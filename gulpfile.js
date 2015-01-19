var gulp = require('gulp'),
	gutil = require('gulp-util'),
	browserify = require('browserify'),
	csso = require('gulp-csso'),
	jscs = require('gulp-jscs'),
	jshint = require('gulp-jshint'),
	plumber = require('gulp-plumber'),
	prefix = require('gulp-autoprefixer'),
	rsync = require('rsyncwrapper').rsync,
	sass = require('gulp-sass'),
	source = require('vinyl-source-stream'),
	watchify = require('watchify'),
	xtend = require('xtend');

gulp.task('styles', function () {
	return gulp.src('./scss/**/*.scss')
		.pipe(plumber({
			errorHandler: function (err) {
				gutil.log(gutil.colors.red('Styles error:\n' + err.message));
				// emit `end` event so the stream can resume https://github.com/dlmanning/gulp-sass/issues/101
				if (this.emit) {
					this.emit('end');
				}
			}
		}))
		.pipe(sass())
		.pipe(prefix())
		.pipe(csso())
		.pipe(gulp.dest('./'));
});

gulp.task('jshint', function () {
	return gulp.src(['**/*.js', '!node_modules/*'])
		.pipe(jshint())
		.pipe(jshint.reporter(require('jshint-stylish')));
});

gulp.task('jscs', function () {
	return gulp.src(['**/*.js', '!node_modules/*'])
		.pipe(jscs());
});

var watching = false;
gulp.task('enable-watch-mode', function () { watching = true });

gulp.task('scripts', function () {
	var opts = {
		entries: './js/main.js',
		debug: (gutil.env.type === 'development')
	}
	if (watching) {
		opts = xtend(opts, watchify.args);
	}
	var bundler = browserify(opts);
	if (watching) {
		bundler = watchify(bundler);
	}
	// optionally transform
	// bundler.transform('transformer');

	bundler.on('update', function (ids) {
		gutil.log('File(s) changed: ' + gutil.colors.cyan(ids));
		gutil.log('Rebunlding...');
	});

	function rebundle() {
		return bundler
			.bundle()
			.on('error', function (e) {
				gutil.log(gutil.colors.red('Browserify ' + e));
			})
			.pipe(source('main.js'))
			.pipe(gulp.dest('./js/dist'));
	}
	return rebundle();
});

gulp.task('watch', ['enable-watch-mode', 'scripts'], function () {
	gulp.watch('./scss/**/*.scss', ['styles']);
});

var server = require('./server.json');
gulp.task('rsync', function () {
	rsync({
		ssh: true,
		src: './**',
		dest: server.user + '@' + server.host + ':' + server.path,
		recursive: true,
		syncDest: true,
		exclude: ['.DS_Store'],
		args: ['--verbose']
	}, function(error, stdout, stderr, cmd) {
		if (error) {
			gutil.log(gutil.colors.red(stderr));
		} else {
			gutil.log(stdout);
		}
	});
});

gulp.task('deploy', ['scripts', 'styles', 'rsync']);
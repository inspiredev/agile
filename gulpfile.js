var gulp = require('gulp'),
	gutil = require('gulp-util'),
	browserify = require('browserify'),
	jscs = require('gulp-jscs'),
	jshint = require('gulp-jshint'),
	plumber = require('gulp-plumber'),
	prefix = require('gulp-prefix'),
	csso = require('gulp-csso'),
	sass = require('gulp-sass'),
	watchify = require('watchify'),
	xtend = require('xtend');

gulp.task('scss', function () {
	return gulp.src('./scss/**/*.scss')
		.pipe(plumber({
			errorHandler: function (err) {
				gutil.log($.util.colors.red('Styles error:\n' + err.message));
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
			.pipe(gulp.dest('./js/dist/main.js'));
	}
	return rebundle();
});

gulp.task('watch', ['enable-watch-mode', 'js'], function () {
	gulp.watch('./scss/**/*.scss', ['scss']);
});
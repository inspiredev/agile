var gulp = require('gulp'),
	gutil = require('gulp-util'),
	plumber = require('gulp-plumber'),
	prefix = require('gulp-prefix'),
	csso = require('gulp-csso'),
	sass = require('gulp-sass');

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


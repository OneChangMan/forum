/**
 * This is the source.
 * https://medium.com/devux/minifying-your-css-js-html-files-using-gulp-2113d7fcbd16
 */

'use strict';

var csso = require('gulp-csso');
var del = require('del');
var gulp = require('gulp');
var runSequence = require('run-sequence');
var uglify = require('gulp-uglify');


// Gulp task to minify CSS files
gulp.task('styles', function () {
  return gulp.src('www/src/css/*.css')
    // Minify the file
    .pipe(csso())
    // Output
    .pipe(gulp.dest('www/dist/css'))
});

// Gulp task to minify JavaScript files
gulp.task('scripts', function() {
  return gulp.src('www/src/js/*.js')
    // Minify the file
    .pipe(uglify())
    // Output
    .pipe(gulp.dest('www/dist/js'))
});
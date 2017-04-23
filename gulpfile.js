'use strict';

// Load plugins
var gulp = require('gulp'),
    sass = require('gulp-sass'),
    jade = require('gulp-jade'),
    autoprefixer = require('gulp-autoprefixer'),
    cssnano = require('gulp-cssnano'),
    uglify = require('gulp-uglify'),
    imagemin = require('gulp-imagemin'),
    rename = require('gulp-rename'),
    concat = require('gulp-concat'),
    cache = require('gulp-cache'),
    livereload = require('gulp-livereload'),
    del = require('del'),
    babel = require('gulp-babel');

// Styles
gulp.task('styles', function() {
    return gulp.src('./src/sass/**/*.sass')
        .pipe(sass.sync().on('error', sass.logError))
        .pipe(autoprefixer('last 2 version'))
        .pipe(gulp.dest('./web/css'))
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(cssnano())
        .pipe(gulp.dest('web/css'))
        .pipe(livereload());
});

// Scripts
gulp.task('scripts', function() {
    return gulp.src('src/js/**/*.js')
        .pipe(babel({
            presets: ['es2015']
        }))
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(uglify())
        .pipe(gulp.dest('./web/js'))
        .pipe(livereload());
});

// Clean
gulp.task('clean', function() {
    return del(['web/css', 'web/js']);
});

// Default task
gulp.task('default', ['watch']);

// Watch
gulp.task('watch', function() {
    // Create LiveReload server
    livereload.listen();

    // Watch .scss files
    gulp.watch('./src/sass/**/*.sass', ['styles']);

    // Watch .js files
    gulp.watch('./src/js/**/*.js', ['scripts']);
});

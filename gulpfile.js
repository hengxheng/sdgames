var gulp = require('gulp');
var sass = require('gulp-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    // minifycss = require('gulp-minify-css'),
    postcss = require('gulp-postcss'),
    notify = require('gulp-notify');
    
var browserSync = require('browser-sync').create();

// Declare development paths
var path = {
    dev : {
        styles : 'src/css',
        images : 'src/images',
        scripts: 'src/js',
        sass : 'src/sass'
    },
    dist: {
        styles : 'dist/css',
        images : 'dist/images',
        scripts: 'dist/js'
    }
};


// ----------dev-----------
gulp.task('browserSync', function() {
    browserSync.init({
      server: {
        baseDir: 'src'
      },
    })
});

// Sass compile, Autoprefix, Reload server
gulp.task('sass', function () {
    return gulp.src(path.dev.sass + '/*.scss')
        .pipe(sass().on('error', notify.onError( function (error) { return 'Error with sass.n' + error; })))
        .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1'))
        .pipe(gulp.dest(path.dev.styles))
        .pipe(browserSync.reload({
            stream: true
          }))
});


// Watch Files For Changes
gulp.task('watch', ['browserSync'], function() {
    gulp.watch(path.dev.sass + '/*.scss', ['sass']);
});


// ----------deploy--------
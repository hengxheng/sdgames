var gulp = require('gulp');
var sass = require('gulp-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    postcss = require('gulp-postcss'),
    notify = require('gulp-notify'),

    useref = require('gulp-useref'),
    imagemin = require('gulp-imagemin'),
    uglify = require('gulp-uglify'),
    gulpif = require('gulp-if'),
    minifyCss = require('gulp-clean-css');
    del = require('del');
    
var browserSync = require('browser-sync').create();

// Declare development paths
var path = {
    dev : {
        styles : 'src/css',
        images : 'src/images',
        scripts: 'src/js',
        sass : 'src/sass',
        fonts : 'src/fonts'
    },
    dist: {
        styles : 'dist/css',
        images : 'dist/images',
        scripts: 'dist/js',
        fonts: 'dist/fonts'
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

gulp.task('html', function () {
    return gulp.src('src/*.html')
    .pipe(gulp.dest('dist'));
});

gulp.task('css-build', function(){
    return gulp.src(path.dev.sass + '/*.scss')
    .pipe(sass().on('error', notify.onError( function (error) { return 'Error with sass.n' + error; })))
    .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1'))
    .pipe(minifyCss({compatibility: 'ie8'}))
    .pipe(gulp.dest(path.dist.styles))
})

gulp.task('js-build', function(){
    return gulp.src(path.dev.scripts + '/*.js')
    .pipe(uglify())
    .pipe(gulp.dest(path.dist.scripts))
});

gulp.task('images', function(){
    return gulp.src(path.dev.images+'/**/*.+(png|jpg|gif|svg)')
    .pipe(imagemin())
    .pipe(gulp.dest(path.dist.images))
});

gulp.task('fonts', function() {
    return gulp.src(path.dev.fonts+'/**/*')
    .pipe(gulp.dest(path.dist.fonts))
})

gulp.task('clean', function() {
    return del.sync('dist');
})

gulp.task('build', [`clean`, `html`, `css-build`, `js-build`, `images`, `fonts`], function (){
    console.log('Building files');
})
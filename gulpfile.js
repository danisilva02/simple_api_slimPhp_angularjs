var gulp = require('gulp'),
    uglify = require('gulp-uglify'),
    server = require('gulp-live-server'),
    browserify = require('gulp-browserify'),
    rename = require("gulp-rename"),
    htmlmin = require('gulp-htmlmin');

gulp.task('default', ['browserify','watch','minify','minifyViews']);


gulp.task('watch', function(){
    gulp.watch('app/**/*.js', ['browserify']);
});

gulp.task('serve', function() {
    var serve = server.static('./public', 8000);
    serve.start();
    gulp.watch('public/js/**/*.js', function (file){
        server.notify.apply(serve, [file]);
    });
    gulp.watch('public/**/*.html', function (file){
        server.notify.apply(serve, [file]);
    });

});

gulp.task('browserify', function(){
    return gulp.src(['app/app.js'])
        .pipe(browserify())
        .pipe(uglify())
        .pipe(rename("main.js"))
        .pipe(gulp.dest('public/js/'));
});

gulp.task('minify', function() {
  return gulp.src('app/*.html')
    .pipe(htmlmin({collapseWhitespace: false}))
    .pipe(gulp.dest('public'))
});
gulp.task('minifyViews', function() {
  return gulp.src('app/views/*.html')
    .pipe(htmlmin({collapseWhitespace: false}))
    .pipe(gulp.dest('public/views'))
});

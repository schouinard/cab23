var gulp = require('gulp');
var notify = require('gulp-notify');
var phpunit = require('gulp-phpunit');
var run = require('gulp-run');

gulp.task('test', function () {
    gulp.src('tests/**/*.php')
        .pipe(run('clear'))
        .pipe(phpunit('', {notify: true}));
});

gulp.task('watch', function() {
    gulp.watch(['tests/**/*.php', 'app/**/*.php'], ['test']);
});

gulp.task('default', ['test', 'watch']);

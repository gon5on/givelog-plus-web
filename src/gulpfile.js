'use strict';
const gulp = require('gulp');
const autoprefixer = require('gulp-autoprefixer');
const fs = require('fs');
const ejs = require('gulp-ejs');
const sass = require('gulp-sass');
const rename = require('gulp-rename');
const browserSync = require('browser-sync');
const watch = require('gulp-watch');
const plumber = require('gulp-plumber');
const sourcemaps = require('gulp-sourcemaps');
const dir = {
    src: 'givelog-plus/webroot', // 吐き出されるとこ
    ejs: 'dev/ejs', // ejsいれてるとこ
    data: 'dev/data', // 開発用のテンプレ
    sass: 'dev/styles' // sassいれてるとこ
};

//css
gulp.task("sass", () => {
    return gulp.src( dir.sass + '/{,**/}*.scss' )
    .pipe(plumber())
    .pipe(sourcemaps.init())
    .pipe(sass({ outputStyle: 'expanded' }).on('error', sass.logError))
    .pipe(autoprefixer({ cascade: false }))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest(dir.src + '/css'));
    });
gulp.task('css', gulp.series('sass'));

//ejs
gulp.task("ejs", () => {
    return gulp.src(
        [dir.ejs + "/**/*.ejs",'!' + dir.ejs + "/**/_*.ejs"]
    )
    .pipe(plumber())
    .pipe(ejs({
        config: JSON.parse(fs.readFileSync(dir.data + '/config.json'))
    }))
    .pipe(rename({ extname: '.html' }))
    .pipe(gulp.dest(dir.src + '/design/'));
});
gulp.task('html', gulp.series('ejs'));

//browserSync
gulp.task('browser-sync', () => {
    browserSync({
        server: {
            proxy: "localhost:3000",
            baseDir: dir.src
        },
        ghostMode: false
    });
    watch([dir.sass + '/{,**/}*.scss'], gulp.series('sass', browserSync.reload));
    watch([dir.ejs + '/{,**/}*.ejs'], gulp.series('ejs', browserSync.reload));
});
gulp.task('server', gulp.series('browser-sync'));

// default
gulp.task('build', gulp.parallel('css', 'html'));
gulp.task('default', gulp.series('build', 'server'));
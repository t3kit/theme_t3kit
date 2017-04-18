// small Example with gulp
const gulp = require('gulp')
const browserSync = require('browser-sync').create()
const less = require('gulp-less')
const css = (file) => `<link rel="stylesheet" type="text/css" href="${file}"/>`
const js = (file) => `<script src="${file}"></script>`

gulp.task('serve', ['less'], function () {
  browserSync.init({
    proxy: 'localhost:8888',
    serveStatic: ['temp'],
    watchTask: true,
    snippetOptions: {
      rule: {
        match: /<\/head>/i,
        fn: function (snippet, match) {
          return `
            ${css('bootstrap.css')}
            ${css('components.css')}
            ${css('main.css')}
            ${js('jquery.js')}
            ${js('bootstrap.js')}
            ${js('components.js')}
            ${js('main.js')}
            ${snippet}
            ${match}
          `
        }
      }
    }
  })
  gulp.watch('dev/styles/**/*.less', ['less'])
})

gulp.task('less', function () {
  return gulp.src('dev/styles/main.less')
    .pipe(less())
    .pipe(gulp.dest('temp'))
    .pipe(browserSync.stream())
})

gulp.task('default', ['serve'])

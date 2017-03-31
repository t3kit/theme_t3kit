const css = (file) => `<link rel="stylesheet" type="text/css" href="${file}"/>`
const js = (file) => `<script src="${file}"></script>`
const port = `8888`
module.exports = {
  dev: {
    bsFiles: {
      src: ['<%= temp %>/*.css', '<%= temp %>/*.js']
    },
    options: {
      proxy: `localhost:${port}`,
      serveStatic: ['<%= temp %>'],
      watchTask: true,
      open: false,
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
    }
  }
}

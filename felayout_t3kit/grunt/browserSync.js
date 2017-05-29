const css = (file) => `<link rel="stylesheet" type="text/css" href="/${file}"/>`
const js = (file) => `<script src="/${file}"></script>`
const conf = require('../conf')

module.exports = {
  dev: {
    bsFiles: {
      src: ['<%= temp %>/*.css', '<%= temp %>/*.js']
    },
    options: {
      proxy: `${conf.var.proxy}`,
      serveStatic: ['<%= temp %>'],
      watchTask: true,
      open: false,
      port: 9001,
      ghostMode: false,
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

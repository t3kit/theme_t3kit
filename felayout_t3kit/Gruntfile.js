const conf = require('./conf')

module.exports = function (grunt) {
  require('time-grunt')(grunt)
  require('load-grunt-config')(grunt, {
    data: {
      cssFolder: conf.var.cssFolder,
      lessFolder: conf.var.lessFolder,
      iconFontFolder: conf.var.iconFontFolder,
      dev: `dev`,
      temp: `temp`,
      components: conf.var.components
    },
    jitGrunt: {
      jitGrunt: true
    }
  })
}

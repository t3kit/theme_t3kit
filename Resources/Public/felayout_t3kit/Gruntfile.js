module.exports = function (grunt) {
  require('time-grunt')(grunt)
  require('load-grunt-config')(grunt, {
    data: {
      cssFolder: `css`,
      lessFolder: `less`,
      dev: `dev`,
      temp: `temp`,
      bc: `dev/bower_components`
    },
    jitGrunt: {
      jitGrunt: true
    }
  })
}

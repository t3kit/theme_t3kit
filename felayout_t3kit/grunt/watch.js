// file sets for Grunt Watch process

// css/less
const lessBootstrapFiles = ['<%= dev %>/styles/bootstrap.less', '<%= dev %>/styles/customVariables.less']
const cssComponentsFiles = ['<%= dev %>/styles/components.less']
const mainLessFiles = ['<%= dev %>/styles/**/*.less', '!<%= dev %>/styles/bootstrap.less', '!<%= dev %>/styles/components.less']

// js
const jsJqueryFiles = ['<%= dev %>/js/jquery.js']
const jsBootstrapFiles = ['<%= dev %>/js/bootstrap.js']
const jsComponentsFiles = ['<%= dev %>/js/components.js']
const jsMainFiles = ['<%= dev %>/js/**/*.js', '!<%= dev %>/js/components.js', '!<%= dev %>/js/bootstrap.js', '!<%= dev %>/js/jquery.js']

// other files
const fontsFiles = '<%= dev %>/fonts/{,*/}*.*'
const imagesFiles = '<%= dev %>/images/{,*/}*.*'

module.exports = {
    // ============================================================
    // DEFAULT
    // ============================================================
    // DEFAULT watch process - less compilation
  lessBootstrap: {
    files: lessBootstrapFiles,
    tasks: ['less:bootstrap']
  },
  lessComponents: {
    files: cssComponentsFiles,
    tasks: ['less:components']
  },
  lessMain: {
    files: mainLessFiles,
    // tasks: ['less:main', 'postcss']
    tasks: ['less:main']
  },

  // DEFAULT watch process - js import
  jsJquery: {
    files: jsJqueryFiles,
    tasks: 'import:jquery'
  },
  jsBootstrap: {
    files: jsBootstrapFiles,
    tasks: 'import:bootstrap'
  },
  jsComponents: {
    files: jsComponentsFiles,
    tasks: 'import:components'
  },
  jsMain: {
    files: jsMainFiles,
    tasks: ['import:main']
  },

  // DEFAULT watch process - copy images and fonts
  copyFonts: {
    files: fontsFiles,
    tasks: 'newer:copy:fonts'
  },
  copyImages: {
    files: imagesFiles,
    tasks: 'newer:copy:images'
  }
}

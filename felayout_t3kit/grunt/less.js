module.exports = {
  bootstrap: {
    options: {
      sourceMap: false
    },
    files: {
      '<%= temp %>/bootstrap.css': '<%= dev %>/styles/bootstrap.less'
    }
  },
  components: {
    options: {
      sourceMap: false
    },
    files: {
      '<%= temp %>/components.css': '<%= dev %>/styles/components.less'
    }
  },
  main: {
    options: {
      sourceMap: true,
      sourceMapFilename: '<%= temp %>/main.css.map',
      sourceMapURL: 'main.css.map',
      plugins: [
        new (require('less-plugin-autoprefix'))({browsers: ['last 2 versions']})
      ]
    },
    files: {
      '<%= temp %>/main.css': '<%= dev %>/styles/main.less'
    }
  }
}

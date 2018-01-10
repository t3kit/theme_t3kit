module.exports = {
  lessFolder: {
    files: [{
      expand: true,
      cwd: '<%= lessFolder %>',
      src: '**/*.js',
      dest: '<%= lessFolder %>'
    }]
  },
  cssFolder: {
    files: [{
      expand: true,
      cwd: '<%= cssFolder %>',
      src: '**/*.js',
      dest: '<%= cssFolder %>'
    }]
  }
}

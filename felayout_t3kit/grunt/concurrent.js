module.exports = {
  options: {
    limit: 17
  },

  // Run grunt tasks concurrently. Copy files. Default task.
  devProcess: {
    tasks: [
      'copy:fonts',
      'copy:images',
      'copy:flags',
      'less:bootstrap',
      'less:components',
      'less:main',
      'import:jquery',
      'import:bootstrap',
      'import:components',
      'import:main'
    ]
  },

  // Run grunt tasks concurrently. Copy main files plus less styling
  lessProcess: {
    tasks: [
      'copy:filesToLessFolder',
      'copy:iconFontToIconFolder',
      'import:bootstrapLess',
      'import:mainLess',
      'imagemin:toLessFolder'
    ]
  },

  // Run grunt tasks concurrently. Copy main files plus css styling
  cssProcess: {
    tasks: [
      'copy:filesToCssFolder',
      'copy:iconFontToIconFolder',
      'imagemin:toCssFolder'
    ]
  }
}

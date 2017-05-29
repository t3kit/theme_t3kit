module.exports = {
  options: {
    limit: 17
  },

  // Run grunt tasks concurrently. Copy files. Default task.
  devProcess: {
    tasks: [
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
      'import:bootstrapLess',
      'import:mainLess',
      'imagemin:toLessFolder'
    ]
  },

  // Run grunt tasks concurrently. Copy main files plus css styling
  cssProcess: {
    tasks: [
      'copy:filesToCssFolder',
      'imagemin:toCssFolder'
    ]
  }
}

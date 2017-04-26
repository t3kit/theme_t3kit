module.exports = {
  less: {
    options: {
      configFile: '.stylelintrc',
      syntax: 'less'
    },
    src: [
      'dev/styles/**/*.{css,less}'
    ]
  }
}

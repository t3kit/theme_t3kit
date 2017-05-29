module.exports = {
  lessFolder: {
    options: {
      force: true
    },
    files: [{
      dot: true,
      src: [
        '<%= lessFolder %>/*'
      ]
    }]
  },
  cssFolder: {
    options: {
      force: true
    },
    files: [{
      dot: true,
      src: [
        '<%= cssFolder %>/*'
      ]
    }]
  },
  tempFolder: {
    files: [{
      dot: true,
      src: [
        '<%= temp %>/*'
      ]
    }]
  }
}

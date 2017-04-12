module.exports = {
  lessFolder: {
    files: [{
      dot: true,
      src: [
        '<%= lessFolder %>/*'
      ]
    }]
  },
  cssFolder: {
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

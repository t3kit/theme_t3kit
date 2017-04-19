module.exports = {

    // copy tasks for Main development process
  images: {
    expand: true,
    dot: true,
    cwd: '<%= dev %>',
    dest: '<%= temp %>',
    src: [
      'images/{,*/}*.*'
    ]
  },
  flags: {
    expand: true,
    dot: true,
    cwd: '<%= components %>/flag-icon-css/flags/4x3/',
    dest: '<%= temp %>/flags/4x3/',
    src: [
      'be.svg',
      'dk.svg',
      'ee.svg',
      'fl.svg',
      'fr.svg',
      'fi.svg',
      'de.svg',
      'it.svg',
      'nl.svg',
      'nz.svg',
      'no.svg',
      'pl.svg',
      'pt.svg',
      'es.svg',
      'se.svg',
      'ch.svg',
      'gb.svg',
      'ua.svg',
      'ro.svg',
      'us.svg'
    ]
  },

  filesToLessFolder: {
    expand: true,
    dot: true,
    cwd: '<%= temp %>',
    dest: '<%= lessFolder %>',
    src: [
      '*.js',
      'components.css',
      'flags/{,*/}*.*',
    ]
  },

  filesToCssFolder: {
    expand: true,
    dot: true,
    cwd: '<%= temp %>',
    dest: '<%= cssFolder %>',
    src: [
      '*.js',
      '*.css',
      'flags/{,*/}*.*',
    ]
  }
}

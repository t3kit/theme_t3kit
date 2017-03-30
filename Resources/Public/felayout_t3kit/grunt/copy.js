module.exports = {

    // copy tasks for Main development process
    fonts: {
        expand: true,
        dot: true,
        cwd: '<%= dev %>',
        dest: '<%= temp %>',
        src: [
            'fonts/{,*/}*.*'
        ]
    },
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
        cwd: '<%= bc %>/flag-icon-css/flags/4x3/',
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

    // copy tasks for static site
    filesToSiteFolder: {
        expand: true,
        dot: true,
        cwd: '<%= temp %>',
        dest: '<%= site %>',
        src: [
            '*.js',
            '*.css',
            '*.html',
            '*.{ico,png,txt,xml,svg}',
            'flags/{,*/}*.*',
            'fonts/{,*/}*.*'
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
            'local.css',
            'flags/{,*/}*.*',
            'fonts/{,*/}*.*'
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
            'fonts/{,*/}*.*'
        ]
    },

    // Copy .gitignore files into service folders
    gitignoreToCssFolder: {
        expand: true,
        dot: true,
        cwd: '.',
        dest: '<%= cssFolder %>',
        src: [
            '.gitignore'
        ]
    },
    gitignoreToLessFolder: {
        expand: true,
        dot: true,
        cwd: '.',
        dest: '<%= lessFolder %>',
        src: [
            '.gitignore'
        ]
    },

    // Copy folder copyToRoot into service folders
    copyToRootFolder: {
        expand: true,
        dot: true,
        cwd: '<%= dev %>/copyToRoot',
        dest: '<%= temp %>',
        src: [
            '{,*/}*.*'
        ]
    },
    copyToRootToCssFolder: {
        expand: true,
        dot: true,
        cwd: '<%= dev %>',
        dest: '<%= cssFolder %>',
        src: [
            'copyToRoot/{,*/}*.*',
            '!copyToRoot/robots.txt',
        ]
    },
    copyToRootToLessFolder: {
        expand: true,
        dot: true,
        cwd: '<%= dev %>',
        dest: '<%= lessFolder %>',
        src: [
            'copyToRoot/{,*/}*.*',
            '!copyToRoot/robots.txt',
        ]
    },
};

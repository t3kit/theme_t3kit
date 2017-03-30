// file sets for Grunt Watch process

// css/less
var lessBootstrapFiles = ['<%= dev %>/styles/bootstrap.less', '<%= dev %>/styles/customVariables.less'];
var cssComponentsFiles = ['<%= dev %>/styles/components.less'];
var mainLessFiles = ['<%= dev %>/styles/**/*.less', '!<%= dev %>/styles/bootstrap.less', '!<%= dev %>/styles/local.less', '!<%= dev %>/styles/components.less', '!<%= dev %>/styles/local/{,*/}*.less'];
var lessLocalFiles = ['<%= dev %>/styles/local.less', '<%= dev %>/styles/local/{,*/}*.less'];

// js
var jsJqueryFiles = ['<%= dev %>/js/jquery.js'];
var jsBootstrapFiles = ['<%= dev %>/js/bootstrap.js'];
var jsComponentsFiles = ['<%= dev %>/js/components.js'];
var jsMainFiles = ['<%= dev %>/js/**/*.js', '!<%= dev %>/js/local.js','!<%= dev %>/js/local/{,*/}*.js', '!<%= dev %>/js/components.js', '!<%= dev %>/js/bootstrap.js', '!<%= dev %>/js/jquery.js'];
var jsLocalFiles = ['<%= dev %>/js/local.js','<%= dev %>/js/local/{,*/}*.js'];

// other files
var fontsFiles = '<%= dev %>/fonts/{,*/}*.*';
var imagesFiles = '<%= dev %>/images/{,*/}*.*';
var copyToRootFiles = '<%= dev %>/copyToRoot/{,*/}*.*';

module.exports = {
    // ============================================================
    // DEFAULT
    // ============================================================
    // DEFAULT watch process - handlebars templates
    // html: {
    //     files: ['<%= dev %>/templates/**/*.hbs'],
    //     tasks: ['assemble:allTemplates']
    // },

    // DEFAULT watch process - less compilation
    lessBootstrap: {
        files: lessBootstrapFiles,
        tasks: ['less:bootstrap']
    },
    lessComponents: {
        files: cssComponentsFiles,
        tasks: ['less:components']
    },
    less: {
        files: mainLessFiles,
        // tasks: ['less:main', 'postcss']
        tasks: ['less:main']
    },
    // lessLocal: {
    //     files: lessLocalFiles,
    //     tasks: ['less:local']
    // },

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
    // jsLocal: {
    //     files: jsLocalFiles,
    //     tasks: 'import:local'
    // },

    // DEFAULT watch process - copy sys files
    copyFonts: {
        files: fontsFiles,
        tasks: 'newer:copy:fonts'
    },
    // copyImages: {
    //     files: imagesFiles,
    //     tasks: 'newer:copy:images'
    // },
    // copyToRoot: {
    //     files: copyToRootFiles,
    //     tasks: 'newer:copy:copyToRootFolder'
    // },
    // ^^^^^^^^^^^^^^^^^^^^^^^^^^^END^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

    // ============================================================
    // felayout LESS - (task prefix = lss)
    // Provide all Front-End service files plus LESS styling for CMS needs, and copy it to less folder
    // ============================================================
    // Watch process - less compilation
    // lssLessBootstrap: {
    //     files: lessBootstrapFiles,
    //     tasks: ['less:bootstrap', 'import:bootstrapLess']
    // },
    // lssLessComponents: {
    //     files: cssComponentsFiles,
    //     tasks: ['less:components', 'newer:copy:filesToLessFolder']
    // },
    // lssLess: {
    //     files: mainLessFiles,
    //     tasks: ['less:main', 'import:mainLess']
    // },

    // // Watch process copy sys files
    // lssCopyFonts: {
    //     files: fontsFiles,
    //     tasks: ['newer:copy:fonts', 'newer:copy:filesToLessFolder']
    // },
    // lssCopyImages: {
    //     files: imagesFiles,
    //     tasks: ['newer:copy:images', 'newer:imagemin:toLessFolder']
    // },
    // lssCopyToRoot: {
    //     files: copyToRootFiles,
    //     tasks: ['newer:copy:copyToRootFolder', 'newer:copy:copyToRootToLessFolder']
    // },

    // // Watch process - js import
    // lssJsJquery: {
    //     files: jsJqueryFiles,
    //     tasks: ['import:jquery', 'newer:copy:filesToLessFolder']
    // },
    // lssJsBootstrap: {
    //     files: jsBootstrapFiles,
    //     tasks: ['import:bootstrap', 'newer:copy:filesToLessFolder']
    // },
    // lssJsComponents: {
    //     files: jsComponentsFiles,
    //     tasks: ['import:components', 'newer:copy:filesToLessFolder']
    // },
    // lssJsMain: {
    //     files: jsMainFiles,
    //     tasks: ['import:main', 'newer:copy:filesToLessFolder']
    // },
    // ^^^^^^^^^^^^^^^^^^^^^^^^^^^END^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

    // ============================================================
    // felayout CSS - (task prefix = css)
    // Provide all Front-End service files plus CSS styling for CMS needs, and copy it to css folder
    // ============================================================
    // Watch process - less compilation
    // cssLessBootstrap: {
    //     files: lessBootstrapFiles,
    //     tasks: ['less:bootstrap', 'newer:copy:filesToCssFolder']
    // },
    // cssLessComponents: {
    //     files: cssComponentsFiles,
    //     tasks: ['less:components', 'newer:copy:filesToCssFolder']
    // },
    // cssLess: {
    //     files: mainLessFiles,
    //     tasks: ['less:main', 'postcss', 'newer:copy:filesToCssFolder']
    // },

    // // Watch process - js import
    // cssJsJquery: {
    //     files: jsJqueryFiles,
    //     tasks: ['import:jquery', 'newer:copy:filesToCssFolder']
    // },
    // cssJsBootstrap: {
    //     files: jsBootstrapFiles,
    //     tasks: ['import:bootstrap', 'newer:copy:filesToCssFolder']
    // },
    // cssJsComponents: {
    //     files: jsComponentsFiles,
    //     tasks: ['import:components', 'newer:copy:filesToCssFolder']
    // },
    // cssJsMain: {
    //     files: jsMainFiles,
    //     tasks: ['import:main', 'newer:copy:filesToCssFolder']
    // },

    // // Watch process - copy files
    // cssCopyFonts: {
    //     files: fontsFiles,
    //     tasks: ['newer:copy:fonts', 'newer:copy:filesToCssFolder']
    // },
    // cssCopyImages: {
    //     files: imagesFiles,
    //     tasks: ['newer:copy:images', 'newer:imagemin:toCssFolder']
    // },
    // cssCopyToRoot: {
    //     files: copyToRootFiles,
    //     tasks: ['newer:copy:copyToRootFolder', 'newer:copy:copyToRootToCssFolder']
    // },
    // ^^^^^^^^^^^^^^^^^^^^^^^^^^^END^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

    // livereload: {
    //     options: {
    //         interrupt: true,
    //         livereload: 35729
    //     },
        // files: [
        //     '<%= temp %>/*.html',
        //     '<%= temp %>/*.css',
        //     '<%= temp %>/*.js',
        //     '<%= temp %>/images/{,*/}*.*',
        //     '<%= temp %>/fonts/{,*/}*.*',
        //     '<%= temp %>/*.{ico,png,txt,xml}'
        // ]
    // }

};

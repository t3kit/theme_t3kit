module.exports = {
    default: {
        include: ['html', 'lessBootstrap', 'lessComponents', 'less', 'lessLocal', 'jsJquery', 'jsBootstrap', 'jsComponents', 'jsMain', 'jsLocal', 'copyFonts', 'copyImages', 'copyToRoot', 'livereload']
    },
    less: {
        include: ['html', 'lessLocal', 'jsLocal', 'lssLessBootstrap', 'lssLessComponents', 'lssLess', 'lssCopyFonts', 'lssCopyImages', 'lssCopyToRoot', 'lssJsJquery', 'lssJsBootstrap', 'lssJsComponents', 'lssJsMain', 'livereload']
    },
    css: {
        include: ['html', 'lessLocal', 'jsLocal', 'cssLessBootstrap', 'cssLessComponents', 'cssLess', 'cssJsJquery', 'cssJsBootstrap', 'cssJsComponents', 'cssJsMain', 'cssCopyFonts', 'cssCopyImages', 'cssCopyToRoot', 'livereload']
    },
};

module.exports = {
    options: {
        limit: 17
    },

    // Copy files and compile templates. Default task.
    devProcess: {
        tasks: [
            'copy:fonts',
            // 'copy:images',
            'copy:flags',
            // 'copy:copyToRootFolder',
            // 'assemble:allTemplates',
            'less:bootstrap',
            'less:components',
            'less:main',
            // 'less:local',
            'import:jquery',
            'import:bootstrap',
            'import:components',
            'import:main',
            // 'import:local'
        ],
    },
    // Copy files and minify images. Static site task.
    siteProcess: {
        tasks: [
            'copy:filesToSiteFolder',
            'imagemin:toSiteFolder'
        ],
    },

    // Run grunt tasks concurrently. Copy main files plus less styling
    lessProcess: {
        tasks: [
            'copy:filesToLessFolder',
            'copy:copyToRootToLessFolder',
            'import:bootstrapLess',
            'import:mainLess',
            'imagemin:toLessFolder',
            'copy:gitignoreToLessFolder'
        ],
    },

    // Run grunt tasks concurrently. Copy main files plus css styling
    cssProcess: {
        tasks: [
            'copy:filesToCssFolder',
            'copy:copyToRootToCssFolder',
            'imagemin:toCssFolder',
            'copy:gitignoreToCssFolder'
        ]
    },
};

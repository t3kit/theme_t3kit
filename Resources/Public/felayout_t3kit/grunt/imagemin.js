module.exports = {
    toSiteFolder: {
        files: [{
            expand: true,
            cwd: '<%= temp %>',
            src: ['images/{,*/}*.{png,jpg,jpeg,gif,svg}'],
            dest: '<%= site %>'
        }]
    },
    toLessFolder: {
        files: [{
            expand: true,
            cwd: '<%= temp %>',
            src: ['images/{,*/}*.{png,jpg,jpeg,gif,svg}'],
            dest: '<%= lessFolder %>'
        }]
    },
    toCssFolder: {
        files: [{
            expand: true,
            cwd: '<%= temp %>',
            src: ['images/{,*/}*.{png,jpg,jpeg,gif,svg}'],
            dest: '<%= cssFolder %>'
        }]
    }
};

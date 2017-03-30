module.exports = {
    siteFolder: {
        files: [{
            dot: true,
            src: [
                '<%= site %>/*',
                '!<%= site %>/.git*'
            ]
        }]
    },
    lessFolder: {
        files: [{
            dot: true,
            src: [
                '<%= lessFolder %>/*',
                '!<%= lessFolder %>/.git*'
            ]
        }]
    },
    cssFolder: {
        files: [{
            dot: true,
            src: [
                '<%= cssFolder %>/*',
                '!<%= cssFolder %>/.git*'
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
};

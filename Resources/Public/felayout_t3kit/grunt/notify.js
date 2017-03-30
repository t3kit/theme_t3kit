module.exports = {
    server: {
        options: {
            title: 'Server is ready',
            message: 'http://localhost:<%= connect.options.port %>'
        }
    },
    site: {
        options: {
            message: 'Static site successfully updated'
        }
    },
    css: {
        options: {
            message: 'CSS branch successfully updated'
        }
    },
    less: {
        options: {
            message: 'LESS branch successfully updated'
        }
    }
};

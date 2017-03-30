module.exports = {
    options: {
        port: 9004,
        livereload: 35729,
        hostname: '0.0.0.0'
        // hostname: 'localhost'
    },
    localhost: {
        options: {
            base: ['.','<%= temp %>'],
        }
    }
};

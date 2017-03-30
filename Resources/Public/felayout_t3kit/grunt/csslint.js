module.exports = {
    options: {
        csslintrc: '.csslintrc'
    },
    lint: {
        options: {
            import: false
        },
        src: ['<%= temp %>/main.css']
    }
};

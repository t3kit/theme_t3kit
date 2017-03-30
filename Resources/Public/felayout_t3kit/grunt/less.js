module.exports = {
    bootstrap: {
        options: {
            sourceMap: false
        },
        files: {
            '<%= temp %>/bootstrap.css': '<%= dev %>/styles/bootstrap.less'
        }
    },
    components: {
        options: {
            sourceMap: false
        },
        files: {
            '<%= temp %>/components.css': '<%= dev %>/styles/components.less'
        }
    },
    main: {
        options: {
            sourceMap: false,
            // sourceMapFilename: '<%= temp %>/main.css.map',
            // sourceMapURL: 'main.css.map'
        },
        files: {
            '<%= temp %>/main.css': '<%= dev %>/styles/main.less'
        }
    },
    local: {
        options: {
            sourceMap: false
        },
        files: {
            '<%= temp %>/local.css': '<%= dev %>/styles/local.less'
        }
    }
};

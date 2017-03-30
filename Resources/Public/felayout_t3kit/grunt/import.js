module.exports = {
    jquery: {
        src: '<%= dev %>/js/jquery.js',
        dest: '<%= temp %>/jquery.js',
    },
    bootstrap: {
        src: '<%= dev %>/js/bootstrap.js',
        dest: '<%= temp %>/bootstrap.js',
    },
    components: {
        src: '<%= dev %>/js/components.js',
        dest: '<%= temp %>/components.js',
    },
    main: {
        src: '<%= dev %>/js/main.js',
        dest: '<%= temp %>/main.js',
    },
    local: {
        src: '<%= dev %>/js/local.js',
        dest: '<%= temp %>/local.js',
    },

    bootstrapLess: {
        src: '<%= dev %>/styles/bootstrap.less',
        dest: '<%= lessFolder %>/bootstrap.less',
    },
    mainLess: {
        src: '<%= dev %>/styles/main.less',
        dest: '<%= lessFolder %>/main.less',
    }
};

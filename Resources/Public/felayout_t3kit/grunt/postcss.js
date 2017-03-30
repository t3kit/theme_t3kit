module.exports = {
    options: {
        map: {
            inline: false,
            annotation: '<%= temp %>'
        },
        processors: [
            require('autoprefixer')({ browsers: ['last 2 versions'] })
        ]
    },
    dist: {
        src: ['<%= temp %>/main.css']
    }
};

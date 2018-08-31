module.exports = {
    options: {
        mergeIntoShorthands: false,
        roundingPrecision: -1
    },
    target: {
        files: [{
            expand: true,
            cwd: '../out/src/css/abovethefold',
            src: ['*.css', '!*.min.css'],
            dest: '../out/src/css/abovethefold',
            ext: '.min.css'
        }]
    }
};
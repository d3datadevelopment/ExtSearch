const sass = require('node-sass');

module.exports = {
    options: {
        implementation: sass
    },

    module_sourcemap: {
        options: {
            sourceMapEmbed: true,
            outputStyle: 'nested'
        },
        files: {
            "tmp/d3extsearch_wave.css": "origin/sass/styles_wave.scss"
        }
    },
    
    module: {
        options: {
            sourceMap: false,
            outputStyle: 'nested'
        },
        files: {
            "tmp/d3extsearch_wave.css": "origin/sass/styles_wave.scss"
        }
    }
};

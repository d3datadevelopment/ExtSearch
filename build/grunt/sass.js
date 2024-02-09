/* jshint esversion: 9 */
/* global module */
/* global require */

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
            "tmp/d3extsearch_apex.css": "origin/sass/apex/styles.scss",
            "tmp/d3extsearch_wave.css": "origin/sass/wave/styles.scss"
        }
    },
    
    module: {
        options: {
            sourceMap: false,
            outputStyle: 'nested'
        },
        files: {
            "tmp/d3extsearch_apex.css": "origin/sass/apex/styles.scss",
            "tmp/d3extsearch_wave.css": "origin/sass/wave/styles.scss"
        }
    }
};

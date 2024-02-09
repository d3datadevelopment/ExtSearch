/* jshint esversion: 9 */
/* global module */

module.exports = {

    sourcemaped_css: {
        files: {
            "../assets/out/src/css/d3extsearch_apex.min.css": "tmp/d3extsearch_apex.css",
            "../assets/out/src/css/d3extsearch_wave.min.css": "tmp/d3extsearch_wave.css"
        }
    },
    nouislider: {
        files: {
            "../assets/out/src/js/nouislider.min.js": "node_modules/nouislider/dist/nouislider.min.js"
        }
    },
    vendorToSource: {
        files: [
            {
                expand: true,
                cwd: '../assets/out/src',
                src: ['**'],
                dest: '../../../../source/out/modules/d3_extsearch/out/src/'
            }
        ]
    }
};

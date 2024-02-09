/* jshint esversion: 9 */
/* global module */

module.exports = {

    options: {
        banner: '/**\n' +
            ' * This Software is the property of Data Development and is protected\n' +
            ' * by copyright law - it is NOT Freeware.\n' +
            ' * Any unauthorized use of this software without a valid license\n' +
            ' * is a violation of the license agreement and will be prosecuted by\n' +
            ' * civil and criminal law.\n' +
            ' * https://www.d3data.de\n' +
            ' *\n' +
            ' * @license\n' +
            ' * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)\n' +
            ' * @author    D3 Data Development - Daniel Seifert <support@shopmodule.com>\n' +
            ' * @link      https://www.oxidmodule.com\n' +
            ' */'
    },

    module: {
        options: {
            sourceMap: false
        },
        files: [
            {
                expand: true,
                src:    "*.js",
                cwd:    "origin/js",
                dest:   "../assets/out/src/js/apex/",
                ext:    ".min.js",
                extDot: "last"
            },
            {
                expand: true,
                src:    "*.js",
                cwd:    "origin/js",
                dest:   "../assets/out/src/js/wave/",
                ext:    ".min.js",
                extDot: "last"
            }
        ]
    },
    module_unminified: {
        options: {
            sourceMap: true,
            compress: false,
            mangle: false,
            beautify: true
        },
        files: [
            {
                expand: true,
                src:    "*.js",
                cwd:    "origin/js",
                dest:   "../assets/out/src/js/apex/",
                ext:    ".min.js",
                extDot: "last"
            },
            {
                expand: true,
                src:    "*.js",
                cwd:    "origin/js",
                dest:   "../assets/out/src/js/wave/",
                ext:    ".min.js",
                extDot: "last"
            }
        ]
    }
};

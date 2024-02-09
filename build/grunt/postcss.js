/* jshint esversion: 9 */
/* global module */
/* global require */

module.exports = {

    module_unminified: {
        options: {
            processors: [
                require('cssnano')({
                    preset: ['advanced', {
                        autoprefixer: true,
                        cssDeclarationSorter: true,
                        convertValues: true,
                        calc: true,
                        colormin: true,
                        discardComments: false,
                        discardDuplicates: true,
                        discardEmpty: true,
                        discardOverridden: true,
                        discardUnused: false,
                        mergeIdents: true,
                        mergeLonghand: true,
                        mergeRules: true,
                        minifyFontValues: true,
                        minifyGradients: true,
                        minifyParams: false,    // minified
                        minifySelectors: false, // minified
                        normalizeCharset: true,
                        normalizeDisplayValues: true,
                        normalizePositions: true,
                        normalizeRepeatStyle: true,
                        normalizeString: true,
                        normalizeTimingFunctions: true,
                        normalizeUnicode: true,
                        normalizeUrl: true,
                        normalizeWhitespace: false, // minified
                        orderedValues: true,
                        rawCache: true,
                        reduceIdents: true,
                        reduceInitial: true,
                        reduceTransforms: true,
                        uniqueSelectors: false, // minified
                        svgo: false,
                        zindex: false,
                    }],
                })
            ]
        },
        map: {
            inline: true
        },
        cwd: 'tmp/',
        src: '*.css',
        dest: '../assets/out/src/css/',
        expand: true,
        ext: '.min.css'
    },

    module_minified: {
        options: {
            processors: [
                require('cssnano')({
                    preset: ['advanced', {
                        autoprefixer: true,
                        cssDeclarationSorter: true,
                        convertValues: true,
                        calc: true,
                        colormin: true,
                        discardComments: true,
                        discardDuplicates: true,
                        discardEmpty: true,
                        discardOverridden: true,
                        discardUnused: false,
                        mergeIdents: true,
                        mergeLonghand: true,
                        mergeRules: true,
                        minifyFontValues: true,
                        minifyGradients: true,
                        minifyParams: true,
                        minifySelectors: true,
                        normalizeCharset: true,
                        normalizeDisplayValues: true,
                        normalizePositions: true,
                        normalizeRepeatStyle: true,
                        normalizeString: true,
                        normalizeTimingFunctions: true,
                        normalizeUnicode: true,
                        normalizeUrl: true,
                        normalizeWhitespace: true,
                        orderedValues: true,
                        rawCache: true,
                        reduceIdents: true,
                        reduceInitial: true,
                        reduceTransforms: true,
                        uniqueSelectors: true,
                        svgo: false,
                        zindex: false,
                    }],
                })
            ]
        },
        cwd: 'tmp/',
        src: '*.css',
        dest: '../assets/out/src/css/',
        expand: true,
        ext: '.min.css'
    },

    critical_minified: {
        options: {
            processors: [
                require('cssnano')({
                    preset: ['advanced', {
                        autoprefixer: true,
                        cssDeclarationSorter: true,
                        convertValues: true,
                        calc: true,
                        colormin: true,
                        discardComments: true,
                        discardDuplicates: true,
                        discardEmpty: true,
                        discardOverridden: true,
                        discardUnused: false,
                        mergeIdents: true,
                        mergeLonghand: true,
                        mergeRules: true,
                        minifyFontValues: true,
                        minifyGradients: true,
                        minifyParams: true,
                        minifySelectors: true,
                        normalizeCharset: true,
                        normalizeDisplayValues: true,
                        normalizePositions: true,
                        normalizeRepeatStyle: true,
                        normalizeString: true,
                        normalizeTimingFunctions: true,
                        normalizeUnicode: true,
                        normalizeUrl: true,
                        normalizeWhitespace: true,
                        orderedValues: true,
                        rawCache: true,
                        reduceIdents: true,
                        reduceInitial: true,
                        reduceTransforms: true,
                        uniqueSelectors: true,
                        svgo: false,
                        zindex: false,
                    }],
                })
            ]
        },
        cwd: '../assets/out/src/css/abovethefold/',
        src: '*.css',
        dest: '../assets/out/src/css/abovethefold/',
        expand: true,
        ext: '.min.css'
    }
};

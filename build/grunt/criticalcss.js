/* jshint esversion: 9 */
/* global module */

module.exports = {
    options: {
        width: 1200,
        height: 900,
        ignoreConsole: true
    },
    apex_category: {
        options: {
            outputfile: '../assets/out/src/css/abovethefold/d3extsearch_apex_alist.css',
            filename: '../assets/out/src/css/d3extsearch_apex.css',
            url: 'http://oxideshop-ee.local/html/oxideshop-ee/source/Kiteboarding/Kites/' // a typical category url from your shop installation with filters
        }
    },
    apex_search: {
        options: {
            outputfile: '../assets/out/src/css/abovethefold/d3extsearch_apex_search.css',
            filename: '../assets/out/src/css/d3extsearch_apex.css',
            url: 'http://oxideshop-ee.local/html/oxideshop-ee/source/index.php?cl=search&searchparam=kite' // a typical search url from your shop installation with filters
        }
    },
    wave_category: {
        options: {
            outputfile: '../assets/out/src/css/abovethefold/d3extsearch_wave_alist.css',
            filename: '../assets/out/src/css/d3extsearch_wave.css',
            url: 'http://oxideshop-ee.local/html/oxideshop-ee/source/Kiteboarding/Kites/' // a typical category url from your shop installation with filters
        }
    },
    wave_search: {
        options: {
            outputfile: '../assets/out/src/css/abovethefold/d3extsearch_wave_search.css',
            filename: '../assets/out/src/css/d3extsearch_wave.css',
            url: 'http://oxideshop-ee.local/html/oxideshop-ee/source/index.php?cl=search&searchparam=kite' // a typical search url from your shop installation with filters
        }
    }
};
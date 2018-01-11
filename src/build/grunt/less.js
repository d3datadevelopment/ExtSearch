module.exports = {

    options: {
        yuicompress: true,
        optimization: 2,
        plugins: [
            new (require('less-plugin-autoprefix'))({
                browsers: [
                    "last 10 versions", 
                    "> 0.2%",
                    "> 0.1% in DE"
                ]
            })
        ]
    },

    module: {
        options: {
            sourceMap: false,
            sourceMapFileInline: false,
            compress: true
        },
        files: {
            "../out/src/css/d3extsearch_allthemes.min.css": "sources/less/styles_allthemes.less",
            "../out/src/css/d3extsearch_flow.min.css": "sources/less/styles_flow.less",
            "../out/src/css/d3extsearch_azure.min.css": "sources/less/styles_azure.less",
            "../out/src/css/d3extsearch_mobile.min.css": "sources/less/styles_mobile.less",
            "../out/src/css/d3extsearch_slider.min.css": "sources/less/styles_slider.less"
        }
    },
    
    module_sourcemap: {
        options: {
            sourceMap: true,
            sourceMapFileInline: true,
            compress: true
        },
        files: {
            "../out/src/css/d3extsearch_allthemes.min.css": "sources/less/styles_allthemes.less",
            "../out/src/css/d3extsearch_flow.min.css": "sources/less/styles_flow.less",
            "../out/src/css/d3extsearch_azure.min.css": "sources/less/styles_azure.less",
            "../out/src/css/d3extsearch_mobile.min.css": "sources/less/styles_mobile.less",
            "../out/src/css/d3extsearch_slider.min.css": "sources/less/styles_slider.less"
        }
    },
    
    module_unminified: {
        options: {
            sourceMap: false,
            sourceMapFileInline: false,
            compress: false
        },
        files: {
            "../out/src/css/d3extsearch_allthemes.css": "sources/less/styles_allthemes.less"
        }
    }

};

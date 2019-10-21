module.exports = {

    module_sourcemap: {
        options: {
            sourceMap: true,
            sourceMapFileInline: true,
            compress: false
        },
        files: {
            "tmp/d3extsearch_flow.css": "sources/less/styles_flow.less",
            "tmp/d3extsearch_azure.css": "sources/less/styles_azure.less",
            "tmp/d3extsearch_mobile.css": "sources/less/styles_mobile.less"
        }
    },
    
    module: {
        options: {
            sourceMap: false,
            sourceMapFileInline: false,
            compress: false
        },
        files: {
            "tmp/d3extsearch_flow.css": "sources/less/styles_flow.less",
            "tmp/d3extsearch_azure.css": "sources/less/styles_azure.less",
            "tmp/d3extsearch_mobile.css": "sources/less/styles_mobile.less"
        }
    }
};

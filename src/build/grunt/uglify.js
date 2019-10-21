module.exports = {

    options: {
        banner: '/**\n' +
            ' * This Software is the property of Data Development and is protected\n' +
            ' * by copyright law - it is NOT Freeware.\n' +
            ' * Any unauthorized use of this software without a valid license\n' +
            ' * is a violation of the license agreement and will be prosecuted by\n' +
            ' * civil and criminal law.\n' +
            ' * http://www.shopmodule.com\n' +
            ' *\n' +
            ' * @license\n' +
            ' * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)\n' +
            ' * @author    D3 Data Development - Daniel Seifert <support@shopmodule.com>\n' +
            ' * @link      http://www.oxidmodule.com\n' +
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
                cwd:    "sources/js/",
                dest:   "../out/src/js/",
                ext:    ".min.js",
                extDot: "last"
            }
        ]
    }
};

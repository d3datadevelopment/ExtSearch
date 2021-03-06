module.exports = {

    options: {
        "asi"      : true,
        "expr"     : true,
        "jquery"   : true,
        "laxbreak" : true,
        "nonbsp"   : true,
        "strict"   : true,
        "curly": true,
        "latedef": true,
        "undef": true,
        "unused": true,
        "eqeqeq": true,
        "eqnull": true,
        "browser": true,
        "esversion": 6,
        "evil": true,
        globals: {
            "jQuery": true,
            "console": true,
            "$": true,
            "d3_extsearch_popup": true
        }
    },
    module: {
        src: [
            "origin/js/*.js"
        ]
    }

};

module.exports = function(grunt) {

    // measures the time each task takes
    require('time-grunt')(grunt);

    let path = require('path');
    
    // load grunt config
    require('load-grunt-config')(grunt, {
        configPath: path.join(process.cwd(), 'grunt')
    });

};

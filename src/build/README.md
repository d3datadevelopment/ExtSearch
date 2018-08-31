# rebuild assets

All module related CSS/JavaScript files can be found in ``build`` directory. To 
regenerate the modules assets, the ``grunt`` tasks should be used. Please 
install ``grunt`` and run ``grunt's`` default task to regenerate all minimized 
``css`` and ``js`` files:

1. To use ``grunt``, ``npm`` is required. Check ``nodejs`` website for 
installation instructions (https://nodejs.org/en/download/package-manager/). 
After this, install ``grunt`` globally. 

2. Go to "build" directory and install all related ``grunt`` plugins:

	```
    npm install
    ```

3. The module-specific LESS files use the LESS variables of the shop. If you 
have customized these, you may need to recreate the module assets. Please note, 
that CSS and JavaScript files were overwritten by module updates. Then run the 
generation again or better store your customizations in own files.

3. configure "above the fold" stylesheets:

    If you use critical "above the fold" stylesheets, enable the penthouse and 
    cssmin tasks in ``build/grunt/aliases.yml`` to generate special stylesheet 
    files. Customize the Penthouse Plugin configuration to your needs in 
    ``build/grunt/penthouse.js``. Penthouse needs a working shop installation 
    with the latest stylesheets to run.
    
    If the generated above-the-fold style sheets contains formattings, they are 
    automatically included in the shop source.

4. Now its possible to regenerate module assets by running ``grunt`` default
task while being in "build" directory:

	```
	grunt
	```
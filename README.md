# Patches

## [apex_7.0.patch](./apex_7.0.patch)

This changes are required in Apex theme in 7.0.x.

### Behaviours:
- add missing template block
- align search HTML to article list pages
- removed unnecessary loop in search template

### Installation instructions:
- add patches package:
  - ```php composer require cweagans/composer-patches```
- enable patching:
  - ```php composer config extra.enable-patching true```
- add patch to registry:
  - ```php composer config --json --merge extra.patches.oxid-esales/apex-theme '{"apply theme changes for extsearch":"https://raw.githubusercontent.com/d3datadevelopment/ExtSearch/patches/apex_7.0.patch"}'```
- remove installed Apex package: 
  - ```rm -r vendor/oxid-esales/apex-theme```
- reinstall it and apply patch: 
  - ```php composer install --no-dev```
  - confirm overwriting the Apex package files
- clear all caches like tmp folder
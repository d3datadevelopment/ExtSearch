[![deutsche Version](https://logos.oxidmodule.com/de2_xs.svg)](README.md)
[![english version](https://logos.oxidmodule.com/en2_xs.svg)](README.en.md)

# Patches

## [apex_7.0.patch](./apex_7.0.patch)

Diese Änderungen sind im Apex Theme in Version 7.0.x benötigt.

### Verhalten:
- ergänzt fehlenden Template Block
- passt die HTML Stuktur der Suchseite an die der Artikellistenseiten an
- entfernt unnötige Schleife im Template

### Installationsanweisungen:
- Patch Paket hinzufügen:
  - ```php composer require cweagans/composer-patches```
- Patchverwendung aktivieren:
  - ```php composer config extra.enable-patching true```
- Patch registrieren:
  - ```php composer config --json --merge extra.patches.oxid-esales/apex-theme '{"apply theme changes for extsearch":"https://raw.githubusercontent.com/d3datadevelopment/ExtSearch/patches/apex_7.0.patch"}'```
- installiertes Apex Theme entfernen: 
  - ```rm -r vendor/oxid-esales/apex-theme```
- Theme neu installieren und Patch anwenden: 
  - ```php composer install --no-dev```
  - ```php composer update --lock --no-dev```
  - confirm overwriting the Apex package files
- leere alle Caches (z.B. den TMP-Ordner)
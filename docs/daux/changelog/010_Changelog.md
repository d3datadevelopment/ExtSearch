---
title: Changelog
---

## 6.6.1.2 (2021-03-03)
### Fixed
- Queryfehler durch unzugeordnetes oxtimestamp-Feld korrigiert
- fehlerhaften Tabellennamengenerierung bei Abfrage in Nicht-Standardsprache korrigiert 
- zu große Artikelanzahl bei mit ähnlichen Artikeln aufgefüllte Trefferliste korrigiert

### Changed
- phonetischer Hash wird ausschließlich in der Datenbank generiert, um Differenzen zwischen PHP- und mySQL-Verhalten zu vermeiden (führte zu ungültigen Updateanforderungen)
- Phonetischer Index wird nicht generiert, wenn kein Generator eingestellt ist
- Bevorzugen der Filtermehrfachauswahl, wenn auch Einfachauswahl gesetzt ist (verhindert ungültige Wertkombinationen)
- Admin-Icon verwendet feste Breite

---

## 6.6.1.1 (2020-12-09)
### Fixed
- fehlerhaften Tabellennamengenerierung bei Abfrage in Nicht-Standardsprache korrigiert 

---

## 6.6.1.0 (2020-12-03)
### Added
- installierbar in OXID 6.2.3

### Changed
- fehlende Übersetzungsbausteine in Sprache Englisch nachgetragen

### Fixed
- Indexgenerierung läuft in manchen Fällen in eine Endlosschleife
- fehlerhaften Feldnamen bei Datenbankabfrage in Phonetic Light korrigiert
- Testlauf verwendet keinen Debugmode

---

## 6.6.0.1 (2020-11-09)
### Changed
- unnötige Redirect-Prävention im Falle eines Einzeltreffers beim Debug-Modus entfernt

### Fixed
- ungültige Tabellenname/Feldname-Kombination in SQL Query korrigiert

---

## 6.6.0.0 (2020-11-06)
### Added
- Wartungsaufgaben über CLI aufrufbar
- Cronjobaufruf generiert fehlende oxartextends-Einträge selbst
- CLI komplett übersetzt und übersetzbar
- Status der Indexgenerierung wird aus Inhalten anstelle des letzten Generierungsdatums ermittelt
- Metadaten mehrsprachig verfügbar

### Fixed
- Theme-Weichen für passende Produktdarstellung im Wave-Theme korrigiert

---

## 6.5.2.2 (2020-09-29)
### Changed
- Suggest: Submit bei markiertem Eintrag sendet Formular ab, anstatt den Eintrag zu zeigen
- JavaScripts verwenden Strict Mode
### Fixed
- optimiertes Decoding verhindert SQL Injections

---

## 6.5.2.1 (2020-08-20)
### Fixed
- fehlerhaften BaseConfKey getauscht

---

## 6.5.2.0 (2020-07-20)
### Changed
- unnötige Maskierung des Suchbegriffes entfernt
  - führte bei Verwendung von Sonderzeichen zu fehlerhaften Ergebnissen 
- Build-Komponenten aktualisiert 
  - vermeidet Verwendung unsicherer Pakete
- Benennung des Source-Verzeichnisses wird automatisch ermittelt
  - so kann dieses Verzeichnis auch anders benannt oder an anderer Stelle abgelegt sein
- kleine Layoutanpassungen im Flow- und Wavetheme
- Dokumentation aktualisiert
### Fixed
- fehlende Datenbankfelder in Abfrage ergänzt
  - führte in Verwendung der Indexbuchstaben in bestimmter Konstellation zu Fehlern bei der Abfrage
- bei entsprechender Einstellung werden leere Kategorien nicht in Filtern gezeigt

---

## 6.5.1.0 (2020-05-04)
### Added
- Artikellisten (Kategorien, Hersteller, Lieferanten) können ebenfalls Varianten zeigen und zur Filterung verwenden
### Fixed
- ungültige Filterkombinationen zeigen in Artikellisten entsprechende Hinweise und ermöglichen ein Zurücksetzen der gesetzten Filter

---

## 6.5.0.0 (2020-03-31)
### Added
- Kompatibilität zu OXID 6.2 hergestellt
- strukturierte Daten für Suchaktion eingefügt
- erzeuge JS-Fehler, wenn kein Eingabeelement für Suggest gefunden wird
- Build-Umgebung aktualisiert
- Ergebnis-Feld-Analyse in Dokumentation aufgenommen
### Changed
- verhindere wählbarer Attributfilter von Variantenartikeln in Kategorieansicht
- ändere JS Event-Eigenschaft
### Fixed
- Datenbankabfragen für abgewählte Attributsfilter korrigiert
- doppelt selektrierte Felder in Datenbankabfrage korrigiert

---

## 6.4.0.0 (2019-10-21)
### Added
- Support für OXID Wave Theme
- Critical CSS (above the fold) eingefügt (erfordert Generierung im finalen Shop durch Grunt)
### Changed
- Query-Manipulation für die Fälle angepasst, in denen weitere count(*) aus anderen Tabellen außer oxarticles abgefragt werden
- Grunt-Module aktualisiert
- CSS-Optimierung auf PostCSS und NanoCSS umgestellt
- Anordnung der Produktboxen im MD-Viewport des Flow-Themes optimiert
- JavaScript-Dateien erhalten Lizenz-Header
- Slider-CSS in Theme-CSS integriert, spart Requests beim Seitenaufbau
- Generierung des Critical CSS (above the fold) auf criticalcss Plugin umgestellt
### Fixed
- fehlerhaft verwendete HTML-Element-IDs in Klassen korrigert

---

## 6.3.1.0 (2019-09-24)
### Changed
- gefilterte Seiten werden nicht im Dynamic Content Cache aufgenommen
- Debug-Ausgaben von der Browser-Ausgabe zur Browser-Konsole verschoben
- Suggest (Schnellsuche) verwendet ArticleList-Objekt statt natives Array
### Fixed
- setze passende Leerwerte, wenn jeweiliger Filter nicht aktiviert ist, vermeidet warning-Meldungen im Log

---

## 6.3.0.0 (2019-07-22)
### Added
- korrespondierende Attributwerte implementiert
### Changed
- Response-Script ermittelt Pfad der Bootstrap-Datei dynamisch
- Abfrage-Veränderungen für Aggrosoft WaWi-Modul-Anpassungen optimiert
- Unit-Tests angepasst
### Fixed
- fehlende Datei im Dateiregister nachgetragen

---

## 6.2.1.1 (2019-06-04)
### Added
- Dokumentation um Erklärung zur Cache-Verhinderung ergänzt
- Offset-Option für Suggest-Fenster integriert
### Changed
- feste Position des Suggest-Fensters im Azure-Theme geändert
### Fixed
- fehlende Styles für Azure-Theme nachgetragen
- fehlende Netto-/Bruttopreisumrechnung in Artikellisten korrigiert

---
## 6.2.1.0 (2019-04-25)
### Added
- Suggest-Suche verhindert die Anzeige veralteter Anfrageergebnisse

---
## 6.2.0.1 (2019-03-21)
### Added
- Build-Ressourcen als `export-ignore` markiert, können bei Bedarf mit `--prefer-source` nachgeladen werden
### Changed
- Dokumentation bereinigt
- Einstellungen für Variantensuche wird auch in Artikelnummernsuche berücksichtigt
- semantische Begriffe werden mit Platzhaltern gesucht - Synonymbestandteile wurden nicht gefunden
### Fixed
- Formularparameter werden encoded
- unnötiges UTF8-Decoding entfernt - verhinderte Schnelltreffer mit Sonderzeichen
- phonetischer Index wird schon bei Neuanlage der Artikel generiert
- Notices auf Grund "undefinierten Index" behoben

---
## 6.2.0.0 (2018-12-14)
### Added
- individuelle Zuordnung der Filterattribute zu Kategorien ermöglicht
- Kategoriefilter verwendet nur den Artikeln zugeordnete Hauptkategorien
- Optionen werden im Admin ausgeblendet, wenn Feature deaktiviert ist
- Tests hinzugefügt
### Changed
- Korrektur für Verwendung von hochpräzisen Preisangaben (vielfache Nachkommastellen) integriert
- Preisslider verwendet Formatierung der aktuell gewählten Währung
### Fixed
- unvollständige Feldliste in Abfragen der RSS-Seiten ergänzt

---
## 6.1.3.0 (2018-11-12)
### Added
- zusätzliche Formatieroptionen zur Suggest-Suche hinzugefügt
- Suggest-Suche wird nur im MD- und LG-Viewport gezeigt
- prepared statements integriert
- Preisslider erhält zufällige ID für mögliche Mehrfachimplementierung
- Relevanzberechnung berücksichtigt auch Synonyme
- Synonyme werden auch zur Ermittlung von Herstellern und Lieferanten verwendet
### Changed
- Analyse-Tool verwendet Klartext-Bezeichnung für Wertespalten
- Preisslider für Brutto/Nettopreise optimiert
- verwende oxescape für zeichensatzabhängiges Maskieren
- Modul verwendet ausschließlich Loglevel-Konstanten
- Dokumentation zum HTML-Format geändert
- Adminhilfetexte aus Dokumentation in den Adminbereich verschoben
### Fixed
- Exception in Analysetool bei inaktivem Modul vermieden
- Datenbankstruktur korrigiert, um Artikel kopieren zu ermöglichen
- Sidebar wird nur hinzugefügt, wenn Modul aktiv ist
- Query-Generierung bei Verwendung des oxtimestamp-Feldes als Sortierkriterium angepasst
- Klartext-Klassennamen zu Namespaces konvertiert
- Anforderungsdefinition angepasst
- doppelte TPL-Blocknamen aufgelöst

---
## 6.1.2.0 (2018-08-30)
### Added
- installierbar in OXID Compilation 6.1
- critical CSS (above the fold) - Generierung und Implementierung
- Anzeigeformat der Filter ist einstellbar
### Changed
- erweitert nur existierende Klassen
### Fixed
- #7384: Bug: Anzeige aller Attribute des Shops als Filter in Artikelliste
- #7471: falsche Preisspannen im Slider bei Eingabe von Nettopreisen
- Mehrfachauswahl der Filter war nur mit Attributfilteroption nutzbar

---
## 6.1.1.0 (2018-02-20)
### Added
- installierbar in OXID eShop 6.1
- Query-Cache-Prüfung integriert
### Changed
- Syntaxgenerierung der Datenbank-Queries optimiert
### Fixed
- auf leeren Artikellistenseiten werden Filter nicht generiert
- Datenbank-Abfragen für CMS-Texte korrigiert

---
## 6.1.0.0 (2017-12-15)
### Added
- Installation via Composer
- Neueinträge bei Synonymen verwenden die Admin-Anmeldesprache

---
## [6.0.0.0] (2017-11-24)
### Added
- Synonym-Wortgruppen werden auch bei Einzelwortsuche gefunden und als Einzelworte in die Suchparameter eingefügt
- Weiterleitungen sind für jeden Datentyp einzeln einstellbar
- Filter werden (sofern verfügbar) in der Sidebar angezeigt (flow-Theme)
- CSS-Generierung auf Less umgestellt, ermöglicht Erstellung individueller CSS-Dateien
### Changed
- Umarbeitung für OXID 6
- Layout der Suggest-Suche angepasst

---
## [5.6.4.2] (2017-10-20)
- Fehler beim Auftrennen kombinierter Suchbegriffe bei der Verwendung der "Ähnlichkeitssuche für Kurzworte" und Multibyte-Zeichen korrigiert
- leere Hersteller- und Lieferantenlisten korrigiert (#6617)
- fehlerhafte Artikellisten bei Artikellistenergänzung korrigiert (#6812)

---
## 5.6.4.1 (2017-07-25) 
- fehlende Sortierung der Suchergebnisse korrigiert

---
## 5.6.4.0 (2017-07-10)
- sinngleiche Suche wird auch bei Suche in Kategorienamen verwendet
- Synonym-Wortgruppen werden auch bei Einzelwortsuche gefunden und als Einzelworte in die Suchparameter eingefügt
- zusätzliche Templateblöcke für Filter integriert
- fehlende Template-Parameter ergänzt
- Preisschiebegregler für Nettopreise angepasst
- Attributfilterbereinigung optimiert
- Preisstepberechnung korigiert
- Mehrfachfilter werden in Artikellisten
- Bugfix: gewählte Mehrfachfilter werden in Artikellisten-Seiten zurückgegeben

---
## [5.6.3.0] (2017-03-14)
- isextsearch-Parameter wird nur bei verwendeter Filterung gesetzt
- mehrfache Kategoriefilter auch in Suchergebnissen verfügbar
- Support für Content-Einstellungen im Visual CMS-Modul (Version 1.0.0) (#6103)
- fehlenden Kategoriefilter in Artikellistenfilter nachgetragen
- Testlizenzen enthalten Artikellistenfilter
- kleine Fehler in der Query-Generierung korrigiert
- Exception bei deaktiviertem Modul korrigiert

---
## [5.6.2.1] (2016-10-21)
- Locator auf der Detailansicht korrigiert, wenn Artikel aus direkter Anzeige einer 1-Treffer-Liste stammt (#5554)
- korrigiert: Mehrfachfilter wurden ausgeblendet, wenn Auswahl nur 1 Treffer enthielt (#5552)
- modulspezifische Theme-Mapping-Variablen eingefügt

---
## 5.6.2.0 (2016-10-10)
- verwendet Theme-Mapping
- Schnellsuche-Anfragen werden ebenfalls ins Log geschrieben
- .htaccess-Beschränkungen für Apache 2.4 angepasst
- gemeinsame Erweiterung der *list-Klassen aufgelöst
- Funktionsaufrufe für Ajax-Calls geändert
- als "deprecated" gekennzeichnete Methodenaufrufe ersetzt
- Scripts für passende Darstellung des Adminmenütitels im Browser angepasst 
- fehlende Template-Erweiterungen für "Flow" nachgetragen
- fehlende Componenten-Klasse in oxwarticledetails-Widget ergänzt
- falschen Formularparameter korrigiert
- Bugfix für fehlerhafte Datenbankabfrage bei aktivierter Variantensuche
- undokumentierte Parameter im Handbuch nachgetragen

---
## [5.6.1.0] (2016-08-10)
- Kompatibilität mit OXID-eShop Version 4.10.x / 5.3.x hergestellt
- Template-Anpassungen für "Flow" eingefügt

---
## 5.6.0.1 (2017-07-10)

---
## [5.6.0.0] (2016-06-27)
- Marken- und Lieferantenfilter sind nun mehrfach wählbar

---
## [5.5.4.0] (2016-03-14)
- Filter für Preiskategorien eingefügt
- Artikellisten verwenden Sortierung der Zuordnungstabellen
- Artikelposition innerhalb der Detailseiten-Listennavigation angepasst
- Installation korrigiert

---
## [5.5.3.1] (2016-02-17)
- Bugfix für fehlerhafte Datenbankabfrage bei Suche ohne definierte Sortierung

---
## [5.5.3.0] (2016-02-16)
- alternative Sortierung bei identischen Relevanzwerten einstellbar
- versteckte Kategorien werden in Attributfilter berücksichtigt
- Attributfilter speichert Auswahl sprachabhängig
- Direktsuche mit leerem Suchparameter korrigiert
- Suggestsuche bei aktiviertem EE-Backend-Cache korrigiert

---
## [5.5.2.0] (2016-01-21)
- semantische Datenbank bereinigt
- semantische Suche verwendet gewählte Sprache zur Auswahl der Alternativbegriffe
- Datenbankabfragen optimiert
- modulspezifische Logging-Auswertung eingefügt
- statistische Auswertungen (ohne grafische Auswertung)auch für EE-Installationen verfügbar gemacht
- Handbuch überarbeitet
- Relevanz-Abfrage wird bei leerer Suchabfrage nicht erstellt
- 4.7 / 5.0-Templates entfernt
- 4.9 / 5.2-Templates eingefügt
- vermeide Überladung der Listennavigation bei deaktiviertem aList-Filter
- fehlende PageId in Response-Klasse nachgetragen
- fehlende Template-Blocks nachgetragen
- Hilfelinks korrigiert
- fehlerhafte BreadCrumb auf Artikeldetailseite bei Verwendung des aListFilters korrigiert
- selektive Funktion des Preisschiebereglers in Markenlisten korrigiert
- überlaufender Preisschieberegler bei identischer Selektion korrigiert
- leere Artikellisten bei 0-bis-0-Euro Preisselektion korrigiert
- unvollständige Listennavigation korrigiert

---
## [5.5.1.1] (2015-12-21)
- RSS-Feed-Controller auf neue Filter angepasst
- vermeidet Warnungen bei unvollständig übergebenen Formularen

---
## [5.5.1.0] (2015-12-14)
- Preisschieberegler verwendet als Auswahl nur den Preisbereich gefundener Artikel
- Preisschieberegler behält initialen Preisbereich für Deselektion auch bei weiterer Einschränkung bei
- Preisfilter verwendet bei Varianten nicht deren 0-Euro-Preis, sondern den Preis der Elternartikel
- Semantic-Tabellen werden in automatischer Installation angelegt -> Semantic auch ohne Lexikon nutzbar
- Synonym-Editor legt Neueinträge passend an
- semantische Begriffe werden optimaler gruppiert
- fehlende JavaScript-Variable bei Nichtanzeige des Preisschiebereglers korrigiert
- Fehlervermeidung bei inaktivem Modul
- Navigationsparamter korrigiert
- Groß-/Kleinschreibung in Synonym-Tabellen korrigiert
- Relevanz-Analyse-Popup ist vergrößerbar 

---
## 5.5.0.1 (2015-09-01)
- optimierte Zeichensatzbehandlung innerhalb der Suggestsuche
- Artikellistenfilterung verwendet Schnellsortierung der Kategorien
- optionale Parameter der Suggest-Suchlinks deaktivierbar (config-Parameter)
- Fehler bei Extraktion der Log-Parameter in Statistik korrigiert
- vermeidet Warnungen bei unvollständig übergebenen Formularen

---
## [5.5.0.0] (2015-08-27)
- Filter können in Kategorie-, Hersteller- und Markenansicht genutzt werden
- bei Attributen können mehrere Filterwerte gewählt werden
- Filter-Löschen-Option eingefügt
- selektierte Attributsfilter werden intern gespeichert, keine Parameterübergabe nötig
- Erweiterbarkeit verbessert (TPL-Block, CSS)
- Mobile-Support auch für Shopversion 4.7 / 5.0

---
## [5.4.0.3] (2015-08-27)
- unvollständig zusammengeführte Templates ergänzt

---
## [5.4.0.2] (2015-08-05)
- fehlende Navigationsparameter für Startseite nachgetragen
- Sortierrichtung für Hersteller- und Lieferantenfilter korrigiert
- Inhaltssuche wird nur mit gesetztem Suchparameter ausgeführt
- ModCfg-Prüf-Blöcke korrigiert
- Datenbankabfrage für attributgefilterte Variantenliste korrigiert
- fehlendes getSortId() für ältere Shopversionen nachgetragen

---
## [5.4.0.1] (2015-07-14)
- Groß-/Kleinschreibung der Felder der semantischen Datenbank korrigiert

---
## [5.4.0.0] (2015-02-04)
- Kategorien können von Verwendung in Suche ausgeschlossen werden
- zusätzlicher Phonetic-Generator für besseres Handling mit Vokalen integriert
- phonetischer Index optimiert
- JavaScript-Code auf bessere Kompatibilität angepasst
- Template der Schnellsuche ist über Template-Block erweiterbar
- kleine Fehler in Abfrage-Generierung behoben

---
## 5.3.0.0
- Unterstützung für OXID Mobile Theme hinzugefügt
- Querygenerierung in Statistikanzeige korrigiert
- Kompatibilität für eShop 4.7.0 + 4.7.1 erweitert

---
## 5.2.1.0
- Attributsortierung in Filtern ermöglicht
- Indexgenerierung prüft vorab auf konsistente oxarticle-oxartextends-Daten
- Hauptsynonyme sind nun auch löschbar
- "Einfügungen und Auslassungen erlauben" auch bei kurzen Suchbegriffen ermöglicht
- explizite Prüfung auf inaktiven Vaterartikel integriert
- kleinere Textkorrekturen und Logikfehler beseitigt

---
## 5.2.0.2
- korrigiert: Abfragegenerierung ohne vorgegebene Artikelsortierung
- korrigiert: inaktives Modul erzeugt Fehler bzgl. mangelnder Ressourcen

---
## 5.2.0.1
- Precheck aktualisiert
- für 4.7.0 + 4.7.1: fehlende getSortIdent-Methode eingefügt
- fehlende Tabellendefinition in Query nachgetragen

---
## 5.2.0.0
- Wortrelevanz wird in Relevanzermittlung zusätzlich berücksichtigt
- Ähnlichkeitssuche berücksichtigt Mehrzahlformen auch bei kurzen Suchworten 

---
## 5.1.1.1
- fehlerhafte Datenbankabfrage bei Kombination von "Variantensuche" und Feldern in "oxartextends" korrigiert

---
## 5.1.1.0
- optionales Popup während des Suchvorgangs eingefügt
- DirectShow verwendet nur suchbare Artikel
- Kompatibilität zu OXID eShop 4.8 / 5.0 hergestellt

---
## 5.1.0.2
- Datenbankabfragen korrigiert

---
## 5.1.0.1
- Phonetic-Generator tickerte falsch
- Semantic-Editor war aufgrund undefinierter Sortierung nicht aufrufbar
- fehlendes Template korrigiert
- Attributsortierung geändert

---
## 5.1.0.0
- Attribute können mehrfach gefiltert werden
- nicht zu Attributen zugeordnete Artikel können gefiltert werden
- Templates wurden für einfachere Erweiterung mit Blöcken ausgerüstet
- kleinere Bugfixes

---
## 5.0.0.1
- Query für Attributlisten korrigiert
- Smarty-Variable in Schnellsuche ergänzt
- nicht ausführbarer Debug-Modus unter mySQL 5.5 korrigiert

---
## 5.0.0.0
- Performanceoptimierung bei großen Suchergebnislisten
- Optimierung auf Cluster
- Statistikauswertungen erweitert
- Suchsyntax optimiert

---
## 4.0.2.0
- eigene Suchformularfelder suchen nun auch in Bereich (von / bis-Suche)
- kleiner Fehler bei der Verarbeitung der eigenen Suchformularfelder beseitigt

---
## 4.0.1.1
- OXID-Bug in Artikelsortierung behoben

---
## 4.0.1.0
- automatische Installation korrigiert
- Suchparameter bei Direktanzeige korrigiert
- zusätzliche Modul-Aktiv-Prüfungen integriert
- Treffer in Suggest-List zeigt auf Shopmandant
- "einfügen/auslassen"-Abfrage korrigiert
- Erweiterbarkeit verbessert
- Similar-Light-Suche korrigiert
- Ergebnis-Feld-Analyse eingefügt
- fehlerhafte Suchbegriff-Verknüpfung korrigiert
- fehlerhafte Hersteller-Relevanz korrigiert

---
## 4.0.0.1
- Korrektur auf neue SQL-Query-Syntax

---
## 4.0.0.0
- Umsetzung in neuer Dateistruktur des OXID 4.7 (PE) / 5.0 (EE)

---
## 3.12.1
- geänderte Logik für OXID 4.6.4: Navigationslinks der Suchergebnisseite enthielten unzureichende Parameter

---
## 3.12.0
- bei gruppierten Variantenartikeln wird Kategoriefilter vom Vaterartikel generiert
- bei gruppierten Variantenartikeln wird Preisfilter von ungruppierten Varianten generiert, 
  Anzahl wird auf Grund differierender Treffermengen am Filter ausgeblendet
- Eingabe des Markennamens im Suchfeld findet Markenartikel (analog Kategorienamen, auch für Lieferanten)
- Schnellsuche findet auch Contents, Marken, Lieferanten und Kategorien
- Artikel der Schnellsuche sind nach Relevanz sortiert
- Direktsuche findet auch Marken und Lieferanten
- Fehler in Ermittlung der phonetischen Länge des Suchbegriffs gefixt
- alte DB-Feldbezeichnungen im Semantic-Editor verhindert Speicherung -> behoben
- Existenzprüfung "getSortingSql" integriert
- getDb()-Syntax-Änderungen aus 4.6.0 eingefügt
- Semantic prüft auch auf leeres Term-Level (nicht nur NULL)
- Templates bis Shopversion 4.6.X

[6.0.0.0]: https://blog.oxidmodule.com/archives/676-Neues-Upgrade-fuer-Modul-Erweiterte-Suche-auf-Version-6.0.0.0.html
[5.6.4.2]: https://blog.oxidmodule.com/archives/665-Neuer-Patch-fuer-Modul-Erweiterte-Suche-auf-Version-5.6.4.2.html
[5.6.3.0]: https://blog.oxidmodule.com/archives/644-Neues-Update-fuer-Modul-Erweiterte-Suche-auf-Version-5.6.3.0.html
[5.6.2.1]: https://blog.oxidmodule.com/archives/630-Neue-Version-fuer-Modul-Erweiterte-Suche-5.6.2.1.html
[5.6.1.0]: https://blog.oxidmodule.com/archives/614-Neues-Update-fuer-Modul-Erweiterte-Suche-auf-Version-5.6.1.0.html
[5.6.0.0]: https://blog.oxidmodule.com/archives/605-Neues-Update-fuer-Modul-Erweiterte-Suche-auf-Version-5.6.0.0.html
[5.5.4.0]: https://blog.oxidmodule.com/archives/588-Neues-Update-fuer-Modul-Erweiterte-Suche-auf-Version-5.5.4.0.html
[5.5.3.1]: https://blog.oxidmodule.com/archives/578-Neuer-Patch-fuer-Modul-Erweiterte-Suche-auf-Version-5.5.3.1.html
[5.5.3.0]: https://blog.oxidmodule.com/archives/577-Neues-Update-fuer-Modul-Erweiterte-Suche-auf-Version-5.5.3.0.html
[5.5.2.0]: https://blog.oxidmodule.com/archives/571-Neues-Update-fuer-Modul-Erweiterte-Suche-auf-Version-5.5.2.0.html
[5.5.1.1]: https://blog.oxidmodule.com/archives/565-Neuer-Patch-fuer-Modul-Erweiterte-Suche-auf-Version-5.5.1.1.html
[5.5.1.0]: https://blog.oxidmodule.com/archives/563-Neues-Update-fuer-Modul-Erweiterte-Suche-auf-Version-5.5.1.0.html
[5.5.0.0]: https://blog.oxidmodule.com/archives/537-Neue-Versionen-5.5.0.0-und-5.5.0.1-fuer-Modul-Erweiterte-Suche.html
[5.4.0.3]: https://blog.oxidmodule.com/archives/536-Neuer-Patch-fuer-Modul-Erweiterte-Suche-auf-Version-5.4.0.3.html
[5.4.0.2]: https://blog.oxidmodule.com/archives/534-Neuer-Patch-fuer-Modul-Erweiterte-Suche-auf-Version-5.4.0.2.html
[5.4.0.1]: https://blog.oxidmodule.com/archives/524-Neuer-Patch-fuer-Modul-Erweiterte-Suche-auf-Version-5.4.0.1.html
[5.4.0.0]: https://blog.oxidmodule.com/archives/499-Neues-Update-fuer-Modul-Erweiterte-Suche-auf-Version-5.4.0.0.html

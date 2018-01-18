# Changelog
All notable changes to this project will be documented in this file.

## Unreleased

## 6.1.0.0 (2017-12-15)
### Added
- Installation via Composer
- Neueinträge bei Synonymen verwenden die Admin-Anmeldesprache

## [6.0.0.0] (2017-11-24)
### Added
- Synonym-Wortgruppen werden auch bei Einzelwortsuche gefunden und als Einzelworte in die Suchparameter eingefügt
- Weiterleitungen sind für jeden Datentyp einzeln einstellbar
- Filter werden (sofern verfügbar) in der Sidebar angezeigt (flow-Theme)
- CSS-Generierung auf Less umgestellt, ermöglicht Erstellung individueller CSS-Dateien

### Changed
- Umarbeitung für OXID 6
- Layout der Suggest-Suche angepasst

## [5.6.4.2] (2017-10-20)
- Fehler beim Auftrennen kombinierter Suchbegriffe bei der Verwendung der "Ähnlichkeitssuche für Kurzworte" und Multibyte-Zeichen korrigiert
- leere Hersteller- und Lieferantenlisten korrigiert (#6617)
- fehlerhafte Artikellisten bei Artikellistenergänzung korrigiert (#6812)

## 5.6.4.1 (2017-07-25) 
- fehlende Sortierung der Suchergebnisse korrigiert

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

## [5.6.3.0] (2017-03-14)
- isextsearch-Parameter wird nur bei verwendeter Filterung gesetzt
- mehrfache Kategoriefilter auch in Suchergebnissen verfügbar
- Support für Content-Einstellungen im Visual CMS-Modul (Version 1.0.0) (#6103)
- fehlenden Kategoriefilter in Artikellistenfilter nachgetragen
- Testlizenzen enthalten Artikellistenfilter
- kleine Fehler in der Query-Generierung korrigiert
- Exception bei deaktiviertem Modul korrigiert

## [5.6.2.1] (2016-10-21)
- Locator auf der Detailansicht korrigiert, wenn Artikel aus direkter Anzeige einer 1-Treffer-Liste stammt (#5554)
- korrigiert: Mehrfachfilter wurden ausgeblendet, wenn Auswahl nur 1 Treffer enthielt (#5552)
- modulspezifische Theme-Mapping-Variablen eingefügt

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

## [5.6.1.0] (2016-08-10)
- Kompatibilität mit OXID-eShop Version 4.10.x / 5.3.x hergestellt
- Template-Anpassungen für "Flow" eingefügt

## 5.6.0.1 (2017-07-10)

## [5.6.0.0] (2016-06-27)
- Marken- und Lieferantenfilter sind nun mehrfach wählbar

## [5.5.4.0] (2016-03-14)
- Filter für Preiskategorien eingefügt
- Artikellisten verwenden Sortierung der Zuordnungstabellen
- Artikelposition innerhalb der Detailseiten-Listennavigation angepasst
- Installation korrigiert

## [5.5.3.1] (2016-02-17)
- Bugfix für fehlerhafte Datenbankabfrage bei Suche ohne definierte Sortierung

## [5.5.3.0] (2016-02-16)
- alternative Sortierung bei identischen Relevanzwerten einstellbar
- versteckte Kategorien werden in Attributfilter berücksichtigt
- Attributfilter speichert Auswahl sprachabhängig
- Direktsuche mit leerem Suchparameter korrigiert
- Suggestsuche bei aktiviertem EE-Backend-Cache korrigiert

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

## [5.5.1.1] (2015-12-21)
- RSS-Feed-Controller auf neue Filter angepasst
- vermeidet Warnungen bei unvollständig übergebenen Formularen

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

## 5.5.0.1 (2015-09-01)
- optimierte Zeichensatzbehandlung innerhalb der Suggestsuche
- Artikellistenfilterung verwendet Schnellsortierung der Kategorien
- optionale Parameter der Suggest-Suchlinks deaktivierbar (config-Parameter)
- Fehler bei Extraktion der Log-Parameter in Statistik korrigiert
- vermeidet Warnungen bei unvollständig übergebenen Formularen

## [5.5.0.0] (2015-08-27)
- Filter können in Kategorie-, Hersteller- und Markenansicht genutzt werden
- bei Attributen können mehrere Filterwerte gewählt werden
- Filter-Löschen-Option eingefügt
- selektierte Attributsfilter werden intern gespeichert, keine Parameterübergabe nötig
- Erweiterbarkeit verbessert (TPL-Block, CSS)
- Mobile-Support auch für Shopversion 4.7 / 5.0

## [5.4.0.3] (2015-08-27)
- unvollständig zusammengeführte Templates ergänzt

## [5.4.0.2] (2015-08-05)
- fehlende Navigationsparameter für Startseite nachgetragen
- Sortierrichtung für Hersteller- und Lieferantenfilter korrigiert
- Inhaltssuche wird nur mit gesetztem Suchparameter ausgeführt
- ModCfg-Prüf-Blöcke korrigiert
- Datenbankabfrage für attributgefilterte Variantenliste korrigiert
- fehlendes getSortId() für ältere Shopversionen nachgetragen

## [5.4.0.1] (2015-07-14)
- Groß-/Kleinschreibung der Felder dr semantischen Datenbank korrigiert

## [5.4.0.0] (2015-02-04)
- Kategorien können von Verwendung in Suche ausgeschlossen werden
- zusätzlicher Phonetic-Generator für besseres Handling mit Vokalen integriert
- phonetischer Index optimiert
- JavaScript-Code auf bessere Kompatibilität angepasst
- Template der Schnellsuche ist über Template-Block erweiterbar
- kleine Fehler in Abfrage-Generierung behoben

## 5.3.0.0
- Unterstützung für OXID Mobile Theme hinzugefügt
- Querygenerierung in Statistikanzeige korrigiert
- Kompatibilität für eShop 4.7.0 + 4.7.1 erweitert

## 5.2.1.0
- Attributsortierung in Filtern ermöglicht
- Indexgenerierung prüft vorab auf konsistente oxarticle-oxartextends-Daten
- Hauptsynonyme sind nun auch löschbar
- "Einfügungen und Auslassungen erlauben" auch bei kurzen Suchbegriffen ermöglicht
- explizite Prüfung auf inaktiven Vaterartikel integriert
- kleinere Textkorrekturen und Logikfehler beseitigt

## 5.2.0.2
- korrigiert: Abfragegenerierung ohne vorgegebene Artikelsortierung
- korrigiert: inaktives Modul erzeugt Fehler bzgl. mangelnder Ressourcen

## 5.2.0.1
- Precheck aktualisiert
- für 4.7.0 + 4.7.1: fehlende getSortIdent-Methode eingefügt
- fehlende Tabellendefinition in Query nachgetragen

## 5.2.0.0
- Wortrelevanz wird in Relevanzermittlung zusätzlich berücksichtigt
- Ähnlichkeitssuche berücksichtigt Mehrzahlformen auch bei kurzen Suchworten 

## 5.1.1.1
- fehlerhafte Datenbankabfrage bei Kombination von "Variantensuche" und Feldern in "oxartextends" korrigiert

## 5.1.1.0
- optionales Popup während des Suchvorgangs eingefügt
- DirectShow verwendet nur suchbare Artikel
- Kompatibilität zu OXID eShop 4.8 / 5.0 hergestellt

## 5.1.0.2
- Datenbankabfragen korrigiert

## 5.1.0.1
- Phonetic-Generator tickerte falsch
- Semantic-Editor war aufgrund undefinierter Sortierung nicht aufrufbar
- fehlendes Template korrigiert
- Attributsortierung geändert

## 5.1.0.0
- Attribute können mehrfach gefiltert werden
- nicht zu Attributen zugeordnete Artikel können gefiltert werden
- Templates wurden für einfachere Erweiterung mit Blöcken ausgerüstet
- kleinere Bugfixes

## 5.0.0.1
- Query für Attributlisten korrigiert
- Smarty-Variable in Schnellsuche ergänzt
- nicht ausführbarer Debug-Modus unter mySQL 5.5 korrigiert

## 5.0.0.0
- Performanceoptimierung bei großen Suchergebnislisten
- Optimierung auf Cluster
- Statistikauswertungen erweitert
- Suchsyntax optimiert

## 4.0.2.0
- eigene Suchformularfelder suchen nun auch in Bereich (von / bis-Suche)
- kleiner Fehler bei der Verarbeitung der eigenen Suchformularfelder beseitigt

## 4.0.1.1
- OXID-Bug in Artikelsortierung behoben

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

## 4.0.0.1
- Korrektur auf neue SQL-Query-Syntax

## 4.0.0.0
- Umsetzung in neuer Dateistruktur des OXID 4.7 (PE) / 5.0 (EE)

## 3.12.1
- geänderte Logik für OXID 4.6.4: Navigationslinks der Suchergebnisseite enthielten unzureichende Parameter

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
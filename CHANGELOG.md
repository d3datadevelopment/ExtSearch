# Changelog
All notable changes to this project will be documented in this file.

## Unreleased

## 6.1.0.0 (2017-12-15)
### Added
- Installation via Composer
- Neueintr�ge bei Synonymen verwenden die Admin-Anmeldesprache

## [6.0.0.0] (2017-11-24)
### Added
- Synonym-Wortgruppen werden auch bei Einzelwortsuche gefunden und als Einzelworte in die Suchparameter eingef�gt
- Weiterleitungen sind f�r jeden Datentyp einzeln einstellbar
- Filter werden (sofern verf�gbar) in der Sidebar angezeigt (flow-Theme)
- CSS-Generierung auf Less umgestellt, erm�glicht Erstellung individueller CSS-Dateien

### Changed
- Umarbeitung f�r OXID 6
- Layout der Suggest-Suche angepasst

## [5.6.4.2] (2017-10-20)
- Fehler beim Auftrennen kombinierter Suchbegriffe bei der Verwendung der "�hnlichkeitssuche f�r Kurzworte" und Multibyte-Zeichen korrigiert
- leere Hersteller- und Lieferantenlisten korrigiert (#6617)
- fehlerhafte Artikellisten bei Artikellistenerg�nzung korrigiert (#6812)

## 5.6.4.1 (2017-07-25) 
- fehlende Sortierung der Suchergebnisse korrigiert

## 5.6.4.0 (2017-07-10)
- sinngleiche Suche wird auch bei Suche in Kategorienamen verwendet
- Synonym-Wortgruppen werden auch bei Einzelwortsuche gefunden und als Einzelworte in die Suchparameter eingef�gt
- zus�tzliche Templatebl�cke f�r Filter integriert
- fehlende Template-Parameter erg�nzt
- Preisschiebegregler f�r Nettopreise angepasst
- Attributfilterbereinigung optimiert
- Preisstepberechnung korigiert
- Mehrfachfilter werden in Artikellisten
- Bugfix: gew�hlte Mehrfachfilter werden in Artikellisten-Seiten zur�ckgegeben

## [5.6.3.0] (2017-03-14)
- isextsearch-Parameter wird nur bei verwendeter Filterung gesetzt
- mehrfache Kategoriefilter auch in Suchergebnissen verf�gbar
- Support f�r Content-Einstellungen im Visual CMS-Modul (Version 1.0.0) (#6103)
- fehlenden Kategoriefilter in Artikellistenfilter nachgetragen
- Testlizenzen enthalten Artikellistenfilter
- kleine Fehler in der Query-Generierung korrigiert
- Exception bei deaktiviertem Modul korrigiert

## [5.6.2.1] (2016-10-21)
- Locator auf der Detailansicht korrigiert, wenn Artikel aus direkter Anzeige einer 1-Treffer-Liste stammt (#5554)
- korrigiert: Mehrfachfilter wurden ausgeblendet, wenn Auswahl nur 1 Treffer enthielt (#5552)
- modulspezifische Theme-Mapping-Variablen eingef�gt

## 5.6.2.0 (2016-10-10)
- verwendet Theme-Mapping
- Schnellsuche-Anfragen werden ebenfalls ins Log geschrieben
- .htaccess-Beschr�nkungen f�r Apache 2.4 angepasst
- gemeinsame Erweiterung der *list-Klassen aufgel�st
- Funktionsaufrufe f�r Ajax-Calls ge�ndert
- als "deprecated" gekennzeichnete Methodenaufrufe ersetzt
- Scripts f�r passende Darstellung des Adminmen�titels im Browser angepasst 
- fehlende Template-Erweiterungen f�r "Flow" nachgetragen
- fehlende Componenten-Klasse in oxwarticledetails-Widget erg�nzt
- falschen Formularparameter korrigiert
- Bugfix f�r fehlerhafte Datenbankabfrage bei aktivierter Variantensuche
- undokumentierte Parameter im Handbuch nachgetragen

## [5.6.1.0] (2016-08-10)
- Kompatibilit�t mit OXID-eShop Version 4.10.x / 5.3.x hergestellt
- Template-Anpassungen f�r "Flow" eingef�gt

## 5.6.0.1 (2017-07-10)

## [5.6.0.0] (2016-06-27)
- Marken- und Lieferantenfilter sind nun mehrfach w�hlbar

## [5.5.4.0] (2016-03-14)
- Filter f�r Preiskategorien eingef�gt
- Artikellisten verwenden Sortierung der Zuordnungstabellen
- Artikelposition innerhalb der Detailseiten-Listennavigation angepasst
- Installation korrigiert

## [5.5.3.1] (2016-02-17)
- Bugfix f�r fehlerhafte Datenbankabfrage bei Suche ohne definierte Sortierung

## [5.5.3.0] (2016-02-16)
- alternative Sortierung bei identischen Relevanzwerten einstellbar
- versteckte Kategorien werden in Attributfilter ber�cksichtigt
- Attributfilter speichert Auswahl sprachabh�ngig
- Direktsuche mit leerem Suchparameter korrigiert
- Suggestsuche bei aktiviertem EE-Backend-Cache korrigiert

## [5.5.2.0] (2016-01-21)
- semantische Datenbank bereinigt
- semantische Suche verwendet gew�hlte Sprache zur Auswahl der Alternativbegriffe
- Datenbankabfragen optimiert
- modulspezifische Logging-Auswertung eingef�gt
- statistische Auswertungen (ohne grafische Auswertung)auch f�r EE-Installationen verf�gbar gemacht
- Handbuch �berarbeitet
- Relevanz-Abfrage wird bei leerer Suchabfrage nicht erstellt
- 4.7 / 5.0-Templates entfernt
- 4.9 / 5.2-Templates eingef�gt
- vermeide �berladung der Listennavigation bei deaktiviertem aList-Filter
- fehlende PageId in Response-Klasse nachgetragen
- fehlende Template-Blocks nachgetragen
- Hilfelinks korrigiert
- fehlerhafte BreadCrumb auf Artikeldetailseite bei Verwendung des aListFilters korrigiert
- selektive Funktion des Preisschiebereglers in Markenlisten korrigiert
- �berlaufender Preisschieberegler bei identischer Selektion korrigiert
- leere Artikellisten bei 0-bis-0-Euro Preisselektion korrigiert
- unvollst�ndige Listennavigation korrigiert

## [5.5.1.1] (2015-12-21)
- RSS-Feed-Controller auf neue Filter angepasst
- vermeidet Warnungen bei unvollst�ndig �bergebenen Formularen

## [5.5.1.0] (2015-12-14)
- Preisschieberegler verwendet als Auswahl nur den Preisbereich gefundener Artikel
- Preisschieberegler beh�lt initialen Preisbereich f�r Deselektion auch bei weiterer Einschr�nkung bei
- Preisfilter verwendet bei Varianten nicht deren 0-Euro-Preis, sondern den Preis der Elternartikel
- Semantic-Tabellen werden in automatischer Installation angelegt -> Semantic auch ohne Lexikon nutzbar
- Synonym-Editor legt Neueintr�ge passend an
- semantische Begriffe werden optimaler gruppiert
- fehlende JavaScript-Variable bei Nichtanzeige des Preisschiebereglers korrigiert
- Fehlervermeidung bei inaktivem Modul
- Navigationsparamter korrigiert
- Gro�-/Kleinschreibung in Synonym-Tabellen korrigiert
- Relevanz-Analyse-Popup ist vergr��erbar 

## 5.5.0.1 (2015-09-01)
- optimierte Zeichensatzbehandlung innerhalb der Suggestsuche
- Artikellistenfilterung verwendet Schnellsortierung der Kategorien
- optionale Parameter der Suggest-Suchlinks deaktivierbar (config-Parameter)
- Fehler bei Extraktion der Log-Parameter in Statistik korrigiert
- vermeidet Warnungen bei unvollst�ndig �bergebenen Formularen

## [5.5.0.0] (2015-08-27)
- Filter k�nnen in Kategorie-, Hersteller- und Markenansicht genutzt werden
- bei Attributen k�nnen mehrere Filterwerte gew�hlt werden
- Filter-L�schen-Option eingef�gt
- selektierte Attributsfilter werden intern gespeichert, keine Parameter�bergabe n�tig
- Erweiterbarkeit verbessert (TPL-Block, CSS)
- Mobile-Support auch f�r Shopversion 4.7 / 5.0

## [5.4.0.3] (2015-08-27)
- unvollst�ndig zusammengef�hrte Templates erg�nzt

## [5.4.0.2] (2015-08-05)
- fehlende Navigationsparameter f�r Startseite nachgetragen
- Sortierrichtung f�r Hersteller- und Lieferantenfilter korrigiert
- Inhaltssuche wird nur mit gesetztem Suchparameter ausgef�hrt
- ModCfg-Pr�f-Bl�cke korrigiert
- Datenbankabfrage f�r attributgefilterte Variantenliste korrigiert
- fehlendes getSortId() f�r �ltere Shopversionen nachgetragen

## [5.4.0.1] (2015-07-14)
- Gro�-/Kleinschreibung der Felder dr semantischen Datenbank korrigiert

## [5.4.0.0] (2015-02-04)
- Kategorien k�nnen von Verwendung in Suche ausgeschlossen werden
- zus�tzlicher Phonetic-Generator f�r besseres Handling mit Vokalen integriert
- phonetischer Index optimiert
- JavaScript-Code auf bessere Kompatibilit�t angepasst
- Template der Schnellsuche ist �ber Template-Block erweiterbar
- kleine Fehler in Abfrage-Generierung behoben

## 5.3.0.0
- Unterst�tzung f�r OXID Mobile Theme hinzugef�gt
- Querygenerierung in Statistikanzeige korrigiert
- Kompatibilit�t f�r eShop 4.7.0 + 4.7.1 erweitert

## 5.2.1.0
- Attributsortierung in Filtern erm�glicht
- Indexgenerierung pr�ft vorab auf konsistente oxarticle-oxartextends-Daten
- Hauptsynonyme sind nun auch l�schbar
- "Einf�gungen und Auslassungen erlauben" auch bei kurzen Suchbegriffen erm�glicht
- explizite Pr�fung auf inaktiven Vaterartikel integriert
- kleinere Textkorrekturen und Logikfehler beseitigt

## 5.2.0.2
- korrigiert: Abfragegenerierung ohne vorgegebene Artikelsortierung
- korrigiert: inaktives Modul erzeugt Fehler bzgl. mangelnder Ressourcen

## 5.2.0.1
- Precheck aktualisiert
- f�r 4.7.0 + 4.7.1: fehlende getSortIdent-Methode eingef�gt
- fehlende Tabellendefinition in Query nachgetragen

## 5.2.0.0
- Wortrelevanz wird in Relevanzermittlung zus�tzlich ber�cksichtigt
- �hnlichkeitssuche ber�cksichtigt Mehrzahlformen auch bei kurzen Suchworten 

## 5.1.1.1
- fehlerhafte Datenbankabfrage bei Kombination von "Variantensuche" und Feldern in "oxartextends" korrigiert

## 5.1.1.0
- optionales Popup w�hrend des Suchvorgangs eingef�gt
- DirectShow verwendet nur suchbare Artikel
- Kompatibilit�t zu OXID eShop 4.8 / 5.0 hergestellt

## 5.1.0.2
- Datenbankabfragen korrigiert

## 5.1.0.1
- Phonetic-Generator tickerte falsch
- Semantic-Editor war aufgrund undefinierter Sortierung nicht aufrufbar
- fehlendes Template korrigiert
- Attributsortierung ge�ndert

## 5.1.0.0
- Attribute k�nnen mehrfach gefiltert werden
- nicht zu Attributen zugeordnete Artikel k�nnen gefiltert werden
- Templates wurden f�r einfachere Erweiterung mit Bl�cken ausger�stet
- kleinere Bugfixes

## 5.0.0.1
- Query f�r Attributlisten korrigiert
- Smarty-Variable in Schnellsuche erg�nzt
- nicht ausf�hrbarer Debug-Modus unter mySQL 5.5 korrigiert

## 5.0.0.0
- Performanceoptimierung bei gro�en Suchergebnislisten
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
- zus�tzliche Modul-Aktiv-Pr�fungen integriert
- Treffer in Suggest-List zeigt auf Shopmandant
- "einf�gen/auslassen"-Abfrage korrigiert
- Erweiterbarkeit verbessert
- Similar-Light-Suche korrigiert
- Ergebnis-Feld-Analyse eingef�gt
- fehlerhafte Suchbegriff-Verkn�pfung korrigiert
- fehlerhafte Hersteller-Relevanz korrigiert

## 4.0.0.1
- Korrektur auf neue SQL-Query-Syntax

## 4.0.0.0
- Umsetzung in neuer Dateistruktur des OXID 4.7 (PE) / 5.0 (EE)

## 3.12.1
- ge�nderte Logik f�r OXID 4.6.4: Navigationslinks der Suchergebnisseite enthielten unzureichende Parameter

## 3.12.0
- bei gruppierten Variantenartikeln wird Kategoriefilter vom Vaterartikel generiert
- bei gruppierten Variantenartikeln wird Preisfilter von ungruppierten Varianten generiert, 
  Anzahl wird auf Grund differierender Treffermengen am Filter ausgeblendet
- Eingabe des Markennamens im Suchfeld findet Markenartikel (analog Kategorienamen, auch f�r Lieferanten)
- Schnellsuche findet auch Contents, Marken, Lieferanten und Kategorien
- Artikel der Schnellsuche sind nach Relevanz sortiert
- Direktsuche findet auch Marken und Lieferanten
- Fehler in Ermittlung der phonetischen L�nge des Suchbegriffs gefixt
- alte DB-Feldbezeichnungen im Semantic-Editor verhindert Speicherung -> behoben
- Existenzpr�fung "getSortingSql" integriert
- getDb()-Syntax-�nderungen aus 4.6.0 eingef�gt
- Semantic pr�ft auch auf leeres Term-Level (nicht nur NULL)
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
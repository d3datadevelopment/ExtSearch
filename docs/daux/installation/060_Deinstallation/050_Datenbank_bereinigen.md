---
title: Datenbank bereinigen
---
  
Das Modul legt Informationen in der Datenbank ab. Sofern diese Daten nicht mehr benötigt werden, können diese gelöscht werden. 

> [!] Legen Sie sich vorab bitte unbedingt eine Sicherung an, um die Daten im Zweifelsfall wiederherstellen zu können.
    
Für das Modul **{$modulename}** sind dies die folgende Tabellen und Felder:

* die komplette Tabelle `d3_extsearch_statisticlog`
* die komplette Tabelle `d3_extsearch_synset`
* die komplette Tabelle `d3_extsearch_term`
    
und diese Felder in bestehenden Tabellen:

* in Tabelle `oxartextends`:  
  * das Feld `D3_PHONETIC`
  * das Feld `D3_PHONETIC_1`
  * das Feld `D3_PHONETIC_...`
  
sowie diese Einträge in bestehenden Tabellen:

* in Tabelle `d3_cfg_mod`:  
  * den Eintrag `oxmodid = "{$modcfgident}"` **)

**) Diesen Eintrag gibt es ggf. für jeden Subshop. Entfernen Sie diesen nur für die Mandanten, in denen das Modul **nicht** mehr installiert ist. 

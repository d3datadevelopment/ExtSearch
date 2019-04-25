---
title: Erweiterungsmöglichkeiten
---

# Allgemein

Viele Stellen des Frontends lassen sich unkompliziert anpassen. Dies gilt für das Design der angezeigten Fenster und Rahmen, sowie auch bestimmte Funktionalitäten.

# Schnellsuche

Die Schnellsuche stellt ein per Ajax-Technologie erstelltes Trefferfenster zur Verfügung. Dieses wird, wie alle anderen Shopseiten auch, aus einem Template erstellt. Möchten Sie dieses Fenster anpassen, verwenden Sie bitte die `modules/d3/extsearch/Application/views/tpl/d3_ext_search_quicksearch.tpl` für inhaltliche Änderungen. Grafische Einstellungen sind in der moduleigenen CSS-Datei `d3_ext_search.css` notiert.

# Filter-Auswahl

Die Filter-Auswahl wird oberhalb der Trefferliste angezeigt. Je nach Einstellung werden Ihnen hier Kategorien, Hersteller oder auch die Indexleiste gezeigt. Diese Elemente sind im Template `modules/d3/extsearch/Application/views/tpl/[theme]/d3_inc_extsearch.tpl` definiert. Um die Auswahlfelder der Indexleiste anzupassen, verwenden Sie die include- Aufrufe, die Sie beispielhaft im Template finden. Um die Logik müssen Sie sich hierbei nicht kümmern. Weitere Details zu den Feldern der Indexleiste finden Sie in den "!!!!!Technischen Erläuterungen" dieses Handbuchs.

# Trefferhervorhebungen

Welches Format die Hervorhebung der gesuchten Begriffe hat, legen Sie im Template `modules/d3/extsearch/Application/views/tpl/d3_ext_search_highlight.tpl` fest. Hierbei sind alle HTML-Tags erlaubt, die im selben Template auch wieder abgeschlossen werden können.

# Zusätzliche Formularfelder

Diese Funktion ist ausführlich in den "!!!!!!Technischen Erläuterungen" beschrieben.

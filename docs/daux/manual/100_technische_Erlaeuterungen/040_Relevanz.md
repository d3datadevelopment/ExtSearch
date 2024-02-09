---
title: Relevanz und Wichtigkeiten
---

Die Suche bietet zwei miteinander kombinierbare Möglichkeiten an, den Artikeln eine automatische Reihenfolge vorzugeben:

- Je nachdem, in welchem Feld der Treffer vorkommt (Bsp.: Artikel mit dem Suchwort im Titel werden höher gewertet, als Artikel mit dem Suchwort in der Langbeschreibung, hat der Artikel die Suchworte in beiden Feldern, addieren sich beide Relevanzwerte und der Artikel wird noch weiter oben gezeigt.
- Je nach Wichtigkeit am Artikel: jeder Artikel kann als normal, wichtiger und sehr wichtig definiert werden. Entsprechend weit oben wird dieser in den Suchergebnissen gezeigt.

Die Kombination aus beiden Möglichkeiten wird durch folgende Formel umgesetzt:

```
Sortierung = (Teilrelevanz * Wichtigkeit) + (Wortrelevanz * Wichtigkeit) + Wichtigkeit
```

So werden wichtige Artikel mit Treffern in unwichtigen Feldern höher bewertet und schieben sich evtl. sogar vor unwichtige Artikel mit Treffern in wichtigen Feldern.

Die Wortrelevanz trifft zu, wenn der Suchbegriff von Leerzeichen umschlossen im jeweiligen Feld gefunden wird. Für die Teilrelevanz ist das Vorkommen des Suchbegriffes auch als Teil eines anderen Wortes ausreichend. Somit werden Artikel, die genau das gesuchte Wort enthalten, höher bewertet, als wenn das Suchwort nur als Teilbegriff vorkommt.

Um die Relevanz in einem Suchergebnis analysieren zu können, finden Sie im Adminbereich der **erweiterten Suche** unter [ Grundeinstellungen ] die Ergebnis-Feld-Analyse. Darin wird zu jedem Treffer Ihrer Suchanfrage aufgeschlüsselt, wie sich seine Relevanz ergibt. Mit diesen Informationen können Sie die Relevanz besser beeinflussen.

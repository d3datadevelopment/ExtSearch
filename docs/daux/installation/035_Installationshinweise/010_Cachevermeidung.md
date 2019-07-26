---
title: Cachevermeidung
---

Serverseitiges Caching kann die Performance der Shopinstallation deutlich verbessern. Jedoch sind die von der Suche generierten Inhalte dynamisch und sollten nicht in den Cache aufgenommen werden. Ansonsten würden die Besucher gegenseitig ihre Ergebnisse sehen. 

Setzen Sie eine Cachelösung ein, definieren Sie bitte speziell für die Suche, wann bestimmte Seiten nicht in den Cache aufgenommen werden sollen. 
Mit jeder der folgenden Variablen kann ermittelt werden, ob dynamische Inhalte generiert wurden und ob die Aufnahme in den Cache verhindert werden soll:

- Request
  - `isextsearch`

- Session
  - `d3searchattrib`
  - `d3searchattribmulti`
  - `d3searchattribmultiselector`

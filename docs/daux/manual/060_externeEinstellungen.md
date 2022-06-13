---
title: Einstellungen außerhalb des Adminbereichs
---

Für wenige Installation sind bestimmte Einstellungen notwendig, um das Modul z.B. an bestimmte Servereinstellungen anzupassen. Diese Optionen werden der Übersichtlichkeit wegen nicht direkt im Adminbereich definiert. Tragen Sie die Einstellungen bei Bedarf bitte direkt in die Datei `config.inc.php` ein.

# UTF8-Decoding erzwingen

Werden Suchbegriffe mit Sonderzeichen fehlerhaft dargestellt, kann es nötig sein, dass diese unbedingt decodiert werden müssen. Hierfür ist folgende Einstellung zu verwenden:

```
$this->d3extsearch_forceUtf8decode = true;
```

# URLs in Artikellisten nicht um Suchparameter ergänzen

Die folgende Option verhindert, dass Artikeladressen innerhalb der Schnellsuche um Suchparameter ergänzt werden:

```
$this->bld3ExtSearchSuggestForceHideUrlParams = true;
```

---
title: Indexleiste
---

Die Felder der Indexleiste sind in `modules/d3/extsearch/Application/views/blocks/page/search/d3_inc_extsearch.tpl` aufgeführt. Sie werden durch den folgenden Aufruf darin eingebunden:

```
[{include file= $sTplPath|cat:“inc/d3_ext_search_filter.tpl“ d3fparam=“X“ d3fdesc=“Buchstabe X“}]
```

Die Logik hinter den Feldern ist im Template `modules/d3/extsearch/Application/views/tpl/d3_ext_search_filter.tpl` realisiert. Zum Aufruf ist der Parameter `d3fparam` zwingend notwendig. Er enthält den Suchparameter. Soll statt des Parameters in der Indexleiste eine andere Ausgabe erfolgen, können Sie diese im optionalen Parameter `d3fdesc` hinterlegen. Hier sind so auch Multilang-Bausteine möglich.

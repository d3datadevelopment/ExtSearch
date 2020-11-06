---
title: Phonetic-Cronjob
---

Werden Ihre Artikel außerhalb des OXID-Frameworks gepflegt, muss die Erstellung des phonetischen Indexes (notwendig für die klangähnliche Suche) manuell gestartet werden. Daher haben Sie die Möglichkeit, die Generierung des Suchindex über einen externen Aufruf zu starten. Verwenden Sie dazu den folgenden Aufruf:

```
./vendor/bin/d3_extsearch_cron
```

Dieser Aufruf listet Ihnen alle möglichen Optionen und Aufgaben. Stellen Sie sich den gewünschten Aufruf damit zusammen und verwenden Sie diesen zum Beispiel als regelmäßig ausgeführter Cronjob.

---
title: Phonetic-Cronjob
---

Werden Ihre Artikel außerhalb des OXID-Frameworks gepflegt, muss die Erstellung des phonetischen Indexes (notwenidig für die klangähnliche Suche) manuell gestartet werden. Daher haben Sie die Möglichkeit, die Generierung des Suchindex über einen externen Aufruf zu starten. Verwenden Sie dazu den folgenden Aufruf:

```
http://www.example.com/admin/index.php?cl=d3_cfg_extsearch_main&fnc=
generatePhoneticStringsExt&extlogin=true&user=admin&pwd=admin&blNewe
st=true&blMsg=true&iTimeLimit=0
```

Die verwendeten Parameter haben folgende Bedeutung:

```
extlogin=true    => ermöglicht externes Login in den Adminbereich
user=admin       => Benutzername eine angelegten Adminbenutzers
pwd=admin        => Passwort eines angelegten Adminbenutzers
blNewest=true    => es werden nur neue / alle Einträge generiert
blMsg=true       => mögliche Meldungen werden ausgegeben / unterdrückt
iTimeLimit=0     => Timeout des Servers in Sekunden

---
title: zusätzliche Formularfelder
---

Mit den zusätzlichen Formularfeldern haben Sie ein mächtiges Werkzeug an der Hand, um Ihren Kunden die Suche vorzubereiten. Mit regulären Formularfeldern ("Select-Boxen", Textfeldern etc.) können Sie auch shopfremde Felder Ihrer Artikeltabelle in flexibler Art und Weise in Kombination mit den Standardoptionen durchsuchbar machen.

Als Anschauungsbeispiel möchte ich Ihnen die Verwendung in einem Schuh-Shop erklären. Übertragen Sie dies dann einfach auf Ihre Branche:

Alle Ihre Schuhe haben die Informationen über die verfügbaren Schuhgrößen in einem speziellen Feld `myShoeSize` in der Tabelle `oxarticles` abgelegt. Für ein Beispiel könnte darin stehen: `40, 41, 45, 46`. Die Werte müssen zwingend mit Komma getrennt sein.

Ein weiteres Beispielfeld `myShoeColor` könnte so die Farbe des Schuhs beinhalten. So steht in unserem Farbfeld eindeutig `schwarz`, `blau` oder `grün`.

Mit Hilfe der zusätzlichen Formularfelder können Sie nun in das Template `modules/d3/extsearch/Application/views/blocks/widget/header/d3_extsearch_searchfield.tpl` ein neues Formularfeld einfügen:

```
<select name="d3searchlike[myShoeSize]">
  <option value=""> - alle Größen - </option>
  <option value="40" [{if $aD3SearchLike.myShoeSize == "40"}]selected[{/if}]> Größe 40 </option>
  <option value="41" [{if $aD3SearchLike.myShoeSize == "41"}]selected[{/if}]> Größe 41 </option>
  <option value="42" [{if $aD3SearchLike.myShoeSize ==  "42"}]selected[{/if}]> Größe 42 </option>
  <option value="..." [{if $aD3SearchLike.myShoeSize == "..."}]selected[{/if}]> ... </option>
  <option value="47" [{if $aD3SearchLike.myShoeSize == "47"}]selected[{/if}]> Größe 47 </option>
</select>

<input type="text" name="d3searchis[myShoeColor]" value="[{$aD3SearchIs.myShoeSize}]">

<select name="d3searchis[myShoeSize]">
  <option value=""> - alle Größen - </option>
  <option value="BETWEEN__AND_35_" [{if $aD3SearchIs.myShoeSize == " BETWEEN__AND_35_"}]selected[{/if}]> bis Größe 35 </option>
  <option value="BETWEEN_36_AND_40_" [{if $aD3SearchIs.myShoeSize == " BETWEEN_36_AND_40_"}]selected[{/if}]> von Größe 36 bis 40 </option>
  <option value="BETWEEN_41_AND__" [{if $aD3SearchIs.myShoeSize == " BETWEEN_41_AND__"}]selected[{/if}]> ab Größe 41 </option>
</select>

<input type="hidden" name="d3searchbitset[bitfield][]" value="">
<input type="checkbox" name="d3searchbitset[bitfield][]" value="1" [{if $aD3SearchBitSet.bitfield && '1'|in_array:$aD3SearchBitSet.bitfield}]checked[{/if}]>1<br>
<input type="checkbox" name="d3searchbitset[bitfield][]" value="2" [{if $aD3SearchBitSet.bitfield && '2'|in_array:$aD3SearchBitSet.bitfield}]checked[{/if}]>2<br>
<input type="checkbox" name="d3searchbitset[bitfield][]" value="4" [{if $aD3SearchBitSet.bitfield && '4'|in_array:$aD3SearchBitSet.bitfield}]checked[{/if}]>4<br>
<input type="checkbox" name="d3searchbitset[bitfield][]" value="8" [{if $aD3SearchBitSet.bitfield && '8'|in_array:$aD3SearchBitSet.bitfield}]checked[{/if}]>8<br>
```

### d3searchlike

Mit diesem Namen des Formularfeldes legen Sie das Verhalten des Suchfeldes fest. Zur Verfügung stehen Ihnen hier:

- d3searchlike: Der damit übergebene Wert muss als Teil des Inhalts im genannten Tabellenfeld enthalten sein. Wählt der Kunde z.B. die Option `41`, werden alle Artikel gefunden, bei denen die Zahl 41 im Größenfeld mit genannt ist. Da die Werte eindeutig getrennt sind, werden die Artikel sicher selektiert. In unserem Fallbeispiel würde der Schuh gefunden werden, wenn alle anderen Suchoptionen (z.B. der Suchbegriff) auch passt. Bei Option `42` fehlt der Artikel trotz passenden Begriffs in der Trefferliste; die Größe ist nicht mit in dessen Liste aufgeführt.
- d3searchis: Der vom Feld übergebene Wert muss eindeutig in dem Feld am Artikel vorkommen. Wird in das Formular `schwarz` eingegeben, werden auch nur Artikel mit der Farbe schwarz gefunden. Die Farbe `schwarzgrün` würde zum Beispiel ignoriert werden. Um ungenaue Suchen auszuschließen, empfehlen wir, auch hier dem Kunden eine genaue Vorgabe in Form von z.B. Selectboxen, Radiobuttons etc. zu machen. Freitexteingaben sind da sehr fehleranfällig.
- d3searchis mit BETWEEN-Syntax: Mit der BETWEEN-Syntax können Sie Bereiche festlegen, innerhalb derer die Treffer liegen müssen. Die Feldwerte müssen dabei wie folgt aufgebaut sein:
```
BETWEEN_Wert1_AND_Wert2_
```
`Wert1` definiert den Startwert, `Wert2` den Endwert.

Die beiden Werte sind optional, einer der beiden Werte muss jedoch zwingend angegeben werden. Folgende Konstellationen sind hierbei möglich:

- `BETWEEN__AND_10_` - Alle Werte bis einschließlich 10 werden gefunden.
- `BETWEEN_11_AND_20_` - Alle Werte zwischen einschließlich 11 bis einschließlich 20 werden gefunden.
- `BETWEEN_21_AND__` - Alle Werte ab einschließlich 21 werden gefunden

Statt Ganzzahlen können Sie auch Dezimalzahlen angeben. Die Schreibweise muss jedoch den Datenbankwerten entsprechen.
- d3searchbitset: Der vom Feld übergebene Ganzzahlwert muss einem im Feld gesetzten Bitwert entsprechen. Ist das Bit nicht gesetzt, wird der Artikel ausgefiltert.

Ein Beispiel für die verwendete Syntax finden Sie weiter oben und in den beiliegenden Modultemplates.

#### Legende
Mit `myShoeSize` sind in den Beispielen die Namen der Datenbankfelder benannt. Tragen Sie die Namen eindeutig (so wie in Ihrer Shopdatenbank in der Tabelle `oxarticles` benannt) entsprechend der Beispiele ein. Mit diesem Namen geben Sie vor, in welchem Feld die ausgewählten Inhalte vorkommen müssen. Zugriff haben Sie auf alle Tabellenfelder der Tabelle `oxarticles`, unabhängig ob diese im Standardshop vorhanden oder individuell angelegt wurden.

Die Werte im `value`-Attribute sind die in der Datenbank abgefragten Werte. In Textfeldern vergeben Sie keine Standardwerte. Im Normalfall (Datenbank-Kollation ist `case-insensitiv`) ist die Groß-/Kleinschreibung der Werte egal.

Leereinträge werden von der Suche so behandelt, dass derjenige Filter nicht verwendet wird. Damit können Sie also eine Möglichkeit schaffen, eine Filterung komplett zu vermeiden. Im Beispiel der Schuhgrößen würde die Auswahl der ersten Option `alle Größen` alle Schuhe unabhängig der Größe liefern.

In den Variablen `$aD3SearchIs` und `$aD3SearchLike` sind die Werte enthalten, die der Kunden vorab gewählt hatte. Als Parameter übergeben Sie den Feldnamen. Damit können Sie Ihren Formularfeldern die vom Kunden gewählte Auswahl wieder als Standard setzen.

In der Praxis hat sich auch bewährt, an prominenter Stelle im Shop ein kleines Suchformular anzubieten und auf einer speziellen Seite Ihrem Kunden ein umfangreiches Suchformular mit vielen Suchkriterien zur Verfügung zu stellen. Kopieren Sie in diesem Fall das komplette Formular aus dem Template `modules/d3/extsearch/Application/views/blocks/widget/header/d3_extsearch_searchfield.tpl` in Ihre spezielle Seite und füllen dies mit den möglichen Suchfeldern entsprechend der vorangegangen Beschreibung.

Beachten Sie bitte, dass zur Auswertung dieser beschriebenen Suchfelder unbedingt die Option `individuelle Filterfelder nutzen` aktiviert sein muss.

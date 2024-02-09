---
title: Attributfilter mit Mehrfachauswahl
---

Auch dieser Filter ist natürlich frei anpassbar. Die Einfachauswahl (Dropdown aus Select-Element) und die Mehrfachauswahl (Checkboxen) sind unterschiedliche Elemente, die gleichzeitig an den Browser geschickt werden. Über einen Schalter wird die jeweils ungenutzte Option ausgeblendet.

Soll stattdessen immer nur die Einfach- oder die Mehrfachauswahl allein gezeigt werden, können die anderen Formularfelder entfernt werden. Beachten Sie hierbei Folgendes:

- Passen Sie die Stylesheet-Angabe so an, dass die gewünschten Eingabefelder sichtbar sind.
- Prüfen Sie, ob die für den Umschalter integrierten JavaScripts noch benötigt werden.
- Ob die Mehrfachauswahl genutzt wird, wird in einem versteckten Formularelement gespeichert (`d3attribmultiselector`). Setzen Sie diesen entsprechend so:

  - Bei Verwendung beider Auswahlmöglichkeiten: dynamisch wie Standardmodul
  - Bei ausschließlicher Verwendung der Einfachauswahl: fest auf `nicht gesetzt`
  - Bei ausschließlicher Verwendung der Mehrfachauswahl: fest auf `gesetzt`

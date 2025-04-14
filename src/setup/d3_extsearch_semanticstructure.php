<?php

$aScripts = array(
    'd3_extsearch_semantic_synset.php',
    'd3_extsearch_semantic_term.php',
);

foreach ($aScripts as $sScript) {
    unset($this->aESSemanticTables);
    unset($this->aESSemanticFields);
    unset($this->aESSemanticIndizes);
    unset($this->aESSemanticRenameFields);

    require($sScript);

    $this->aSemanticTables = array_merge($this->aSemanticTables ?? [], $this->aESSemanticTables ?? []);
    $this->aFields = array_merge($this->aFields ?? [], $this->aESSemanticFields ?? []);
    $this->aIndizes = array_merge($this->aIndizes ?? [], $this->aESSemanticIndizes ?? []);
    $this->aRenameFields = array_merge($this->aRenameFields ?? [], $this->aESSemanticRenameFields ?? []);
}

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

    if (isset($this->aESSemanticTables)
        && is_array($this->aESSemanticTables)
        && count($this->aESSemanticTables)
    ) {
        $this->aSemanticTables = is_array($this->aSemanticTables) ? array_merge($this->aSemanticTables, $this->aESSemanticTables) : $this->aESSemanticTables;
    }

    if (isset($this->aESSemanticFields)
        && is_array($this->aESSemanticFields)
        && count($this->aESSemanticFields)
    ) {
        $this->aFields = is_array($this->aFields) ? array_merge($this->aFields, $this->aESSemanticFields) : $this->aESSemanticFields;
    }

    if (isset($this->aESSemanticIndizes)
        && is_array($this->aESSemanticIndizes)
        && count($this->aESSemanticIndizes)
    ) {
        $this->aIndizes = is_array($this->aIndizes) ? array_merge($this->aIndizes, $this->aESSemanticIndizes) : $this->aESSemanticIndizes;
    }

    if (isset($this->aESSemanticRenameFields)
        && is_array($this->aESSemanticRenameFields)
        && count($this->aESSemanticRenameFields)
    ) {
        $this->aRenameFields = is_array($this->aRenameFields) ? array_merge($this->aRenameFields, $this->aESSemanticRenameFields) : $this->aESSemanticRenameFields;
    }
}

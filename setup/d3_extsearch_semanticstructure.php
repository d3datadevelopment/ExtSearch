<?php

/**
 * This Software is the property of Data Development and is protected
 * by copyright law - it is NOT Freeware.
 *
 * Any unauthorized use of this software without a valid license
 * is a violation of the license agreement and will be prosecuted by
 * civil and criminal law.
 *
 * http://www.shopmodule.com
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author    D3 Data Development - Daniel Seifert <support@shopmodule.com>
 * @link      http://www.oxidmodule.com
 */

use D3\Extsearch\setup\d3_extsearch_update;

/** @var d3_extsearch_update $this */

$aScripts = [
    'd3_extsearch_semantic_synset.php',
    'd3_extsearch_semantic_term.php',
];

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

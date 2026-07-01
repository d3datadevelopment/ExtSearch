<?php

/**
 * Copyright (c) D3 Data Development (Inh. Thomas Dartsch)
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * https://www.d3data.de
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author    D3 Data Development - Daniel Seifert <info@shopmodule.com>
 * @link      https://www.oxidmodule.com
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

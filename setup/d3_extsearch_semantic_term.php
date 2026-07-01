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
use D3\ModCfg\Application\Model\d3database;

/** @var d3_extsearch_update $this */

$this->aESSemanticTables = [
    'd3_extsearch_term'  => [
        'sName'     => 'd3_extsearch_term',
        'sType'     => 'MyISAM',
        'sComment'  => '',
    ],
];

$this->aESSemanticFields = [
    'D3SYN_TERM_OXID'    => [
        'sTableName'  => 'd3_extsearch_term',
        'sFieldName'  => 'OXID',
        'sType'       => 'CHAR(32)',
        'blNull'      => false,
        'sDefault'    => false,
        'sComment'    => '',
        'sExtra'      => '',
        'blMultilang' => false,
    ],
    'D3SYN_TERM_LANGUAGE_ID'    => [
        'sTableName'  => 'd3_extsearch_term',
        'sFieldName'  => 'LANGUAGE_ID',
        'sType'       => 'CHAR(32)',
        'blNull'      => false,
        'sDefault'    => false,
        'sComment'    => '',
        'sExtra'      => '',
        'blMultilang' => false,
    ],
    'D3SYN_TERM_SYNSET_ID'    => [
        'sTableName'  => 'd3_extsearch_term',
        'sFieldName'  => 'SYNSET_ID',
        'sType'       => 'CHAR(32)',
        'blNull'      => false,
        'sDefault'    => false,
        'sComment'    => '',
        'sExtra'      => '',
        'blMultilang' => false,
    ],
    'D3SYN_TERM_USER_COMMENT'    => [
        'sTableName'  => 'd3_extsearch_term',
        'sFieldName'  => 'USER_COMMENT',
        'sType'       => 'VARCHAR(255)',
        'blNull'      => true,
        'sDefault'    => false,
        'sComment'    => '',
        'sExtra'      => '',
        'blMultilang' => false,
    ],
    'D3SYN_TERM_WORD'    => [
        'sTableName'  => 'd3_extsearch_term',
        'sFieldName'  => 'WORD',
        'sType'       => 'VARCHAR(255)',
        'blNull'      => false,
        'sDefault'    => false,
        'sComment'    => '',
        'sExtra'      => '',
        'blMultilang' => false,
    ],
    'D3SYN_TERM_D3_PHONETIC'    => [
        'sTableName'  => 'd3_extsearch_term',
        'sFieldName'  => 'D3_PHONETIC',
        'sType'       => 'VARCHAR(255)',
        'blNull'      => false,
        'sDefault'    => false,
        'sComment'    => '',
        'sExtra'      => '',
        'blMultilang' => false,
    ],
];

$this->aESSemanticIndizes = [
    'D3TERM_PRIMARY'  => [
        'sTableName'  => 'd3_extsearch_term',
        'sType'     => d3database::INDEX_TYPE_PRIMARY,
        'aFields'   => [
            'OXID' => 'OXID',
        ],
        'blMultilang' => false,
    ],
    'FK36446CA3843755'  => [
        'sTableName'  => 'd3_extsearch_term',
        'sType'   => '',
        'sName'     => 'FK36446CA3843755',
        'aFields' => [
            'SYNSET_ID' => 'SYNSET_ID',
        ],
        'blMultilang' => false,
    ],
    'FK36446C5CA8CBD5'  => [
        'sTableName'  => 'd3_extsearch_term',
        'sType'   => '',
        'sName'     => 'FK36446C5CA8CBD5',
        'aFields' => [
            'LANGUAGE_ID' => 'LANGUAGE_ID',
        ],
        'blMultilang' => false,
    ],
    'WORD'  => [
        'sTableName'  => 'd3_extsearch_term',
        'sType'   => '',
        'aFields' => [
            'WORD' => 'WORD',
        ],
        'blMultilang' => false,
    ],
    'D3_PHONETIC'  => [
        'sTableName'  => 'd3_extsearch_term',
        'sType'   => '',
        'aFields' => [
            'D3_PHONETIC' => 'D3_PHONETIC',
        ],
        'blMultilang' => false,
    ],
];

$this->aESSemanticRenameFields = [
    'TERM_OXID'        => [
        'sTableName'  => 'd3_extsearch_term',
        'mOldFieldNames' => ['id', 'ID', 'oxid'], // is case sensitive
        'sFieldName'  => 'OXID',
        'blMultilang' => false,
    ],
    'TERM_LANGUAGEID'        => [
        'sTableName'  => 'd3_extsearch_term',
        'mOldFieldNames' => ['language_id'], // is case sensitive
        'sFieldName'  => 'LANGUAGE_ID',
        'blMultilang' => false,
    ],
    'TERM_SYNSETID'        => [
        'sTableName'  => 'd3_extsearch_term',
        'mOldFieldNames' => ['synset_id'], // is case sensitive
        'sFieldName'  => 'SYNSET_ID',
        'blMultilang' => false,
    ],
    'TERM_USERCOMMENT'        => [
        'sTableName'  => 'd3_extsearch_term',
        'mOldFieldNames' => ['user_comment'], // is case sensitive
        'sFieldName'  => 'USER_COMMENT',
        'blMultilang' => false,
    ],
    'TERM_WORD'        => [
        'sTableName'  => 'd3_extsearch_term',
        'mOldFieldNames' => ['word'], // is case sensitive
        'sFieldName'  => 'WORD',
        'blMultilang' => false,
    ],
    'TERM_D3PHONETIC'        => [
        'sTableName'  => 'd3_extsearch_term',
        'mOldFieldNames' => ['d3_phonetic'], // is case sensitive
        'sFieldName'  => 'D3_PHONETIC',
        'blMultilang' => false,
    ],
];

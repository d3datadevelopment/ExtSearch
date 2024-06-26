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
use D3\ModCfg\Application\Model\d3database;

/** @var d3_extsearch_update $this */

$this->aESSemanticTables = [
    'd3_extsearch_synset'  => [
        'sName'     => 'd3_extsearch_synset',
        'sType'     => 'MyISAM',
        'sComment'  => '',
    ],
];

$this->aESSemanticFields = [
    'D3SYN_SYNSET_OXID'    => [
        'sTableName'  => 'd3_extsearch_synset',
        'sFieldName'  => 'OXID',
        'sType'       => 'CHAR(32)',
        'blNull'      => false,
        'sDefault'    => false,
        'sComment'    => '',
        'sExtra'      => '',
        'blMultilang' => false,
    ],
    'D3SYN_SYNSET_IS_VISIBLE'    => [
        'sTableName'  => 'd3_extsearch_synset',
        'sFieldName'  => 'IS_VISIBLE',
        'sType'       => 'TINYINT(1)',
        'blNull'      => false,
        'sDefault'    => '1',
        'sComment'    => '',
        'sExtra'      => '',
        'blMultilang' => false,
    ],
    'D3SYN_SYNSET_USER_COMMENT'    => [
        'sTableName'  => 'd3_extsearch_synset',
        'sFieldName'  => 'USER_COMMENT',
        'sType'       => 'LONGTEXT',
        'blNull'      => true,
        'sDefault'    => '',
        'sComment'    => '',
        'sExtra'      => '',
        'blMultilang' => false,
    ],
    'D3SYN_SYNSET_USE_FOR_TERMS'    => [
        'sTableName'  => 'd3_extsearch_synset',
        'sFieldName'  => 'USEFORTERMS',
        'sType'       => 'TINYINT(1)',
        'blNull'      => false,
        'sDefault'    => '0',
        'sComment'    => 'synonym will used for search terms',
        'sExtra'      => '',
        'blMultilang' => false,
    ],
    'D3SYN_SYNSET_USE_FOR_ATTRIBUTES'    => [
        'sTableName'  => 'd3_extsearch_synset',
        'sFieldName'  => 'USEFORATTRIBUTES',
        'sType'       => 'TINYINT(1)',
        'blNull'      => false,
        'sDefault'    => '0',
        'sComment'    => 'synonym will used for attribute filters',
        'sExtra'      => '',
        'blMultilang' => false,
    ],
];

$this->aESSemanticIndizes = [
    'SYNSET_PRIMARY'    => [
        'sTableName'    => 'd3_extsearch_synset',
        'sType'         => d3database::INDEX_TYPE_PRIMARY,
        'aFields'       => [
            'OXID'      => 'OXID',
        ],
        'blMultilang'   => false,
    ],
    'IS_VISIBLE'  => [
        'sTableName'  => 'd3_extsearch_synset',
        'sType'   => '',
        'aFields' => [
            'IS_VISIBLE' => 'IS_VISIBLE',
        ],
        'blMultilang' => false,
    ],
];

$this->aESSemanticRenameFields = [
    'SYNSET_OXID'        => [
        'sTableName'  => 'd3_extsearch_synset',
        'mOldFieldNames' => ['id', 'ID', 'oxid'], // is case sensitive
        'sFieldName'  => 'OXID',
        'blMultilang' => false,
    ],
    'SYNSET_ISVISIBLE'        => [
        'sTableName'  => 'd3_extsearch_synset',
        'mOldFieldNames' => ['is_visible'], // is case sensitive
        'sFieldName'  => 'IS_VISIBLE',
        'blMultilang' => false,
    ],
    'SYNSET_USER_COMMENT'        => [
        'sTableName'  => 'd3_extsearch_synset',
        'mOldFieldNames' => ['user_comment'], // is case sensitive
        'sFieldName'  => 'USER_COMMENT',
        'blMultilang' => false,
    ],
];

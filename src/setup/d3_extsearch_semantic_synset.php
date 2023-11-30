<?php

use D3\ModCfg\Application\Model\d3database;

$this->aESSemanticTables = array(
    'd3_extsearch_synset'  => array(
        'sName'     => 'd3_extsearch_synset',
        'sType'     => 'MyISAM',
        'sComment'  => '',
    ),
);

$this->aESSemanticFields = array(
    'D3SYN_SYNSET_OXID'    => array(
        'sTableName'  => 'd3_extsearch_synset',
        'sFieldName'  => 'OXID',
        'sType'       => 'CHAR(32)',
        'blNull'      => false,
        'sDefault'    => false,
        'sComment'    => '',
        'sExtra'      => '',
        'blMultilang' => false,
    ),
    'D3SYN_SYNSET_IS_VISIBLE'    => array(
        'sTableName'  => 'd3_extsearch_synset',
        'sFieldName'  => 'IS_VISIBLE',
        'sType'       => 'TINYINT(1)',
        'blNull'      => false,
        'sDefault'    => '1',
        'sComment'    => '',
        'sExtra'      => '',
        'blMultilang' => false,
    ),
    'D3SYN_SYNSET_USER_COMMENT'    => array(
        'sTableName'  => 'd3_extsearch_synset',
        'sFieldName'  => 'USER_COMMENT',
        'sType'       => 'LONGTEXT',
        'blNull'      => true,
        'sDefault'    => '',
        'sComment'    => '',
        'sExtra'      => '',
        'blMultilang' => false,
    ),
    'D3SYN_SYNSET_USE_FOR_TERMS'    => array(
        'sTableName'  => 'd3_extsearch_synset',
        'sFieldName'  => 'USEFORTERMS',
        'sType'       => 'TINYINT(1)',
        'blNull'      => false,
        'sDefault'    => '0',
        'sComment'    => 'synonym will used for search terms',
        'sExtra'      => '',
        'blMultilang' => false,
    ),
    'D3SYN_SYNSET_USE_FOR_ATTRIBUTES'    => array(
        'sTableName'  => 'd3_extsearch_synset',
        'sFieldName'  => 'USEFORATTRIBUTES',
        'sType'       => 'TINYINT(1)',
        'blNull'      => false,
        'sDefault'    => '0',
        'sComment'    => 'synonym will used for attribute filters',
        'sExtra'      => '',
        'blMultilang' => false,
    ),
);

$this->aESSemanticIndizes = array(
    'SYNSET_PRIMARY'    => array(
        'sTableName'    => 'd3_extsearch_synset',
        'sType'         => d3database::INDEX_TYPE_PRIMARY,
        'aFields'       => array(
            'OXID'      => 'OXID',
        ),
        'blMultilang'   => false,
    ),
    'IS_VISIBLE'  => array(
        'sTableName'  => 'd3_extsearch_synset',
        'sType'   => '',
        'aFields' => array(
            'IS_VISIBLE' => 'IS_VISIBLE',
        ),
        'blMultilang' => false,
    ),
);

$this->aESSemanticRenameFields = array(
    'SYNSET_OXID'        => array(
        'sTableName'  => 'd3_extsearch_synset',
        'mOldFieldNames' => array('id', 'ID', 'oxid'), // is case sensitive
        'sFieldName'  => 'OXID',
        'blMultilang' => false,
    ),
    'SYNSET_ISVISIBLE'        => array(
        'sTableName'  => 'd3_extsearch_synset',
        'mOldFieldNames' => array('is_visible'), // is case sensitive
        'sFieldName'  => 'IS_VISIBLE',
        'blMultilang' => false,
    ),
    'SYNSET_USER_COMMENT'        => array(
        'sTableName'  => 'd3_extsearch_synset',
        'mOldFieldNames' => array('user_comment'), // is case sensitive
        'sFieldName'  => 'USER_COMMENT',
        'blMultilang' => false,
    ),
);

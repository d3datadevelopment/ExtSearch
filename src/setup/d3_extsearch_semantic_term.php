<?php

use D3\ModCfg\Application\Model\d3database;

$this->aESSemanticTables = array(
    'd3_extsearch_term'  => array(
        'sName'     => 'd3_extsearch_term',
        'sType'     => 'MyISAM',
        'sComment'  => '',
    ),
);

$this->aESSemanticFields = array(
    'D3SYN_TERM_OXID'    => array(
        'sTableName'  => 'd3_extsearch_term',
        'sFieldName'  => 'OXID',
        'sType'       => 'CHAR(32)',
        'blNull'      => false,
        'sDefault'    => false,
        'sComment'    => '',
        'sExtra'      => '',
        'blMultilang' => false,
    ),
    'D3SYN_TERM_LANGUAGE_ID'    => array(
        'sTableName'  => 'd3_extsearch_term',
        'sFieldName'  => 'LANGUAGE_ID',
        'sType'       => 'CHAR(32)',
        'blNull'      => false,
        'sDefault'    => false,
        'sComment'    => '',
        'sExtra'      => '',
        'blMultilang' => false,
    ),
    'D3SYN_TERM_SYNSET_ID'    => array(
        'sTableName'  => 'd3_extsearch_term',
        'sFieldName'  => 'SYNSET_ID',
        'sType'       => 'CHAR(32)',
        'blNull'      => false,
        'sDefault'    => false,
        'sComment'    => '',
        'sExtra'      => '',
        'blMultilang' => false,
    ),
    'D3SYN_TERM_USER_COMMENT'    => array(
        'sTableName'  => 'd3_extsearch_term',
        'sFieldName'  => 'USER_COMMENT',
        'sType'       => 'VARCHAR(255)',
        'blNull'      => true,
        'sDefault'    => false,
        'sComment'    => '',
        'sExtra'      => '',
        'blMultilang' => false,
    ),
    'D3SYN_TERM_WORD'    => array(
        'sTableName'  => 'd3_extsearch_term',
        'sFieldName'  => 'WORD',
        'sType'       => 'VARCHAR(255)',
        'blNull'      => false,
        'sDefault'    => false,
        'sComment'    => '',
        'sExtra'      => '',
        'blMultilang' => false,
    ),
    'D3SYN_TERM_D3_PHONETIC'    => array(
        'sTableName'  => 'd3_extsearch_term',
        'sFieldName'  => 'D3_PHONETIC',
        'sType'       => 'VARCHAR(255)',
        'blNull'      => false,
        'sDefault'    => false,
        'sComment'    => '',
        'sExtra'      => '',
        'blMultilang' => false,
    ),
);

$this->aESSemanticIndizes = array(
    'D3TERM_PRIMARY'  => array(
        'sTableName'  => 'd3_extsearch_term',
        'sType'     => d3database::INDEX_TYPE_PRIMARY,
        'aFields'   => array(
            'OXID' => 'OXID',
        ),
        'blMultilang' => false,
    ),
    'FK36446CA3843755'  => array(
        'sTableName'  => 'd3_extsearch_term',
        'sType'   => '',
        'sName'     => 'FK36446CA3843755',
        'aFields' => array(
            'SYNSET_ID' => 'SYNSET_ID',
        ),
        'blMultilang' => false,
    ),
    'FK36446C5CA8CBD5'  => array(
        'sTableName'  => 'd3_extsearch_term',
        'sType'   => '',
        'sName'     => 'FK36446C5CA8CBD5',
        'aFields' => array(
            'LANGUAGE_ID' => 'LANGUAGE_ID',
        ),
        'blMultilang' => false,
    ),
    'WORD'  => array(
        'sTableName'  => 'd3_extsearch_term',
        'sType'   => '',
        'aFields' => array(
            'WORD' => 'WORD',
        ),
        'blMultilang' => false,
    ),
    'D3_PHONETIC'  => array(
        'sTableName'  => 'd3_extsearch_term',
        'sType'   => '',
        'aFields' => array(
            'D3_PHONETIC' => 'D3_PHONETIC',
        ),
        'blMultilang' => false,
    ),
);

$this->aESSemanticRenameFields = array(
    'TERM_OXID'        => array(
        'sTableName'  => 'd3_extsearch_term',
        'mOldFieldNames' => array('id', 'ID', 'oxid'), // is case sensitive
        'sFieldName'  => 'OXID',
        'blMultilang' => false,
    ),
    'TERM_LANGUAGEID'        => array(
        'sTableName'  => 'd3_extsearch_term',
        'mOldFieldNames' => array('language_id'), // is case sensitive
        'sFieldName'  => 'LANGUAGE_ID',
        'blMultilang' => false,
    ),
    'TERM_SYNSETID'        => array(
        'sTableName'  => 'd3_extsearch_term',
        'mOldFieldNames' => array('synset_id'), // is case sensitive
        'sFieldName'  => 'SYNSET_ID',
        'blMultilang' => false,
    ),
    'TERM_USERCOMMENT'        => array(
        'sTableName'  => 'd3_extsearch_term',
        'mOldFieldNames' => array('user_comment'), // is case sensitive
        'sFieldName'  => 'USER_COMMENT',
        'blMultilang' => false,
    ),
    'TERM_WORD'        => array(
        'sTableName'  => 'd3_extsearch_term',
        'mOldFieldNames' => array('word'), // is case sensitive
        'sFieldName'  => 'WORD',
        'blMultilang' => false,
    ),
    'TERM_D3PHONETIC'        => array(
        'sTableName'  => 'd3_extsearch_term',
        'mOldFieldNames' => array('d3_phonetic'), // is case sensitive
        'sFieldName'  => 'D3_PHONETIC',
        'blMultilang' => false,
    ),
);

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

$this->aESStatisticTables = [
    'd3_extsearch_term'  => [
        'sName'     => 'd3_extsearch_statisticlog',
        'sType'     => 'InnoDb',
        'sComment'  => 'extSearch statistic log',
    ],
];

$this->aESStatisticFields = [
    'OXID'          => [
        'sTableName'  => 'd3_extsearch_statisticlog',
        'sFieldName'  => 'OXID',
        'sType'       => 'CHAR(32)',
        'blNull'      => false,
        'sDefault'    => false,
        'sComment'    => '',
        'sExtra'      => '',
        'blMultilang' => false,
    ],
    'OXTIME'          => [
        'sTableName'  => 'd3_extsearch_statisticlog',
        'sFieldName'  => 'OXTIME',
        'sType'       => 'DATETIME',
        'blNull'      => false,
        'sDefault'    => '0000-00-00 00:00:00',
        'sComment'    => 'Creation Time',
        'sExtra'      => '',
        'blMultilang' => false,
    ],
    'OXSHOPID'        => [
        'sTableName'  => 'd3_extsearch_statisticlog',
        'sFieldName'  => 'OXSHOPID',
        'sType'       => 'CHAR(32)',
        'blNull'      => false,
        'sDefault'    => false,
        'sComment'    => 'Shop Id (oxshops)',
        'sExtra'      => '',
        'blMultilang' => false,
    ],
    'OXUSERID'        => [
        'sTableName'  => 'd3_extsearch_statisticlog',
        'sFieldName'  => 'OXUSERID',
        'sType'       => 'CHAR(32)',
        'blNull'      => true,
        'sDefault'    => false,
        'sComment'    => 'User Id (oxuser)',
        'sExtra'      => '',
        'blMultilang' => false,
    ],
    'OXSESSID'        => [
        'sTableName'  => 'd3_extsearch_statisticlog',
        'sFieldName'  => 'OXSESSID',
        'sType'       => 'CHAR(32)',
        'blNull'      => true,
        'sDefault'    => false,
        'sComment'    => 'Session Id',
        'sExtra'      => '',
        'blMultilang' => false,
    ],
    'OXLANG'        => [
        'sTableName'  => 'd3_extsearch_statisticlog',
        'sFieldName'  => 'OXLANG',
        'sType'       => 'CHAR(32)',
        'blNull'      => false,
        'sDefault'    => false,
        'sComment'    => 'Session Id',
        'sExtra'      => '',
        'blMultilang' => false,
    ],
    'OXSEARCHPARAM'   => [
        'sTableName'  => 'd3_extsearch_statisticlog',
        'sFieldName'  => 'OXSEARCHPARAM',
        'sType'       => 'VARCHAR(255)',
        'blNull'      => false,
        'sDefault'    => false,
        'sComment'    => 'Search Parameters',
        'sExtra'      => '',
        'blMultilang' => false,
    ],
    'OXPARAMETER'            => [
        'sTableName'  => 'd3_extsearch_statisticlog',
        'sFieldName'  => 'OXPARAMETER',
        'sType'       => 'VARCHAR(255)',
        'blNull'      => false,
        'sDefault'    => false,
        'sComment'    => 'additional Search Parameters',
        'sExtra'      => '',
        'blMultilang' => false,
    ],
    'D3COUNT'         => [
        'sTableName'  => 'd3_extsearch_statisticlog',
        'sFieldName'  => 'D3COUNT',
        'sType'       => 'INT(5)',
        'blNull'      => false,
        'sDefault'    => '0',
        'sComment'    => 'Article Count',
        'sExtra'      => '',
        'blMultilang' => false,
    ],
    'OXTIMESTAMP'     => [
        'sTableName'  => 'd3_extsearch_statisticlog',
        'sFieldName'  => 'OXTIMESTAMP',
        'sType'       => 'TIMESTAMP',
        'blNull'      => false,
        'sDefault'    => 'CURRENT_TIMESTAMP',
        'sComment'    => 'Timestamp',
        'sExtra'      => '',
        'blMultilang' => false,
    ],
];

$this->aESStatisticIndizes = [
    'OXID'          => [
        'sTableName'  => 'd3_extsearch_statisticlog',
        'sType'       => d3database::INDEX_TYPE_PRIMARY,
        'aFields'     => [
            'OXID'    => 'OXID',
        ],
    ],
    'OXTIME'          => [
        'sTableName'  => 'd3_extsearch_statisticlog',
        'sType'       => '',
        'sName'       => 'OXTIME',
        'aFields'     => [
            'OXTIME'  => 'OXTIME',
        ],
    ],
    'OXSHOPID'        => [
        'sTableName'  => 'd3_extsearch_statisticlog',
        'sType'       => '',
        'sName'       => 'OXSHOPID',
        'aFields'     => [
            'OXSHOPID'=> 'OXSHOPID',
        ],
    ],
    'OXLANG'          => [
        'sTableName'  => 'd3_extsearch_statisticlog',
        'sType'       => '',
        'sName'       => 'OXLANG',
        'aFields'     => [
            'OXLANG'  => 'OXLANG',
        ],
    ],
    'OXSEARCHPARAM'   => [
        'sTableName'  => 'd3_extsearch_statisticlog',
        'sType'       => '',
        'sName'       => 'OXSEARCHPARAM',
        'aFields'     => [
            'OXSEARCHPARAM'  => 'OXSEARCHPARAM',
        ],
    ],
    'D3COUNT'         => [
        'sTableName'  => 'd3_extsearch_statisticlog',
        'sType'       => '',
        'sName'       => 'D3COUNT',
        'aFields'     => [
            'D3COUNT' => 'D3COUNT',
        ],
    ],
];

$this->aStatisticTables = array_merge($this->aStatisticTables ?? [], $this->aESStatisticTables ?? []);
$this->aFields = array_merge($this->aFields ?? [], $this->aESStatisticFields ?? []);
$this->aIndizes = array_merge($this->aIndizes ?? [], $this->aESStatisticIndizes ?? []);
$this->aRenameFields = array_merge($this->aRenameFields ?? [], $this->aESStatisticRenameFields ?? []);

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

$this->aA2OFields = [
    'D3A2O_OXID'    => [
        'sTableName'  => 'd3extsearch_attribute2object',
        'sFieldName'  => 'OXID',
        'sType'       => 'CHAR(32)',
        'blNull'      => false,
        'sDefault'    => false,
        'sComment'    => 'Record id',
        'sExtra'      => '',
        'blMultilang' => false,
    ],
    'D3A2O_OXATTRIBUTEID'    => [
        'sTableName'  => 'd3extsearch_attribute2object',
        'sFieldName'  => 'OXATTRIBUTEID',
        'sType'       => 'CHAR(32)',
        'blNull'      => false,
        'sDefault'    => false,
        'sComment'    => 'Attribute id (oxattribute)',
        'sExtra'      => '',
        'blMultilang' => false,
    ],
    'D3A2O_OXOBJECTID'    => [
        'sTableName'  => 'd3extsearch_attribute2object',
        'sFieldName'  => 'OXOBJECTID',
        'sType'       => 'CHAR(32)',
        'blNull'      => false,
        'sDefault'    => false,
        'sComment'    => 'Object id (table determined by oxtype)',
        'sExtra'      => '',
        'blMultilang' => false,
    ],
    'D3A2O_OXTYPE'    => [
        'sTableName'  => 'd3extsearch_attribute2object',
        'sFieldName'  => 'OXTYPE',
        'sType'       => 'CHAR(32)',
        'blNull'      => false,
        'sDefault'    => false,
        'sComment'    => 'Record type',
        'sExtra'      => '',
        'blMultilang' => false,
    ],
    'D3A2O_OXTIMESTAMP'            => [
        'sTableName'  => 'd3extsearch_attribute2object',
        'sFieldName'  => 'OXTIMESTAMP',
        'sType'       => 'TIMESTAMP',
        'blNull'      => false,
        'sDefault'    => 'CURRENT_TIMESTAMP',
        'sComment'    => 'Timestamp',
        'sExtra'      => '',
        'blMultilang' => false,
    ],
];

$this->aA2OIndizes = [
    'D3A2O_PRIMARY' => [
        'sTableName' => 'd3extsearch_attribute2object',
        'sType'      => 'PRIMARY',
        'sName'      => 'PRIMARY',
        'aFields'    => [
            'OXID' => 'OXID',
        ],
        'blMultilang' => false,
    ],
    'D3A2O_OXOBJECTID' => [
        'sTableName' => 'd3extsearch_attribute2object',
        'sType'      => '',
        'sName'      => 'OXOBJECTID',
        'aFields'    => [
            'OXOBJECTID' => 'OXOBJECTID',
        ],
        'blMultilang' => false,
    ],
    'D3A2O_OXATTRIBUTEID' => [
        'sTableName' => 'd3extsearch_attribute2object',
        'sType'      => '',
        'sName'      => 'OXATTRIBUTEID',
        'aFields'    => [
            'OXATTRIBUTEID' => 'OXATTRIBUTEID',
        ],
        'blMultilang' => false,
    ],
    'D3A2O_ObjectType' => [
        'sTableName' => 'd3extsearch_attribute2object',
        'sType'      => '',
        'sName'      => 'ObjectType',
        'aFields'    => [
            'OXOBJECTID' => 'OXOBJECTID',
            'OXTYPE' => 'OXTYPE',
        ],
        'blMultilang' => false,
    ],
];

$this->aFields = is_array($this->aFields) ? array_merge($this->aFields, $this->aA2OFields) : $this->aA2OFields;
$this->aIndizes = is_array($this->aIndizes) ? array_merge($this->aIndizes, $this->aA2OIndizes) : $this->aA2OIndizes;

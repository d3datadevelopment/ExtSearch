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

$this->aA2OFields = array(
    'D3A2O_OXID'    => array(
        'sTableName'  => 'd3extsearch_attribute2object',
        'sFieldName'  => 'OXID',
        'sType'       => 'CHAR(32)',
        'blNull'      => false,
        'sDefault'    => false,
        'sComment'    => 'Record id',
        'sExtra'      => '',
        'blMultilang' => false,
    ),
    'D3A2O_OXATTRIBUTEID'    => array(
        'sTableName'  => 'd3extsearch_attribute2object',
        'sFieldName'  => 'OXATTRIBUTEID',
        'sType'       => 'CHAR(32)',
        'blNull'      => false,
        'sDefault'    => false,
        'sComment'    => 'Attribute id (oxattribute)',
        'sExtra'      => '',
        'blMultilang' => false,
    ),
    'D3A2O_OXOBJECTID'    => array(
        'sTableName'  => 'd3extsearch_attribute2object',
        'sFieldName'  => 'OXOBJECTID',
        'sType'       => 'CHAR(32)',
        'blNull'      => false,
        'sDefault'    => false,
        'sComment'    => 'Object id (table determined by oxtype)',
        'sExtra'      => '',
        'blMultilang' => false,
    ),
    'D3A2O_OXTYPE'    => array(
        'sTableName'  => 'd3extsearch_attribute2object',
        'sFieldName'  => 'OXTYPE',
        'sType'       => 'CHAR(32)',
        'blNull'      => false,
        'sDefault'    => false,
        'sComment'    => 'Record type',
        'sExtra'      => '',
        'blMultilang' => false,
    ),
    'D3A2O_OXTIMESTAMP'            => array(
        'sTableName'  => 'd3extsearch_attribute2object',
        'sFieldName'  => 'OXTIMESTAMP',
        'sType'       => 'TIMESTAMP',
        'blNull'      => false,
        'sDefault'    => 'CURRENT_TIMESTAMP',
        'sComment'    => 'Timestamp',
        'sExtra'      => '',
        'blMultilang' => false,
    )
);

$this->aA2OIndizes = array(
    'D3A2O_PRIMARY' => array(
        'sTableName' => 'd3extsearch_attribute2object',
        'sType'      => 'PRIMARY',
        'sName'      => 'PRIMARY',
        'aFields'    => array(
            'OXID' => 'OXID',
        ),
        'blMultilang' => false,
    ),
    'D3A2O_OXOBJECTID' => array(
        'sTableName' => 'd3extsearch_attribute2object',
        'sType'      => '',
        'sName'      => 'OXOBJECTID',
        'aFields'    => array(
            'OXOBJECTID' => 'OXOBJECTID',
        ),
        'blMultilang' => false,
    ),
    'D3A2O_OXATTRIBUTEID' => array(
        'sTableName' => 'd3extsearch_attribute2object',
        'sType'      => '',
        'sName'      => 'OXATTRIBUTEID',
        'aFields'    => array(
            'OXATTRIBUTEID' => 'OXATTRIBUTEID',
        ),
        'blMultilang' => false,
    ),
    'D3A2O_ObjectType' => array(
        'sTableName' => 'd3extsearch_attribute2object',
        'sType'      => '',
        'sName'      => 'ObjectType',
        'aFields'    => array(
            'OXOBJECTID' => 'OXOBJECTID',
            'OXTYPE' => 'OXTYPE',
        ),
        'blMultilang' => false,
    ),
);

$this->aFields = is_array($this->aFields) ? array_merge($this->aFields, $this->aA2OFields) : $this->aA2OFields;
$this->aIndizes = is_array($this->aIndizes) ? array_merge($this->aIndizes, $this->aA2OIndizes) : $this->aA2OIndizes;

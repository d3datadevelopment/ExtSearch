<?php

use D3\ModCfg\Application\Model\d3database;

$this->aESStatisticTables = array(
    'd3_extsearch_term'  => array(
        'sName'     => 'd3_extsearch_statisticlog',
        'sType'     => 'InnoDb',
        'sComment'  => 'extSearch statistic log',
    ),
);

$this->aESStatisticFields = array(
    'OXID'          => array(
        'sTableName'  => 'd3_extsearch_statisticlog',
        'sFieldName'  => 'OXID',
        'sType'       => 'CHAR(32)',
        'blNull'      => false,
        'sDefault'    => false,
        'sComment'    => '',
        'sExtra'      => '',
        'blMultilang' => false,
    ),
    'OXTIME'          => array(
        'sTableName'  => 'd3_extsearch_statisticlog',
        'sFieldName'  => 'OXTIME',
        'sType'       => 'DATETIME',
        'blNull'      => false,
        'sDefault'    => '0000-00-00 00:00:00',
        'sComment'    => 'Creation Time',
        'sExtra'      => '',
        'blMultilang' => false,
    ),
    'OXSHOPID'        => array(
        'sTableName'  => 'd3_extsearch_statisticlog',
        'sFieldName'  => 'OXSHOPID',
        'sType'       => 'CHAR(32)',
        'blNull'      => false,
        'sDefault'    => false,
        'sComment'    => 'Shop Id (oxshops)',
        'sExtra'      => '',
        'blMultilang' => false,
    ),
    'OXUSERID'        => array(
        'sTableName'  => 'd3_extsearch_statisticlog',
        'sFieldName'  => 'OXUSERID',
        'sType'       => 'CHAR(32)',
        'blNull'      => true,
        'sDefault'    => false,
        'sComment'    => 'User Id (oxuser)',
        'sExtra'      => '',
        'blMultilang' => false,
    ),
    'OXSESSID'        => array(
        'sTableName'  => 'd3_extsearch_statisticlog',
        'sFieldName'  => 'OXSESSID',
        'sType'       => 'CHAR(32)',
        'blNull'      => true,
        'sDefault'    => false,
        'sComment'    => 'Session Id',
        'sExtra'      => '',
        'blMultilang' => false,
    ),
    'OXLANG'        => array(
        'sTableName'  => 'd3_extsearch_statisticlog',
        'sFieldName'  => 'OXLANG',
        'sType'       => 'CHAR(32)',
        'blNull'      => false,
        'sDefault'    => false,
        'sComment'    => 'Session Id',
        'sExtra'      => '',
        'blMultilang' => false,
    ),
    'OXSEARCHPARAM'   => array(
        'sTableName'  => 'd3_extsearch_statisticlog',
        'sFieldName'  => 'OXSEARCHPARAM',
        'sType'       => 'VARCHAR(255)',
        'blNull'      => false,
        'sDefault'    => false,
        'sComment'    => 'Search Parameters',
        'sExtra'      => '',
        'blMultilang' => false,
    ),
    'OXPARAMETER'            => array(
        'sTableName'  => 'd3_extsearch_statisticlog',
        'sFieldName'  => 'OXPARAMETER',
        'sType'       => 'VARCHAR(255)',
        'blNull'      => false,
        'sDefault'    => false,
        'sComment'    => 'additional Search Parameters',
        'sExtra'      => '',
        'blMultilang' => false,
    ),
    'D3COUNT'         => array(
        'sTableName'  => 'd3_extsearch_statisticlog',
        'sFieldName'  => 'D3COUNT',
        'sType'       => 'INT(5)',
        'blNull'      => false,
        'sDefault'    => '0',
        'sComment'    => 'Article Count',
        'sExtra'      => '',
        'blMultilang' => false,
    ),
    'OXTIMESTAMP'     => array(
        'sTableName'  => 'd3_extsearch_statisticlog',
        'sFieldName'  => 'OXTIMESTAMP',
        'sType'       => 'TIMESTAMP',
        'blNull'      => false,
        'sDefault'    => 'CURRENT_TIMESTAMP',
        'sComment'    => 'Timestamp',
        'sExtra'      => '',
        'blMultilang' => false,
    ),
);

$this->aESStatisticIndizes = array(
    'OXID'          => array(
        'sTableName'  => 'd3_extsearch_statisticlog',
        'sType'       => d3database::INDEX_TYPE_PRIMARY,
        'aFields'     => array(
            'OXID'    => 'OXID',
        ),
    ),
    'OXTIME'          => array(
        'sTableName'  => 'd3_extsearch_statisticlog',
        'sType'       => '',
        'sName'       => 'OXTIME',
        'aFields'     => array(
            'OXTIME'  => 'OXTIME',
        ),
    ),
    'OXSHOPID'        => array(
        'sTableName'  => 'd3_extsearch_statisticlog',
        'sType'       => '',
        'sName'       => 'OXSHOPID',
        'aFields'     => array(
            'OXSHOPID'=> 'OXSHOPID',
        ),
    ),
    'OXLANG'          => array(
        'sTableName'  => 'd3_extsearch_statisticlog',
        'sType'       => '',
        'sName'       => 'OXLANG',
        'aFields'     => array(
            'OXLANG'  => 'OXLANG',
        ),
    ),
    'OXSEARCHPARAM'   => array(
        'sTableName'  => 'd3_extsearch_statisticlog',
        'sType'       => '',
        'sName'       => 'OXSEARCHPARAM',
        'aFields'     => array(
            'OXSEARCHPARAM'  => 'OXSEARCHPARAM',
        ),
    ),
    'D3COUNT'         => array(
        'sTableName'  => 'd3_extsearch_statisticlog',
        'sType'       => '',
        'sName'       => 'D3COUNT',
        'aFields'     => array(
            'D3COUNT' => 'D3COUNT',
        ),
    ),
);

$this->aESStatisticRenameFields = array();

if (isset($this->aESStatisticTables)
    && is_array($this->aESStatisticTables)
    && count($this->aESStatisticTables)
) {
    $this->aStatisticTables = is_array($this->aStatisticTables) ? array_merge($this->aStatisticTables, $this->aESStatisticTables) : $this->aStatisticTables;
}

if (isset($this->aESStatisticFields)
    && is_array($this->aESStatisticFields)
    && count($this->aESStatisticFields)
) {
    $this->aFields = is_array($this->aFields) ? array_merge($this->aFields, $this->aESStatisticFields) : $this->aESStatisticFields;
}

if (isset($this->aESStatisticIndizes)
    && is_array($this->aESStatisticIndizes)
    && count($this->aESStatisticIndizes)
) {
    $this->aIndizes = is_array($this->aIndizes) ? array_merge($this->aIndizes, $this->aESStatisticIndizes) : $this->aESStatisticIndizes;
}

if (isset($this->aESStatisticRenameFields)
    && is_array($this->aESStatisticRenameFields)
    && count($this->aESStatisticRenameFields)
) {
    $this->aRenameFields = is_array($this->aRenameFields) ? array_merge($this->aRenameFields, $this->aESStatisticRenameFields) : $this->aESStatisticRenameFields;
}

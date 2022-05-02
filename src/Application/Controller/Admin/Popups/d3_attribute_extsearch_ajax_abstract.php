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

namespace D3\Extsearch\Application\Controller\Admin\Popups;

use D3\Extsearch\Application\Model\d3extsearch_attribute2object;
use Exception;
use OxidEsales\Eshop\Application\Controller\Admin\ListComponentAjax;
use OxidEsales\Eshop\Application\Model\Attribute;
use OxidEsales\Eshop\Core\DatabaseProvider;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Model\BaseModel;
use OxidEsales\Eshop\Core\Model\MultiLanguageModel;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;

abstract class d3_attribute_extsearch_ajax_abstract extends ListComponentAjax
{
    public abstract function getObjectModel();

    public abstract function getLeftColumnTitle();

    public abstract function getRightColumnTitle();

    public abstract function getObjectIdField();

    public abstract function getContainerKey();

    /**
     * @return string
     */
    public function getTplName()
    {
        return "d3_attribute_extsearch_ajax.tpl";
    }

    /**
     * @return string
     * @throws DatabaseConnectionException
     */
    protected function _getQuery()
    {
        $oDb = DatabaseProvider::getDb();
        $oRequest = Registry::get(Request::class);
        $sId = $oRequest->getRequestEscapedParameter('oxid');
        $sSynchId = $oRequest->getRequestEscapedParameter('synchoxid');

        /** @var MultiLanguageModel $oObject */
        $oObject = oxNew($this->getObjectModel());
        $sObjectTable = $oObject->getViewName();

        $oA2O = oxNew(d3extsearch_attribute2object::class);
        $sA2OTable = $oA2O->getViewName();

        if (!$sId) {
            $sQAdd = " from {$sObjectTable}";
        } else {
            $sQAdd = " from {$sA2OTable}, {$sObjectTable} " .
                     "where {$sObjectTable}.oxid={$sA2OTable}.oxobjectid " .
                     " and {$sA2OTable}.oxattributeid = " . $oDb->quote($sId) .
                     " and {$sA2OTable}.oxtype = '{$oObject->getCoreTableName()}' ";
        }

        if ($sSynchId && $sSynchId != $sId) {
            // performance
            $sSubSelect = " select {$sObjectTable}.oxid from {$sA2OTable}, {$sObjectTable} " .
                          "where {$sObjectTable}.oxid={$sA2OTable}.oxobjectid " .
                          " and {$sA2OTable}.oxattributeid = " . $oDb->quote($sSynchId) .
                          " and {$sA2OTable}.oxtype = '{$oObject->getCoreTableName()}' ";
            if (stristr($sQAdd, 'where') === false) {
                $sQAdd .= ' where ';
            } else {
                $sQAdd .= ' and ';
            }
            $sQAdd .= " {$sObjectTable}.oxid not in ( $sSubSelect ) ";
        }

        return $sQAdd;
    }

    /**
     * Removes selected items from list
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function removeAttributeObject()
    {
        $oRequest = Registry::get(Request::class);
        $aChosenObjects = $this->_getActionIds('d3extsearch_attribute2object.oxid');

        $oA2O = oxNew(d3extsearch_attribute2object::class);
        $sA2OTable = $oA2O->getViewName();

        /** @var Attribute $oAttribute */
        $oAttribute = oxNew(Attribute::class);
        $oAttribute->setId($oRequest->getRequestEscapedParameter('oxid'));
        if (method_exists($oAttribute, 'executeDependencyEvent')) {
            $oAttribute->executeDependencyEvent();
        }

        if ($oRequest->getRequestParameter('all')) {
            $sQ = $this->_addFilter("delete {$sA2OTable}.* " . $this->_getQuery());
            DatabaseProvider::getDb()->execute($sQ);
        } elseif (is_array($aChosenObjects)) {
            $sChosenObjects = implode(", ", DatabaseProvider::getDb()->quoteArray($aChosenObjects));
            $sQ = "delete from {$sA2OTable} where {$sA2OTable}.oxid in (" . $sChosenObjects . ") ";
            DatabaseProvider::getDb()->execute($sQ);
        }
    }

    /**
     * @throws DatabaseConnectionException
     * @throws Exception
     */
    public function addAttributeObject()
    {
        $oRequest = Registry::get(Request::class);
        $aChosenObjects = $this->_getActionIds($this->getObjectIdField());
        $soxId = $oRequest->getRequestEscapedParameter('synchoxid');

        /** @var Attribute $oAttribute */
        $oAttribute = oxNew(Attribute::class);
        $oAttribute->setId($soxId);
        if (method_exists($oAttribute, 'executeDependencyEvent')) {
            $oAttribute->executeDependencyEvent();
        }

        /** @var MultiLanguageModel $oObject */
        $oObject = oxNew($this->getObjectModel());

        if ($oRequest->getRequestEscapedParameter('all')) {
            $sObjectTable = $oObject->getViewName();
            $aChosenObjects = $this->_getAll($this->_addFilter("select $sObjectTable.oxid " . $this->_getQuery()));
        }

        if ($soxId && $soxId != "-1" && is_array($aChosenObjects)) {
            foreach ($aChosenObjects as $sChosenObject) {
                $oAssignment = oxNew(d3extsearch_attribute2object::class);
                $oAssignment->assign(
                    array(
                        'oxattributeid' => $soxId,
                        'oxobjectid'    => $sChosenObject,
                        'oxtype'        => $oObject->getCoreTableName()
                    )
                );
                $oAssignment->save();
            }
        }

        if (method_exists($oObject, 'executeDependencyEvent')) {
            $oObject->executeDependencyEvent($aChosenObjects);
        }
    }
}

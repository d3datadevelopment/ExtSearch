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

use D3\Extsearch\Application\Model\Constants;
use D3\Extsearch\Application\Model\d3extsearch_attribute2object;
use Exception;
use OxidEsales\Eshop\Application\Controller\Admin\ListComponentAjax;
use OxidEsales\Eshop\Application\Model\Attribute;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Model\MultiLanguageModel;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Database\ConnectionProviderInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

abstract class d3_attribute_extsearch_ajax_abstract extends ListComponentAjax
{
    abstract public function getObjectModel();

    abstract public function getLeftColumnTitle();

    abstract public function getRightColumnTitle();

    abstract public function getObjectIdField();

    abstract public function getContainerKey();

    /**
     * @return string
     */
    public function getTplName()
    {
        return '@'. Constants::OXID_MODULE_ID .'/admin/popups/d3_attribute_extsearch_ajax';
    }

    /**
     * @return string
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected function getQuery()
    {
        $connection = ContainerFactory::getInstance()->getContainer()->get(ConnectionProviderInterface::class)->get();
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
                     " and {$sA2OTable}.oxattributeid = " . $connection->quote($sId) .
                     " and {$sA2OTable}.oxtype = '{$oObject->getCoreTableName()}' ";
        }

        if ($sSynchId && $sSynchId != $sId) {
            // performance
            $sSubSelect = " select {$sObjectTable}.oxid from {$sA2OTable}, {$sObjectTable} " .
                          "where {$sObjectTable}.oxid={$sA2OTable}.oxobjectid " .
                          " and {$sA2OTable}.oxattributeid = " . $connection->quote($sSynchId) .
                          " and {$sA2OTable}.oxtype = '{$oObject->getCoreTableName()}' ";
            if (stristr($sQAdd, 'where') === false) {
                $sQAdd .= ' where ';
            } else {
                $sQAdd .= ' and ';
            }
            $sQAdd .= " {$sObjectTable}.oxid not in ( $sSubSelect ) ";
        }
        //dumpvar($sQAdd);
        //die();
        return $sQAdd;
    }

    /**
     * Removes selected items from list
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function removeAttributeObject()
    {
        $connection = ContainerFactory::getInstance()->getContainer()->get(ConnectionProviderInterface::class)->get();
        $oRequest = Registry::get(Request::class);
        $aChosenObjects = $this->getActionIds('d3extsearch_attribute2object.oxid');

        $oA2O = oxNew(d3extsearch_attribute2object::class);
        $sA2OTable = $oA2O->getViewName();

        /** @var Attribute $oAttribute */
        $oAttribute = oxNew(Attribute::class);
        $oAttribute->setId($oRequest->getRequestEscapedParameter('oxid'));
        if (method_exists($oAttribute, 'executeDependencyEvent')) {
            $oAttribute->executeDependencyEvent();
        }

        if ($oRequest->getRequestParameter('all')) {
            $sQ = $this->addFilter("delete {$sA2OTable}.* " . $this->getQuery());
            $connection->prepare($sQ)->executeStatement();
        } elseif (is_array($aChosenObjects)) {
            $sChosenObjects = implode(", ", array_map([$connection, 'quote'], $aChosenObjects));
            $sQ = "delete from {$sA2OTable} where {$sA2OTable}.oxid in (" . $sChosenObjects . ") ";
            $connection->prepare($sQ)->executeStatement();
        }
    }

    /**
     * @throws DatabaseConnectionException
     * @throws Exception
     */
    public function addAttributeObject()
    {
        $oRequest = Registry::get(Request::class);
        $aChosenObjects = $this->getActionIds($this->getObjectIdField());
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
            $aChosenObjects = $this->getAll($this->addFilter("select $sObjectTable.oxid " . $this->getQuery()));
        }

        if ($soxId && $soxId != "-1" && is_array($aChosenObjects)) {
            foreach ($aChosenObjects as $sChosenObject) {
                $oAssignment = oxNew(d3extsearch_attribute2object::class);
                $oAssignment->assign(
                    [
                        'oxattributeid' => $soxId,
                        'oxobjectid'    => $sChosenObject,
                        'oxtype'        => $oObject->getCoreTableName(),
                    ]
                );
                $oAssignment->save();
            }
        }

        if (method_exists($oObject, 'executeDependencyEvent')) {
            $oObject->executeDependencyEvent($aChosenObjects);
        }
    }
}

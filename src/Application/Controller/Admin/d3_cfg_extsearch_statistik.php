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

namespace D3\Extsearch\Application\Controller\Admin;

use D3\Extsearch\Application\Model\d3_extsearch_statisticlog;
use D3\Extsearch\Application\Model\d3_search;
use D3\ModCfg\Application\Controller\Admin\d3_cfg_mod_main;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use Doctrine\DBAL\DBALException;
use OeStatistics_Report_Base;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Model\BaseModel;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;
use OxidEsales\Eshop\Core\UtilsDate;
use OxidEsales\Eshop\Core\UtilsView;
use Smarty;
use stdClass;

class d3_cfg_extsearch_statistik extends d3_cfg_mod_main
{
    protected $_sThisTemplate = "d3_cfg_extsearch_statistik.tpl";
    protected $_sModId = 'd3_extsearch';
    public $aSearchwords = array();
    protected $_sHelpLinkMLAdd = 'D3_EXTSEARCH_HELPLINK_CONFIG';

    protected $_sMenuItemTitle = 'd3mxextsearch';

    protected $_sMenuSubItemTitle = 'd3mxextsearch_statistic';

    public $oD3OwnSearchHandler;

    /**
     * @return string
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     */
    public function render()
    {
        $sRet = parent::render();

        $this->addTplParam('aTimes', $this->_getAvailableLogTime());
        $this->addTplParam('aParams', Registry::get(Request::class)->getRequestEscapedParameter('statparams'));

        return $sRet;
    }

    /**
     * @return array
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    protected function _getAvailableLogTime()
    {
        $oStatistic = oxNew(d3_extsearch_statisticlog::class);
        return $oStatistic->getAvailableLogTime();
    }

    /**
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function generateStatList()
    {
        /** @var d3_extsearch_statisticlog $oStat */
        $oStat = oxNew(d3_extsearch_statisticlog::class);
        $oStatList = $oStat->getStatisticList();

        if ($oStatList && $oStatList->count()) {
            /** @var BaseModel $oStatItem */
            foreach ($oStatList as $oStatItem) {
                $sFilterKey = base64_encode($oStatItem->getFieldData('OXSEARCHPARAM')) .
                    substr(base64_encode($oStatItem->getFieldData('OXPARAMETER')), 0, 16) .
                    substr(base64_encode($oStatItem->getFieldData('OXPARAMETER')), -16, 16);

                $oSearchWord                     = new stdClass();
                $oSearchWord->sWord              = $oStatItem->getFieldData('OXSEARCHPARAM');
                $oSearchWord->iCount             = $oStatItem->getFieldData('COUNTER')  + $this->aSearchwords[$sFilterKey]->iCount;
                $oSearchWord->blGraph            = $oStatItem->getFieldData('GRAPH');
                $oSearchWord->aFilters           = $this->_extractFilters($oStatItem->getFieldData('OXPARAMETER'));
                $oSearchWord->sFilters           = $this->_exportFilters($oStatItem->getFieldData('OXPARAMETER'));
                $oSearchWord->iLang              = $oStatItem->getFieldData('OXLANG');
                $this->aSearchwords[$sFilterKey] = $oSearchWord;
            }
        }
    }

    /**
     * @param $sFilters
     * @return string
     */
    protected function _exportFilters($sFilters)
    {
        $aFilters = unserialize($sFilters);
        if (is_array($aFilters)) {
            return base64_encode($sFilters);
        }

        return '';
    }

    /**
     * @param $sFilters
     * @return array
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    protected function _extractFilters($sFilters)
    {
        $sFilters = html_entity_decode($sFilters);
        $aFilters = unserialize($sFilters);

        $oFilterList = $this->_d3GetOwnSearchHandler()->getFilterList();
        $aPreparedFilters = array();

        if (is_array($aFilters)) {
            foreach ($aFilters as $sType => $sValue) {
                $oFilter = $oFilterList->getFilterByStatisticLogId($sType);
                $aPreparedFilters[] = $oFilter->getStatisticLogFilterObject($sValue);
            }
        }

        return $aPreparedFilters;
    }

    /**
     * @return array
     */
    public function getStatList()
    {
        return $this->aSearchwords;
    }

    /**
     * @return bool
     */
    public function checkReportBaseClass()
    {
        return class_exists(OeStatistics_Report_Base::class);
    }

    public function generateStat()
    {
        if ($this->checkReportBaseClass()) {
            $aStatparams = Registry::get(Request::class)->getRequestEscapedParameter("statparams");
            $sTimeFrom = substr($aStatparams['time'], 0, 4) . "-" . substr($aStatparams['time'], 4, 2) . "-01";
            $timestamp = mktime(0, 0, 0, substr($aStatparams['time'], 4, 2), 1, substr($aStatparams['time'], 0, 4));
            $sTimeTo =
                substr($aStatparams['time'], 0, 4) . "-" . substr($aStatparams['time'], 4, 2) . "-" . date('t', $timestamp);

            if ($sTimeFrom && $sTimeTo) {
                $sTimeFrom = Registry::get(UtilsDate::class)->formatDBDate($sTimeFrom, true);
                $sTimeFrom = date("Y-m-d", strtotime($sTimeFrom));
                $sTimeTo = Registry::get(UtilsDate::class)->formatDBDate($sTimeTo, true);
                $sTimeTo = date("Y-m-d", strtotime($sTimeTo));
            } else {
                $dDays = Registry::get(Request::class)->getRequestEscapedParameter("timeframe");
                $dNow = time();
                $sTimeFrom = date("Y-m-d", mktime(0, 0, 0, date("m", $dNow), date("d", $dNow) - $dDays, date("Y", $dNow)));
                $sTimeTo = date("Y-m-d", time());
            }

            /** @var $oSmarty Smarty */
            $oSmarty = Registry::get(UtilsView::class)->getSmarty();
            $oSmarty->assign("time_from", $sTimeFrom . " 23:59:59");
            $oSmarty->assign("time_to", $sTimeTo . " 23:59:59");
            $oSmarty->assign("searchfilters", $aStatparams['searchparams']);
            $oSmarty->assign("oViewConf", $this->getViewDataElement("oViewConf"));

            echo($oSmarty->fetch("oestatistics_report_pagehead.tpl"));

            $aAllreports = array(
                'D3\Extsearch\Application\Controller\Admin\Reports\d3_extsearch_report_' . $aStatparams['type'],
            );

            foreach ($aAllreports as $FQCN) {
                if (($FQCN = trim($FQCN))) {
                    $sClassName = $FQCN;

                    $oReport = oxNew($sClassName);
                    $oReport->setSmarty($oSmarty);

                    $oSmarty->assign("oView", $oReport);
                    echo($oSmarty->fetch($oReport->render()));
                }
            }

            Registry::getUtils()->showMessageAndExit($oSmarty->fetch("oestatistics_report_bottomitem.tpl"));
        } else {
            echo Registry::getLang()->translateString('D3_EXTSEARCH_STAT_NOREPORTBASE');
        }
    }

    /**
     * @return array
     */
    public function getLangList()
    {
        return Registry::getLang()->getLanguageArray(null, true);
    }

    /**
     * performance, use a class wide instance
     *
     * @return d3_search
     */
    protected function _d3GetOwnSearchHandler()
    {
        if (!$this->oD3OwnSearchHandler) {
            $this->oD3OwnSearchHandler = oxNew(d3_search::class);
        }

        return $this->oD3OwnSearchHandler;
    }
}

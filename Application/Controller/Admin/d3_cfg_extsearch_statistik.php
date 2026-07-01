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

namespace D3\Extsearch\Application\Controller\Admin;

use D3\Extsearch\Application\Model\Constants;
use D3\Extsearch\Application\Model\d3_extsearch_statisticlog;
use D3\Extsearch\Application\Model\d3_search;
use D3\ModCfg\Application\Controller\Admin\d3_cfg_mod_main;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use Doctrine\DBAL\Exception as DBALException;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Model\BaseModel;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;
use stdClass;

class d3_cfg_extsearch_statistik extends d3_cfg_mod_main
{
    protected $_sThisTemplate = '@'. Constants::OXID_MODULE_ID .'/admin/d3_cfg_extsearch_statistik';
    protected $_sModId = 'd3_extsearch';
    public $aSearchwords = [];
    protected $_sHelpLinkMLAdd = 'D3_EXTSEARCH_HELPLINK_CONFIG';

    protected $_sMenuItemTitle = 'D3MXEXTSEARCH';

    protected $_sMenuSubItemTitle = 'D3MXEXTSEARCH_STATISTIC';

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

        if ($oStatList->count()) {
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
        $aPreparedFilters = [];

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

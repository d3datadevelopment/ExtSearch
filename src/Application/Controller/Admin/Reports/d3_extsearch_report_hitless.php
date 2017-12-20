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

namespace D3\Extsearch\Application\Controller\Admin\Reports;

use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;
use OxidEsales\Eshop\Core\TableViewNameGenerator;

if (false == class_exists(d3_extsearch_report_hitless::class)) {
    /**
     *
     */
    class d3_extsearch_report_hitless extends d3_extsearch_report_base
    {
        protected $_sThisTemplate = "d3_extsearch_report_hitless.tpl";
        public $aStatParams = array('type' => 'hitless');
        public $sTimeFrom;
        public $sTimeType = 'month';
        public $aFilters;

        /**
         * @return string
         */
        public function render()
        {
            $oSmarty = $this->getSmarty();
            $oSmarty->assign("aStats", array());

            $this->hitlessmonth();
            $this->hitlessyear();

            return parent::render();
        }

        public function hitlessmonth()
        {
            $aDataX = array();
            $aDataY = array();

            $oSmarty         = $this->getSmarty();
            $this->sTimeFrom = date("Ym", strtotime($oSmarty->_tpl_vars['time_from']));
            $this->sTimeType = 'month';
            $this->aFilters  = base64_decode(Registry::get(Request::class)->getRequestEscapedParameter('searchparams'));

            list($sSelect, $aParameters) = $this->getLogSubQuery(
                Registry::get(TableViewNameGenerator::class)->getViewName('d3_extsearch_statisticlog')
            );

            $aTemp   = $this->_getDataArray($sSelect, $aParameters, $this->_getLineCount());

            foreach ($aTemp as $key => $value) {
                $aDataX[$key] = $value;
                $aDataY[]     = $key;
            }

            $iMax      = $this->_getMaxValue($aDataX);
            $aAligns   = $this->_getAligns($iMax);
            $aDataVals = $this->_getDataVals($aDataX, $aDataY);

            if (count($aDataY) > 0) {
                $oSmarty->assign("drawStat", true);
            } else {
                $oSmarty->assign("drawStat", false);
            }

            $aSmartyVars = array(
                'sHeadline'   => sprintf(
                    Registry::getLang()->translateString('D3_EXTSEARCH_STAT_STATDESC_HITLESS'),
                    date("m.Y", strtotime($oSmarty->_tpl_vars['time_from'])),
                    Registry::get(Request::class)->getRequestEscapedParameter('searchword')
                ),
                'classes'     => array($aAligns),
                'allCols'     => count($aAligns) + 2,
                'cols'        => count($aAligns),
                'sSearchDate' => date("m.y", strtotime($oSmarty->_tpl_vars['time_from'])),
                'percents'    => array($aDataVals),
                'y'           => $aDataY,
                'sFilters'    => $this->FilterToString($this->aFilters),
            );

            $aStats = $oSmarty->_tpl_vars['aStats'];
            array_push($aStats, $aSmartyVars);
            $oSmarty->assign("aStats", $aStats);
        }

        public function hitlessyear()
        {
            $aDataX = array();
            $aDataY = array();

            $oSmarty         = $this->getSmarty();
            $this->sTimeFrom = date("Y", strtotime($oSmarty->_tpl_vars['time_from']));
            $this->sTimeType = 'year';
            $this->aFilters  = base64_decode(Registry::get(Request::class)->getRequestEscapedParameter('searchparams'));

            list($sSelect, $aParameters) = $this->getLogSubQuery(
                Registry::get(TableViewNameGenerator::class)->getViewName('d3_extsearch_statisticlog')
                );
            $aTemp   = $this->_getDataArray($sSelect, $aParameters, $this->_getLineCount());

            foreach ($aTemp as $key => $value) {
                $aDataX[$key] = $value;
                $aDataY[]     = $key;
            }

            $iMax      = $this->_getMaxValue($aDataX);
            $aAligns   = $this->_getAligns($iMax);
            $aDataVals = $this->_getDataVals($aDataX, $aDataY);

            if (count($aDataY) > 0) {
                $oSmarty->assign("drawStat", true);
            } else {
                $oSmarty->assign("drawStat", false);
            }

            $aSmartyVars = array(
                'sHeadline'   => sprintf(
                    Registry::getLang()->translateString("D3_EXTSEARCH_STAT_STATDESC_HITLESS"),
                    date("Y", strtotime($oSmarty->_tpl_vars['time_from'])),
                    Registry::get(Request::class)->getRequestEscapedParameter('searchword')
                ),
                'classes'     => array($aAligns),
                'allCols'     => count($aAligns) + 2,
                'cols'        => count($aAligns),
                'sSearchDate' => date("y", strtotime($oSmarty->_tpl_vars['time_from'])),
                'percents'    => array($aDataVals),
                'y'           => $aDataY,
                'sFilters'    => $this->FilterToString($this->aFilters),
            );

            $aStats = $oSmarty->_tpl_vars['aStats'];
            array_push($aStats, $aSmartyVars);
            $oSmarty->assign("aStats", $aStats);
        }
    }
}

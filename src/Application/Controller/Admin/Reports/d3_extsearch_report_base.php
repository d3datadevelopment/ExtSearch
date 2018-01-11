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

use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\DatabaseProvider;
use OxidEsales\Eshop\Core\Request;
use OxidEsales\Eshop\Application\Model\Category;
use OxidEsales\Eshop\Application\Model\Vendor;
use OxidEsales\Eshop\Application\Model\Manufacturer;
use OxidEsales\Eshop\Application\Model\Attribute;
use \OeStatistics_Report_Base;

class d3_extsearch_report_base extends OeStatistics_Report_Base
{
    public $aStatParams = array('type' => 'mostsearches');
    public $sTimeFrom;
    public $sTimeType = 'month';
    public $aFilters;

    /**
     * @param $sFrom
     * @return array
     */
    public function getLogSubQuery($sFrom)
    {
        $aParameters = array();
        $sTmpTableName = 'LogTable';

        $sSelect = "
                    SELECT";
        if ($this->aStatParams['type'] == 'hitless' || $this->aStatParams['type'] == 'mostsearches') {
            $sSelect .= "
                        count($sTmpTableName.oxsearchparam) as counter, ";
        }
        $sSelect .= "
                        $sTmpTableName.oxsearchparam,
                        $sTmpTableName.oxparameter,";

        if ($this->sTimeType == 'month') {
            $sSelect .= "
                        date_format($sTmpTableName.oxtime,'%d.') as searchdate,";
        } else {
            $sSelect .= "
                        date_format($sTmpTableName.oxtime,'%m.') as searchdate,";
        }

        if ($this->aStatParams['type'] == 'mosthits') {
            $sSelect .= "
                        $sTmpTableName.d3count as counter, ";
        }

        $sSelect .= "
                        $sTmpTableName.oxtime
                    FROM
                        $sFrom as $sTmpTableName
                    WHERE";

        if ($this->aStatParams['type'] == 'mosthits') {
            $sSelect .= "
                        $sTmpTableName.d3count != ? AND ";
            $aParameters[] = 0;
        } elseif ($this->aStatParams['type'] == 'hitless') {
            $sSelect .= "
                        $sTmpTableName.d3count = ? AND ";
            $aParameters[] = 0;
        }

        $sSelect .= "
                        $sTmpTableName.oxsearchparam = ? AND";
        $aParameters[] = Registry::get(Request::class)->getRequestEscapedParameter('searchword');
        $sSelect .= "
                        $sTmpTableName.oxlang = ? AND";
        $aParameters[] = Registry::get(Request::class)->getRequestEscapedParameter('lang');

        if (Registry::get(Request::class)->getRequestEscapedParameter('searchparams')) {
            $sSelect .= "
                        $sTmpTableName.oxparameter = ? AND";
            $aParameters[] = base64_decode(Registry::get(Request::class)->getRequestEscapedParameter('searchparams'));
        }

        if ($this->sTimeType == 'month') {
            $sSelect .= "
                        date_format($sTmpTableName.oxtime,'%Y%m') = ? AND";
            $aParameters[] = $this->sTimeFrom;
        } else {
            $sSelect .= "
                        date_format($sTmpTableName.oxtime,'%Y') = ? AND";
            $aParameters[] = $this->sTimeFrom;
        }

        $sSelect .= "
                        $sTmpTableName.oxshopid = ?";
        $aParameters[] = Registry::getConfig()->getShopId();

        $sSelect .= "
            GROUP BY";
        if ($this->sTimeType == 'month') {
            $sSelect .= "
                        date_format($sTmpTableName.oxtime, '%Y%m%d'),";
        } else {
            $sSelect .= "
                        date_format($sTmpTableName.oxtime, '%Y%m'),";
        }

        $sSelect .= "
                        $sTmpTableName.oxsearchparam,
                        $sTmpTableName.oxparameter
                    ORDER BY
                        counter DESC,
                        $sTmpTableName.oxsearchparam ASC
                ";

        return array($sSelect, $aParameters);
    }

    /**
     * @param $sSelect
     * @param $aParameters
     * @param $iLines
     * @return array
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    protected function _getDataArray($sSelect, $aParameters, $iLines)
    {
        $aTemp = array();
        for ($i = 1; $i <= $iLines; $i++) {
            $aTemp[date("d.", mktime(23, 59, 59, 01, $i, 1970))] = 0;
        }

        $aRecords = DatabaseProvider::getDb(DatabaseProvider::FETCH_MODE_ASSOC)->getAll($sSelect, $aParameters);
        if ($aRecords && is_array($aRecords) && count($aRecords)) {
            foreach ($aRecords as $aRecord) {
                $aRecord = array_change_key_case($aRecord, CASE_UPPER);
                if ($aRecord['COUNTER']) {
                    $aTemp[$aRecord['SEARCHDATE']] = (int)$aRecord['COUNTER'];
                }
            }
        }

        return $aTemp;
    }

    /**
     * @return int
     */
    protected function _getLineCount()
    {
        $iCount = 0;

        if ($this->sTimeType == 'month') {
            $iCount =
                date("t", mktime(23, 59, 59, substr($this->sTimeFrom, 4, 2), 01, substr($this->sTimeFrom, 0, 4)));
        } elseif ($this->sTimeType == 'year') {
            $iCount = 12;
        }

        return $iCount;
    }

    /**
     * @param $aDataX
     * @return int
     */
    protected function _getMaxValue($aDataX)
    {
        $iMax = 0;
        foreach ($aDataX as $sValue) {
            if ($iMax < (int)$sValue) {
                $iMax = (int)$sValue;
            }
        }

        return $iMax;
    }

    /**
     * @param $iMax
     * @return mixed
     */
    protected function _getAligns($iMax)
    {
        $aPoints      = array();
        $aPoints["0"] = 0;
        $aAligns["0"] = 'report_searchstrings_scale_aligns_left"';
        $iTenth       = strlen($iMax) - 1;
        if ($iTenth < 1) {
            $aPoints["" . (round(($iMax / 2))) . ""] = $iMax / 2;
            $aAligns["" . (round(($iMax / 2))) . ""] =
                'report_searchstrings_scale_aligns_center" width="' . (720 / 3) . '"';
            $aPoints["" . $iMax . ""]                = $iMax;
            $aAligns["" . $iMax . ""]                =
                'report_searchstrings_scale_aligns_right" width="' . (720 / 3) . '"';
        } else {
            $iScaleMax = $iMax;
            $ctr       = 0;
            for ($iCtr = 10; $iCtr > 0; $iCtr--) {
                $aPoints["" . (round(($ctr))) . ""] = $ctr += $iScaleMax / 10;
                $aAligns["" . (round(($ctr))) . ""] =
                    'report_searchstrings_scale_aligns_center" width="' . (720 / 10) . '"';
            }
            $aAligns["" . (round(($ctr))) . ""] = 'report_searchstrings_scale_aligns_right" width="' . (720 / 10) . '"';
        }

        $aAligns["0"] .= ' width="' . (720 / count($aAligns)) . '"';

        return $aAligns;
    }

    /**
     * @param $aDataX
     * @param $aDataY
     * @return array
     */
    protected function _getDataVals($aDataX, $aDataY)
    {
        $iMax      = $this->_getMaxValue($aDataX);
        $aDataVals = array();

        for ($iCtr = 0; $iCtr < count($aDataY); $iCtr++) {
            $aDataVals[$aDataY[$iCtr]] = round($aDataX[$iCtr] / $iMax * 100);
        }

        foreach ($aDataX as $sKey => $sValue) {
            $aDataVals{$sKey} = round($sValue / $iMax * 100);
        }

        return $aDataVals;
    }

    /**
     * @param $aFilters
     * @return array
     */
    protected function _extractFilters($aFilters)
    {
        $aFilters = unserialize($aFilters);

        $aPreparedFilters = array();

        if (is_array($aFilters)) {
            foreach ($aFilters as $sType => $sValue) {
                $oPreparedFilter = new \stdClass;

                switch ($sType) {
                    case "cat":
                        $oPreparedFilter->desc =
                            Registry::getLang()->translateString('D3_EXTSEARCH_STAT_TYPES_CATEGORY');
                        /** @var $oCategory Category */
                        $oCategory = oxNew(Category::class);
                        $oCategory->load($sValue);
                        /** @var Category $oParentCategory */
                        $oParentCategory = $oCategory->getParentCategory();
                        $oPreparedFilter->value = $oCategory->getFieldData('oxtitle') ?
                            '.../' . $oParentCategory->getFieldData('oxtitle') . '/' .
                                $oCategory->getFieldData('oxtitle') : $sValue;
                        break;
                    case "price":
                        $oPreparedFilter->desc  =
                            Registry::getLang()->translateString('D3_EXTSEARCH_STAT_TYPES_PRICE');
                        if (is_array($sValue)) {
                            $oPreparedFilter->value = http_build_query($sValue,'','; ');
                        } else {
                            $oPreparedFilter->value = $sValue;
                        }
                        break;
                    case "vnd":
                        $oPreparedFilter->desc =
                            Registry::getLang()->translateString('D3_EXTSEARCH_STAT_TYPES_VENDOR');
                        $oVendor               = oxNew(Vendor::class);
                        $oVendor->load($sValue);
                        $oPreparedFilter->value =
                            $oVendor->getFieldData('oxtitle') ? $oVendor->getFieldData('oxtitle') : $sValue;
                        break;
                    case "mnf":
                        $oPreparedFilter->desc =
                            Registry::getLang()->translateString('D3_EXTSEARCH_STAT_TYPES_MANUFACTURER');
                        $oManufacturer         = oxNew(Manufacturer::class);
                        $oManufacturer->load($sValue);
                        $oPreparedFilter->value =
                            $oManufacturer->getFieldData('oxtitle') ? $oManufacturer->getFieldData('oxtitle') : $sValue;
                        break;
                    case "ownlike":
                        $oPreparedFilter->desc  =
                            Registry::getLang()->translateString('D3_EXTSEARCH_STAT_TYPES_OWNLIKE');
                        $aFieldList = array();
                        if (is_array($sValue) && count($sValue)) {
                            foreach ($sValue as $sFieldName => $aFieldValue) {
                                if (count($aFieldValue) && strlen($aFieldValue[0])) {
                                    $aFieldList[] = sprintf(
                                        Registry::getLang()->translateString('D3_EXTSEARCH_STAT_TYPES_OWNVALUE'),
                                        $sFieldName,
                                        implode(', ', $aFieldValue)
                                    );
                                }
                            }
                        }
                        $oPreparedFilter->value = implode(nl2br(', '.PHP_EOL.'&nbsp;&nbsp;&nbsp;'), $aFieldList);
                        break;
                    case "ownis":
                        $oPreparedFilter->desc  =
                            Registry::getLang()->translateString('D3_EXTSEARCH_STAT_TYPES_OWNIS');
                        $aFieldList = array();
                        if (is_array($sValue) && count($sValue)) {
                            foreach ($sValue as $sFieldName => $aFieldValue) {
                                if (count($aFieldValue) && strlen($aFieldValue[0])) {
                                    $aFieldList[] =
                                        sprintf(
                                            Registry::getLang()->translateString('D3_EXTSEARCH_STAT_TYPES_OWNVALUE'),
                                            $sFieldName,
                                            implode(', ', $aFieldValue)
                                        );
                                }
                            }
                        }
                        $oPreparedFilter->value = implode(nl2br(', '.PHP_EOL.'&nbsp;&nbsp;&nbsp;'), $aFieldList);
                        break;
                    case "attr":
                        $oPreparedFilter->desc =
                            Registry::getLang()->translateString('D3_EXTSEARCH_STAT_TYPES_ATTRIBUTE');
                        if (is_array($sValue)) {
                            foreach ($sValue as $sAttrKey => $sAttribValue) {
                                $oAttribute = oxNew(Attribute::class);
                                $oAttribute->load($sAttrKey);
                                $oPreparedFilter->value .= $oAttribute->getFieldData('oxtitle') ?
                                    $oAttribute->getFieldData('oxtitle') :
                                    $sAttrKey;
                                $oPreparedFilter->value .= ': ' . $sAttribValue . "; ";
                            }
                        }
                        break;
                    case "lttr":
                        $oPreparedFilter->desc  =
                            Registry::getLang()->translateString('D3_EXTSEARCH_STAT_TYPES_INDEXLETTER');
                        $oPreparedFilter->value = strtolower($sValue);
                        break;
                    default:
                        $oPreparedFilter->desc  =
                            Registry::getLang()->translateString('D3_EXTSEARCH_STAT_TYPES_UNKNOWN');
                        $oPreparedFilter->value = $sValue;
                        break;
                }

                $aPreparedFilters[] = $oPreparedFilter;
            }
        }

        return $aPreparedFilters;
    }

    /**
     * @param $aFilters
     * @return string
     */
    protected function FilterToString($aFilters)
    {
        $aFilters        = $this->_extractFilters($aFilters);
        $aPreparedFilter = array();

        if (!isset($aFilters) || !is_array($aFilters) || !count($aFilters)) {
            return '';
        }

        foreach ($aFilters as $aFilter) {
            $aPreparedFilter[] = $aFilter->desc . ': ' . $aFilter->value;
        }

        return implode(', ', $aPreparedFilter);
    }
}

<?php

/**
 * This Software is the property of Data Development and is protected
 * by copyright law - it is NOT Freeware.
 * Any unauthorized use of this software without a valid license
 * is a violation of the license agreement and will be prosecuted by
 * civil and criminal law.
 * http://www.shopmodule.com
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author    D3 Data Development - Daniel Seifert <support@shopmodule.com>
 * @link      http://www.oxidmodule.com
 */

namespace D3\Extsearch\Modules\Application\Component;

use D3\Extsearch\Application\Model\d3_search;
use D3\Extsearch\Application\Model\Filters\d3Filter;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;

class d3_oxcmp_basket_extsearch extends d3_oxcmp_basket_extsearch_parent
{
    protected $_oOwnSearchHandler;
    /**
     * @return string
     */
    protected function _getRedirectUrl()
    {
        $sUrl       = parent::_getRedirectUrl();

        $aParamList = array();
        /** @var d3Filter $oFilter */
        foreach ($this->_d3getOwnSearchHandler()->getFilterList() as $oFilter) {
            if (false == $oFilter->isUsingSessionStorage()) {
                $aParamList = array_merge($aParamList, $oFilter->getRequestParameterNameList(true));
            }
        }
        $aParamList = array_unique($aParamList);

        $sAdd       = '';

        foreach ($aParamList as $sParam) {
            $mTransferParam = Registry::get(Request::class)->getRequestParameter($sParam);
            if ($mTransferParam) {
                if (is_array($mTransferParam)) {
                    foreach ($mTransferParam as $key => $value) {
                        $sAdd .= $sParam . '[' . $key . ']=' . $value . '&';
                    }
                } else {
                    $sAdd .= $sParam . '=' . Registry::get(Request::class)->getRequestParameter($sParam) . "&";
                }
            }
        }

        $sUrl .= $sAdd;

        return $sUrl;
    }

    /**
     * performance, use a class wide instance
     *
     * @return d3_search
     */
    protected function _d3getOwnSearchHandler()
    {
        if (!$this->_oOwnSearchHandler) {
            /** @var d3_search $oSearch */
            $oSearch = oxNew(d3_search::class);
            $this->_oOwnSearchHandler = $oSearch;
        }

        return $this->_oOwnSearchHandler;
    }
}

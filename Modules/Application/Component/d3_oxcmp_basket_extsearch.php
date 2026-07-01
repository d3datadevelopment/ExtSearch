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

namespace D3\Extsearch\Modules\Application\Component;

use D3\Extsearch\Application\Model\d3_search;
use D3\Extsearch\Application\Model\Filters\d3Filter;
use Doctrine\DBAL\Exception as DBALException;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;

class d3_oxcmp_basket_extsearch extends d3_oxcmp_basket_extsearch_parent
{
    protected $_oOwnSearchHandler;

    /**
     * @return string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    protected function getRedirectUrl(): string
    {
        $sUrl       = parent::getRedirectUrl();

        $aParamList = [];
        /** @var d3Filter $oFilter */
        foreach ($this->d3getOwnSearchHandler()->getFilterList() as $oFilter) {
            if (! $oFilter->isUsingSessionStorage()) {
                $aParamList = array_merge($aParamList, $oFilter->getRequestParameterNameList(true));
            }
        }
        $aParamList = array_unique($aParamList);

        $sAdd       = '';

        foreach ($aParamList as $sParam) {
            $mTransferParam = Registry::get(Request::class)->getRequestEscapedParameter($sParam);
            if ($mTransferParam) {
                if (is_array($mTransferParam)) {
                    foreach ($mTransferParam as $key => $value) {
                        $sAdd .= $sParam . '[' . $key . ']=' . $value . '&';
                    }
                } else {
                    $sAdd .= $sParam . '=' . Registry::get(Request::class)->getRequestEscapedParameter($sParam) . "&";
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
    protected function d3getOwnSearchHandler(): d3_search
    {
        if (!$this->_oOwnSearchHandler) {
            /** @var d3_search $oSearch */
            $oSearch = oxNew(d3_search::class);
            $this->_oOwnSearchHandler = $oSearch;
        }

        return $this->_oOwnSearchHandler;
    }
}

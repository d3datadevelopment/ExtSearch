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

namespace D3\Extsearch\Modules\Application\Controller;

use D3\Extsearch\Modules\Application\Model\d3_oxsearch_extsearch;
use D3\Extsearch\Application\Model\d3_search;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use Doctrine\DBAL\DBALException;
use OxidEsales\Eshop\Application\Model\Search;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;

class d3_rss_extsearch extends d3_rss_extsearch_parent
{
    /** @var d3_oxsearch_extsearch */
    public $oD3SearchHandler = null;
    /** @var d3_search */
    public $oD3OwnSearchHandler = null;
    protected $_aSelectedAttributes;
    protected $_sD3AdditionalParams = null;

    /**
     * performance, use a class wide instance
     *
     * @return d3_oxsearch_extsearch|Search
     */
    protected function _d3GetSearchHandler()
    {
        if (!$this->oD3SearchHandler) {
            $this->oD3SearchHandler = oxNew(Search::class);
        }

        return $this->oD3SearchHandler;
    }

    /**
     * @return mixed
     */
    public function d3getFilterPageId()
    {
        if ($this->getConfig()->getConfigParam('bl_rssSearch')) {
            $sClassNameAdd = 'search##';
            $sIdent = md5(rawurlencode(strtolower(Registry::get(Request::class)->getRequestParameter('searchparam'))));
        } else {
            $sClassNameAdd = '##';
            $sIdent = Registry::get(Request::class)->getRequestEscapedParameter('cat');
        }

        $sPageId = $sClassNameAdd.
            Registry::getLang()->getLanguageAbbr()."##".
            Registry::getConfig()->getShopId()."##".
            $sIdent;

        return $sPageId;
    }

    /**
     * @return array
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function getAttributeFilters()
    {
        if (null == $this->_aSelectedAttributes) {
            $oAttributeFilter = $this->d3GetOwnSearchHandler()->getFilterList()->getAttributeFilter();
            $oAttributeFilter->setIgnoreSessionAttributes(true);
            $this->_aSelectedAttributes = $oAttributeFilter->getAttributeFilters();
            $oAttributeFilter->setIgnoreSessionAttributes(false);

            $this->addTplParam('aD3AttribFilters', $this->_aSelectedAttributes);
        }

        return $this->_aSelectedAttributes;
    }

    /**
     * @return bool|string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function getSearchCategory()
    {
        return $this->d3GetOwnSearchHandler()->getFilterList()->getCategoryFilter()->getUserSingleSelection();
    }

    /**
     * @return bool
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws StandardException
     */
    public function d3CategoryFilterUseMultipleValues()
    {
        return $this->d3GetOwnSearchHandler()->getFilterList()->getCategoryFilter()->hasUserMultiSelection();
    }

    /**
     * @return bool|string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function getSearchVendor()
    {
        return $this->d3GetOwnSearchHandler()->getFilterList()->getVendorFilter()->getUserSingleSelection();
    }

    /**
     * @return bool
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function d3VendorFilterUseMultipleValues()
    {
        return $this->d3GetOwnSearchHandler()->getFilterList()->getVendorFilter()->hasUserMultiSelection();
    }

    /**
     * @return bool|string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function getSearchManufacturer()
    {
        return $this->d3GetOwnSearchHandler()->getFilterList()->getManufacturerFilter()->getUserSingleSelection();
    }

    /**
     * @return bool
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function d3ManufacturerFilterUseMultipleValues()
    {
        return $this->d3GetOwnSearchHandler()->getFilterList()->getManufacturerFilter()->hasUserMultiSelection();
    }

    /**
     * performance, use a class wide instance
     *
     * @return d3_search
     */
    public function d3GetOwnSearchHandler()
    {
        if (!$this->oD3OwnSearchHandler) {
            $this->oD3OwnSearchHandler = oxNew(d3_search::class);
        }

        return $this->oD3OwnSearchHandler;
    }
}
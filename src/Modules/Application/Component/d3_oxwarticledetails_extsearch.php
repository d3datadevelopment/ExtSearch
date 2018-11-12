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

namespace D3\Extsearch\Modules\Application\Component;

use D3\Extsearch\Modules\Application\Model\d3_oxsearch_extsearch;
use D3\Extsearch\Modules\Application\Controller\d3_ext_search;
use D3\Extsearch\Modules\Application\Controller\d3_alist_extsearch;
use D3\Extsearch\Modules\Application\Controller\d3_manufacturerlist_extsearch;
use D3\Extsearch\Modules\Application\Controller\d3_vendorlist_extsearch;
use D3\Extsearch\Application\Model\d3_search;
use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use Doctrine\DBAL\DBALException;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Request;
use OxidEsales\Eshop\Core\Registry;
use \OxidEsales\Eshop\Application\Model\Search;
use \OxidEsales\Eshop\Application\Controller\SearchController;
use \OxidEsales\Eshop\Application\Controller\ArticleListController;
use \OxidEsales\Eshop\Application\Controller\ManufacturerListController;
use \OxidEsales\Eshop\Application\Controller\VendorListController;

class d3_oxwarticledetails_extsearch extends d3_oxwarticledetails_extsearch_parent
{
    /** @var Search */
    public $oD3SearchHandler = null;
    /** @var d3_search */
    public $oD3OwnSearchHandler = null;
    protected $_aSelectedAttributes;
    private $_sModId = 'd3_extsearch';

    public function init()
    {
        if (false == is_array($this->_aComponentNames)) {
            $this->_aComponentNames = array();
        }

        if (false == in_array('oxcmp_utils', array_change_key_case(array_keys($this->_aComponentNames)), CASE_LOWER)) {
            $this->_aComponentNames['oxcmp_utils'] = 1;
        }

        parent::init();
    }

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
     * @return array
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function getAttributeFilters()
    {
        if (null == $this->_aSelectedAttributes) {
            $this->_aSelectedAttributes = $this->_d3GetSearchHandler()->getAttributeFilters();

            $this->addTplParam('aD3AttribFilters', $this->_aSelectedAttributes);
        }

        return $this->_aSelectedAttributes;
    }

    /**
     * @return mixed
     */
    public function d3getFilterPageId()
    {
        switch (strtolower($this->getListType())) {
            case 'search':
                $sClassNameAdd = 'search##';
                $sIdent = md5(rawurlencode(strtolower(Registry::get(Request::class)->getRequestEscapedParameter('searchparam'))));
                break;
            case 'manufacturer':
                $sClassNameAdd = '##';
                $sIdent = Registry::get(Request::class)->getRequestEscapedParameter('mnid');
                break;
            default:
                $sClassNameAdd = '##';
                $sIdent = Registry::get(Request::class)->getRequestEscapedParameter('cnid');
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
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function getNavigationParams()
    {
        $aParams = parent::getNavigationParams();

        $sListType = Registry::get(Request::class)->getRequestEscapedParameter('listtype');
        /** @var d3_ext_search|d3_alist_extsearch|d3_manufacturerlist_extsearch|d3_vendorlist_extsearch $oController */
        if ('search' == $sListType) {
            $oController = oxNew(SearchController::class);
        } elseif ('vendor' == $sListType) {
            $oController = oxNew(VendorListController::class);
        } elseif ('manufacturer' == $sListType) {
            $oController = oxNew(ManufacturerListController::class);
        } else {
            $oController = oxNew(ArticleListController::class);
        }
        $aSearchParams = $oController->getNavigationParams();
        $this->_d3GetSearchHandler()->d3RemoveEmptyParameters($aParams);

        $aParams = array_merge($aSearchParams, $aParams);

        return $aParams;
    }

    /**
     * @return string
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
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function d3CategoryFilterUseMultipleValues()
    {
        return $this->d3GetOwnSearchHandler()->getFilterList()->getCategoryFilter()->hasUserMultiSelection();
    }

    /**
     * @return string
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
     * @return string
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

    /**
     * Returns page sort identificator. It is used as identificator in session variable aSorting[ident]
     *
     * @return string
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     */
    public function getSortIdent()
    {
        if ($this->d3GetSet()->isActive()
            && Registry::get(Request::class)->getRequestParameter('isextsearch') === 'search'
        ) {
            return 'd3extsearch';
        } elseif (method_exists(get_parent_class(), 'getSortIdent')) {
            return parent::getSortIdent();
        } else {
            return null;
        }
    }

    /**
     * @return d3_cfg_mod
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function d3GetSet()
    {
        return d3_cfg_mod::get($this->_d3getModId());
    }

    /**
     * @return string
     */
    private function _d3getModId()
    {
        return $this->_sModId;
    }
}

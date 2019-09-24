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

namespace D3\Extsearch\Modules\Application\Controller;

use D3\Extsearch\Modules\Application\Model\d3_oxsearch_extsearch;
use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use Doctrine\DBAL\DBALException;
use OxidEsales\Eshop\Application\Model\Search;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;
use OxidEsales\Eshop\Application\Controller\SearchController;
use OxidEsales\Eshop\Application\Controller\ArticleListController;
use OxidEsales\Eshop\Application\Controller\VendorListController;
use OxidEsales\Eshop\Application\Controller\ManufacturerListController;

class d3_details_extsearch extends d3_details_extsearch_parent
{
    /** @var d3_oxsearch_extsearch */
    public $oD3SearchHandler = null;
    protected $_aSelectedAttributes;
    private $_sModId = 'd3_extsearch';

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

        $oController = $this->d3GetBaseController();
        $aSearchParams = $oController->getNavigationParams();

        $aParams = array_merge($aSearchParams, $aParams);

        $this->_d3GetSearchHandler()->d3RemoveEmptyParameters($aParams);

        return $aParams;
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
     * @return string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function getDynUrlParams()
    {
        $sRet = parent::getDynUrlParams();

        $oController = $this->d3GetBaseController();

        if (method_exists($oController, 'd3GetXListController')) {
            $sRet .= $oController->d3GetXListController()->d3AddBaseUrlParams($sRet);
        } else {
            $sRet .= $oController->d3AddBaseUrlParams($sRet);
        }

        return $sRet;
    }

    /**
     * @return d3_alist_extsearch|d3_ext_search|d3_manufacturerlist_extsearch|d3_vendorlist_extsearch
     */
    public function d3GetBaseController()
    {
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

        return $oController;
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

    /**
     * checks if this view can be cached
     * @return bool
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function canCache()
    {
        $canCache = parent::canCache();

        $oController = $this->d3GetBaseController();
        if ($canCache &&
            method_exists($oController, 'd3GetXListController') &&
            count($oController->d3GetXListController()->getAllSelections())
        ) {
            $canCache = false;
        }

        return $canCache;
    }
}

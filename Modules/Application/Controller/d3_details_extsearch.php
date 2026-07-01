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

namespace D3\Extsearch\Modules\Application\Controller;

use D3\Extsearch\Modules\Application\Model\d3_oxsearch_extsearch;
use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use Doctrine\DBAL\Exception as DBALException;
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
    /** @var null|d3_oxsearch_extsearch */
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

        $this->d3GetSearchHandler()->d3RemoveEmptyParameters($aParams);

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
            $this->_aSelectedAttributes = $this->d3GetSearchHandler()->getAttributeFilters();

            $this->addTplParam('aD3AttribFilters', $this->_aSelectedAttributes);
        }

        return $this->_aSelectedAttributes;
    }

    /**
     * performance, use a class wide instance
     *
     * @return d3_oxsearch_extsearch
     */
    protected function d3GetSearchHandler(): d3_oxsearch_extsearch
    {
        if (!$this->oD3SearchHandler) {
            /** @var d3_oxsearch_extsearch $searchHandler */
            $searchHandler = oxNew(Search::class);
            $this->oD3SearchHandler = $searchHandler;
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

        if ('search' == $sListType) {
            /** @var d3_ext_search|d3_alist_extsearch|d3_manufacturerlist_extsearch|d3_vendorlist_extsearch $oController */
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
            return '';
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
        return d3_cfg_mod::get($this->d3getModId());
    }

    /**
     * @return string
     */
    private function d3getModId()
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

        return $canCache && $this->d3CanCache();
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
    public function d3CanCache()
    {
        $oController = $this->d3GetBaseController();

        return false === method_exists($oController, 'd3GetXListController') ||
            ((bool) count($oController->d3GetXListController()->getAllSelections())) === false;
    }

    /**
     * Search bread crumb
     *
     * @return array
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    protected function getSearchBreadCrumb()
    {
        return $this->d3ExtendBreadCrumpLink(parent::getSearchBreadCrumb());
    }

    /**
     * Category bread crumb
     *
     * @return array
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    protected function getCategoryBreadCrumb()
    {
        return $this->d3ExtendBreadCrumpLink(parent::getCategoryBreadCrumb());
    }

    /**
     * vendor bread crumb
     *
     * @return array
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    protected function getVendorBreadCrumb()
    {
        return $this->d3ExtendBreadCrumpLink(parent::getVendorBreadCrumb());
    }

    /**
     * @param array $paths
     *
     * @return array
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    protected function d3ExtendBreadCrumpLink(array $paths): array
    {
        $pathKeys = array_keys($paths);
        $baseController = $this->d3GetBaseController();
        $link = $paths[end($pathKeys)]['link'];

        if (method_exists($baseController, 'd3GetXListController')) {
            $link .= $baseController->d3GetXListController()->d3AddBaseUrlParams($link);
        } else {
            $link .= $baseController->d3AddBaseUrlParams($link);
        }

        $paths[end($pathKeys)]['link'] = $link;

        return $paths;
    }
}

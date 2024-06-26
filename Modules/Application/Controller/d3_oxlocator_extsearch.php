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

use D3\Extsearch\Modules\Application\Model\d3_oxarticlelist_extsearch;
use D3\Extsearch\Application\Model\d3_search;
use D3\Extsearch\Application\Model\Filters\d3Filter;
use D3\Extsearch\Core\d3_extsearch_conf;
use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use Doctrine\DBAL\Exception as DBALException;
use OxidEsales\Eshop\Application\Model\Manufacturer;
use OxidEsales\Eshop\Application\Model\Vendor;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;
use OxidEsales\Eshop\Application\Model\Article;
use OxidEsales\Eshop\Application\Model\Category;
use OxidEsales\Eshop\Application\Model\ArticleList;
use OxidEsales\Eshop\Application\Controller\FrontendController;
use stdClass;

class d3_oxlocator_extsearch extends d3_oxlocator_extsearch_parent
{
    /** @var null|Article */
    protected $_oNextProduct = null;

    /** @var null|Article */
    protected $_oBackProduct = null;

    /** @var array */
    protected $_aD3Params = [];

    private $_sModId = 'd3_extsearch';

    /** @var  d3_details_extsearch */
    protected $_d3LocatorTarget;

    /** @var null|d3_search */
    public $oD3OwnSearchHandler;

    /**
     * @param Article $oCurrArticle
     * @param d3_details_extsearch $oLocatorTarget
     */
    public function setLocatorData($oCurrArticle, $oLocatorTarget)
    {
        $this->_d3LocatorTarget = $oLocatorTarget;

        parent::setLocatorData($oCurrArticle, $oLocatorTarget);
    }

    /**
     * @param d3_ext_search $oLocatorTarget
     * @param Article $oCurrArticle
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    protected function setListLocatorData($oLocatorTarget, $oCurrArticle)
    {
        parent::setListLocatorData($oLocatorTarget, $oCurrArticle);

        /** @var Category|false $oCategory */
        $oCategory = $oLocatorTarget->getActiveCategory();

        if ($this->d3ExtSearchNeedExtensionForCurrentLocator()
            && $oCategory
        ) {
            $sSeparator = htmlspecialchars(ini_get('arg_separator.output'));

            // loading data for article navigation
            /** @var d3_oxarticlelist_extsearch $oIdList */
            $oIdList = oxNew(ArticleList::class);

            if ($oLocatorTarget->showSorting()) {
                $oLocatorTarget->getSorting($this->d3GetSortIdent($oLocatorTarget));
                $oIdList->setCustomSorting($oLocatorTarget->getSortingSql($this->d3GetSortIdent($oLocatorTarget)));
            }

            if ($oCategory->isPriceCategory()) {
                $oIdList->loadPriceIds($oCategory->getFieldData('oxpricefrom'), $oCategory->getFieldData('oxpriceto'));
            } else {
                $sActCat = $oCategory->getId();
                $oIdList->loadCategoryIds($sActCat, Registry::getSession()->getVariable('session_attrfilter'));
            }

            //page number
            $iPage = $this->findActPageNumber($oLocatorTarget->getActPage(), $oIdList, $oCurrArticle);

            $sAddSearch = $this->d3GetSearchUrlAdd();

            // setting product position in list, amount of articles etc
            $oCategory->__set('iCntOfProd', $oIdList->count());
            $oCategory->__set('iProductPos', $this->getProductPos($oCurrArticle, $oIdList, $oLocatorTarget));

            $sPageNr = $this->getPageNumber($iPage);
            $oCategory->__set('toListLink', $this->makeLink($oCategory->__get('link'), $sPageNr . ($sPageNr ? $sSeparator : '') . $sAddSearch));
            $this->_oNextProduct ?
                $oCategory->__set('nextProductLink', $this->makeLink($this->_oNextProduct->getLink(), $sAddSearch)) :
                null;

            $this->_oBackProduct ?
                $oCategory->__set('prevProductLink', $this->makeLink($this->_oBackProduct->getLink(), $sAddSearch)) :
                null;

            $sFormat = Registry::getLang()->translateString('searchResult');
            $oLocatorTarget->setSearchTitle(sprintf($sFormat, $this->d3GetParamForSearch('searchparam', true)));
            // for compatibility reasons for a while. will be removed in future
            $oLocatorTarget->addTplParam('sSearchTitle', $oLocatorTarget->getSearchTitle());

            if ($this->d3GetRawUrlParamForSearch('searchparam')) {
                $oLocatorTarget->addTplParam('searchparam', $this->d3GetRawUrlParamForSearch('searchparam'));
            }

            /** @var d3Filter $oFilter */
            foreach ($this->d3GetOwnSearchHandler()->getFilterList()->getArray() as $oFilter) {
                foreach ($oFilter->getNavigationParameterArray() as $sKey => $sValue) {
                    $oLocatorTarget->addTplParam($sKey, $sValue);
                }
            }

            if ($this->d3GetParamForSearch('searchparam', true)) {
                $oLocatorTarget->addTplParam('searchparamforhtml', $this->d3GetParamForSearch('searchparam', true));
            }

            if ($this->d3GetParamForSearch('isextsearch', false)) {
                $oLocatorTarget->addTplParam('isextseach', Registry::get(Request::class)->getRequestEscapedParameter('isextsearch'));
            }

            $oCategory->__set('toListLink', $oCategory->__get('toListLink') . $sSeparator.'d3avoiddirectshow=1');

            $oLocatorTarget->setActiveCategory($oCategory);
            // for compatibility reasons for a while. will be removed in future
            $oLocatorTarget->addTplParam('actCategory', $oLocatorTarget->getActiveCategory());
        }
    }

    /**
     * @param FrontendController $oLocatorTarget
     * @param Article $oCurrArticle
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    protected function setVendorLocatorData($oLocatorTarget, $oCurrArticle)
    {
        parent::setVendorLocatorData($oLocatorTarget, $oCurrArticle);

        /** @var Vendor|false $oVendor */
        $oVendor = $oLocatorTarget->getActVendor();

        if ($this->d3ExtSearchNeedExtensionForCurrentLocator()
            && $oVendor
        ) {
            $sVendorId = $oVendor->getId();

            // loading data for article navigation
            $oIdList = oxNew(ArticleList::class);
            if ($oLocatorTarget->showSorting()) {
                $oIdList->setCustomSorting($oLocatorTarget->getSortingSql($oLocatorTarget->getSortIdent()));
            }
            $oIdList->loadVendorIDs($sVendorId);

            //page number
            $iPage = $this->findActPageNumber($oLocatorTarget->getActPage(), $oIdList, $oCurrArticle);

            $sAddSearch = $this->d3GetSearchUrlAdd();

            // setting product position in list, amount of articles etc
            $oVendor->__set('iCntOfProd', $oIdList->count());
            $oVendor->__set('iProductPos', $this->getProductPos($oCurrArticle, $oIdList, $oLocatorTarget));

            $oVendor->__set('toListLink', $this->makeLink($oVendor->getLink(), $this->getPageNumber($iPage) . $sAddSearch));
            $this->_oNextProduct ?
                $oVendor->__set('nextProductLink', $this->makeLink($this->_oNextProduct->getLink(), $sAddSearch)) :
                null;
            $this->_oBackProduct ?
                $oVendor->__set('prevProductLink', $this->makeLink($this->_oBackProduct->getLink(), $sAddSearch)) :
                null;

            $oLocatorTarget->setActiveCategory($oVendor);
        }
    }

    /**
     * @param FrontendController $oLocatorTarget
     * @param Article $oCurrArticle
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    protected function setManufacturerLocatorData($oLocatorTarget, $oCurrArticle)
    {
        parent::setManufacturerLocatorData($oLocatorTarget, $oCurrArticle);

        /** @var false|Manufacturer $oManufacturer */
        $oManufacturer = $oLocatorTarget->getActManufacturer();

        if ($this->d3ExtSearchNeedExtensionForCurrentLocator()
            && $oManufacturer
        ) {
            $sManufacturerId = $oManufacturer->getId();

            // loading data for article navigation
            $oIdList = oxNew(ArticleList::class);
            if ($oLocatorTarget->showSorting()) {
                $oIdList->setCustomSorting($oLocatorTarget->getSortingSql($oLocatorTarget->getSortIdent()));
            }
            $oIdList->loadManufacturerIDs($sManufacturerId);

            //page number
            $iPage = $this->findActPageNumber($oLocatorTarget->getActPage(), $oIdList, $oCurrArticle);

            $sAddSearch = $this->d3GetSearchUrlAdd();

            // setting product position in list, amount of articles etc
            $oManufacturer->__set('iCntOfProd', $oIdList->count());
            $oManufacturer->__set('iProductPos', $this->getProductPos($oCurrArticle, $oIdList, $oLocatorTarget));

            $oManufacturer->__set('toListLink', $this->makeLink($oManufacturer->getLink(), $this->getPageNumber($iPage). $sAddSearch));
            $this->_oNextProduct ?
                $oManufacturer->__set('nextProductLink', $this->makeLink($this->_oNextProduct->getLink(), $sAddSearch)) :
                null;
            $this->_oBackProduct ?
                $oManufacturer->__set('prevProductLink', $this->makeLink($this->_oBackProduct->getLink(), $sAddSearch)) :
                null;

            // active Manufacturer
            $oLocatorTarget->setActiveCategory($oManufacturer);
        }
    }

    /**
     * @param d3_ext_search $oLocatorTarget
     * @param Article $oCurrArticle
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    protected function setSearchLocatorData($oLocatorTarget, $oCurrArticle)
    {
        if (false == $this->d3ExtSearchNeedExtensionForCurrentLocator()) {
            parent::setSearchLocatorData($oLocatorTarget, $oCurrArticle);
            return;
        }

        /** @var Category|stdClass $oSearchCat */
        $oSearchCat = $oLocatorTarget->getActSearch();
        $sSeparator = htmlspecialchars(ini_get('arg_separator.output'));

        // loading data for article navigation
        /** @var d3_oxarticlelist_extsearch $oIdList */
        $oIdList = oxNew(ArticleList::class);

        if ($oLocatorTarget->showSorting()) {
            $oLocatorTarget->getSorting($this->d3GetSortIdent($oLocatorTarget));
            $oIdList->setCustomSorting($oLocatorTarget->getSortingSql($this->d3GetSortIdent($oLocatorTarget)));
        }

        $oIdList->loadSearchIds(
            $this->d3GetParamForSearch('searchparam', false),
            $this->d3GetRawUrlParamForSearch('searchcnid'),
            $this->d3GetRawUrlParamForSearch('searchvendor'),
            $this->d3GetRawUrlParamForSearch('searchmanufacturer')
        );

        //page number
        $iPage = $this->findActPageNumber($oLocatorTarget->getActPage(), $oIdList, $oCurrArticle);

        $sAddSearch = $this->d3GetSearchUrlAdd();

        // setting product position in list, amount of articles etc
        $oSearchCat->iCntOfProd = $oIdList->count();
        $oSearchCat->iProductPos = $this->getProductPos($oCurrArticle, $oIdList, $oLocatorTarget);

        $sPageNr = $this->getPageNumber($iPage);
        $oSearchCat->toListLink =
            $this->makeLink($oSearchCat->link, $sPageNr . ($sPageNr ? $sSeparator : '') . $sAddSearch);
        $oSearchCat->nextProductLink =
            $this->_oNextProduct ? $this->makeLink($this->_oNextProduct->getLink(), $sAddSearch) : null;
        $oSearchCat->prevProductLink =
            $this->_oBackProduct ? $this->makeLink($this->_oBackProduct->getLink(), $sAddSearch) : null;

        $sFormat = Registry::getLang()->translateString('searchResult');
        $oLocatorTarget->setSearchTitle(sprintf($sFormat, $this->d3GetParamForSearch('searchparam', true)));
        // for compatibility reasons for a while. will be removed in future
        $oLocatorTarget->addTplParam('sSearchTitle', $oLocatorTarget->getSearchTitle());

        if ($this->d3GetRawUrlParamForSearch('searchparam')) {
            $oLocatorTarget->addTplParam('searchparam', $this->d3GetRawUrlParamForSearch('searchparam'));
        }

        /** @var d3Filter $oFilter */
        foreach ($this->d3GetOwnSearchHandler()->getFilterList() as $oFilter) {
            if ($oFilter->hasUserSelection()) {
                foreach ($oFilter->getNavigationParameterArray() as $sId => $sValue) {
                    $oLocatorTarget->addTplParam($sId, $sValue);
                }
            }
        }

        if ($this->d3GetParamForSearch('searchparam', true)) {
            $oLocatorTarget->addTplParam('searchparamforhtml', $this->d3GetParamForSearch('searchparam', true));
        }

        $oSearchCat->toListLink = $oSearchCat->toListLink . $sSeparator.'d3avoiddirectshow=1';

        $oLocatorTarget->setActiveCategory($oSearchCat);
        // for compatibility reasons for a while. will be removed in future
        $oLocatorTarget->addTplParam('actCategory', $oLocatorTarget->getActiveCategory());
    }

    /**
     * @param $oLocatorTarget
     *
     * @return string
     */
    public function d3GetSortIdent($oLocatorTarget)
    {
        if (method_exists($oLocatorTarget, 'getSortIdent')) {
            return $oLocatorTarget->getSortIdent();
        }

        return 'alist';
    }

    /**
     * @param      $sParamName
     * @param bool $blFormParam
     *
     * @return mixed
     */
    protected function d3GetParamForSearch($sParamName, $blFormParam = false)
    {
        if (!isset($this->_aD3Params[$sParamName . $blFormParam]) || !$this->_aD3Params[$sParamName . $blFormParam]) {
            $this->_aD3Params[$sParamName . $blFormParam] =
                $blFormParam ?
                    Registry::get(Request::class)->getRequestParameter($sParamName) :
                    Registry::get(Request::class)->getRequestEscapedParameter($sParamName);
        }

        return $this->_aD3Params[$sParamName . $blFormParam];
    }

    /**
     * @param $sParamName
     *
     * @return string
     */
    protected function d3GetRawUrlParamForSearch($sParamName)
    {
        return rawurldecode($this->d3GetParamForSearch($sParamName));
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
    protected function d3GetSearchUrlAdd()
    {
        $sSeparator = htmlspecialchars(ini_get('arg_separator.output'));

        $sAddSearch = "searchparam=" . $this->d3GetRawUrlParamForSearch('searchparam').$sSeparator;
        $sAddSearch .= "listtype=" . $this->_sType.$sSeparator;

        $sAddSearch2 = '';

        /** @var d3Filter $oFilter */
        foreach ($this->d3GetOwnSearchHandler()->getFilterList() as $oFilter) {
            $sAddSearch2 .= $oFilter->getNavigationParameterString();
        }

        if (Registry::get(Request::class)->getRequestEscapedParameter('isextsearch') &&
            (strlen($sAddSearch2) || $this->_d3LocatorTarget->getAttributeFilters())
        ) {
            $sAddSearch2 .= $sSeparator."isextsearch=" . Registry::get(Request::class)->getRequestEscapedParameter('isextsearch');
        }

        return $sAddSearch.$sAddSearch2;
    }

    /**
     * @return string
     */
    private function d3getModId()
    {
        return $this->_sModId;
    }

    /**
     * @return d3_cfg_mod
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    protected function d3GetSet()
    {
        return d3_cfg_mod::get($this->d3getModId());
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
    private function d3UseAlistFilters()
    {
        return ($this->d3GetSet()->getLicenseConfigData(d3_extsearch_conf::SERIAL_BIT_HAS_FILTERS_IN_ALIST, false)
                || $this->d3GetSet()->isDemo())
            && $this->d3GetSet()->getValue(d3_extsearch_conf::CONF_USEFILTERSINLISTS);
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
    protected function d3ExtSearchNeedExtensionForCurrentLocator(): bool
    {
        if (! $this->d3GetSet()->isActive() //
             || ! method_exists(Registry::getConfig()->getActiveView(), 'getListType')
             || ( //
                 ! $this->d3UseAlistFilters() //
                 && Registry::getConfig()->getActiveView()->getListType() != 'search' //
             ) //
        ) {
            return false;
        }

        return true;
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

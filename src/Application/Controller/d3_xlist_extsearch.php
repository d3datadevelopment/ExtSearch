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

namespace D3\Extsearch\Application\Controller;

use alist;
use D3\Extsearch\Modules\Application\Model\d3_oxsearch_extsearch;
use D3\Extsearch\Modules\Application\Controller\d3_alist_extsearch;
use D3\Extsearch\Application\Model\Filters\d3FilterList;
use D3\Extsearch\Application\Model\Filters\d3Filter;
use D3\Extsearch\Application\Model\d3_search;
use D3\Extsearch\Core\d3_extsearch_conf;
use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use Doctrine\DBAL\DBALException;
use manufacturerlist as manufacturerlistAlias;
use OxidEsales\Eshop\Application\Controller\ManufacturerListController;
use OxidEsales\Eshop\Application\Controller\VendorListController;
use OxidEsales\Eshop\Application\Controller\ArticleListController;
use OxidEsales\Eshop\Application\Controller\SearchController;
use OxidEsales\Eshop\Application\Model\ArticleList;
use OxidEsales\Eshop\Application\Model\CategoryList;
use OxidEsales\Eshop\Application\Model\Search;
use OxidEsales\Eshop\Application\Model\VendorList;
use OxidEsales\Eshop\Application\Model\ManufacturerList;
use OxidEsales\Eshop\Application\Model\Category;
use OxidEsales\Eshop\Application\Model\Manufacturer;
use OxidEsales\Eshop\Application\Model\Vendor;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\FileException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;
use OxidEsales\Eshop\Core\StrMb;
use vendorlist as vendorlistAlias;

class d3_xlist_extsearch
{
    private $_sModId = 'd3_extsearch';
    protected $_oaListController;
    public $oD3SearchHandler = null;
    public $oD3OwnSearchHandler = null;
    public $aPriceSteps;
    public $aPriceSelector;
    public $sPriceSelector;
    protected $_sD3AdditionalParams = null;
    protected $_aSelectedAttributes;
    private $_blUseAlistFilter;

    /**
     * d3_xlist_extsearch constructor.
     * @param $oListController
     * @throws StandardException
     */
    public function __construct($oListController)
    {
        if (false == ($oListController instanceof ArticleListController)
            && false == ($oListController instanceof SearchController)
        ) {
            $sMessage = 'Argument passed to '.__METHOD__.' must be an instance of ArticleListController or SearchController';
            $oException = oxNew(StandardException::class, $sMessage);
            throw $oException;
        }

        $this->_oaListController = $oListController;
    }

    /**
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function render()
    {
        if ($this->d3GetSet()->isActive() && $this->_d3UseAlistFilters()) {
            $this->addSideBar();
            $this->_d3AddAllTplParams();
        }
    }

    public function addSideBar()
    {
        $this->getaListController()->addTplParam('sidebar', 'left');
    }

    /**
     * @param Category|Manufacturer|Vendor $oCategory
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function addAListFilters($oCategory)
    {
        if (false == $this->_d3UseAlistFilters()) {
            return;
        }

        $oFilterList = $this->d3GetOwnSearchHandler()->getFilterList();

        if (false == method_exists($oCategory, 'isPriceCategory')  // in case of manufacturerlist class
            || false == $oCategory->isPriceCategory()
        ) {
            $sControllerClassName = strtolower($this->getaListController()->getClassKey());

            if (in_array($sControllerClassName, array(ArticleListController::class, alist::class))) {
                $_POST["searchcnid"] = Registry::get(Request::class)->getRequestEscapedParameter('cnid');
            } elseif (in_array($sControllerClassName, array(ManufacturerListController::class, manufacturerlistAlias::class))) {
                $_POST["searchmanufacturer"] = Registry::get(Request::class)->getRequestEscapedParameter('mnid');
            } elseif (in_array($sControllerClassName, array(VendorListController::class, vendorlistAlias::class))) {
                $sActCat = Registry::get(Request::class)->getRequestEscapedParameter('cnid');
                /** @var StrMb $oStrMb */
                $oStrMb = getStr();
                $_POST["searchvendor"] = ($oStrMb->preg_match('/^v_.?/i', $sActCat)) ? str_replace(
                    'v_',
                    '',
                    $sActCat
                ) : null;
            }

            $aExclude = array();

            if (in_array($sControllerClassName, array(ArticleListController::class, alist::class))) {
                $aExclude[] = d3FilterList::CategoryFilterId;
            } elseif (in_array($sControllerClassName, array(VendorListController::class, vendorlistAlias::class))) {
                $aExclude[] = d3FilterList::VendorFilterId;
            } elseif (in_array($sControllerClassName, array(ManufacturerListController::class, manufacturerlistAlias::class))) {
                $aExclude[] = d3FilterList::ManufacturerFilterId;
            }

            /** @var d3Filter $oFilter */
            foreach ($oFilterList->getAllExcept($aExclude) as $oFilter) {
                $oFilter->generateFilterList();
            }

        } elseif (method_exists($oCategory, 'isPriceCategory')  // in case of manufacturerlist class
            && $oCategory->isPriceCategory()
        ) {
            $oCur = Registry::getConfig()->getActShopCurrencyObject();
            $iCurPrecision = $oCur->decimal;
            $pow = pow(10, $iCurPrecision);

            $aPriceSelector = array(
                'min' => $oCategory->getFieldData('oxpricefrom'),
                'max' => $oCategory->getFieldData('oxpriceto')
            );
            $aPSOV = array(
                'min' => $oCategory->getFieldData('oxpricefrom') * $pow,
                'max' => $oCategory->getFieldData('oxpriceto') * $pow
            );
            $_POST["d3psov"] = $aPSOV;
            $_POST["priceselector"] = $aPriceSelector;

            $aExclude = array(
                d3FilterList::CategoryFilterId,
            );

            /** @var d3Filter $oFilter */
            foreach ($oFilterList->getAllExcept($aExclude) as $oFilter) {
                $oFilter->generateFilterList();
            }
        }
    }

    /**
     * @param $iArticleCount
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function addSearchFilters($iArticleCount)
    {
        $oFilterList = $this->d3GetOwnSearchHandler()->getFilterList();
        /** @var d3Filter $oFilter */
        foreach ($oFilterList->getArray() as $oFilter) {
            if ($oFilter->canBeUsed($iArticleCount)) {
                $oFilter->generateFilterList();
            }
        }
    }

    /**
     * @param ArticleList $oArtList
     *
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function setTplParams($oArtList)
    {
        $this->getaListController()->addTplParam( 'blD3ShowFilters', $this->d3CanShowFilters($oArtList) );
        $this->getaListController()->addTplParam('blD3HasSelectedFilters', $this->d3GetOwnSearchHandler()->d3HasSelectedFilters());
    }

    /**
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    protected function _d3AddAllTplParams()
    {
        $sSeparator = htmlspecialchars(ini_get('arg_separator.output'));

        // set TPL parameter, if category and vendor selectlists on frontends left side shouldn't changed
        if (false == strstr($this->getaListController()->getViewDataElement('additionalparams'), $sSeparator.'isextsearch=') //
            && ($sExtSearchFlag = Registry::get(Request::class)->getRequestEscapedParameter('isextsearch')) //
        ) {
            $this->getaListController()->addTplParam(
                'additionalparams',
                $this->getaListController()->getViewDataElement('additionalparams') . $sSeparator.'isextsearch='.$sExtSearchFlag
            );
            $this->getaListController()->addTplParam('isextsearch', $sExtSearchFlag);
        }

        /** @var d3Filter $oFilter */
        foreach ($this->d3GetOwnSearchHandler()->getFilterList() as $oFilter) {
            if ($oFilter->hasUserSelection()) {
                $this->_sD3AdditionalParams .= $oFilter->getD3AdditionalParams();
            }
        }

        // send browser plugin status to smarty
        $this->getaListController()->addTplParam('blSearchPluginLink', $this->d3GetSet()->getValue('blExtSearch_enablePluginLink'));
    }

    /**
     * @param ArticleList $oArtList
     *
     * @return bool
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function d3CanShowFilters($oArtList)
    {
        if ($oArtList->count() == 0) {
            return false;
        }

        $oFilterList = $this->d3GetOwnSearchHandler()->getFilterList();
        /** @var d3Filter $oFilter */
        foreach ($oFilterList->getArray() as $oFilter) {
            if ($oFilter->canShowFilter()) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return d3_cfg_mod
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function d3GetSet()
    {
        $oSet = d3_cfg_mod::get($this->_d3getModId());
        // set "allow search without searchparam"
        $oSet->setValue(d3_extsearch_conf::CONF_ALLOWEMPTYSEARCHSTR, true);

        return $oSet;
    }

    /**
     * @return string
     */
    private function _d3getModId()
    {
        return $this->_sModId;
    }

    /**
     * performance, use a class wide instance
     *
     * @return d3_oxsearch_extsearch
     */
    public function d3GetSearchHandler()
    {
        if (!$this->oD3SearchHandler) {
            $this->oD3SearchHandler = oxNew(Search::class);
        }

        return $this->oD3SearchHandler;
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
     * Template variable getter. Returns hits related vendor list
     *
     * @return CategoryList
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function d3GetCategoryList()
    {
        return $this->d3GetOwnSearchHandler()->getFilterList()->getCategoryFilter()->getFilterList();
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
    public function d3HasCategoryList()
    {
        return $this->d3GetOwnSearchHandler()->getFilterList()->getCategoryFilter()->canShowFilter();
    }

    /**
     * Template variable getter. Returns hits related vendor list
     * @return Vendorlist
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function d3GetVendorList()
    {
        return $this->d3GetOwnSearchHandler()->getFilterList()->getVendorFilter()->getFilterList();
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
    public function d3HasVendorList()
    {
        return $this->d3GetOwnSearchHandler()->getFilterList()->getVendorFilter()->canShowFilter();
    }

    /**
     * Template variable getter.  Returns hits related manufacturer list
     * @return Manufacturerlist
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function d3GetManufacturerList()
    {
        return $this->d3GetOwnSearchHandler()->getFilterList()->getManufacturerFilter()->getFilterList();
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
    public function d3HasManufacturerList()
    {
        return $this->d3GetOwnSearchHandler()->getFilterList()->getManufacturerFilter()->canShowFilter();
    }

    /**
     * Template variable getter. Returns hits related attribute list (generating in $this->_d3GetAttributeList())
     *
     * @return array
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function d3GetAttributeList()
    {
        return $this->d3GetOwnSearchHandler()->getFilterList()->getAttributeFilter()->getFilterList();
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
    public function d3HasAttributeList()
    {
        return $this->d3GetOwnSearchHandler()->getFilterList()->getAttributeFilter()->canShowFilter();
    }

    /**
     * Template variable getter. Returns price selector list
     *
     * @return array
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws FileException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function d3getPriceSteps()
    {
        return $this->d3GetOwnSearchHandler()->getFilterList()->getPriceFilter()->getFilterList();
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
    public function d3HasjQuerySlider()
    {
        return $this->d3GetOwnSearchHandler()->getFilterList()->getPriceFilter()->canHaveMultipleSelection();
    }

    /**
     * @param string $sBase
     * @return string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function d3AddBaseUrlParams($sBase = '')
    {
        $sRet = '';
        if ($this->d3GetSet()->isActive()) {

            $sSeparator = htmlspecialchars(ini_get('arg_separator.output'));
            if (substr($sBase, -1) !== $sSeparator) {
                $sRet .= $sSeparator;
            }

            $blExcludeShopHandledSingleParameters = $this->isControllerClass(SearchController::class) ? true : false;

            /** @var d3Filter $oFilter */
            foreach ($this->d3GetOwnSearchHandler()->getFilterList() as $oFilter) {
                $blExists = false;
                foreach ($oFilter->getParameterCheckPattern('@', $blExcludeShopHandledSingleParameters) as $sPattern) {
                    if (preg_match($sPattern, $sBase)) {
                        $blExists = true;
                        break;
                    }
                }

                if (false === $blExists) {
                    $sRet .= $oFilter->getNavigationParameterString(false, $blExcludeShopHandledSingleParameters);
                }
            }

            $sRet = in_array($sRet, ['&amp;', '&']) ? '' : $sRet;

            if (false == strstr($sBase, $sSeparator.'isextsearch=')
                && (strlen($sRet) || $this->d3GetOwnSearchHandler()->getFilterList()->getAttributeFilter()->d3HasAttributeValues())
            ) {
                $sRet .= "isextsearch=alist".$sSeparator;
            }
        }

        return $sRet;
    }

    public function isControllerClass($sCheckClassKey)
    {
        $sClassKey = Registry::getConfig()->getActiveView()->getClassKey();

        return strtolower($sClassKey) === strtolower($sCheckClassKey);
    }

    /**
     * @return string
     */
    public function d3GetDeselectValue()
    {
        return $this->d3GetSearchHandler()->d3GetDeselectValue();
    }

    /**
     * @return string
     */
    public function d3getFilterPageId()
    {
        $sClassName = strtolower($this->getaListController()->getClassKey());
        switch (true) {
            case in_array($sClassName, array(strtolower('manufacturerlist'))):
                $sIdent = Registry::get(Request::class)->getRequestEscapedParameter('mnid');
                break;
            default:
                $sIdent = Registry::get(Request::class)->getRequestEscapedParameter('cnid');
        }

        $sPageId = '##'.
            Registry::getLang()->getLanguageAbbr()."##".
            Registry::getConfig()->getShopId()."##".
            $sIdent;

        return $sPageId;
    }

    /**
     * @param $sOptionTitle
     *
     * @return string
     */
    public function d3GetMultipleSelectionTranslation($sOptionTitle)
    {
        return sprintf(Registry::getLang()->translateString('D3_EXTSEARCH_EXT_MULTIPLESELECT'), $sOptionTitle);
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
    public function d3HasFilters()
    {
        $oFilterList = $this->d3GetOwnSearchHandler()->getFilterList();

        /** @var d3Filter $oFilter */
        foreach ($oFilterList->getArray() as $oFilter) {
            if ($oFilter->canShowFilter()) {
                return true;
            }
        }

        return false;
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
    public function d3HasPriceFilter()
    {
        return $this->d3GetOwnSearchHandler()->getFilterList()->getPriceFilter()->canShowFilter();
    }

    /**
     * @return bool
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws FileException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function d3CanShowPriceFilterSlider()
    {
        return $this->d3GetOwnSearchHandler()->getFilterList()->getPriceFilter()->canShowPriceFilterSlider();
    }

    /**
     * @return string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws FileException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function d3GetPriceSliderInfoMinValue()
    {
        return $this->d3GetOwnSearchHandler()->getFilterList()->getPriceFilter()->getPriceSliderInfoMinValue();
    }

    /**
     * @return string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws FileException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function d3GetPriceSliderInfoMaxValue()
    {
        return $this->d3GetOwnSearchHandler()->getFilterList()->getPriceFilter()->getPriceSliderInfoMaxValue();
    }

    /**
     * @return string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws FileException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function d3GetPriceSliderInputMinValue()
    {
        return $this->d3GetOwnSearchHandler()->getFilterList()->getPriceFilter()->getPriceSliderInputMinValue();
    }

    /**
     * @return string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws FileException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function d3GetPriceSliderInputMaxValue()
    {
        return $this->d3GetOwnSearchHandler()->getFilterList()->getPriceFilter()->getPriceSliderInputMaxValue();
    }

    /**
     * @return float|int
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function d3getPricePrecision()
    {
        return $this->d3GetOwnSearchHandler()->getFilterList()->getPriceFilter()->getPricePrecision();
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
    public function d3getPriceLimits()
    {
        return $this->d3GetOwnSearchHandler()->getFilterList()->getPriceFilter()->getPriceLimits();
    }

    /**
     * @return string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws FileException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function d3GetPriceSliderOriginalMinValue()
    {
        return $this->d3GetOwnSearchHandler()->getFilterList()->getPriceFilter()->getPriceSliderOriginalMinValue();
    }

    /**
     * @return string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws FileException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function d3GetPriceSliderOriginalMaxValue()
    {
        return $this->d3GetOwnSearchHandler()->getFilterList()->getPriceFilter()->getPriceSliderOriginalMaxValue();
    }

    /**
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function d3ClearFilter()
    {
        $this->d3GetSearchHandler()->d3ClearFilters();
        $oView = Registry::getConfig()->getActiveView();
        $oView->setFncName(null);
    }

    /**
     * @param $aParams
     * @return array
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function addNavigationParams($aParams)
    {
        $aAddParams = array();

        if ($this->d3GetSet()->isActive()
            && $this->_d3UseAlistFilters()
        ) {
            $this->d3GetSearchHandler()->d3RemoveEmptyParameters($aParams);

            if (strlen(Registry::get(Request::class)->getRequestEscapedParameter('searchparam'))) {
                $aAddParams['searchparam'] = htmlspecialchars(
                    html_entity_decode(Registry::get(Request::class)->getRequestEscapedParameter('searchparam'))
                );
            }

            /** @var d3Filter $oFilter */
            foreach ($this->d3GetOwnSearchHandler()->getFilterList() as $oFilter) {
                $aAddParams = array_merge($aAddParams, $oFilter->getNavigationParameterList());
            }

            if ((count($aAddParams) || $this->d3GetOwnSearchHandler()->getFilterList()->getAttributeFilter()->d3HasAttributeValues()) &&
                ($sExtSearchFlag = Registry::get(Request::class)->getRequestEscapedParameter('isextsearch'))
            ) {
                $aAddParams['isextsearch'] = $sExtSearchFlag;
            }
        }

        return array_merge($aParams, $aAddParams);
    }

    /**
     * returns all selections (inclusive attributes) as a merged array
     * @return array
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function getAllSelections()
    {
        $selections = [];

        /** @var d3Filter $oFilter */
        foreach ($this->d3GetOwnSearchHandler()->getFilterList() as $oFilter) {
            $selection = $oFilter->getUserSelection();
            if ($selection && !(is_array($selection) && !count($selection))) {
                $selections[] = $selection;
            }
        }

        return $selections;
    }

    /**
     * returns a unique hash from selected filter combination
     * @return string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function getHashedSelections()
    {
        return md5(serialize($this->getAllSelections()));
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
    private function _d3UseAlistFilters()
    {
        if (null === $this->_blUseAlistFilter) {
            $this->_blUseAlistFilter = ($this->d3GetSet()->getLicenseConfigData(d3_extsearch_conf::SERIAL_BIT_HAS_FILTERS_IN_ALIST, false)
                    || $this->d3GetSet()->isDemo())
                && $this->d3GetSet()->getValue(d3_extsearch_conf::CONF_USEFILTERSINLISTS);
        }
        return $this->_blUseAlistFilter;
    }

    /**
     * @return d3_alist_extsearch|ArticleListController
     */
    public function getaListController()
    {
        return $this->_oaListController;
    }

    /**
     * @return string
     */
    public function getD3AdditionalParams()
    {
        return $this->_sD3AdditionalParams;
    }
}

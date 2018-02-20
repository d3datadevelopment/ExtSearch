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
use D3\Extsearch\Application\Controller\d3_xlist_extsearch;
use D3\Extsearch\Application\Model\d3_search;
use D3\Extsearch\Application\Model\Filters\d3Filter;
use D3\Extsearch\Core\d3_extsearch_conf;
use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use Doctrine\DBAL\DBALException;
use OxidEsales\Eshop\Application\Model\Manufacturer;
use OxidEsales\Eshop\Application\Model\ManufacturerList;
use OxidEsales\Eshop\Application\Model\VendorList;
use OxidEsales\Eshop\Application\Model\CategoryList;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\FileException;
use OxidEsales\Eshop\Core\Exception\StandardException;

class d3_manufacturerlist_extsearch extends d3_manufacturerlist_extsearch_parent
{
    /** @var d3_xlist_extsearch */
    protected $_oXListController;
    private $_blUseAlistFilter;

    /**
     * @return string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function render()
    {
        $this->d3GetXListController()->render();

        return parent::render();
    }

    /**
     * @param Manufacturer $oCategory
     *
     * @return array
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    protected function _loadArticles($oCategory)
    {
        $aRet = parent::_loadArticles($oCategory);
        $aKeys = array_keys($aRet);

        $iArtCnt  = $aRet[$aKeys[1]];

        if ($iArtCnt) {
            $this->d3GetXListController()->addAListFilters($oCategory);
        }

        $this->d3GetXListController()->setTplParams();

        return $aRet;
    }

    /**
     * @return bool|string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function getSearchCategory()
    {
        return $this->_d3GetOwnSearchHandler()->getFilterList()->getCategoryFilter()->getUserSingleSelection();
    }

    /**
     * @return bool|string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function getSearchVendor()
    {
        return $this->_d3GetOwnSearchHandler()->getFilterList()->getVendorFilter()->getUserSingleSelection();
    }

    /**
     * @return bool|string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function getSearchManufacturer()
    {
        return $this->_d3GetOwnSearchHandler()->getFilterList()->getManufacturerFilter()->getUserSingleSelection();
    }

    /**
     * @param string $sUrl
     * @param int $iPage
     * @param null $iLang
     *
     * @return string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    protected function _addPageNrParam($sUrl, $iPage, $iLang = null)
    {
        if (false == $this->_d3UseAlistFilters()) {
            return parent::_addPageNrParam($sUrl, $iPage, $iLang);
        }

        $sUrl = parent::_addPageNrParam($sUrl, $iPage, $iLang);

        $sUrlAdd = $this->getViewDataElement('additionalparams');

        if ($sUrlAdd) {
            $sUrl .= ((strpos($sUrl, '?') === false) ? '?' : '') . $sUrlAdd;
        }

        return $sUrl;
    }

    /**
     * returns additional url params for dynamic url building
     *
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

        if ($this->_d3UseAlistFilters()) {
            $sRet .= $this->d3GetXListController()->d3AddBaseUrlParams($sRet);
        }

        return $sRet;
    }

    /**
     * Returns additional URL parameters which must be added to list products urls
     *
     * @return string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function getAddUrlParams()
    {
        $sAddParams = parent::getAddUrlParams();

        if ($this->_d3UseAlistFilters()) {
            $sAddParams .= $this->d3GetXListController()->d3AddBaseUrlParams($sAddParams);
        }

        return $sAddParams;
    }

    /**
     * Returns additional URL parameters which must be added to list products seo urls
     * @return string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function getAddSeoUrlParams()
    {
        $sAddParams = parent::getAddUrlParams();

        if ($this->_d3UseAlistFilters()) {
            $sAddParams .= $this->d3GetXListController()->d3AddBaseUrlParams($sAddParams);
        }

        return $sAddParams;
    }

    /**
     * Returns array of params => values which are used in hidden forms and as additional url params
     *
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

        $aParams = $this->d3GetXListController()->addNavigationParams($aParams);

        return $aParams;
    }

    /**
     * @return string
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     */
    public function getAdditionalParams()
    {
        $this->_sAdditionalParams = parent::getAdditionalParams();

        if ($this->d3GetSet()->isActive()) {
            $sSeparator = htmlspecialchars(ini_get('arg_separator.output'));
            $this->_sAdditionalParams .= $this->d3GetXListController()->getD3AdditionalParams();

            if (!strstr($this->_sAdditionalParams, $sSeparator.'isextsearch=')
                && $this->d3HaveFiltersUserSelection()
            ) {
                $this->_sAdditionalParams .= $sSeparator.'isextsearch=alist';
            }
        }

        return $this->_sAdditionalParams;
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
    public function d3HaveFiltersUserSelection()
    {
        /** @var d3Filter $oFilter */
        foreach ($this->_d3GetOwnSearchHandler()->getFilterList() as $oFilter) {
            if ($oFilter->hasUserSelection()) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return string
     */
    public function d3getFilterPageId()
    {
        return $this->d3GetXListController()->d3getFilterPageId();
    }

    /**
     * @return d3_cfg_mod
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function d3GetSet()
    {
        return $this->d3GetXListController()->d3GetSet();
    }

    /**
     * @return d3_oxsearch_extsearch
     */
    protected function _d3GetSearchHandler()
    {
        return $this->d3GetXListController()->d3GetSearchHandler();
    }

    /**
     * @return d3_search
     */
    protected function _d3GetOwnSearchHandler()
    {
        return $this->d3GetXListController()->d3GetOwnSearchHandler();
    }

    /**
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
        return $this->d3GetXListController()->d3GetCategoryList();
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
        return $this->d3GetXListController()->d3HasCategoryList();
    }

    /**
     * @return VendorList
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function d3GetVendorList()
    {
        return $this->d3GetXListController()->d3GetVendorList();
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
        return $this->d3GetXListController()->d3HasVendorList();
    }

    /**
     * @return ManufacturerList
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function d3GetManufacturerList()
    {
        return $this->d3GetXListController()->d3GetManufacturerList();
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
        return $this->d3GetXListController()->d3HasManufacturerList();
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
    public function d3GetAttributeList()
    {
        return $this->d3GetXListController()->d3GetAttributeList();
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
        return $this->d3GetXListController()->d3HasAttributeList();
    }

    /**
     * @param $sAttrId
     * @return bool
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function d3AttributeFilterUseMultipleValues($sAttrId)
    {
        return $this->_d3GetOwnSearchHandler()->getFilterList()->getAttributeFilter()->hasUserMultiSelection($sAttrId);
    }

    /**
     * @return array|null
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function d3CategoryFilterUseMultipleValues()
    {
        return $this->_d3GetOwnSearchHandler()->getFilterList()->getCategoryFilter()->getUserMultiSelection();
    }

    /**
     * @return array|null
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function d3VendorFilterUseMultipleValues()
    {
        return $this->_d3GetOwnSearchHandler()->getFilterList()->getVendorFilter()->getUserMultiSelection();
    }

    /**
     * @return array|null
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function d3ManufacturerFilterUseMultipleValues()
    {
        return $this->_d3GetOwnSearchHandler()->getFilterList()->getManufacturerFilter()->getUserMultiSelection();
    }

    /**
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
        return $this->d3GetXListController()->d3getPriceSteps();
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
        return $this->d3GetXListController()->d3HasjQuerySlider();
    }

    /**
     * @return string
     */
    public function d3GetDeselectValue()
    {
        return $this->d3GetXListController()->d3GetDeselectValue();
    }

    /**
     * @param $sOptionTitle
     * @return string
     */
    public function d3GetMultipleSelectionTranslation($sOptionTitle)
    {
        return $this->d3GetXListController()->d3GetMultipleSelectionTranslation($sOptionTitle);
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
        return $this->d3GetXListController()->d3HasFilters();
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
        return $this->d3GetXListController()->d3HasPriceFilter();
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
        return $this->d3GetXListController()->d3CanShowPriceFilterSlider();
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
        return $this->d3GetXListController()->d3GetPriceSliderInfoMinValue();
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
        return $this->d3GetXListController()->d3GetPriceSliderInfoMaxValue();
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
        return $this->d3GetXListController()->d3GetPriceSliderInputMinValue();
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
        return $this->d3GetXListController()->d3GetPriceSliderInputMaxValue();
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
        return $this->d3GetXListController()->d3getPriceLimits();
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
        return $this->d3GetXListController()->d3GetPriceSliderOriginalMinValue();
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
        return $this->d3GetXListController()->d3GetPriceSliderOriginalMaxValue();
    }

    /**
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function d3ClearFilter()
    {
        $this->d3GetXListController()->d3ClearFilter();
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
            $this->_blUseAlistFilter = $this->d3GetSet()->isActive()
                && ($this->d3GetSet()->getLicenseConfigData(d3_extsearch_conf::SERIAL_BIT_HAS_FILTERS_IN_ALIST, false) || $this->d3GetSet()->isDemo())
                && $this->d3GetSet()->getValue('blExtSearch_useAListFilter');
        }
        return $this->_blUseAlistFilter;
    }

    /**
     * @return d3_xlist_extsearch
     */
    public function d3GetXListController()
    {
        if (false == $this->_oXListController) {
            $this->_oXListController = oxNew(d3_xlist_extsearch::class, $this);
        }
        return $this->_oXListController;
    }
}

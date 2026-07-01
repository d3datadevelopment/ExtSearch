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

use D3\Extsearch\Application\Model\Filters\d3AttributeFilter;
use D3\Extsearch\Application\Model\Filters\d3CategoryFilter;
use D3\Extsearch\Application\Model\Filters\d3FieldBitSetFilter;
use D3\Extsearch\Application\Model\Filters\d3FieldIsFilter;
use D3\Extsearch\Application\Model\Filters\d3FieldLikeFilter;
use D3\Extsearch\Application\Model\Filters\d3IndexFilter;
use D3\Extsearch\Application\Model\Filters\d3ManufacturerFilter;
use D3\Extsearch\Application\Model\Filters\d3PriceFilter;
use D3\Extsearch\Application\Model\Filters\d3VendorFilter;
use D3\Extsearch\Core\d3_extsearch_conf;
use D3\Extsearch\Modules\Application\Model\d3_oxsearch_extsearch;
use D3\Extsearch\Application\Controller\d3_xlist_extsearch;
use D3\Extsearch\Application\Model\d3_search;
use D3\Extsearch\Application\Model\d3_extsearch_statisticlog;
use D3\Extsearch\Application\Model\Filters\d3Filter;
use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\d3utils;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use D3\ModCfg\Application\Model\Log\d3log;
use Doctrine\DBAL\Exception as DBALException;
use Exception;
use OxidEsales\Eshop\Application\Model\CategoryList;
use OxidEsales\Eshop\Application\Model\VendorList;
use OxidEsales\Eshop\Application\Model\ManufacturerList;
use OxidEsales\Eshop\Application\Model\ArticleList;
use OxidEsales\Eshop\Application\Model\Search;
use OxidEsales\Eshop\Application\Model\Article;
use OxidEsales\Eshop\Application\Model\Vendor;
use OxidEsales\Eshop\Application\Model\Manufacturer;
use OxidEsales\Eshop\Application\Model\Content;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\FileException;
use OxidEsales\Eshop\Core\Exception\LanguageNotFoundException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Model\ListModel;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Database\QueryBuilderFactoryInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * extends the OXID default search by adding error tolerance and further filters
 */
class d3_ext_search extends d3_ext_search_parent
{
    public const OWNFIELD_IS = 'is';
    public const OWNFIELD_LIKE = 'like';

    // default log type
    private $_sModId = 'd3_extsearch'; // in ModCfg used module ident
    protected $_iAllArtCnt = 0;

    /** @var float */
    protected $_iCntPages = null;

    protected $_sD3AdditionalParams = null;

    /** @var null|d3_xlist_extsearch */
    protected $_oXListController;

    /** @var null|d3_oxsearch_extsearch */
    public $oD3SearchHandler = null;

    /** @var null|d3_search */
    public $oD3OwnSearchHandler = null;

    public $aPriceSteps;

    public $oRegularyArtList;

    /** @var CategoryList */
    public $oSearchCatList;

    protected $_aBlockRedirectParams = [];

    public $aPriceSelector;

    public $sPriceSelector;

    protected $_aSortColumns;

    public $aSearchContentList;

    public $aSearchVendorList = [];

    public $aSearchManufacturerList = [];

    public $aSearchAttribList;

    public $aSearchAttributeList;

    /** @var VendorList */
    public $oSearchVendorList;

    /** @var ManufacturerList */
    public $oSearchManufacturerList;

    public $blSearchFilterParam;

    public $aCachedSynonyms = [];

    /**
     * Search title
     * @var string
     */
    protected $_sSearchTitle = null;

    /** @var array */
    protected $_aArticleList;

    /**
     * d3_ext_search constructor.
     */
    public function __construct()
    {
        // mustn'd be getRequestEscapedParameter!
        $sTmP = Registry::get(Request::class)->getRequestParameter('searchparam');
        if (mb_detect_encoding($sTmP) !== "UTF-8" || false === mb_check_encoding($sTmP, "UTF-8")) {
            $sTmP = mb_convert_encoding($sTmP, 'UTF-8', 'ISO-8859-1');

            if (strlen(trim($sTmP))) {
                isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST' ?
                    $_POST['searchparam'] = trim($sTmP) :
                    $_GET['searchparam'] = trim($sTmP);
            }
        }

        $oD3Utils = d3utils::getInstance();
        if ($oD3Utils->hasParentClassMethod($this, '__construct')) {
            parent::__construct();
        }
    }

    /**
     * @return null
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     */
    public function init()
    {
        if (Registry::get(Request::class)->getRequestEscapedParameter('fnc') == 'd3ClearFilter') {
            $this->d3ClearFilter();
        }

        $this->d3CheckEmptySearchParam();

        // contains the default search calls
        parent::init();

        if ($this->d3GetSet()->isActive()) {
            // if search string is empty and empty string is allowed
            if ($this->isEmptySearch()
                 && $this->d3GetSet()->getValue(d3_extsearch_conf::CONF_ALLOWEMPTYSEARCHSTR)
            ) {
                $this->d3PerformEmptySearch();
            }

            $this->d3AddAllTplParams();

            // writes search items into oxlog table, if set
            $this->handleLogging();

            // get related CMS contents and write log
            if ($this->d3GetSet()->getValue('blExtSearch_showContentList')) {
                $this->getCMSList();
            }

            // check for one hit, then redirect to object page
            $this->directShowCheck();

            if ($this->_iAllArtCnt) {
                $this->d3GetXListController()->addSearchFilters($this->_iAllArtCnt);
            }
        }

        $this->_sThisAction = "search";

        return null;
    }

    /**
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    protected function d3CheckEmptySearchParam()
    {
        if ($this->d3GetSet()->isActive()) {
            // performance: disable imposible SEO generating from search url, must set before parent::init()
            $this->_aBlockRedirectParams[] = 'searchparam';

            // if searchstr is description text
            if ($this->getSearchParam() == Registry::getLang()->translateString('D3_EXTSEARCH_FIELD_NOTICE')) {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $_POST['searchparam'] = '';
                } else {
                    $_GET['searchparam'] = '';
                }
            }
        }
    }

    /**
     * @return bool
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    protected function d3CheckForCategoryList()
    {
        if ($this->d3GetSet()->getValue(d3_extsearch_conf::CONF_CATEGORYFILTER_SHOWLIST)
            && (
                $this->_iAllArtCnt
                || (
                    $this->d3GetSet()->getValue(d3_extsearch_conf::CONF_ALLOWEMPTYSEARCHSTR)
                    && $this->d3GetSet()->getValue('blExtSearch_catSearch')
                    && $this->d3GetSet()->getValue('sExtSearch_showCatArticles') == 'catinlist'
                )
            )
        ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * restart the search methods
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    protected function d3PerformEmptySearch()
    {
        /** @var ArticleList $oSearchList */
        $oSearchList = $this->d3GetSearchHandler()->getSearchArticles(
            $this->getSearchParam(),
            $this->d3getCategoryFilter()->getUserSingleSelection(),
            $this->d3getVendorFilter()->getUserSingleSelection(),
            $this->d3getManufacturerFilter()->getUserSingleSelection(),
            $this->getSortingSql($this->getSortIdent())
        );

        // skip count calculation if no articles in list found
        if ($oSearchList->count()) {
            $this->_iAllArtCnt = $this->d3GetSearchHandler()->getSearchArticleCount(
                $this->getSearchParam(),
                $this->d3getCategoryFilter()->getUserSingleSelection(),
                $this->d3getVendorFilter()->getUserSingleSelection(),
                $this->d3getManufacturerFilter()->getUserSingleSelection()
            );
        } else {
            $this->_iAllArtCnt = 0;
        }

        // list of found articles ... and it's counter
        $this->_aArticleList = $oSearchList->getArray();

        // calculate the page navigation values
        $iNrofCatArticles = (int)Registry::getConfig()->getConfigParam('iNrofCatArticles');
        $iNrofCatArticles = $iNrofCatArticles ?: 1;

        $this->_iCntPages = round($this->_iAllArtCnt / $iNrofCatArticles + 0.49);
    }

    /**
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    protected function d3AddAllTplParams()
    {
        // send browser plugin status to smarty
        $this->addTplParam('blSearchPluginLink', $this->d3GetSet()->getValue('blExtSearch_enablePluginLink'));

        $this->addTplParam('blD3HasSelectedFilters', $this->d3GetOwnSearchHandler()->d3HasSelectedFilters());
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
     * @return array
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function getSortColumns()
    {
        $this->_aSortColumns = parent::getSortColumns();
        $aPriorityAlias      = [];

        if (method_exists($this->d3GetSearchHandler(), 'd3GetPriorityAlias')) {
            $aPriorityAlias = $this->d3GetSearchHandler()->d3GetPriorityAlias();
        }

        if ($this->d3GetSet()->isActive()
            && $this->d3GetSet()->getValue('blExtSearch_orderByPriority')
            && !in_array($aPriorityAlias['sortby'], $this->_aSortColumns)
        ) {
            $this->_aSortColumns[] = $aPriorityAlias['sortby'];
        }

        return $this->_aSortColumns;
    }

    /**
     * @param $oSearchHandler
     */
    public function d3SetSearchHandler($oSearchHandler)
    {
        $this->oD3SearchHandler = $oSearchHandler;
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
     * performance, use a class wide instance
     *
     * @return d3_search
     */
    protected function d3GetOwnSearchHandler()
    {
        if (!$this->oD3OwnSearchHandler) {
            $this->oD3OwnSearchHandler = oxNew(d3_search::class);
        }

        return $this->oD3OwnSearchHandler;
    }

    /**
     * adds modul generated log items
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws exception
     */
    protected function handleLogging()
    {
        startProfile('extSearch::logging');

        if (($this->d3GetSet()->getValue('blExtSearch_generallyLogForSearch'))
            || $this->d3GetSet()->getValue('blExtSearch_logHitless')
            && $this->_iAllArtCnt === 0
        ) {
            $aParams = [];
            $sShopID = Registry::getConfig()->getShopId();
            $sSid = Registry::getSession()->getId();
            $iLang = Registry::getLang()->getTplLanguage();

            $sTime = date('Y-m-d H:i:s');
            $sUserID = Registry::getSession()->getVariable('usr');

            $iArtCount = $this->d3GetSearchHandler()->getSearchRegularyArticleCount(
                $this->getSearchParam(),
                $this->d3getCategoryFilter()->getUserSingleSelection(),
                $this->d3getVendorFilter()->getUserSingleSelection(),
                $this->d3getManufacturerFilter()->getUserSingleSelection()
            );

            /** @var d3Filter $oFilter */
            foreach ($this->d3GetOwnSearchHandler()->getFilterList() as $oFilter) {
                if ($oFilter->hasUserSelection()) {
                    $aParams[$oFilter->getStatisticLogIndex()] = $oFilter->getUserSelection();
                }
            }

            /** @var d3_extsearch_statisticlog $oLog */
            $oLog = oxNew(d3_extsearch_statisticlog::class);
            $oLog->assign(
                [
                    'oxtime'    =>  $sTime,
                    'oxshopid'  =>  $sShopID,
                    'oxuserid'  =>  $sUserID,
                    'oxsessid'  =>  $sSid,
                    'oxlang'    =>  $iLang,
                    'oxsearchparam' =>  $this->getSearchParam(),
                    'oxparameter'   =>  $aParams,
                    'd3count'       =>  $iArtCount,
                ]
            );
            $oLog->save();
        }

        stopProfile('extSearch::logging');
    }

    /**
     * check for one hit, then redirect to articles details page
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    protected function directShowCheck()
    {
        if (Registry::get(Request::class)->getRequestEscapedParameter('d3avoiddirectshow') == 1
            || (
                !Registry::get(Request::class)->getRequestParameter('searchparam')
                && !$this->d3GetSet()->getValue(d3_extsearch_conf::CONF_ALLOWEMPTYSEARCHSTR)
            )
        ) {
            return;
        }

        if ($this->d3GetSet()->getValue('blExtSearch_goToUniqueHit')
            && $this->_iAllArtCnt == 1
            && !count($this->d3GetCMSList())
        ) {
            // get key list to detect the first (and once) article in list
            $aKeys = $this->getKeyList($this->_aArticleList);
            // get SEO url for redirect
            /** @var Article $oArticle */
            $oArticle = $this->_aArticleList[$aKeys[0]];
            $this->d3GetOwnSearchHandler()->performDirectShow(null, null, $oArticle);
            return;
        }

        if ($this->d3GetSet()->getValue('blExtSearch_goToUniqueContentHit')
            && !$this->_iAllArtCnt
            && is_array($this->aSearchContentList)
            && count($this->aSearchContentList) == '1'
        ) {
            $aKeys = $this->getKeyList($this->aSearchContentList);
            // get SEO url for redirect
            /** @var Content $oContent */
            $oContent = $this->aSearchContentList[$aKeys[0]];
            $this->d3GetOwnSearchHandler()->performDirectShow(null, null, $oContent);
            return;
        }

        if ($this->d3GetSet()->getValue('blExtSearch_goToUniqueVendorHit')
            && !$this->_iAllArtCnt
            && $this->getSearchVendorList()
            && count($this->aSearchVendorList) == '1'
        ) {
            $aKeys = $this->getKeyList($this->aSearchVendorList);
            $this->d3GetOwnSearchHandler()->performDirectShow(
                $this->aSearchVendorList[$aKeys[0]],
                Vendor::class
            );
            return;
        }

        if ($this->d3GetSet()->getValue('blExtSearch_goToUniqueManufacturerHit')
            && !$this->_iAllArtCnt
            && $this->getSearchManufacturerList()
            && count($this->aSearchManufacturerList) == '1'
        ) {
            $aKeys = $this->getKeyList($this->aSearchManufacturerList);
            $this->d3GetOwnSearchHandler()->performDirectShow(
                $this->aSearchManufacturerList[$aKeys[0]],
                Manufacturer::class
            );
        }
    }

    /**
     * Template variable getter. Returns hits related category list
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
        return $this->d3getCategoryFilter()->getFilterList();
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
        return $this->d3getCategoryFilter()->canShowFilter();
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
        return $this->d3getAttributeFilter()->getFilterList();
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
        return $this->d3getAttributeFilter()->canShowFilter();
    }

    /**
     * gets first letters in database field of all hits
     * @return ListModel
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws FileException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    protected function d3GetIndexList()
    {
        return $this->d3getIndexLetterFilter()->getFilterList();
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
    public function d3HasIndexList()
    {
        return $this->d3getIndexLetterFilter()->canShowFilter();
    }

    /**
     * checks, if commited letter is containing in generated indexlist (contains first letter occurence)
     *
     * @param string $sLetter
     *
     * @return bool
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws FileException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function isHitForIndexLetter($sLetter)
    {
        $oIndexList = $this->d3GetIndexList();
        if ($sLetter == 'all'
            || (
                $oIndexList->count()
                && $this->d3getIndexLetterFilter()->isLetterInList($sLetter)
            )
        ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Template variable getter. Returns hits related vendor list
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
        return $this->d3getVendorFilter()->getFilterList();
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
        return $this->d3getVendorFilter()->canShowFilter();
    }

    /**
     * Template variable getter.  Returns hits related manufacturer list
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
        return $this->d3getManufacturerFilter()->getFilterList();
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
        return $this->d3getManufacturerFilter()->canShowFilter();
    }

    /**
     * generates a content list by given search parameter
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    protected function getCMSList()
    {
        if ($this->d3GetSet()->getFieldData('oxismodulelog')) {
            $this->d3GetSet()->d3getLog()->log(
                d3log::INFO,
                __CLASS__,
                __FUNCTION__,
                __LINE__,
                "",
                "generating CMS list"
            );
        }

        // calls database query execution
        $this->aSearchContentList = $this->d3GetSearchHandler()->getSearchContents();
    }

    /**
     * generates a vendor list by given search parameter
     * @return bool
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    protected function getSearchVendorList()
    {
        if ($this->d3GetSet()->getFieldData('oxismodulelog')) {
            $this->d3GetSet()->d3getLog()->log(
                d3log::INFO,
                __CLASS__,
                __FUNCTION__,
                __LINE__,
                "",
                "generating vendor list"
            );
        }

        // calls database query execution
        $this->aSearchVendorList = $this->d3GetSearchHandler()->getVendorNameHits();

        return true;
    }

    /**
     * generates a manufacturer list by given search parameter
     * @return bool
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    protected function getSearchManufacturerList()
    {
        if ($this->d3GetSet()->getFieldData('oxismodulelog')) {
            $this->d3GetSet()->d3getLog()->log(
                d3log::INFO,
                __CLASS__,
                __FUNCTION__,
                __LINE__,
                "",
                "generating manufacturer list"
            );
        }

        // calls database query execution
        $this->aSearchManufacturerList = $this->d3GetSearchHandler()->getManufacturerNameHits();

        return true;
    }

    /**
     * Template variable getter. Returns searched content list (generated in $this->_getCMSList() above)
     *
     * @return array
     */
    public function d3GetCMSList()
    {
        if (isset($this->aSearchContentList)
            && is_array($this->aSearchContentList)
            && count($this->aSearchContentList)
        ) {
            return $this->aSearchContentList;
        }

        return [];
    }

    /**
     * extracts article list keys (articles oxId) from given list
     *
     * @param array|ListModel $aList
     *
     * @return array
     */
    protected function getKeyList($aList = [])
    {
        $aKeys = [];

        if (count($aList)) {
            $listKeys = is_array($aList) ? array_keys($aList) : $aList->arrayKeys();
            foreach ($listKeys as $key) {
                $aKeys[] = $key;
            }
        }

        return $aKeys;
    }

    /**
     * extends all navigation URLs with modul specific parameters
     *
     * @param bool $addPageNumber
     *
     * @return string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    protected function getRequestParams($addPageNumber = true)
    {
        $sURL = parent::getRequestParams($addPageNumber);
        $sURLAdd = '';

        if ($this->d3GetSet()->isActive()) {
            $sSeparator = htmlspecialchars(ini_get('arg_separator.output'));
            if (substr($sURL, -1) !== $sSeparator) {
                $sURLAdd .= $sSeparator;
            }

            $oFilterList = $this->d3GetOwnSearchHandler()->getFilterList();
            /** @var d3Filter $oFilter */
            foreach ($oFilterList->getArray() as $oFilter) {
                $sURLAdd .= $oFilter->getNavigationParameterString();
            }

            $sURLAdd = in_array($sURLAdd, ['&amp;', '&']) ? '' : $sURLAdd;

            if ((strlen($sURLAdd) || $this->d3getAttributeFilter()->d3HasAttributeValues()) &&
                false == strstr($sURL, 'isextsearch=') &&
                ($sExtSearchFlag = Registry::get(Request::class)->getRequestEscapedParameter('isextsearch'))
            ) {
                $sURLAdd .= $sSeparator."isextsearch=".$sExtSearchFlag;
            }
        }

        return $sURL.$sURLAdd;
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

        if ($this->d3GetSet()->isActive()) {
            $sAddParams .= $this->d3AddBaseUrlParams($sAddParams);
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
        $aAddParams = [];

        if ($this->d3GetSet()->isActive()) {
            $this->d3GetSearchHandler()->d3RemoveEmptyParameters($aParams);

            $oFilterList = $this->d3GetOwnSearchHandler()->getFilterList();
            /** @var d3Filter $oFilter */
            foreach ($oFilterList->getArray() as $oFilter) {
                $aAddParams = array_merge($aAddParams, $oFilter->convertNavigationParameterArrayToList($oFilter->getNavigationParameterArray()));
            }
            if (! isset($aParams['isextsearch'])
                 && (count($aAddParams) || $this->d3GetSearchHandler()->getAttributeFilters())
                 && ($sExtSearchFlag = Registry::get(Request::class)->getRequestEscapedParameter('isextsearch'))
            ) {
                $aAddParams['isextsearch'] = $sExtSearchFlag;
            }
        }

        return array_merge($aParams, $aAddParams);
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
    public function getAdditionalParams()
    {
        $this->_sAdditionalParams = parent::getAdditionalParams();

        if ($this->d3GetSet()->isActive()) {
            $sSeparator = htmlspecialchars(ini_get('arg_separator.output'));
            $this->_sAdditionalParams .= $this->_sD3AdditionalParams;

            if (!strstr($this->_sAdditionalParams, $sSeparator.'isextsearch=')
                && $this->d3HaveFiltersUserSelection()
            ) {
                $this->_sAdditionalParams .= $sSeparator.'isextsearch=search';
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
        foreach ($this->d3GetOwnSearchHandler()->getFilterList() as $oFilter) {
            if ($oFilter->hasUserSelection()) {
                return true;
            }
        }

        return false;
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

        if ($this->d3GetSet()->isActive()) {
            $sRet .= $this->d3AddBaseUrlParams($sRet);
        }

        return $sRet;
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

            /** @var d3Filter $oFilter */
            foreach ($this->d3GetOwnSearchHandler()->getFilterList() as $oFilter) {
                $blExists = false;
                foreach ($oFilter->getParameterCheckPattern('@', true) as $sPattern) {
                    if (preg_match($sPattern, $sBase)) {
                        $blExists = true;
                        break;
                    }
                }

                if (false === $blExists) {
                    $sRet .= $oFilter->getNavigationParameterString(false, true);
                }
            }

            if (false == strstr($sBase, $sSeparator.'isextsearch=') &&
                (strlen($sRet) || $this->d3getAttributeFilter()->d3HasAttributeValues()) &&
                false == strstr($sRet, $sSeparator.'isextsearch=') //
                && ($sExtSearchFlag = Registry::get(Request::class)->getRequestEscapedParameter('isextsearch')) //
            ) {
                $sRet .= "isextsearch=".$sExtSearchFlag.$sSeparator;
            }
        }

        return $sRet;
    }

    /**
     * set default sorting to priority, if prio is enabled and there's
     * no sorting selected
     *
     * @param $sortIdent
     *
     * @return array
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function getSorting($sortIdent)
    {
        if (! $this->d3GetSet()->isActive()) {
            return parent::getSorting($sortIdent);
        }

        $aSorting = parent::getSorting($sortIdent) ?: [];

        if (!count($aSorting)
            && $this->d3GetSet()->getValue('blExtSearch_orderByPriority')
        ) {
            $aSorting = $this->d3GetSearchHandler()->d3GetPriorityAlias();
        }

        if (!count($aSorting)) {
            $aSorting = null;
        }

        if ($aSorting) {
            if (method_exists($this, 'setListOrderBy')) {
                $this->setListOrderBy($aSorting['sortby']);
            } else {
                $this->_sListOrderBy = $aSorting['sortby'];
            }

            if (method_exists($this, 'setListOrderDirection')) {
                $this->setListOrderDirection($aSorting['sortdir']);
            } else {
                $this->_sListOrderDir = $aSorting['sortdir'];
            }
        }

        return $aSorting;
    }

    /**
     * ignore field exist check for prio sorting
     * @return array
     * @throws DBALException
     * @throws DatabaseConnectionException
     */
    public function getUserSelectedSorting()
    {
        $sSortBy = Registry::get(Request::class)->getRequestEscapedParameter($this->getSortOrderByParameterName());
        $aPriorityAlias = $this->d3GetSearchHandler()->d3GetPriorityAlias();

        if ($sSortBy === $aPriorityAlias['sortby']) {
            $sSortDir = Registry::get(Request::class)->getRequestEscapedParameter($this->getSortOrderParameterName());
            $aSorting = ['sortby' => $sSortBy, 'sortdir' => $sSortDir];
        } else {
            $this->d3AddMissingSortFieldName($sSortBy);
            $aSorting = parent::getUserSelectedSorting();
        }

        return $aSorting;
    }

    /**
     * add sort fieldname, if it isn't available yet after clear cache - small bug in shop
     *
     * @param $sSortBy
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected function d3AddMissingSortFieldName($sSortBy)
    {
        /** @var Article $oArticle */
        $oArticle = oxNew(Article::class);

        if (! in_array($sSortBy, $oArticle->getFieldNames())) {
            $oQB = ContainerFactory::getInstance()->getContainer()->get(QueryBuilderFactoryInterface::class)->create();
            $oQB->select('oxid')
                ->from($oArticle->getViewName())
                ->setMaxResults(1);
            $sId = $oQB->execute()->fetchOne();
            // loading a random article via load method fix this
            $oArticle->load($sId);
        }
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
    public function d3HasFilters(): bool
    {
        return $this->d3HasCategoryList()
            || $this->d3HasVendorList()
            || $this->d3HasManufacturerList()
            || $this->d3HasAttributeList()
            || $this->d3HasPriceFilter();
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
        return $this->d3getPriceFilter()->canShowFilter();
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
        return $this->d3getPriceFilter()->canShowPriceFilterSlider();
    }

    /**
     * Template variable getter. Returns price selector list
     *
     * @return array
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws FileException
     * @throws StandardException
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
     * @throws FileException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function d3HasPriceSteps()
    {
        return (bool) ($this->d3getPriceSteps() || $this->getViewDataElement('sSelectedPriceStep'));
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
     * set, if only similar hits are related or a combined article list (regular and similar articles) is returned
     *
     * @return bool|string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function getSearchResultStatusMessage()
    {
        $blSimilar = false;
        $blRegular = false;

        if ($this->d3GetSet()->isActive()) {
            if (count($this->_aArticleList)) {
                foreach ($this->_aArticleList as $oArticle) {
                    if ($oArticle->blIsSimilar) {
                        $blSimilar = true;
                    } else {
                        $blRegular = true;
                    }
                }
            }

            // if regular and similar articles (combined mode)
            if ($blRegular && $blSimilar) {
                return 'combined';
            } elseif ($blSimilar) {
                return 'similar';
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * @return array|string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws FileException
     */
    public function getUsedParams()
    {
        return implode(" ", $this->d3GetSearchHandler()->getFilteredSearchArray());
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
     * @return float|int
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function d3getPricePrecision()
    {
        return $this->d3GetXListController()->d3getPricePrecision();
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
     * @return string
     */
    public function getSearchParamForHtml()
    {
        return htmlspecialchars_decode(parent::getSearchParamForHtml(), ENT_QUOTES);
    }

    /**
     * Returns page sort indentificator. It is used as intentificator in session variable aSorting[ident]
     *
     * @return string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function getSortIdent()
    {
        if ($this->d3GetSet()->isActive()) {
            return 'd3extsearch';
        } elseif (method_exists(get_parent_class(), 'getSortIdent')) {
            return parent::getSortIdent();
        } else {
            return '';
        }
    }

    /**
     * Returns search title. It will be setted in oxLocator
     *
     * @return string
     */
    public function getSearchTitle()
    {
        return $this->_sSearchTitle;
    }

    /**
     * Returns search title setter
     * @param string $sTitle search title
     */
    public function setSearchTitle($sTitle)
    {
        $this->_sSearchTitle = $sTitle;
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
        return $this->d3getCategoryFilter()->hasUserMultiSelection();
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
        return $this->d3getVendorFilter()->hasUserMultiSelection();
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
        return $this->d3getManufacturerFilter()->hasUserMultiSelection();
    }

    /**
     * @param $sAttrId
     *
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
        return $this->d3getAttributeFilter()->hasUserMultiSelection($sAttrId);
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
     * @throws LanguageNotFoundException
     */
    public function d3getFilterPageId()
    {
        $sPageId = "search##".
            Registry::getLang()->getLanguageAbbr()."##".
            Registry::getConfig()->getShopId()."##".
            md5(rawurlencode(strtolower(Registry::get(Request::class)->getRequestEscapedParameter('searchparam'))));

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
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function d3ClearFilter()
    {
        $this->d3GetSearchHandler()->d3ClearFilters();
        $this->setFncName(null);
    }

    /**
     * @return bool|string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function getSearchCategory()
    {
        return $this->d3getCategoryFilter()->getUserSingleSelection();
    }

    /**
     * @return bool|string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function getSearchVendor()
    {
        return $this->d3getVendorFilter()->getUserSingleSelection();
    }

    /**
     * @return bool|string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function getSearchManufacturer()
    {
        return $this->d3getManufacturerFilter()->getUserSingleSelection();
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

    /**
     * @return d3CategoryFilter
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function d3getCategoryFilter()
    {
        return $this->d3GetXListController()->d3GetOwnSearchHandler()->getFilterList()->getCategoryFilter();
    }

    /**
     * @return d3VendorFilter
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function d3getVendorFilter()
    {
        return $this->d3GetXListController()->d3GetOwnSearchHandler()->getFilterList()->getVendorFilter();
    }

    /**
     * @return d3ManufacturerFilter
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function d3getManufacturerFilter()
    {
        return $this->d3GetXListController()->d3GetOwnSearchHandler()->getFilterList()->getManufacturerFilter();
    }

    /**
     * @return d3IndexFilter
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function d3getIndexLetterFilter()
    {
        return $this->d3GetXListController()->d3GetOwnSearchHandler()->getFilterList()->getIndexLetterFilter();
    }

    /**
     * @return d3PriceFilter
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function d3getPriceFilter()
    {
        return $this->d3GetXListController()->d3GetOwnSearchHandler()->getFilterList()->getPriceFilter();
    }

    /**
     * @return d3FieldIsFilter
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function d3getFieldIsFilter()
    {
        return $this->d3GetXListController()->d3GetOwnSearchHandler()->getFilterList()->getFieldIsFilter();
    }

    /**
     * @return d3FieldLikeFilter
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function d3getFieldLikeFilter()
    {
        return $this->d3GetXListController()->d3GetOwnSearchHandler()->getFilterList()->getFieldLikeFilter();
    }

    /**
     * @return d3FieldBitSetFilter
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function d3getFieldBitsetFilter()
    {
        return $this->d3GetXListController()->d3GetOwnSearchHandler()->getFilterList()->getFieldBitsetFilter();
    }

    /**
     * @return d3AttributeFilter
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function d3getAttributeFilter()
    {
        return $this->d3GetXListController()->d3GetOwnSearchHandler()->getFilterList()->getAttributeFilter();
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
        // need function check, because canCache is called before the filters are reset
        return trim(strtolower(Registry::getRequest()->getRequestEscapedParameter('fnc'))) === 'd3clearfilter' ||
            ((bool) count($this->d3GetXListController()->getAllSelections())) === false;
    }
}

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
use D3\Extsearch\Core\d3_extsearch_conf;
use D3\ModCfg\Application\Model\d3utils;
use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\d3filesystem;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use Doctrine\DBAL\Exception as DBALException;
use OxidEsales\Eshop\Application\Model\Shop;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\FileException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;
use OxidEsales\Eshop\Application\Model\Search;
use OxidEsales\Eshop\Core\Controller\BaseController;
use OxidEsales\Eshop\Application\Controller\FrontendController;

class d3_oxcmp_utils_extsearch extends d3_oxcmp_utils_extsearch_parent
{
    private $_sModId = 'd3_extsearch';

    public $blIsComponent = true;

    protected $_sOldPluginName = 'se_browserinstall.xml';

    public $aArtExtendsFields = ['oxlongdesc', 'oxtags'];

    protected $_d3SimilarQuickSearch;

    /** @var null|d3_search */
    public $oD3SearchHandler;

    /** @var  null|Search */
    public $oD3oxSearchHandler;

    /**
     * constructor
     */
    public function __construct()
    {
        // required for parent class method check
        $this->setClassKey('oxcmp_utils');

        /** @var d3utils $oD3Utils */
        $oD3Utils = Registry::get(d3utils::class);
        if ($oD3Utils->hasParentClassMethod($this, '__construct')) {
            parent::__construct();
        }
    }

    /**
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     */
    public function init()
    {
        parent::init();

        if (!$this->isAdmin()) {
            if ($this->d3GetSet()->isActive()) {
                /** @var BaseController $oParentView */
                $oParentView = $this->getParent();
                $oParentView->addTplParam('blD3ShowIAS', $this->d3GetSet()->getValue('blExtSearch_ShowIAS'));
                $oParentView->addTplParam('blD3EmptySearch', $this->d3GetSet()->getValue(d3_extsearch_conf::CONF_ALLOWEMPTYSEARCHSTR));
                $oParentView->addTplParam('blD3ShowSearchPopup', $this->d3GetSet()->getValue('blExtSearch_ShowPopup'));
                $oParentView->addTplParam('sSearchPluginURL', $this->d3GetSearchPluginUrl());
                $oParentView->addTplParam('oD3ExtSearchCmpUtils', $this);
                $oParentView->addTplParam('blUseSuggestSearch', $this->d3GetSet()->getValue('blExtSearch_enableAjaxSearch'));
            }
        }
    }

    /**
     * @return mixed
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function render()
    {
        $ret = parent::render();

        if (!$this->isAdmin() && $this->d3GetSet()->isActive()) {
            /** @var BaseController $oParentView */
            $oParentView = $this->getParent();
            $oParentView->addTplParam(
                'blSearchPluginInstall',
                $this->d3GetSet()->getValue('blExtSearch_enablePluginBrowserInstall')
            );
            $oParentView->addTplParam('blOwnFormFields', $this->d3GetSet()->getValue(d3_extsearch_conf::CONF_CUSTOMFILTER_USE));
            $oParentView->addTplParam('sAboveTheFoldCssFile', $this->d3GetAtfCssFile());
        }

        if (!$this->isAdmin()
            && $this->d3GetSet()->isActive()
            && $this->d3GetSet()->getValue('blExtSearch_enableAjaxSearch')
        ) {
            /** @var BaseController $oParentView */
            $oParentView = $this->getParent();
            $oParentView->addTplParam('sD3QSWaitMessage', $this->getD3SearchHandler()->suggestGetWaitMessage());
        }

        // change OXIDs list type dependend by search only parameters

        if (!$this->isAdmin() //
            && $this->d3GetSet()->isActive() //
            && $this->d3GetSet()->getValue(d3_extsearch_conf::CONF_USEFILTERSINLISTS)
        ) {
            /** @var FrontendController $oParentView */
            $oParentView = $this->getParent();

            if ($oParentView->getListType() == 'search'
                && Registry::get(Request::class)->getRequestEscapedParameter('isextsearch') == 'alist'
            ) {
                $oParentView->setListType('list');
            }
        }

        return $ret;
    }

    /**
     * @return bool|string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws FileException
     */
    public function d3GetAtfCssFile()
    {
        $sFilePath = "out/src/css/abovethefold/d3extsearch_".$this->d3GetSet()->getMappedThemeId()."_".
            strtolower(Registry::getConfig()->getActiveView()->getClassKey()).".min.css";

        $sDir = Registry::getConfig()->getActiveView()->getViewConfig()->getModulePath(
            'd3_extsearch'
        ) . $sFilePath;

        $fs = oxNew(d3filesystem::class);

        return $fs->exists($sDir) ? $sDir : false;
    }

    /**
     * @return d3_cfg_mod
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    private function d3GetSet()
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
     * performance, use a class wide instance
     *
     * @return d3_search
     */
    protected function getD3SearchHandler()
    {
        if (!$this->oD3SearchHandler) {
            $this->oD3SearchHandler = oxNew(d3_search::class);
        }

        return $this->oD3SearchHandler;
    }

    /**
     * generates article list for browsers search engines
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws FileException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function d3_browser_suggest()
    {
        // zwingend, um die Gueltigkeit des Dokuments sicherzustellen
        // faengt Fehlausgaben anderer Module ab
        ob_end_clean();

        // we don't require a complete object
        $blOldFullObject = $this->d3GetSet()->getValue('blExtSearch_QuickSearchLoadFullObject');
        $this->d3GetSet()->setValue('blExtSearch_QuickSearchLoadFullObject', false);

        echo $this->getD3SearchHandler()->browserSuggestGetContent();

        // restore setting
        $this->d3GetSet()->setValue('blExtSearch_QuickSearchLoadFullObject', $blOldFullObject);

        Registry::getConfig()->pageClose();
        die();
    }

    /**
     * @return bool|string
     */
    protected function d3GetSearchPluginUrl()
    {
        /** @var Shop $oShop */
        $oShop = Registry::getConfig()->getActiveShop();

        $oFS = oxNew(d3filesystem::class);
        if ($oFS->exists(
            $oFS->trailingslashit(Registry::getConfig()->getConfigParam('sShopDir')) . $this->_sOldPluginName
        )
        ) {
            $sFileName = $this->_sOldPluginName;
        } else {
            $sPattern  = "[^a-zA-Z0-9]";
            $sFileName = 'searchplugin_' . strtolower(
                preg_replace('@' . $sPattern . '@', '_', $oShop->getFieldData('oxname'))
            ) . ".xml";
        }

        $sURI  = $oFS->trailingslashit(Registry::getConfig()->getConfigParam('sShopURL')) . $sFileName;
        $sPath = $oFS->trailingslashit(Registry::getConfig()->getConfigParam('sShopDir')) . $sFileName;

        if ($oFS->exists($sPath)) {
            return $sURI;
        }

        return false;
    }
}

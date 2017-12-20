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

namespace D3\Extsearch\Modules\Application\Component;

use D3\Extsearch\Application\Model\d3_search;
use D3\ModCfg\Application\Model\d3utils;
use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\d3filesystem;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;
use \OxidEsales\Eshop\Application\Model\Search;
use \OxidEsales\Eshop\Core\Controller\BaseController;
use \OxidEsales\Eshop\Application\Controller\FrontendController;

class d3_oxcmp_utils_extsearch extends d3_oxcmp_utils_extsearch_parent
{
    private $_sModId = 'd3_extsearch';

    public $blIsComponent = true;

    protected $_sOldPluginName = 'se_browserinstall.xml';

    public $aArtExtendsFields = array('oxlongdesc', 'oxtags');

    protected $_d3SimilarQuickSearch;

    /** @var  d3_search */
    public $oD3SearchHandler;

    /** @var  Search */
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

    public function init()
    {
        parent::init();

        if (!$this->isAdmin()) {
            if ($this->_d3GetSet()->isActive()) {
                /** @var $oParentView BaseController */
                $oParentView = $this->getParent();
                $oParentView->addTplParam('blD3ShowIAS', $this->_d3GetSet()->getValue('blExtSearch_ShowIAS'));
                $oParentView->addTplParam('blD3EmptySearch', $this->_d3GetSet()->getValue('blExtSearch_emptySearch'));
                $oParentView->addTplParam('blD3ShowSearchPopup', $this->_d3GetSet()->getValue('blExtSearch_ShowPopup'));
                $oParentView->addTplParam('sSearchPluginURL', $this->_d3GetSearchPluginUrl());
                $oParentView->addTplParam('oD3ExtSearchCmpUtils', $this);
                $oParentView->addTplParam('blUseSuggestSearch', $this->_d3GetSet()->getValue('blExtSearch_enableAjaxSearch'));
            }
        }
    }

    /**
     * @return mixed
     */
    public function render()
    {
        $ret = parent::render();

        if (!$this->isAdmin() && $this->_d3GetSet()->isActive()) {
            /** @var $oParentView BaseController */
            $oParentView = $this->getParent();
            $oParentView->addTplParam(
                'blSearchPluginInstall',
                $this->_d3GetSet()->getValue('blExtSearch_enablePluginBrowserInstall')
            );
            $oParentView->addTplParam('blOwnFormFields', $this->_d3GetSet()->getValue('blExtSearch_ownFormFields'));
        }

        if (!$this->isAdmin()
            && $this->_d3GetSet()->isActive()
            && $this->_d3GetSet()->getValue('blExtSearch_enableAjaxSearch')
        ) {
            /** @var $oParentView BaseController */
            $oParentView = $this->getParent();
            $oParentView->addTplParam('sD3QSWaitMessage', $this->_getD3SearchHandler()->suggestGetWaitMessage());
        }

        // change OXIDs list type dependend by search only parameters

        if (!$this->isAdmin() //
            && $this->_d3GetSet()->isActive() //
            && $this->_d3GetSet()->getValue('blExtSearch_useAListFilter')
        ) {
            /** @var $oParentView FrontendController */
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
     * @return d3_cfg_mod
     */
    private function _d3GetSet()
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
     * performance, use a class wide instance
     *
     * @return d3_search
     */
    protected function _getD3SearchHandler()
    {
        if (!$this->oD3SearchHandler) {
            $this->oD3SearchHandler = oxNew(d3_search::class);
        }

        return $this->oD3SearchHandler;
    }

    /**
     * generates article list for browsers search engines
     */
    public function d3_browser_suggest()
    {
        // zwingend, um die G�ltigkeit des Dokuments sicherzustellen
        // f�ngt Fehlausgaben anderer Module ab
        ob_end_clean();

        // we don't require a complete object
        $blOldFullObject = $this->_d3GetSet()->getValue('blExtSearch_QuickSearchLoadFullObject');
        $this->_d3GetSet()->setValue('blExtSearch_QuickSearchLoadFullObject', false);

        echo $this->_getD3SearchHandler()->browserSuggestGetContent();

        // restore setting
        $this->_d3GetSet()->setValue('blExtSearch_QuickSearchLoadFullObject', $blOldFullObject);

        Registry::getConfig()->pageClose();
        die();
    }

    /**
     * @return bool|string
     */
    protected function _d3GetSearchPluginUrl()
    {
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

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

namespace D3\Extsearch\Application\Controller\Admin;

use D3\Extsearch\Application\Model\d3_extsearch_term;
use D3\Extsearch\Application\Model\d3_semantic;
use D3\ModCfg\Application\Controller\Admin\d3_cfg_mod_main;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;

class d3_cfg_extsearchsyneditor_Main extends d3_cfg_mod_main
{
    protected $_sThisTemplate = 'd3_cfg_extsearchsyneditor_main.tpl';
    protected $_sModId = 'd3_extsearch';
    protected $_aNonIndexedFields = array('oxartnum');
    protected $_sSavedId = null;
    protected $_blUseOwnOxid = true;
    public $sSearchTerm;
    public $sAction;
    public $sSynsetId;
    public $aSynList;
    protected $_aNaviItems = array(
        'new' => array(
            'sScript' => 'top.basefrm.list.EditThis( -1 );return false;',
            'sTranslationId' => 'D3_EXTSEARCH_SYNED_MAIN_NEWWORD',
        ),
    );

    protected $_sMenuItemTitle = 'd3mxextsearch';

    protected $_sMenuSubItemTitle = 'd3mxextsearch_syneditor';

    public function init()
    {
        $this->sSearchTerm = Registry::get(Request::class)->getRequestEscapedParameter('searchterm');
        $this->sAction     = Registry::get(Request::class)->getRequestEscapedParameter('action');
        $this->sSynsetId   = Registry::get(Request::class)->getRequestEscapedParameter('synsetid');
        parent::init();
    }

    /**
     * @return string
     */
    public function render()
    {
        $sRet = parent::render();

        /** @var $oTerm d3_extsearch_term */
        $oTerm = oxNew(d3_extsearch_term::class);
        $this->addTplParam('edit', $oTerm);

        if (method_exists($this, 'getEditObjectId')) {
            $soxId = $this->getEditObjectId();
        } else {
            $soxId = Registry::get(Request::class)->getRequestEscapedParameter("oxid");
            $this->addTplParam("oxid", $soxId);

            // check if we right now saved a new entry
            if ($this->_sSavedId) {
                $soxId = $this->_sSavedId;
                $this->addTplParam("oxid", $soxId);

                // for reloading upper frame
                $this->addTplParam("updatelist", "1");
            }
        }

        if ($soxId && $soxId != "-1") {
            // load object
            if (!$oTerm instanceof d3_extsearch_term && !($oTerm->load($soxId))) {
                $soxId = '-1';
                $this->addTplParam('oxid', $soxId);
            } else {
                $oTerm->load($soxId);
            }
        }

        return $sRet;
    }

    public function save()
    {
        if (method_exists($this, 'getEditObjectId')) {
            $soxId = $this->getEditObjectId();
        } else {
            $soxId = Registry::get(Request::class)->getRequestEscapedParameter("oxid");
        }

        $aParams = Registry::get(Request::class)->getRequestEscapedParameter("editval");

        // default values
        $aParams = $this->addDefaultValues($aParams);

        /** @var d3_extsearch_term $oTerm */
        $oTerm = oxNew(d3_extsearch_term::class);
        $oTerm->setLanguage($this->_iEditLang);

        if ($soxId != "-1") {
            $oTerm->loadInLang($this->_iEditLang, $soxId);
        } else {
            $aParams['d3_extsearch_term__oxid']      = null;
            $aParams['d3_extsearch_term__synset_id'] = $this->getNextSynsetId();
        }

        $oTerm->setLanguage(0);

        $aParams['d3_extsearch_term__word']            = trim($aParams['d3_extsearch_term__word']);

        $oTerm->assign($aParams);
        $oTerm->setLanguage($this->_iEditLang);
        $oTerm->save();

        if (method_exists($this, 'setEditObjectId')) {
            $this->setEditObjectId($oTerm->getId());
        } elseif ($soxId == "-1") {
            $this->_sSavedId = $oTerm->getId();
        }
    }

    /**
     * @param $aParams
     * @return mixed
     */
    public function addDefaultValues($aParams)
    {
        return $aParams;
    }

    /**
     * @return mixed
     */
    public function getLanguageList()
    {
        return Registry::getLang()->getLanguageArray();
    }

    /**
     * @return mixed
     */
    public function getNextSynsetId()
    {
        /** @var d3_semantic $oSemantic */
        $oSemantic = oxNew(d3_semantic::class);
        return $oSemantic->getNextSynsetId();
    }

    /**
     * @param $binValue
     * @return int
     */
    public function convertBin2Int($binValue)
    {
        return ord($binValue);
    }

    public function searchSynonymLists()
    {
        /** @var d3_semantic $oSemantic */
        $oSemantic      = oxNew(d3_semantic::class);
        $this->aSynList = $oSemantic->getSynonymListsForWord($this->sSearchTerm);
    }

    /**
     * @return mixed
     */
    public function getSynonymLists()
    {
        return $this->aSynList;
    }

    /**
     * @return mixed
     */
    public function getSearchTerm()
    {
        return $this->sSearchTerm;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->sAction;
    }

    /**
     * @return mixed
     */
    public function getSynsetId()
    {
        return $this->sSynsetId;
    }
}

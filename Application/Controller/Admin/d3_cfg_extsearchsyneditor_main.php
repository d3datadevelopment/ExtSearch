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

namespace D3\Extsearch\Application\Controller\Admin;

use D3\Extsearch\Application\Model\Constants;
use D3\Extsearch\Application\Model\d3_extsearch_synset;
use D3\Extsearch\Application\Model\d3_extsearch_term;
use D3\Extsearch\Application\Model\d3_semantic;
use D3\ModCfg\Application\Controller\Admin\d3_cfg_mod_main;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use Doctrine\DBAL\Exception as DBALException;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\DatabaseException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;

class d3_cfg_extsearchsyneditor_main extends d3_cfg_mod_main
{
    protected $_sThisTemplate = '@'. Constants::OXID_MODULE_ID .'/admin/d3_cfg_extsearchsyneditor_main';
    protected $_sModId = 'd3_extsearch';
    protected $_aNonIndexedFields = ['oxartnum'];
    protected $_sSavedId = null;
    protected $_blUseOwnOxid = true;
    public $sSearchTerm;
    public $sAction;
    public $sSynsetId;
    public $aSynList;
    protected $_aNaviItems = [
        'new' => [
            'sScript' => 'top.basefrm.list.EditThis( -1 );return false;',
            'sTranslationId' => 'D3_EXTSEARCH_SYNED_MAIN_NEWWORD',
        ],
    ];

    protected $_sMenuItemTitle = 'D3MXEXTSEARCH';

    protected $_sMenuSubItemTitle = 'D3MXEXTSEARCH_SYNEDITOR';

    public function init()
    {
        $this->sSearchTerm = Registry::get(Request::class)->getRequestEscapedParameter('searchterm');
        $this->sAction     = Registry::get(Request::class)->getRequestEscapedParameter('action');
        $this->sSynsetId   = Registry::get(Request::class)->getRequestEscapedParameter('synsetid');
        parent::init();
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
    public function render()
    {
        $sRet = parent::render();

        /** @var d3_extsearch_term $oTerm */
        $oTerm = oxNew(d3_extsearch_term::class);
        $this->addTplParam('edit', $oTerm);

        /** @var d3_extsearch_synset $oSynset */
        $oSynset = oxNew(d3_extsearch_synset::class);
        $this->addTplParam('synset', $oSynset);

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
            if (!$oTerm->load($soxId)) {
                $soxId = '-1';
                $this->addTplParam('oxid', $soxId);
            } else {
                $oTerm->load($soxId);
                $oSynset->load($oTerm->getFieldData('synset_id'));
            }
        }

        return $sRet;
    }

    /**
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseException
     */
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

        /** @var d3_extsearch_synset $oSynset */
        $oSynset = oxNew(d3_extsearch_synset::class);

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

        $aSynsetParams = Registry::get(Request::class)->getRequestEscapedParameter("synset");

        $oSynset->load($oTerm->getFieldData('synset_id'));
        $oSynset->assign($aSynsetParams);
        $oSynset->save();

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
        return Registry::getLang()->getLanguageArray(Registry::getLang()->getTplLanguage());
    }

    /**
     * @return mixed
     * @throws DBALException
     * @throws DatabaseConnectionException
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

    /**
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
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

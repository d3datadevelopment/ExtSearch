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

class d3_cfg_extsearchsyneditor_manage extends d3_cfg_mod_main
{
    protected $_sThisTemplate = '@'. Constants::OXID_MODULE_ID .'/admin/d3_cfg_extsearchsyneditor_manage';
    protected $_sModId = 'd3_extsearch';
    protected $_aNonIndexedFields = ['oxartnum'];
    protected $_blUseOwnOxid = true;
    public $sSearchTerm;
    public $sAction;
    public $sSynsetId;
    public $aSynList;
    protected $_aNaviItems = [
        'new' => [
            'sScript' => 'top.basefrm.list.editThis( -1 );return false;',
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

        if (method_exists($this, 'getEditObjectId')) {
            $soxId = $this->getEditObjectId();
        } else {
            $soxId = Registry::get(Request::class)->getRequestEscapedParameter("oxid");
        }

        if ($soxId && $soxId != "-1") {
            // load object
            $oTerm->load($soxId);
        }

        $this->addTplParam('aSynList', $oTerm->getSynonymArrayForSynsetId());
        $this->addTplParam('edit', $oTerm);

        return $sRet;
    }

    public function save()
    {
        $soxId   = $this->getEditObjectId();
        $aParams = Registry::get(Request::class)->getRequestEscapedParameter("editval");

        // default values
        $aParams = $this->addDefaultValues($aParams);

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

        $this->setEditObjectId($oTerm->getId());
    }

    /**
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseException
     */
    public function savesynonym()
    {
        $oTerm = oxNew(d3_extsearch_term::class);
        $oTerm->assign(Registry::get(Request::class)->getRequestEscapedParameter('editval'));
        $oTerm->save();

        $this->addTplParam('updatelist', 1);
    }

    public function deletesynonym()
    {
        $oTerm = oxNew(d3_extsearch_term::class);
        $oTerm->delete(Registry::get(Request::class)->getRequestEscapedParameter('deloxid'));

        $this->addTplParam('updatelist', 1);
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
     * @throws DBALException
     * @throws DatabaseConnectionException
     */
    public function getNextSynsetId()
    {
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
        $oSemantic      = oxNew(d3_semantic::class);
        $this->aSynList = $oSemantic->getSynonymListsForWord($this->sSearchTerm);
    }

    public function getSynonymLists()
    {
        return $this->aSynList;
    }

    public function getSearchTerm()
    {
        return $this->sSearchTerm;
    }

    public function getAction()
    {
        return $this->sAction;
    }

    public function getSynsetId()
    {
        return $this->sSynsetId;
    }
}

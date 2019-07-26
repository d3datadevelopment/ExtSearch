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

namespace D3\Extsearch\Application\Controller\Admin;

use D3\Extsearch\Application\Model\d3_search_generator;
use D3\Extsearch\Modules\Application\Model\d3_oxsearch_extsearch;
use D3\ModCfg\Application\Controller\Admin\d3_cfg_mod_main;
use D3\ModCfg\Application\Model\d3utils;
use D3\ModCfg\Application\Model\d3database;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use Doctrine\DBAL\DBALException;
use OxidEsales\Eshop\Application\Controller\Admin\LoginController;
use OxidEsales\Eshop\Application\Model\Search;
use OxidEsales\Eshop\Core\DatabaseProvider;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\FileException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\UtilsView;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;
use OxidEsales\Eshop\Core\TableViewNameGenerator;
use OxidEsales\Eshop\Core\Output;
use Smarty;

class d3_cfg_extsearch_main extends d3_cfg_mod_main
{
    protected $_sThisTemplate = 'd3_cfg_extsearch_main.tpl';

    protected $_sModId = 'd3_extsearch';

    protected $_blUseModCfgStdObject = true;

    public $blSearchColsSet = false;

    public $aSearchCols = array();

    protected $_blHasDebugSwitch = true;

    protected $_blHasTestModeSwitch = false;

    protected $_sDebugHelpTextIdent = 'D3_EXTSEARCH_MAIN_DEBUGACTIVE_DESC';

    protected $_iUnindexedArticles = false;

    public $oD3Generator;
    
    protected $_sHelpLinkMLAdd = 'D3_EXTSEARCH_HELPLINK_CONFIG';

    protected $_sMenuItemTitle = 'd3mxextsearch';

    protected $_sMenuSubItemTitle = 'd3mxextsearch_settings';

    /**
     * constructor
     */
    public function __construct()
    {
        startProfile(__METHOD__);
        if (Registry::get(Request::class)->getRequestEscapedParameter('extlogin')) {
            // fake sToken
            $_GET['stoken'] = Registry::getSession()->getSessionChallengeToken();
            $oLogin         = oxNew(LoginController::class);
            $oLogin->checklogin();
        }

        stopProfile(__METHOD__);

        return parent::__construct();
    }

    /**
     * @return string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function getIndexStatus()
    {
        if ($this->_iUnindexedArticles === false) {
            $this->_iUnindexedArticles = 0;
            startProfile(__METHOD__);

            $this->d3getGenerator()->setGetNewArticlesOnly(true);
            $this->_iUnindexedArticles = $this->d3getGenerator()->getMaxUpdatePos();
            $this->d3getGenerator()->setGetNewArticlesOnly(false);

            stopProfile(__METHOD__);
        }

        return $this->_iUnindexedArticles;
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
        startProfile(__METHOD__);

        $this->addTplParam("oConfig", Registry::getConfig());

        $sRet = parent::render();

        stopProfile(__METHOD__);

        return $sRet;
    }

    /**
     * @return d3_search_generator
     */
    public function d3getGenerator()
    {
        if (!$this->oD3Generator) {
            $this->oD3Generator = oxNew(d3_search_generator::class);
        }

        return $this->oD3Generator;
    }

    /**
     * Generiert aus jedem Artikel auf Grundlage der zu verwendenden Felder den phonetischen Code
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws FileException
     */
    public function generatePhoneticStrings()
    {
        startProfile(__METHOD__);

        /** @var d3utils $oD3Utils */
        $oD3Utils = Registry::get(d3utils::class);

        $iArtPos = $this->d3getGenerator()->getArtPos();

        // bestimmt die maximal zu updatende Anzahl Artikel
        $iMaxPos = Registry::get(Request::class)->getRequestEscapedParameter('iMaxPos');
        if (!$iMaxPos) {
            if (DatabaseProvider::getDb(DatabaseProvider::FETCH_MODE_ASSOC)->getOne($this->getCheckOxartextendsQuery())) {
                $this->showHtmlMessage(
                    Registry::getLang()->translateString('D3_EXTSEARCH_MAIN_GENERATOR_NOTE'),
                    sprintf(Registry::getLang()->translateString('D3_EXTSEARCH_MAIN_GENERATOR_INCONSISTENTTABLE'),
                        $this->getHelpURL())
                );
            }

            // nicht betroffene Artikel auf aktuelles Datum setzen
            $iMaxPos = $this->d3getGenerator()->getMaxUpdatePos();
        }
        $iProcessedArticles = $this->d3getGenerator()->updateArticles();

        if ($iProcessedArticles > 0) {
            $iNewPos = $iArtPos + $iProcessedArticles;

            $aParams = array(
                'cl'      => __CLASS__,
                'fnc'     => __FUNCTION__,
                'iArtPos' => $iNewPos,
                'iMaxPos' => $iMaxPos,
                'type'    => Registry::get(Request::class)->getRequestEscapedParameter('type')
            );
            $sURL    = $oD3Utils->getAdminClassUrl($aParams);

            $this->showProcessingInfos($iArtPos, $iMaxPos, $sURL);
        } else {
            $this->showHtmlMessage(
                Registry::getLang()->translateString('D3_EXTSEARCH_MAIN_GENERATOR_FINISHED'),
                sprintf(Registry::getLang()->translateString('D3_EXTSEARCH_MAIN_GENERATOR_PROCESSED'), $iArtPos)
            );
        }

        Registry::getConfig()->pageClose();
        stopProfile(__METHOD__);
        die();
    }

    /**
     * there is no ticker
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws FileException
     */
    public function generatePhoneticStringsExt()
    {
        startProfile(__METHOD__);

        ignore_user_abort(true);
        $iTimeLimit = Registry::get(Request::class)->getRequestEscapedParameter('iTimeLimit') ?
            Registry::get(Request::class)->getRequestEscapedParameter('iTimeLimit') :
            30;
        @set_time_limit($iTimeLimit);

        $blMsg      = Registry::get(Request::class)->getRequestEscapedParameter('blMsg');
        $iProcessedArticles = $this->d3getGenerator()->updateArticles();

        if (strtoupper($blMsg) == 'true') {
            $this->showHtmlMessage(
                Registry::getLang()->translateString('D3_EXTSEARCH_MAIN_GENERATOR_FINISHED'),
                sprintf(
                    Registry::getLang()->translateString('D3_EXTSEARCH_MAIN_GENERATOR_PROCESSED'),
                    $iProcessedArticles
                )
            );
        }

        Registry::getConfig()->pageClose();
        stopProfile(__METHOD__);
        die();
    }


    /**
     * @param $sArtPos
     * @param $iMaxPos
     * @param $sURL
     */
    public function showProcessingInfos($sArtPos, $iMaxPos, $sURL)
    {
        startProfile(__METHOD__);

        $iProcessedPercent = 0;
        if ($sArtPos > 0) {
            $iPercent          = 100 / $iMaxPos * $sArtPos;
            $iProcessedPercent = floor($iPercent);
        }

        $sTitle = sprintf(
            Registry::getLang()->translateString('D3_EXTSEARCH_MAIN_GENERATOR_PROCESSING'),
            $iProcessedPercent
        );

        /** @var $smarty Smarty */
        $smarty = Registry::get(UtilsView::class)->getSmarty();
        $smarty->assign('sCharset', $this->getCharSet());
        $smarty->assign('sTitle', $sTitle);
        $smarty->assign('sRefreshUrl', $sURL);
        $smarty->assign('sMessage', sprintf(
            Registry::getLang()->translateString('D3_EXTSEARCH_MAIN_GENERATOR_PROCESSING1'),
            (string) $sArtPos,
            (string) $iMaxPos
        ));
        if ($sArtPos > 0) {
            $smarty->assign('iProgressPercent', $iProcessedPercent);
        }
        $smarty->assign('blWait', true);

        $sTplFile = 'd3_extsearch_popup.tpl';

        $outputManager = oxNew(Output::class);
        $outputManager->setCharset(Registry::getConfig()->getActiveView()->getCharSet());
        $outputManager->sendHeaders();
        $outputManager->output('content', $smarty->fetch($sTplFile));
        Registry::getConfig()->pageClose();
        $outputManager->flushOutput();

        stopProfile(__METHOD__);
    }

    /**
     * @return string
     * @throws DBALException
     */
    protected function getCheckOxartextendsQuery()
    {
        $oTableViewNameGenerator = Registry::get(TableViewNameGenerator::class);
        $sArtTblName = $oTableViewNameGenerator->getViewName('oxarticles');
        $sArtExtTblName = $oTableViewNameGenerator->getViewName('oxartextends');

        $oQB = d3database::getInstance()->getQueryBuilder();
        $oQB->select('count(oa.oxid)')
            ->from($sArtTblName, 'oa')
            ->leftJoin('oa', $sArtExtTblName, 'oae', 'oa.oxid = oae.oxid')
            ->where('oae.oxid IS NULL')
            ->setMaxResults(1);
        return $oQB->getSQL();
    }

    /**
     * Generiert aus jedem Semantic-Lexikoneintrag den phonetischen Code
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws FileException
     */
    public function generatePhoneticSemantic()
    {
        startProfile(__METHOD__);

        /** @var d3utils $oD3Utils */
        $oD3Utils = Registry::get(d3utils::class);

        $iTermPos  = Registry::get(Request::class)->getRequestEscapedParameter('iTermPos');
        if (!$iTermPos) {
            $iTermPos = 0;
        }

        $iMaxPos = Registry::get(Request::class)->getRequestEscapedParameter('iMaxPos');
        if (!$iMaxPos) {
            $iMaxPos = $this->d3getGenerator()->getMaxSemanticUpdatePos();
        }

        $iProcessedTerms = $this->d3getGenerator()->updateSemantics($iTermPos);

        if ($iProcessedTerms > 0) {
            $iNewPos = $iTermPos + $iProcessedTerms;

            $aParams = array(
                'cl'       => __CLASS__,
                'fnc'      => __FUNCTION__,
                'iTermPos' => $iNewPos,
                'iMaxPos'  => $iMaxPos,
            );
            $sURL    = $oD3Utils->getAdminClassUrl($aParams);

            $this->showProcessingSemanticInfos($iTermPos, $iMaxPos, $sURL);

        } else {
            $this->showHtmlMessage(
                Registry::getLang()->translateString('D3_EXTSEARCH_MAIN_GENERATOR_FINISHED'),
                sprintf(Registry::getLang()->translateString('D3_EXTSEARCH_MAIN_GENERATOR_TERMPROCESSED'), $iTermPos)
            );
        }

        Registry::getConfig()->pageClose();
        stopProfile(__METHOD__);
        die();
    }

    /**
     * @param $iTermPos
     * @param $iMaxPos
     * @param $sURL
     */
    public function showProcessingSemanticInfos($iTermPos, $iMaxPos, $sURL)
    {
        $iProcessedPercent = 0;
        if ($iTermPos > 0) {
            $iPercent          = 100 / $iMaxPos * $iTermPos;
            $iProcessedPercent = floor($iPercent);
        }

        $sTitle = sprintf(
            Registry::getLang()->translateString('D3_EXTSEARCH_MAIN_GENERATOR_PROCESSING'),
            $iProcessedPercent
        );

        /** @var $smarty Smarty */
        $smarty = Registry::get(UtilsView::class)->getSmarty();
        $smarty->assign('sCharset', $this->getCharSet());
        $smarty->assign('sTitle', $sTitle);
        $smarty->assign('sRefreshUrl', $sURL);
        $smarty->assign('sMessage', sprintf(
            Registry::getLang()->translateString('D3_EXTSEARCH_MAIN_GENERATOR_PROCESSING3'),
            (string) $iTermPos,
            (string) $iMaxPos
        ));
        if ($iTermPos > 0) {
            $smarty->assign('iProgressPercent', $iProcessedPercent);
        }
        $smarty->assign('blWait', true);

        $sTplFile = 'd3_extsearch_popup.tpl';

        $outputManager = oxNew(Output::class);
        $outputManager->setCharset(Registry::getConfig()->getActiveView()->getCharSet());
        $outputManager->sendHeaders();
        $outputManager->output('content', $smarty->fetch($sTplFile));
        Registry::getConfig()->pageClose();
        $outputManager->flushOutput();
    }

    /**
     * @param $sTitle
     * @param $sMessage
     */
    public function showHtmlMessage($sTitle, $sMessage)
    {
        $sCharSet = "UTF-8";

        /** @var $smarty Smarty */
        $smarty = Registry::get(UtilsView::class)->getSmarty();
        $smarty->assign('sCharset', $sCharSet);
        $smarty->assign('sTitle', $sTitle);
        $smarty->assign('sMessage', $sMessage);
        $sTplFile = 'd3_extsearch_popup.tpl';

        $outputManager = oxNew(Output::class);
        $outputManager->setCharset(Registry::getConfig()->getActiveView()->getCharSet());
        $outputManager->sendHeaders();
        $outputManager->output('content', $smarty->fetch($sTplFile));
        Registry::getConfig()->pageClose();
        $outputManager->flushOutput();

        die();
    }

    /**
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function startSortAnalysis()
    {
        $aParams = array(
            'cl'       => __CLASS__,
            'fnc'      => __FUNCTION__,
        );
        $aAllList = array();
        $aUsedFields = array();
        $aFieldNames = array();

        /** @var $smarty Smarty */
        $smarty = Registry::get(UtilsView::class)->getSmarty();
        $smarty->assign('sCharSet', $this->getCharSet());
        $smarty->assign('sFormUrl', d3utils::getInstance()->getAdminClassUrl($aParams));
        $smarty->assign('sHiddenSid', $this->getViewConfig()->getHiddenSid());
        $smarty->assign('sClass', __CLASS__);
        $smarty->assign('sFnc', __FUNCTION__);
        $smarty->assign('sSearchParam', Registry::get(Request::class)->getRequestEscapedParameter('searchparam'));

        if (Registry::get(Request::class)->getRequestEscapedParameter('searchparam')) {
            /** @var d3_oxsearch_extsearch|Search $oSearch */
            $oSearch = oxNew(Search::class);
            $aAllList = $oSearch->d3GetPriorityDebugArticleList();
            $aAllKeys = array_keys($aAllList);
            $aAllowedFields = array('oxartnum', 'oxtitle', 'oxvarselect', 'd3push', 'd3priority');

            if (count($aAllList)) {
                foreach (array_keys($aAllList[$aAllKeys[0]]) as $sFieldName) {
                    if (in_array(strtolower($sFieldName), $aAllowedFields) || strstr($sFieldName, '_IN_')) {
                        $aUsedFields[] = $sFieldName;
                        if (strstr($sFieldName, '_IN_') && strstr($sFieldName, '@@')) {
                            $sFieldName = $this->translateAnalysisFields($sFieldName);
                        }
                        $aFieldNames[] = $sFieldName;
                    }
                }
            }
        }

        $smarty->assign('aUsedFields', $aUsedFields);
        $smarty->assign('aFieldNames', $aFieldNames);
        $smarty->assign('aAllList', $aAllList);

        $sTplFile = 'd3_cfg_extsearch_main_sortanalysis.tpl';
        $sContent = $smarty->fetch($sTplFile);

        $outputManager = oxNew(Output::class);
        $outputManager->setCharset(Registry::getConfig()->getActiveView()->getCharSet());
        $outputManager->sendHeaders();
        $outputManager->output('content', $sContent);
        Registry::getConfig()->pageClose();
        $outputManager->flushOutput();
        die();
    }

    public function translateAnalysisFields($sFieldName)
    {
        $aFieldName = explode('@@', $sFieldName);
        $searchParam = $aFieldName[0];
        $sTranslationIdent = "D3_EXTSEARCH_MAIN_SORTDEBUG" . $aFieldName[1];
        $sFieldName = $aFieldName[2];

        $sTranslation = sprintf(Registry::getLang()->translateString($sTranslationIdent), $searchParam, $sFieldName);

        return $sTranslation;
    }

    /**
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function save()
    {
        startProfile(__METHOD__);

        parent::save();

        $myConfig = Registry::getConfig();
        $sShopId  = Registry::getConfig()->getShopId();

        $aConfVars = Registry::get(Request::class)->getRequestEscapedParameter('confbools');

        if (is_array($aConfVars)) {
            foreach ($aConfVars as $sName => $sValue) {
                $myConfig->saveShopConfVar(
                    'bool',
                    $sName,
                    $sValue,
                    $sShopId
                );
            }
        }

        stopProfile(__METHOD__);
    }

    /**
     * @return int
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function getArticleCountPerTick()
    {
        return $this->d3getGenerator()->getArticleCountPerTick();
    }

    /**
     * @return array
     * @throws FileException
     */
    public function getPhoneticLanguages()
    {
        return $this->d3getGenerator()->getPhoneticLanguages();
    }

    /**
     * @return mixed
     */
    public function d3getFilterPageId()
    {
        $sPageId = "search##".
            Registry::getLang()->getLanguageAbbr()."##".
            Registry::getConfig()->getShopId()."##".
            md5(rawurlencode(strtolower(Registry::get(Request::class)->getRequestEscapedParameter('searchparam'))));

        return $sPageId;
    }
}

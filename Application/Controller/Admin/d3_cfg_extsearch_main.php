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
use D3\Extsearch\Application\Model\d3_search_generator;
use D3\Extsearch\Core\d3_extsearch_conf;
use D3\Extsearch\Modules\Application\Model\d3_oxsearch_extsearch;
use D3\ModCfg\Application\Controller\Admin\d3_cfg_mod_main;
use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\d3database;
use D3\ModCfg\Application\Model\d3utils;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use Doctrine\DBAL\Exception as DBALException;
use Doctrine\DBAL\Query\QueryBuilder;
use OxidEsales\Eshop\Application\Model\Article;
use OxidEsales\Eshop\Application\Model\Search;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\FileException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Model\MultiLanguageModel;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;
use OxidEsales\Eshop\Core\Output;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Database\QueryBuilderFactoryInterface;
use OxidEsales\EshopCommunity\Internal\Framework\Templating\TemplateRenderer;
use OxidEsales\EshopCommunity\Internal\Framework\Templating\TemplateRendererBridgeInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use RuntimeException;

class d3_cfg_extsearch_main extends d3_cfg_mod_main
{
    protected $_sThisTemplate = '@'. Constants::OXID_MODULE_ID .'/admin/d3_cfg_extsearch_main';

    protected $_sModId = 'd3_extsearch';

    protected $_blUseModCfgStdObject = true;

    public $blSearchColsSet = false;

    public $aSearchCols = [];

    protected $_blHasDebugSwitch = true;

    protected $_blHasTestModeSwitch = false;

    protected $_sDebugHelpTextIdent = 'D3_EXTSEARCH_MAIN_DEBUGACTIVE_DESC';

    protected $_iUnindexedArticles = false;

    public $oD3Generator;

    protected $_sHelpLinkMLAdd = 'D3_EXTSEARCH_HELPLINK_CONFIG';

    protected $_sMenuItemTitle = 'D3MXEXTSEARCH';

    protected $_sMenuSubItemTitle = 'D3MXEXTSEARCH_SETTINGS';

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

            try {
                $this->_iUnindexedArticles = $this->d3getGenerator()->getMaxUpdatePos();
            } catch (DatabaseErrorException $e) {
            }

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

        $this->assertSearchFields();

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
    public function generatePhoneticStrings(): void
    {
        startProfile(__METHOD__);

        /** @var d3utils $oD3Utils */
        $oD3Utils = Registry::get(d3utils::class);

        $iArtPos = $this->d3getGenerator()->getArtPos();

        // bestimmt die maximal zu updatende Anzahl Artikel
        $iMaxPos = Registry::get(Request::class)->getRequestEscapedParameter('iMaxPos');
        if (!$iMaxPos) {
            if ($this->getCheckOxartextendsQuery()->execute()->fetchOne()) {
                $this->showHtmlMessage(
                    Registry::getLang()->translateString('D3_EXTSEARCH_MAIN_GENERATOR_NOTE'),
                    sprintf(
                        Registry::getLang()->translateString('D3_EXTSEARCH_MAIN_GENERATOR_INCONSISTENTTABLE'),
                        $this->getHelpURL()
                    )
                );
            }

            // nicht betroffene Artikel auf aktuelles Datum setzen
            $iMaxPos = $this->d3getGenerator()->getMaxUpdatePos();
        }

        try {
            $iProcessedArticles = $this->d3getGenerator()->updateArticles();
        } catch (RuntimeException $e) {
            die($e->getMessage());
        }

        if ($iProcessedArticles > 0) {
            $iNewPos = $iArtPos + $iProcessedArticles;

            $aParams = [
                'cl'      => $this->getClassKey(),
                'fnc'     => __FUNCTION__,
                'iArtPos' => $iNewPos,
                'iMaxPos' => $iMaxPos,
                'type'    => Registry::get(Request::class)->getRequestEscapedParameter('type'),
            ];
            $sURL    = $oD3Utils->getAdminClassUrl($aParams);

            $this->showProcessingInfos($iArtPos, $iMaxPos, $sURL);
        } else {
            $this->showHtmlMessage(
                Registry::getLang()->translateString('D3_EXTSEARCH_MAIN_GENERATOR_FINISHED'),
                sprintf(
                    Registry::getLang()->translateString('D3_EXTSEARCH_MAIN_GENERATOR_PROCESSED'),
                    (string) $iArtPos,
                    (string) ceil($iArtPos / count(Registry::getLang()->getLanguageIds()))
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

        $templateRenderer = $this->getTemplateRenderer();
        $context = [
            'sCharset'  => $this->getCharSet(),
            'sTitle'    => $sTitle,
            'sRefreshUrl'   => $sURL,
            'sMessage'  => sprintf(
                Registry::getLang()->translateString('D3_EXTSEARCH_MAIN_GENERATOR_PROCESSING1'),
                (string) $sArtPos,
                (string) $iMaxPos,
                (string) ceil($sArtPos / count(Registry::getLang()->getLanguageIds()))
            ),
            'iProgressPercent'  => $sArtPos > 0 ? $iProcessedPercent : null,
            'blWait'            => true,
        ];

        $sTplFile = '@'. Constants::OXID_MODULE_ID .'/admin/d3_extsearch_popup';

        $outputManager = oxNew(Output::class);
        $outputManager->setCharset(Registry::getConfig()->getActiveView()->getCharSet());
        $outputManager->sendHeaders();
        $outputManager->output('content', $templateRenderer->renderTemplate($sTplFile, $context));
        Registry::getConfig()->pageClose();
        $outputManager->flushOutput();

        stopProfile(__METHOD__);
    }

    /**
     * @return TemplateRenderer
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected function getTemplateRenderer(): TemplateRenderer
    {
        return ContainerFactory::getInstance()->getContainer()
             ->get(TemplateRendererBridgeInterface::class)
             ->getTemplateRenderer();
    }

    /**
     * @return QueryBuilder
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getCheckOxartextendsQuery(): QueryBuilder
    {
        $oArt = oxNew(Article::class);
        $sArtTblName = $oArt->getViewName();
        $oArtExtends = oxNew(MultiLanguageModel::class);
        $oArtExtends->init('oxartextends');
        $sArtExtTblName = $oArtExtends->getViewName();

        $oQB = ContainerFactory::getInstance()->getContainer()->get(QueryBuilderFactoryInterface::class)->create();
        $oQB->select('count(oa.oxid)')
            ->from($sArtTblName, 'oa')
            ->leftJoin('oa', $sArtExtTblName, 'oae', 'oa.oxid = oae.oxid')
            ->where('oae.oxid IS NULL')
            ->setMaxResults(1);
        return $oQB;
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

        try {
            $iProcessedTerms = $this->d3getGenerator()->updateSemantics($iTermPos);
        } catch (RuntimeException $e) {
            die($e->getMessage());
        }

        if ($iProcessedTerms > 0) {
            $iNewPos = $iTermPos + $iProcessedTerms;

            $aParams = [
                'cl'       => $this->getClassKey(),
                'fnc'      => __FUNCTION__,
                'iTermPos' => $iNewPos,
                'iMaxPos'  => $iMaxPos,
            ];
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

        $templateRenderer = $this->getTemplateRenderer();
        $context = [
            'sCharset'  => $this->getCharSet(),
            'sTitle'    => $sTitle,
            'sRefreshUrl'   => $sURL,
            'sMessage'  => sprintf(
                Registry::getLang()->translateString('D3_EXTSEARCH_MAIN_GENERATOR_PROCESSING3'),
                (string) $iTermPos,
                (string) $iMaxPos
            ),
            'iProgressPercent'  => $iTermPos > 0 ? $iProcessedPercent : null,
            'blWait'    => true,
        ];

        $sTplFile = '@'. Constants::OXID_MODULE_ID .'/admin/d3_extsearch_popup';

        $outputManager = oxNew(Output::class);
        $outputManager->setCharset(Registry::getConfig()->getActiveView()->getCharSet());
        $outputManager->sendHeaders();
        $outputManager->output('content', $templateRenderer->renderTemplate($sTplFile, $context));
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

        $templateRenderer = $this->getTemplateRenderer();
        $context = [
            'sCharset'  => $sCharSet,
            'sTitle'    => $sTitle,
            'sMessage'  => $sMessage,
        ];
        $sTplFile = '@'. Constants::OXID_MODULE_ID .'/admin/d3_extsearch_popup';

        $outputManager = oxNew(Output::class);
        $outputManager->setCharset(Registry::getConfig()->getActiveView()->getCharSet());
        $outputManager->sendHeaders();
        $outputManager->output('content', $templateRenderer->renderTemplate($sTplFile, $context));
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
        $aParams = [
            'cl'       => $this->getClassKey(),
            'fnc'      => __FUNCTION__,
        ];
        $aAllList = [];
        $aUsedFields = [];
        $aFieldNames = [];

        $templateRenderer = $this->getTemplateRenderer();
        $context = [
            'sCharSet'  => $this->getCharSet(),
            'sFormUrl'  => d3utils::getInstance()->getAdminClassUrl($aParams),
            'sHiddenSid' => $this->getViewConfig()->getHiddenSid(),
            'sClass'    => $this->getClassKey(),
            'sFnc'      => __FUNCTION__,
            'sSearchParam'  => Registry::get(Request::class)->getRequestEscapedParameter('searchparam'),
        ];

        if (Registry::get(Request::class)->getRequestEscapedParameter('searchparam')) {
            /** @var d3_oxsearch_extsearch $oSearch */
            $oSearch = oxNew(Search::class);
            $aAllList = $oSearch->d3GetPriorityDebugArticleList();
            $aAllKeys = array_keys($aAllList);
            $aAllowedFields = [ 'oxartnum', 'oxtitle', 'oxvarselect', 'd3push', 'd3priority' ];

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

        $context['aUsedFields'] = $aUsedFields;
        $context['aFieldNames'] = $aFieldNames;
        $context['aAllList']    = $aAllList;

        $sTplFile = '@'. Constants::OXID_MODULE_ID .'/admin/d3_cfg_extsearch_main_sortanalysis';
        $sContent = $templateRenderer->renderTemplate($sTplFile, $context);

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

        return sprintf(Registry::getLang()->translateString($sTranslationIdent), $searchParam, $sFieldName);
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
     * @return void
     * @throws ContainerExceptionInterface
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws NotFoundExceptionInterface
     */
    protected function assertSearchFields()
    {
        $fields = d3_cfg_mod::get($this->_sModId)->getValue('aExtSearch_similarSearchFields');
        $connection = d3database::getInstance()->getDBConnection();

        $sSelectOa = 'SHOW FULL COLUMNS FROM '. $connection->quoteIdentifier(oxNew(Article::class)->getCoreTableName());
        $sSelectOae = 'SHOW FULL COLUMNS FROM '. $connection->quoteIdentifier('oxartextends');
        $records = array_merge(
            $connection->prepare($sSelectOae)->executeQuery()->fetchAllAssociative(),
            $connection->prepare($sSelectOa)->executeQuery()->fetchAllAssociative()
        );

        $usedCollation = null;
        $differentCollationFields = [];
        $missingFields = [];

        array_walk($records, function ($item) use (&$usedCollation) {
            if ($item['Field'] === 'OXTITLE') {
                $usedCollation = $item['Collation'];
            }
        });

        foreach ($fields as $fieldname) {
            $exists = false;
            $re = '/(\d+\s*=>\s*)?(.*)\s?/m';
            preg_match($re, $fieldname, $matches);
            $fieldname = trim($matches[2]);
            reset($records);
            array_walk($records, function ($item) use ($usedCollation, $fieldname, &$exists, &$differentCollationFields) {
                if ($item['Field'] === strtoupper($fieldname)) {
                    $exists = true;
                }
                if ($item['Field'] === strtoupper($fieldname) && $item['Collation'] !== null && $item['Collation'] !== $usedCollation) {
                    $differentCollationFields[] = $fieldname;
                }
            });
            if (!$exists) {
                $missingFields[] = $fieldname;
            }
        }

        if (count($differentCollationFields)) {
            Registry::getUtilsView()->addErrorToDisplay(
                sprintf(
                    Registry::getLang()->translateString('D3_EXTSEARCH_MAIN_COLLATIONERROR'),
                    '"'.implode('", "', array_unique($differentCollationFields)).'"'
                )
            );
        }
        if (count($missingFields)) {
            Registry::getUtilsView()->addErrorToDisplay(
                sprintf(
                    Registry::getLang()->translateString('D3_EXTSEARCH_MAIN_NOTEXISTINGFIELDS'),
                    '"'.implode('", "', array_unique($missingFields)).'"'
                )
            );
        }
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
        return "search##".
            Registry::getLang()->getLanguageAbbr()."##".
            Registry::getConfig()->getShopId()."##".
            md5(rawurlencode(strtolower(Registry::get(Request::class)->getRequestEscapedParameter('searchparam'))));
    }

    /**
     * @return bool
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     */
    public function d3UseAlistFilters()
    {
        return $this->d3GetSet()->getLicenseConfigData(d3_extsearch_conf::SERIAL_BIT_HAS_FILTERS_IN_ALIST, false) || $this->d3GetSet()->isDemo();
    }
}

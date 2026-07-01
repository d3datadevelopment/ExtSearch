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

namespace D3\Extsearch\Application\Controller;

use D3\Extsearch\Application\Model\d3_search;
use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use Doctrine\DBAL\Exception as DBALException;
use OxidEsales\Eshop\Core\ConfigFile;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Output;
use OxidEsales\Eshop\Core\Controller\BaseController;

class d3_extsearch_response extends BaseController
{
    private $_sModId = 'd3_extsearch';

    public $oD3SearchHandler;

    public function render()
    {
        throw oxNew(StandardException::class, 'missing function name');
    }

    /**
     * @param $aParams
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws StandardException
     */
    public function getSuggestContent()
    {
        startProfile(__METHOD__);

        Registry::getConfig()->setActiveView($this);

        ob_start();

        // disable displaying debug informations, that will destroy JSON document
        // parameter "d3forcedebug=1" enables forced debug mode
        $forcedDebug = (bool) Registry::getRequest()->getRequestEscapedParameter('d3forcedebug');

        if (!$forcedDebug) {
            Registry::getConfig()->setConfigParam('iDebug', 0);
            Registry::get(ConfigFile::class)->setVar('iDebug', 0);
        }

        $outputManager = oxNew(Output::class);
        $outputManager->setCharset(Registry::getConfig()->getActiveView()->getCharSet());
        $outputManager->setOutputFormat($forcedDebug ? Output::OUTPUT_FORMAT_HTML : Output::OUTPUT_FORMAT_JSON);
        $outputManager->sendHeaders();

        // fetch debug contents and add it after suggest window
        $sContent = $this->_getD3SearchHandler()->suggestGetContent(
            Registry::getRequest()->getRequestEscapedParameter('searchParam')
        );
        $sContent .= ob_get_contents();
        ob_end_clean();

        $outputManager->output('searchparam', Registry::getRequest()->getRequestEscapedParameter('searchParam'));
        $outputManager->output('content', $sContent);

        Registry::getConfig()->pageClose();
        $outputManager->flushOutput();

        $this->_addProfiling();

        stopProfile(__METHOD__);

        Registry::getConfig()->pageClose();
        exit;
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
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    protected function _addProfiling()
    {
        startProfile(__METHOD__);

        d3_cfg_mod::get($this->_sModId)->d3getLog()->d3GetProfiling();

        stopProfile(__METHOD__);
    }

    /**
     * @return string
     */
    public function d3getFilterPageId()
    {
        /** @var array<string|int, mixed> $mArgs */
        $mArgs = func_get_args();

        $sPageId = "search##".
            Registry::getLang()->getLanguageAbbr()."##".
            Registry::getConfig()->getShopId()."##".
            md5(rawurlencode(strtolower($mArgs['searchParam'])));

        return $sPageId;
    }
}

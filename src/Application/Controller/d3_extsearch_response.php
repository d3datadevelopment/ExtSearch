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

namespace D3\Extsearch\Application\Controller;

use D3\Extsearch\Application\Model\d3_search;
use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use Doctrine\DBAL\DBALException;
use OxidEsales\Eshop\Core\ConfigFile;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Controller\BaseController;
use OxidEsales\Eshop\Core\Output;

class d3_extsearch_response extends BaseController
{
    private $_sModId = 'd3_extsearch';

    public $oD3SearchHandler;

    /**
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function init()
    {
        startProfile(__METHOD__);

        Registry::getConfig()->setActiveView($this);

        $mArgs = func_get_args();
        $mArgs = array_change_key_case($mArgs[0], CASE_LOWER);

        if (is_array($mArgs) && count($mArgs) && isset($mArgs['fnc'])) {
            call_user_func_array(array($this, $mArgs['fnc']), array($mArgs));
        }

        $this->_addProfiling();

        stopProfile(__METHOD__);
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
    public function getSuggestContent($aParams)
    {
        startProfile(__METHOD__);

        ob_start();

        // disable displaying debug informations, that will destroy JSON document
        Registry::getConfig()->setConfigParam('iDebug', 0);
        Registry::get(ConfigFile::class)->setVar( 'iDebug', 0);

        $outputManager = oxNew(Output::class);
        $outputManager->setCharset(Registry::getConfig()->getActiveView()->getCharSet());
        $outputManager->setOutputFormat(Output::OUTPUT_FORMAT_JSON);
        $outputManager->sendHeaders();

        // fetch debug contents and add it after suggest window
        $sContent = $this->_getD3SearchHandler()->suggestGetContent($aParams['searchparam']);
        $sContent .= ob_get_contents();
        ob_end_clean();

        $outputManager->output('searchparam', $aParams['searchparam']);
        $outputManager->output('content', $sContent);

        Registry::getConfig()->pageClose();
        $outputManager->flushOutput();

        stopProfile(__METHOD__);
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
        $mArgs = func_get_args();

        $sPageId = "search##".
            Registry::getLang()->getLanguageAbbr()."##".
            Registry::getConfig()->getShopId()."##".
            md5(rawurlencode(strtolower($mArgs['searchParam'])));

        return $sPageId;
    }
}

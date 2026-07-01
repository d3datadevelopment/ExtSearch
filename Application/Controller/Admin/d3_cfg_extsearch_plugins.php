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
use D3\ModCfg\Application\Controller\Admin\d3_cfg_mod_main;
use D3\ModCfg\Application\Model\d3filesystem;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use Doctrine\DBAL\Exception as DBALException;
use OxidEsales\Eshop\Application\Model\Shop;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Output;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Templating\TemplateRenderer;
use OxidEsales\EshopCommunity\Internal\Framework\Templating\TemplateRendererBridgeInterface;

class d3_cfg_extsearch_plugins extends d3_cfg_mod_main
{
    protected $_sThisTemplate = '@'. Constants::OXID_MODULE_ID .'/admin/d3_cfg_extsearch_plugins';

    protected $_sModId = 'd3_extsearch';

    protected $_sOldPluginName = 'se_browserinstall.xml';

    protected $_sHelpLinkMLAdd = 'D3_EXTSEARCH_HELPLINK_CONFIG';

    protected $_sMenuItemTitle = 'D3MXEXTSEARCH';

    protected $_sMenuSubItemTitle = 'D3MXEXTSEARCH_SETTINGS';

    /**
     * ruft oxutils-Funktion auf, die vom Template aus nicht verfuegbar ist
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     */
    public function save()
    {
        if ($_FILES['value']['name']['sExtSearch_PluginIcon']) {
            if (copy(
                $_FILES['value']['tmp_name']['sExtSearch_PluginIcon'],
                Registry::getConfig()->getConfigParam(
                    'sShopDir'
                ) . $_FILES['value']['name']['sExtSearch_PluginIcon']
            )
            ) {
                $oSet = $this->d3GetSet();
                $oSet->setValue('sExtSearch_PluginIcon', $_FILES['value']['name']['sExtSearch_PluginIcon']);
                $oSet->save();
            };
        }

        parent::save();

        return;
    }

    /**
     * @return string
     */
    public function getPluginFileName()
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

        return $sFileName;
    }

    /**
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function generatePluginFile()
    {
        $oShop = Registry::getConfig()->getActiveShop();

        /** @var d3filesystem $oFS */
        $oFS = oxNew(d3filesystem::class);

        $sIconData     = false;
        $blHasIcon = false;
        $aImgInfo = [];
        if ($this->d3GetSet()->getValue('sExtSearch_PluginIcon')) {
            $sImgPath   = $oFS->trailingslashit(Registry::getConfig()->getConfigParam('sShopDir')) .
                $this->d3GetSet()->getValue('sExtSearch_PluginIcon');
            $aImgInfo = getimagesize($sImgPath);
            $fp_img   = fopen($sImgPath, "r");
            $sIconData     = fread($fp_img, filesize($sImgPath));
            fclose($fp_img);
            $blHasIcon = count($aImgInfo) ? true : false;
        }

        $templateRenderer = $this->getTemplateRenderer();
        $sTplFile = '@'. Constants::OXID_MODULE_ID .'/admin/d3_extsearch_plugin';
        $context = [
            'oShop'         => $oShop,
            'blHasIcon'     => $blHasIcon,
            'aImgInfo'      => $aImgInfo,
            'sBase64Icon'   => base64_encode($sIconData),
            'sShopUrl'      => Registry::getConfig()->getConfigParam('sShopURL'),
        ];
        $sFileContent = $templateRenderer->renderTemplate($sTplFile, $context);

        $sFileName = $oFS->trailingslashit(Registry::getConfig()->getConfigParam('sShopDir')) .
            $this->getPluginFileName();

        $sMessage = $oFS->createFile($sFileName, $sFileContent, true)
            ? Registry::getLang()->translateString('D3_EXTSEARCH_PLUGIN_CREATE_SUCC')
            : Registry::getLang()->translateString('D3_EXTSEARCH_PLUGIN_CREATE_NSUCC');

        $sCharSet = "UTF-8";
        $sTitle = Registry::getLang()->translateString('D3_EXTSEARCH_MAIN_GENERATOR_NOTE');

        $context = [
            'sCharset'  => $sCharSet,
            'sTitle'    => $sTitle,
            'sMessage'  => $sMessage,
        ];
        $sTplFile = '@'. Constants::OXID_MODULE_ID .'/admin/d3_extsearch_popup';
        $content = $templateRenderer->renderTemplate($sTplFile, $context);

        $outputManager = oxNew(Output::class);
        $outputManager->setCharset(Registry::getConfig()->getActiveView()->getCharSet());
        $outputManager->sendHeaders();
        $outputManager->output('content', $content);
        Registry::getConfig()->pageClose();
        $outputManager->flushOutput();

        die();
    }

    protected function getTemplateRenderer(): TemplateRenderer
    {
        return ContainerFactory::getInstance()->getContainer()
            ->get(TemplateRendererBridgeInterface::class)
            ->getTemplateRenderer();
    }
}

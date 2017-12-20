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

use D3\ModCfg\Application\Controller\Admin\d3_cfg_mod_main;
use D3\ModCfg\Application\Model\d3filesystem;
use OxidEsales\Eshop\Core\UtilsView;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Output;

class d3_cfg_extsearch_plugins extends d3_cfg_mod_main
{
    protected $_sThisTemplate = "d3_cfg_extsearch_plugins.tpl";

    protected $_sModId = 'd3_extsearch';

    protected $_sOldPluginName = 'se_browserinstall.xml';
    
    protected $_sHelpLinkMLAdd = 'D3_EXTSEARCH_HELPLINK_CONFIG';

    protected $_sMenuItemTitle = 'd3mxextsearch';

    protected $_sMenuSubItemTitle = 'd3mxextsearch_settings';

    /**
     * ruft oxutils-Funktion auf, die vom Template aus nicht verfuegbar ist
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

    public function generatePluginFile()
    {
        $oShop = Registry::getConfig()->getActiveShop();

        /** @var d3filesystem $oFS */
        $oFS = oxNew(d3filesystem::class);

        $sIconData     = false;
        $blHasIcon = false;
        $aImgInfo = array();
        if ($this->d3GetSet()->getValue('sExtSearch_PluginIcon')) {
            $sImgPath   = $oFS->trailingslashit(Registry::getConfig()->getConfigParam('sShopDir')) .
                $this->d3GetSet()->getValue('sExtSearch_PluginIcon');
            $aImgInfo = getimagesize($sImgPath);
            $fp_img   = fopen($sImgPath, "r");
            $sIconData     = fread($fp_img, filesize($sImgPath));
            fclose($fp_img);
            $blHasIcon = count($aImgInfo) ? true : false;
        }

        /** @var $smarty \Smarty */
        $smarty = Registry::get(UtilsView::class)->getSmarty();
        $smarty->assign('oShop', $oShop);
        $smarty->assign('blHasIcon', $blHasIcon);
        $smarty->assign('aImgInfo', $aImgInfo);
        $smarty->assign('sBase64Icon', base64_encode($sIconData));
        $smarty->assign('sShopUrl', Registry::getConfig()->getConfigParam('sShopURL'));
        $sTplFile = 'd3_extsearch_plugin.tpl';
        $sFileContent = $smarty->fetch($sTplFile);

        $sFileName = $oFS->trailingslashit(Registry::getConfig()->getConfigParam('sShopDir')) .
            $this->getPluginFileName();
        $sMessage = $oFS->createFile($sFileName, $sFileContent, true)
            ? Registry::getLang()->translateString('D3_EXTSEARCH_PLUGIN_CREATE_SUCC')
            : Registry::getLang()->translateString('D3_EXTSEARCH_PLUGIN_CREATE_NSUCC');

        $sCharSet = "UTF-8";
        $sTitle = Registry::getLang()->translateString('D3_EXTSEARCH_MAIN_GENERATOR_NOTE');

        /** @var $smarty \Smarty */
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
}

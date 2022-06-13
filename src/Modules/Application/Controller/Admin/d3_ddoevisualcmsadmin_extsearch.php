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

namespace D3\Extsearch\Modules\Application\Controller\Admin;

use OxidEsales\Eshop\Application\Model\Content;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;

class d3_ddoevisualcmsadmin_extsearch extends d3_ddoevisualcmsadmin_extsearch_parent
{
    public function render()
    {
        $sRet = parent::render();

        $this->addTplParam('sOriginalTplName', $sRet);
        $sRet = 'd3_ddeovisualcmsadmin_extsearch.tpl';

        return $sRet;
    }

    public function d3GetIsSearchStatus()
    {
        $oContent = oxNew(Content::class);
        if (($oContent->load(Registry::get(Request::class)->getRequestEscapedParameter('id')))
            && $oContent->getFieldData('d3issearchable')
        ) {
            echo 'true';
        } else {
            echo "false";
        }

        die();
    }
}
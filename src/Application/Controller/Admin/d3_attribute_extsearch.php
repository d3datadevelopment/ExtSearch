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

use D3\Extsearch\Application\Controller\Admin\Popups\d3_attribute2category_extsearch_ajax;
use D3\Extsearch\Application\Controller\Admin\Popups\d3_attribute2manufacturer_extsearch_ajax;
use D3\Extsearch\Application\Controller\Admin\Popups\d3_attribute2vendor_extsearch_ajax;
use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use Doctrine\DBAL\DBALException;
use Exception;
use OxidEsales\Eshop\Application\Controller\Admin\AdminDetailsController;
use OxidEsales\Eshop\Application\Model\Attribute;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;

class d3_attribute_extsearch extends AdminDetailsController
{
    /**
     * Current class template name.
     *
     * @var string
     */
    protected $_sThisTemplate = 'd3_attribute_extsearch.tpl';

    /**
     * @return string
     */
    public function render()
    {
        $sRet = parent::render();

        $soxId = $this->getEditObjectId();
        $this->addTplParam("oxid", $soxId);

        if ($soxId != "-1" && isset($soxId)) {
            /** @var Attribute $oItem */
            $oItem = oxNew(Attribute::class);
            $oItem->load($soxId);
            $this->addTplParam("edit", $oItem);
        }

        $iAoc = Registry::get(Request::class)->getRequestEscapedParameter("aoc");
        if ($iAoc == 1) {
            /** @var d3_attribute2category_extsearch_ajax $oAjax */
            $oAjax = oxNew(d3_attribute2category_extsearch_ajax::class);
            $this->_aViewData['oAjaxView'] = $oAjax;
            return $oAjax->getTplName();
        } elseif ($iAoc == 2) {
            /** @var d3_attribute2manufacturer_extsearch_ajax $oAjax */
            $oAjax = oxNew(d3_attribute2manufacturer_extsearch_ajax::class);
            $this->_aViewData['oAjaxView'] = $oAjax;
            return $oAjax->getTplName();
        } elseif ($iAoc == 3) {
            /** @var d3_attribute2vendor_extsearch_ajax $oAjax */
            $oAjax = oxNew(d3_attribute2vendor_extsearch_ajax::class);
            $this->_aViewData['oAjaxView'] = $oAjax;
            return $oAjax->getTplName();
        }

        return $sRet;
    }

    /**
     * @throws Exception
     */
    public function save()
    {
        parent::save();

        $soxId = $this->getEditObjectId();
        $aParams = Registry::get(Request::class)->getRequestEscapedParameter("editval");

        /** @var Attribute $oAttr */
        $oAttr = oxNew(Attribute::class);

        if ($soxId != "-1") {
            $oAttr->loadInLang($this->_iEditLang, $soxId);
        } else {
            $aParams['oxattribute__oxid'] = null;
        }

        //Disable editing for derived items
        if ($oAttr->isDerived()) {
            return;
        }

        $oAttr->setLanguage(0);
        $oAttr->assign($aParams);
        $oAttr->setLanguage($this->_iEditLang);
        $oAttr->save();

        $this->setEditObjectId($oAttr->getId());
    }

    /**
     * @return d3_cfg_mod|false
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function d3GetSet()
    {
        return d3_cfg_mod::get('d3_extsearch');
    }
}

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

use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use Doctrine\DBAL\DBALException;
use OxidEsales\Eshop\Application\Controller\Admin\AdminDetailsController;
use OxidEsales\Eshop\Application\Model\Attribute;
use OxidEsales\Eshop\Application\Model\Category;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;

class d3_category_extsearch extends AdminDetailsController
{
   /**
     * Current class template name.
     *
     * @var string
     */
    protected $_sThisTemplate = 'd3_category_extsearch.tpl';

    /**
     * @return string
     */
    public function render()
    {
        $sRet = parent::render();

        $soxId = $this->getEditObjectId();
        $this->addTplParam("oxid", $soxId);

        if ($soxId != "-1" && isset($soxId)) {
            /** @var Category $oItem */
            $oItem = oxNew(Category::class);
            $oItem->load($soxId);
            $this->addTplParam("edit", $oItem);
        }

        return $sRet;
    }

    /**
     * @throws \Exception
     */
    public function save()
    {
        parent::save();

        $soxId = $this->getEditObjectId();
        $aParams = Registry::get(Request::class)->getRequestEscapedParameter("editval");

        /** @var Category $oCategory */
        $oCategory = oxNew(Category::class);

        if ($soxId != "-1") {
            $oCategory->loadInLang($this->_iEditLang, $soxId);
        } else {
            $aParams['oxcategories__oxid'] = null;
        }

        //Disable editing for derived items
        if ($oCategory->isDerived()) {
            return;
        }

        $oCategory->setLanguage(0);
        $oCategory->assign($aParams);
        $oCategory->setLanguage($this->_iEditLang);
        $oCategory->save();

        $this->setEditObjectId($oCategory->getId());
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

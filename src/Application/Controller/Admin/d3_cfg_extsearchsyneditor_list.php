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

use D3\Extsearch\Application\Model\d3_extsearch_term;
use D3\ModCfg\Application\Controller\Admin\d3_cfg_mod_list;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;


class d3_cfg_extsearchsyneditor_list extends d3_cfg_mod_list
{
    protected $_blD3ShowLangSwitch = true;
    protected $_sThisTemplate = 'd3_cfg_extsearchsyneditor_list.tpl';
    protected $_sListClass = d3_extsearch_term::class;
    protected $_blEmployMultilanguage;
    protected $_sDefSortField = 'word';
    protected $_sDefSortOrder = 'asc';
    protected $_blShowListItems = true;

    /**
     * @return null|string
     */
    public function render()
    {
        $sRet = parent::render();

        $this->addTplParam("default_edit", "d3_cfg_extsearchsyneditor_main");
        return $sRet;
    }

    /**
     * @param array $aWhere
     * @param string $sSql
     * @return string
     * @throws DatabaseConnectionException
     */
    protected function _prepareWhereQuery($aWhere, $sSql)
    {
        $sSql = parent::_prepareWhereQuery($aWhere, $sSql);

        if (method_exists($this, 'getItemListBaseObject')) {
            $sSql .= " AND (" . $this->getItemListBaseObject()->getCoreTableName() . ".word != '') ";
        } else {
            $sSql .= " AND (" . $this->_oList->getBaseObject()->getCoreTableName() . ".word != '') ";
        }

        return $sSql;
    }
}

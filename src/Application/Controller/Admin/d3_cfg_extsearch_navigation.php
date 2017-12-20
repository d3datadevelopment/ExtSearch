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

use D3\Extsearch\Core\d3_extsearch_conf;
use D3\ModCfg\Application\Controller\Admin\d3_cfg_mod_main;

class d3_cfg_extsearch_navigation extends d3_cfg_mod_main
{
    protected $_sThisTemplate = 'd3_cfg_extsearch_navigation.tpl';

    protected $_sModId = 'd3_extsearch';
    
    protected $_sHelpLinkMLAdd = 'D3_EXTSEARCH_HELPLINK_CONFIG';

    protected $_sMenuItemTitle = 'd3mxextsearch';

    protected $_sMenuSubItemTitle = 'd3mxextsearch_settings';

    /**
     * @return bool
     */
    public function d3UseAlistFilters()
    {
        return $this->d3GetSet()->getLicenseConfigData(d3_extsearch_conf::SERIAL_BIT_HAS_FILTERS_IN_ALIST, false) || $this->d3GetSet()->isDemo();
    }
}

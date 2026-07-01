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

class d3_cfg_extsearch_quicksearch extends d3_cfg_mod_main
{
    protected $_sThisTemplate = '@'. Constants::OXID_MODULE_ID .'/admin/d3_cfg_extsearch_quicksearch';

    protected $_sModId = 'd3_extsearch';

    protected $_sHelpLinkMLAdd = 'D3_EXTSEARCH_HELPLINK_CONFIG';

    protected $_sMenuItemTitle = 'D3MXEXTSEARCH';

    protected $_sMenuSubItemTitle = 'D3MXEXTSEARCH_SETTINGS';
}

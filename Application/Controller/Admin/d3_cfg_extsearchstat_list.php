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

use D3\ModCfg\Application\Controller\Admin\d3_cfg_mod_list;

class d3_cfg_extsearchstat_list extends d3_cfg_mod_list
{
    protected $_blD3ShowLangSwitch = false;
    protected $_sListClass = null;

    /**
     * @return string
     */
    public function render()
    {
        $sRet = parent::render();

        $this->addTplParam("default_edit", "d3_cfg_extsearch_statistik");

        return $sRet;
    }
}

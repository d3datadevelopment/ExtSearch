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

use D3\ModCfg\Application\Controller\Admin\Log\d3_cfg_log;

class d3_cfg_extsearchlog extends d3_cfg_log
{
    protected $_sModId = 'd3_extsearch';

    /**
     * @return string
     */
    public function d3getAdditionalUrlParams()
    {
        $sRet = parent::d3getAdditionalUrlParams();

        if ($this->_sModId) {
            $sRet .= '&sD3ModId='.$this->_sModId;
        }

        return $sRet;
    }
}

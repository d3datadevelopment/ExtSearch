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

namespace D3\Extsearch\Modules\Application\Controller\Admin;

use D3\Extsearch\Application\Model\Constants;
use OxidEsales\Eshop\Application\Model\Content;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;

class d3_ddoevisualcmsadmin_extsearch extends d3_ddoevisualcmsadmin_extsearch_parent
{
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

        exit();
    }
}

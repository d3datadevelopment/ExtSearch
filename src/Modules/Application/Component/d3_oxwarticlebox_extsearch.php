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

namespace D3\Extsearch\Modules\Application\Component;

use OxidEsales\Eshop\Core\Request;
use OxidEsales\Eshop\Core\Registry;

class d3_oxwarticlebox_extsearch extends d3_oxwarticlebox_extsearch_parent
{
    /**
     * @return mixed
     */
    public function d3getFilterPageId()
    {
        switch (strtolower($this->getListType())) {
            case 'search':
                $sClassNameAdd = 'search##';
                $sIdent = md5(rawurlencode(strtolower(Registry::get(Request::class)->getRequestEscapedParameter('searchparam'))));
                break;
            case 'manufacturer':
                $sClassNameAdd = '##';
                $sIdent = Registry::get(Request::class)->getRequestEscapedParameter('mnid');
                break;
            default:
                $sClassNameAdd = '##';
                $sIdent = Registry::get(Request::class)->getRequestEscapedParameter('cnid');
        }

        $sPageId = $sClassNameAdd.
            Registry::getLang()->getLanguageAbbr()."##".
            Registry::getConfig()->getShopId()."##".
            $sIdent;

        return $sPageId;
    }
}

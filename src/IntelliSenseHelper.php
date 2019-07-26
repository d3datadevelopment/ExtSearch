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

namespace D3\Extsearch\Modules\Application\Component
{
    class d3_oxcmp_basket_extsearch_parent extends \OxidEsales\Eshop\Application\Component\BasketComponent {}

    class d3_oxcmp_utils_extsearch_parent extends \OxidEsales\Eshop\Application\Component\UtilsComponent {}

    class d3_oxwarticledetails_extsearch_parent extends \OxidEsales\Eshop\Application\Component\Widget\ArticleDetails {}

    class d3_oxwarticlebox_extsearch_parent extends \OxidEsales\Eshop\Application\Component\Widget\ArticleBox {}
}

namespace D3\Extsearch\Modules\Application\Controller\Admin
{
    class d3_article_list_extsearch_parent extends \OxidEsales\Eshop\Application\Controller\Admin\ArticleList {}

    class d3_ddoevisualcmsadmin_extsearch_parent extends \OxidEsales\VisualCmsModule\Application\Controller\Admin\VisualCmsAdmin {}
}

namespace D3\Extsearch\Modules\Application\Controller
{
    class d3_rss_extsearch_parent extends \OxidEsales\Eshop\Application\Controller\RssController {}

    class d3_ext_search_parent extends \OxidEsales\Eshop\Application\Controller\SearchController {}

    class d3_alist_extsearch_parent extends \OxidEsales\Eshop\Application\Controller\ArticleListController {}

    class d3_manufacturerlist_extsearch_parent extends \OxidEsales\Eshop\Application\Controller\ManufacturerListController {}

    class d3_vendorlist_extsearch_parent extends \OxidEsales\Eshop\Application\Controller\VendorListController {}

    class d3_details_extsearch_parent extends \OxidEsales\Eshop\Application\Controller\ArticleDetailsController {}

    class d3_oxlocator_extsearch_parent extends \OxidEsales\Eshop\Application\Component\Locator {}
}

namespace D3\Extsearch\Modules\Application\Model
{
    class d3_oxsearch_extsearch_parent extends \OxidEsales\Eshop\Application\Model\Search {}

    class d3_oxarticle_phonetic_parent extends \OxidEsales\Eshop\Application\Model\Article {}

    class d3_oxarticlelist_extsearch_parent extends \OxidEsales\Eshop\Application\Model\ArticleList {}

    class d3_oxrssfeed_extsearch_parent extends \OxidEsales\Eshop\Application\Model\RssFeed {}

    class d3_oxshop_extsearch_parent extends \OxidEsales\Eshop\Application\Model\Shop {}

    class d3_basemodel_extsearch_parent extends \OxidEsales\Eshop\Core\Model\BaseModel {}
}

namespace D3\Extsearch\Modules\Core
{
    class d3_oxutilsview_extsearch_parent extends \OxidEsales\Eshop\Core\UtilsView { }
}
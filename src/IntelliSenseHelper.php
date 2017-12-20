<?php

namespace D3\Extsearch\Modules\Application\Component
{
    class d3_oxcmp_basket_extsearch_parent extends \OxidEsales\Eshop\Application\Component\BasketComponent {}

    class d3_oxcmp_utils_extsearch_parent extends \OxidEsales\Eshop\Application\Component\UtilsComponent {}

    class d3_oxwarticledetails_extsearch_parent extends \OxidEsales\Eshop\Application\Component\Widget\ArticleDetails {}
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
}

namespace D3\Extsearch\Modules\Core
{
    class d3_oxutilsview_extsearch_parent extends \OxidEsales\Eshop\Core\UtilsView { }
}
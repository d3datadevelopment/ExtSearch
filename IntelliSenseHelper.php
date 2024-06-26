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
    use OxidEsales\Eshop\Application\Component\BasketComponent;
    use OxidEsales\Eshop\Application\Component\UtilsComponent;
    use OxidEsales\Eshop\Application\Component\Widget\ArticleBox;
    use OxidEsales\Eshop\Application\Component\Widget\ArticleDetails;

    class d3_oxcmp_basket_extsearch_parent extends BasketComponent
    {
    }

    class d3_oxcmp_utils_extsearch_parent extends UtilsComponent
    {
    }

    class d3_oxwarticledetails_extsearch_parent extends ArticleDetails
    {
    }

    class d3_oxwarticlebox_extsearch_parent extends ArticleBox
    {
    }
}

namespace D3\Extsearch\Modules\Application\Controller\Admin
{
    use OxidEsales\Eshop\Application\Controller\Admin\ArticleList;
    use OxidEsales\VisualCmsModule\Application\Controller\Admin\VisualCmsAdmin;

    class d3_article_list_extsearch_parent extends ArticleList
    {
    }

    class d3_ddoevisualcmsadmin_extsearch_parent extends VisualCmsAdmin
    {
    }
}

namespace D3\Extsearch\Modules\Application\Controller
{
    use OxidEsales\Eshop\Application\Component\Locator as LocatorAlias;
    use OxidEsales\Eshop\Application\Controller\ArticleDetailsController as ArticleDetailsControllerAlias;
    use OxidEsales\Eshop\Application\Controller\ArticleListController as ArticleListControllerAlias;
    use OxidEsales\Eshop\Application\Controller\ManufacturerListController as ManufacturerListControllerAlias;
    use OxidEsales\Eshop\Application\Controller\SearchController as SearchControllerAlias;
    use OxidEsales\Eshop\Application\Controller\VendorListController as VendorListControllerAlias;

    class d3_ext_search_parent extends SearchControllerAlias
    {
    }

    class d3_alist_extsearch_parent extends ArticleListControllerAlias
    {
    }

    class d3_manufacturerlist_extsearch_parent extends ManufacturerListControllerAlias
    {
    }

    class d3_vendorlist_extsearch_parent extends VendorListControllerAlias
    {
    }

    class d3_details_extsearch_parent extends ArticleDetailsControllerAlias
    {
    }

    class d3_oxlocator_extsearch_parent extends LocatorAlias
    {
    }
}

namespace D3\Extsearch\Modules\Application\Model
{
    use OxidEsales\Eshop\Application\Model\Article;
    use OxidEsales\Eshop\Application\Model\ArticleList;
    use OxidEsales\Eshop\Application\Model\Attribute;
    use OxidEsales\Eshop\Application\Model\Category;
    use OxidEsales\Eshop\Application\Model\Manufacturer;
    use OxidEsales\Eshop\Application\Model\Search;
    use OxidEsales\Eshop\Application\Model\Shop;
    use OxidEsales\Eshop\Application\Model\Vendor;
    use OxidEsales\Eshop\Core\Model\BaseModel;

    class d3_oxsearch_extsearch_parent extends Search
    {
    }

    class d3_oxarticle_phonetic_parent extends Article
    {
    }

    class d3_oxarticlelist_extsearch_parent extends ArticleList
    {
    }

    class d3_attribute_extsearch_parent extends Attribute
    {
    }

    class d3_oxshop_extsearch_parent extends Shop
    {
    }

    class d3_basemodel_extsearch_parent extends BaseModel
    {
    }

    class d3_category_extsearch_parent extends Category
    {
    }

    class d3_manufacturer_extsearch_parent extends Manufacturer
    {
    }

    class d3_vendor_extsearch_parent extends Vendor
    {
    }
}

namespace D3\Extsearch\Modules\Core
{
    use OxidEsales\Eshop\Core\UtilsView;

    class d3_oxutilsview_extsearch_parent extends UtilsView
    {
    }
}

namespace D3\Extsearch\Modules\PsCache\Core
{
    use ProudSourcing\psCache\Core\CacheCore;

    class d3_CacheCore_extsearch_parent extends CacheCore
    {
    }
}

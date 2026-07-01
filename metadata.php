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

use D3\Extsearch\Application\Controller\Admin as ModuleControllerAdmin;
use D3\Extsearch\Application\Controller as ModuleController;
use D3\Extsearch\Application\Model\Constants;
use D3\Extsearch\Modules\Application\Component as ModuleExtComponent;
use D3\Extsearch\Modules\Application\Controller\Admin as ModuleExtControllerAdmin;
use D3\Extsearch\Modules\Application\Controller as ModuleExtController;
use D3\Extsearch\Modules\Application\Model as ModuleExtModel;
use D3\Extsearch\Modules\PsCache\Core\d3_CacheCore_extsearch;
use OxidEsales\Eshop\Application\Controller as OxidController;
use OxidEsales\Eshop\Application\Model as OxidModel;
use OxidEsales\Eshop\Application\Component as OxidComponent;
use OxidEsales\Eshop\Core as OxidCore;
use OxidEsales\VisualCmsModule\Controller\Admin\VisualCmsAdmin;
use ProudSourcing\psCache\Core\CacheCore;

/**
 * Metadata version
 */
$sMetadataVersion = '2.1';

$sModuleId = 'd3_extsearch';

/**
 * Module information
 */
$aModule = [
    'id'          => $sModuleId,
    'title'       => [
        'de'    => '(D3) Erweiterte Suche',
        'en'    => '(D3) Extended Search',
    ],
    'description' => [
        'de' => 'Stellt fehlertolerante Suche und weitere Filterm&ouml;glichkeiten zur Verf&uuml;gung.<br>Aktivieren Sie die Moduleintr&auml;ge bitte immer und steuern Sie die Modulaktivit&auml;t ausschlie&szlig;lich im Adminbereich des Moduls.',
        'en' => 'Provides error-tolerant search and other filter options. Please always activate the module entries and control the module activity exclusively in the admin area of the module.',
    ],
    'thumbnail'   => 'picture.svg',
    'version'     => '8.2.2.0',
    'author'      => 'D&sup3; Data Development (Inh.: Thomas Dartsch)',
    'email'       => 'support@shopmodule.com',
    'url'         => 'https://www.oxidmodule.com/',
    'extend'      => [
        OxidController\Admin\ArticleList::class             => ModuleExtControllerAdmin\d3_article_list_extsearch::class,
        OxidController\ArticleDetailsController::class      => ModuleExtController\d3_details_extsearch::class,
        OxidCore\Model\BaseModel::class                     => ModuleExtModel\d3_basemodel_extsearch::class,
        OxidModel\Article::class                            => ModuleExtModel\d3_oxarticle_phonetic::class,
        OxidModel\ArticleList::class                        => ModuleExtModel\d3_oxarticlelist_extsearch::class,
        OxidModel\Attribute::class                          => ModuleExtModel\d3_attribute_extsearch::class,
        OxidModel\Category::class                           => ModuleExtModel\d3_category_extsearch::class,
        OxidModel\Manufacturer::class                       => ModuleExtModel\d3_manufacturer_extsearch::class,
        OxidModel\Vendor::class                             => ModuleExtModel\d3_vendor_extsearch::class,
        OxidComponent\BasketComponent::class                => ModuleExtComponent\d3_oxcmp_basket_extsearch::class,
        OxidComponent\UtilsComponent::class                 => ModuleExtComponent\d3_oxcmp_utils_extsearch::class,
        OxidComponent\Widget\ArticleDetails::class          => ModuleExtComponent\d3_oxwarticledetails_extsearch::class,
        OxidComponent\Widget\ArticleBox::class              => ModuleExtComponent\d3_oxwarticlebox_extsearch::class,
        OxidComponent\Locator::class                        => ModuleExtController\d3_oxlocator_extsearch::class,
        OxidController\ArticleListController::class         => ModuleExtController\d3_alist_extsearch::class,
        OxidController\ManufacturerListController::class    => ModuleExtController\d3_manufacturerlist_extsearch::class,
        OxidController\VendorListController::class          => ModuleExtController\d3_vendorlist_extsearch::class,
        OxidModel\Search::class                             => ModuleExtModel\d3_oxsearch_extsearch::class,
        OxidController\SearchController::class              => ModuleExtController\d3_ext_search::class,
    ],
    'controllers'   => [
        'd3_cfg_extsearch'                  => ModuleControllerAdmin\d3_cfg_extsearch::class,
        'd3_cfg_extsearch_list'             => ModuleControllerAdmin\d3_cfg_extsearch_list::class,
        'd3_cfg_extsearch_main'             => ModuleControllerAdmin\d3_cfg_extsearch_main::class,
        'd3_cfg_extsearch_navigation'       => ModuleControllerAdmin\d3_cfg_extsearch_navigation::class,
        'd3_cfg_extsearch_quicksearch'      => ModuleControllerAdmin\d3_cfg_extsearch_quicksearch::class,
        'd3_cfg_extsearch_plugins'          => ModuleControllerAdmin\d3_cfg_extsearch_plugins::class,
        'd3_cfg_extsearch_licence'          => ModuleControllerAdmin\d3_cfg_extsearch_licence::class,

        'd3_cfg_extsearchstat'              => ModuleControllerAdmin\d3_cfg_extsearchstat::class,
        'd3_cfg_extsearchstat_list'         => ModuleControllerAdmin\d3_cfg_extsearchstat_list::class,
        'd3_cfg_extsearch_statistik'        => ModuleControllerAdmin\d3_cfg_extsearch_statistik::class,

        'd3_cfg_extsearchsyneditor'         => ModuleControllerAdmin\d3_cfg_extsearchsyneditor::class,
        'd3_cfg_extsearchsyneditor_list'    => ModuleControllerAdmin\d3_cfg_extsearchsyneditor_list::class,
        'd3_cfg_extsearchsyneditor_main'    => ModuleControllerAdmin\d3_cfg_extsearchsyneditor_main::class,
        'd3_cfg_extsearchsyneditor_manage'  => ModuleControllerAdmin\d3_cfg_extsearchsyneditor_manage::class,

        'd3_cfg_extsearchlog'               => ModuleControllerAdmin\d3_cfg_extsearchlog::class,
        'd3_cfg_extsearchlog_list'          => ModuleControllerAdmin\d3_cfg_extsearchlog_list::class,

        'd3_attribute_extsearch'            => ModuleControllerAdmin\d3_attribute_extsearch::class,
        'd3_attribute2category_extsearch_ajax'      => ModuleControllerAdmin\Popups\d3_attribute2category_extsearch_ajax::class,
        'd3_attribute2manufacturer_extsearch_ajax'  => ModuleControllerAdmin\Popups\d3_attribute2manufacturer_extsearch_ajax::class,
        'd3_attribute2vendor_extsearch_ajax'        => ModuleControllerAdmin\Popups\d3_attribute2vendor_extsearch_ajax::class,
        'd3_category_extsearch'             => ModuleControllerAdmin\d3_category_extsearch::class,

        'd3_extsearch_response'             => ModuleController\d3_extsearch_response::class,
    ],
    'templates'   => [
        '@' . Constants::OXID_MODULE_ID . '/admin/d3_cfg_extsearch_main.tpl'                => 'views/smarty/admin/d3_cfg_extsearch_main.tpl',
        '@' . Constants::OXID_MODULE_ID . '/admin/d3_cfg_extsearch_main_sortanalysis.tpl'   => 'views/smarty/admin/d3_cfg_extsearch_main_sortanalysis.tpl',
        '@' . Constants::OXID_MODULE_ID . '/admin/d3_cfg_extsearch_navigation.tpl'          => 'views/smarty/admin/d3_cfg_extsearch_navigation.tpl',
        '@' . Constants::OXID_MODULE_ID . '/admin/d3_cfg_extsearch_plugins.tpl'             => 'views/smarty/admin/d3_cfg_extsearch_plugins.tpl',
        '@' . Constants::OXID_MODULE_ID . '/admin/d3_cfg_extsearch_quicksearch.tpl'         => 'views/smarty/admin/d3_cfg_extsearch_quicksearch.tpl',
        '@' . Constants::OXID_MODULE_ID . '/admin/d3_cfg_extsearch_statistik.tpl'           => 'views/smarty/admin/d3_cfg_extsearch_statistik.tpl',
        '@' . Constants::OXID_MODULE_ID . '/admin/d3_cfg_extsearchsyneditor_list.tpl'       => 'views/smarty/admin/d3_cfg_extsearchsyneditor_list.tpl',
        '@' . Constants::OXID_MODULE_ID . '/admin/d3_cfg_extsearchsyneditor_main.tpl'       => 'views/smarty/admin/d3_cfg_extsearchsyneditor_main.tpl',
        '@' . Constants::OXID_MODULE_ID . '/admin/d3_cfg_extsearchsyneditor_manage.tpl'     => 'views/smarty/admin/d3_cfg_extsearchsyneditor_manage.tpl',
        '@' . Constants::OXID_MODULE_ID . '/admin/d3_extsearch_plugin.tpl'                   => 'views/smarty/admin/d3_extsearch_plugin.tpl',
        '@' . Constants::OXID_MODULE_ID . '/admin/d3_extsearch_popup.tpl'                    => 'views/smarty/admin/d3_extsearch_popup.tpl',

        '@' . Constants::OXID_MODULE_ID . '/admin/d3_attribute_extsearch.tpl'                => 'views/smarty/admin/d3_attribute_extsearch.tpl',
        '@' . Constants::OXID_MODULE_ID . '/admin/popups/d3_attribute_extsearch_ajax.tpl'    => 'views/smarty/admin/popups/d3_attribute_extsearch_ajax.tpl',
        '@' . Constants::OXID_MODULE_ID . '/admin/d3_category_extsearch.tpl'                 => 'views/smarty/admin/d3_category_extsearch.tpl',

        '@' . Constants::OXID_MODULE_ID . '/d3_ext_search_suggestsearch.tpl'                 => 'views/smarty/d3_ext_search_suggestsearch.tpl',

        '@' . Constants::OXID_MODULE_ID . '/d3_ext_search_highlight.tpl'                     => 'views/smarty/d3_ext_search_highlight.tpl',

        '@' . Constants::OXID_MODULE_ID . '/d3_ext_search_filter.tpl'                        => 'views/smarty/d3_ext_search_filter.tpl',
        '@' . Constants::OXID_MODULE_ID . '/wave/d3_search_contents.tpl'                     => 'views/smarty/wave/d3_search_contents.tpl',
        '@' . Constants::OXID_MODULE_ID . '/wave/d3_search_filters.tpl'                      => 'views/smarty/wave/d3_search_filters.tpl',
        '@' . Constants::OXID_MODULE_ID . '/wave/d3_list_filters.tpl'                        => 'views/smarty/wave/d3_list_filters.tpl',

        '@' . Constants::OXID_MODULE_ID . '/filterelements/d3_ext_search_filter_category.tpl'         => 'views/smarty/filterelements/category.tpl',
        '@' . Constants::OXID_MODULE_ID . '/filterelements/d3_ext_search_filter_vendor.tpl'           => 'views/smarty/filterelements/vendor.tpl',
        '@' . Constants::OXID_MODULE_ID . '/filterelements/d3_ext_search_filter_manufacturer.tpl'     => 'views/smarty/filterelements/manufacturer.tpl',
        '@' . Constants::OXID_MODULE_ID . '/filterelements/d3_ext_search_filter_attribute.tpl'        => 'views/smarty/filterelements/attribute.tpl',
        '@' . Constants::OXID_MODULE_ID . '/filterelements/d3_ext_search_filter_priceselector.tpl'    => 'views/smarty/filterelements/priceselector.tpl',
        '@' . Constants::OXID_MODULE_ID . '/filterelements/d3_ext_search_filter_jqslider.tpl'         => 'views/smarty/filterelements/jqslider.tpl',

        '@' . Constants::OXID_MODULE_ID . '/filterelements/inc/d3_ext_search_filter_inc_multibuttons.tpl' => 'views/smarty/filterelements/inc/multibuttons.tpl',

        '@' . Constants::OXID_MODULE_ID . '/admin/d3_togglegroup_extsearch.tpl'         => 'views/smarty/admin/d3_togglegroup_extsearch.tpl',
    ],
    'events'      => [
        'onActivate'    => '\D3\Extsearch\setup\Events::onActivate',
        'onDeactivate'  => '\D3\Extsearch\setup\Events::onDeactivate',
    ],
    'settings' => [
        [
            'group'     => 'd3thememapping_module',
            'name'      => 'd3custParentThemeMappedToApex_'.$sModuleId,
            'type'      => 'str',
            'value'     => '',
        ],
        [
            'group'     => 'd3thememapping_module',
            'name'      => 'd3custParentThemeMappedToWave_'.$sModuleId,
            'type'      => 'str',
            'value'     => '',
        ],
    ],
    'blocks'      => [
        [
            'template'  => 'page/search/search.tpl',
            'block'     => 'search_results',
            'file'      => 'views/smarty/blocks/page/search/d3_inc_ext_search.tpl',
            'position'  => 1,
        ],
        [
            'template'  => 'layout/base.tpl',
            'block'     => 'head_css',
            'file'      => 'views/smarty/blocks/layout/d3_extsearch_css.tpl',
            'position'  => 1,
        ],
        [
            'template'  => 'layout/base.tpl',
            'block'     => 'base_js',
            'file'      => 'views/smarty/blocks/layout/d3_extsearch_js.tpl',
            'position'  => 1,
        ],
        [
            'template'  => 'widget/header/search.tpl',
            'block'     => 'widget_header_search_form',
            'file'      => 'views/smarty/blocks/widget/header/d3_extsearch_headersearch.tpl',
            'position'  => 1,
        ],
        [
            'template'  => 'widget/header/search.tpl',
            'block'     => 'header_search_field',
            'file'      => 'views/smarty/blocks/widget/header/d3_extsearch_searchfield.tpl',
            'position'  => 1,
        ],
        [
            'template'  => 'page/list/list.tpl',
            'block'     => 'page_list_listbody',
            'file'      => 'views/smarty/blocks/page/list/d3extsearch_alist_noartfilters.tpl',
            'position'  => 1,
        ],
        [
            'template'  => 'page/list/list.tpl',
            'block'     => 'page_list_listhead',
            'file'      => 'views/smarty/blocks/page/list/d3extsearch_alist_filters.tpl',
            'position'  => 1,
        ],
        [
            'template'  => 'widget/locator/attributes.tpl',
            'block'     => 'widget_locator_attributes',
            'file'      => 'views/smarty/blocks/widget/locator/d3_list_disabledefaultfilters.tpl',
            'position'  => 1,
        ],
        [
            'template'  => 'widget/product/listitem_infogrid.tpl',
            'block'     => 'widget_product_listitem_infogrid_titlebox',
            'file'      => 'views/smarty/blocks/widget/product/d3_extsearch_listiteminfogrid_title.tpl',
            'position'  => 1,
        ],
        [
            'template'  => 'widget/product/listitem_grid.tpl',
            'block'     => 'widget_product_listitem_grid',
            'file'      => 'views/smarty/blocks/widget/product/d3_extsearch_listitemgrid_title.tpl',
            'position'  => 1,
        ],
        [
            'template'  => 'widget/product/listitem_grid.tpl',
            'block'     => 'widget_product_listitem_infogrid_titlebox',
            'file'      => 'views/smarty/blocks/widget/product/d3_extsearch_listitemgrid_flowtitlebox.tpl',
            'position'  => 1,
        ],
        [
            'template'  => 'widget/product/listitem_line.tpl',
            'block'     => 'widget_product_listitem_line_titlebox',
            'file'      => 'views/smarty/blocks/widget/product/d3_extsearch_listitemline_flowtitlebox.tpl',
            'position'  => 1,
        ],
        [
            'template'  => 'widget/product/listitem_line.tpl',
            'block'     => 'widget_product_listitem_line_selections',
            'file'      => 'views/smarty/blocks/widget/product/d3_extsearch_listitemline_selections.tpl',
            'position'  => 1,
        ],
        [
            'template'  => 'widget/product/listitem_line.tpl',
            'block'     => 'widget_product_listitem_line_description',
            'file'      => 'views/smarty/blocks/widget/product/d3_extsearch_listitemline_description.tpl',
            'position'  => 1,
        ],
        [
            'template'  => 'content_main.tpl',
            'block'     => 'admin_content_main_form',
            'file'      => 'views/smarty/blocks/admin/d3_extsearch_content_main.tpl',
            'position'  => 1,
        ],
        [
            'template'  => 'article_extend.tpl',
            'block'     => 'admin_article_extend_form',
            'file'      => 'views/smarty/blocks/admin/d3_extsearch_article_extend.tpl',
            'position'  => 1,
        ],
    ],
    'smartyPluginDirectories' => [
        'Core/Smarty/Plugins',
    ],
];

// is not in OXID Composer copy to source process
if (!in_array(
    1,
    array_map(
        function ($traceStep) {
            return isset($traceStep['class'])
                && $traceStep['class'] === \OxidEsales\ComposerPlugin\Installer\Package\ModulePackageInstaller::class;
        },
        debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS)
    )
)) {
    if (class_exists(VisualCmsAdmin::class)) {
        $aModule['extend'][ VisualCmsAdmin::class ] = ModuleExtControllerAdmin\d3_ddoevisualcmsadmin_extsearch::class;
    }

    if (class_exists(CacheCore::class)) {
        $aModule['extend'][ CacheCore::class ] = d3_CacheCore_extsearch::class;
    }
}

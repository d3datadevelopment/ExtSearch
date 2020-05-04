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

use D3\Extsearch\setup as ModuleSetup;

/**
 * Module information
 */
$aModule = array(
    'd3FileRegister'    => array(
        'd3/extsearch/IntelliSenseHelper.php',
        'd3/extsearch/metadata.php',
        'd3/extsearch/d3metadata.php',
        'd3/extsearch/core/smarty/plugins/function.d3_extsearch_highlight.php',
        'd3/extsearch/Application/Model/d3_phonetic_de.php',
        'd3/extsearch/Application/Model/d3_phonetic_de_voc.php',
        'd3/extsearch/public/d3_extsearch_response.php',
        'd3/extsearch/Application/translations/de/d3_extsearch_lang.php',
        'd3/extsearch/Application/translations/en/d3_extsearch_lang.php',
        'd3/extsearch/Application/views/admin/de/d3_extsearch_lang.php',
        'd3/extsearch/Application/views/admin/de/module_options.php',
        'd3/extsearch/Application/views/admin/en/d3_extsearch_lang.php',
        'd3/extsearch/Application/views/admin/en/module_options.php',
        'd3/extsearch/setup/d3_extsearch_semanticstructure.php',
        'd3/extsearch/setup/d3_extsearch_semantic_synset.php',
        'd3/extsearch/setup/d3_extsearch_semantic_term.php',
        'd3/extsearch/setup/d3_extsearch_statisticlog.php',
        'd3/extsearch/setup/d3_extsearch_attribute2object.php',

        'd3/extsearch/Application/Controller/d3_extsearch_response.php',
        'd3/extsearch/Application/Controller/d3_xlist_extsearch.php',
        'd3/extsearch/Application/Controller/Admin/d3_cfg_extsearch_navigation.php',
        'd3/extsearch/Application/Controller/Admin/d3_cfg_extsearch_list.php',
        'd3/extsearch/Application/Controller/Admin/d3_cfg_extsearch_main.php',
        'd3/extsearch/Application/Controller/Admin/d3_cfg_extsearch_licence.php',
        'd3/extsearch/Application/Controller/Admin/d3_cfg_extsearchsyneditor.php',
        'd3/extsearch/Application/Controller/Admin/d3_cfg_extsearchsyneditor_list.php',
        'd3/extsearch/Application/Controller/Admin/d3_cfg_extsearchlog.php',
        'd3/extsearch/Application/Controller/Admin/Reports/d3_extsearch_report_hitless.php',
        'd3/extsearch/Application/Controller/Admin/Reports/d3_extsearch_report_base.php',
        'd3/extsearch/Application/Controller/Admin/Reports/d3_extsearch_report_mostsearches.php',
        'd3/extsearch/Application/Controller/Admin/d3_cfg_extsearchlog_list.php',
        'd3/extsearch/Application/Controller/Admin/d3_cfg_extsearchsyneditor_manage.php',
        'd3/extsearch/Application/Controller/Admin/d3_cfg_extsearchstat.php',
        'd3/extsearch/Application/Controller/Admin/d3_cfg_extsearchstat_list.php',
        'd3/extsearch/Application/Controller/Admin/d3_cfg_extsearch_plugins.php',
        'd3/extsearch/Application/Controller/Admin/d3_cfg_extsearch_quicksearch.php',
        'd3/extsearch/Application/Controller/Admin/d3_cfg_extsearchsyneditor_main.php',
        'd3/extsearch/Application/Controller/Admin/d3_cfg_extsearch_statistik.php',
        'd3/extsearch/Application/Controller/Admin/d3_cfg_extsearch.php',
        'd3/extsearch/Application/Model/d3_extsearch_statisticlog.php',
        'd3/extsearch/Application/Model/d3_oxutils_extsearch.php',
        'd3/extsearch/Application/Model/d3_semantic.php',
        'd3/extsearch/Application/Model/d3_search.php',
        'd3/extsearch/Application/Model/d3_extsearch_term.php',
        'd3/extsearch/Application/Model/d3_extsearch_synset.php',
        'd3/extsearch/Application/Model/d3_search_generator.php',
        'd3/extsearch/Application/Model/Filters/d3Filter.php',
        'd3/extsearch/Application/Model/Filters/d3FieldIsFilter.php',
        'd3/extsearch/Application/Model/Filters/d3VendorFilter.php',
        'd3/extsearch/Application/Model/Filters/d3FilterList.php',
        'd3/extsearch/Application/Model/Filters/d3IndexFilter.php',
        'd3/extsearch/Application/Model/Filters/d3AttributeFilter.php',
        'd3/extsearch/Application/Model/Filters/d3ManufacturerFilter.php',
        'd3/extsearch/Application/Model/Filters/d3CategoryFilter.php',
        'd3/extsearch/Application/Model/Filters/d3FieldLikeFilter.php',
        'd3/extsearch/Application/Model/Filters/d3PriceFilter.php',
        'd3/extsearch/Application/Model/Filters/d3FilterInterface.php',
        'd3/extsearch/setup/d3_extsearch_update.php',
        'd3/extsearch/Core/d3_extsearch_conf.php',

        'd3/extsearch/Modules/Application/Component/d3_oxcmp_basket_extsearch.php',
        'd3/extsearch/Modules/Application/Component/d3_oxcmp_utils_extsearch.php',
        'd3/extsearch/Modules/Application/Component/d3_oxwarticledetails_extsearch.php',
        'd3/extsearch/Modules/Application/Controller/d3_manufacturerlist_extsearch.php',
        'd3/extsearch/Modules/Application/Controller/d3_vendorlist_extsearch.php',
        'd3/extsearch/Modules/Application/Controller/d3_oxlocator_extsearch.php',
        'd3/extsearch/Modules/Application/Controller/d3_alist_extsearch.php',
        'd3/extsearch/Modules/Application/Controller/d3_details_extsearch.php',
        'd3/extsearch/Modules/Application/Controller/d3_rss_extsearch.php',
        'd3/extsearch/Modules/Application/Controller/Admin/d3_article_list_extsearch.php',
        'd3/extsearch/Modules/Application/Controller/Admin/d3_ddoevisualcmsadmin_extsearch.php',
        'd3/extsearch/Application/Controller/Admin/Popups/d3_attribute_extsearch_ajax_abstract.php',
        'd3/extsearch/Modules/Application/Controller/d3_ext_search.php',
        'd3/extsearch/Modules/Application/Model/d3_oxsearch_extsearch.php',
        'd3/extsearch/Modules/Application/Model/d3_oxarticlelist_extsearch.php',
        'd3/extsearch/Modules/Application/Model/d3_oxarticle_phonetic.php',
        'd3/extsearch/Modules/Application/Model/d3_basemodel_extsearch.php',
        'd3/extsearch/Modules/Application/Model/d3_oxrssfeed_extsearch.php',
        'd3/extsearch/Modules/Core/d3_oxutilsview_extsearch.php',

        'd3/extsearch/setup/Events.php',
        
        'd3/extsearch/tests/d3extsearch_config.php',
        'd3/extsearch/tests/additional.inc.php',
        'd3/extsearch/tests/integration/assignedFilters/nofilterTest.php',
        'd3/extsearch/tests/integration/assignedFilters/d3ExtsearchFilterQueriesIntegrationTestCase.php',
        'd3/extsearch/tests/integration/assignedFilters/categoryMultiFilterTest.php',
        'd3/extsearch/tests/integration/assignedFilters/categorySingleFilterTest.php',
        'd3/extsearch/tests/integration/d3ExtsearchIntegrationTestCase.php',
        'd3/extsearch/tests/integration/assignedFilters/manufacturerSingleFilterTest.php',
        'd3/extsearch/tests/integration/assignedFilters/manufacturerMultiFilterTest.php',
        'd3/extsearch/tests/integration/assignedFilters/vendorSingleFilterTest.php',
        'd3/extsearch/tests/integration/assignedFilters/vendorMultiFilterTest.php',
        'd3/extsearch/tests/integration/assignedFilters/fieldLikeFilterTest.php',
        'd3/extsearch/tests/integration/assignedFilters/fieldIsFilterTest.php',
        'd3/extsearch/tests/integration/assignedFilters/priceSliderFilterTest.php',
        'd3/extsearch/tests/integration/assignedFilters/priceArrayFilterTest.php',
        'd3/extsearch/tests/integration/assignedFilters/indexFilterTest.php',
        'd3/extsearch/tests/integration/assignedFilters/allSingleFilterTest.php',
        'd3/extsearch/tests/integration/assignedFilters/allMultiFilterTest.php',
        'd3/extsearch/tests/integration/assignedFilters/attributeSingleFilterTest.php',
        'd3/extsearch/tests/integration/assignedFilters/attributeMultiFilterTest.php',
        'd3/extsearch/tests/integration/filterlists/attributeFilterTest.php',
        'd3/extsearch/tests/integration/filterlists/categoryFilterTest.php',
        'd3/extsearch/tests/integration/filterlists/indexFilterTest.php',
        'd3/extsearch/tests/integration/filterlists/manufacturerFilterTest.php',
        'd3/extsearch/tests/integration/filterlists/priceFilterTest.php',
        'd3/extsearch/tests/integration/filterlists/vendorFilterTest.php',
        'd3/extsearch/tests/integration/filterlists/d3ExtsearchFilterlistsIntegrationTestCase.php',
        'd3/extsearch/tests/integration/queryExecute/alistQueryExecuteTest.php',
        'd3/extsearch/tests/integration/queryExecute/searchQueryExecuteTest.php',
        'd3/extsearch/tests/integration/queryExecute/d3ExtsearchFilterQueriesIntegrationTestCase.php'
    ),
    'd3SetupClasses'    => array(
        ModuleSetup\d3_extsearch_update::class,
    ),
);

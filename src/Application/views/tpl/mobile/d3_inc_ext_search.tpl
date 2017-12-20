[{if !$oView->getArticleCount()}]
    [{block name="d3_cfg_extsearch_searchmobile_noarticlemessage"}]
        <h3>[{oxcontent ident="d3extsearch_noarticlefound" field="oxtitle"}]</h3>
        [{oxcontent ident="d3extsearch_noarticlefound"}]
    [{/block}]
[{/if}]

[{if $oView->d3GetCMSList()}]
    [{block name="d3_cfg_extsearch_searchmobile_cms_results"}]
        <div class="d3extsearch_mobile">
            <h3>
                [{oxmultilang ident="D3_EXTSEARCH_EXT_CMSHEADLINE"}]
            </h3>
            <div class="content list">
                <ul style="margin: 2px;">
                    [{foreach from=$oView->d3GetCMSList() item="oContent"}]
                        [{assign var="TitleCharCount" value=$oContent->oxcontents__oxtitle->value|count_characters}]
                        [{math equation="100-s" s=$TitleCharCount assign="iTextLength"}]
                        <li>
                            <a href="[{$oContent->getLink()}]"><b>[{$oContent->oxcontents__oxtitle->value}]</b></a><br>
                        </li>
                    [{/foreach}]
                </ul>
            </div>
        </div>
    [{/block}]
[{/if}]

[{assign var="similarSearch" value=$oView->getSearchResultStatusMessage()}]
[{if $similarSearch}]
    [{block name="d3_cfg_extsearch_searchmobile_similar_messages"}]
        <div class="d3extsearch_mobile">
            <div class="message">
                [{if $similarSearch == 'similar'}]
                    [{oxmultilang ident="D3_EXTSEARCH_EXT_NOARTMSG"}] [{$oView->getUsedParams()}]
                [{elseif $similarSearch == 'combined'}]
                    [{oxmultilang ident="D3_EXTSEARCH_EXT_LESSARTMSG"}]
                [{/if}]
            </div>
        </div>
    [{/block}]
[{/if}]

[{if $oView->getArticleCount()}]
    [{block name="d3_cfg_extsearch_searchmobile_filterbox"}]
        <div id="filterItems" class="filter-box">
            <div class="filter-box-closed" id="filterBoxClosed">
                <input class="btn" type="button" value="[{oxmultilang ident="FILTER_LIST"}]">
            </div>
            <div id="filterBoxOpened" class="filter-box-opened">
                <div class="filter-header">
                    <span class="filter-close"><i class="glyphicon-remove"></i></span>
                    <span class="filter-open-title">[{oxmultilang ident="FILTER_LIST"}]</span>
                </div>
                <div class="filterData">

                    [{if $oView->d3HasFilters()}]
                        [{block name="d3_cfg_extsearch_searchmobile_filters"}]
                            <script type="text/javascript">
                                function d3extSearchSubmitFilter(sInputId, mValue) {
                                    document.getElementById(sInputId).value = mValue;
                                }
                            </script>
                            <form action="[{$oViewConf->getSelfActionLink()}]" method="post" name="_filterlist" id="filterList">
                                [{$oViewConf->getHiddenSid()}]
                                <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
                                <input type="hidden" name="fnc" value="">
                                <input type="hidden" name="showFilter" value="false">
                                [{foreach from=$oView->getNavigationParams() key="keyname" item="value"}]
                                    [{if $keyname != 'searchcnid' && $keyname != 'searchvendor' && $keyname != 'searchmanufacturer'}]
                                        <input type="hidden" name="[{$keyname}]" value="[{$value}]">
                                    [{/if}]
                                [{/foreach}]
                                <input type="hidden" name="isextsearch" value="search">
                                [{assign var="blFilterOpen" value=false}]

                                [{block name="d3_inc_ext_search__filter"}]
                                    [{if $oView->d3HasCategoryList()}]
                                        <label class="filter-title">[{oxmultilang ident="D3_EXTSEARCH_EXT_CATEGORIES"}]</label>
                                        <div class="dropdown">
                                            <input type="hidden" id="searchcnid" name="searchcnid" value="[{$sSelectedCatId}]">
                                            <div class="dropdown-toggle" data-toggle="dropdown" data-target="#">
                                                <div>
                                                    [{if $sSelectedCatId}]
                                                        [{$sSelectedCat}]
                                                        [{assign var="blFilterOpen" value=true}]
                                                    [{else}]
                                                        [{oxmultilang ident="D3_EXTSEARCH_EXT_CHOOSECAT"}]
                                                    [{/if}]
                                                </div>
                                                <i class="glyphicon-chevron-down"></i>
                                            </div>
                                            <ul class="dropdown-menu" role="menu">
                                                [{if $sSelectedCatId}]
                                                    <li class="dropdown-option">
                                                        <a tabindex="-1" data-selection-id="" onclick="d3extSearchSubmitFilter('searchcnid', this.getAttribute('data-selection-id'));">
                                                            [{oxmultilang ident="D3_EXTSEARCH_EXT_SEARCHINCATEGORIES"}]
                                                        </a>
                                                    </li>
                                                [{else}]
                                                    [{foreach from=$oView->d3getCategoryList() item="category"}]
                                                        <li class="dropdown-option">
                                                            <a tabindex="-1" data-selection-id="[{$category->getId()}]" title="[{$category->oxcategories__oxtitle->getRawValue()}]" [{if $sSelectedCatId == $category->getId()}]class="selected"[{/if}] onclick="d3extSearchSubmitFilter('searchcnid', this.getAttribute('data-selection-id'));">
                                                                [{$category->getTitle()}][{if $category->getFieldData('counter')}] ([{$category->getFieldData('counter')}])[{/if}]
                                                            </a>
                                                        </li>
                                                    [{/foreach}]
                                                [{/if}]
                                            </ul>
                                        </div>
                                    [{/if}]

                                    [{if $oView->d3HasVendorList()}]
                                        <label class="filter-title">[{oxmultilang ident="D3_EXTSEARCH_EXT_VENDORS"}]</label>
                                        <div class="dropdown">
                                            <input type="hidden" id="searchvendor" name="searchvendor" value="[{$sSelectedVendorId}]">
                                            <div class="dropdown-toggle" data-toggle="dropdown" data-target="#">
                                                <div>
                                                    [{if $sSelectedVendorId}]
                                                        [{$sSelectedVendor}]
                                                        [{assign var="blFilterOpen" value=true}]
                                                    [{else}]
                                                        [{oxmultilang ident="D3_EXTSEARCH_EXT_CHOOSEVENDOR"}]
                                                    [{/if}]
                                                </div>
                                                <i class="glyphicon-chevron-down"></i>
                                            </div>
                                            <ul class="dropdown-menu" role="menu">
                                                [{if $sSelectedVendorId}]
                                                    <li class="dropdown-option">
                                                        <a tabindex="-1" data-selection-id="" onclick="d3extSearchSubmitFilter('searchvendor', this.getAttribute('data-selection-id'));">
                                                            [{oxmultilang ident="D3_EXTSEARCH_EXT_SEARCHINVENDORS"}]
                                                        </a>
                                                    </li>
                                                [{else}]
                                                    [{foreach from=$oView->d3getVendorList() item="vendor"}]
                                                        <li class="dropdown-option">
                                                            <a tabindex="-1" data-selection-id="[{$vendor->getId()}]" title="[{$vendor->oxvendor__oxtitle->getRawValue()}]" [{if $sSelectedVendorId == $vendor->getId()}]class="selected"[{/if}] onclick="d3extSearchSubmitFilter('searchvendor', this.getAttribute('data-selection-id'));">
                                                                [{$vendor->getTitle()}][{if $vendor->getFieldData('counter')}] ([{$vendor->getFieldData('counter')}])[{/if}]
                                                            </a>
                                                        </li>
                                                    [{/foreach}]
                                                [{/if}]
                                            </ul>
                                        </div>
                                    [{/if}]


                                    [{if $oView->d3HasManufacturerList()}]
                                        <label class="filter-title">[{oxmultilang ident="D3_EXTSEARCH_EXT_MANUFACTURERS"}]</label>
                                        <div class="dropdown">
                                            <input type="hidden" id="searchmanufacturer" name="searchmanufacturer" value="[{$sSelectedManufacturerId}]">
                                            <div class="dropdown-toggle" data-toggle="dropdown" data-target="#">
                                                <div>
                                                    [{if $sSelectedManufacturerId}]
                                                        [{$sSelectedManufacturer}]
                                                        [{assign var="blFilterOpen" value=true}]
                                                    [{else}]
                                                        [{oxmultilang ident="D3_EXTSEARCH_EXT_CHOOSEMANUFACTURER"}]
                                                    [{/if}]
                                                </div>
                                                <i class="glyphicon-chevron-down"></i>
                                            </div>
                                            <ul class="dropdown-menu" role="menu">
                                                [{if $sSelectedManufacturerId}]
                                                    <li class="dropdown-option">
                                                        <a tabindex="-1" data-selection-id="" onclick="d3extSearchSubmitFilter('searchmanufacturer', this.getAttribute('data-selection-id'));">
                                                            [{oxmultilang ident="D3_EXTSEARCH_EXT_SEARCHINMANUFACTURERS"}]
                                                        </a>
                                                    </li>
                                                [{else}]
                                                    [{foreach from=$oView->d3getManufacturerList() item="manufacturer"}]
                                                        <li class="dropdown-option">
                                                            <a tabindex="-1" data-selection-id="[{$manufacturer->getId()}]" title="[{$manufacturer->oxmanufacturers__oxtitle->getRawValue()}]" [{if $sSelectedManufacturerId == $manufacturer->getId()}]class="selected"[{/if}] onclick="d3extSearchSubmitFilter('searchmanufacturer', this.getAttribute('data-selection-id'));">
                                                                [{$manufacturer->getTitle()}][{if $manufacturer->getFieldData('counter')}] ([{$manufacturer->getFieldData('counter')}])[{/if}]
                                                            </a>
                                                        </li>
                                                    [{/foreach}]
                                                [{/if}]
                                            </ul>
                                        </div>
                                    [{/if}]

                                    [{if $oView->d3HasAttributeList()}]
                                        [{foreach from=$oView->d3GetAttributeList() name=search key=key item=oAttribute}]
                                            <label class="filter-title">[{$oAttribute->title}]:</label>
                                            <div class="dropdown">
                                                <input type="hidden" id="d3searchattrib__[{$key}]" name="d3searchattrib[[{$key}]]" value="[{$oAttribute->selectionRawValue}]">
                                                <div class="dropdown-toggle" data-toggle="dropdown" data-target="#">
                                                    <div>
                                                        [{if $oAttribute->selected}]
                                                            [{$oAttribute->selectionValue}]
                                                            [{assign var="blFilterOpen" value=true}]
                                                        [{else}]
                                                            [{oxmultilang ident="D3_EXTSEARCH_EXT_ATTRIBSNOSELECTION1"}] [{$oAttribute->title}] [{oxmultilang ident="D3_EXTSEARCH_EXT_ATTRIBSNOSELECTION2"}]
                                                        [{/if}]
                                                    </div>
                                                    <i class="glyphicon-chevron-down"></i>
                                                </div>
                                                <ul class="dropdown-menu" role="menu">
                                                    [{if $oAttribute->selected}]
                                                        <li class="dropdown-option">
                                                            <a tabindex="-1" data-selection-id="" onclick="d3extSearchSubmitFilter('d3searchattrib__[{$key}]', this.getAttribute('data-selection-id'));">
                                                                [{oxmultilang ident="D3_EXTSEARCH_EXT_ATTRIBSDESELECT1"}] [{$oAttribute->title}] [{oxmultilang ident="D3_EXTSEARCH_EXT_ATTRIBSDESELECT2"}]
                                                            </a>
                                                        </li>
                                                    [{else}]
                                                        [{foreach from=$oAttribute->_aList name="attrvalues" key="valuekey" item="oAttrValue"}]
                                                            <li class="dropdown-option">
                                                                [{if $oAttrValue->isSelectable}]
                                                                    <a tabindex="-1" data-selection-id="[{$oAttrValue->rawvalue}]" title="[{$oAttrValue->value}]" style="[{if $oAttrValue->highlighted}]background-color: #E2E2E2;[{/if}]" [{if $oAttrValue->selected}]class="selected"[{/if}] onclick="d3extSearchSubmitFilter('d3searchattrib__[{$key}]', this.getAttribute('data-selection-id'));">
                                                                        [{$oAttrValue->value}] [{if $oAttrValue->count}]([{$oAttrValue->count}])[{/if}]
                                                                    </a>
                                                                [{else}]
                                                                    <div>
                                                                        [{$oAttrValue->value}] [{if $oAttrValue->count}]([{$oAttrValue->count}])[{/if}]
                                                                    </div>
                                                                [{/if}]
                                                            </li>
                                                        [{/foreach}]
                                                    [{/if}]
                                                </ul>
                                            </div>
                                        [{/foreach}]
                                    [{/if}]

                                    [{if $oView->d3HasPriceFilter()}]
                                        [{assign var="currency" value=$oView->getActCurrency()}]
                                        <label class="filter-title">[{oxmultilang ident="D3_EXTSEARCH_EXT_PRICECATS"}]</label>
                                        <div class="dropdown">
                                            <input type="hidden" id="priceselector" name="priceselector" value="[{$sSelectedPriceStep}]">
                                            <div class="dropdown-toggle" data-toggle="dropdown" data-target="#">
                                                <div>
                                                    [{if $sSelectedPriceStep}]
                                                        [{oxmultilang ident="D3_EXTSEARCH_EXT_CHOOSEPRICE"}]
                                                        [{assign var="blFilterOpen" value=true}]
                                                    [{else}]
                                                        [{oxmultilang ident="D3_EXTSEARCH_EXT_CHOOSEPRICE"}]
                                                    [{/if}]
                                                </div>
                                                <i class="glyphicon-chevron-down"></i>
                                            </div>
                                            <ul class="dropdown-menu" role="menu">
                                                [{if $sSelectedPriceStep}]
                                                    <li class="dropdown-option">
                                                        <a tabindex="-1" data-selection-id="" onclick="d3extSearchSubmitFilter('priceselector', this.getAttribute('data-selection-id'));">
                                                            [{oxmultilang ident="D3_EXTSEARCH_EXT_DESELECTPRICE"}]
                                                        </a>
                                                    </li>
                                                [{/if}]
                                                [{foreach from=$oView->d3getPriceSteps() item="price"}]
                                                    <li class="dropdown-option">
                                                        <a tabindex="-1" data-selection-id="[{$price->addParam}]" title="[{oxmultilang ident="D3_EXTSEARCH_EXT_PRICEFROM"}] [{$price->iFMin}] [{$currency->sign}] [{oxmultilang ident="D3_EXTSEARCH_EXT_PRICETO"}] [{$price->iFMax}] [{$currency->sign}]" onclick="d3extSearchSubmitFilter('priceselector', this.getAttribute('data-selection-id'));">
                                                            [{oxmultilang ident="D3_EXTSEARCH_EXT_PRICEFROM"}] [{$price->iFMin}] [{$currency->sign}] [{oxmultilang ident="D3_EXTSEARCH_EXT_PRICETO"}] [{$price->iFMax}] [{$currency->sign}][{if $price->iCount != ''}] ([{$price->iCount}])[{/if}]
                                                        </a>
                                                    </li>
                                                [{/foreach}]
                                            </ul>
                                        </div>

                                    [{/if}]

                                [{/block}]

                            </form>
                        [{/block}]
                    [{/if}]
                </div>

                [{if $oView->d3HasIndexList()}]
                    [{block name="d3_cfg_extsearch_searchmobile_index"}]
                        <div class="d3extsearch_mobile spacer">
                            [{include file="d3_ext_search_filter.tpl" d3fdesc="D3_EXTSEARCH_EXT_ALL"|oxmultilangassign d3fparam="all"}]
                            [{include file="d3_ext_search_filter.tpl" d3fparam="1"}]
                            [{include file="d3_ext_search_filter.tpl" d3fparam="2"}]
                            [{include file="d3_ext_search_filter.tpl" d3fparam="3"}]
                            [{include file="d3_ext_search_filter.tpl" d3fparam="4"}]
                            [{include file="d3_ext_search_filter.tpl" d3fparam="5"}]
                            [{include file="d3_ext_search_filter.tpl" d3fparam="6"}]
                            [{include file="d3_ext_search_filter.tpl" d3fparam="7"}]
                            [{include file="d3_ext_search_filter.tpl" d3fparam="8"}]
                            [{include file="d3_ext_search_filter.tpl" d3fparam="9"}]
                            [{include file="d3_ext_search_filter.tpl" d3fparam="0"}]
                            <div style="clear: both;"></div>
                            [{include file="d3_ext_search_filter.tpl" d3fparam="A"}]
                            [{include file="d3_ext_search_filter.tpl" d3fparam="B"}]
                            [{include file="d3_ext_search_filter.tpl" d3fparam="C"}]
                            [{include file="d3_ext_search_filter.tpl" d3fparam="D"}]
                            [{include file="d3_ext_search_filter.tpl" d3fparam="E"}]
                            [{include file="d3_ext_search_filter.tpl" d3fparam="F"}]
                            [{include file="d3_ext_search_filter.tpl" d3fparam="G"}]
                            [{include file="d3_ext_search_filter.tpl" d3fparam="H"}]
                            [{include file="d3_ext_search_filter.tpl" d3fparam="I"}]
                            [{include file="d3_ext_search_filter.tpl" d3fparam="J"}]
                            [{include file="d3_ext_search_filter.tpl" d3fparam="K"}]
                            [{include file="d3_ext_search_filter.tpl" d3fparam="L"}]
                            [{include file="d3_ext_search_filter.tpl" d3fparam="M"}]
                            [{include file="d3_ext_search_filter.tpl" d3fparam="N"}]
                            [{include file="d3_ext_search_filter.tpl" d3fparam="O"}]
                            [{include file="d3_ext_search_filter.tpl" d3fparam="P"}]
                            [{include file="d3_ext_search_filter.tpl" d3fparam="Q"}]
                            [{include file="d3_ext_search_filter.tpl" d3fparam="R"}]
                            [{include file="d3_ext_search_filter.tpl" d3fparam="S"}]
                            [{include file="d3_ext_search_filter.tpl" d3fparam="T"}]
                            [{include file="d3_ext_search_filter.tpl" d3fparam="U"}]
                            [{include file="d3_ext_search_filter.tpl" d3fparam="V"}]
                            [{include file="d3_ext_search_filter.tpl" d3fparam="W"}]
                            [{include file="d3_ext_search_filter.tpl" d3fparam="X"}]
                            [{include file="d3_ext_search_filter.tpl" d3fparam="Y"}]
                            [{include file="d3_ext_search_filter.tpl" d3fparam="Z"}]
                            <div style="clear: both;"></div>
                        </div>
                    [{/block}]
                [{/if}]
            </div>

            [{capture name="d3JsFnc"}][{strip}]
                $('div.dropdown').oxDropDown();
            [{/strip}][{/capture}]
            [{oxscript add=$smarty.capture.d3JsFnc}]
            [{oxscript include="js/widgets/oxattribute.js" priority=10}]
            [{capture name="d3JsFnc"}][{strip}]
                $('#filterItems').oxAttribute({blShowFilter:'$blFilterOpen'});
            [{/strip}][{/capture}]
            [{oxscript add=$smarty.capture.d3JsFnc}]
            [{capture name="d3JsFnc"}][{strip}]
                $('#sortItems').oxAttribute({blShowFilter:'$blFilterOpen'});
            [{/strip}][{/capture}]
            [{oxscript add=$smarty.capture.d3JsFnc}]

        </div>
    [{/block}]
[{/if}]
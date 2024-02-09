[{if $oView->d3HasFilters()}]
    [{block name="d3_cfg_extsearch_alist_filters"}]
        <div class="box d3_extsearch_navigation d3theme_[{$themename}] [{$sidebar_class}] baseframe">
            [{block name="d3_cfg_extsearch_alist_filters_headline"}]
                <h3>
                    [{oxmultilang ident="D3_EXTSEARCH_EXT_SEARCHBOX"}]
                </h3>
            [{/block}]

            [{block name="d3_cfg_extsearch_alist_filters_content"}]
                <div class="content list">
                    <form action="[{$oViewConf->getSelfActionLink()}]" method="post" id="d3searchfilterform" class="box d3_extsearch_navigation d3theme_[{$themename}] baseframe" autocomplete="off" spellcheck="false">
                        [{$oViewConf->getHiddenSid()}]
                        <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
                        <input type="hidden" name="searchparam" value="[{$oView->getSearchParamForHtml()}]">
                        <input type="hidden" name="fnc" value="">
                        [{foreach from=$oView->getNavigationParams() key="keyname" item="value"}]
                            [{if $keyname != 'searchcnid' && $keyname != 'searchvendor' && $keyname != 'searchmanufacturer'}]
                                <input type="hidden" name="[{$keyname|htmlentities}]" value="[{$value|htmlentities}]">
                            [{/if}]
                        [{/foreach}]
                        <input type="hidden" name="isextsearch" value="alist">

                        <div class="listFilter js-fnSubmit clear">
                            [{block name="d3_inc_ext_search__filter"}]
                                <div>
                                    [{if $oView->d3HasCategoryList()}]
                                        [{block name="d3_inc_ext_search__filter_category"}]
                                            [{include file="@d3_extsearch/filterelements/d3_ext_search_filter_category.tpl" cssclass="" sSelectedCategoryId=$sSelectedCategoryId sSelectedCategory=$sSelectedCategory}]
                                        [{/block}]
                                    [{/if}]

                                    [{if $oView->d3HasVendorList()}]
                                        [{block name="d3_inc_ext_search__filter_vendor"}]
                                            [{include file="@d3_extsearch/filterelements/d3_ext_search_filter_vendor.tpl" cssclass="" sSelectedVendorId=$sSelectedVendorId sSelectedVendor=$sSelectedVendor}]
                                        [{/block}]
                                    [{/if}]

                                    [{if $oView->d3HasManufacturerList()}]
                                        [{block name="d3_inc_ext_search__filter_manufacturer"}]
                                            [{include file="@d3_extsearch/filterelements/d3_ext_search_filter_manufacturer.tpl" cssclass="" sSelectedManufacturerId=$sSelectedManufacturerId sSelectedManufacturer=$sSelectedManufacturer}]
                                        [{/block}]
                                    [{/if}]

                                    [{if $oView->d3HasAttributeList()}]
                                        [{foreach from=$oView->d3GetAttributeList() name=search key=key item=oAttribute}]
                                            [{block name="d3_inc_ext_search__filter_attribute"}]
                                                [{include file="@d3_extsearch/filterelements/d3_ext_search_filter_attribute.tpl" cssclass="" key=$key oAttribute=$oAttribute}]
                                            [{/block}]
                                        [{/foreach}]
                                    [{/if}]

                                    [{block name="d3_inc_ext_search__filter_other"}]
                                    [{/block}]

                                    [{if $oView->d3HasPriceFilter()}]
                                        [{block name="d3_inc_ext_search__filter_price"}]
                                            [{include file="@d3_extsearch/filterelements/d3_ext_search_filter_priceselector.tpl" cssclass="" infoMinValue=$oView->d3GetPriceSliderInfoMinValue() infoMaxValue=$oView->d3GetPriceSliderInfoMaxValue() originalMinValue=$oView->d3GetPriceSliderOriginalMinValue() originalMaxValue=$oView->d3GetPriceSliderOriginalMaxValue() inputMinValue=$oView->d3GetPriceSliderInputMinValue() inputMaxValue=$oView->d3GetPriceSliderInputMaxValue() aPriceLimits=$oView->d3getPriceLimits() aPriceSteps=$oView->d3getPriceSteps() precision=$oView->d3getPricePrecision()}]
                                        [{/block}]
                                    [{/if}]
                                </div>

                                [{block name="d3_inc_ext_search__filter_clear"}]
                                    <div class="fullitem clearFilter">
                                        <button type="submit" class="submitButton largeButton btn [{if $oModCfg_d3_extsearch->isThemeIdMappedTo('wave')}]btn-outline-primary [{* for Bootstrap 4 *}][{/if}] btn-sm" onclick="document.getElementById('d3searchfilterform').isextsearch.value = false; document.getElementById('d3searchfilterform').fnc.value = 'd3ClearFilter'; d3_extsearch_popup.popup.load();">[{oxmultilang ident="D3_EXTSEARCH_EXT_CLEARFILTER"}]</button>
                                    </div>
                                [{/block}]
                            [{/block}]
                        </div>
                    </form>
                </div>
            [{/block}]
        </div>
    [{/block}]
[{/if}]

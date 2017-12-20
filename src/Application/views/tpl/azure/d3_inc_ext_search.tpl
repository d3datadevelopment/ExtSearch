[{if !$oView->getArticleCount()}]
    [{block name="d3_cfg_extsearch_search_noarticlemessage"}]
        <h3>[{oxcontent ident="d3extsearch_noarticlefound" field="oxtitle"}]</h3>
        [{oxcontent ident="d3extsearch_noarticlefound"}]
    [{/block}]
[{/if}]

[{if $oView->d3GetCMSList()}]
    [{block name="d3_cfg_extsearch_search_cms_results"}]
        <div class="box d3_extsearch_navigation d3theme_azure baseframe">
            <h3>
                [{oxmultilang ident="D3_EXTSEARCH_EXT_CMSHEADLINE"}]
            </h3>
            <div class="content list">
            <!--
            [{* Darstellung als Detaileinträge untereinander
                   <ul style="margin: 2px;">
                       [{foreach from=$oView->d3GetCMSList() item="oContent"}]
                           [{assign var="TitleCharCount" value=$oContent->oxcontents__oxtitle->value|count_characters}]
                           [{math equation="100-s" s=$TitleCharCount assign="iTextLength"}]
                           <li>
                               <a href="[{$oContent->getLink()}]"><b>[{$oContent->oxcontents__oxtitle->value}]</b> - [{$oContent->oxcontents__oxcontent->value|strip_tags|oxtruncate:$iTextLength:"..."}]</a><br>
                           </li>
                       [{/foreach}]
                   </ul>
            *}]
            -->

                [{foreach from=$oView->d3GetCMSList() item="oContent"}]
                    [{assign var="TitleCharCount" value=$oContent->oxcontents__oxtitle->value|count_characters}]
                    [{math equation="100-s" s=$TitleCharCount assign="iTextLength"}]
                    <div class="item">
                        <a href="[{$oContent->getLink()}]">[{$oContent->oxcontents__oxtitle->value}]</a>
                    </div>
                [{/foreach}]
                <div class="clearitem"></div>
            </div>
        </div>
    [{/block}]
[{/if}]

[{assign var="similarSearch" value=$oView->getSearchResultStatusMessage()}]
[{if $similarSearch}]
    [{block name="d3_cfg_extsearch_search_similar_messages"}]
        <div class="d3_extsearch_navigation d3theme_azure baseframe">
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

[{if $blSearchPluginLink == 1}]
    [{block name="d3_cfg_extsearch_search_plugin"}]
        <div class="box d3_extsearch_navigation d3theme_azure baseframe">
            <h3>
                [{oxmultilang ident="D3_EXTSEARCH_EXT_PLUGINHEADLINE"}]
            </h3>
            <div class="content list">
                <SCRIPT type="text/javascript">
                    function installSearchEngine() {
                        if (window.external && ("AddSearchProvider" in window.external)) {
                            window.external.AddSearchProvider("[{$sSearchPluginURL}]");
                        } else {
                            alert('[{oxmultilang ident="D3_EXTSEARCH_EXT_PLUGINBROWSERERROR"}]');
                        }
                    }
                </SCRIPT>
                [{oxmultilang ident="D3_EXTSEARCH_EXT_PLUGININSTALLMSG"}]
                <div style="text-align: center; padding-top: 5px;"><a class="login_button" style="padding: 2px;" onclick="installSearchEngine();">[{oxmultilang ident="D3_EXTSEARCH_EXT_PLUGININSTALLBTN"}]</a></div>
            </div>
        </div>
    [{/block}]
[{/if}]

[{if $oView->d3HasFilters()}]
    [{block name="d3_cfg_extsearch_search_filters"}]
        <div class="box d3_extsearch_navigation d3theme_azure baseframe">
            [{block name="d3_cfg_extsearch_search_filters_headline"}]
                <h3>
                    [{oxmultilang ident="D3_EXTSEARCH_EXT_SEARCHBOX"}]
                </h3>
            [{/block}]

            [{block name="d3_cfg_extsearch_search_filters_content"}]
                <div class="content list">
                    <form action="[{$oViewConf->getSelfActionLink()}]" method="post" id="d3searchfilterform" autocomplete="off" spellcheck="false">
                        [{$oViewConf->getHiddenSid()}]
                        <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
                        <input type="hidden" name="fnc" value="">
                        [{foreach from=$oView->getNavigationParams() key="keyname" item="value"}]
                            [{if $keyname != 'searchcnid' && $keyname != 'searchvendor' && $keyname != 'searchmanufacturer'}]
                                <input type="hidden" name="[{$keyname}]" value="[{$value}]">
                            [{/if}]
                        [{/foreach}]
                        <input type="hidden" name="isextsearch" value="search">

                        [{block name="d3_inc_ext_search__filter"}]
                            [{if $oView->d3HasCategoryList()}]
                                [{block name="d3_inc_ext_search__filter_category"}]
                                    [{include file="d3_ext_search_filter_category.tpl" cssclass="" sSelectedCategoryId=$sSelectedCategoryId sSelectedCategory=$sSelectedCategory}]
                                [{/block}]
                            [{/if}]

                            [{if $oView->d3HasVendorList()}]
                                [{block name="d3_inc_ext_search__filter_vendor"}]
                                    [{include file="d3_ext_search_filter_vendor.tpl" cssclass="" sSelectedVendorId=$sSelectedVendorId sSelectedVendor=$sSelectedVendor}]
                                [{/block}]
                            [{/if}]

                            [{if $oView->d3HasManufacturerList()}]
                                [{block name="d3_inc_ext_search__filter_manufacturer"}]
                                    [{include file="d3_ext_search_filter_manufacturer.tpl" cssclass="" sSelectedManufacturerId=$sSelectedManufacturerId sSelectedManufacturer=$sSelectedManufacturer}]
                                [{/block}]
                            [{/if}]

                            [{if $oView->d3HasAttributeList()}]
                                [{foreach from=$oView->d3GetAttributeList() name=search key=key item=oAttribute}]
                                    [{block name="d3_inc_ext_search__filter_attribute"}]
                                        [{include file="d3_ext_search_filter_attribute.tpl" cssclass="" key=$key oAttribute=$oAttribute}]
                                    [{/block}]
                                [{/foreach}]
                            [{/if}]

                            [{if $oView->d3HasPriceFilter()}]
                                [{block name="d3_inc_ext_search__filter_price"}]
                                    [{include file="d3_ext_search_filter_priceselector.tpl" cssclass="" infoMinValue=$oView->d3GetPriceSliderInfoMinValue() infoMaxValue=$oView->d3GetPriceSliderInfoMaxValue() originalMinValue=$oView->d3GetPriceSliderOriginalMinValue() originalMaxValue=$oView->d3GetPriceSliderOriginalMaxValue() inputMinValue=$oView->d3GetPriceSliderInputMinValue() inputMaxValue=$oView->d3GetPriceSliderInputMaxValue() aPriceLimits=$oView->d3getPriceLimits() aPriceSteps=$oView->d3getPriceSteps()}]
                                [{/block}]
                            [{/if}]

                            <noscript>
                                <div class="fullitem">
                                    <span class="btn">
                                        <input type="submit" value="[{oxmultilang ident="D3_EXTSEARCH_EXT_START_SEARCH"}]">
                                    </span>
                                </div>
                            </noscript>

                            [{block name="d3_inc_ext_search__filter_clear"}]
                                <div class="fullitem clearFilter">
                                    <button type="submit" class="submitButton largeButton" onclick="document.getElementById('d3searchfilterform').isextsearch.value = false; document.getElementById('d3searchfilterform').fnc.value = 'd3ClearFilter'; d3_extsearch_popup.popup.load();">[{oxmultilang ident="D3_EXTSEARCH_EXT_CLEARFILTER"}]</button>
                                </div>
                            [{/block}]

                            <div class="clearitem"></div>
                        [{/block}]
                    </form>
                </div>
            [{/block}]
        </div>
    [{/block}]
[{/if}]

[{if $oView->d3HasIndexList()}]
    [{block name="d3_cfg_extsearch_search_index"}]
        <div class="d3_extsearch_navigation d3theme_azure baseframe fit">
            [{include file="d3_ext_search_filter.tpl" d3fdesc="D3_EXTSEARCH_EXT_ALL"|oxmultilangassign d3fparam="all"}]
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
        </div>
    [{/block}]
[{/if}]

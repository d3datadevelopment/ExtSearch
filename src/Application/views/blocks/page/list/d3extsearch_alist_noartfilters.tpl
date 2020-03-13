[{d3modcfgcheck modid="d3_extsearch"}][{/d3modcfgcheck}]
[{if $mod_d3_extsearch && $oView->getArticleList()|@count == 0 && $blD3HasSelectedFilters}]
    <div class="d3searchdeselectform">
        <form action="[{$oViewConf->getSelfActionLink()}]" method="post" id="d3searchfilterform">
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

            [{oxmultilang ident="D3_EXTSEARCH_EXT_NOARTDESELECT"}]

            [{block name="d3_inc_ext_search__filter_clear"}]
                <div class="fullitem clearFilter">
                    <button type="submit" class="submitButton largeButton" onclick="document.getElementById('d3searchfilterform').isextsearch.value = false; document.getElementById('d3searchfilterform').fnc.value = 'd3ClearFilter'; d3_extsearch_popup.popup.load();">[{oxmultilang ident="D3_EXTSEARCH_EXT_CLEARFILTER"}]</button>
                </div>
            [{/block}]
        </form>
    </div>
[{/if}]

[{$smarty.block.parent}]
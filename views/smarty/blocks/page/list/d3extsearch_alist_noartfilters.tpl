[{d3modcfgcheck modid="d3_extsearch"}][{/d3modcfgcheck}]
[{assign var="articleList" value=$oView->getArticleList()}]

[{if $mod_d3_extsearch && (!$articleList || $articleList|@count == 0) && $blD3HasSelectedFilters}]
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

            [{block name="d3_inc_ext_search__filter_message"}]
                <div class="alert alert-info">
                    [{oxmultilang ident="D3_EXTSEARCH_EXT_NOARTDESELECT"}]
                </div>
            [{/block}]

            [{block name="d3_inc_ext_search__filter_clear"}]
                <div class="fullitem clearFilter">
                    <button type="submit" class="submitButton largeButton btn [{if $oModCfg_d3_extsearch->isThemeIdMappedTo('wave')}]btn-outline-primary [{* for Bootstrap 4 *}][{/if}]  btn-sm" onclick="document.getElementById('d3searchfilterform').isextsearch.value = false; document.getElementById('d3searchfilterform').fnc.value = 'd3ClearFilter'; d3_extsearch_popup.popup.load();">[{oxmultilang ident="D3_EXTSEARCH_EXT_CLEARFILTER"}]</button>
                </div>
            [{/block}]
        </form>
    </div>
[{/if}]

[{$smarty.block.parent}]
[{d3modcfgcheck modid="d3_extsearch"}][{/d3modcfgcheck}]

[{if $mod_d3_extsearch && false == $oModCfg_d3_extsearch->isThemeIdMappedTo('mobile')}]
    [{block name="widget_header_search_form_replacement"}]
        [{capture assign="content"}][{$smarty.block.parent}][{/capture}]

        [{capture assign="search"}][{strip}]
            name="search"
        [{/strip}][{/capture}]

        [{capture assign="replace"}][{strip}]
            name="search" id="search" onSubmit="d3_extsearch_popup.popup.load();" autocomplete="off" spellcheck="false"
        [{/strip}][{/capture}]

        [{$content|replace:$search:$replace}]
    [{/block}]
[{else}]
    [{$smarty.block.parent}]
[{/if}]

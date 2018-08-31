[{$smarty.block.parent}]

[{d3modcfgcheck modid="d3_extsearch"}][{/d3modcfgcheck}]

[{if $mod_d3_extsearch}]
    [{if $oModCfg_d3_extsearch->isThemeIdMappedTo('mobile')}]
        [{assign var="sCssName" value="out/src/css/d3extsearch_mobile.min.css"}]
        [{include file=$oViewConf->getModulePath('d3_extsearch', 'out/src/css/abovethefold/d3extsearch_mobile.min.css') assign="atfCss"}]
    [{elseif $oModCfg_d3_extsearch->isThemeIdMappedTo('flow')}]
        [{assign var="sCssName" value="out/src/css/d3extsearch_flow.min.css"}]
        [{include file=$oViewConf->getModulePath('d3_extsearch', 'out/src/css/abovethefold/d3extsearch_flow.min.css') assign="atfCss"}]
    [{elseif $oModCfg_d3_extsearch->isThemeIdMappedTo('azure')}]
        [{assign var="sCssName" value="out/src/css/d3extsearch_azure.min.css"}]
        [{include file=$oViewConf->getModulePath('d3_extsearch', 'out/src/css/abovethefold/d3extsearch_azure.min.css') assign="atfCss"}]
    [{else}]
        [{assign var="sCssName" value="out/src/css/d3extsearch_allthemes.min.css"}]
        [{include file=$oViewConf->getModulePath('d3_extsearch', 'out/src/css/abovethefold/d3extsearch_allthemes.min.css') assign="atfCss"}]
    [{/if}]

    [{oxstyle include=$oViewConf->getModuleUrl('d3_extsearch', $sCssName)}]
    [{if $atfCss}]<style type="text/css">[{$atfCss}]</style>[{/if}]

    [{if $blSearchPluginInstall == '1' && $sSearchPluginURL}]
        <link rel="search" type="application/opensearchdescription+xml" title="[{$oxcmp_shop->oxshops__oxname->value}]" href="[{$sSearchPluginURL}]" />
    [{/if}]
[{/if}]

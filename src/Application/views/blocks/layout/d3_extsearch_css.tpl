[{$smarty.block.parent}]

[{d3modcfgcheck modid="d3_extsearch"}][{/d3modcfgcheck}]

[{if $mod_d3_extsearch}]
    [{if $oModCfg_d3_extsearch->isThemeIdMappedTo('mobile')}]
        [{assign var="sCssName" value="out/src/css/d3extsearch_mobile.min.css"}]
    [{elseif $oModCfg_d3_extsearch->isThemeIdMappedTo('flow')}]
        [{assign var="sCssName" value="out/src/css/d3extsearch_flow.min.css"}]
    [{elseif $oModCfg_d3_extsearch->isThemeIdMappedTo('azure')}]
        [{assign var="sCssName" value="out/src/css/d3extsearch_azure.min.css"}]
    [{else}]
        [{assign var="sCssName" value="out/src/css/d3extsearch_allthemes.min.css"}]
    [{/if}]

    [{oxstyle include=$oViewConf->getModuleUrl('d3_extsearch', $sCssName)}]

    [{if $blSearchPluginInstall == '1' && $sSearchPluginURL}]
        <link rel="search" type="application/opensearchdescription+xml" title="[{$oxcmp_shop->oxshops__oxname->value}]" href="[{$sSearchPluginURL}]" />
    [{/if}]
[{/if}]

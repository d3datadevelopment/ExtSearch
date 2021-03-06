[{$smarty.block.parent}]

[{d3modcfgcheck modid="d3_extsearch"}][{/d3modcfgcheck}]

[{if $mod_d3_extsearch}]
    [{assign var="sCssName" value="out/src/css/d3extsearch_"|cat:$oModCfg_d3_extsearch->getMappedThemeId()|cat:".min.css"}]

    [{if $sAboveTheFoldCssFile}]
        [{include file=$sAboveTheFoldCssFile assign="atfCss"}]
    [{/if}]

    [{oxstyle include=$oViewConf->getModuleUrl('d3_extsearch', $sCssName)}]
    [{if $atfCss}]<style type="text/css">[{$atfCss}]</style>[{/if}]

    [{if $blSearchPluginInstall == '1' && $sSearchPluginURL}]
        <link rel="search" type="application/opensearchdescription+xml" title="[{$oxcmp_shop->oxshops__oxname->value}]" href="[{$sSearchPluginURL}]" />
    [{/if}]

    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "WebSite",
            "url": "[{$oViewConf->getHomeLink()}]",
            "potentialAction": {
                "@type": "SearchAction",
                "target": "[{$oViewConf->getSelfLink()|oxaddparams:"cl=search"|oxaddparams:"searchparam="|cat:"{search_term_string}"}]",
                "query-input": "required name=search_term_string"
            }
        }
    </script>
[{/if}]

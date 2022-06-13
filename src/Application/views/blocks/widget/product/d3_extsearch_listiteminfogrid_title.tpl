[{d3modcfgcheck modid="d3_extsearch"}][{/d3modcfgcheck}]
[{if $mod_d3_extsearch}]
    [{if $oModCfg_d3_extsearch->isThemeIdMappedTo('flow')}]
        <div class="title">
            <a id="[{$testid}]" href="[{$_productLink}]" class="title" title="[{$product->oxarticles__oxtitle->value}] [{$product->oxarticles__oxvarselect->value}]">
                <span>[{d3_extsearch_highlight text=$product->oxarticles__oxtitle->value}] [{d3_extsearch_highlight text=$product->oxarticles__oxvarselect->value}]</span>
            </a>

            [{if $product->blIsSimilar}]<span class='similar'>[{oxmultilang ident="D3_EXTSEARCH_EXT_SIMILAR"}]</span>[{/if}]
            [{if $product->isD3CatHit}]<span class='similar'>[{oxmultilang ident="D3_EXTSEARCH_EXT_CATHIT"}]</span>[{/if}]
        </div>
    [{else}]
        <div class="titleBox">
            <a id="[{$testid}]" href="[{$_productLink}]" class="title" title="[{$product->oxarticles__oxtitle->value}] [{$product->oxarticles__oxvarselect->value}]">
                <span>[{d3_extsearch_highlight text=$product->oxarticles__oxtitle->value}] [{d3_extsearch_highlight text=$product->oxarticles__oxvarselect->value}]</span>
            </a>

            [{if $product->blIsSimilar}]<span class='similar'>[{oxmultilang ident="D3_EXTSEARCH_EXT_SIMILAR"}]</span>[{/if}]
            [{if $product->isD3CatHit}]<span class='similar'>[{oxmultilang ident="D3_EXTSEARCH_EXT_CATHIT"}]</span>[{/if}]
        </div>
    [{/if}]
[{else}]
    [{$smarty.block.parent}]
[{/if}]

[{d3modcfgcheck modid="d3_extsearch"}][{/d3modcfgcheck}]
[{if $mod_d3_extsearch && $oModCfg_d3_extsearch->isThemeIdMappedTo('flow')}]
    <div class="title">
        <a id="[{$testid}]" href="[{$_productLink}]" class="title" title="[{$product->oxarticles__oxtitle->value}] [{$product->oxarticles__oxvarselect->value}]">
[{*** D3 Modul "extSearch" CHANGE START ***}]
            <span>[{d3_extsearch_highlight text=$product->oxarticles__oxtitle->value}] [{d3_extsearch_highlight text=$product->oxarticles__oxvarselect->value}]</span>
[{*** D3 Modul "extSearch" CHANGE END ***}]
        </a>
[{*** D3 Modul "extSearch" ADD START ***}]
        [{if $product->blIsSimilar}]<span class='similar'>[{oxmultilang ident="D3_EXTSEARCH_EXT_SIMILAR"}]</span>[{/if}]
        [{if $product->isD3CatHit}]<span class='similar'>[{oxmultilang ident="D3_EXTSEARCH_EXT_CATHIT"}]</span>[{/if}]
[{*** D3 Modul "extSearch" ADD END ***}]
    </div>
[{else}]
    [{$smarty.block.parent}]
[{/if}]
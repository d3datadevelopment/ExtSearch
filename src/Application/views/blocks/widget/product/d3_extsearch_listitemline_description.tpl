[{d3modcfgcheck modid="d3_extsearch"}][{/d3modcfgcheck}]

[{if $mod_d3_extsearch}]
    <div class="description">
        [{if $recommid}]
            <div>[{d3_extsearch_highlight text=$product->text|truncate:160:"..."}]</div>
        [{else}]
            [{oxhasrights ident="SHOWSHORTDESCRIPTION"}]
                [{d3_extsearch_highlight text=$product->oxarticles__oxshortdesc->value|truncate:160:"..."}]
            [{/oxhasrights}]
        [{/if}]
    </div>
[{else}]
    [{$smarty.block.parent}]
[{/if}]
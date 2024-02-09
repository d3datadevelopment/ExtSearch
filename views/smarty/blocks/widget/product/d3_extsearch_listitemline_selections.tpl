[{d3modcfgcheck modid="d3_extsearch"}][{/d3modcfgcheck}]
[{if $mod_d3_extsearch && false == $oModCfg_d3_extsearch->isThemeIdMappedTo('flow')}]
    <div class="info">
        <a id="[{$testid}]" href="[{$_productLink}]" class="title" title="[{$product->oxarticles__oxtitle->value}] [{$product->oxarticles__oxvarselect->value}]">
            <span>[{d3_extsearch_highlight text=$product->oxarticles__oxtitle->value}] [{d3_extsearch_highlight text=$product->oxarticles__oxvarselect->value}]</span>
        </a>
        [{if $product->blIsSimilar}]<span class='similar'>[{oxmultilang ident="D3_EXTSEARCH_EXT_SIMILAR"}]</span>[{/if}]
        [{if $product->isD3CatHit}]<span class='similar'>[{oxmultilang ident="D3_EXTSEARCH_EXT_CATHIT"}]</span>[{/if}]
        <div class="variants">
        [{if $aVariantSelections && $aVariantSelections.selections}]
            <div id="variantselector_[{$testid}]" class="selectorsBox js-fnSubmit clear">
                [{foreach from=$aVariantSelections.selections item=oSelectionList key=iKey}]
                    [{include file="widget/product/selectbox.tpl" oSelectionList=$oSelectionList sJsAction="js-fnSubmit"}]
                [{/foreach}]
            </div>
        [{elseif $oViewConf->showSelectListsInList()}]
            [{assign var="oSelections" value=$product->getSelections(1)}]
            [{if $oSelections}]
                <div id="selectlistsselector_[{$testid}]" class="selectorsBox js-fnSubmit clear">
                    [{foreach from=$oSelections item=oList name=selections}]
                        [{include file="widget/product/selectbox.tpl" oSelectionList=$oList sFieldName="sel" iKey=$smarty.foreach.selections.index blHideDefault=true sSelType="seldrop" sJsAction="js-fnSubmit"}]
                    [{/foreach}]
                </div>
            [{/if}]
        [{/if}]
        </div>
    </div>
[{else}]
    [{$smarty.block.parent}]
[{/if}]

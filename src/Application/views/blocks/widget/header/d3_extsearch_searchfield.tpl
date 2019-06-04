[{d3modcfgcheck modid="d3_extsearch"}][{/d3modcfgcheck}]

[{if $mod_d3_extsearch && false == $oModCfg_d3_extsearch->isThemeIdMappedTo('mobile')}]

    [{block name="d3_extsearch_header_searchfield_searchparam"}]
        [{capture assign="content"}][{$smarty.block.parent}][{/capture}]

        [{capture assign="search"}][{strip}]
            id="searchParam"
        [{/strip}][{/capture}]

        [{capture assign="replace"}][{strip}]
            [{$search}] autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" suggestLeftOffsetPx="0" suggestTopOffsetPx="0"
        [{/strip}][{/capture}]

        [{$content|replace:$search:$replace}]
    [{/block}]

    [{if $blOwnFormFields}]
        [{block name="d3_extsearch_header_searchfield_ownformfields"}]
            [{*** Fuegen Sie hier bei Bedarf noch weitere Filtermoeglichkeiten hinzu ***}]
            [{* Gesucht wird nach Teilen mit LIKE *}]
            [{oxmultilang ident="D3_CUSTOMFIELDTEXT_LIKETITLE"}]
            <input type="text" name="d3searchlike[oxtitle]" value="[{$aD3SearchLike.oxtitle}]" size="21" class="txt"><br>
            [{*<input type="text" name="d3searchlike[oxshortdesc]" value="[{$aD3SearchLike.oxshortdesc}]" size="21" class="txt">*}]
            [{* Gesucht wird nach genauem Wortlaut mit = *}]
            [{oxmultilang ident="D3_CUSTOMFIELDTEXT_ISARTNUM"}]
            <input type="text" name="d3searchis[oxartnum]" value="[{$aD3SearchIs.oxartnum}]" size="21" class="txt"><br>
            [{*<input type="text" name="d3searchis[oxshortdesc]" value="[{$aD3SearchIs.oxshortdesc}]" size="21" class="txt">*}]
            [{oxmultilang ident="D3_CUSTOMFIELDTEXT_ISBETWEENSTOCK"}]
            <select name="d3searchis[oxstock]">
                <option value="">[{oxmultilang ident="D3_CUSTOMFIELDTEXT_CHOOSESTOCK"}]</option>    [{* change description to your requirements *}]
                <option value="BETWEEN__AND_5_" [{if $aD3SearchIs.oxstock == 'BETWEEN__AND_5_'}] selected[{/if}]>bis 5</option>
                <option value="BETWEEN_3_AND_7_" [{if $aD3SearchIs.oxstock == 'BETWEEN_3_AND_7_'}] selected[{/if}]>von 3 bis 7</option>
                <option value="BETWEEN_8_AND_200_" [{if $aD3SearchIs.oxstock == 'BETWEEN_8_AND_200_'}] selected[{/if}]>von 8 bis 200</option>
                <option value="BETWEEN_201_AND__" [{if $aD3SearchIs.oxstock == 'BETWEEN_201_AND__'}] selected[{/if}]>ab 201</option>
            </select><br>
            [{oxmultilang ident="D3_CUSTOMFIELDTEXT_ISBETWEENPRICE"}]
            <select name="d3searchis[oxprice]">
                <option value="">[{oxmultilang ident="D3_CUSTOMFIELDTEXT_CHOOSEPRICE"}]</option>  [{* change description to your requirements *}]
                <option value="BETWEEN__AND_3.5_" [{if $aD3SearchIs.oxprice == 'BETWEEN__AND_3.5_'}] selected[{/if}]>bis 3,50</option>
                <option value="BETWEEN_3_AND_8.7_" [{if $aD3SearchIs.oxprice == 'BETWEEN_3_AND_8.7_'}] selected[{/if}]>von 3,00 bis 8,70</option>
                <option value="BETWEEN_8.71_AND__" [{if $aD3SearchIs.oxprice == 'BETWEEN_8.71_AND__'}] selected[{/if}]>ab 8,71</option>
            </select><br>
        [{/block}]
    [{/if}]
[{else}]
    [{$smarty.block.parent}]
[{/if}]
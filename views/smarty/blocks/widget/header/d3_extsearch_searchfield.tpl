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
            <label for="liketitle">[{oxmultilang ident="D3_CUSTOMFIELDTEXT_LIKETITLE"}]</label>
            <input type="text" name="d3searchlike[oxtitle]" id="liketitle" value="[{$aD3SearchLike.oxtitle}]" size="21" class="txt"><br>
            [{*<input type="text" name="d3searchlike[oxshortdesc]" value="[{$aD3SearchLike.oxshortdesc}]" size="21" class="txt">*}]
            [{* Gesucht wird nach genauem Wortlaut mit = *}]
            <label for="isartnum">[{oxmultilang ident="D3_CUSTOMFIELDTEXT_ISARTNUM"}]</label>
            <input type="text" name="d3searchis[oxartnum]" id="isartnum" value="[{$aD3SearchIs.oxartnum}]" size="21" class="txt"><br>
            [{*<input type="text" name="d3searchis[oxshortdesc]" value="[{$aD3SearchIs.oxshortdesc}]" size="21" class="txt">*}]
            <label for="isstock">[{oxmultilang ident="D3_CUSTOMFIELDTEXT_ISBETWEENSTOCK"}]</label>
            <select name="d3searchis[oxstock]" id="isstock">
                <option value="">[{oxmultilang ident="D3_CUSTOMFIELDTEXT_CHOOSESTOCK"}]</option>    [{* change description to your requirements *}]
                <option value="BETWEEN__AND_5_" [{if $aD3SearchIs.oxstock == 'BETWEEN__AND_5_'}] selected[{/if}]>bis 5</option>
                <option value="BETWEEN_3_AND_7_" [{if $aD3SearchIs.oxstock == 'BETWEEN_3_AND_7_'}] selected[{/if}]>von 3 bis 7</option>
                <option value="BETWEEN_8_AND_200_" [{if $aD3SearchIs.oxstock == 'BETWEEN_8_AND_200_'}] selected[{/if}]>von 8 bis 200</option>
                <option value="BETWEEN_201_AND__" [{if $aD3SearchIs.oxstock == 'BETWEEN_201_AND__'}] selected[{/if}]>ab 201</option>
            </select><br>
            <label for="isprice">[{oxmultilang ident="D3_CUSTOMFIELDTEXT_ISBETWEENPRICE"}]</label>
            <select name="d3searchis[oxprice]" id="isprice">
                <option value="">[{oxmultilang ident="D3_CUSTOMFIELDTEXT_CHOOSEPRICE"}]</option>  [{* change description to your requirements *}]
                <option value="BETWEEN__AND_3.5_" [{if $aD3SearchIs.oxprice == 'BETWEEN__AND_3.5_'}] selected[{/if}]>bis 3,50</option>
                <option value="BETWEEN_3_AND_8.7_" [{if $aD3SearchIs.oxprice == 'BETWEEN_3_AND_8.7_'}] selected[{/if}]>von 3,00 bis 8,70</option>
                <option value="BETWEEN_8.71_AND__" [{if $aD3SearchIs.oxprice == 'BETWEEN_8.71_AND__'}] selected[{/if}]>ab 8,71</option>
            </select><br>
            [{oxmultilang ident="D3_CUSTOMFIELDTEXT_BITSET"}]
            <input type="hidden" name="d3searchbitset[bitfield][]" value="">
            <input type="checkbox" name="d3searchbitset[bitfield][]" value="1" [{if $aD3SearchBitSet.bitfield && '1'|in_array:$aD3SearchBitSet.bitfield}]checked[{/if}] onchange="d3_extsearch_popup.popup.load(); this.form.submit();" id="bitfield1"> <label for="bitfield1">1</label><br>
            <input type="checkbox" name="d3searchbitset[bitfield][]" value="2" [{if $aD3SearchBitSet.bitfield && '2'|in_array:$aD3SearchBitSet.bitfield}]checked[{/if}] onchange="d3_extsearch_popup.popup.load(); this.form.submit();" id="bitfield2"> <label for="bitfield2">2</label><br>
            <input type="checkbox" name="d3searchbitset[bitfield][]" value="4" [{if $aD3SearchBitSet.bitfield && '4'|in_array:$aD3SearchBitSet.bitfield}]checked[{/if}] onchange="d3_extsearch_popup.popup.load(); this.form.submit();" id="bitfield3"> <label for="bitfield3">4</label><br>
            <input type="checkbox" name="d3searchbitset[bitfield][]" value="8" [{if $aD3SearchBitSet.bitfield && '8'|in_array:$aD3SearchBitSet.bitfield}]checked[{/if}] onchange="d3_extsearch_popup.popup.load(); this.form.submit();" id="bitfield4"> <label for="bitfield4">8</label><br>
        [{/block}]
    [{/if}]
[{else}]
    [{$smarty.block.parent}]
[{/if}]
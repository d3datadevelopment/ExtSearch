[{assign var="sIdKey" value=$key|replace:".":""}]
[{assign var="blShowMultipleSelector" value=true}]
<div class="item attribute  [{$cssclass}]" id="atid_[{$key}]">
    <label for="d3searchattrib__[{$key}]">
        [{$oAttribute->title}]:
    </label><br>

    [{if in_array($sAttributeFilterDisplayType, array('combined', 'single'))}]
        [{block name="d3_inc_ext_search__filter_attribute_single"}]
            <SELECT id="d3searchattrib__[{$key}]" name="d3searchattrib[[{$key}]]" onchange="d3_extsearch_popup.popup.load(); this.form.submit();">
                [{if $oAttribute->selected}]
                    [{assign var="blShowMultipleSelector" value=false}]
                    <OPTION class="desc" value="[{$oView->d3GetDeselectValue()}]">[{oxmultilang ident="D3_EXTSEARCH_EXT_ATTRIBSDESELECT1"}] [{$oAttribute->title}] [{oxmultilang ident="D3_EXTSEARCH_EXT_ATTRIBSDESELECT2"}]</OPTION>
                [{else}]
                    <OPTION class="desc" value="" selected="selected">[{oxmultilang ident="D3_EXTSEARCH_EXT_ATTRIBSNOSELECTION1"}] [{$oAttribute->title}] [{oxmultilang ident="D3_EXTSEARCH_EXT_ATTRIBSNOSELECTION2"}]</OPTION>
                [{/if}]
                [{foreach from=$oAttribute->_aList name=attrvalues key=valuekey item=oAttrValue}]
                    <OPTION class="[{if $oAttrValue->highlighted}]highlight [{/if}]" value="[{$oAttrValue->rawvalue}]" [{if false == $oView->d3AttributeFilterUseMultipleValues($key) && $oAttrValue->selected}] selected[{/if}] [{if false == $oAttrValue->isSelectable}] disabled[{/if}]>[{$oAttrValue->value}]
                        [{if !$oModCfg_d3_extsearch->getValue('blExtSearch_dontShowFilterArticleCount') && $oAttrValue->count}]
                            ([{$oAttrValue->count}])
                        [{/if}]
                    </OPTION>
                [{/foreach}]
            </SELECT>
        [{/block}]
    [{/if}]

    [{if in_array($sAttributeFilterDisplayType, array('combined', 'multi'))}]
        [{block name="d3_inc_ext_search__filter_attribute_multi"}]
            <div id="d3searchattrib__multi__[{$key}]" style="[{if $sAttributeFilterDisplayType == 'combined'}]display: none;[{/if}]">
                [{foreach from=$oAttribute->_aList name=attrvalues key=valuekey item=oAttrValue}]
                    <input name="d3searchattribmulti[[{$key}]][[{$oAttrValue->rawvalue}]]" type="hidden" value="[{$oView->d3GetDeselectValue()}]">
                    <input name="d3searchattribmulti[[{$key}]][[{$oAttrValue->rawvalue}]]" type="checkbox" value="[{$oAttrValue->rawvalue}]" id="cb[{$key}][{$oAttrValue->rawvalue}]" [{if $oAttrValue->selected}] checked[{/if}] [{if false == $oAttrValue->isSelectable}] disabled[{/if}]>
                    <label for="cb[{$key}][{$oAttrValue->rawvalue}]">
                        [{$oAttrValue->value}] [{if !$oModCfg_d3_extsearch->getValue('blExtSearch_dontShowFilterArticleCount') && $oAttrValue->count}]([{$oAttrValue->count}])[{/if}]
                    </label><br>
                [{/foreach}]

                [{include file="d3_ext_search_filter_inc_multibuttons.tpl" type="attrib"}]
            </div>
        [{/block}]
    [{/if}]

    [{block name="d3_inc_ext_search__filter_attribute_multiselector"}]
        [{if $sAttributeFilterDisplayType == 'combined'}]
            <div id="d3searchattrib__multiselector__[{$key}]" class="filterselector [{if false == $blShowMultipleSelector}]filterselector_hidden[{/if}]">
                <input type="checkbox" name="d3searchattribmultiselector[[{$key}]]" id="d3searchattribmultiselector[[{$key}]]" onclick="toggleMultiAttrib(this.checked, '[{$key}]');">
                <label for="d3searchattribmultiselector[[{$key}]]">
                    [{$oView->d3GetMultipleSelectionTranslation($oAttribute->title)}]
                </label>
            </div>

            [{capture name="d3JsFnc"}][{strip}]
                function toggleMultiAttrib(blChecked, sId) {
                    if (blChecked) {
                        document.getElementById('d3searchattrib__multi__' + sId).style.display = 'block';
                        document.getElementById('d3searchattrib__' + sId).style.display = 'none';
                        if (selectorElement = document.getElementById('d3searchattrib__multiselector__' + sId)) {
                            selectorElement.style.display = 'none';
                        }
                    }
                }
            [{/strip}][{/capture}]
            [{oxscript add=$smarty.capture.d3JsFnc}]

            [{if $oView->d3AttributeFilterUseMultipleValues($key)}]
                [{capture name="d3JsFnc"}][{strip}]
                    toggleMultiAttrib(true, '[{$key}]');
                    if (selectorElement = document.getElementById('d3searchattribmultiselector[[{$key}]]')) {
                        selectorElement.checked = 'checked';
                    }
                [{/strip}][{/capture}]
                [{oxscript add=$smarty.capture.d3JsFnc}]
            [{/if}]
        [{elseif $sAttributeFilterDisplayType == 'single'}]
            <input type="hidden" value="" name="d3searchattribmultiselector[[{$key}]]" id="d3searchattribmultiselector[[{$key}]]">
        [{elseif $sAttributeFilterDisplayType == 'multi'}]
            <input type="hidden" value="on" name="d3searchattribmultiselector[[{$key}]]" id="d3searchattribmultiselector[[{$key}]]">
        [{/if}]
    [{/block}]
</div>
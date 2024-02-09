[{assign var="sIdKey" value="vendor"}]
[{assign var="blShowMultipleSelector" value=true}]
<div class="item vendor [{$cssclass}]" id="atid_vendor">
    [{block name="d3_inc_ext_search__filter_vendor_title"}]
        <label for="searchvendor">
            [{oxmultilang ident="D3_EXTSEARCH_EXT_VENDORS"}]
        </label><br>
    [{/block}]

    [{if in_array($sVendorFilterDisplayType, array('combined', 'single'))}]
        [{block name="d3_inc_ext_search__filter_vendor_single"}]
            <SELECT id="searchvendor" name="searchvendor" onchange="d3_extsearch_popup.popup.load(); this.form.submit();">
                [{if $sSelectedVendorId}]
                    [{assign var="blShowMultipleSelector" value=false}]
                    <OPTION class="desc" value="">[{oxmultilang ident="D3_EXTSEARCH_EXT_SEARCHINVENDORS"}]</OPTION>
                    <OPTION value="[{$sSelectedVendorId}]" selected="selected">[{$sSelectedVendor}]</OPTION>
                [{else}]
                    <OPTION class="desc" value="" selected="selected">[{oxmultilang ident="D3_EXTSEARCH_EXT_CHOOSEVENDOR"}]</OPTION>
                    [{foreach from=$oView->d3getVendorList() item="vendor"}]
                        <OPTION value="[{$vendor->getId()}]">[{$vendor->oxvendor__oxtitle->getRawValue()}]
                            [{if !$oModCfg_d3_extsearch->getValue('blExtSearch_dontShowFilterArticleCount') && $vendor->getFieldData('counter')}]
                                ([{$vendor->getFieldData('counter')}])
                            [{/if}]
                        </OPTION>
                    [{/foreach}]
                [{/if}]
            </SELECT>

            <noscript>
                <div id="searchvendorsubmit" class="fullitem">
                    <button type="submit" class="submitButton largeButton btn [{if $oModCfg_d3_extsearch->isThemeIdMappedTo('wave')}]btn-outline-primary [{* for Bootstrap 4 *}][{/if}] btn-sm" onclick="d3_extsearch_popup.popup.load();">[{oxmultilang ident="D3_EXTSEARCH_EXT_ASSIGNFILTER"}]</button>
                </div>
            </noscript>
        [{/block}]
    [{/if}]

    [{if in_array($sVendorFilterDisplayType, array('combined', 'multi'))}]
        [{block name="d3_inc_ext_search__filter_vendor_multi"}]
            <div class="multiselect" id="d3searchvendor__multi" style="[{if $sVendorFilterDisplayType == 'combined'}]display: none;[{/if}]">
                [{foreach from=$oView->d3getVendorList() name=attrvalues key=valuekey item=vendor}]
                    <div class="multiselectvalue" id="d3searchvendor__multi__[{$valuekey}]">
                        <input name="d3searchvendormulti[[{$vendor->getId()}]]" type="hidden" value="">
                        <input name="d3searchvendormulti[[{$vendor->getId()}]]" type="checkbox" value="[{$vendor->getId()}]" id="cb[{$key}][{$vendor->getId()}]" [{if $vendor->selected || $vendor->getId() == $sSelectedVendorId}] checked[{/if}]>
                        <label for="cb[{$key}][{$vendor->getId()}]">
                            [{$vendor->getTitle()}] [{if !$oModCfg_d3_extsearch->getValue('blExtSearch_dontShowFilterArticleCount') && $vendor->getFieldData('counter')}]([{$vendor->getFieldData('counter')}])[{/if}]
                        </label>
                    </div>
                [{/foreach}]

                [{block name="d3_inc_ext_search__filter_vendor_multibuttons"}]
                    [{include file="@d3_extsearch/filterelements/inc/d3_ext_search_filter_inc_multibuttons.tpl" type="vendor"}]
                [{/block}]
            </div>
        [{/block}]
    [{/if}]

    [{block name="d3_inc_ext_search__filter_vendor_multiselector"}]
        [{if $sVendorFilterDisplayType == 'combined'}]
            <div id="d3searchvendor__multiselector" class="filterselector [{if false == $blShowMultipleSelector}]filterselector_hidden[{/if}]">
                <input type="checkbox" name="d3searchvendormultiselector" id="d3searchvendormultiselector" onclick="toggleMultiVendor(this.checked);">
                <label for="d3searchvendormultiselector">
                    [{assign var="vendortranslation" value="VENDOR"|oxmultilangassign}]
                    [{$oView->d3GetMultipleSelectionTranslation($vendortranslation)}]
                </label>
            </div>

            [{capture name="d3JsFnc"}][{strip}]
                function toggleMultiVendor(blChecked) {
                    if (blChecked) {
                        document.getElementById('d3searchvendor__multi').style.display = 'block';
                        document.getElementById('searchvendor').style.display = 'none';
                        if (buttonElement = document.getElementById('searchvendorsubmit')) {
                            buttonElement.style.display = 'none';
                        }
                        document.getElementById('d3searchvendor__multiselector').style.display = 'none';
                    }
                }
            [{/strip}][{/capture}]
            [{oxscript add=$smarty.capture.d3JsFnc}]

            [{if $oView->d3VendorFilterUseMultipleValues()}]
                [{capture name="d3JsFnc"}][{strip}]
                    toggleMultiVendor(true);
                    document.getElementById('d3searchvendormultiselector').checked = 'checked';
                [{/strip}][{/capture}]
                [{oxscript add=$smarty.capture.d3JsFnc}]
            [{/if}]
        [{elseif $sVendorFilterDisplayType == 'single'}]
            <input type="hidden" value="" name="d3searchvendormultiselector" id="d3searchvendormultiselector">
        [{elseif $sVendorFilterDisplayType == 'multi'}]
            <input type="hidden" value="on" name="d3searchvendormultiselector" id="d3searchvendormultiselector">
        [{/if}]
    [{/block}]
</div>
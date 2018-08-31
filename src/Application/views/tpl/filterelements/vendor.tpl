[{assign var="sIdKey" value="vendor"}]
[{assign var="blShowMultipleSelector" value=true}]
<div class="item vendor [{$cssclass}]">
    <label for="searchvendor">
        [{oxmultilang ident="D3_EXTSEARCH_EXT_VENDORS"}]
    </label><br>

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
                        <OPTION value="[{$vendor->getId()}]">[{$vendor->oxvendor__oxtitle->getRawValue()}][{if $vendor->getFieldData('counter')}] ([{$vendor->getFieldData('counter')}])[{/if}]</OPTION>
                    [{/foreach}]
                [{/if}]
            </SELECT>
        [{/block}]
    [{/if}]

    [{if in_array($sVendorFilterDisplayType, array('combined', 'multi'))}]
        [{block name="d3_inc_ext_search__filter_vendor_multi"}]
            <div id="d3searchvendor__multi" style="[{if $sVendorFilterDisplayType == 'combined'}]display: none;[{/if}]">
                [{foreach from=$oView->d3getVendorList() name=attrvalues key=valuekey item=oAttrValue}]
                    <input name="d3searchvendormulti[[{$oAttrValue->getId()}]]" type="hidden" value="">
                    <input name="d3searchvendormulti[[{$oAttrValue->getId()}]]" type="checkbox" value="[{$oAttrValue->getId()}]" id="cb[{$key}][{$oAttrValue->getId()}]" [{if $oAttrValue->selected || $oAttrValue->getId() == $sSelectedVendorId}] checked[{/if}]>
                    <label for="cb[{$key}][{$oAttrValue->getId()}]">
                        [{$oAttrValue->getTitle()}] [{if $oAttrValue->getFieldData('counter')}]([{$oAttrValue->getFieldData('counter')}])[{/if}]
                    </label><br>
                [{/foreach}]
                <button type="submit" class="submitButton largeButton" onclick="d3_extsearch_popup.popup.load();">[{oxmultilang ident="D3_EXTSEARCH_EXT_ASSIGNFILTER"}]</button>

                <button id="d3searchvendor__multiclear__[{$sIdKey}]" type="submit" class="submitButton largeButton" onclick="d3_extsearch_popup.popup.load();">[{oxmultilang ident="D3_EXTSEARCH_EXT_UNASSIGNFILTER"}]</button>

                [{capture name="d3JsFnc"}][{strip}]
                    $('#d3searchvendor__multiclear__[{$sIdKey}]').click(function(){
                        $(this).parent().children('input:checkbox').each(function() {
                            $(this).removeAttr('checked');
                        });
                    });
                [{/strip}][{/capture}]
                [{oxscript add=$smarty.capture.d3JsFnc}]
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
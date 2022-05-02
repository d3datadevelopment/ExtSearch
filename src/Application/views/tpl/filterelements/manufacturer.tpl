[{assign var="sIdKey" value="manufacturer"}]
[{assign var="blShowMultipleSelector" value=true}]
<div class="item manufacturer [{$cssclass}]" id="atid_manufacturer">
    [{block name="d3_inc_ext_search__filter_manufacturer_title"}]
        <label for="searchmanufacturer">
            [{oxmultilang ident="D3_EXTSEARCH_EXT_MANUFACTURERS"}]
        </label><br>
    [{/block}]

    [{if in_array($sManufacturerFilterDisplayType, array('combined', 'single'))}]
        [{block name="d3_inc_ext_search__filter_manufacturer_single"}]
            <SELECT id="searchmanufacturer" name="searchmanufacturer" onchange="d3_extsearch_popup.popup.load(); this.form.submit();">
                [{if $sSelectedManufacturerId}]
                    [{assign var="blShowMultipleSelector" value=false}]
                    <OPTION class="desc" value="">[{oxmultilang ident="D3_EXTSEARCH_EXT_SEARCHINMANUFACTURERS"}]</OPTION>
                    <OPTION value="[{$sSelectedManufacturerId}]" selected="selected">[{$sSelectedManufacturer}]</OPTION>
                [{else}]
                    <OPTION class="desc" value="" selected="selected">[{oxmultilang ident="D3_EXTSEARCH_EXT_CHOOSEMANUFACTURER"}]</OPTION>
                    [{foreach from=$oView->d3getManufacturerList() item="manufacturer"}]
                        <OPTION value="[{$manufacturer->getId()}]">[{$manufacturer->oxmanufacturers__oxtitle->getRawValue()}]
                            [{if !$oModCfg_d3_extsearch->getValue('blExtSearch_dontShowFilterArticleCount') && $manufacturer->getFieldData('counter')}]
                                ([{$manufacturer->getFieldData('counter')}])
                            [{/if}]
                        </OPTION>
                    [{/foreach}]
                [{/if}]
            </SELECT>

            <noscript>
                <div id="searchmanufacturersubmit" class="fullitem">
                    <button type="submit" class="submitButton largeButton btn [{if $oModCfg_d3_extsearch->isThemeIdMappedTo('flow')}]btn-primary [{* for Bootstrap 3 *}][{else}]btn-outline-primary [{* for Bootstrap 4 *}][{/if}] btn-sm" onclick="d3_extsearch_popup.popup.load();">[{oxmultilang ident="D3_EXTSEARCH_EXT_ASSIGNFILTER"}]</button>
                </div>
            </noscript>
        [{/block}]
    [{/if}]

    [{if in_array($sManufacturerFilterDisplayType, array('combined', 'multi'))}]
        [{block name="d3_inc_ext_search__filter_manufacturer_multi"}]
            <div class="multiselect" id="d3searchmanufacturer__multi" style="[{if $sManufacturerFilterDisplayType == 'combined'}]display: none;[{/if}]">
                [{foreach from=$oView->d3getManufacturerList() name=attrvalues key=valuekey item=oAttrValue}]
                    <div class="multiselectvalue" id="d3searchmanufacturer__multi__[{$valuekey}]">
                        <input name="d3searchmanufacturermulti[[{$oAttrValue->getId()}]]" type="hidden" value="">
                        <input name="d3searchmanufacturermulti[[{$oAttrValue->getId()}]]" type="checkbox" value="[{$oAttrValue->getId()}]" id="cb[{$key}][{$oAttrValue->getId()}]" [{if $oAttrValue->selected || $oAttrValue->getId() == $sSelectedManufacturerId}] checked[{/if}]>
                        <label for="cb[{$key}][{$oAttrValue->getId()}]">
                            [{$oAttrValue->getTitle()}] [{if !$oModCfg_d3_extsearch->getValue('blExtSearch_dontShowFilterArticleCount') && $manufacturer->getFieldData('counter')}]([{$oAttrValue->getFieldData('counter')}])[{/if}]
                        </label>
                    </div>
                [{/foreach}]

                [{block name="d3_inc_ext_search__filter_manufacturer_multibuttons"}]
                    [{include file="d3_ext_search_filter_inc_multibuttons.tpl" type="manufacturer"}]
                [{/block}]
            </div>
        [{/block}]
    [{/if}]

    [{block name="d3_inc_ext_search__filter_manufacturer_multiselector"}]
        [{if $sManufacturerFilterDisplayType == 'combined'}]
            <div id="d3searchmanufacturer__multiselector" class="filterselector [{if false == $blShowMultipleSelector}]filterselector_hidden[{/if}]">
                <input type="checkbox" name="d3searchmanufacturermultiselector" id="d3searchmanufacturermultiselector" onclick="toggleMultiManufacturer(this.checked);">
                <label for="d3searchmanufacturermultiselector">
                    [{assign var="manufacturertranslation" value="MANUFACTURERS"|oxmultilangassign}]
                    [{$oView->d3GetMultipleSelectionTranslation($manufacturertranslation)}]
                </label>
            </div>

            [{capture name="d3JsFnc"}][{strip}]
                function toggleMultiManufacturer(blChecked) {
                    if (blChecked) {
                        document.getElementById('d3searchmanufacturer__multi').style.display = 'block';
                        document.getElementById('searchmanufacturer').style.display = 'none';
                        if (buttonElement = document.getElementById('searchmanufacturersubmit')) {
                            buttonElement.style.display = 'none';
                        }
                        document.getElementById('d3searchmanufacturer__multiselector').style.display = 'none';
                    }
                }
            [{/strip}][{/capture}]
            [{oxscript add=$smarty.capture.d3JsFnc}]

            [{if $oView->d3ManufacturerFilterUseMultipleValues()}]
                [{capture name="d3JsFnc"}][{strip}]
                    toggleMultiManufacturer(true);
                    document.getElementById('d3searchmanufacturermultiselector').checked = 'checked';
                [{/strip}][{/capture}]
                [{oxscript add=$smarty.capture.d3JsFnc}]
            [{/if}]
        [{elseif $sManufacturerFilterDisplayType == 'single'}]
            <input type="hidden" value="" name="d3searchmanufacturermultiselector" id="d3searchmanufacturermultiselector">
        [{elseif $sManufacturerFilterDisplayType == 'multi'}]
            <input type="hidden" value="on" name="d3searchmanufacturermultiselector" id="d3searchmanufacturermultiselector">
        [{/if}]
    [{/block}]
</div>
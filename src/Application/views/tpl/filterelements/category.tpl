[{assign var="sIdKey" value="category"}]
[{assign var="blShowMultipleSelector" value=true}]
<div class="item category [{$cssclass}]">
    <label for="searchcategory">
        [{oxmultilang ident="D3_EXTSEARCH_EXT_CATEGORIES"}]
    </label><br>

    [{if in_array($sCategoryFilterDisplayType, array('combined', 'single'))}]
        [{block name="d3_inc_ext_search__filter_category_single"}]
            <SELECT id="searchcategory" name="searchcnid" onchange="d3_extsearch_popup.popup.load(); this.form.submit();">
                [{if $sSelectedCategoryId}]
                    [{assign var="blShowMultipleSelector" value=false}]
                    <OPTION class="desc" value="">[{oxmultilang ident="D3_EXTSEARCH_EXT_SEARCHINCATEGORIES"}]</OPTION>
                    <OPTION value="[{$sSelectedCategoryId}]" selected="selected">[{$sSelectedCategory}]</OPTION>
                [{else}]
                    <OPTION class="desc" value="" selected="selected">[{oxmultilang ident="D3_EXTSEARCH_EXT_CHOOSECAT"}]</OPTION>
                    [{foreach from=$oView->d3getCategoryList() item="category"}]
                        <OPTION value="[{$category->getId()}]">[{$category->oxcategories__oxtitle->getRawValue()}][{if $category->getFieldData('counter')}] ([{$category->getFieldData('counter')}])[{/if}]</OPTION>
                    [{/foreach}]
                [{/if}]
            </SELECT>
        [{/block}]
    [{/if}]

    [{if in_array($sCategoryFilterDisplayType, array('combined', 'multi'))}]
        [{block name="d3_inc_ext_search__filter_category_multi"}]
            <div id="d3searchcategory__multi" style="[{if $sCategoryFilterDisplayType == 'combined'}]display: none;[{/if}]">
                [{foreach from=$oView->d3getCategoryList() name=attrvalues key=valuekey item=oAttrValue}]
                    <input name="d3searchcategorymulti[[{$oAttrValue->getId()}]]" type="hidden" value="">
                    <input name="d3searchcategorymulti[[{$oAttrValue->getId()}]]" type="checkbox" value="[{$oAttrValue->getId()}]" id="cb[{$key}][{$oAttrValue->getId()}]" [{if $oAttrValue->selected || $oAttrValue->getId() == $sSelectedCategoryId}] checked[{/if}]>
                    <label for="cb[{$key}][{$oAttrValue->getId()}]">
                        [{$oAttrValue->getTitle()}] [{if $oAttrValue->getFieldData('counter')}]([{$oAttrValue->getFieldData('counter')}])[{/if}]
                    </label><br>
                [{/foreach}]

                [{include file="d3_ext_search_filter_inc_multibuttons.tpl" type="category"}]
            </div>
        [{/block}]
    [{/if}]

    [{block name="d3_inc_ext_search__filter_category_multiselector"}]
        [{if $sCategoryFilterDisplayType == 'combined'}]
            <div id="d3searchcategory__multiselector" class="filterselector [{if false == $blShowMultipleSelector}]filterselector_hidden[{/if}]">
                <input type="checkbox" name="d3searchcategorymultiselector" id="d3searchcategorymultiselector" onclick="toggleMultiCategory(this.checked);">
                <label for="d3searchcategorymultiselector">
                    [{assign var="categorytranslation" value="CATEGORY"|oxmultilangassign}]
                    [{$oView->d3GetMultipleSelectionTranslation($categorytranslation)}]
                </label>
            </div>

            [{capture name="d3JsFnc"}][{strip}]
                function toggleMultiCategory(blChecked) {
                    if (blChecked) {
                        document.getElementById('d3searchcategory__multi').style.display = 'block';
                        document.getElementById('searchcategory').style.display = 'none';
                        document.getElementById('d3searchcategory__multiselector').style.display = 'none';
                    }
                }
            [{/strip}][{/capture}]
            [{oxscript add=$smarty.capture.d3JsFnc}]

            [{if $oView->d3CategoryFilterUseMultipleValues()}]
                [{capture name="d3JsFnc"}][{strip}]
                    toggleMultiCategory(true);
                    document.getElementById('d3searchcategorymultiselector').checked = 'checked';
                [{/strip}][{/capture}]
                [{oxscript add=$smarty.capture.d3JsFnc}]
            [{/if}]
        [{elseif $sCategoryFilterDisplayType == 'single'}]
            <input type="hidden" value="" name="d3searchcategorymultiselector" id="d3searchcategorymultiselector">
        [{elseif $sCategoryFilterDisplayType == 'multi'}]
            <input type="hidden" value="on" name="d3searchcategorymultiselector" id="d3searchcategorymultiselector">
        [{/if}]
    [{/block}]
</div>
[{include file="headitem.tpl" title="d3tbclextsearch_settings_navigation"|oxmultilangassign}]

<style type="text/css">
    .ext_edittext {
        padding: 2px;
    }
</style>

<script type="text/javascript">
    <!--
    [{if $updatelist == 1}]
        UpdateList('[{$oxid}]');
    [{/if}]

    function UpdateList( sID)
    {
        var oSearch = parent.list.document.getElementById("search");
        oSearch.oxid.value=sID;
        oSearch.fnc.value='';
        oSearch.submit();
    }

    function EditThis( sID)
    {
        var oTransfer = document.getElementById("transfer");
        oTransfer.oxid.value=sID;
        oTransfer.cl.value='';
        oTransfer.submit();

        var oSearch = parent.list.document.getElementById("search");
        oSearch.actedit.value = 0;
        oSearch.oxid.value=sID;
        oSearch.submit();
    }

    function _groupExp(el) {
        var _cur = el.parentNode;

        if (_cur.className == "exp") _cur.className = "";
          else _cur.className = "exp";
    }
    -->
</script>

<style type="text/css">
    <!--
    fieldset {
        border:           1px inset black;
        background-color: #F0F0F0;
    }

    legend {
        font-weight: bold;
    }

    .groupExp dl dt {
        font-weight:  normal;
        width:        55%;
        padding-left: 10px;
        padding-top:  10px;
    }

    label.disabled {
        color: gray;
    }

    .edittext select.editinput {
        width: auto;
    }
    -->
</style>

[{if $readonly}]
    [{assign var="readonly" value="readonly disabled"}]
[{else}]
    [{assign var="readonly" value=""}]
[{/if}]

<form name="transfer" id="transfer" action="[{$oViewConf->getSelfLink()}]" method="post">
    [{$oViewConf->getHiddenSid()}]
    <input type="hidden" name="oxid" value="[{$oxid}]">
    <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
    <input type="hidden" name="actshop" value="[{$actshopobj->getId()}]">
    <input type="hidden" name="editlanguage" value="[{$editlanguage}]">
</form>

<form name="myedit" id="myedit" action="[{$oViewConf->getSelfLink()}]" method="post">
    [{$oViewConf->getHiddenSid()}]
    <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
    <input type="hidden" name="fnc" value="save">
    <input type="hidden" name="oxid" value="[{$oxid}]">
    <input type="hidden" name="editval[oxid]" value="[{$oxid}]">

[{if $oView->getValueStatus() == 'error'}]
    <table border="0" style="width: 98%;">
        <tr>
            <td style="vertical-align: top;" class="edittext">
                <b>[{oxmultilang ident="D3_EXTSEARCH_MAIN_NOCONFIG_DESC"}]</b><br>
                <input type="submit" value="[{oxmultilang ident="D3_EXTSEARCH_MAIN_NOCONFIG_BTN"}]">
            </td>
        </tr>
    </table>
[{else}]
    <table border="0" style="width: 98%;">
        <tr>
            <td style="vertical-align: top;" class="edittext">
                [{block name="d3_cfg_extsearch_navigation__form"}]
                    <div class="groupExp">
                        <div class="">
                            [{block name="d3_cfg_extsearch_navigation__main"}]
                                <a class="rc" onclick="_groupExp(this); return false;" href="#">
                                    <b>
                                        [{oxmultilang ident="D3_EXTSEARCH_NAVI_MAINSETTINGS"}]
                                    </b>
                                </a>
                                <dl>
                                    <dt>
                                        <label for="emptysearch">[{oxmultilang ident="D3_EXTSEARCH_NAVI_EMPTYSEARCH"}]</label>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="value[blExtSearch_emptySearch]" value="0">
                                        <input id="emptysearch" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_emptySearch]" value='1' [{if $edit->getEditValue('blExtSearch_emptySearch') == 1}]checked[{/if}]>
                                        [{oxinputhelp ident="D3_EXTSEARCH_NAVI_EMPTYSEARCH_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                                <dl>
                                    <dt>
                                        <label for="showHighlightedText">[{oxmultilang ident="D3_EXTSEARCH_NAVI_HIGHLIGHT"}]</label>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="value[blExtSearch_showHighlightedText]" value="0">
                                        <input id="showHighlightedText" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_showHighlightedText]" value='1' [{if $edit->getEditValue('blExtSearch_showHighlightedText') == 1}]checked[{/if}]>
                                        [{oxinputhelp ident="D3_EXTSEARCH_NAVI_HIGHLIGHT_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>

                                [{if $oView->d3UseAlistFilters()}]
                                    [{assign var="blActionRestriction" value=""}]
                                [{else}]
                                    [{assign var="blActionRestriction" value="readonly disabled"}]
                                    [{assign var="blRestricted" value=true}]
                                [{/if}]
                                <dl>
                                    <dt>
                                        <label for="alistfilter" class="[{$blActionRestriction}]">[{oxmultilang ident="D3_EXTSEARCH_NAVI_ALISTFILTER"}]</label>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="value[blExtSearch_useAListFilter]" value="0" [{$blActionRestriction}]>
                                        <input id="alistfilter" class="edittext ext_edittext" type="checkbox" [{$blActionRestriction}] name="value[blExtSearch_useAListFilter]" value='1' [{if !$blRestricted && $edit->getEditValue('blExtSearch_useAListFilter') == 1}]checked[{/if}]>
                                        [{oxinputhelp ident="D3_EXTSEARCH_NAVI_ALISTFILTER_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                            [{/block}]
                        </div>
                    </div>

                    <div class="groupExp">
                        <div class="">
                            [{block name="d3_cfg_extsearch_navigation__catfilter"}]
                                <a class="rc" onclick="_groupExp(this); return false;" href="#">
                                    <b>
                                        [{oxmultilang ident="D3_EXTSEARCH_NAVI_CATFILTER"}]
                                    </b>
                                </a>
                                <dl>
                                    <dt>
                                        <label for="showCatList">[{oxmultilang ident="D3_EXTSEARCH_NAVI_CATLIST"}]</label>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="value[blExtSearch_showCatList]" value="0">
                                        <input id="showCatList" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_showCatList]" value='1' [{if $edit->getEditValue('blExtSearch_showCatList') == 1}]checked[{/if}]>
                                        [{oxinputhelp ident="D3_EXTSEARCH_NAVI_CATLIST_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                                <dl>
                                    <dt>
                                        <label for="orderCatList">[{oxmultilang ident="D3_EXTSEARCH_NAVI_CATLIST_SORT"}]</label>
                                    </dt>
                                    <dd>
                                        <select id="orderCatList" class="editinput" name="value[sExtSearch_orderCatList]" size="1">
                                            <option value="counter"[{if $edit->getEditValue('sExtSearch_orderCatList') == 'counter'}] selected[{/if}]>[{oxmultilang ident="D3_EXTSEARCH_NAVI_CATLIST_SORT_COUNT"}]</option>
                                            <option value="oxorder"[{if $edit->getEditValue('sExtSearch_orderCatList') == 'oxorder'}] selected[{/if}]>[{oxmultilang ident="D3_EXTSEARCH_NAVI_CATLIST_SORT_DATA"}]</option>
                                        </select>
                                        [{oxinputhelp ident="D3_EXTSEARCH_NAVI_CATLIST_SORT_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                            [{/block}]
                        </div>
                    </div>

                    <div class="groupExp">
                        <div class="">
                            [{block name="d3_cfg_extsearch_navigation__vendorfilter"}]
                                <a class="rc" onclick="_groupExp(this); return false;" href="#">
                                    <b>
                                        [{oxmultilang ident="D3_EXTSEARCH_NAVI_VENDORFILTER"}]
                                    </b>
                                </a>
                                <dl>
                                    <dt>
                                        <label for="showVendorList">[{oxmultilang ident="D3_EXTSEARCH_NAVI_VENDORLIST"}]</label>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="value[blExtSearch_showVendorList]" value="0">
                                        <input id="showVendorList" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_showVendorList]" value='1' [{if $edit->getEditValue('blExtSearch_showVendorList') == 1}]checked[{/if}]>
                                        [{oxinputhelp ident="D3_EXTSEARCH_NAVI_VENDORLIST_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                                <dl>
                                    <dt>
                                        <label for="orderVendorList">[{oxmultilang ident="D3_EXTSEARCH_NAVI_VENDORLIST_SORT"}]</label>
                                    </dt>
                                    <dd>
                                        <select id="orderVendorList" class="editinput" name="value[sExtSearch_orderVendorList]" size="1">
                                            <option value="counter"[{if $edit->getEditValue('sExtSearch_orderVendorList') == 'counter'}] selected[{/if}]>[{oxmultilang ident="D3_EXTSEARCH_NAVI_VENDORLIST_SORT_COUNT"}]</option>
                                            <option value="oxtitle"[{if $edit->getEditValue('sExtSearch_orderVendorList') == 'oxtitle'}] selected[{/if}]>[{oxmultilang ident="D3_EXTSEARCH_NAVI_VENDORLIST_SORT_ALPHA"}]</option>
                                        </select>
                                        [{oxinputhelp ident="D3_EXTSEARCH_NAVI_VENDORLIST_SORT_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                            [{/block}]
                        </div>
                    </div>

                    <div class="groupExp">
                        <div class="">
                            [{block name="d3_cfg_extsearch_navigation__manufacturerfilter"}]
                                <a class="rc" onclick="_groupExp(this); return false;" href="#">
                                    <b>
                                        [{oxmultilang ident="D3_EXTSEARCH_NAVI_MANUFACTURERFILTER"}]
                                    </b>
                                </a>
                                <dl>
                                    <dt>
                                        <label for="showManufacturerList">[{oxmultilang ident="D3_EXTSEARCH_NAVI_MANUFACTURERLIST"}]</label>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="value[blExtSearch_showManufacturerList]" value="0">
                                        <input id="showManufacturerList" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_showManufacturerList]" value='1' [{if $edit->getEditValue('blExtSearch_showManufacturerList') == 1}]checked[{/if}]>
                                        [{oxinputhelp ident="D3_EXTSEARCH_NAVI_MANUFACTURERLIST_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                                <dl>
                                    <dt>
                                        <label for="orderManufacturerList">[{oxmultilang ident="D3_EXTSEARCH_NAVI_MANUFACTURERLIST_SORT"}]</label>
                                    </dt>
                                    <dd>
                                        <select id="orderManufacturerList" class="editinput" name="value[sExtSearch_orderManufacturerList]" size="1">
                                            <option value="counter"[{if $edit->getEditValue('sExtSearch_orderManufacturerList') == 'counter'}] selected[{/if}]>[{oxmultilang ident="D3_EXTSEARCH_NAVI_MANUFACTURERLIST_SORT_COUNT"}]</option>
                                            <option value="oxtitle"[{if $edit->getEditValue('sExtSearch_orderManufacturerList') == 'oxtitle'}] selected[{/if}]>[{oxmultilang ident="D3_EXTSEARCH_NAVI_MANUFACTURERLIST_SORT_ALPHA"}]</option>
                                        </select>
                                        [{oxinputhelp ident="D3_EXTSEARCH_NAVI_MANUFACTURERLIST_SORT_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                            [{/block}]
                        </div>
                    </div>

                    <div class="groupExp">
                        <div class="">
                            [{block name="d3_cfg_extsearch_navigation__attributefilter"}]
                                <a class="rc" onclick="_groupExp(this); return false;" href="#">
                                    <b>
                                        [{oxmultilang ident="D3_EXTSEARCH_NAVI_ATTRIBUTEFILTER"}]
                                    </b>
                                </a>
                                <dl>
                                    <dt>
                                        <label for="showAttributeList">[{oxmultilang ident="D3_EXTSEARCH_NAVI_ATTRIBUTELIST"}]</label>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="value[blExtSearch_showAttributeList]" value="0">
                                        <input id="showAttributeList" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_showAttributeList]" value='1' [{if $edit->getEditValue('blExtSearch_showAttributeList') == 1}]checked[{/if}]>
                                        [{oxinputhelp ident="D3_EXTSEARCH_NAVI_ATTRIBUTELIST_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                                <dl>
                                    <dt>
                                        <label for="useAttributeCombineOr">[{oxmultilang ident="D3_EXTSEARCH_NAVI_ATTRIBUTES_COMBINE"}]</label>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="value[blExtSearch_useAttributeCombineOr]" value="0">
                                        <input id="useAttributeCombineOr" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_useAttributeCombineOr]" value='1' [{if $edit->getEditValue('blExtSearch_useAttributeCombineOr') == 1}]checked[{/if}]>
                                        [{oxinputhelp ident="D3_EXTSEARCH_NAVI_ATTRIBUTES_COMBINE_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                                <dl>
                                    <dt>
                                        <label for="orderAttributes">[{oxmultilang ident="D3_EXTSEARCH_NAVI_ATTRIBUTES_SORT"}]</label>
                                    </dt>
                                    <dd>
                                        <select id="orderAttributes" class="editinput" name="value[sExtSearch_orderAttributes]" size="1">
                                            <option value="oxpos"[{if $edit->getEditValue('sExtSearch_orderAttributes') == 'oxpos'}] selected[{/if}]>[{oxmultilang ident="D3_EXTSEARCH_NAVI_ATTRIBUTES_SORT_POS"}]</option>
                                            <option value="title"[{if $edit->getEditValue('sExtSearch_orderAttributes') == 'title'}] selected[{/if}]>[{oxmultilang ident="D3_EXTSEARCH_NAVI_ATTRIBUTES_SORT_TITLE"}]</option>
                                        </select>
                                        [{oxinputhelp ident="D3_EXTSEARCH_NAVI_ATTRIBUTES_SORT_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                                <dl>
                                    <dt>
                                        <label for="useAttributeValueCombineAnd">[{oxmultilang ident="D3_EXTSEARCH_NAVI_ATTRIBUTEVALUES_COMBINE"}]</label>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="value[blExtSearch_useAttributeValueCombineAnd]" value="0">
                                        <input id="useAttributeValueCombineAnd" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_useAttributeValueCombineAnd]" value='1' [{if $edit->getEditValue('blExtSearch_useAttributeValueCombineAnd') == 1}]checked[{/if}]>
                                        [{oxinputhelp ident="D3_EXTSEARCH_NAVI_ATTRIBUTEVALUES_COMBINE_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                                <dl>
                                    <dt>
                                        <label for="orderAttributeList">[{oxmultilang ident="D3_EXTSEARCH_NAVI_ATTRIBUTELIST_SORT"}]</label>
                                    </dt>
                                    <dd>
                                        <select id="orderAttributeList" class="editinput" name="value[sExtSearch_orderAttributeList]" size="1">
                                            <option value="counter"[{if $edit->getEditValue('sExtSearch_orderAttributeList') == 'counter'}] selected[{/if}]>[{oxmultilang ident="D3_EXTSEARCH_NAVI_ATTRIBUTELIST_SORT_COUNT"}]</option>
                                            <option value="oxpos"[{if $edit->getEditValue('sExtSearch_orderAttributeList') == 'oxpos'}] selected[{/if}]>[{oxmultilang ident="D3_EXTSEARCH_NAVI_ATTRIBUTELIST_SORT_POS"}]</option>
                                        </select>
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                                <dl>
                                    <dt>
                                        <label for="showNoAssignedAttributeArticles">[{oxmultilang ident="D3_EXTSEARCH_NAVI_NOATTRIBUTEARTS"}]</label>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="value[blExtSearch_showNoAssignedAttributeArticles]" value="0">
                                        <input id="showNoAssignedAttributeArticles" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_showNoAssignedAttributeArticles]" value='1' [{if $edit->getEditValue('blExtSearch_showNoAssignedAttributeArticles') == 1}]checked[{/if}]>
                                        [{oxinputhelp ident="D3_EXTSEARCH_NAVI_NOATTRIBUTEARTS_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                                <dl>
                                    <dt>
                                        <label for="showNotSelectableAttributes">[{oxmultilang ident="D3_EXTSEARCH_NAVI_SHOWNOTSELECTABLEATTRIBUTES"}]</label>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="value[blExtSearch_showNotSelectableAttributes]" value="0">
                                        <input id="showNotSelectableAttributes" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_showNotSelectableAttributes]" value='1' [{if $edit->getEditValue('blExtSearch_showNotSelectableAttributes') == 1}]checked[{/if}]>
                                        [{oxinputhelp ident="D3_EXTSEARCH_NAVI_SHOWNOTSELECTABLEATTRIBUTES_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                            [{/block}]
                        </div>
                    </div>

                    <div class="groupExp">
                        <div class="">
                            [{block name="d3_cfg_extsearch_navigation__pricefilter"}]
                                <a class="rc" onclick="_groupExp(this); return false;" href="#">
                                    <b>
                                        [{oxmultilang ident="D3_EXTSEARCH_NAVI_PRICEFILTER"}]
                                    </b>
                                </a>
                                <dl>
                                    <dt>
                                        <label for="showPriceSelector">[{oxmultilang ident="D3_EXTSEARCH_NAVI_PRICELIST"}]</label>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="value[blExtSearch_showPriceSelector]" value="0">
                                        <input id="showPriceSelector" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_showPriceSelector]" value='1' [{if $edit->getEditValue('blExtSearch_showPriceSelector') == 1}]checked[{/if}]>
                                        [{oxinputhelp ident="D3_EXTSEARCH_NAVI_PRICELIST_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                                <dl>
                                    <dt>
                                        <label for="priceSelectorItems">[{oxmultilang ident="D3_EXTSEARCH_NAVI_PRICELIST_ITEMS"}]</label>
                                    </dt>
                                    <dd>
                                        <input id="priceSelectorItems" type="text" class="editinput" size="8" maxlength="2" name="value[iExtSearch_priceSelectorItems]" value="[{if $edit->getEditValue('iExtSearch_priceSelectorItems')}][{$edit->getEditValue('iExtSearch_priceSelectorItems')}][{else}]5[{/if}]">
                                        [{oxinputhelp ident="D3_EXTSEARCH_NAVI_PRICELIST_ITEMS_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                                <dl>
                                    <dt>
                                        <label for="PriceSelectorsRounded">[{oxmultilang ident="D3_EXTSEARCH_NAVI_PRICELIST_ROUNDED"}]</label>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="value[blExtSearch_PriceSelectorsRounded]" value="0">
                                        <input id="PriceSelectorsRounded" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_PriceSelectorsRounded]" value='1' [{if $edit->getEditValue('blExtSearch_PriceSelectorsRounded') == 1}]checked[{/if}]>
                                        [{oxinputhelp ident="D3_EXTSEARCH_NAVI_PRICELIST_ROUNDED_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                                <dl>
                                    <dt>
                                        <label for="PriceSelectorsDispType">[{oxmultilang ident="D3_EXTSEARCH_NAVI_PRICELIST_DISPLAY"}]</label>
                                    </dt>
                                    <dd>
                                        <select id="PriceSelectorsDispType" class="editinput" name="value[sExtSearch_PriceSelectorsDispType]" size="1">
                                            <option value="dropdown"[{if $edit->getEditValue('sExtSearch_PriceSelectorsDispType') == 'dropdown'}] selected[{/if}]>[{oxmultilang ident="D3_EXTSEARCH_NAVI_PRICELIST_DISPLAY_LISTTYPE"}]</option>
                                            <option value="jqslider"[{if $edit->getEditValue('sExtSearch_PriceSelectorsDispType') == 'jqslider'}] selected[{/if}]>[{oxmultilang ident="D3_EXTSEARCH_NAVI_PRICELIST_DISPLAY_SLIDER"}]</option>
                                        </select>
                                        [{oxinputhelp ident="D3_EXTSEARCH_NAVI_PRICELIST_DISPLAY_DESC"}]
                                        <br>
                                        <div style="margin: 10px 5px 5px 40px; text-indent: -7px; white-space: normal;">[{oxmultilang ident="D3_EXTSEARCH_NAVI_PRICELIST_REQU"}]</div>
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                            [{/block}]
                        </div>
                    </div>

                    <div class="groupExp">
                        <div class="">
                            [{block name="d3_cfg_extsearch_navigation__indexfilter"}]
                                <a class="rc" onclick="_groupExp(this); return false;" href="#">
                                    <b>
                                        [{oxmultilang ident="D3_EXTSEARCH_NAVI_INDEXFILTER"}]
                                    </b>
                                </a>
                                <dl>
                                    <dt>
                                        <label for="showFilterParam">[{oxmultilang ident="D3_EXTSEARCH_NAVI_SHOWINDEX"}]</label>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="value[blExtSearch_showFilterParam]" value="0">
                                        <input id="showFilterParam" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_showFilterParam]" value='1' [{if $edit->getEditValue('blExtSearch_showFilterParam') == 1}]checked[{/if}]>
                                        [{oxinputhelp ident="D3_EXTSEARCH_NAVI_SHOWINDEX_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                                <dl>
                                    <dt>
                                        <label for="filterParamField">[{oxmultilang ident="D3_EXTSEARCH_NAVI_FILTERFIELDNAME"}]</label>
                                    </dt>
                                    <dd>
                                        <input id="filterParamField" type="text" class="editinput" size="10" maxlength="50" name="value[sExtSearch_filterParamField]" value="[{if $edit->getEditValue('sExtSearch_filterParamField')}][{$edit->getEditValue('sExtSearch_filterParamField')}][{else}]oxtitle[{/if}]">
                                        [{oxinputhelp ident="D3_EXTSEARCH_NAVI_FILTERFIELDNAME_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                            [{/block}]
                        </div>
                    </div>

                    <div class="groupExp">
                        <div class="">
                            [{block name="d3_cfg_extsearch_navigation__ownformfilter"}]
                                <a class="rc" onclick="_groupExp(this); return false;" href="#">
                                    <b>
                                        [{oxmultilang ident="D3_EXTSEARCH_NAVI_OWNFORMFIELDS"}]
                                    </b>
                                </a>
                                <dl>
                                    <dt>
                                        <label for="ownFormFields">[{oxmultilang ident="D3_EXTSEARCH_MAIN_OWNFORMFIELDS"}]</label>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="value[blExtSearch_ownFormFields]" value="0">
                                        <input id="ownFormFields" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_ownFormFields]" value='1' [{if $edit->getEditValue('blExtSearch_ownFormFields') == 1}]checked[{/if}]>
                                        [{oxinputhelp ident="D3_EXTSEARCH_MAIN_OWNFORMFIELDS_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                            [{/block}]
                        </div>
                    </div>
                [{/block}]

                <table style="width:98%;">
                    <tr>
                        <td class="edittext ext_edittext" style="text-align: left;"><br>
                            <span class="d3modcfg_btn icon d3color-green">
                                <button type="submit" name="save">
                                    <i class="fa fa-check-circle fa-inverse"></i>[{oxmultilang ident="D3_EXTSEARCH_NAVI_SAVE"}]
                                </button>
                            </span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
[{/if}]

</form>

[{include file="d3_cfg_mod_inc.tpl"}]

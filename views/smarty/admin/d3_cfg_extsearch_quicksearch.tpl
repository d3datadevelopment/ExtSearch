[{include file="headitem.tpl" title="D3TBCLEXTSEARCH_SETTINGS_QUICK"|oxmultilangassign}]

<script type="text/javascript">
    <!--
    [{if $updatelist == 1}]
        UpdateList('[{$oxid}]');
    [{/if}]

    function UpdateList( sID)
    {
        let oSearch = parent.list.document.getElementById("search");
        oSearch.oxid.value=sID;
        oSearch.fnc.value='';
        oSearch.submit();
    }

    function EditThis( sID)
    {
        let oTransfer = document.getElementById("transfer");
        oTransfer.oxid.value=sID;
        oTransfer.cl.value='';
        oTransfer.submit();

        let oSearch = parent.list.document.getElementById("search");
        oSearch.actedit.value = 0;
        oSearch.oxid.value=sID;
        oSearch.submit();
    }

    function _groupExp(el) {
        let _cur = el.parentNode;

        if (_cur.className === "exp") _cur.className = "";
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
        padding-top: 10px;
    }

    .ext_edittext {
        padding: 2px;
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
    <input type="hidden" name="actshop" value="[{$shop->id}]">
    <input type="hidden" name="editlanguage" value="[{$editlanguage}]">
</form>

<form name="myedit" id="myedit" action="[{$oViewConf->getSelfLink()}]" method="post">
    [{$oViewConf->getHiddenSid()}]
    <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
    <input type="hidden" name="fnc" value="save">
    <input type="hidden" name="oxid" value="[{$oxid}]">
    <input type="hidden" name="editval[oxid]" value="[{$oxid}]">

    [{if $oView->getValueStatus() == 'error'}]
        <b>[{oxmultilang ident="D3_EXTSEARCH_MAIN_NOCONFIG_DESC"}]</b><br>
        <input type="submit" value="[{oxmultilang ident="D3_EXTSEARCH_MAIN_NOCONFIG_BTN"}]" [{$readonly}]>
    [{else}]
        <table style="border: 0; width: 98%;">
            <tr>
                <td style="vertical-align: top;" class="edittext">

                    [{block name="d3_cfg_extsearch_quicksearch__form"}]
                        <div class="groupExp">
                            <div class="">
                                [{block name="d3_cfg_extsearch_navigation__quick"}]
                                    <a class="rc" onclick="_groupExp(this); return false;" href="#">
                                        <b>
                                            [{oxmultilang ident="D3_EXTSEARCH_QUICK"}]
                                        </b>
                                    </a>
                                    <dl>
                                        <dt>
                                            <label for="enableAjaxSearch">[{oxmultilang ident="D3_EXTSEARCH_QUICK_ACTIVE"}]</label>
                                        </dt>
                                        <dd>
                                            <input type="hidden" name="value[blExtSearch_enableAjaxSearch]" value="0">
                                            <input id="enableAjaxSearch" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_enableAjaxSearch]" value='1' [{if $edit->getEditValue('blExtSearch_enableAjaxSearch') == 1}]checked[{/if}] onclick='[{include file="@d3_extsearch/admin/d3_togglegroup_extsearch.tpl" sToggleOptionName="blExtSearch_enableAjaxSearch" sToggleOptionClass=".suggest_options"}]' [{$readonly}]>
                                            [{oxinputhelp ident="D3_EXTSEARCH_QUICK_ACTIVE_DESC"}]
                                        </dd>
                                        <dd class="spacer"></dd>
                                    </dl>
                                    <dl class="suggest_options">
                                        <dt>
                                            <label for="ajaxSearchLoadFullObjects">[{oxmultilang ident="D3_EXTSEARCH_QUICK_FULLOBJECTS"}]</label>
                                        </dt>
                                        <dd>
                                            <input type="hidden" name="value[blExtSearch_ajaxSearchLoadFullObjects]" value="0">
                                            <input id="ajaxSearchLoadFullObjects" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_ajaxSearchLoadFullObjects]" value='1' [{if $edit->getEditValue('blExtSearch_ajaxSearchLoadFullObjects') == 1}]checked[{/if}] [{$readonly}]>
                                            [{oxinputhelp ident="D3_EXTSEARCH_QUICK_FULLOBJECTS_DESC"}]
                                        </dd>
                                        <dd class="spacer"></dd>
                                    </dl>
                                    <dl class="suggest_options">
                                        <dt>
                                            <label for="QuickSearchMaxArticles">[{oxmultilang ident="D3_EXTSEARCH_QUICK_COUNT"}]</label>
                                        </dt>
                                        <dd>
                                            <input id="QuickSearchMaxArticles" size="6" maxlength="5" class="edittext ext_edittext" type="text" name="value[sExtSearch_QuickSearchMaxArticles]" value="[{if $edit->getEditValue('sExtSearch_QuickSearchMaxArticles')}][{$edit->getEditValue('sExtSearch_QuickSearchMaxArticles')}][{else}]200[{/if}]" [{$readonly}]>
                                            [{oxinputhelp ident="D3_EXTSEARCH_QUICK_COUNT_DESC"}]
                                        </dd>
                                        <dd class="spacer"></dd>
                                    </dl>
                                    <dl class="suggest_options">
                                        <dt>
                                            <label for="QuickSearchLoadCategories">[{oxmultilang ident="D3_EXTSEARCH_QUICK_LOADCATEGORIES"}]</label>
                                        </dt>
                                        <dd>
                                            <input type="hidden" name="value[blExtSearch_QuickSearchLoadCategories]" value="0">
                                            <input id="QuickSearchLoadCategories" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_QuickSearchLoadCategories]" value='1' [{if $edit->getEditValue('blExtSearch_QuickSearchLoadCategories') == 1}]checked[{/if}] [{$readonly}]>
                                            [{oxinputhelp ident="D3_EXTSEARCH_QUICK_LOADCATEGORIES_DESC"}]
                                        </dd>
                                        <dd class="spacer"></dd>
                                    </dl>
                                    <dl class="suggest_options">
                                        <dt>
                                            <label for="QuickSearchLoadManufacturers">[{oxmultilang ident="D3_EXTSEARCH_QUICK_LOADMANUFACTURERS"}]</label>
                                        </dt>
                                        <dd>
                                            <input type="hidden" name="value[blExtSearch_QuickSearchLoadManufacturers]" value="0">
                                            <input id="QuickSearchLoadManufacturers" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_QuickSearchLoadManufacturers]" value='1' [{if $edit->getEditValue('blExtSearch_QuickSearchLoadManufacturers') == 1}]checked[{/if}] [{$readonly}]>
                                            [{oxinputhelp ident="D3_EXTSEARCH_QUICK_LOADMANUFACTURERS_DESC"}]
                                        </dd>
                                        <dd class="spacer"></dd>
                                    </dl>
                                    <dl class="suggest_options">
                                        <dt>
                                            <label for="QuickSearchLoadVendors">[{oxmultilang ident="D3_EXTSEARCH_QUICK_LOADVENDORS"}]</label>
                                        </dt>
                                        <dd>
                                            <input type="hidden" name="value[blExtSearch_QuickSearchLoadVendors]" value="0">
                                            <input id="QuickSearchLoadVendors" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_QuickSearchLoadVendors]" value='1' [{if $edit->getEditValue('blExtSearch_QuickSearchLoadVendors') == 1}]checked[{/if}] [{$readonly}]>
                                            [{oxinputhelp ident="D3_EXTSEARCH_QUICK_LOADVENDORS_DESC"}]
                                        </dd>
                                        <dd class="spacer"></dd>
                                    </dl>
                                    <dl class="suggest_options">
                                        <dt>
                                            <label for="QuickSearchLoadContent">[{oxmultilang ident="D3_EXTSEARCH_QUICK_LOADCONTENT"}]</label>
                                        </dt>
                                        <dd>
                                            <input type="hidden" name="value[blExtSearch_QuickSearchLoadContent]" value="0">
                                            <input id="QuickSearchLoadContent" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_QuickSearchLoadContent]" value='1' [{if $edit->getEditValue('blExtSearch_QuickSearchLoadContent') == 1}]checked[{/if}] [{$readonly}]>
                                            [{oxinputhelp ident="D3_EXTSEARCH_QUICK_LOADCONTENT_DESC"}]
                                        </dd>
                                        <dd class="spacer"></dd>
                                    </dl>
                                [{/block}]
                            </div>
                        </div>

                        <div class="groupExp">
                            <div class="">
                                [{block name="d3_cfg_extsearch_navigation__ias"}]
                                    <a class="rc" onclick="_groupExp(this); return false;" href="#">
                                        <b>
                                            [{oxmultilang ident="D3_EXTSEARCH_QUICK_IAS"}]
                                        </b>
                                    </a>
                                    <dl>
                                        <dt>
                                            <label for="ShowIAS">[{oxmultilang ident="D3_EXTSEARCH_QUICK_SHOWIAS"}]</label>
                                        </dt>
                                        <dd>
                                            <input type="hidden" name="value[blExtSearch_ShowIAS]" value="0">
                                            <input id="ShowIAS" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_ShowIAS]" value='1' [{if $edit->getEditValue('blExtSearch_ShowIAS') == 1}]checked[{/if}] [{$readonly}]>
                                            [{oxinputhelp ident="D3_EXTSEARCH_QUICK_SHOWIAS_DESC"}]
                                        </dd>
                                        <dd class="spacer"></dd>
                                    </dl>
                                [{/block}]
                            </div>
                        </div>
                    [{/block}]

                    <table style="width:100%;">
                        <tr>
                            <td class="edittext ext_edittext" style="text-align: left;"><br>
                                <span class="d3modcfg_btn icon d3color-green">
                                    <button type="submit" name="save" [{$readonly}]>
                                        <i class="fa fa-check-circle fa-inverse"></i>[{oxmultilang ident="D3_EXTSEARCH_QUICK_SAVE"}]
                                    </button>
                                </span>
                            </td>
                        </tr>
                    </table>
                <br><br>[{oxmultilang ident="D3_EXTSEARCH_QUICK_TPLNOTICE"}]
            </td>
        </tr>
    </table>
[{/if}]
</form>

[{include file="@d3modcfg_lib/admin/inc/inc.tpl"}]

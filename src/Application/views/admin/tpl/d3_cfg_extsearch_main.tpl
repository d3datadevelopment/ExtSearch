[{include file="headitem.tpl" title="d3tbclextsearch_settings_results"|oxmultilangassign}]

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
        padding-top:  10px;
    }

    .groupExp.highlighted {
        background-color: #CD0210;
    }

    .groupExp.highlighted a.rc b {
        color: white;
    }

    .groupExp.highlighted .exp a.rc b {
        color: black;
    }

    .groupExp.highlighted .exp {
        background-color: #F0F0F0;
    }

    .ext_edittext {
        padding: 2px;
    }

    td.edittext {
        white-space: normal;
    }

    .confinput {
        width:  300px;
        height: 70px;
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

    <table style="border: 0; width:98%;">
        <tr>
            <td style="vertical-align: top;" class="edittext">

                [{block name="d3_cfg_extsearch_main__form"}]
                    [{include file="d3_cfg_mod_active.tpl"}]

                    [{if $oView->getValueStatus() == 'error'}]
                        <hr>
                        <b>[{oxmultilang ident="D3_CFG_MOD_GENERAL_NOCONFIG_DESC"}]</b>
                        <br>
                        <br>
                        <span class="d3modcfg_btn fixed icon d3color-orange">
                            <button type="submit">
                                <i class="fa fa-warning fa-inverse"></i>[{oxmultilang ident="D3_CFG_MOD_GENERAL_NOCONFIG_BTN"}]
                            </button>
                        </span>
                    </form>
                [{else}]
                    <div class="groupExp [{if $edit->getEditValue('aExtSearch_similarSearchFields') == ''}]highlighted[{/if}]">
                        <div class="">
                            [{block name="d3_cfg_extsearch_main__main"}]
                                <a class="rc" onclick="_groupExp(this); return false;" href="#">
                                    <b>
                                        [{oxmultilang ident="D3_EXTSEARCH_MAIN_MAINSETTINGS"}]
                                    </b>
                                </a>
                                <dl>
                                    <dt>
                                        <label for="similarSearchFields">[{oxmultilang ident="D3_EXTSEARCH_MAIN_FIELDLIST"}]</label>
                                        [{if $edit->getEditValue('aExtSearch_similarSearchFields') == ''}]
                                            <br><div style="background-color: #CD0210; color: white;">[{oxmultilang ident="D3_EXTSEARCH_MAIN_NOFIELDSDEFINED"}]</div>
                                        [{/if}]
                                    </dt>
                                    <dd>
                                        <textarea id="similarSearchFields" class="confinput" name="valuearr[aExtSearch_similarSearchFields]">[{$edit->getEditValue('aExtSearch_similarSearchFields')}]</textarea>
                                        [{oxinputhelp ident="D3_EXTSEARCH_MAIN_FIELDLIST_DESC"}]
                                        [{assign var="clParam" value="cl="|cat:$oViewConf->getActiveClassName()}]
                                        <input type="button" value="[{oxmultilang ident="D3_EXTSEARCH_MAIN_SORTDEBUG"}]" onclick="window.open('[{$oViewConf->getSelfLink()|oxaddparams:$clParam|oxaddparams:"fnc=startSortAnalysis"}]', 'startSortAnalysis', 'width=800, height=300, left=100, scrollbars=yes, resizable=yes'); return false;">
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                                <dl>
                                    <dt>
                                        <label for="blSearchUseAND">[{oxmultilang ident="SHOP_CONFIG_SEARCHUSEAND"}]</label>
                                    </dt>
                                    <dd>
                                        <input type=hidden name=confbools[blSearchUseAND] value=0>
                                        <input id="blSearchUseAND" type=checkbox name=confbools[blSearchUseAND] value=1  [{if $oConfig->getConfigParam('blSearchUseAND')}]checked[{/if}] [{$readonly}]>
                                        [{oxinputhelp ident="HELP_"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                                <dl>
                                    <dt>
                                        <label for="MultiSearchwordUsage">[{oxmultilang ident="D3_EXTSEARCH_MAIN_MULIPLEWORDS"}]</label>
                                    </dt>
                                    <dd>
                                        <SELECT id="MultiSearchwordUsage" class="edittext ext_edittext" name="value[sExtSearch_MultiSearchwordUsage]">
                                            <OPTION value="singleWord"[{if $edit->getEditValue('sExtSearch_MultiSearchwordUsage') == 'singleWord'}] selected>&bull; [{else}]>[{/if}][{oxmultilang ident="D3_EXTSEARCH_MAIN_MULIPLEWORDS_SINGLE"}]</option>
                                            <OPTION value="wholeParam"[{if $edit->getEditValue('sExtSearch_MultiSearchwordUsage') == 'wholeParam'}] selected>&bull; [{else}]>[{/if}][{oxmultilang ident="D3_EXTSEARCH_MAIN_MULIPLEWORDS_WHOLE"}]</option>
                                            <OPTION value="syntax"[{if $edit->getEditValue('sExtSearch_MultiSearchwordUsage') == 'syntax'}] selected>&bull; [{else}]>[{/if}][{oxmultilang ident="D3_EXTSEARCH_MAIN_MULIPLEWORDS_SYNTAX"}]</option>
                                        </SELECT>
                                        [{oxinputhelp ident="D3_EXTSEARCH_MAIN_MULIPLEWORDS_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                                <dl>
                                    <dt>
                                        <label for="findPutInAndLeaveOut">[{oxmultilang ident="D3_EXTSEARCH_MAIN_PUTINLEAVEOUT"}]</label>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="value[blExtSearch_findPutInAndLeaveOut]" value="0">
                                        <input id="findPutInAndLeaveOut" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_findPutInAndLeaveOut]" value='1' [{if $edit->getEditValue('blExtSearch_findPutInAndLeaveOut') == 1}]checked[{/if}]>
                                        [{oxinputhelp ident="D3_EXTSEARCH_MAIN_PUTINLEAVEOUT_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                                <dl>
                                    <dt>
                                        <label for="ShowPopup">[{oxmultilang ident="D3_EXTSEARCH_MAIN_SHOW_POPUP"}]</label>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="value[blExtSearch_ShowPopup]" value="0">
                                        <input id="ShowPopup" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_ShowPopup]" value='1' [{if $edit->getEditValue('blExtSearch_ShowPopup') == 1}]checked[{/if}]>
                                        [{oxinputhelp ident="D3_EXTSEARCH_MAIN_SHOW_POPUP_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                            [{/block}]
                        </div>
                    </div>

                    <div class="groupExp">
                        <div class="">
                            [{block name="d3_cfg_extsearch_main__sorting"}]
                                <a class="rc" onclick="_groupExp(this); return false;" href="#">
                                    <b>
                                        [{oxmultilang ident="D3_EXTSEARCH_MAIN_SORTING"}]
                                    </b>
                                </a>
                                <dl>
                                    <dt>
                                        <label for="orderByPriority">[{oxmultilang ident="D3_EXTSEARCH_MAIN_ORDERBYPRIORITY"}]</label>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="value[blExtSearch_orderByPriority]" value="0">
                                        <input id="orderByPriority" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_orderByPriority]" value='1' [{if $edit->getEditValue('blExtSearch_orderByPriority') == 1}]checked[{/if}]>
                                        [{oxinputhelp ident="D3_EXTSEARCH_MAIN_ORDERBYPRIORITY_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                                <dl>
                                    <dt>
                                        <label for="orderByPush">[{oxmultilang ident="D3_EXTSEARCH_MAIN_ORDERBYPUSH"}]</label>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="value[blExtSearch_orderByPush]" value="0">
                                        <input id="orderByPush" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_orderByPush]" value='1' [{if $edit->getEditValue('blExtSearch_orderByPush') == 1}]checked[{/if}]>
                                        [{oxinputhelp ident="D3_EXTSEARCH_MAIN_ORDERBYPUSH_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                                <dl>
                                    <dt>
                                        <label for="orderByAlternative">[{oxmultilang ident="D3_EXTSEARCH_MAIN_ORDERBYALTERNATIVE"}]</label>
                                    </dt>
                                    <dd>
                                        <input id="orderByAlternative" class="editinput" type="text" size="10" maxlength="50" name="value[sExtSearch_orderByAlternative]" value='[{if $edit->getEditValue('sExtSearch_orderByAlternative')}][{$edit->getEditValue('sExtSearch_orderByAlternative')}][{else}]oxtitle[{/if}]'>&nbsp;
                                        <input type="radio" class="editinput" name="value[sExtSearch_orderDirAlternative]" value="asc" [{if $edit->getEditValue('sExtSearch_orderDirAlternative') == "asc" || false == $edit->getEditValue('sExtSearch_orderByAlternative')}]checked[{/if}]>[{oxmultilang ident="CATEGORY_MAIN_ASC"}]
                                        <input type="radio" class="editinput" name="value[sExtSearch_orderDirAlternative]" value="desc" [{if $edit->getEditValue('sExtSearch_orderDirAlternative') == "desc"}]checked[{/if}]>[{oxmultilang ident="CATEGORY_MAIN_DESC"}]
                                        [{oxinputhelp ident="D3_EXTSEARCH_MAIN_ORDERBYALTERNATIVE_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                            [{/block}]
                        </div>
                    </div>

                    <div class="groupExp">
                        <div class="">
                            [{block name="d3_cfg_extsearch_main__variants"}]
                                <a class="rc" onclick="_groupExp(this); return false;" href="#">
                                    <b>
                                        [{oxmultilang ident="D3_EXTSEARCH_MAIN_VARIANTSETTINGS"}]
                                    </b>
                                </a>
                                <dl>
                                    <dt>
                                        <label for="VariantSearch">[{oxmultilang ident="D3_EXTSEARCH_MAIN_VARIANTSEARCH"}]</label>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="value[blExtSearch_VariantSearch]" value="0">
                                        <input id="VariantSearch" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_VariantSearch]" value='1' [{if $edit->getEditValue('blExtSearch_VariantSearch') == 1}]checked[{/if}] onclick='[{include file="d3_togglegroup_extsearch.tpl" sToggleOptionName="blExtSearch_VariantSearch" sToggleOptionClass=".variant_options"}]'>
                                        [{oxinputhelp ident="D3_EXTSEARCH_MAIN_VARIANTSEARCH_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                                <dl class="variant_options">
                                    <dt>
                                        <label for="VariantUsage">[{oxmultilang ident="D3_EXTSEARCH_MAIN_VARIANTUSAGE"}]</label>
                                    </dt>
                                    <dd>
                                        <SELECT id="VariantUsage" class="edittext ext_edittext" name="value[sExtSearch_VariantUsage]">
                                            <OPTION value="showParent"[{if $edit->getEditValue('sExtSearch_VariantUsage') == 'showParent'}] selected>&bull; [{else}]>[{/if}][{oxmultilang ident="D3_EXTSEARCH_MAIN_VARIANTUSAGE_SHOWPARENT"}]</option>
                                            <OPTION value="showVariant"[{if $edit->getEditValue('sExtSearch_VariantUsage') == 'showVariant'}] selected>&bull; [{else}]>[{/if}][{oxmultilang ident="D3_EXTSEARCH_MAIN_VARIANTUSAGE_SHOWVARIANT"}]</option>
                                        </SELECT>
                                        [{oxinputhelp ident="D3_EXTSEARCH_MAIN_VARIANTUSAGE_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>

                                [{if $oView->d3UseAlistFilters()}]
                                    [{assign var="blActionRestriction" value=""}]
                                [{else}]
                                    [{assign var="blActionRestriction" value="readonly disabled"}]
                                    [{assign var="blRestricted" value=true}]
                                [{/if}]
                                <dl class="variant_options">
                                    <dt>
                                        <label for="VariantInAList" class="[{$blActionRestriction}]">[{oxmultilang ident="D3_EXTSEARCH_MAIN_VARIANTINALIST"}]</label>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="value[blExtSearch_VariantInAList]" value="0" [{$blActionRestriction}]>
                                        <input id="VariantInAList" class="edittext ext_edittext" type="checkbox" [{$blActionRestriction}] name="value[blExtSearch_VariantInAList]" value='1' [{if !$blRestricted && $edit->getEditValue('blExtSearch_VariantInAList') == 1}]checked[{/if}]>
                                        [{oxinputhelp ident="D3_EXTSEARCH_MAIN_VARIANTINALIST_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                                <dl class="variant_options">
                                    <dt>
                                        <label for="VariantCheckParentActive">[{oxmultilang ident="D3_EXTSEARCH_MAIN_VARIANTCHECKPARENTACTIVE"}]</label>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="value[blExtSearch_VariantCheckParentActive]" value="0">
                                        <input id="VariantCheckParentActive" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_VariantCheckParentActive]" value='1' [{if $edit->getEditValue('blExtSearch_VariantCheckParentActive') == 1}]checked[{/if}]>
                                        [{oxinputhelp ident="D3_EXTSEARCH_MAIN_VARIANTCHECKPARENTACTIVE_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                            [{/block}]
                        </div>
                    </div>

                    <div class="groupExp">
                        <div class="">
                            [{block name="d3_cfg_extsearch_main__phonetics"}]
                                <a class="rc" onclick="_groupExp(this); return false;" href="#">
                                    <b>
                                        [{oxmultilang ident="D3_EXTSEARCH_MAIN_PHONETICS"}]
                                    </b>
                                </a>
                                <dl>
                                    <dt style="width: 90%; float: none;">[{oxmultilang ident="D3_EXTSEARCH_MAIN_PHONETICS_DESC"}]</dt>
                                </dl>
                                <dl>
                                    <dt>
                                        <label for="similarSearch">[{oxmultilang ident="D3_EXTSEARCH_MAIN_SIMILARSEARCH"}]</label>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="value[blExtSearch_similarSearch]" value="0">
                                        <input id="similarSearch" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_similarSearch]" value='1' [{if $edit->getEditValue('blExtSearch_similarSearch') == 1}]checked[{/if}] onclick='[{include file="d3_togglegroup_extsearch.tpl" sToggleOptionName="blExtSearch_similarSearch" sToggleOptionClass=".phonetic_options"}]'>
                                        [{oxinputhelp ident="D3_EXTSEARCH_MAIN_SIMILARSEARCH_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                                <dl class="phonetic_options">
                                    <dt>
                                        <label for="langFile">[{oxmultilang ident="D3_EXTSEARCH_MAIN_PHONETICLANG"}]</label>
                                    </dt>
                                    <dd>
                                        <select id="langFile" name="value[sExtSearch_langFile]" class="editinput">
                                            [{foreach from=$oView->getPhoneticLanguages() item=aLang}]
                                                <option value="[{$aLang.file}]" [{if $edit->getEditValue('sExtSearch_langFile') == $aLang.file}]selected>&bull; [{else}]>[{/if}][{$aLang.name}] ([{$aLang.file}])</option>
                                            [{/foreach}]
                                        </select>
                                        [{oxinputhelp ident="D3_EXTSEARCH_MAIN_PHONETICLANG_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                                <dl class="phonetic_options">
                                    <dt>
                                        <label for="blsimilarExtList">[{oxmultilang ident="D3_EXTSEARCH_MAIN_SIMILAREXTLIST_1"}]</label>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="value[blExtSearch_similarExtList]" value="0">
                                        <input id="blsimilarExtList" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_similarExtList]" value='1' [{if $edit->getEditValue('blExtSearch_similarExtList') == 1}]checked[{/if}]>
                                        <input id="isimilarExtList" type="text" class="editinput" size="8" maxlength="5" name="value[iExtSearch_similarExtList]" value="[{if $edit->getEditValue('iExtSearch_similarExtList')}][{$edit->getEditValue('iExtSearch_similarExtList')}][{else}]10[{/if}]">    <label for="isimilarExtList">[{oxmultilang ident="D3_EXTSEARCH_MAIN_SIMILAREXTLIST_2"}]</label>
                                        [{oxinputhelp ident="D3_EXTSEARCH_MAIN_SIMILAREXTLIST_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                                <dl class="phonetic_options">
                                    <dt>
                                        <label for="minPhonLength">[{oxmultilang ident="D3_EXTSEARCH_MAIN_MINPHONLENGTH"}]</label>
                                    </dt>
                                    <dd>
                                        <SELECT id="minPhonLength" class="edittext ext_edittext" name="value[iExtSearch_minPhonLength]">
                                            <OPTION value="2"[{if $edit->getEditValue('iExtSearch_minPhonLength') == 2}] selected>&bull; [{else}]>[{/if}][{oxmultilang ident="D3_EXTSEARCH_MAIN_MINPHONLENGTH_LESS"}]</option>
                                            <OPTION value="3"[{if $edit->getEditValue('iExtSearch_minPhonLength') == 3}] selected>&bull; [{else}]>[{/if}][{oxmultilang ident="D3_EXTSEARCH_MAIN_MINPHONLENGTH_REG"}]</option>
                                            <OPTION value="4"[{if $edit->getEditValue('iExtSearch_minPhonLength') == 4}] selected>&bull; [{else}]>[{/if}][{oxmultilang ident="D3_EXTSEARCH_MAIN_MINPHONLENGTH_MORE"}]</option>
                                        </SELECT>
                                        [{oxinputhelp ident="D3_EXTSEARCH_MAIN_MINPHONLENGTH_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                            [{/block}]
                        </div>
                    </div>

                    <div class="groupExp">
                        <div class="">
                            [{block name="d3_cfg_extsearch_main__semantics"}]
                                <a class="rc" onclick="_groupExp(this); return false;" href="#">
                                    <b>
                                        [{oxmultilang ident="D3_EXTSEARCH_MAIN_SEMANTICS"}]
                                    </b>
                                </a>
                                <dl>
                                    <dt style="width: 90%; float: none;">[{oxmultilang ident="D3_EXTSEARCH_MAIN_SEMANTICS_DESC"}]</dt>
                                </dl>
                                <dl>
                                    <dt>
                                        <label for="semanticSearch">[{oxmultilang ident="D3_EXTSEARCH_MAIN_SEMANTICSEARCH"}]</label>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="value[blExtSearch_semanticSearch]" value="0">
                                        <input id="semanticSearch" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_semanticSearch]" value='1' [{if $edit->getEditValue('blExtSearch_semanticSearch') == 1}]checked[{/if}] onclick='[{include file="d3_togglegroup_extsearch.tpl" sToggleOptionName="blExtSearch_semanticSearch" sToggleOptionClass=".semantic_options"}]'>
                                        [{oxinputhelp ident="D3_EXTSEARCH_MAIN_SEMANTICSEARCH_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                                <dl class="semantic_options">
                                    <dt>
                                        <label for="semanticUsePhonetic">[{oxmultilang ident="D3_EXTSEARCH_MAIN_SEMANTICUSEPHONETIC"}]</label>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="value[blExtSearch_semanticUsePhonetic]" value="[{if $edit->getEditValue('blExtSearch_similarSearch') != 1}][{$edit->getEditValue('blExtSearch_semanticUsePhonetic')}][{else}]0[{/if}]">
                                        <input id="semanticUsePhonetic" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_semanticUsePhonetic]" value='1' [{if $edit->getEditValue('blExtSearch_semanticUsePhonetic') == 1}]checked[{/if}] [{if $edit->getEditValue('blExtSearch_similarSearch') != 1}]disabled[{/if}]>
                                        [{oxinputhelp ident="D3_EXTSEARCH_MAIN_SEMANTICUSEPHONETIC_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                            [{/block}]
                        </div>
                    </div>

                    <div class="groupExp">
                        <div class="">
                            [{block name="d3_cfg_extsearch_main__category"}]
                                <a class="rc" onclick="_groupExp(this); return false;" href="#">
                                    <b>
                                        [{oxmultilang ident="D3_EXTSEARCH_MAIN_CATEGORY"}]
                                    </b>
                                </a>
                                <dl>
                                    <dt>
                                        <label for="catSearch">[{oxmultilang ident="D3_EXTSEARCH_MAIN_CATEGORY_SEARCH"}]</label>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="value[blExtSearch_catSearch]" value="0">
                                        <input id="catSearch" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_catSearch]" value='1' [{if $edit->getEditValue('blExtSearch_catSearch') == 1}]checked[{/if}] onclick='[{include file="d3_togglegroup_extsearch.tpl" sToggleOptionName="blExtSearch_catSearch" sToggleOptionClass=".category_options"}]'>
                                        [{oxinputhelp ident="D3_EXTSEARCH_MAIN_CATEGORY_SEARCH_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                                <dl class="category_options">
                                    <dt>
                                        <label for="blSearchUseAND">[{oxmultilang ident="SHOP_CONFIG_SEARCHUSEAND"}]</label>
                                    </dt>
                                    <dd>
                                        <input type=hidden name=value[blExtSearch_catSearchUseAND] value=0>
                                        <input id="blSearchUseAND" type=checkbox name=value[blExtSearch_catSearchUseAND] value=1  [{if $edit->getEditValue('blExtSearch_catSearchUseAND')}]checked[{/if}] [{$readonly}]>
                                        [{oxinputhelp ident="D3_EXTSEARCH_MAIN_CATEGORY_ANDOR_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                                <dl style="display: none;">
                                    <dt>
                                        <label for="showCatArticles">[{oxmultilang ident="D3_EXTSEARCH_MAIN_CATEGORY_ARTHANDLING"}]</label>
                                    </dt>
                                    <dd>
                                        <SELECT id="showCatArticles" class="edittext ext_edittext" name="value[sExtSearch_showCatArticles]">
                                            <OPTION selected value="artincat"[{if $edit->getEditValue('sExtSearch_showCatArticles') == 'artincat' || $edit->getEditValue('sExtSearch_showCatArticles') == ''}] selected>&bull; [{else}]>[{/if}][{oxmultilang ident="D3_EXTSEARCH_MAIN_CATEGORY_ARTINCAT"}]</option>
                                            <OPTION value="catinlist"[{if $edit->getEditValue('sExtSearch_showCatArticles') == 'catinlist__'}] selected>&bull; [{else}]>[{/if}][{oxmultilang ident="D3_EXTSEARCH_MAIN_CATEGORY_CATINLIST"}]</option>
                                        </SELECT>
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                                <dl class="category_options">
                                    <dt>
                                        <label for="catPrio">[{oxmultilang ident="D3_EXTSEARCH_MAIN_CATEGORY_PRIORITY"}]</label>
                                    </dt>
                                    <dd>
                                        <input id="catPrio" type="text" class="editinput" size="8" maxlength="5" name="value[iExtSearch_catPrio]" value="[{if $edit->getEditValue('iExtSearch_catPrio')}][{$edit->getEditValue('iExtSearch_catPrio')}][{else}]50[{/if}]">
                                        [{oxinputhelp ident="D3_EXTSEARCH_MAIN_CATEGORY_PRIORITY_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                            [{/block}]
                        </div>
                    </div>

                    <div class="groupExp">
                        <div class="">
                            [{block name="d3_cfg_extsearch_main__manufacturer"}]
                                <a class="rc" onclick="_groupExp(this); return false;" href="#">
                                    <b>
                                        [{oxmultilang ident="D3_EXTSEARCH_MAIN_MANUFACTURER"}]
                                    </b>
                                </a>
                                <dl>
                                    <dt>
                                        <label for="manufacturerSearch">[{oxmultilang ident="D3_EXTSEARCH_MAIN_MANUFACTURER_SEARCH"}]</label>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="value[blExtSearch_manufacturerSearch]" value="0">
                                        <input id="manufacturerSearch" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_manufacturerSearch]" value='1' [{if $edit->getEditValue('blExtSearch_manufacturerSearch') == 1}]checked[{/if}] onclick='[{include file="d3_togglegroup_extsearch.tpl" sToggleOptionName="blExtSearch_manufacturerSearch" sToggleOptionClass=".manufacturer_options"}]'>
                                        [{oxinputhelp ident="D3_EXTSEARCH_MAIN_MANUFACTURER_SEARCH_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                                <dl class="manufacturer_options">
                                    <dt>
                                        <label for="blSearchUseAND">[{oxmultilang ident="SHOP_CONFIG_SEARCHUSEAND"}]</label>
                                    </dt>
                                    <dd>
                                        <input type=hidden name=value[blExtSearch_manufacturerSearchUseAND] value=0>
                                        <input id="blSearchUseAND" type=checkbox name=value[blExtSearch_manufacturerSearchUseAND] value=1  [{if $edit->getEditValue('blExtSearch_manufacturerSearchUseAND')}]checked[{/if}] [{$readonly}]>
                                        [{oxinputhelp ident="D3_EXTSEARCH_MAIN_MANUFACTURER_ANDOR_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                                <dl class="manufacturer_options">
                                    <dt>
                                        <label for="manufacturerPrio">[{oxmultilang ident="D3_EXTSEARCH_MAIN_MANUFACTURER_PRIORITY"}]</label>
                                    </dt>
                                    <dd>
                                        <input id="manufacturerPrio" type="text" class="editinput" size="8" maxlength="5" name="value[iExtSearch_manufacturerPrio]" value="[{if $edit->getEditValue('iExtSearch_manufacturerPrio')}][{$edit->getEditValue('iExtSearch_manufacturerPrio')}][{else}]50[{/if}]">
                                        [{oxinputhelp ident="D3_EXTSEARCH_MAIN_MANUFACTURER_PRIORITY_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                            [{/block}]
                        </div>
                    </div>

                    <div class="groupExp">
                        <div class="">
                            [{block name="d3_cfg_extsearch_main__contents"}]
                                <a class="rc" onclick="_groupExp(this); return false;" href="#">
                                    <b>
                                        [{oxmultilang ident="D3_EXTSEARCH_NAVI_CONTENTS"}]
                                    </b>
                                </a>
                                <dl>
                                    <dt>
                                        <label for="showContentList">[{oxmultilang ident="D3_EXTSEARCH_NAVI_CONTENTLIST"}]</label>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="value[blExtSearch_showContentList]" value="0">
                                        <input id="showContentList" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_showContentList]" value='1' [{if $edit->getEditValue('blExtSearch_showContentList') == 1}]checked[{/if}] onclick='[{include file="d3_togglegroup_extsearch.tpl" sToggleOptionName="blExtSearch_showContentList" sToggleOptionClass=".content_options"}]'>
                                        [{oxinputhelp ident="D3_EXTSEARCH_NAVI_CONTENTLIST_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                                <dl class="content_options">
                                    <dt>
                                        <label for="contentSearchLongtext">[{oxmultilang ident="D3_EXTSEARCH_NAVI_CONTENTSEARCHINLONGTEXT"}]</label>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="value[blExtSearch_contentSearchLongtext]" value="0">
                                        <input id="contentSearchLongtext" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_contentSearchLongtext]" value='1' [{if $edit->getEditValue('blExtSearch_contentSearchLongtext') == 1}]checked[{/if}]>
                                        [{oxinputhelp ident="D3_EXTSEARCH_NAVI_CONTENTLONG_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                            [{/block}]
                        </div>
                    </div>

                    <div class="groupExp">
                        <div class="">
                            [{block name="d3_cfg_extsearch_main__redirects"}]
                                <a class="rc" onclick="_groupExp(this); return false;" href="#">
                                    <b>
                                        [{oxmultilang ident="D3_EXTSEARCH_NAVI_REDIRECTS"}]
                                    </b>
                                </a>
                                <dl>
                                    <dt>
                                        <label for="useArtNumSearch">[{oxmultilang ident="D3_EXTSEARCH_MAIN_USEARTNUMSEARCH"}]</label>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="value[blExtSearch_useArtNumSearch]" value="0">
                                        <input id="useArtNumSearch" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_useArtNumSearch]" value='1' [{if $edit->getEditValue('blExtSearch_useArtNumSearch') == 1}]checked[{/if}]>
                                        [{oxinputhelp ident="D3_EXTSEARCH_MAIN_USEARTNUMSEARCH_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                                <dl>
                                    <dt>
                                        <label for="goToUniqueHit">[{oxmultilang ident="D3_EXTSEARCH_NAVI_UNIQUEHIT"}]</label>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="value[blExtSearch_goToUniqueHit]" value="0">
                                        <input id="goToUniqueHit" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_goToUniqueHit]" value='1' [{if $edit->getEditValue('blExtSearch_goToUniqueHit') == 1}]checked[{/if}]>
                                        [{oxinputhelp ident="D3_EXTSEARCH_NAVI_UNIQUEHIT_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                                <dl>
                                    <dt>
                                        <label for="goToUniqueContentHit">[{oxmultilang ident="D3_EXTSEARCH_NAVI_UNIQUECONTENTHIT"}]</label>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="value[blExtSearch_goToUniqueContentHit]" value="0">
                                        <input id="goToUniqueContentHit" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_goToUniqueContentHit]" value='1' [{if $edit->getEditValue('blExtSearch_goToUniqueContentHit') == 1}]checked[{/if}]>
                                        [{oxinputhelp ident="D3_EXTSEARCH_NAVI_UNIQUECONTENTHIT_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                                <dl>
                                    <dt>
                                        <label for="goToUniqueVendorHit">[{oxmultilang ident="D3_EXTSEARCH_NAVI_UNIQUEVENDORHIT"}]</label>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="value[blExtSearch_goToUniqueVendorHit]" value="0">
                                        <input id="goToUniqueVendorHit" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_goToUniqueVendorHit]" value='1' [{if $edit->getEditValue('blExtSearch_goToUniqueVendorHit') == 1}]checked[{/if}]>
                                        [{oxinputhelp ident="D3_EXTSEARCH_NAVI_UNIQUEVENDORHIT_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                                <dl>
                                    <dt>
                                        <label for="goToUniqueManufacturerHit">[{oxmultilang ident="D3_EXTSEARCH_NAVI_UNIQUEMANUFACTURERHIT"}]</label>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="value[blExtSearch_goToUniqueManufacturerHit]" value="0">
                                        <input id="goToUniqueManufacturerHit" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_goToUniqueManufacturerHit]" value='1' [{if $edit->getEditValue('blExtSearch_goToUniqueManufacturerHit') == 1}]checked[{/if}]>
                                        [{oxinputhelp ident="D3_EXTSEARCH_NAVI_UNIQUEMANUFACTURERHIT_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                            [{/block}]
                        </div>
                    </div>

                    <div class="groupExp">
                        <div class="">
                            [{block name="d3_cfg_extsearch_main__log"}]
                                <a class="rc" onclick="_groupExp(this); return false;" href="#">
                                    <b>
                                        [{oxmultilang ident="D3_EXTSEARCH_MAIN_LOGSETTINGS"}]
                                    </b>
                                </a>
                                <dl>
                                    <dt>
                                        <label for="logHitless">[{oxmultilang ident="D3_EXTSEARCH_MAIN_LOGHITLESS"}]</label>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="value[blExtSearch_logHitless]" value="0">
                                        <input id="logHitless" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_logHitless]" value='1' [{if $edit->getEditValue('blExtSearch_logHitless') == 1}]checked[{/if}]>
                                        [{oxinputhelp ident="D3_EXTSEARCH_MAIN_LOGHITLESS_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                                <dl>
                                    <dt>
                                        <label for="generallyLogForSearch">[{oxmultilang ident="D3_EXTSEARCH_MAIN_LOGFORSEARCH"}]</label>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="value[blExtSearch_generallyLogForSearch]" value="0">
                                        <input id="generallyLogForSearch" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_generallyLogForSearch]" value='1' [{if $edit->getEditValue('blExtSearch_generallyLogForSearch') == 1}]checked[{/if}]>
                                        [{oxinputhelp ident="D3_EXTSEARCH_MAIN_LOGFORSEARCH_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                            [{/block}]
                        </div>
                    </div>

                    <div class="groupExp">
                        <div class="">
                            [{block name="d3_cfg_extsearch_main__admin"}]
                                <a class="rc" onclick="_groupExp(this); return false;" href="#">
                                    <b>
                                        [{oxmultilang ident="D3_EXTSEARCH_MAIN_ADMINPANEL"}]
                                    </b>
                                </a>
                                <dl>
                                    <dt>
                                        <label for="adminShowVariants">[{oxmultilang ident="D3_EXTSEARCH_MAIN_ADMINSHOWVARIANTS"}]</label>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="value[blExtSearch_adminShowVariants]" value="0">
                                        <input id="adminShowVariants" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_adminShowVariants]" value='1' [{if $edit->getEditValue('blExtSearch_adminShowVariants') == 1}]checked[{/if}]>
                                        [{oxinputhelp ident="D3_EXTSEARCH_MAIN_ADMINSHOWVARIANTS_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                            [{/block}]
                        </div>
                    </div>

                    <table style="width: 100%">
                        <tr>
                            <td class="edittext ext_edittext" style="text-align: left;">
                                <br>
                                <span class="d3modcfg_btn icon d3color-green">
                                    <button type="submit" name="save">
                                        <i class="fa fa-check-circle fa-inverse"></i>[{oxmultilang ident="D3_EXTSEARCH_MAIN_SAVE"}]
                                    </button>
                                </span>
                                <br><br>
                            </td>
                        </tr>
                    </table>

                    <div class="groupExp [{if $oView->getIndexStatus() > 0}]highlighted[{/if}]">
                        <div class="">
                            [{block name="d3_cfg_extsearch_main__index"}]
                                <a class="rc" onclick="_groupExp(this); return false;" href="#">
                                    <b>
                                        [{oxmultilang ident="D3_EXTSEARCH_MAIN_INDEX"}]
                                    </b>
                                </a>
                                <dl>
                                    <dt style="width: 90%; float: none;">[{oxmultilang ident="D3_EXTSEARCH_MAIN_INDEX_DESC"}]</dt>
                                </dl>
                                <dl>
                                    <dt>
                                        <input id="articlesPerTick" type="text" class="editinput" size="4" maxlength="3" name="value[iExtSearch_articlesPerTick]" value="[{$oView->getArticleCountPerTick()}]">
                                        <label for="articlesPerTick">[{oxmultilang ident="D3_EXTSEARCH_MAIN_INDEXARTCNT"}]</label>
                                        [{oxinputhelp ident="D3_EXTSEARCH_MAIN_INDEXARTCNT_DESC"}]
                                    </dt>
                                    <dd>
                                    </form>
                                    <form name="myedit" id="myedit" action="[{$oViewConf->getSelfLink()}]" method="post" style="padding: 0;margin: 0;height:0;">
                                        [{$oViewConf->getHiddenSid()}]
                                        <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
                                        <input type="hidden" name="fnc" value="generatePhoneticStrings">
                                        <input type="hidden" name="editlanguage" value="[{$editlanguage}]">
                                        <input type="hidden" name="oxid" value="[{$oxid}]">
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>

                                [{assign var="clParam" value="cl="|cat:$oViewConf->getActiveClassName()}]
                                <dl>
                                    <dt>
                                        &nbsp;
                                    </dt>
                                    <dd>
                                        <span class="d3modcfg_btn icon d3color-orange">
                                            <button type="submit" name="save" onclick="window.open('[{$oViewConf->getSelfLink()|oxaddparams:$clParam|oxaddparams:"fnc=generatePhoneticStrings"}]', 'generate_phonetic', 'width=300, height=300, left=100'); return false;">
                                                <i class="fa fa-warning fa-inverse"></i>[{oxmultilang ident="D3_EXTSEARCH_MAIN_GENINDEXCMPL"}]
                                            </button>
                                        </span>

                                        [{oxinputhelp ident="D3_EXTSEARCH_MAIN_GENINDEXCMPL_DESC"}]
                                    </dd>
                                    <dd class="spacer"></dd>
                                </dl>
                                <dl>
                                    <dt>
                                        &nbsp;
                                    </dt>
                                    <dd>
                                        <span class="d3modcfg_btn icon d3color-orange">
                                            <button type="submit" name="save" onclick="window.open('[{$oViewConf->getSelfLink()|oxaddparams:$clParam|oxaddparams:"fnc=generatePhoneticSemantic"}]', 'generate_phoneticsemantic', 'width=300, height=300, left=100'); return false;">
                                                <i class="fa fa-warning fa-inverse"></i>[{oxmultilang ident="D3_EXTSEARCH_MAIN_GENSEMANTICINDEX"}]
                                            </button>
                                        </span>
                                        [{oxinputhelp ident="D3_EXTSEARCH_MAIN_GENSEMANTICINDEX_DESC"}]
                                </dd>
                            [{/block}]
                            </form>
                            <div class="spacer"></div>
                        </dl>
                    </div>
                </div>
            [{/if}]
            [{/block}]
        </td>
    </tr>
</table>

[{include file="d3_cfg_mod_inc.tpl"}]

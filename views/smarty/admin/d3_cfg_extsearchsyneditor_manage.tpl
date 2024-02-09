[{include file="headitem.tpl" title="D3MXEXTSEARCH_SYNEDITOR"|oxmultilangassign}]

<script type="text/javascript">
    window.onload = function () {
        [{if $updatelist == 1}]
            top.oxid.admin.updateList('[{$oxid}]');
        [{/if}]
        let oField = top.oxid.admin.getLockTarget();
        oField.onchange = oField.onkeyup = oField.onmouseout = top.oxid.admin.unlockSave;
    }

    function editThis(sID) {
        let oTransfer = top.basefrm.edit.document.getElementById("transfer");
        oTransfer.oxid.value = sID;
        oTransfer.cl.value = top.basefrm.list.sDefClass;

        //forcing edit frame to reload after submit
        top.forceReloadingEditFrame();

        let oSearch = top.basefrm.list.document.getElementById("search");
        oSearch.oxid.value = sID;
        oSearch.actedit.value = 0;
        oSearch.submit();
    }
    function deleteThis(sID) {
        let blCheck = confirm("[{oxmultilang ident="D3_EXTSEARCH_SYNED_DELETESYN"}]");
        if (blCheck === true) {
            let oSearch = document.getElementById("myedit2");
            oSearch.fnc.value = 'deletesynonym';
            oSearch.deloxid.value = sID;
            oSearch.submit();
        }
    }
</script>

<style type="text/css">
    <!--

    td.edittext,
    th {
        padding: 5px;
    }

    th {
        border-bottom: 1px solid silver;
    }

    fieldset {
        border:           1px inset black;
        background-color: #F0F0F0;
    }

    legend {
        font-weight: bold;
    }

    dl dt {
        font-weight: normal;
        width:       55%;
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

[{oxmultilang ident="D3_EXTSEARCH_SYNED_MANAGE_DESC"}]
<table style="padding:0;border:0;width:98%;">
    <tr>
        <td class="edittext" style="vertical-align: top;padding-top:10px;padding-left:10px; width: 50%;">

            <form name="myedit2" id="myedit2" action="[{$oViewConf->getSelfLink()}]" method="post">
                [{$oViewConf->getHiddenSid()}]
                <input type="hidden" name="editlanguage" value="0">
                <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
                <input type="hidden" name="fnc" value="savesynonym">
                <input type="hidden" name="oxid" value="[{$oxid}]">
                <input type="hidden" name="deloxid" value="">
                <input type="hidden" name="editval[d3_extsearch_term__synset_id]" value="[{$edit->d3_extsearch_term__synset_id->value}]">
                <input type="hidden" name="editval[d3_extsearch_term__language_id]" value="[{$edit->d3_extsearch_term__language_id->value}]">

                <table style="padding:0;border:0;width:100%;">
                    <colgroup>
                        <col style="width:10%">
                        <col>
                        <col style="width:29px">
                    </colgroup>
                    [{assign var="blWhite" value=""}]
                    <tr>
                        <th>[{oxmultilang ident="D3_EXTSEARCH_SYNED_MANAGE_EDIT"}] [{oxinputhelp ident="D3_EXTSEARCH_SYNED_MANAGE_EDIT_DESC"}]</th>
                        <th>[{oxmultilang ident="D3_EXTSEARCH_SYNED_MANAGE_SYNONYM"}]</th>
                        <th>&nbsp;</th>
                    </tr>
                    [{foreach from=$aSynList item="sSynonym" key="termid"}]
                        [{assign var="listclass" value="listitem"|cat:$blWhite}]
                        <tr>
                            <td class="edittext [{$listclass}]" style="text-align: center;">
                                [{if !$readonly}]
                                    <a href="JavaScript:editThis('[{$termid}]');"><img src="[{$oViewConf->getImageUrl()}]editvariant.gif" style="width:15px;height:15px;border:0;vertical-align: middle" alt=""></a>
                                [{/if}]
                            </td>
                            <td class="edittext [{$listclass}]">
                                [{$sSynonym}]
                            </td>
                            <td class="edittext [{$listclass}]" style="width: 15px;">
                                [{if !$readonly}]
                                    <a href="Javascript:deleteThis('[{$termid}]');" class="delete"></a>
                                [{/if}]
                            </td>
                        </tr>
                        [{if $blWhite == "2"}]
                            [{assign var="blWhite" value=""}]
                        [{else}]
                            [{assign var="blWhite" value="2"}]
                        [{/if}]
                    [{/foreach}]

                    [{assign var="listclass" value="listitem"|cat:$blWhite}]
                    <tr>
                        <td class="edittext [{$listclass}]">
                        </td>
                        <td class="edittext [{$listclass}]" colspan="2">
                            <input class="editinput" type="text" name="editval[d3_extsearch_term__word]" size="32" maxlength="[{$edit->d3_extsearch_term__word->fldmax_length}]" [{$readonly}]>
                            <input value="[{oxmultilang ident="D3_EXTSEARCH_SYNED_SAVENEWSYN"}]" type="submit" class="editinput" [{$readonly}]>
                            [{oxinputhelp ident="D3_EXTSEARCH_SYNED_SAVENEWSYN_DESC"}]
                        </td>
                    </tr>
                </table>
            </form>
        </td>
    </tr>
</table>

[{include file="@d3modcfg_lib/admin/inc/inc.tpl"}]

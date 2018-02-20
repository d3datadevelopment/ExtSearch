[{include file="headitem.tpl" title="d3mxextsearch_syneditor"|oxmultilangassign}]

<script type="text/javascript">
    <!--
    window.onload = function ()
    {
        [{if $updatelist == 1}]
            top.oxid.admin.updateList('[{$oxid}]');
        [{/if}]
        var oField = top.oxid.admin.getLockTarget();
        oField.onchange = oField.onkeyup = oField.onmouseout = top.oxid.admin.unlockSave;
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

    dl dt {
        font-weight: normal;
        width:       55%;
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

<form name="myedit" id="myedit" action="[{$oViewConf->getSelfLink()}]" method="post" style="padding: 0;margin: 0;height:0;">
    [{$oViewConf->getHiddenSid()}]
    <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
    <input type="hidden" name="fnc" value="save">
    <input type="hidden" name="oxid" value="[{$oxid}]">
    <input type="hidden" name="editval[d3_extsearch_term__oxid]" value="[{$oxid}]">
    <table cellspacing="0" cellpadding="0" border="0" style="width:98%;">
        <tr>
            <td valign="top" class="edittext" style="padding-top:10px;padding-left:10px; width: 50%;">

                <table cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <td class="edittext" style="width:120px;">
                            <label for="term__word">[{oxmultilang ident="D3_EXTSEARCH_SYNED_MAIN_WORD"}]</label>
                        </td>
                        <td class="edittext">
                            <input type="text" class="editinput" size="32" maxlength="[{$edit->d3_extsearch_term__word->fldmax_length}]" id="term__word" name="editval[d3_extsearch_term__word]" value="[{$edit->getFieldData('word')}]">
                            [{oxinputhelp ident="D3_EXTSEARCH_SYNED_MAIN_WORD_DESC"}]
                        </td>
                    </tr>
                    <tr>
                        <td class="edittext" style="width:120px;">
                            <label for="term__user_comment">[{oxmultilang ident="D3_EXTSEARCH_SYNED_MAIN_COMMENT"}]</label>
                        </td>
                        <td class="edittext">
                            <input type="text" class="editinput" size="32" maxlength="[{$edit->d3_extsearch_term__user_comment->fldmax_length}]" id="term__user_comment" name="editval[d3_extsearch_term__user_comment]" value="[{$edit->getFieldData('user_comment')}]">
                            [{oxinputhelp ident="D3_EXTSEARCH_SYNED_MAIN_COMMENT_DESC"}]
                        </td>
                    </tr>
                </table>
            </td>
    <!-- Anfang rechte Seite -->
            <td valign="top" class="edittext" align="left" style="width:100%;height:99%;padding-left:5px;padding-bottom:30px;padding-top:10px;">
                <table cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <td class="edittext" style="width:120px;">
                            <label for="term__synset_id">[{oxmultilang ident="D3_EXTSEARCH_SYNED_MAIN_SYNSETID"}]</label>
                        </td>
                        <td class="edittext">
                            [{if $oxid != '-1'}]
                                <input type="text" class="editinput" size="32" maxlength="[{$edit->d3_extsearch_term__synset_id->fldmax_length}]" id="term__synset_id" name="editval[d3_extsearch_term__synset_id]" value="[{$edit->getFieldData('synset_id')}]">
                            [{else}]
                                [{$oView->getNextSynsetId()}]
                            [{/if}]
                            [{oxinputhelp ident="D3_EXTSEARCH_SYNED_MAIN_SYNSETID_DESC"}]
                        </td>
                    </tr>
                    <tr>
                        <td class="edittext" style="width:120px;">
                            <label for="term__language_id">[{oxmultilang ident="D3_EXTSEARCH_SYNED_MAIN_LANGUAGE"}]</label>
                        </td>
                        <td class="edittext">
                            <select class="editinput" name="editval[d3_extsearch_term__language_id]" id="term__language_id" [{$readonly}]>
                                [{foreach from=$oView->getLanguageList() item="oLanguage"}]
                                    <option value="[{$oLanguage->id}]"[{if $oLanguage->selected && $oxid == '-1' || $edit->getFieldData('language_id') == $oLanguage->id}] selected[{/if}]>[{$oLanguage->name}] [{if $oView->convertBin2Int($oLanguage->active) == 0}][{oxmultilang ident="D3_EXTSEARCH_SYNED_MAIN_LANGUAGE_DISABLED"}][{/if}]</option>
                                [{/foreach}]
                            </select>
                            [{oxinputhelp ident="D3_EXTSEARCH_SYNED_MAIN_LANGUAGE_DESC"}]
                        </td>
                    </tr>
                </table>

            </td>
    <!-- Ende rechte Seite -->
        </tr>
        <tr>
            <td class="edittext ext_edittext" style="text-align: left;" colspan="2">
                <br>
                <span class="d3modcfg_btn icon d3color-green">
                    <button type="submit" name="save">
                        <i class="fa fa-check-circle fa-inverse"></i>[{oxmultilang ident="D3_EXTSEARCH_MAIN_SAVE"}]
                    </button>
                </span>
            </td>
        </tr>
    </table>
</form>

[{include file="d3_cfg_mod_inc.tpl"}]

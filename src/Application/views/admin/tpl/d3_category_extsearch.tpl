[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign}]

[{d3modcfgcheck modid="d3_extsearch"}][{/d3modcfgcheck}]

[{if $readonly}]
    [{assign var="readonly" value="readonly disabled"}]
[{else}]
    [{assign var="readonly" value=""}]
[{/if}]

<form name="transfer" id="transfer" action="[{$oViewConf->getSelfLink()}]" method="post">
    [{$oViewConf->getHiddenSid()}]
    <input type="hidden" name="oxid" value="[{$oxid}]">
    <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
    <input type="hidden" name="editlanguage" value="[{$editlanguage}]">
</form>

<form name="myedit" id="myedit" action="[{$oViewConf->getSelfLink()}]" method="post">
    [{$oViewConf->getHiddenSid()}]
    <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
    <input type="hidden" name="fnc" value="">
    <input type="hidden" name="oxid" value="[{$oxid}]">
    <input type="hidden" name="editval[d3_extsearch_attribute2object__oxid]" value="[{$oxid}]">

    <table cellspacing="0" cellpadding="0" border="0" width="98%">
        <tr>
            <!-- Anfang rechte Seite -->
            <td valign="top" class="edittext" align="left" width="50%">

                <table cellspacing="0" cellpadding="0" border="0">
                    [{block name="d3_admin_category_extsearch_form"}]
                        <tr>
                            <td class="edittext" colspan="2">
                                <h3>[{oxmultilang ident="D3_EXTSEARCH_SETTINGS"}] [{oxinputhelp ident="D3_EXTSEARCH_SETTINGS_DESC"}]</h3>
                            </td>
                        </tr>

                        <tr id="d3notuse4filter">
                            <td class="edittext">
                                [{oxmultilang ident="D3_EXTSEARCH_CATEGORY_NOTUSE4FILTER"}]
                            </td>
                            <td class="edittext">
                                <input type="hidden" name="editval[oxcategories__d3notuse4filter]" value="0">
                                <input type="checkbox" name="editval[oxcategories__d3notuse4filter]" id="d3notuse4filter" value="1" class="edittext" [{if $edit->oxcategories__d3notuse4filter->value == 1}]CHECKED[{/if}] [{$readonly}]>
                            </td>
                        </tr>
                    [{/block}]
                    <tr>
                        <td class="edittext">
                        </td>
                        <td class="edittext"><br>
                            <input type="submit" class="edittext" name="save" value="[{oxmultilang ident="GENERAL_SAVE"}]" onClick="document.myedit.fnc.value='save'"" [{$readonly}]><br>
                        </td>
                    </tr>
                </table>
            </td>
            <!-- Anfang rechte Seite -->
            <td valign="top" class="edittext" align="left">
                <table cellspacing="0" cellpadding="0" border="0">
                    [{block name="d3_admin_category_extsearch_form2"}]
                        <tr>
                            <td class="edittext" colspan="2">
                                <h3>&nbsp;</h3>
                            </td>
                        </tr>

                        <tr>
                            <td class="edittext" colspan="2">
                            </td>
                        </tr>
                    [{/block}]
                </table>
            </td>
            <!-- Ende rechte Seite -->
        </tr>
    </table>

</form>

[{include file="bottomnaviitem.tpl"}]
[{include file="bottomitem.tpl"}]

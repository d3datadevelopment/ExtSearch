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
                    [{block name="d3_admin_attribute_extsearch_form"}]
                        <tr>
                            <td class="edittext" colspan="2">
                                <h3>[{oxmultilang ident="D3_EXTSEARCH_SETTINGS"}] [{oxinputhelp ident="D3_EXTSEARCH_SETTINGS_DESC"}]</h3>
                            </td>
                        </tr>

                        <tr id="d3notuse4filter">
                            <td class="edittext">
                                <label for="d3notuse4filter">[{oxmultilang ident="D3_EXTSEARCH_ATTRIBUTE_NOTUSE4FILTER"}]</label>
                            </td>
                            <td class="edittext">
                                <input type="hidden" name="editval[oxattribute__d3notuse4filter]" value="0">
                                <input type="checkbox" name="editval[oxattribute__d3notuse4filter]" id="d3notuse4filter" value="1" class="edittext" [{if $edit->oxattribute__d3notuse4filter->value == 1}]CHECKED[{/if}] [{$readonly}]>
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
                    [{block name="d3_admin_attribute_extsearch_form2"}]
                        <tr>
                            <td class="edittext" colspan="2">
                                <h3>&nbsp;</h3>
                            </td>
                        </tr>

                        <tr>
                            <td class="edittext" colspan="2">
                                <p>
                                    <input [{$readonly}] type="button" value="[{oxmultilang ident="D3_EXTSEARCH_ASSIGNCATEGORIES"}]" class="edittext" onclick="showDialog('&cl=d3_attribute_extsearch&aoc=1&oxid=[{$oxid}]');">
                                    [{oxinputhelp ident="D3_EXTSEARCH_ASSIGNCATEGORIES_DESC"}]
                                </p>

                                [{if false == $oModCfg_d3_extsearch->getValue('blExtSearch_useAttributeListAssignments')}]
                                    <p>
                                        [{oxmultilang ident="D3_EXTSEARCH_NAVI_ATTRIBUTELIST_ASSIGNMENT_NA"}] [{oxinputhelp ident="D3_EXTSEARCH_NAVI_ATTRIBUTELIST_ASSIGNMENT_NA_DESC"}]
                                    </p>
                                [{/if}]
                            </td>
                        </tr>

                        <tr>
                            <td class="edittext" colspan="2">
                                <p>
                                    <input [{$readonly}] type="button" value="[{oxmultilang ident="D3_EXTSEARCH_ASSIGNMANUFACTURERS"}]" class="edittext" onclick="showDialog('&cl=d3_attribute_extsearch&aoc=2&oxid=[{$oxid}]');">
                                    [{oxinputhelp ident="D3_EXTSEARCH_ASSIGNMANUFACTURERS_DESC"}]
                                </p>

                                [{if false == $oModCfg_d3_extsearch->getValue('blExtSearch_useAttributeListAssignments')}]
                                    <p>
                                        [{oxmultilang ident="D3_EXTSEARCH_NAVI_ATTRIBUTELIST_ASSIGNMENT_NA"}] [{oxinputhelp ident="D3_EXTSEARCH_NAVI_ATTRIBUTELIST_ASSIGNMENT_NA_DESC"}]
                                    </p>
                                [{/if}]
                            </td>
                        </tr>

                        <tr>
                            <td class="edittext" colspan="2">
                                <p>
                                    <input [{$readonly}] type="button" value="[{oxmultilang ident="D3_EXTSEARCH_ASSIGNVENDORS"}]" class="edittext" onclick="showDialog('&cl=d3_attribute_extsearch&aoc=3&oxid=[{$oxid}]');">
                                    [{oxinputhelp ident="D3_EXTSEARCH_ASSIGNVENDORS_DESC"}]
                                </p>

                                [{if false == $oModCfg_d3_extsearch->getValue('blExtSearch_useAttributeListAssignments')}]
                                    <p>
                                        [{oxmultilang ident="D3_EXTSEARCH_NAVI_ATTRIBUTELIST_ASSIGNMENT_NA"}] [{oxinputhelp ident="D3_EXTSEARCH_NAVI_ATTRIBUTELIST_ASSIGNMENT_NA_DESC"}]
                                    </p>
                                [{/if}]
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

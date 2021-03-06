[{include file="headitem.tpl" title="d3tbclextsearch_settings_browser"|oxmultilangassign}]

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

[{if $oView->getValueStatus() == 'error'}]
    <form name="myedit" id="myedit" enctype="multipart/form-data" action="[{$oViewConf->getSelfLink()}]" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
        [{$oViewConf->getHiddenSid()}]
        <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
        <input type="hidden" name="fnc" value="save">
        <input type="hidden" name="oxid" value="[{$oxid}]">
        <input type="hidden" name="editval[oxid]" value="[{$oxid}]">

        <b>[{oxmultilang ident="D3_EXTSEARCH_MAIN_NOCONFIG_DESC"}]</b><br>
        <input type="submit" value="[{oxmultilang ident="D3_EXTSEARCH_MAIN_NOCONFIG_BTN"}]">
    </form>
[{else}]

    <form name="myedit" id="myedit" enctype="multipart/form-data" action="[{$oViewConf->getSelfLink()}]" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
        [{$oViewConf->getHiddenSid()}]
        <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
        <input type="hidden" name="fnc" value="save">
        <input type="hidden" name="oxid" value="[{$oxid}]">
        <input type="hidden" name="editval[oxid]" value="[{$oxid}]">

        <fieldset>
            <legend>[{oxmultilang ident="D3_EXTSEARCH_PLUGIN_SETTINGS"}]</legend>
            <table style="width:100%;padding:0;border:0">
                [{block name="d3_cfg_extsearch_plugins__form"}]
                    <tr>
                        <td class="edittext ext_edittext">
                              <label for="enablePluginBrowserInstall">[{oxmultilang ident="D3_EXTSEARCH_PLUGIN_SEARCHACTIVE"}]</label>
                        </td>
                        <td class="edittext ext_edittext">
                            <input type="hidden" name="value[blExtSearch_enablePluginBrowserInstall]" value="0">
                            <input id="enablePluginBrowserInstall" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_enablePluginBrowserInstall]" value='1' [{if $edit->getEditValue('blExtSearch_enablePluginBrowserInstall') == 1}]checked[{/if}]>
                            [{oxinputhelp ident="D3_EXTSEARCH_PLUGIN_SEARCHACTIVE_DESC"}]
                        </td>
                    </tr>

                    <tr>
                        <td class="edittext ext_edittext">
                              <label for="enablePluginLink">[{oxmultilang ident="D3_EXTSEARCH_PLUGIN_INSTALLLINK"}]</label>
                        </td>
                        <td class="edittext ext_edittext">
                            <input type="hidden" name="value[blExtSearch_enablePluginLink]" value="0">
                            <input id="enablePluginLink" class="edittext ext_edittext" type="checkbox" name="value[blExtSearch_enablePluginLink]" value='1' [{if $edit->getEditValue('blExtSearch_enablePluginLink') == 1}]checked[{/if}]>
                            [{oxinputhelp ident="D3_EXTSEARCH_PLUGIN_INSTALLLINK_DESC"}]
                        </td>
                    </tr>
                    <tr>
                        <td class="edittext ext_edittext">
                              <label for="PluginIcon">[{oxmultilang ident="D3_EXTSEARCH_PLUGIN_SEARCHICON"}]</label>
                        </td>
                        <td class="edittext ext_edittext">
                            <input id="PluginIcon" class="edittext ext_edittext" type="file" name="value[sExtSearch_PluginIcon]" value='[{$edit->getEditValue('sExtSearch_PluginIcon')}]'><br>
                            [{if $edit->getEditValue('sExtSearch_PluginIcon')}][{$edit->getEditValue('sExtSearch_PluginIcon')}] <img src="[{$oViewConf->getBaseDir()}][{$edit->getEditValue('sExtSearch_PluginIcon')}]" style="margin-top: 3px;">[{else}][{oxmultilang ident="D3_EXTSEARCH_PLUGIN_CHOOSEICON"}][{/if}]
                            [{oxinputhelp ident="D3_EXTSEARCH_PLUGIN_SEARCHICON_DESC"}]
                        </td>
                    </tr>
                [{/block}]
            </table>
        </fieldset>


        <table style="width:100%;">
            <tr>
                <td class="edittext ext_edittext" style="text-align: left;"><br>
                    <span class="d3modcfg_btn icon d3color-green">
                        <button type="submit" name="save">
                            <i class="fa fa-check-circle fa-inverse"></i>[{oxmultilang ident="D3_EXTSEARCH_PLUGIN_SAVE"}]
                        </button>
                    </span>
                </td>
            </tr>
        </table>


    </form>

    <fieldset>
        <legend>[{oxmultilang ident="D3_EXTSEARCH_PLUGIN_GENERATE"}]</legend>

        [{oxmultilang ident="D3_EXTSEARCH_PLUGIN_GENERATEFILE"}]
        <form name="myedit2" id="myedit2" action="[{$oViewConf->getSelfLink()}]" method="post">
            [{$oViewConf->getHiddenSid()}]
            <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
            <input type="hidden" name="fnc" value="generatePluginFile">
            <input type="hidden" name="oxid" value="[{$oxid}]">
            <input type="hidden" name="editval[oxid]" value="[{$oxid}]">

            <span class="d3modcfg_btn d3color-blue">
                [{assign var="escapedCl" value=$oViewConf->getActiveClassName()|oxescape:"url"}]
                [{assign var="clParam" value="cl="|cat:$escapedCl}]
                <input type="submit" name="save" value="[{oxmultilang ident="D3_EXTSEARCH_PLUGIN_STARTGENERATING"}]" onclick="window.open('[{$oViewConf->getSelfLink()}]&sid=[{$shop->sid}]&[{$clParam}]&fnc=generatePluginFile', 'generate_plugin', 'width=300, height=300, left=100'); return false;">
            </span>
            <br><br>
            [{oxmultilang ident="D3_EXTSEARCH_PLUGIN_GENERATENOTICE"}]
        </form>
        [{oxinputhelp ident="D3_EXTSEARCH_PLUGIN_GENERATE_DESC"}]
    </fieldset>
[{/if}]

[{include file="d3_cfg_mod_inc.tpl"}]

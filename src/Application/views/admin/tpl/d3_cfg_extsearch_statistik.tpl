[{include file="headitem.tpl" title="d3tbclextsearch_settings_statistik"|oxmultilangassign}]

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

    function showGraph(sSearchWord, sFilters, iLang)
    {
        document.popuptransfer.target='_new';
        document.popuptransfer.fnc.value='generateStat';
        document.popuptransfer.searchword.value= sSearchWord;
        document.popuptransfer.searchparams.value= sFilters;
        document.popuptransfer.lang.value= iLang;
        document.popuptransfer.submit();
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

    .edittext select.editinput {
        width: auto;
    }

    .fa-stack.disabled {
        color: silver;
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

<form name="popuptransfer" id="popuptransfer" action="[{$oViewConf->getSelfLink()}]" target="" method="post">
    [{$oViewConf->getHiddenSid()}]
    <input type="hidden" name="oxid" value="[{$oxid}]">
    <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
    <input type="hidden" name="fnc" value="">
    <input type="hidden" name="actshop" value="[{$shop->id}]">
    <input type="hidden" name="editlanguage" value="[{$editlanguage}]">
    <input type="hidden" name="statparams[type]" value="[{$aParams.type}]">
    <input type="hidden" name="statparams[time]" value="[{$aParams.time}]">
    <input type="hidden" name="searchword" value="">
    <input type="hidden" name="searchparams" value="">
    <input type="hidden" name="lang" value="">
</form>

<form name="myedit" id="myedit" action="[{$oViewConf->getSelfLink()}]" method="post">
    [{$oViewConf->getHiddenSid()}]
    <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
    <input type="hidden" name="fnc" value="generateStatList">
    <input type="hidden" name="oxid" value="[{$oxid}]">
    <input type="hidden" name="editval[oxid]" value="[{$oxid}]">

<table style="border: 0; width:98%;">
    <tr>
        <td style="vertical-align: top;" class="edittext">

            [{if $edit->getErrorMessage()}]
                <div class="extension_error">
                    [{$edit->getErrorMessage()}]
                </div>
            [{/if}]

            [{if $oView->getValueStatus() == 'error'}]
                <span style="font-weight: bold;">[{oxmultilang ident="D3_EXTSEARCH_MAIN_NOCONFIG_DESC"}]</span><br>
                <span class="d3modcfg_btn">
                    <input type="submit" name="save" value="[{oxmultilang ident="D3_EXTSEARCH_MAIN_NOCONFIG_BTN"}]">
                </span>
            [{else}]
                <fieldset>
                    <table style="width: 100%;padding:0;border:0">
                        <colgroup>
                            <col style="width:35%">
                            <col style="width:35%">
                            <col style="width:30%">
                        </colgroup>
                        <tr>
                            <td>
                                <label for="stattype">[{oxmultilang ident="D3_EXTSEARCH_STAT_TYPE"}]</label>
                                <select id="stattype" name="statparams[type]">
                                    [{if $aTimes|count}]
                                        <option value="hitless" [{if $aParams.type == 'hitless'}]selected[{/if}]>[{oxmultilang ident="D3_EXTSEARCH_STAT_TYPEHITLESS"}]</option>
                                        <option value="mosthits" [{if $aParams.type == 'mosthits'}]selected[{/if}]>[{oxmultilang ident="D3_EXTSEARCH_STAT_TYPEMOSTHITS"}]</option>
                                        <option value="mostsearches" [{if $aParams.type == 'mostsearches'}]selected[{/if}]>[{oxmultilang ident="D3_EXTSEARCH_STAT_TYPEMOSTSEARCHES"}]</option>
                                    [{else}]
                                        <option value="" disabled>[{oxmultilang ident="D3_EXTSEARCH_STAT_NOHITS"}]</option>
                                    [{/if}]
                                </select>
                            </td>
                            <td>
                                <label for="statlang">[{oxmultilang ident="D3_EXTSEARCH_STAT_LANG"}]</label>
                                <select id="statlang" name="statparams[lang]">
                                    [{foreach from=$oView->getLangList() item="oLang"}]
                                        <option value="[{$oLang->id}]" [{if $aParams.lang == $oLang->id}]selected[{/if}]>[{$oLang->name}]</option>
                                    [{/foreach}]
                                </select>
                            </td>
                            <td>
                                <label for="stattime">[{oxmultilang ident="D3_EXTSEARCH_STAT_TIME"}]</label>
                                <select id="stattime" name="statparams[time]">
                                    [{if $aTimes|count}]
                                        [{foreach from=$aTimes item="aTime"}]
                                            <option value="[{$aTime.value}]" [{if $aParams.time == $aTime.value}]selected[{/if}]>[{$aTime.output}]</option>
                                        [{/foreach}]
                                    [{else}]
                                        <option value="" disabled>[{oxmultilang ident="D3_EXTSEARCH_STAT_NOHITS"}]</option>
                                    [{/if}]
                                </select>
                            </td>
                            <td>
                                <span class="d3modcfg_btn">
                                    <input [{if !$aTimes|count}] disabled [{/if}] type="submit" name="save" value="[{oxmultilang ident="D3_EXTSEARCH_STAT_GENERATESTAT"}]">
                                </span>
                            </td>

                        </tr>
                        <tr>
                            <td colspan="4"><hr></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">
                                [{oxmultilang ident="D3_EXTSEARCH_STAT_SEARCHWORD"}]
                            </td>
                            <td style="font-weight: bold;">
                                [{if $aParams.type == 'mosthits'}][{oxmultilang ident="D3_EXTSEARCH_STAT_HITS"}][{else}][{oxmultilang ident="D3_EXTSEARCH_STAT_SEARCHES"}][{/if}]
                            </td>
                            <td style="font-weight: bold;" colspan="2">
                                [{oxmultilang ident="D3_EXTSEARCH_STATISTIC_GRAPH"}]
                            </td>
                        </tr>
                        [{if $oView->getStatList()}]
                            [{assign var="blWhite" value=""}]
                            [{assign var="_cnt" value=0}]
                            [{foreach from=$oView->getStatList() item="searchword"}]
                                [{assign var="_cnt" value=$_cnt+1}]
                                [{if $listitem->blacklist == 1}]
                                    [{assign var="listclass" value="listitem3"}]
                                [{else}]
                                    [{assign var="listclass" value="listitem"|cat:$blWhite}]
                                [{/if}]
                                <tr>
                                    <td class="[{$listclass}]" style="vertical-align: top;">
                                        <b>[{$searchword->sWord}]</b>
                                        [{if $searchword->aFilters}][{*oxmultilang ident="D3_EXTSEARCH_STATISTIC_FURTHERFILTERS"*}]
                                            [{foreach from=$searchword->aFilters item="oFilter"}]
                                                <div style="padding-left: 10px;">[{$oFilter->desc}]: [{$oFilter->value}]</div>
                                            [{/foreach}]
                                        [{/if}]
                                    </td>
                                    <td class="[{$listclass}]" style="vertical-align: top;">
                                        [{$searchword->iCount}]
                                    </td>
                                    <td class="[{$listclass}]" style="vertical-align: top;" colspan="2">
                                        [{if $oView->checkReportBaseClass()}]
                                            [{if $searchword->blGraph}]
                                                <span class="fa-stack fa-lg">
                                                    <i class="fa fa-square fa-stack-2x"></i>
                                                    <a id="del.[{$_cnt}]" class="fa fa-bar-chart fa-stack-1x fa-inverse" href="#" onclick="showGraph('[{$searchword->sWord}]', '[{$searchword->sFilters}]', '[{$searchword->iLang}]'); return false;"></a>
                                                </span>
                                            [{else}]
                                                <span class="fa-stack fa-lg disabled">
                                                    <i class="fa fa-bar-chart fa-stack-1x"></i>
                                                    <i class="fa fa-ban fa-stack-2x"></i>
                                                </span>
                                            [{/if}]
                                        [{else}]
                                            [{oxmultilang ident="D3_EXTSEARCH_STAT_NOREPORTBASE"}] [{oxinputhelp ident="D3_EXTSEARCH_STAT_NOREPORTBASE_DESC"}]
                                        [{/if}]
                                    </td>
                                </tr>
                                [{if $blWhite == "2"}]
                                    [{assign var="blWhite" value=""}]
                                [{else}]
                                    [{assign var="blWhite" value="2"}]
                                [{/if}]
                            [{/foreach}]
                        [{elseif $aParams}]
                            <tr>
                                <td colspan="3" class="listitem" style="text-align: center;">
                                    [{oxmultilang ident="D3_EXTSEARCH_STAT_NOITEMS"}] [{oxinputhelp ident="D3_EXTSEARCH_STAT_NOITEMS_DESC"}]
                                </td>
                            </tr>
                        [{else}]
                            <tr>
                                <td colspan="3" class="listitem" style="text-align: center;">
                                    [{oxmultilang ident="D3_EXTSEARCH_STAT_SELECTFILTER"}]
                                </td>
                            </tr>
                        [{/if}]
                    </table>
                </fieldset>
            [{/if}]
        </td>
    </tr>
</table>
</form>

[{include file="d3_cfg_mod_inc.tpl"}]

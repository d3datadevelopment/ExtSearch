<br>
[{if $drawStat}]
    [{foreach from=$aStats item="aStat"}]
    <table class="report_searchstrings_table" style="padding:0;width:800px">
        <tr>
            <td class="report_searchstrings_td">
                <table style="width:100%;padding:0">
                    <tr>
                        <td colspan="[{$aStat.allCols}]" style="text-align: center">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="[{$aStat.allCols}]" style="text-align: center"><b>[{$aStat.sHeadline}] [{if $aStat.sFilters}]([{$aStat.sFilters}])[{/if}]</b></td>
                    </tr>
                    <tr>
                        <td colspan="[{$aStat.allCols}]" style="text-align: center">&nbsp;</td>
                    </tr>
                    <tr>
                        <td></td>
                        [{foreach name=outer item=classe from=$aStat.classes}]
                            [{foreach key=key item=curr_point from=$classe}]
                                <td class="[{$curr_point}]">[{$key}]</td>
                            [{/foreach}]
                        [{/foreach}]
                        <td class="report_searchstrings_scale_empty_right"></td>
                    </tr>
                    [{foreach name=outer item=percent from=$aStat.percents}]
                        [{foreach key=key item=curr_point from=$percent}]
                            <tr>
                                <td class="report_searchstrings_scale">[{$key}][{$aStat.sSearchDate}]</td><td colspan="[{$aStat.cols}]"><img src="[{$oViewConf->getBaseDir()}]/out/admin/img/slide.jpg" height="20" width="[{$curr_point}]%"></td><td></td>
                            </tr>
                        [{/foreach}]
                    [{/foreach}]
                    <tr>
                        <td>&nbsp;</td><td>&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br>
    [{/foreach}]
    [{else}]
<b>[{oxmultilang ident="GENERAL_NODATA"}]</b>
[{/if}]
<br>


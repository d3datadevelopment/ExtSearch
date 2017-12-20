<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=[{$sCharSet}]">
        <title>[{oxmultilang ident="D3_EXTSEARCH_MAIN_SORTDEBUG"}]</title>
    </head>
    <body style='font: 12px Trebuchet MS,Tahoma,Verdana,Arial,Helvetica,sans-serif;'>
        <form action="[{$sFormUrl}]" style="float: left; margin-right: 5px;">
            [{$sHiddenSid}]
            <input type="hidden" name="cl" value="[{$sClass}]">
            <input type="hidden" name="fnc" value="[{$sFnc}]">
            <input type="text" name="searchparam" value="[{$sSearchParam}]">
            <input type="submit" value="[{oxmultilang ident="D3_EXTSEARCH_MAIN_SORTDEBUG_START"}]">
        </form>

        [{oxmultilang ident="D3_EXTSEARCH_MAIN_SORTDEBUG_DESC"}]

        <hr style="clear: both; float: none;">

        [{if $aAllList|count}]
            <table cellspacing='0' style='font-size: 10px; border: 1px solid silver;'>
                [{capture name="fieldNameLine"}]
                    <tr>
                        <td style='font-weight: bold; padding: 2px; border: 1px solid black; '>No:</td>
                        [{foreach from=$aUsedFields item="sUsedField"}]
                            <td style='font-weight: bold; padding: 2px; border: 1px solid black; '>[{$sUsedField}]</td>
                        [{/foreach}]
                    </tr>
                [{/capture}]

                [{$smarty.capture.fieldNameLine}]

                [{foreach from=$aAllList item="aItem" name="itemlist"}]
                    <tr>
                        <td style='border: 1px solid silver;'>[{$smarty.foreach.itemlist.iteration}]</td>
                        [{foreach from=$aItem key="sKey" item="sItem"}]
                            [{if $sKey|in_array:$aUsedFields}]
                                <td style='border: 1px solid silver;'>[{$sItem}]</td>
                            [{/if}]
                        [{/foreach}]
                    </tr>

                    [{if $smarty.foreach.itemlist.iteration % 20 == 0}]
                        [{$smarty.capture.fieldNameLine}]
                    [{/if}]
                [{/foreach}]

            </table>
        [{/if}]
    </body>
</html>
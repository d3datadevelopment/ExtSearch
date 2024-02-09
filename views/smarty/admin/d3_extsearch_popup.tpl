[{assign var="iRefreshTime" value=$iRefreshTime|default:0}]

<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=[{$sCharSet}]">
        <title>[{$sTitle}]</title>
        [{if $sRefreshUrl}]
            <meta http-equiv="refresh" content="[{$iRefreshTime}]; URL=[{$sRefreshUrl}]">
        [{/if}]
    </head>
    <body style='font: 12px Trebuchet MS,Tahoma,Verdana,Arial,Helvetica,sans-serif;'>

        [{if $sMessage}]
            <br>
            <br>
            [{$sMessage}]
            <br>
        [{/if}]

        [{if $iProgressPercent}]
            <br>
            <div style='position: relative; background-color:#B4D2F5; border:1px solid #000000; height:15px; margin:auto auto auto 10px; width:100px;'>
                <div style='background-color:#1A4782; height:15px; width:[{$iProgressPercent}]px;'></div>
                <div style='border-style: none; color: white; line-height:15px; position:absolute; text-align:center; top:0; width:100px;'>
                    [{assign var="sText" value="D3_EXTSEARCH_MAIN_GENERATOR_PROCESSING2"|oxmultilangassign}]
                    [{$sText|sprintf:$iProgressPercent}]
                </div>
            </div>
        [{/if}]

        [{if $blWait}]
            <br>
            <span style='font-weight: bold;'>[{oxmultilang ident="D3_EXTSEARCH_MAIN_GENERATOR_WAIT"}]</span>
        [{else}]
            <br>
            <a href='#' onClick='window.close();'>[{oxmultilang ident="D3_EXTSEARCH_MAIN_GENERATOR_CLOSEWND"}]</a>
        [{/if}]
    </body>
</html>
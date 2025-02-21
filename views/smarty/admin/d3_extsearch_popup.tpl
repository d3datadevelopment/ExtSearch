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
            [{assign var="sText" value="D3_EXTSEARCH_MAIN_GENERATOR_PROCESSING2"|oxmultilangassign}]
            <label for="progress">[{$sText|sprintf:$iProgressPercent}]</label><br>
            <progress id="progress" value="[{$iProgressPercent}]" max="100"> [{$sText|sprintf:$iProgressPercent}] </progress>
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
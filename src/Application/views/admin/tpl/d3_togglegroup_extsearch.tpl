[{strip}]
    [{oxscript include="js/libs/jquery.min.js"}]
    [{oxscript add='var jQ = $.noConflict();'}]
    [{if !$edit->getEditValue($sToggleOptionName)}]
        [{oxscript add='jQ("'|cat:$sToggleOptionClass|cat:'").hide();'}]
    [{/if}]

    jQ("[{$sToggleOptionClass}]").toggle();
[{/strip}]
<button type="submit" class="submitButton largeButton btn btn-primary [{* for Bootstrap 3 *}] btn-outline-primary [{* for Bootstrap 4 *}] btn-sm" onclick="d3_extsearch_popup.popup.load();">[{oxmultilang ident="D3_EXTSEARCH_EXT_ASSIGNFILTER"}]</button>

<button id="d3search[{$type}]__multiclear__[{$sIdKey}]" type="submit" class="submitButton largeButton btn btn-secondary [{* for Bootstrap 3 *}] btn-outline-secondary [{* for Bootstrap 4 *}] btn-sm" onclick="d3_extsearch_popup.popup.load();">[{oxmultilang ident="D3_EXTSEARCH_EXT_UNASSIGNFILTER"}]</button>

[{capture name="d3JsFnc"}][{strip}]
    $('#d3search[{$type}]__multiclear__[{$sIdKey}]').click(function(){
        $(this).parent().children('input:checkbox').each(function() {
            $(this).removeAttr('checked');
        });
    });
[{/strip}][{/capture}]
[{oxscript add=$smarty.capture.d3JsFnc}]
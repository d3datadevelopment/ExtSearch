<div class="clearfix"></div>
<button type="submit" class="submitButton largeButton btn [{if $oModCfg_d3_extsearch->isThemeIdMappedTo('flow')}]btn-primary [{* for Bootstrap 3 *}][{else}]btn-outline-primary [{* for Bootstrap 4 *}][{/if}] btn-sm" onclick="d3_extsearch_popup.popup.load();">[{oxmultilang ident="D3_EXTSEARCH_EXT_ASSIGNFILTER"}]</button>

<button id="d3search[{$type}]__multiclear__[{$sIdKey}]" type="submit" class="submitButton largeButton btn [{if $oModCfg_d3_extsearch->isThemeIdMappedTo('flow')}]btn-warning [{* for Bootstrap 3 *}][{else}]btn-outline-secondary [{* for Bootstrap 4 *}][{/if}] btn-sm" onclick="d3_extsearch_popup.popup.load();">[{oxmultilang ident="D3_EXTSEARCH_EXT_UNASSIGNFILTER"}]</button>

[{capture name="d3JsFnc"}][{strip}]
    $('#d3search[{$type}]__multiclear__[{$sIdKey}]').click(function(){
        $(this).parent().find('input:checkbox').each(function() {
            $(this).removeAttr('checked');
        });
    });
[{/strip}][{/capture}]
[{oxscript add=$smarty.capture.d3JsFnc}]
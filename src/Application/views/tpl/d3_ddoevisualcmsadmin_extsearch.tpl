[{block name="d3_cfg_extsearch_visualcms"}]

[{capture name="sOxidContent"}][{strip}]
    [{include file=$sOriginalTplName}]
[{/strip}][{/capture}]

[{capture name="sSearchContent"}][{strip}]
<div role="tabpanel" class="tab-pane" id="tab_settings_advanced">
[{/strip}][{/capture}]

[{capture name="sModuleContent"}]
<div role="tabpanel" class="tab-pane" id="tab_settings_advanced">
    <div class="form-group">
        <label>[{oxmultilang ident="D3_EXTSEARCH_TRANSL"}]</label>
        <div class="checkbox">
            <label>
                <input type="hidden" name="editval[oxcontents__d3issearchable]" value="0">
                <input type="checkbox" name="editval[oxcontents__d3issearchable]" id="elm_edit_d3issearchable" value="1" />
                [{oxmultilang ident="D3_EXTSEARCH_CONTENT_SEARCHABLE"}]
            </label>
        </div>
    </div>
[{/capture}]

[{$smarty.capture.sOxidContent|replace:$smarty.capture.sSearchContent:$smarty.capture.sModuleContent}]

[{capture name="d3JsFnc"}][{strip}]
    $('ul.nav-tabs').find('li a[href="#tab_settings_advanced"]').click(function() {
        var CmsId = $('div.selectize-input').find('div.item').attr('data-value');
        var isNewItem = $('#elm_edit_new').is(":checked");

        if (CmsId != 'CMSFOLDER_NONE' && !isNewItem) {
            sURI = "[{$oViewConf->getSelfLink()}]" + "&cl=[{$oViewConf->getActiveClassName()}]&fnc=d3GetIsSearchStatus" + "&id=" + encodeURIComponent(CmsId);
            sURI = sURI.replace(/&amp;/g, '&');

            $.ajax({
                url: sURI,
                type: "GET",
                success: function (a) {
                    $('#elm_edit_d3issearchable').prop("checked", a == 'true');
                }
            })
        } else {
            $('#elm_edit_d3issearchable').prop("checked", false);
        }
    });
[{/strip}][{/capture}]
[{oxscript add=$smarty.capture.d3JsFnc}]
[{oxscript}]

[{/block}]
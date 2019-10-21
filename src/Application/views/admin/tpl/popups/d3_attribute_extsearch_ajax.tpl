[{include file="popups/headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign}]

[{assign var="oxajax" value=$oAjaxView->getColumns()}]

<script type="text/javascript">
    initAoc = function()
    {
        try {
            YAHOO.oxid.container1 = new YAHOO.oxid.aoc(
                'container1',
                [
                    [{foreach from=$oxajax.container1 item="aItem" key="iKey"}]
                    [{$sSep}][{strip}]
                    {
                        key: '_[{$iKey}]',
                        ident: [{if $aItem.4}]true[{else}]false[{/if}]
                        [{if !$aItem.4}],
                        label: '[{oxmultilang ident="GENERAL_AJAX_SORT_"|cat:$aItem.0|oxupper}]',
                        visible: [{if $aItem.2}]true[{else}]false[{/if}]
                        [{/if}]
                    }
                    [{/strip}]
                    [{assign var="sSep" value=","}]
                    [{/foreach}]
                ],
                '[{$oViewConf->getAjaxLink()}]cmpid=container1&container=[{$oAjaxView->getContainerKey()}]&synchoxid=[{$oxid}]'
            );

            [{assign var="sSep" value=""}]

            YAHOO.oxid.container2 = new YAHOO.oxid.aoc(
                'container2',
                [
                    [{foreach from=$oxajax.container2 item="aItem" key="iKey"}]
                        [{$sSep}][{strip}]
                        {
                            key:'_[{$iKey}]',
                            ident: [{if $aItem.4}]true[{else}]false[{/if}]
                            [{if !$aItem.4}],
                                label: '[{oxmultilang ident="GENERAL_AJAX_SORT_"|cat:$aItem.0|oxupper}]',
                                visible: [{if $aItem.2}]true[{else}]false[{/if}],
                                formatter: YAHOO.oxid.aoc.custFormatter
                            [{/if}]}
                        [{/strip}]
                        [{assign var="sSep" value=","}]
                    [{/foreach}]
                ],
                '[{$oViewConf->getAjaxLink()}]cmpid=container2&container=[{$oAjaxView->getContainerKey()}]&oxid=[{$oxid}]'
            );

            YAHOO.oxid.container1.getDropAction = function()
            {
                return 'fnc=addAttributeObject';
            }

            YAHOO.oxid.container2.getDropAction = function()
            {
                return 'fnc=removeAttributeObject';
            }
        } catch (ex) {
            console.log(ex);
        }
    }
    $E.onDOMReady( initAoc );
</script>

    <table style="width: 100%">
        <colgroup>
            <col span="2" style="width: 50%" />
        </colgroup>
        <tr class="edittext">
            <td colspan="2">[{oxmultilang ident="GENERAL_AJAX_DESCRIPTION"}]<br>[{oxmultilang ident="GENERAL_FILTERING"}]<br /><br /></td>
        </tr>
        <tr class="edittext">
            <td style="text-align: center"><b>[{oxmultilang ident=$oAjaxView->getLeftColumnTitle()}]</b></td>
            <td style="text-align: center"><b>[{oxmultilang ident=$oAjaxView->getRightColumnTitle()}]</b></td>
        </tr>
        <tr>
            <td style="vertical-align: top" id="container1"></td>
            <td style="vertical-align: top" id="container2"></td>
        </tr>
        <tr>
            <td class="oxid-aoc-actions"><input type="button" value="[{oxmultilang ident="GENERAL_AJAX_ASSIGNALL"}]" id="container1_btn"></td>
            <td class="oxid-aoc-actions"><input type="button" value="[{oxmultilang ident="GENERAL_AJAX_UNASSIGNALL"}]" id="container2_btn"></td>
        </tr>
    </table>

</body>
</html>


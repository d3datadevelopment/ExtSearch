[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign box="list"}]

[{if $readonly}]
    [{assign var="readonly" value="readonly disabled"}]
[{else}]
    [{assign var="readonly" value=""}]
[{/if}]

[{assign var="where" value=$oView->getListFilter()}]

<script type="text/javascript">
    window.onload = function () {
        top.reloadEditFrame();
    }

    function EditThis( sID)
    {
        let oTransfer = parent.edit.document.getElementById("transfer");
        oTransfer.oxid.value=sID;
        oTransfer.cl.value='[{if $actlocation}][{$actlocation|oxescape:"javascript"}][{else}][{$default_edit|oxescape:"javascript"}][{/if}]';

        //forcing edit frame to reload after submit
        top.forceReloadingEditFrame();

        let oSearch = document.getElementById("search");
        oSearch.oxid.value=sID;
        oSearch.submit();
    }
</script>

<div id="liste">
    <form name="search" id="search" action="[{$oViewConf->getSelfLink()}]" method="post">
        [{include file="_formparams.tpl" cl=$oViewConf->getActiveClassName() lstrt=$lstrt actedit=$actedit oxid=$oxid fnc="" language=$actlang editlanguage=$actlang}]
        <input type="hidden" name="delete_oxtime" value="">
        <input type="hidden" name="delete_oxmodid" value="">
        <input type="hidden" name="delete_oxtype" value="">

        <table style="padding:0;border:0;width:100%">
            <colgroup>
                <col style="width:30%">
                <col style="width:50%">
                <col style="width:9%">
                <col style="width:2%">
            </colgroup>
            <tr class="listitem">
                <td style="height:20px; vertical-align: middle" class="listfilter first" nowrap>
                    <div class="r1"><div class="b1">
                        <input class="listedit" type="text" size="50" maxlength="250" name="where[[{$listTable}]][word]" value="[{$where.d3_extsearch_term.word}]" [{include file="help.tpl" helpid=searchfieldoxdynamic}]>
                        [{oxinputhelp ident="D3_EXTSEARCH_SYNED_WORD_DESC"}]
                    </div></div>
                </td>
                <td style="height:20px;vertical-align: middle" class="listfilter" nowrap>
                    <div class="r1"><div class="b1">
                    </div></div>
                </td>
                <td style="height:20px; vertical-align: middle" colspan="2" class="listfilter" nowrap>
                    <div class="r1"><div class="b1">
                        <div class="find">
                            <input class="listedit" type="submit" name="submitit" value="[{oxmultilang ident="GENERAL_SEARCH"}]" onClick="document.search.lstrt.value=0;">
                        </div>
                        <input class="listedit" type="text" size="8" maxlength="128" name="where[[{$listTable}]][synset_id]" value="[{$where.d3_extsearch_term.synset_id}]" [{include file="help.tpl" helpid=searchfieldoxdynamic}]>
                        [{oxinputhelp ident="D3_EXTSEARCH_SYNED_SYNSETID_DESC"}]
                    </div></div>
                </td>
            </tr>
            <tr>
                <td class="listheader first" style="height:15px">&nbsp;
                    <a href="#" onclick="top.oxid.admin.setSorting( document.search, 'd3_extsearch_term', 'word', 'asc');document.search.submit();" class="listheader">[{oxmultilang ident="D3_EXTSEARCH_SYNED_WORD"}]</a>
                </td>
                <td class="listheader" style="height:15px">&nbsp;
                    [{oxmultilang ident="D3_EXTSEARCH_SYNED_ALTWORD"}]
                </td>
                <td class="listheader" style="height:15px">&nbsp;
                    <a href="#" onclick="top.oxid.admin.setSorting( document.search, 'd3_extsearch_term', 'synset_id', 'asc');document.search.submit();" class="listheader">[{oxmultilang ident="D3_EXTSEARCH_SYNED_SYNSETID"}]</a>
                </td>
                <td class="listheader" style="height:15px">&nbsp;
                </td>
            </tr>

            [{assign var="blWhite" value=""}]
            [{assign var="_cnt" value=0}]
            [{foreach from=$mylist item=listitem}]
                [{assign var="_cnt" value=$_cnt+1}]
                <tr id="row.[{$_cnt}]">

                    [{if $listitem->blacklist == 1}]
                        [{assign var="listclass" value=listitem3}]
                    [{else}]
                        [{assign var="listclass" value="listitem"|cat:$blWhite}]
                    [{/if}]
                    [{if $listitem->d3_extsearch_term__oxid->value == $oxid}]
                        [{assign var="listclass" value=listitem4}]
                    [{/if}]

                    <td style="vertical-align: top; height: 15px" class="[{$listclass}]"><div class="listitemfloating"><a href="Javascript:EditThis('[{$listitem->d3_extsearch_term__oxid->value}]');" class="[{$listclass}]">[{$listitem->d3_extsearch_term__word->value}]</a></div></td>
                    <td style="vertical-align: top; height: 15px" class="[{$listclass}]"><div class="listitemfloating"><a href="Javascript:EditThis('[{$listitem->d3_extsearch_term__oxid->value}]');" class="[{$listclass}]">[{$listitem->getSynonymsForSynsetId($listitem->d3_extsearch_term__synset_id->value, $listitem->d3_extsearch_term__word->value)}]</a></div></td>
                    <td style="vertical-align: top; height: 15px" class="[{$listclass}]"><div class="listitemfloating"><a href="Javascript:EditThis('[{$listitem->d3_extsearch_term__oxid->value}]');" class="[{$listclass}]">[{$listitem->d3_extsearch_term__synset_id->value}]</a></div></td>
                    <td style="vertical-align: top; height: 15px" class="[{$listclass}]"><div class="listitemfloating"><a href="Javascript:top.oxid.admin.deleteThis('[{$listitem->d3_extsearch_term__oxid->value}]');"  class="delete" id="del.[{$_cnt}]" title="" [{include file="help.tpl" helpid=item_delete}]></a></div></td>
                </tr>
                [{if $blWhite == "2"}]
                    [{assign var="blWhite" value=""}]
                [{else}]
                    [{assign var="blWhite" value="2"}]
                [{/if}]
            [{/foreach}]

            [{include file="pagenavisnippet.tpl" colspan="4"}]
        </table>
    </form>
</div>

[{include file="pagetabsnippet.tpl"}]

<script type="text/javascript">
    if (parent.parent)
    {
        parent.parent.sShopTitle   = "[{$actshopobj->oxshops__oxname->getRawValue()|oxaddslashes}]";
        parent.parent.sMenuItem    = "[{oxmultilang ident="d3mxlog"}]";
        parent.parent.sMenuSubItem = "[{oxmultilang ident="d3mxlog_main"}]";
        parent.parent.sWorkArea    = "[{$_act}]";
        parent.parent.setTitle();
    }
</script>

</body>
</html>
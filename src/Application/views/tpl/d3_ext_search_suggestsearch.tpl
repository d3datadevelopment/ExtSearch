[{block name="d3extsearch_suggest_main"}]
    <div id="d3_extsearch_quicksearch" class="[{if $blStartSearch}]searchWaitMsg[{/if}]">
        <div class="headline">
            [{block name="d3extsearch_suggest_headline"}]
                [{if $blStartSearch}]
                    [{oxmultilang ident="D3_EXTSEARCH_QUICK_SEARCH"}]
                [{else}]
                    <a title="[{oxmultilang ident="D3_EXTSEARCH_QUICK_CLOSE"}]" href="#" class="closebtn" id="d3extsearch_suggest_closebtn"></a>
                    [{if $useMultipleObjectTypes}]
                        [{oxmultilang ident="D3_EXTSEARCH_QUICK_MULTIPLEHITS"}]
                    [{else}]
                        [{$iHitCount}] [{if $similar}][{oxmultilang ident="D3_EXTSEARCH_QUICK_SIMILARHITS"}][{else}][{oxmultilang ident="D3_EXTSEARCH_QUICK_HITS"}][{/if}] "[{$sSearchparam}]"
                    [{/if}]
                [{/if}]
            [{/block}]
        </div>

        [{capture assign="sCssClasses"}][{strip}]
            [{if !$blStartSearch}]
                [{if $oHitList && $oHitList->count()}] hasArticleItems[{/if}]
                [{if $oCatHitList && $oCatHitList->count()}] hasCategoryItems[{/if}]
                [{if $oManHitList && $oManHitList->count()}] hasManufacturerItems[{/if}]
                [{if $oVendorHitList && $oVendorHitList->count()}] hasVendorItems[{/if}]
                [{if $oContentHitList && $oContentHitList->count()}] hasContentItems[{/if}]
            [{/if}]
        [{/strip}][{/capture}]

        [{strip}]
            [{if !$blStartSearch}]
                [{block name="d3extsearch_suggest_list"}]
                    <div class="list [{if $useMultipleObjectTypes}]small[{/if}] [{$sCssClasses}]" id="searchItemList">

                        [{if $oHitList->count()}]
                            [{block name="d3extsearch_suggest_list_article"}]
                                <div class="d3extsearch_suggest articlebox" id="d3extsearch_suggest_articlebox">
                                    <h3>[{oxmultilang ident="PRODUCTS"}]</h3>
                                    [{foreach name="hitlist" from=$oHitList item="oHit"}]
                                        [{block name="d3extsearch_suggest_listitem_article"}]
                                            [{strip}]
                                                <a class="item_inact d3QSItem article" data-object-type="article" id="[{$oHit->getId()|replace:".":""}]" href="[{$oHit->getLink()}]">
                                                    <div class="imgframe"><img src="[{$oHit->getIconUrl()}]" alt="[{$oHit->getFieldData('oxtitle')}]"></div>
                                                    [{$oHit->getFieldData('oxtitle')}]
                                                    [{if $oHit->getFieldData('oxvarselect')}] [{$oHit->getFieldData('oxvarselect')}][{/if}]
                                                </a>
                                            [{/strip}]
                                            [{assign var="blItem" value=true}]
                                        [{/block}]
                                    [{/foreach}]
                                </div>
                            [{/block}]
                        [{/if}]

                        [{if $useMultipleObjectTypes && $oCatHitList->count()}]
                            [{block name="d3extsearch_suggest_list_category"}]
                                <div class="d3extsearch_suggest categorybox" id="d3extsearch_suggest_categorybox">
                                    <h3>[{oxmultilang ident="CATEGORIES"}]</h3>
                                    [{foreach name="cathitlist" from=$oCatHitList item="oHit"}]
                                        [{block name="d3extsearch_suggest_listitem_category"}]
                                            [{strip}]
                                                [{if $oHit->getIsVisible()}]
                                                    <a class="item_inact d3QSItem category" data-object-type="category" id="[{$oHit->getId()|replace:".":""}]" href="[{$oHit->getLink()}]">
                                                        [{$oHit->getFieldData('oxtitle')}]
                                                    </a>
                                                [{/if}]
                                            [{/strip}]
                                            [{assign var="blItem" value=true}]
                                        [{/block}]
                                    [{/foreach}]
                                </div>
                            [{/block}]
                        [{/if}]

                        [{if $useMultipleObjectTypes && $oManHitList->count()}]
                            [{block name="d3extsearch_suggest_list_manufacturer"}]
                                <div class="d3extsearch_suggest manufacturerbox" id="d3extsearch_suggest_manufacturerbox">
                                    <h3>[{oxmultilang ident="MANUFACTURERS"}]</h3>
                                    [{foreach name="manhitlist" from=$oManHitList item="oHit"}]
                                        [{block name="d3extsearch_suggest_listitem_manufacturer"}]
                                            [{strip}]
                                                <a class="item_inact d3QSItem manufacturer" data-object-type="manufacturer" id="[{$oHit->getId()|replace:".":""}]" href="[{$oHit->getLink()}]">
                                                    [{$oHit->getFieldData('oxtitle')}]
                                                </a>
                                            [{/strip}]
                                            [{assign var="blItem" value=true}]
                                        [{/block}]
                                    [{/foreach}]
                                </div>
                            [{/block}]
                        [{/if}]

                        [{if $useMultipleObjectTypes && $oVendorHitList->count()}]
                            [{block name="d3extsearch_suggest_list_vendor"}]
                                <div class="d3extsearch_suggest vendorbox" id="d3extsearch_suggest_vendorbox">
                                    <h3>[{oxmultilang ident="DISTRIBUTORS"}]</h3>
                                    [{foreach name="vendorhitlist" from=$oVendorHitList item="oHit"}]
                                        [{block name="d3extsearch_suggest_listitem_vendor"}]
                                            [{strip}]
                                                <a class="item_inact d3QSItem vendor" data-object-type="vendor" id="[{$oHit->getId()|replace:".":""}]" href="[{$oHit->getLink()}]">
                                                    [{$oHit->getFieldData('oxtitle')}]
                                                </a>
                                            [{/strip}]
                                            [{assign var="blItem" value=true}]
                                        [{/block}]
                                    [{/foreach}]
                                </div>
                            [{/block}]
                        [{/if}]

                        [{if $useMultipleObjectTypes && $oContentHitList->count()}]
                            [{block name="d3extsearch_suggest_list_content"}]
                                <div class="d3extsearch_suggest contentbox" id="d3extsearch_suggest_contentbox">
                                    <h3>[{oxmultilang ident="SERVICES"}]</h3>
                                    [{foreach name="contenthitlist" from=$oContentHitList item="oHit"}]
                                        [{block name="d3extsearch_suggest_listitem_content"}]
                                            [{strip}]
                                                <a class="item_inact d3QSItem content" data-object-type="content" id="[{$oHit->getId()|replace:".":""}]" href="[{$oHit->getLink()}]">
                                                    [{$oHit->getFieldData('oxtitle')}]
                                                </a>
                                            [{/strip}]
                                            [{assign var="blItem" value=true}]
                                        [{/block}]
                                    [{/foreach}]
                                </div>
                            [{/block}]
                        [{/if}]

                        [{block name="d3extsearch_suggest_furtherlinks"}]
                            [{if $blToMuchHits}]
                                <a href="#" onclick="document.getElementById('search').submit(); return false;" class="item_inact">
                                    [{oxmultilang ident="D3_EXTSEARCH_QUICK_TOMUCHHITS"}]
                                </a>
                            [{elseif !$blItem}]
                                <a href="#" onclick="$('#xajax_resp').css({'display' : 'none'}); return false;" class="item_inact">
                                    [{oxmultilang ident="D3_EXTSEARCH_QUICK_NOHIT"}]
                                </a>
                            [{/if}]
                        [{/block}]
                    </div>
                [{/block}]
                [{if $oHit}]
                    [{block name="d3extsearch_suggest_searchbutton"}]
                        <div class="d3_extsearch_footer">
                            <a id="d3extsearch_suggest_startsearch" href="#" class="">
                                [{oxmultilang ident="D3_EXTSEARCH_QUICK_STARTSEARCH"}]
                            </a>
                        </div>
                    [{/block}]
                [{/if}]
            [{/if}]
        [{/strip}]
    </div>
[{/block}]

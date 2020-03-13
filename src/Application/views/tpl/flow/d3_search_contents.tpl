[{if !$oView->getArticleCount()}]
    [{block name="d3_cfg_extsearch_search_noarticlemessage"}]
        <h3>[{oxcontent ident="d3extsearch_noarticlefound" field="oxtitle"}]</h3>
        [{oxcontent ident="d3extsearch_noarticlefound"}]
    [{/block}]
[{/if}]

[{if $oView->d3GetCMSList()}]
    [{block name="d3_cfg_extsearch_search_cms_results"}]
        <div class="box d3_extsearch_navigation d3theme_[{$themename}] baseframe">
            <h3>
                [{oxmultilang ident="D3_EXTSEARCH_EXT_CMSHEADLINE"}]
            </h3>
            <div class="content list">
                [{foreach from=$oView->d3GetCMSList() item="oContent"}]
                    [{assign var="TitleCharCount" value=$oContent->oxcontents__oxtitle->value|count_characters}]
                    [{math equation="100-s" s=$TitleCharCount assign="iTextLength"}]
                    <div class="item">
                        <a href="[{$oContent->getLink()}]">[{$oContent->oxcontents__oxtitle->value}]</a>
                    </div>
                [{/foreach}]
                <div class="clearitem"></div>
            </div>
        </div>
    [{/block}]
[{/if}]

[{if $blSearchPluginLink == 1}]
    [{block name="d3_cfg_extsearch_search_plugin"}]
        <div class="box d3_extsearch_navigation d3theme_[{$themename}] baseframe">
            <h3>
                [{oxmultilang ident="D3_EXTSEARCH_EXT_PLUGINHEADLINE"}]
            </h3>
            <div class="content list">
                <SCRIPT type="text/javascript">
                    function installSearchEngine() {
                        if (window.external && ("AddSearchProvider" in window.external)) {
                            window.external.AddSearchProvider("[{$sSearchPluginURL}]");
                        } else {
                            alert('[{oxmultilang ident="D3_EXTSEARCH_EXT_PLUGINBROWSERERROR"}]');
                        }
                    }
                </SCRIPT>
                [{oxmultilang ident="D3_EXTSEARCH_EXT_PLUGININSTALLMSG"}]
                <div style="text-align: center; padding-top: 5px;"><a class="login_button" style="padding: 2px;" onclick="installSearchEngine();">[{oxmultilang ident="D3_EXTSEARCH_EXT_PLUGININSTALLBTN"}]</a></div>
            </div>
        </div>
    [{/block}]
[{/if}]

[{assign var="similarSearch" value=$oView->getSearchResultStatusMessage()}]
[{if $similarSearch}]
    [{block name="d3_cfg_extsearch_search_similar_messages"}]
        <div class="d3_extsearch_navigation d3theme_[{$themename}] baseframe">
            <div class="message">
                [{if $similarSearch == 'similar'}]
                    [{oxmultilang ident="D3_EXTSEARCH_EXT_NOARTMSG"}] [{$oView->getUsedParams()}]
                [{elseif $similarSearch == 'combined'}]
                    [{oxmultilang ident="D3_EXTSEARCH_EXT_LESSARTMSG"}]
                [{/if}]
            </div>
        </div>
    [{/block}]
[{/if}]
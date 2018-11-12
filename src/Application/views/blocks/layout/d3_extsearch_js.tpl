[{$smarty.block.parent}]

[{d3modcfgcheck modid="d3_extsearch"}][{/d3modcfgcheck}]

[{if $mod_d3_extsearch && false == $oModCfg_d3_extsearch->isThemeIdMappedTo('mobile')}]
    [{if $blUseSuggestSearch}]
        [{strip}]
            [{block name="d3_extsearch_js__suggest"}]
                [{block name="d3_extsearch_js__suggest_jsfile"}]
                    [{oxscript include=$oViewConf->getModuleUrl('d3_extsearch', 'out/src/js/d3extsearch.min.js')}]
                [{/block}]

                [{block name="d3_extsearch_js__suggest_jssuggestcall"}]
                    [{assign var="sCharSet" value="charset"|oxmultilangassign}]
                    [{capture name="d3script"}][{strip}]
                        $(document).ready(function () {
                            $('#searchParam').d3extsearchsuggest({
                                sWaitMessage: '[{$sD3QSWaitMessage|strip|oxescape:"htmlall":$sCharSet}]',
                                sParentThemeId: '[{$oModCfg_d3_extsearch->getReferenceThemeId()}]',
                                sRequestUrl: '[{$oViewConf->getModuleUrl('d3_extsearch')|cat:"public/d3_extsearch_response.php?shp="|cat:$oViewConf->getActiveShopId()|cat:"&"}]'
                            });
                        });
                    [{/strip}][{/capture}]
                    [{oxscript add=$smarty.capture.d3script}]
                [{/block}]

                [{if !$blD3EmptySearch}]
                    [{assign var="sSBDefault" value="D3_EXTSEARCH_FIELD_NOTICE"|oxmultilangassign}]
                    [{oxscript add="var sD3SearchBoxDefault = '"|cat:$sSBDefault|cat:"';"}]
                    [{else}]
                    [{oxscript add="var sD3SearchBoxDefault = '';"}]
                [{/if}]
            [{/block}]
        [{/strip}]
    [{/if}]

    [{if $blD3ShowIAS}]
        [{strip}]
            [{block name="d3_extsearch_js__ias"}]
                [{block name="d3_extsearch_js__ias_jsfile"}]
                    [{oxscript include=$oViewConf->getModuleUrl('d3_extsearch', 'out/src/js/d3extsearch_ias.min.js')}]
                [{/block}]

                [{block name="d3_extsearch_js__suggest_jsiascall"}]
                    [{assign var="sCharSet" value="charset"|oxmultilangassign}]
                    [{capture name="d3script"}][{strip}]
                        $(document).ready(function () {
                            $(document).d3extsearchias();
                        });
                    [{/strip}][{/capture}]
                    [{oxscript add=$smarty.capture.d3script}]
                [{/block}]

                <div id="IAS_box" class="IAS_box IAS_box_[{$oModCfg_d3_extsearch->getParentThemeId()}]">
                    <div class="headline">
                        <div class="closebtn" id="IAS_closebtn">X</div>
                        <label for="IAS_input">[{oxmultilang ident="D3_EXTSEARCH_IAS_SEARCH"}]</label>
                    </div>
                    <form action="[{$oViewConf->getBaseDir()}]index.php" method="get" onSubmit="d3_extsearch_popup.popup.load();">
                        <div>
                            [{$oViewConf->getHiddenSid()}]
                            <input type="hidden" name="cl" value="search">
                            <input id="IAS_input" type="text" size="30" value="" name="searchparam">
                            <span class="btn">
                                <input type="submit" class="btn" value="[{oxmultilang ident="D3_EXTSEARCH_IAS_STARTSEARCH"}]">
                            </span>
                        </div>
                    </form>
                </div>
            [{/block}]
        [{/strip}]
    [{/if}]

    [{if $blD3ShowSearchPopup}]
        [{block name="d3_extsearch_js__popup"}]
            <div id="d3extsearch_message" class="d3extsearch_popup">
                <strong style="text-align: center;">[{oxmultilang ident="D3_EXTSEARCH_SEARCHINPROGRESS"}]</strong>
            </div>

            <script type="text/javascript">
                var d3_extsearch_popup = {
                    // Popups
                    popup: {
                        load : function(){
                            var id = 'd3extsearch_message';
                            var pcl = 'd3extsearch_popup load on';
                            var mcl = 'on';
                            var _mk = document.getElementById('d3extsearch_mask');
                            var _el = document.getElementById(id);
                            if(_mk && _el) {
                                _mk.className = mcl;
                                _el.className = pcl;
                            }
                        }
                    }
                };
            </script>

            <div id="d3extsearch_mask"></div>
        [{/block}]
    [{else}]
        [{block name="d3_extsearch_js__nopopup"}]
            <script type="text/javascript">
                var d3_extsearch_popup = {
                    popup: {
                        load : function(){ }
                    }
                };
            </script>
        [{/block}]
    [{/if}]
[{/if}]
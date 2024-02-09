[{block name="d3_cfg_extsearch_jqsliderscript"}]
    [{assign var="elementId" value="d3extsearch_"|cat:$sliderId}]
    [{assign var="fieldMinId" value="d3extsearch_"|cat:$sliderId|cat:"fieldMinId"}]
    [{assign var="fieldMaxId" value="d3extsearch_"|cat:$sliderId|cat:"fieldMaxId"}]
    [{assign var="priceInfoMinId" value="d3extsearch_"|cat:$sliderId|cat:"PriceInfoMinId"}]
    [{assign var="priceInfoMaxId" value="d3extsearch_"|cat:$sliderId|cat:"PriceInfoMaxId"}]
    [{assign var="psovFieldName" value=$psovFieldName|default:"d3psov"}]
    [{assign var="selectorFieldName" value=$selectorFieldName|default:"priceselector"}]

    [{block name="d3_cfg_extsearch_jqsliderscript_touchjs"}]
        [{oxscript include=$oViewConf->getModuleUrl('d3_extsearch', 'out/src/js/jquery.ui.touch-punch.min.js')}]
    [{/block}]
    [{block name="d3_cfg_extsearch_jqsliderscript_sliderjs"}]
        [{oxscript include=$oViewConf->getModuleUrl('d3_extsearch', 'out/src/js/nouislider.min.js')}]
        [{oxscript include=$oViewConf->getModuleUrl('d3_extsearch', 'out/src/js/wave/d3extsearch_slider.min.js')}]
    [{/block}]
    
    [{capture name="d3script"}][{strip}]
        document.addEventListener("DOMContentLoaded", () => {
            try {
                new d3ExtsearchSlider({
                    elementId: '[{$elementId}]',
                    priceStepsMin: [{$aPriceSteps.min}],
                    priceStepsMax: [{$aPriceSteps.max}],
                    rangeMin: [{$aPriceLimits.min}],
                    rangeMax: [{$aPriceLimits.max}],
                    fieldMinId: '[{$fieldMinId}]',
                    fieldMaxId: '[{$fieldMaxId}]',
                    currencySign: '[{$currency->sign}]',
                });
            } catch (e) {
                console.error(e.message);
            }
        });
    [{/strip}][{/capture}]
    [{oxscript add=$smarty.capture.d3script}]
[{/block}]

[{block name="d3_cfg_extsearch_alist_jqsliderfields"}]
    <div style="display: block;" id="d3extsearch[{$elementId}]fields">
        <input type="hidden" name="[{$psovFieldName}][min]" value="[{$originalMinValue}]">
        <input type="hidden" name="[{$psovFieldName}][max]" value="[{$originalMaxValue}]">
        <input size="10" maxlength="20" type="text" name="[{$selectorFieldName}][min]" value="[{$inputMinValue}]" id="[{$fieldMinId}]" style="width: 50px;"> [{$currency->sign}] -
        <input size="10" maxlength="20" type="text" name="[{$selectorFieldName}][max]" value="[{$inputMaxValue}]" id="[{$fieldMaxId}]" style="width: 50px;"> [{$currency->sign}]
    </div>

    [{capture name="d3script"}][{strip}]
        document.getElementById('d3extsearch[{$elementId}]fields').style.display = 'none';
    [{/strip}][{/capture}]
    [{oxscript add=$smarty.capture.d3script}]

    <div id="[{$elementId}]" class="ui-slider">
        <div class="ui-slider-handle" id="d3extsearch_priceslider1"></div>
        <div class="ui-slider-handle" id="d3extsearch_priceslider2" style="right:0;"></div>
    </div>
[{/block}]
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
        [{oxscript include=$oViewConf->getModuleUrl('d3_extsearch', 'out/src/js/d3extsearch_slider.min.js')}]
    [{/block}]
    
    [{capture name="d3script"}][{strip}]
        $('#[{$elementId}]').d3extsearchslider({
            limitMin:   [{$aPriceLimits.min}],
            limitMax:   [{$aPriceLimits.max}],
            stepsMin:   [{$aPriceSteps.min}],
            stepsMax:   [{$aPriceSteps.max}],
            infoMinId:  '[{$priceInfoMinId}]',
            infoMaxId:  '[{$priceInfoMaxId}]',
            fieldMinId: '[{$fieldMinId}]',
            fieldMaxId: '[{$fieldMaxId}]',
        });
    [{/strip}][{/capture}]
    [{oxscript add=$smarty.capture.d3script}]

    [{assign var="sCssInc" value=$oViewConf->getModuleUrl('d3_extsearch', 'out/src/css/d3extsearch_slider.min.css')}]
    [{oxstyle include=$sCssInc}]

    [{include file=$oViewConf->getModulePath('d3_extsearch', 'out/src/css/abovethefold/d3extsearch_allthemes.min.css') assign="atfSliderCss"}]
    [{if $atfSliderCss}]<style type="text/css">[{$atfSliderCss}]</style>[{/if}]
[{/block}]

[{block name="d3_cfg_extsearch_jqsliderinfo"}]
    <div style="text-align: center; display: none;" id="d3extsearch[{$elementId}]info">
        <span id="[{$priceInfoMinId}]">
            [{$infoMinValue}]
        </span> [{$currency->sign}] - <span id="[{$priceInfoMaxId}]">
            [{$infoMaxValue}]
        </span> [{$currency->sign}]
    </div>
[{/block}]

[{block name="d3_cfg_extsearch_alist_jqsliderfields"}]
    <div style="display: block;" id="d3extsearch[{$elementId}]fields">
        <input type="hidden" name="[{$psovFieldName}][min]" value="[{$originalMinValue}]">
        <input type="hidden" name="[{$psovFieldName}][max]" value="[{$originalMaxValue}]">
        <input size="10" maxlength="20" type="text" name="[{$selectorFieldName}][min]" value="[{$inputMinValue}]" id="[{$fieldMinId}]" style="width: 50px;"> [{$currency->sign}] -
        <input size="10" maxlength="20" type="text" name="[{$selectorFieldName}][max]" value="[{$inputMaxValue}]" id="[{$fieldMaxId}]" style="width: 50px;"> [{$currency->sign}]
    </div>

    [{capture name="d3script"}][{strip}]
        document.getElementById('d3extsearch[{$elementId}]info').style.display = 'block';
        document.getElementById('d3extsearch[{$elementId}]fields').style.display = 'none';
    [{/strip}][{/capture}]
    [{oxscript add=$smarty.capture.d3script}]

    <div id="[{$elementId}]" class="ui-slider">
        <div class="ui-slider-handle" id="d3extsearch_priceslider1"></div>
        <div class="ui-slider-handle" id="d3extsearch_priceslider2" style="right:0;"></div>
    </div>
[{/block}]
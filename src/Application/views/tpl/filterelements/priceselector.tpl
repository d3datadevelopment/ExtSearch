[{assign var="currency" value=$oView->getActCurrency()}]
<div class="item priceselector [{$cssclass}]">
    <label for="priceselector">
        [{oxmultilang ident="D3_EXTSEARCH_EXT_PRICECATS"}]:
    </label><br>
    [{if $oView->d3HasjQuerySlider() && $oView->d3CanShowPriceFilterSlider()}]
        [{assign var="random" value=1|rand:1000}]
        [{assign var="sliderIdDefault" value="PriceFilter"|cat:$random}]
        [{assign var="sliderId" value=$sliderId|default:$sliderIdDefault}]
        [{include file="d3_ext_search_filter_jqslider.tpl"
            sliderId=$sliderId
            formId="d3searchfilterform"
            aPriceLimits=$aPriceLimits
            aPriceSteps=$aPriceSteps
            infoMinValue=$infoMinValue
            infoMaxValue=$infoMaxValue
            originalMinValue=$originalMinValue
            originalMaxValue=$originalMaxValue
            inputMinValue=$inputMinValue
            inputMaxValue=$inputMaxValue
            precision=$precision
        }]
    [{elseif !$oView->d3HasjQuerySlider()}]
        <SELECT id="priceselector" name="priceselector" onchange="d3_extsearch_popup.popup.load(); this.form.submit();">
            <OPTION value="[{$sSelectedPriceStep}]" class="desc" selected="selected">[{oxmultilang ident="D3_EXTSEARCH_EXT_CHOOSEPRICE"}]</OPTION>
            [{foreach from=$oView->d3getPriceSteps() item="price"}]
                <OPTION value="[{$price->addParam}]">[{oxmultilang ident="D3_EXTSEARCH_EXT_PRICEFROM"}] [{$price->iFMin}] [{$currency->sign}] [{oxmultilang ident="D3_EXTSEARCH_EXT_PRICETO"}] [{$price->iFMax}] [{$currency->sign}]
                    [{if !$oModCfg_d3_extsearch->getValue('blExtSearch_dontShowFilterArticleCount') && $price->iCount != ''}]
                        ([{$price->iCount}])
                    [{/if}]
                </OPTION>
            [{/foreach}]
            [{if $sSelectedPriceStep}]
                <OPTION value="" class="desc">[{oxmultilang ident="D3_EXTSEARCH_EXT_DESELECTPRICE"}]</OPTION>
            [{/if}]
        </SELECT>
    [{/if}]
</div>
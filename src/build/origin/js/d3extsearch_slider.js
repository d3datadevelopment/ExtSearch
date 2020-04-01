/**
 * This Software is the property of Data Development and is protected
 * by copyright law - it is NOT Freeware.
 * Any unauthorized use of this software without a valid license
 * is a violation of the license agreement and will be prosecuted by
 * civil and criminal law.
 * http://www.shopmodule.com
 * 
 * @license
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author    D3 Data Development - Daniel Seifert <support@shopmodule.com>
 * @link      http://www.oxidmodule.com
 */

(function ( $ )
{
    let d3extsearchslider = {
        options: {
            fieldMinId: "d3extsearch_PriceFilterfieldMinId",
            fieldMaxId: "d3extsearch_PriceFilterfieldMaxId",
            infoMinId:  "d3extsearch_PriceFilterPriceInfoMinId",
            infoMaxId:  "d3extsearch_PriceFilterPriceInfoMaxId",
            formId:     "d3searchfilterform",
            precision:  100,
        },

        _create: function ()
        {
            let self = this;
            let options = self.options;
            let el      = self.element;

            if (typeof options.limitMin !== "undefined") {
                $('input#' + options.fieldMinId + ',input#' + options.fieldMaxId).hide();
                $(el).slider(
                    {
                        range: true,
                        min: options.limitMin,
                        max: options.limitMax,
                        step: 100,
                        values: [options.stepsMin, options.stepsMax],
                        slide: function () {
                            $("#" + options.infoMinId).html(
                                $(el).slider(
                                    "option",
                                    "values"
                                )[0] / options.precision
                            );
                            $("#" + options.infoMaxId).html(
                                $(el).slider(
                                    "option",
                                    "values"
                                )[1] / options.precision
                            );
                        },
                        change: function () {
                            $("input#" + options.fieldMinId).val(
                                $(el).slider(
                                    "option",
                                    "values"
                                )[0] / options.precision
                            );
                            $("input#" + options.fieldMaxId).val(
                                $(el).slider(
                                    "option",
                                    "values"
                                )[1] / options.precision
                            );
                            $("#" + options.infoMinId).html(
                                $(el).slider(
                                    "option",
                                    "values"
                                )[0] / options.precision
                            );
                            $("#" + options.infoMaxId).html(
                                $(el).slider(
                                    "option",
                                    "values"
                                )[1] / options.precision
                            );
                            d3_extsearch_popup.popup.load();
                            $("form#" + options.formId).submit();
                        }
                    }
                );
            }
        }
    };

    $.widget( "ui.d3extsearchslider", d3extsearchslider );

})( jQuery );

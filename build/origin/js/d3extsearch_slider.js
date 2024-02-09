/**
 * This Software is the property of Data Development and is protected
 * by copyright law - it is NOT Freeware.
 * Any unauthorized use of this software without a valid license
 * is a violation of the license agreement and will be prosecuted by
 * civil and criminal law.
 * https://www.d3data.de
 *
 * @license
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author    D3 Data Development - Daniel Seifert <support@shopmodule.com>
 * @link      https://www.oxidmodule.com
 */

/* jshint esversion: 9 */
/* global console */
/* global noUiSlider */
/* global d3_extsearch_popup */
/* exported d3ExtsearchSlider */

let d3ExtsearchSlider = (function ()
{
    'use strict';

    function Constructor (initOptions)
    {
        let options = {
            elementId: "searchParam",
            filterFormId: "d3searchfilterform",
            element: null,
            priceStepsMin: null,
            priceStepsMax: null,
            rangeMin: null,
            rangeMax: null,
            fieldMinId: false,
            fieldMaxId: false,
            connect: true,
            step: 100,
            precision: 100,
            behaviour: 'tap-drag',
            currencySign: '',
            tooltips: {
                to: function(value) {
                    return (Math.round(value) / options.precision).toFixed(2) + ' ' + options.currencySign;
                }
            },
            keyboardDefaultStep: 100,
        };

        let setSlider = function ()
        {
            console.debug('define slider');

            options.element = document.getElementById(options.elementId);
            let slider = options.element;

            noUiSlider.create(slider, {
                start: [options.priceStepsMin, options.priceStepsMax],
                connect: options.connect,
                range: {
                    'min': options.rangeMin,
                    'max': options.rangeMax
                },
                step: options.step,
                behaviour: options.behaviour,
                tooltips: options.tooltips,
                keyboardDefaultStep: options.keyboardDefaultStep,
            });
        };

        let setUpdateEvent = function ()
        {
            console.debug('set update event');

            let slider = options.element;

            slider.noUiSlider.on('update', function (values) {
                document.getElementById(options.fieldMinId).setAttribute('value', values[0] / options.precision);
                document.getElementById(options.fieldMaxId).setAttribute('value', values[1] / options.precision);
            });
        };

        let setSetEvent = function ()
        {
            console.debug('set Set event');

            let slider = options.element;

            slider.noUiSlider.on('set', function () {
                d3_extsearch_popup.popup.load();
                document.querySelector('#' + options.filterFormId).submit();
            });
        };

        let init = function (initOptions)
        {
            console.debug('slider initialized');

            options = {
                ...options,
                ...initOptions
            };
            setSlider();
            setUpdateEvent();
            setSetEvent();
        };

        init(initOptions);
    }

    return Constructor;
})();
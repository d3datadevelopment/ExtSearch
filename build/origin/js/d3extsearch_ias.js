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
/* exported d3ExtsearchIAS */

let d3ExtsearchIAS = (function () {
    'use strict';

    function Constructor(initOptions) {
        let options = {
            sElementId: "IAS_box",
            sInputElementId: "IAS_input",
            sCloseElementId: "IAS_closebtn",
            iPosOffset: 10, // in px
            sLastSelection: "",
            iDelay: 600,    // in ms between click outside and deactivating of the box
            oClearWnd: null
        };

        let getSelection = function () {
            let oSelection;
            if (window.getSelection) {
                oSelection = window.getSelection();
            } else if (document.getSelection) {
                // NC compatible
                oSelection = document.getSelection();
            } else if (document.selection) {
                // IE compatible
                oSelection = document.selection.createRange().text;
            }

            return oSelection.toString();
        };

        let showIasWindow = function (event)
        {
            console.debug('show IAS window');
            let oIASBoxElement = document.querySelector("#" + options.sElementId);
            let oIASInputElement = document.querySelector("#" + options.sInputElementId);
            if (oIASBoxElement) {
                let sSelection = getSelection();
                if (sSelection !== options.sLastSelection && sSelection.length > 0) {
                    oIASBoxElement.style.display = 'block';
                    oIASBoxElement.style.top = (event.pageY + options.iPosOffset) + "px";
                    oIASBoxElement.style.left = (event.pageX + options.iPosOffset) + "px";
                    oIASInputElement.value = sSelection;
                    options.sLastSelection = sSelection;
                }
            }
        };

        let clearIasWindow = function ()
        {
            console.debug('clear IAS window');
            document.querySelector("#" + options.sElementId).style.display = 'none';
            options.sLastSelection = "";
        };

        let checkIasWindow = function (event)
        {
            console.debug('check IAS window');
            if (getSelection()) {
                showIasWindow(event);
            } else {
                clearIasWindow();
            }
        };

        let setMouseEvents = function ()
        {
            console.debug('IAS: set mouse events');
            document.querySelector("#" + options.sElementId).addEventListener(
                'mouseup',
                function (event) {
                    event.stopPropagation();
                }
            );
            document.querySelector("body").addEventListener(
                'mouseup',
                function (event) {
                    checkIasWindow(event);
                }
            );
            document.querySelector("#" + options.sCloseElementId).addEventListener(
                'click',
                function () {
                    clearIasWindow();
                }
            );
        };

        let init = function (initOptions)
        {
            console.debug('IAS initialized');

            options = {
                ...options,
                ...initOptions
            };
            setMouseEvents();
        };

        init(initOptions);
    }

    return Constructor;
})();
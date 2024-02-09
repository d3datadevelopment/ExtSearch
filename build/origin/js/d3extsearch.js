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
/* exported d3ExtsearchSuggest */

let d3ExtsearchSuggest = (function ()
{
    'use strict';

    function Constructor (initOptions)
    {
        let options = {
            inputFieldId: "searchParam",
            currentEvent: null,
            oAjaxResponseElement: null,
            isSend: 0,
            coloredId: null,
            sWaitMessage: "",
            oldColoredId: null,
            iActLine: 0,
            iCode: null,
            blNavigate: null,
            iRet: null,
            sSelection: null,
            oSelection: null,
            iDelay: 600,
            iMinCharCount: 3,
            sD3SearchBoxDefault: "",
            sParentThemeId: "apex",
            sRequestUrl: null,
            sSearchFormId: "searchForm",
            sCloseBtnId: "d3extsearch_suggest_closebtn",
            sResultListId: "#searchItemList",
            sResultItemClass: ".d3QSItem",
            sStartSearchButtonId: "d3extsearch_suggest_startsearch",
            sResponseElementId: "xajax_resp",
            sResponseElementClass: "xajax_resp_cl",
            sWaitMsgIdentificator: "#d3_extsearch_quicksearch.searchWaitMsg",
            sRequestFncName: "getSuggestContent",
            sSearchParamName: "searchParam",
            sActClassName: "item_act",
            sInactClassName: "item_inact",
            sActiveElementClassName: null,
            blSetActiveElementDimensions: true,
            sActiveElementStyleTop: null,
            sActiveElementStyleTopImportant: "",
            sActiveElementStyleLeft: null,
            sActiveElementStyleLeftImportant: "",
            blAutomatedActiveElementStyleWidth: false,
            sActiveElementStyleWidth: null,
            sActiveElementStyleWidthImportant: "",
            iScrollTopOffset: 29,
            blEnableLeftRightNavigation: true,
            blToggleLeftRightDirection: false
        };

        let createResponseElement = function ()
        {
            let target = document.querySelector('body'), element = document.createElement('div');
            element.id = options.sResponseElementId;
            element.className = options.sResponseElementClass + " xajax_resp_" + options.sParentThemeId;
            target.append(element);

            return element;
        };

        let addResponseElement = function ()
        {
            console.debug('add response element');
            let responseElement = document.querySelector("#" + options.sResponseElementId);
            options.oAjaxResponseElement = responseElement ? responseElement : createResponseElement();
        };

        let isHidden = function (element)
        {
            return window.getComputedStyle(element).display === 'none';
        };

        let getResultItemListElement = function ()
        {
            return document.querySelector(options.sResultListId).querySelectorAll("a" + options.sResultItemClass);
        };

        let getResultItemCount = function ()
        {
            return getResultItemListElement().length;
        };

        let getResultItemIdByLine = function (iLine)
        {
            let iRet = null;
            getResultItemListElement().forEach(function (current, index) {
                if (index === iLine) {
                    iRet = current.id;
                }
            });

            return iRet;
        };

        let scrollToSelectedElement = function (elementId)
        {
            let currentEvent = options.currentEvent;
            let itemElement = document.querySelector("#" + elementId);

            // if list doesn't exist or event is mouse event
            if (itemElement.length === 0 || currentEvent.type.toLowerCase().indexOf("mouse") >= 0) {
                return;
            }

            itemElement.scrollIntoView({ behavior: "smooth", block: "end", inline: "nearest" });
        };

        let changeResultItemColor = function (newId, oldId)
        {
            if (oldId !== -1 && oldId !== newId) {
                let oldHighlightedElement = document.querySelector("#" + oldId);
                if (oldHighlightedElement) {
                    // don't use toggleClass, because this method is too slow for this case
                    let classList = oldHighlightedElement.classList;
                    classList.add(options.sInactClassName);
                    classList.remove(options.sActClassName);
                }
            }

            if (oldId !== newId) {
                let newHighlightedElement = document.querySelector("#" + newId);
                if (newHighlightedElement) {
                    let classList = newHighlightedElement.classList;
                    classList.add(options.sActClassName);
                    classList.remove(options.sInactClassName);
                }
            }

            scrollToSelectedElement(newId);
        };

        let handleArrowUpKey = function ()
        {
            console.debug('arrow up key handled');

            options.iActLine = options.iActLine > 0 ?
                options.iActLine - 1 :
                0;

            if (options.coloredId) {
                options.oldColoredId = options.coloredId;
            }
            options.blNavigate = true;
            options.coloredId = getResultItemIdByLine(options.iActLine);
            changeResultItemColor(options.coloredId, options.oldColoredId);
        };

        let handleArrowDownKey = function ()
        {
            console.debug('arrow down key handled');

            let iNodesCount = getResultItemCount();

            if (options.iActLine === false) {
                options.iActLine = 0;
            } else {
                options.iActLine = options.iActLine < iNodesCount - 1 ?
                    options.iActLine + 1 :
                    iNodesCount - 1;
            }

            if (options.coloredId) {
                options.oldColoredId = options.coloredId;
            }
            options.blNavigate = true;
            options.coloredId = getResultItemIdByLine(options.iActLine);
            changeResultItemColor(options.coloredId, options.oldColoredId);
        };

        let findFirstElementIdByObjectType = function (sType)
        {
            let firstItem = Array.from(getResultItemListElement()).find(
                (element) => element.getAttribute("data-object-type") === sType
            );

            options.iActLine = Array.from(getResultItemListElement()).indexOf(firstItem);

            return firstItem.getAttribute('id');
        };

        let changeToItemGroup = function (iIndex, iDirection, aTypes)
        {
            let newIndex = Math.min(Math.max(0, iIndex + iDirection), aTypes.length -1);
            let sNewType = aTypes[newIndex];
            let sElementId = findFirstElementIdByObjectType(sNewType);

            if (sElementId !== null) {
                if (options.coloredId) {
                    options.oldColoredId = options.coloredId;
                }
                options.coloredId = sElementId;
                changeResultItemColor(options.coloredId, options.oldColoredId);
                options.oldColoredId = options.coloredId;
            }
        };

        let getTypesList = function ()
        {
            let types = [];

            getResultItemListElement().forEach(function (item) {
                let objecttype = item.getAttribute("data-object-type");
                if (objecttype && objecttype.length) {
                    if (types.indexOf(objecttype) === -1) {
                        types.push(objecttype);
                    }
                } else {
                    console.warn("no data-object-type attributes for grouping found");
                }
            });
            return types;
        };

        let handleArrowLeftKey = function ()
        {
            console.debug('arrow left key handled');

            let iIndex = null, iDirection = null, aTypes = getTypesList();

            if (options.iActLine < 0) {
                iIndex = 0;
                iDirection = 0;
            } else {
                let sCurrType = document.querySelector("#" + getResultItemIdByLine(options.iActLine)).getAttribute("data-object-type");

                if (sCurrType && sCurrType.length && aTypes.length > 1) {
                    iIndex = aTypes.indexOf(sCurrType);
                    iDirection = options.blToggleLeftRightDirection ? 1 : -1;
                } else {
                    console.warn("selected item has no data-object-type attribute, can not switch to next group");
                }
            }

            if (iIndex !== null) {
                changeToItemGroup(iIndex, iDirection, aTypes);
            }
        };

        let handleArrowRightKey = function ()
        {
            console.debug('arrow right key handled');

            let iIndex = null, iDirection = null, aTypes = getTypesList();

            if (options.iActLine < 0) {
                iIndex = 0;
                iDirection = 0;
            } else if (getResultItemIdByLine(options.iActLine)) {
                let sCurrType = document.querySelector("#" + getResultItemIdByLine(options.iActLine)).getAttribute("data-object-type");
                if (sCurrType && sCurrType.length && aTypes.length > 1) {
                    iIndex = aTypes.indexOf(sCurrType);
                    iDirection = options.blToggleLeftRightDirection ? -1 : 1;
                } else {
                    console.warn("selected item has no data-object-type attribute, can not switch to next group");
                }
            }

            if (iIndex !== null) {
                changeToItemGroup(iIndex, iDirection, aTypes);
            }
        };

        let handleEnterKeyOnSelectedItem = function ()
        {
            console.debug('enter key on selected item handled');

            let element = document.querySelector("#" + getResultItemIdByLine(options.iActLine));
            window.location.href = element.getAttribute("href");
        };

        let hideSuggest = function ()
        {
            options.oAjaxResponseElement.classList.remove('suggestVisible');
        };

        let handleEnterKeyWithoutSelectedItem = function ()
        {
            console.debug('enter key without selected item handled');

            if (options.isSend) {
                window.clearTimeout(options.isSend);
                hideSuggest();
            }
            let searchFormElement = document.querySelector("#" + options.sSearchFormId);
            searchFormElement.addEventListener('submit', function() {}, false);
            searchFormElement.submit();
        };

        let handleEscapeKey = function ()
        {
            console.debug('escape key handled');
            hideSuggest();
        };

        let getOffset = function (element)
        {
            if (!element.getClientRects().length) {
                return { top: 0, left: 0 };
            }

            let rect = element.getBoundingClientRect();
            let win = element.ownerDocument.defaultView;
            return ({
                top: rect.top + win.scrollY,
                left: rect.left + win.scrollX
            });
        };

        let setResponseStyles = function ()
        {
            console.debug('set result DOM elements position');

            let inputElement = document.querySelector("#" + options.inputFieldId);

            if (options.sActiveElementClassName) {
                options.oAjaxResponseElement.addClass(options.sActiveElementClassName);
            }

            if (options.blSetActiveElementDimensions) {
                options.oAjaxResponseElement.style.setProperty(
                    'top',
                    options.sActiveElementStyleTop ?
                        options.sActiveElementStyleTop :
                        inputElement.hasAttribute("suggestTopOffsetPx") ?
                            (getOffset(inputElement).top + (parseInt(getComputedStyle(inputElement).getPropertyValue('height')) + 5) + parseInt(inputElement.getAttribute('suggestTopOffsetPx'), 10) + "px"):
                            (getOffset(inputElement).top + (parseInt(getComputedStyle(inputElement).getPropertyValue('height')) + 5) + "px"),
                    options.sActiveElementStyleTopImportant
                );
                options.oAjaxResponseElement.style.setProperty(
                    'left',
                    options.sActiveElementStyleLeft ?
                        options.sActiveElementStyleLeft :
                        inputElement.hasAttribute("suggestLeftOffsetPx") ?
                            (getOffset(inputElement).left + parseInt(inputElement.getAttribute('suggestLeftOffsetPx'), 10)) + "px":
                            (getOffset(inputElement).left + "px"),
                    options.sActiveElementStyleLeftImportant
                );
                if (options.blAutomatedActiveElementStyleWidth) {
                    options.oAjaxResponseElement.style.setProperty(
                        'width',
                        options.sActiveElementStyleWidth ?
                            options.sActiveElementStyleWidth :
                            (parseInt(getComputedStyle(inputElement).getPropertyValue('width')) + "px"),
                        options.sActiveElementStyleWidthImportant
                    );
                }
            }
        };

        let showSuggest = function ()
        {
            options.oAjaxResponseElement.classList.add('suggestVisible');
        };

        let setResponseElementStyle = function ()
        {
            let inputElement, closeButtonElement;

            setResponseStyles();
            showSuggest();

            // prevent a close on inside click
            options.oAjaxResponseElement.addEventListener("click", (event) => {
                event.stopPropagation();
            });
            inputElement = document.querySelector("#" + options.inputFieldId);
            inputElement.addEventListener("click", (event) => {
                event.stopPropagation();
            });
            document.querySelector("body").addEventListener("click", () => {
                hideSuggest();
            });

            closeButtonElement = document.querySelector("#" + options.sCloseBtnId);
            if (closeButtonElement) {
                closeButtonElement.addEventListener("click", (event) => {
                    event.stopPropagation();
                    hideSuggest();
                });
            }
        };

        let showWaitMessage = function ()
        {
            let content, element = document.createElement('div');

            element.innerHTML = options.sWaitMessage;
            content = element.textContent;
            options.oAjaxResponseElement.innerHTML = content;
            setResponseElementStyle();
        };

        let mouseHandler = function (elementId, iLine)
        {
            options.oldColoredId = options.coloredId;
            options.coloredId = elementId;
            options.iActLine = iLine;
            options.blNavigate = true;
            changeResultItemColor(options.coloredId, options.oldColoredId);
        };

        let setItemsMouseHandler = function ()
        {
            console.debug('set mouseover handler set for every');
            getResultItemListElement().forEach(function (domObject, index) {
                domObject.addEventListener('mouseover', (event) => {
                    options.currentEvent = event;
                    let sElementId = getResultItemIdByLine(index);
                    mouseHandler(sElementId, index);
                });
            });
        };

        let setStartSearchButtonHandler = function ()
        {
            let startSearchElement = document.querySelector("#" + options.sStartSearchButtonId);

            if (startSearchElement) {
                startSearchElement.addEventListener("click", (event) => {
                    event.preventDefault();
                    event.stopPropagation();
                    handleEnterKeyWithoutSelectedItem();
                });
            }
        };

        let showResult = function ()
        {
            let inputElement = document.querySelector("#" + options.inputFieldId);

            if (false === Number.isFinite(options.iMinCharCount) || inputElement.value.length < options.iMinCharCount) {
                console.debug('insufficient search term length');
                hideSuggest();
                return;
            }

            let requestUrl = options.sRequestUrl + "fnc=" + options.sRequestFncName + "&" +
                options.sSearchParamName + "=" + inputElement.value;
            const myRequest = new Request(requestUrl.replace('&amp;', '&'));

            fetch(myRequest)
                .then(function (resp) {
                    console.debug('successfully requested');
                    resp.json().then(parsedValue => {
                        console.debug('successfully parsed');
                        // prevent the display of outdated information
                        if (inputElement.value === parsedValue.searchparam) {
                            options.oAjaxResponseElement.innerHTML = parsedValue.content;
                            setItemsMouseHandler();
                            setResponseElementStyle();
                            setStartSearchButtonHandler();
                        } else {
                            console.debug('outdated response');
                        }
                    }).catch(error => console.error(error));
                }).catch(error => console.error(error));

            options.iActLine = false;
            options.coloredId = false;
            options.oldColoredId = false;

            options.blNavigate = false;
        };

        let showSuggestWindow = function ()
        {
            if (options.currentEvent.key.toLowerCase() === "enter") {
                return;
            }

            showWaitMessage();
            if (options.isSend && document.querySelector(options.sWaitMsgIdentificator)) {
                window.clearTimeout(options.isSend);
            }
            options.isSend = setTimeout(function(){ showResult(); }.bind(this), options.iDelay);
        };

        let handleOtherKeys = function ()
        {
            let event = options.currentEvent;
            let sKey = event.originalEvent ? event.originalEvent.key : '';

            if (sKey !== "ArrowLeft" && sKey !== "ArrowRight") {
                showSuggestWindow();
            }
        };

        let keyHandler = function (event)
        {
            event.preventDefault();
            options.currentEvent = event;
            let isSubmitEvent = event.type.toLowerCase() === "submit";
            let sKey = isSubmitEvent ? "Enter" : event.key;

            if (isSubmitEvent || sKey.toLowerCase() === "enter" || !isHidden(options.oAjaxResponseElement)) {
                if (sKey.toLowerCase() === "arrowup") {
                    handleArrowUpKey();
                } else if (
                    (sKey.toLowerCase() === "arrowleft" || sKey.toLowerCase() === "pageup") && options.blEnableLeftRightNavigation
                ) {
                    handleArrowLeftKey();
                } else if (
                    (sKey.toLowerCase() === "arrowright" || sKey.toLowerCase() === "pagedown") && options.blEnableLeftRightNavigation
                ) {
                    handleArrowRightKey();
                } else if (sKey.toLowerCase() === "arrowdown") {
                    handleArrowDownKey();
                } else if (sKey.toLowerCase() === "enter") {
                    if (options.blNavigate) {   // if suggest search window is open
                        handleEnterKeyOnSelectedItem();
                    } else {
                        handleEnterKeyWithoutSelectedItem();
                    }
                } else if (sKey.toLowerCase() === "escape") {
                    handleEscapeKey();
                } else {
                    handleOtherKeys();
                }
            } else {    // there's no suggest search window
                showSuggestWindow();
            }
        };

        let addEventHandler = function ()
        {
            console.debug('add event listener');
            if (!options.inputFieldId) {
                throw new Error('Error: Please provide a valid input field selector');
            }
            if (!document.querySelector("#" + options.inputFieldId)) {
                throw new Error('Error: extsearch: no DOM element with id "' + options.inputFieldId + '" found');
            }
            document.querySelector("#" + options.inputFieldId).addEventListener("keyup", (event) => keyHandler(event));
        };

        let init = function (initOptions)
        {
            console.debug('initialized');
            options = {
                ...options,
                ...initOptions
            };
            addResponseElement();
            addEventHandler();
        };

        init(initOptions);
    }

    return Constructor;
})();

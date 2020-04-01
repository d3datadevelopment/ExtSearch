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

$( function() {
    $.widget( "ui.d3extsearchsuggest", {
        // default options
        options: {
            currentEvent: null,
            oAjaxResponseElement: null,
            isSend: 0,
            coloredId: null,
            oldColoredId: null,
            iActLine: null,
            iCode: null,
            blNavigate: null,
            iRet: null,
            sSelection: null,
            oSelection: null,
            iDelay: 600,  // delay before submit to server, if is already submitted
            sD3SearchBoxDefault: "",
            sWaitMessage: "",
            sParentThemeId: "flow",
            sRequestUrl: null,
            sSearchFormId: "search",
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

            sActiveElementClassName: null,        // apply css class
            blSetActiveElementDimensions: true,   // use calculated or applied inline formats
            sActiveElementStyleTop: null,
            sActiveElementStyleTopImportant: "",  // should "" or "important"
            sActiveElementStyleLeft: null,
            sActiveElementStyleLeftImportant: "",  // should "" or "important"
            blAutomatedActiveElementStyleWidth: false,
            sActiveElementStyleWidth: null,
            sActiveElementStyleWidthImportant: "",  // should "" or "important"

            iScrollTopOffset: 29,
            blEnableLeftRightNavigation: true,
            blToggleLeftRightDirection: false
        },

        _create: function () {
            let self    = this;
            let el      = this.element;
            let options = this.options;

            this.addResponseElement();
            el.keyup(function(event) {
                self.keyHandler(event);
            });
            $("#" + options.sSearchFormId).submit(function(event) {
                self.keyHandler(event);
            });
        },

        addResponseElement: function () {
            let options = this.options;
            let ResponseElement = $("#" + options.sResponseElementId);
            if (ResponseElement.length === 0) {
                options.oAjaxResponseElement = $("<div>", {
                    "id": options.sResponseElementId,
                    "class": options.sResponseElementClass + " xajax_resp_" + options.sParentThemeId
                }).appendTo("body");
            } else {
                options.oAjaxResponseElement = ResponseElement;
            }
        },

        mouseHandler: function (elementId, iLine) {
            let options = this.options;
            options.oldColoredId = options.coloredId;
            options.coloredId = elementId;
            options.iActLine = iLine;
            options.blNavigate = true;
            this.changeResultItemColor(options.coloredId, options.oldColoredId);
        },

        keyHandler: function (event) {
            event.preventDefault();
            let options = this.options;
            options.currentEvent = event;
            let isSubmitEvent = event.type.toLowerCase() === "submit";
            let sKey = isSubmitEvent ? "Enter" : event.originalEvent.key;

            if (isSubmitEvent || options.oAjaxResponseElement.is(":visible")) {
                if (sKey.toLowerCase() === "arrowup") {
                    this.handleArrowUpKey();
                } else if (
                    (sKey.toLowerCase() === "arrowleft" || sKey.toLowerCase() === "pageup") && options.blEnableLeftRightNavigation
                ) {
                    this.handleArrowLeftKey();
                } else if (
                    (sKey.toLowerCase() === "arrowright" || sKey.toLowerCase() === "pagedown") && options.blEnableLeftRightNavigation
                ) {
                    this.handleArrowRightKey();
                } else if (sKey.toLowerCase() === "arrowdown") {
                    this.handleArrowDownKey();
                } else if (sKey.toLowerCase() === "enter") {
                    if (options.blNavigate) {   // if suggest search window is open
                        this.handleEnterKeyOnSelectedItem();
                    } else {
                        this.handleEnterKeyWithoutSelectedItem();
                    }
                } else if (sKey.toLowerCase() === "escape") {
                    this.handleEscapeKey();
                } else {
                    this.handleOtherKeys();
                }
            } else {    // there's no suggest search window
                this.showSuggestWindow();
            }
        },

        handleArrowUpKey: function () {
            let options = this.options;
            if (options.iActLine > 0) {
                options.iActLine--;
            }
            if (options.coloredId) {
                options.oldColoredId = options.coloredId;
            }
            options.blNavigate = true;
            options.coloredId = this.getResultItemIdByLine(options.iActLine);
            this.changeResultItemColor(options.coloredId, options.oldColoredId);
        },

        handleArrowDownKey: function () {
            let options = this.options;
            let iNodesCount = this.getResultItemCount();

            if (options.iActLine < iNodesCount - 1) {
                options.iActLine++;
            }

            if (options.coloredId) {
                options.oldColoredId = options.coloredId;
            }
            options.blNavigate = true;
            options.coloredId = this.getResultItemIdByLine(options.iActLine);
            this.changeResultItemColor(options.coloredId, options.oldColoredId);
        },

        handleArrowLeftKey: function () {
            let options = this.options;
            let iIndex = null;
            let iDirection = null;
            let aTypes = this.getTypesList();

            if (options.iActLine < 0) {
                iIndex = 0;
                iDirection = 0;
            } else {
                let sCurrType = $("#" + this.getResultItemIdByLine(options.iActLine)).attr("data-object-type");
                if (sCurrType !== null) {
                    if (sCurrType && sCurrType.length && aTypes.length > 1) {
                        iIndex = $.inArray(sCurrType, aTypes);
                        iDirection = options.blToggleLeftRightDirection ? 1 : -1;
                    }
                } else {
                    console.error("selected item has no data-object-type attribute, can not switch to next group");
                }
            }

            if (iIndex !== null) {
                let sNewType = aTypes[iIndex + iDirection];
                let sElementId = this.findFirstElementIdByObjectType(sNewType);
                if (sElementId !== null) {
                    if (options.coloredId) {
                        options.oldColoredId = options.coloredId;
                    }
                    options.coloredId = sElementId;
                    this.changeResultItemColor(options.coloredId, options.oldColoredId);
                    options.oldColoredId = options.coloredId;
                }
            }
        },

        handleArrowRightKey: function () {
            let options = this.options;
            let iIndex = null;
            let iDirection = null;
            let aTypes = this.getTypesList();

            if (options.iActLine < 0) {
                iIndex = 0;
                iDirection = 0;
            } else {
                let sCurrType = $("#" + this.getResultItemIdByLine(options.iActLine)).attr("data-object-type");
                if (sCurrType) {
                    if (sCurrType && sCurrType.length && aTypes.length > 1) {
                        iIndex = $.inArray(sCurrType, aTypes);
                        iDirection = options.blToggleLeftRightDirection ? -1 : 1;
                    }
                } else {
                    console.error("selected item has no data-object-type attribute, can not switch to next group");
                }
            }

            if (iIndex !== null) {
                let sNewType = aTypes[iIndex + iDirection];
                let sElementId = this.findFirstElementIdByObjectType(sNewType);
                if (sElementId) {
                    if (options.coloredId) {
                        options.oldColoredId = options.coloredId;
                    }
                    options.coloredId = sElementId;
                    this.changeResultItemColor(options.coloredId, options.oldColoredId);
                    options.oldColoredId = options.coloredId;
                }
            }
        },

        getTypesList: function () {
            let types = [];
            this.getResultItemListElement().each(function () {
                let objecttype = $(this).attr("data-object-type");
                if (objecttype) {
                    if (objecttype.length && $.inArray(objecttype, types) < 0) {
                        types.push(objecttype);
                    }
                } else {
                    console.error("no data-object-type attributes for grouping found");
                }
            });
            return types;
        },

        findFirstElementIdByObjectType: function (sType) {
            let options = this.options;
            let sId = null;
            this.getResultItemListElement().each(function (index) {
                if ($(this).attr("data-object-type") === sType) {
                    options.iActLine = index;
                    sId = $(this).attr("id");
                    return false;
                }
            });

            return sId;
        },

        handleEnterKeyOnSelectedItem: function () {
            let options = this.options;
            let element = $("#" + this.getResultItemIdByLine(options.iActLine));
            window.location.href = element.attr("href");
        },

        handleEnterKeyWithoutSelectedItem: function () {
            let self    = this;
            let options = this.options;

            if (options.isSend) {
                window.clearTimeout(options.isSend);
                self.hideSuggest();
            }
            let searchFormElement = $("#" + options.sSearchFormId);
            searchFormElement.off("submit");
            searchFormElement.submit();
        },

        handleEscapeKey: function () {
            let self    = this;
            self.hideSuggest();
        },

        handleOtherKeys: function () {
            let options = this.options;
            let event = options.currentEvent;
            let sKey = event.originalEvent.key;

            if (sKey !== "ArrowLeft" && sKey !== "ArrowRight") {
                this.showSuggestWindow();
            }
        },

        showSuggestWindow: function () {
            let options = this.options;

            if (options.currentEvent.originalEvent.key.toLowerCase() === "enter") {
                return;
            }

            if ($(options.sWaitMsgIdentificator).length === 0) {
                this.showWaitMessage();
                options.isSend = window.setTimeout(this.showResult(), 0);
            } else {
                this.showWaitMessage();
                if (options.isSend) {
                    window.clearTimeout(options.isSend);
                }
                options.isSend = window.setTimeout(this.showResult(), options.iDelay);
            }

            return null;
        },

        showWaitMessage: function () {
            let options = this.options;
            options.oAjaxResponseElement.html($("<div/>").html(options.sWaitMessage).text());
            this.setResponseElementStyle();
        },

        showResult: function () {
            let options = this.options;
            let el = this.element;
            let self = this;
            // don't use oD3SearchJQ.ajax, because it sends one letter per request
            $.get(options.sRequestUrl + "fnc=" + options.sRequestFncName + "&" + options.sSearchParamName + "=" + el.val(), function (data) {
                // prevent the display of outdated informations
                if (el.val() === data.searchparam) {
                    options.oAjaxResponseElement.html(data.content);
                    self.setItemsMouseHandler();
                    self.setResponseElementStyle();
                    self.setStartSearchButtonHandler();
                }
            });

            options.iActLine = -1;
            options.coloredId = -1;
            options.oldColoredId = -1;

            options.blNavigate = false;
        },

        setResponseElementStyle: function () {
            let self    = this;
            let options = this.options;
            let el = this.element;

            function setResponseStyles() {
                if (options.sActiveElementClassName) {
                    options.oAjaxResponseElement.addClass(options.sActiveElementClassName);
                }

                if (options.blSetActiveElementDimensions) {
                    options.oAjaxResponseElement.get(0).style.setProperty(
                        'top',
                        options.sActiveElementStyleTop ?
                            options.sActiveElementStyleTop :
                            el[0].hasAttribute("suggestTopOffsetPx") ?
                                (el.offset().top + (el.height() + 5) + parseInt(el.attr('suggestTopOffsetPx'), 10) + "px"):
                                (el.offset().top + (el.height() + 5) + "px"),
                        options.sActiveElementStyleTopImportant
                    );
                    options.oAjaxResponseElement.get(0).style.setProperty(
                        'left',
                        options.sActiveElementStyleLeft ?
                            options.sActiveElementStyleLeft :
                            el[0].hasAttribute("suggestLeftOffsetPx") ?
                                (el.offset().left + parseInt(el.attr('suggestLeftOffsetPx'), 10)) + "px":
                                (el.offset().left + "px"),
                        options.sActiveElementStyleLeftImportant
                    );
                    if (options.blAutomatedActiveElementStyleWidth) {
                        options.oAjaxResponseElement.get(0).style.setProperty(
                            'width',
                            options.sActiveElementStyleWidth ?
                                options.sActiveElementStyleWidth :
                                (el.width() + "px"),
                            options.sActiveElementStyleWidthImportant
                        );
                    }
                }
            }

            setResponseStyles();
            this.showSuggest();
            options.oAjaxResponseElement.click(function(event){   // required to prevent close on inside click
                event.stopPropagation();
            });
            this.element.click(function(event) {
                event.stopPropagation();
            });
            $("body").click(function() {
                self.hideSuggest();
            });
            $("#" + options.sCloseBtnId).click(function(event) {
                event.stopPropagation();
                self.hideSuggest();
            });
        },

        showSuggest: function () {
            this.options.oAjaxResponseElement.addClass('suggestVisible');
        },

        hideSuggest: function () {
            this.options.oAjaxResponseElement.removeClass('suggestVisible');
        },

        getResultItemListElement: function () {
            let options = this.options;
            return $(options.sResultListId).find("a" + options.sResultItemClass);
        },

        getResultItemCount: function () {
            return this.getResultItemListElement().length;
        },

        getResultItemIdByLine:function (iLine) {
            let iRet = null;
            this.getResultItemListElement().each(function (index) {
                if (index === iLine) {
                    iRet = $(this).attr("id");
                }
            });

            return iRet;
        },

        changeResultItemColor: function (newId, oldId) {
            let options = this.options;

            if (oldId !== -1 && oldId !== newId) {
                // don't use toggleClass, because this method is to slow for this case
                $("#" + oldId).addClass(options.sInactClassName).removeClass(options.sActClassName);
            }

            if (oldId !== newId) {
                $("#" + newId).addClass(options.sActClassName).removeClass(options.sInactClassName);
            }

            this.scrollToSelectedElement(newId);
        },

        scrollToSelectedElement: function (elementId) {
            let options = this.options;
            let currentEvent = options.currentEvent;
            let itemElement = $("#" + elementId);

            // if list doesn't exist or event is mouse event
            if (itemElement.length === 0 || currentEvent.type.toLowerCase().indexOf("mouse") >= 0) {
                return;
            }

            let listElement = $(options.sResultListId);
            let iPosition = itemElement.position().top + listElement.scrollTop() - options.iScrollTopOffset;
            listElement.stop(true).animate({
                scrollTop: iPosition
            }, "slow");
        },

        setItemsMouseHandler: function () {
            let self = this;
            let options = this.options;
            this.getResultItemListElement().each(function (index) {
                $(this).mouseover(function(event) {
                    options.currentEvent = event;
                    let sElementId = self.getResultItemIdByLine(index);
                    self.mouseHandler(sElementId, index);
                });
            });
        },

        setStartSearchButtonHandler: function () {
            let self = this;
            let options = this.options;

            $("#" + options.sStartSearchButtonId).click(function(event) {
                event.preventDefault();
                self.handleEnterKeyWithoutSelectedItem();
            });
        }
    });
}(jQuery));
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
    $.widget( "ui.d3extsearchias", {
        // default options
        options: {
            sElementId: "IAS_box",
            sInputElementId: "IAS_input",
            sCloseElementId: "IAS_closebtn",
            iPosOffset: 10, // in px
            sLastSelection: "",
            iDelay: 600,    // in ms between click outside and deactivating of the box
            oClearWnd: null
        },

        _create: function () {
            var self = this;
            var el      = this.element;
            var options = this.options;

            $("#" + options.sElementId).mouseup(function(event) {
                event.stopPropagation();
            });
            $("body").mouseup(function(event) {
                self.checkIasWindow(event);
            });
            $("#" + options.sCloseElementId).click(function() {
                self.clearIasWindow();
            });
        },

        showIasWindow: function (event) {
            var options = this.options;
            var oIASBoxElement = $("#" + options.sElementId);
            var oIASInputElement = $("#" + options.sInputElementId);
            if (oIASBoxElement.length) {
                var sSelection = this.getSelection();
                if (sSelection !== options.sLastSelection && sSelection.length > 0) {
                    oIASBoxElement.show().css({
                        "top":event.pageY + options.iPosOffset + "px",
                        "left":event.pageX + options.iPosOffset + "px"
                    });
                    oIASInputElement.val(sSelection);
                    options.sLastSelection = sSelection;
                }
            }
        },

        checkIasWindow: function (event) {
            if (this.getSelection()) {
                this.showIasWindow(event);
            } else {
                this.clearIasWindow();
            }
        },

        clearIasWindow: function () {
            var options = this.options;
            $("#" + options.sElementId).hide();
            options.sLastSelection = "";
        },

        getSelection: function () {
            var oSelection;
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
        }
    });
}(jQuery));


/*global tx_solr_suggestUrl*/
/*global Awesomplete*/
/*global touchSupport*/

// global var
// container for Search suggestion data
var mainSearchInputList = {};

(function($) {
    'use strict';

    // init function
    var searchSuggestFn = function() {

        // ============================
        // Search Suggest DATA-API
        // ============================
        $('[data-search="searchSuggest"]').each(function(index, el) {
            mainSearchInputList['searchItem' + index] = new Awesomplete(el, {
                list: [],
                maxItems: 20,
                minChars: 2,
                autoFirst: true
            });
            var req = false;
            $(this).on('keyup.search.suggest', function(e) {
                var c = e.keyCode;
                if (c === 13 ||c === 27 || c === 38 || c === 40) {
                    return;
                }
                var that = $(this);
                var fetchSuggestData = function() {
                    if (!req) {
                        req = true;
                        $.ajax({
                            url: tx_solr_suggestUrl, // jscs:ignore requireCamelCaseOrUpperCaseIdentifiers
                            dataType: 'json',
                            data:{
                                termLowercase: that.val().toLowerCase(),
                                termOriginal: that.val(),
                                L: jQuery('div.tx-solr input[name="L"]').val()
                            },
                            success: function(data) {
                                req = false;
                                var arrr = [];
                                $.each(data, function(term) {
                                    arrr.push(term);
                                });
                                mainSearchInputList['searchItem' + index]._list = arrr;
                                mainSearchInputList['searchItem' + index].evaluate();
                            }
                        });
                    }
                };
                typeof tx_solr_suggestUrl !== 'undefined' && fetchSuggestData(); // jscs:ignore requireCamelCaseOrUpperCaseIdentifiers
            });
            $(this).on('awesomplete-selectcomplete', function() {
                $(this).closest('form').submit();
            });
        });
        // =============end==============

    };

    // document load event
    $(document).ready(function() {
        if (!touchSupport && $(window).width() >= 992) {
            searchSuggestFn();
        }
    });

})(jQuery);

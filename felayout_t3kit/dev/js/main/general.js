// ########## general.js ###########
/* global jQuery */

;(function ($) {
  'use strict'

  // document load event
  $(document).ready(function () {
    // Image Lightbox
    // initialize simpleLightbox when document ready
    // https://github.com/andreknieriem/simplelightbox
    $("div[class*='lightbox__wrp-']").each(function () {
      $(this).find('.lightbox').simpleLightbox({
        captionType: 'data',
        captionsData: 'caption',
        captionPosition: 'outside',
        heightRatio: 0.6
      })
    })
  })
})(jQuery)

// ^^^^^^^^^^ general.js ^^^^^^^^^^^

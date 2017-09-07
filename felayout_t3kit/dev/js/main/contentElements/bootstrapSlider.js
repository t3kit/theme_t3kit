/* global jQuery */

;(function ($) {
  'use strict'
  // document load event
  $(document).ready(function () {
    $('.carousel').each(function () {
      $(this).swipe({
        swipe: function (event, direction) {
          if (direction === 'left') {
            $(this).carousel('next')
          }
          if (direction === 'right') {
            $(this).carousel('prev')
          }
        },
        allowPageScroll: 'vertical'
      })
    })
  })
})(jQuery)

/* global jQuery */

;(function ($) {
  'use strict'

  // document load event
  $(document).ready(function () {
    // Parallax
    // https://github.com/nk-o/jarallax
    if (!$('html').hasClass('IE')) { // disabled in IE since scrolling looks jerky
      $('.parallax-img').jarallax({
        type: 'scroll', // scroll, scale, opacity, scroll-opacity, scale-opacit
        speed: 0.5,
        disableParallax: /iPad|iPhone|iPod/ // disable Ios
      })
      $('.parallax-resimg').each(function () {
        $(this).jarallax({
          type: 'scroll', // scroll, scale, opacity, scroll-opacity, scale-opacit
          speed: 0.5,
          disableParallax: /iPad|iPhone|iPod/, // disable Ios
          imgSrc: $(this).css('background-image').trim().slice(5, -2)
        })
      })
      $('.parallax-video').jarallax({
        type: 'scroll', // scroll, scale, opacity, scroll-opacity, scale-opacit
        speed: 0.5,
        disableParallax: /iPad|iPhone|iPod|Android/ // disable Ios and Android
      })
    }
  })
})(jQuery)

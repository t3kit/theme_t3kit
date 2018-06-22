/* global jQuery */

;(function ($) {
  'use strict'

  // document load event
  $(document).ready(function () {
    // Parallax
    // https://github.com/nk-o/jarallax
    if (!$('html').hasClass('IE')) { // disabled in IE since scrolling looks jerky
      $('.parallax-img').jarallax({
        type: 'scroll', // scroll, scale, opacity, scroll-opacity, scale-opacity
        speed: 0.5,
        disableParallax: /iPad|iPhone|iPod|Edge/ // disable Ios and Microsoft Edge
      })
      $('.parallax-resimg').each(function () {
        $(this).jarallax({
          type: 'scroll', // scroll, scale, opacity, scroll-opacity, scale-opacity
          speed: 0.5,
          disableParallax: /iPad|iPhone|iPod|Edge/, // disable Ios and Microsoft Edge
          imgSrc: $(this).css('background-image').match(/\(([^)]+)\)/)[1].replace(/"/g, '')
        })
      })
      $('.parallax-video').each(function () {
        $(this).jarallax({
          type: 'scroll', // scroll, scale, opacity, scroll-opacity, scale-opacity
          speed: 0.5,
          disableParallax: /iPad|iPhone|iPod|Android/, // disable Ios and Android
          videoSrc: $(this).attr('data-video-url')
        })
      })
    }
  })
})(jQuery)

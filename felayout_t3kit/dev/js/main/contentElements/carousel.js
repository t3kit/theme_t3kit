/* global jQuery */

;(function ($) {
  'use strict'
  // document load event
  $(document).ready(function () {
    // initialize swiper when document ready
    // http://idangero.us/swiper/api/
    $('.js__logo-carousel').each(function () {
      // Get json content from element LogoCarousel.html
      var label = JSON.parse($('#js__aria-labels').html())

      $(this).swiper({
        nextButton: '.js__logo-carousel__btn-next',
        prevButton: '.js__logo-carousel__btn-prev',
        slidesPerView: 5,
        preloadImages: false,
        lazyLoading: true,
        watchSlidesVisibility: true,
        lazyLoadingInPrevNext: true,
        spaceBetween: 20,
        autoplay: $(this).data('autoplay'),
        a11y: true,
        prevSlideMessage: label.ariaLabel.prevSlideMessage,
        nextSlideMessage: label.ariaLabel.nextSlideMessage,
        firstSlideMessage: label.ariaLabel.firstSlideMessage,
        lastSlideMessage: label.ariaLabel.lastSlideMessage,
        paginationBulletMessage: label.ariaLabel.paginationBulletMessage,
        // Responsive breakpoints
        breakpoints: {
          // when window width is <= 480px
          480: {
            slidesPerView: 1
          },

          // when window width is <= 600px
          600: {
            slidesPerView: 2
          },

          // when window width is <= 768px
          768: {
            slidesPerView: 3
          },

          // when window width is <= 992px
          992: {
            slidesPerView: 4
          }
        }
      })
    })
  })
})(jQuery)

/* global Swiper*/
(function($) {
    'use strict';
    // document load event
    $(document).ready(function() {
        var $swiperContainerWrapper = $('.js__slider-container__wrapper');
        $swiperContainerWrapper.each(function() {
            $(this).children().wrap('<div class="swiper-slide slider-container__slide js__slider-container__slide"></div>');
        });

        var $swiperContainer = $('.js__slider-container__container');
        $swiperContainer.each(function() {
            var time = $(this).attr('data-autoplay');
            var loopParam = $(this).attr('data-loop');
            var amountOfSlides = parseInt($(this).attr('data-slidesperview'));
            var effectName = $(this).attr('data-effect');
            var transition = $(this).attr('data-speed');
            var widthForMobile;
            var widthForTablet;
            var widthForLaptop;
            var widthForMediumLaptop;
            if (amountOfSlides >= 4) {
                widthForMobile = 1,
                widthForTablet = 2,
                widthForLaptop = 3,
                widthForMediumLaptop = 4;
            } else if (amountOfSlides === 2) {
                widthForMobile = 1,
                widthForTablet = 1,
                widthForLaptop = 1,
                widthForMediumLaptop = 2;
            } else if (amountOfSlides === 1) {
                widthForMobile = 1,
                widthForTablet = 1,
                widthForLaptop = 1,
                widthForMediumLaptop = 1;
            } else {
                widthForMobile = 1,
                widthForTablet = 2,
                widthForLaptop = 2,
                widthForMediumLaptop = 3;
            }
            var slider = new Swiper($(this), {
                containerModifierClass:'js__slider-container__container',
                wrapperClass:'js__slider-container__wrapper',
                slideClass:'js__slider-container__slide',
                nextButton: $(this).parent().find('.js__slider-container__btn-next'),
                prevButton: $(this).parent().find('.js__slider-container__btn-prev'),
                pagination: $(this).parent().find('.js__slider-container__pagination'),
                paginationClickable: true,
                speed: parseInt(transition),
                loop:loopParam,
                autoplay: time,
                effect:effectName,
                watchSlidesVisibility: true,
                spaceBetween: 20,
                preloadImages: false,
                lazyLoading: true,
                lazyLoadingInPrevNext: true,
                slidesPerView: amountOfSlides,
                breakpoints:{
                    // Responsive breakpoints
                    480: {
                        slidesPerView:widthForMobile
                    },
                    767: {
                        slidesPerView:widthForTablet
                    },
                    992: {
                        slidesPerView:widthForLaptop
                    },
                    1024:{
                        slidesPerView:widthForMediumLaptop
                    }
                },
                coverflow: {
                    rotate: 90,
                    stretch: 0,
                    depth: 200,
                    modifier: 1,
                    slideShadows: false
                },
                cube: {
                    slideShadows: false,
                    shadow: false
                },
                fade: {
                    crossFade: true
                },
                flip: {
                    slideShadows: false,
                    limitRotation: true
                }
            });
            // Makes it possible to skip between slider images if they have links, using the tab button
            slider.container.on('focus', 'a', function(e) {
                //Index of focused slide
                var focusIndex = $(e.target).parents('.slider-container__slide').index();
                //Reset scrollLeft set by browser on focus
                slider.container.scrollLeft(0);
                // IE fix
                setTimeout(function() {
                    slider.container.scrollLeft(0);
                }, 0);
                //Slide to focused slide
                slider.slideTo(focusIndex);
            });
        });
    });
})(jQuery);

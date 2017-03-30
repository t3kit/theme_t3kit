
// header
// =================================
// Global variables (jshint):

/*global touchSupport*/
// =================================

jQuery(function($) {
    // Caching variables
    var $html = $('html');
    var $mainNavigation = $('.js__main-navigation');
    var $openSubMenuLink = $('.js__main-navigation__open-sub-menu-link');
    var $mainNavigationItemsList = $mainNavigation.find('.js__main-navigation__items-list').children('li');
    var $secondNavLevel = $('.second-navigation-level');
    var $thirdNavLevel = $('.third-navigation-level');
    var $openThirdMenuLink = $('.js__main-navigation__open-third-menu-link');
    var $dropdownMenuWithColumns = $('.js__dropdown-menu-with-columns .js__main-navigation__item._sub');

    if (!touchSupport) {
        $dropdownMenuWithColumns.hover(function() {
            $(this).toggleClass('open');
        });
    }

    // Set class for third-navigation-level to handle position on left or right
    var setThirdMenuPosition = function() {
        if ($thirdNavLevel.length) {
            if (window.matchMedia('(min-width: 992px)').matches) {
                $secondNavLevel.each(function() {
                    var offsetRight = $(window).width() - $(this).offset().left - $(this).outerWidth();
                    var secondNavLevelWidth = $(this).width();
                    var thirdNavLevelWidth = $(this).find($thirdNavLevel).width();
                    if (offsetRight < thirdNavLevelWidth) {
                        $(this).find($thirdNavLevel).css('left', -secondNavLevelWidth);
                    } else {
                        $(this).find($thirdNavLevel).css('left', secondNavLevelWidth);
                    }
                });
            } else {
                $thirdNavLevel.css('left', 'auto');
            }
        }
    };
    // Initial call for function
    setThirdMenuPosition();
    // Cleanup function to clean unneeded classes
    var cleanup = function() {
        $mainNavigation.find('.js__main-navigation__items-list').find('li').removeClass('_open-mobile-dropdown _open-tablet-dropdown');
        $html.removeClass('mobile-menu-opened');

        if (window.matchMedia('(min-width: 992px)').matches) {
            $('.js__navigation__items-wrp').show();
        } else {
            $('.js__navigation__items-wrp').hide();
        }

        //Set timeout for third menu position to load the width
        window.setTimeout(function() {
            setThirdMenuPosition();
        }, 500);
    };

    // Add click event to dropdown link on mobile devices.
    $openSubMenuLink.on('click', function(e) {
        e.preventDefault();
        if (window.matchMedia('(min-width: 992px)').matches) {
            $mainNavigationItemsList.not($(this).parents()).removeClass('_open-tablet-dropdown');
            $(this).parents('.main-navigation__item').toggleClass('_open-tablet-dropdown');
        } else {
            $(this).parents('.main-navigation__item').toggleClass('_open-mobile-dropdown');
        }
    });

    // Add click event to second menu dropdown link on mobile devices.
    $openThirdMenuLink.on('click', function(e) {
        e.preventDefault();
        if (window.matchMedia('(min-width: 992px)').matches) {
            $('.main-navigation__sub-item').not($(this).parents('.main-navigation__sub-item')).removeClass('_open-tablet-dropdown');
            $(this).parents('.main-navigation__sub-item').toggleClass('_open-tablet-dropdown');
        } else {
            $(this).parents('.main-navigation__sub-item').toggleClass('_open-mobile-dropdown');
        }
    });

    var mobileMenuAnimationComplete = true;
    $('.js__main-navigation__toggle-btn').on('click', function(e) {
        e.preventDefault();
        if (mobileMenuAnimationComplete) {
            mobileMenuAnimationComplete = false;
            $html.toggleClass('mobile-menu-opened');
        }
        $('.js__navigation__items-wrp').not(':animated').slideToggle(300, function() {
            mobileMenuAnimationComplete = true;
        });
    });

    // detect if we cross 992px window width.
    window.matchMedia('(min-width: 992px)').addListener(cleanup);
});

// ====== class fo fixed main navigation bar   =======
jQuery(function($) {
    var navbar = $('.js__main-navigation');

    if (navbar.length) {
        var offsetTop = navbar.offset().top;

        // function that calculates offsetTop-value.
        var calcOffsetTop = function() {
            if (window.matchMedia('(min-width: 992px)').matches) {
                var navbarPos = navbar.css('position');
                offsetTop = $('header').height() - (navbarPos === 'fixed' ? 0 : navbar.outerHeight());
            }
        };

        // detect if we cross 992px window width.
        window.matchMedia('(min-width: 992px)').addListener(calcOffsetTop);

        $(window).on('load scroll', function() {
            var scrollPos = $(window).scrollTop();
            if (scrollPos > offsetTop) {
                $('body').addClass('main-navigation-fixed');
            } else {
                $('body').removeClass('main-navigation-fixed');
            }
        });
    }
});

jQuery(function($) {
    var $mainNavigationSearchBtn = $('.js__main-navigation__search-btn');
    var $mainNavigationSearchBox = $('.js__main-navigation__search-box');
    var $mainNavigationSearchBoxOverlay = $('.js__main-navigation__search-box-overlay');

    var $languageMenuOverlay = $('.js__header-top__language-menu-overlay');
    var $languageMenuBtn = $('.js__header-top__language-menu-btn');
    var $languageMenuBox = $('.js__header-top__language-menu-box');
    var $languageMenuBoxCloseBtn = $('.js__header-top__language-menu-box-close-btn');

    $mainNavigationSearchBtn.on('click', function(e) {
        e.preventDefault();
        $(this).toggleClass('_search-close-btn');
        $mainNavigationSearchBox.toggleClass('_search-box-visible');
        if ($mainNavigationSearchBox.hasClass('_search-box-visible')) {
            $mainNavigationSearchBox.find('input[type="search"]').focus();
        }
        $mainNavigationSearchBoxOverlay.toggleClass('_search-box-overlay-visible');
    });
    $mainNavigationSearchBoxOverlay.on('click', function() {
        $(this).toggleClass('_search-box-overlay-visible');
        $mainNavigationSearchBtn.toggleClass('_search-close-btn');
        $mainNavigationSearchBox.toggleClass('_search-box-visible');
    });

    $languageMenuBtn.on('click', function(e) {
        e.preventDefault();
        $languageMenuBox.addClass('_language-menu-box-visible');
        $languageMenuOverlay.toggleClass('_language-menu-box-overlay-visible');
    });
    $languageMenuOverlay.on('click', function() {
        $(this).toggleClass('_language-menu-box-overlay-visible');
        $languageMenuBox.removeClass('_language-menu-box-visible');
    });
    $languageMenuBoxCloseBtn.on('click', function() {
        $languageMenuOverlay.toggleClass('_language-menu-box-overlay-visible');
        $languageMenuBox.removeClass('_language-menu-box-visible');
    });

});


// elements
/* global Swiper*/
(function($) {
    'use strict';

    // document load event
    $(document).ready(function() {

        // initialize swiper when document ready
        // http://idangero.us/swiper/api/
        var $elem = $('.js__img-slider');
        $elem.each(function() {
            var time = $(this).attr('data-autoplay');
            var slider = new Swiper($(this), {
                nextButton: '.js__img-slider__btn-next',
                prevButton: '.js__img-slider__btn-prev',
                pagination: '.js__img-slider__pagination',
                paginationClickable: true,
                preloadImages: false,
                lazyLoading: true,
                watchSlidesVisibility: true,
                lazyLoadingInPrevNext: true,
                speed: 600,
                autoplay: time
            });
            // Makes it possible to skip between slider images if they have links, using the tab button
            slider.container.on('focus', 'a', function(e) {
                //Index of focused slide
                var focusIndex = $(e.target).parents('.swiper-slide').index();
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

(function($) {
    'use strict';

    // document load event
    $(document).ready(function() {

        // initialize swiper when document ready
        // http://idangero.us/swiper/api/
        $('.js__logo-carousel').swiper({
            nextButton: '.js__logo-carousel__btn-next',
            prevButton: '.js__logo-carousel__btn-prev',
            slidesPerView: 5,
            preloadImages: false,
            lazyLoading: true,
            watchSlidesVisibility: true,
            lazyLoadingInPrevNext: true,
            spaceBetween: 20,
            autoplay: 2500,

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
        });
    });

})(jQuery);

(function($) {
    'use strict';

    // document load event
    $(document).ready(function() {
        // Parallax
        // https://github.com/nk-o/jarallax
        if (!$('html').hasClass('IE')) { // disabled in IE since scrolling looks jerky
            $('.parallax-img').jarallax({
                type: 'scroll', //scroll, scale, opacity, scroll-opacity, scale-opacit
                speed: 0.5,
                noAndroid: false,
                noIos: true
            });
            $('.parallax-video').jarallax({
                type: 'scroll', //scroll, scale, opacity, scroll-opacity, scale-opacit
                speed: 0.5,
                noAndroid: true,
                noIos: true
            });
        }
    });

})(jQuery);

(function($) {
    'use strict';

    // document load event
    $(document).ready(function() {
        var $frame = $('.js__hero-image');
        var $slider = $('.slider-container');
        $frame.each(function() {
            var self = $(this);
            if (!self.parents('.swiper-wrapper').length){
                self.addClass('_animated');
            }
        });
        $slider.each(function() {
            if ($(this).find($frame).length){
                $(this).addClass('_full-width');
            }
        });
    });

})(jQuery);

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

(function($) {
    'use strict';

    // document load event
    $(document).ready(function() {

        var $paragraph = $('.js__img-text-link');

        $paragraph.dotdotdot({
            height: 60
        });

    });

})(jQuery);


// plugins
(function($) {
    'use strict';

    // document load event
    $(document).ready(function() {

        // initialize swiper when document ready
        // http://idangero.us/swiper/api/
        $('.js__news-carousel').each(function() {
            $(this).swiper({
                nextButton: $(this).parent().find('.js__news-carousel__btn-next'),
                prevButton: $(this).parent().find('.js__news-carousel__btn-prev'),
                pagination: '.js__news-carousel__pagination',
                paginationClickable: true,
                slidesPerView: 4,
                preloadImages: false,
                spaceBetween: 30,

                // Responsive breakpoints
                breakpoints: {

                    // when window width is <= 480px
                    500: {
                        slidesPerView: 1
                    },
                    // when window width is <= 768px
                    767: {
                        slidesPerView: 2
                    },
                    // when window width is <= 992px
                    991: {
                        slidesPerView: 3
                    },
                    // when window width is <= 1199px
                    1199: {
                        slidesPerView: 4
                    }
                }
            });
        });
    });

})(jQuery);

// news Timeline
$('.js__news-timeline__item').on('click', function(e) {
    if ($(this).hasClass('collapsed')){
        e.preventDefault();
        $(this).removeClass('collapsed');
        $(this).closest('.js__news-timeline__item-wrp').find('.js__news-timeline__date').addClass('open');
    }
});

// news Cards
$('.js__news-cards__dotdotdot').dotdotdot({
    watch: 'window'
});

// news Simple list
$('.js__news-simple-list__dotdotdot').dotdotdot({
    watch: 'window'
});


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


// ########## general.js ###########

(function($) {
    'use strict';

    // document load event
    $(document).ready(function() {

        // Image Lightbox
        // initialize simpleLightbox when document ready
        // https://github.com/andreknieriem/simplelightbox
        $('.lightbox').simpleLightbox({
            captionType: 'data',
            captionsData: 'caption',
            captionPosition: 'outside',
            heightRatio: 0.6
        });
    });

})(jQuery);

// ^^^^^^^^^^ general.js ^^^^^^^^^^^


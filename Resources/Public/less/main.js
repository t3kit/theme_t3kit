
// header
/* global touchSupport, jQuery */

jQuery(function ($) {
  // Caching variables
  var $html = $('html')
  var $mainNavigation = $('.js__main-navigation')
  var $openSubMenuLink = $('.js__main-navigation__open-sub-menu-link')
  var $mainNavigationItemsList = $mainNavigation.find('.js__main-navigation__items-list').children('li')
  var $secondNavLevel = $('.second-navigation-level')
  var $thirdNavLevel = $('.third-navigation-level')
  var $openThirdMenuLink = $('.js__main-navigation__open-third-menu-link')
  var $dropdownMenuWithColumns = $('.js__dropdown-menu-with-columns .js__main-navigation__item._sub')

  if (!touchSupport) {
    $dropdownMenuWithColumns.hover(function () {
      $(this).toggleClass('open')
    })
  }

  // Set class for third-navigation-level to handle position on left or right
  var setThirdMenuPosition = function () {
    if ($thirdNavLevel.length) {
      if (window.matchMedia('(min-width: 992px)').matches) {
        $secondNavLevel.each(function () {
          var offsetRight = $(window).width() - $(this).offset().left - $(this).outerWidth()
          var secondNavLevelWidth = $(this).width()
          var thirdNavLevelWidth = $(this).find($thirdNavLevel).width()
          if (offsetRight < thirdNavLevelWidth) {
            $(this).find($thirdNavLevel).css('left', -secondNavLevelWidth)
          } else {
            $(this).find($thirdNavLevel).css('left', secondNavLevelWidth)
          }
        })
      } else {
        $thirdNavLevel.css('left', 'auto')
      }
    }
  }
  // Initial call for function
  setThirdMenuPosition()
  // Cleanup function to clean unneeded classes
  var cleanup = function () {
    $mainNavigation.find('.js__main-navigation__items-list').find('li').removeClass('_open-mobile-dropdown _open-tablet-dropdown')
    $html.removeClass('mobile-menu-opened')

    if (window.matchMedia('(min-width: 992px)').matches) {
      $('.js__navigation__items-wrp').show()
    } else {
      $('.js__navigation__items-wrp').hide()
    }

    // Set timeout for third menu position to load the width
    window.setTimeout(function () {
      setThirdMenuPosition()
    }, 500)
  }

  // Add click event to dropdown link on mobile devices.
  $openSubMenuLink.on('click', function (e) {
    e.preventDefault()
    if (window.matchMedia('(min-width: 992px)').matches) {
      $mainNavigationItemsList.not($(this).parents()).removeClass('_open-tablet-dropdown')
      $(this).parents('.main-navigation__item').toggleClass('_open-tablet-dropdown')
    } else {
      $(this).parents('.main-navigation__item').toggleClass('_open-mobile-dropdown')
    }
  })

  // Add click event to second menu dropdown link on mobile devices.
  $openThirdMenuLink.on('click', function (e) {
    e.preventDefault()
    if (window.matchMedia('(min-width: 992px)').matches) {
      $('.main-navigation__sub-item').not($(this).parents('.main-navigation__sub-item')).removeClass('_open-tablet-dropdown')
      $(this).parents('.main-navigation__sub-item').toggleClass('_open-tablet-dropdown')
    } else {
      $(this).parents('.main-navigation__sub-item').toggleClass('_open-mobile-dropdown')
    }
  })

  var mobileMenuAnimationComplete = true
  $('.js__main-navigation__toggle-btn').on('click', function (e) {
    e.preventDefault()
    if (mobileMenuAnimationComplete) {
      mobileMenuAnimationComplete = false
      $html.toggleClass('mobile-menu-opened')
    }
    $('.js__navigation__items-wrp').not(':animated').slideToggle(300, function () {
      mobileMenuAnimationComplete = true
    })
  })

  // detect if we cross 992px window width.
  window.matchMedia('(min-width: 992px)').addListener(cleanup)
})

// ====== class fo fixed main navigation bar   =======
jQuery(function ($) {
  var navbar = $('.js__main-navigation')

  if (navbar.length) {
    var offsetTop = navbar.offset().top

    // function that calculates offsetTop-value.
    var calcOffsetTop = function () {
      if (window.matchMedia('(min-width: 992px)').matches) {
        var navbarPos = navbar.css('position')
        offsetTop = $('header').height() - (navbarPos === 'fixed' ? 0 : navbar.outerHeight())
      }
    }

    // detect if we cross 992px window width.
    window.matchMedia('(min-width: 992px)').addListener(calcOffsetTop)
    $(window).on('load scroll', function () {
      var scrollPos = $(window).scrollTop()
      if (scrollPos > offsetTop) {
        $('body').addClass('main-navigation-fixed')
      } else {
        $('body').removeClass('main-navigation-fixed')
      }
    })
  }
})

jQuery(function ($) {
  var $mainNavigationSearchBtn = $('.js__main-navigation__search-btn')
  var $mainNavigationSearchBox = $('.js__main-navigation__search-box')
  var $mainNavigationSearchBoxOverlay = $('.js__main-navigation__search-box-overlay')

  var $languageMenuOverlay = $('.js__header-top__language-menu-overlay')
  var $languageMenuBtn = $('.js__header-top__language-menu-btn')
  var $languageMenuBox = $('.js__header-top__language-menu-box')
  var $languageMenuBoxCloseBtn = $('.js__header-top__language-menu-box-close-btn')

  $mainNavigationSearchBtn.on('click', function (e) {
    e.preventDefault()
    $(this).toggleClass('_search-close-btn')
    $mainNavigationSearchBox.toggleClass('_search-box-visible')
    if ($mainNavigationSearchBox.hasClass('_search-box-visible')) {
      $mainNavigationSearchBox.find('input[type="search"]').focus()
    }
    $mainNavigationSearchBoxOverlay.toggleClass('_search-box-overlay-visible')
  })
  $mainNavigationSearchBoxOverlay.on('click', function () {
    $(this).toggleClass('_search-box-overlay-visible')
    $mainNavigationSearchBtn.toggleClass('_search-close-btn')
    $mainNavigationSearchBox.toggleClass('_search-box-visible')
  })
  $languageMenuBtn.on('click', function (e) {
    e.preventDefault()
    $languageMenuBox.addClass('_language-menu-box-visible')
    $languageMenuOverlay.toggleClass('_language-menu-box-overlay-visible')
  })
  $languageMenuOverlay.on('click', function () {
    $(this).toggleClass('_language-menu-box-overlay-visible')
    $languageMenuBox.removeClass('_language-menu-box-visible')
  })
  $languageMenuBoxCloseBtn.on('click', function () {
    $languageMenuOverlay.toggleClass('_language-menu-box-overlay-visible')
    $languageMenuBox.removeClass('_language-menu-box-visible')
  })
})


// elements
/* global Swiper, jQuery */

;(function ($) {
  'use strict'

  // document load event
  $(document).ready(function () {
    // initialize swiper when document ready
    // http://idangero.us/swiper/api/
    var $elem = $('.js__img-slider')
    $elem.each(function () {
      var time = $(this).attr('data-autoplay')
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
      })
      // Makes it possible to skip between slider images if they have links, using the tab button
      slider.container.on('focus', 'a', function (e) {
        // Index of focused slide
        var focusIndex = $(e.target).parents('.swiper-slide').index()
        // Reset scrollLeft set by browser on focus
        slider.container.scrollLeft(0)

        // IE fix
        setTimeout(function () {
          slider.container.scrollLeft(0)
        }, 0)
        // Slide to focused slide
        slider.slideTo(focusIndex)
      })
    })
  })
})(jQuery)

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

      var swiper = $(this).swiper({
        nextButton: '.js__logo-carousel__btn-next',
        prevButton: '.js__logo-carousel__btn-prev',
        slidesPerView: 5,
        preloadImages: false,
        lazyLoading: true,
        watchSlidesVisibility: true,
        lazyLoadingInPrevNext: true,
        slideVisibleClass: 'is-visible',
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
      // if the selected swipe is not visible when focused
      // put it into view
      $(swiper.slides).each(function (index, element) {
        $(element).on('focusin', function (e) {
          if ($(e.target).not('.is-visible')) {
            swiper.slideTo(index)
          }
        })
      })
    })
  })
})(jQuery)

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
        noAndroid: false,
        noIos: true
      })
      $('.parallax-resimg').each(function () {
        $(this).jarallax({
          type: 'scroll', // scroll, scale, opacity, scroll-opacity, scale-opacit
          speed: 0.5,
          noAndroid: false,
          imgSrc: $(this).css('background-image').trim().slice(5, -2),
          noIos: true
        })
      })
      $('.parallax-video').jarallax({
        type: 'scroll', // scroll, scale, opacity, scroll-opacity, scale-opacit
        speed: 0.5,
        noAndroid: true,
        noIos: true
      })
    }
  })
})(jQuery)

/* global jQuery */

;(function ($) {
  'use strict'

  // document load event
  $(document).ready(function () {
    var $frame = $('.js__hero-image')
    // var $slider = $('.slider-container')
    $frame.each(function () {
      var self = $(this)
      var $p = self.find('.hero-image__caption-p')
      if ($p.length) {
        $p.dotdotdot({
          watch: 'window',
          height: 55
        })
      }
      if (!self.parents('.swiper-wrapper').length) {
        self.addClass('_animated')
      }
    })
  })
})(jQuery)

/* global Swiper,jQuery */
;(function ($) {
  'use strict'
  // document load event
  $(document).ready(function () {
    var $swiperContainerWrapper = $('.js__slider-container__wrapper')
    $swiperContainerWrapper.each(function () {
      $(this).children().wrap('<div class="swiper-slide slider-container__slide js__slider-container__slide"></div>')
    })

    var $swiperContainer = $('.js__slider-container__container')
    $swiperContainer.each(function () {
      var time = $(this).attr('data-autoplay')
      var loopParam = $(this).attr('data-loop')
      var amountOfSlides = parseInt($(this).attr('data-slidesperview'))
      var effectName = $(this).attr('data-effect')
      var transition = $(this).attr('data-speed')
      var widthForMobile
      var widthForTablet
      var widthForLaptop
      var widthForMediumLaptop
      if (amountOfSlides >= 4) {
        widthForMobile = 1
        widthForTablet = 2
        widthForLaptop = 3
        widthForMediumLaptop = 4
      } else if (amountOfSlides === 2) {
        widthForMobile = 1
        widthForTablet = 1
        widthForLaptop = 1
        widthForMediumLaptop = 2
      } else if (amountOfSlides === 1) {
        widthForMobile = 1
        widthForTablet = 1
        widthForLaptop = 1
        widthForMediumLaptop = 1
      } else {
        widthForMobile = 1
        widthForTablet = 2
        widthForLaptop = 2
        widthForMediumLaptop = 3
      }
      var slider = new Swiper($(this), {
        containerModifierClass: 'js__slider-container__container',
        wrapperClass: 'js__slider-container__wrapper',
        slideClass: 'js__slider-container__slide',
        nextButton: $(this).parent().find('.js__slider-container__btn-next'),
        prevButton: $(this).parent().find('.js__slider-container__btn-prev'),
        pagination: $(this).parent().find('.js__slider-container__pagination'),
        paginationClickable: true,
        speed: parseInt(transition),
        loop: loopParam,
        autoplay: time,
        effect: effectName,
        watchSlidesVisibility: true,
        spaceBetween: 20,
        preloadImages: false,
        lazyLoading: true,
        lazyLoadingInPrevNext: true,
        slidesPerView: amountOfSlides,
        breakpoints: {
          // Responsive breakpoints
          480: {
            slidesPerView: widthForMobile
          },
          767: {
            slidesPerView: widthForTablet
          },
          992: {
            slidesPerView: widthForLaptop
          },
          1024: {
            slidesPerView: widthForMediumLaptop
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
          slideShadows: false
        }
      })
      // Makes it possible to skip between slider images if they have links, using the tab button
      slider.container.on('focus', 'a', function (e) {
        // Index of focused slide
        var focusIndex = $(e.target).parents('.slider-container__slide').index()
        // Reset scrollLeft set by browser on focus
        slider.container.scrollLeft(0)
        // IE fix
        setTimeout(function () {
          slider.container.scrollLeft(0)
        }, 0)
        // Slide to focused slide
        slider.slideTo(focusIndex)
      })
    })
  })
})(jQuery)

/* global jQuery */

;(function ($) {
  'use strict'

  // document load event
  $(document).ready(function () {
    var $paragraph = $('.js__img-text-link')
    $paragraph.dotdotdot({
      height: 60
    })
  })
})(jQuery)

/* global jQuery */

;(function ($) {
  'use strict'
  // document load event
  $(document).ready(function () {
    $('.carousel').each(function () {
      var $this = $(this)
      var $quickLinks = $this.find('.carousel-indicators li')
      var $control = $this.find('.carousel-control')
      var $btn = $this.find('.carousel__btn')

      // Set tabindex on quicklinks on init
      $quickLinks.attr('tabindex', 0)

      // add handler to quickLinks to allow changing the slide via enter key
      $this.on('keydown', $quickLinks, function (e) {
        if (e.which === 13) {
          $(e.target).trigger('click')
        }
      })

      // Enable swipe for each carousel element
      $this.swipe({
        swipe: function (event, direction) {
          if (direction === 'left') {
            $this.carousel('next')
          }
          if (direction === 'right') {
            $this.carousel('prev')
          }
        },
        allowPageScroll: 'vertical'
      })

      // Pause carousel if it has focus
      if ($this.data('interval') !== false) {
        pauseCarouselOnFocus()
      }

      // After carousel slide update aria-selected and tab index
      $this.on('slid.bs.carousel', function (event) {
        setAriaOnQuickLinks()
        updateControlAriaLabel($(event.relatedTarget))
      })

      // Extend keydown function from carousel.js
      // Update quick link focus on keyboard use
      $.fn.carousel.Constructor.prototype.keydown = function (e) {
        if (/input|textarea/i.test(e.target.tagName)) return
        switch (e.which) {
          case 37:
            this.prev()
            updateFocusOnQuickLinks()
            break
          case 39:
            this.next()
            updateFocusOnQuickLinks()
            break
          default: return
        }

        e.preventDefault()
      }

        // Set aria-selected and tab index to true only for active item
      function setAriaOnQuickLinks () {
        $quickLinks.each(function () {
          var link = $(this)
          if (link.hasClass('active')) {
            link.attr('aria-selected', 'true')
          } else {
            link.attr('aria-selected', 'false')
          }
        })
      }

      // Set focus on active quick link item
      function updateFocusOnQuickLinks () {
        $quickLinks.each(function () {
          if ($(this).hasClass('active')) {
            $(this).focus()
          } else {
            $(this).blur()
          }
        })
      }

      // Detect carousel focus elements and pause when one is focused
      function pauseCarouselOnFocus () {
        $quickLinks.add($control).add($btn).each(function () {
          $(this).focus(function () {
            $this.carousel('pause')
          })
          $(this).blur(function () {
            $this.carousel('cycle')
          })
        })
      }

      // Update aria-label on prev and next button depending on active slide
      function updateControlAriaLabel (element) {
        var $slideLeft = $('.carousel-control.left')
        var $slideRight = $('.carousel-control.right')
        var nextLabel
        var prevLabel

        if (element.next().length) {
          nextLabel = element.next().attr('data-controllabel')
        } else {
          nextLabel = element.parent().children('.item').first().attr('data-controllabel')
        }

        if (element.prev().length) {
          prevLabel = element.prev().attr('data-controllabel')
        } else {
          prevLabel = element.parent().children('.item').last().attr('data-controllabel')
        }

        $slideLeft.attr('aria-label', prevLabel)
        $slideRight.attr('aria-label', nextLabel)
      }
    })
  })
})(jQuery)


// plugins
/* global jQuery */

;(function ($) {
  'use strict'

  // document load event
  $(document).ready(function () {
    // initialize swiper when document ready
    // http://idangero.us/swiper/api/
    $('.js__news-carousel').each(function () {
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
      })
    })
  })
})(jQuery)

/* global $ */

// news Timeline
$('.js__news-timeline__item').on('click', function (e) {
  if ($(this).hasClass('collapsed')) {
    e.preventDefault()
    $(this).removeClass('collapsed')
    $(this).closest('.js__news-timeline__item-wrp').find('.js__news-timeline__date').addClass('open')
  }
})

// news Cards
$('.js__news-cards__dotdotdot').dotdotdot({
  watch: 'window'
})

// news Simple list
$('.js__news-simple-list__dotdotdot').dotdotdot({
  watch: 'window'
})


/* global forceEnableSuggest, Awesomplete, touchSupport, jQuery */

// container for Search suggestion data
var mainSearchInputList = {}

;(function ($) {
  'use strict'

  // init function
  var searchSuggestFn = function () {
    // ============================
    // Search Suggest DATA-API
    // ============================
    $('[data-search="searchSuggest"]').each(function (index, el) {
      mainSearchInputList['searchItem' + index] = new Awesomplete(el, {
        list: [],
        maxItems: 20,
        minChars: 2,
        autoFirst: true
      })
      var req = false
      $(this).on('keyup.search.suggest', function (e) {
        var c = e.keyCode
        if (c === 13 || c === 27 || c === 38 || c === 40) {
          return
        }
        var that = $(this)
        var fetchSuggestData = function () {
          if (!req) {
            req = true
            $.ajax({
              url: that.closest('form').data('suggest'),
              dataType: 'json',
              data: {
                termLowercase: that.val().toLowerCase(),
                termOriginal: that.val(),
                L: that.closest('form').find('input[name="L"]').val()
              },
              success: function (data) {
                req = false
                var arrr = []
                $.each(data, function (term) {
                  arrr.push(term)
                })
                mainSearchInputList['searchItem' + index]._list = arrr
                mainSearchInputList['searchItem' + index].evaluate()
              }
            })
          }
        }
        typeof $(this).closest('form').data('suggest') !== 'undefined' && fetchSuggestData() // eslint-disable-line
      })
      $(this).on('awesomplete-selectcomplete', function () {
        $(this).closest('form').submit()
      })
    })
    // =============end==============
  }

  // document load event
  $(document).ready(function () {
    // Make it possible to enable suggest even on devices with touch support
    // by setting var forceEnableSuggest = true;
    var overrideTouchSupport = typeof forceEnableSuggest !== 'undefined' ? forceEnableSuggest : false

    if ((!touchSupport || overrideTouchSupport) && $(window).width() >= 992) {
      searchSuggestFn()
    }
  })
})(jQuery)


/* global Image, HTMLImageElement, String */

/*
object-fit-images plugin with some project specific changes
  - Add objectFitImages function call at the end of file
  - Add global comments on top
  - Adjust shorthand of getComputedStyle function
  - Change doublequotes to  singlequotes of strings
  - Adjust unnecessary use of conditional expression for default assignment
  - Adjust formatting and removed semicolons
*/

/*! npm.im/object-fit-images 3.2.3 */
var objectFitImages = (function () {
  'use strict'

  var OFI = 'bfred-it:object-fit-images'
  var propRegex = /(object-fit|object-position)\s*:\s*([-\w\s%]+)/g
  var testImg = typeof Image === 'undefined' ? {style: {'object-position': 1}} : new Image()
  var supportsObjectFit = 'object-fit' in testImg.style
  var supportsObjectPosition = 'object-position' in testImg.style
  var supportsOFI = 'background-size' in testImg.style
  var supportsCurrentSrc = typeof testImg.currentSrc === 'string'
  var nativeGetAttribute = testImg.getAttribute
  var nativeSetAttribute = testImg.setAttribute
  var autoModeEnabled = false

  function createPlaceholder (w, h) {
    return ('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'' + w + '\' height=\'' + h + '\'%3E%3C/svg%3E')
  }

  function polyfillCurrentSrc (el) {
    if (el.srcset && !supportsCurrentSrc && window.picturefill) {
      var pf = window.picturefill._
      // parse srcset with picturefill where currentSrc isn't available
      if (!el[pf.ns] || !el[pf.ns].evaled) {
        // force synchronous srcset parsing
        pf.fillImg(el, {reselect: true})
      }

      if (!el[pf.ns].curSrc) {
        // force picturefill to parse srcset
        el[pf.ns].supported = false
        pf.fillImg(el, {reselect: true})
      }

      // retrieve parsed currentSrc, if any
      el.currentSrc = el[pf.ns].curSrc || el.src
    }
  }

  function getStyle (el) {
    var style = window.getComputedStyle(el).fontFamily
    var parsed
    var props = {}
    while ((parsed = propRegex.exec(style)) !== null) {
      props[parsed[1]] = parsed[2]
    }
    return props
  }

  function setPlaceholder (img, width, height) {
    // Default: fill width, no height
    var placeholder = createPlaceholder(width || 1, height || 0)

    // Only set placeholder if it's different
    if (nativeGetAttribute.call(img, 'src') !== placeholder) {
      nativeSetAttribute.call(img, 'src', placeholder)
    }
  }

  function onImageReady (img, callback) {
    // naturalWidth is only available when the image headers are loaded,
    // this loop will poll it every 100ms.
    if (img.naturalWidth) {
      callback(img)
    } else {
      setTimeout(onImageReady, 100, img, callback)
    }
  }

  function fixOne (el) {
    var style = getStyle(el)
    var ofi = el[OFI]
    style['object-fit'] = style['object-fit'] || 'fill' // default value

    // Avoid running where unnecessary, unless OFI had already done its deed
    if (!ofi.img) {
      // fill is the default behavior so no action is necessary
      if (style['object-fit'] === 'fill') {
        return
      }

      // Where object-fit is supported and object-position isn't (Safari < 10)
      if (
        !ofi.skipTest && // unless user wants to apply regardless of browser support
        supportsObjectFit && // if browser already supports object-fit
        !style['object-position'] // unless object-position is used
      ) {
        return
      }
    }

    // keep a clone in memory while resetting the original to a blank
    if (!ofi.img) {
      ofi.img = new Image(el.width, el.height)
      ofi.img.srcset = nativeGetAttribute.call(el, 'data-ofi-srcset') || el.srcset
      ofi.img.src = nativeGetAttribute.call(el, 'data-ofi-src') || el.src

      // preserve for any future cloneNode calls
      // https://github.com/bfred-it/object-fit-images/issues/53
      nativeSetAttribute.call(el, 'data-ofi-src', el.src)
      if (el.srcset) {
        nativeSetAttribute.call(el, 'data-ofi-srcset', el.srcset)
      }

      setPlaceholder(el, el.naturalWidth || el.width, el.naturalHeight || el.height)

      // remove srcset because it overrides src
      if (el.srcset) {
        el.srcset = ''
      }
      try {
        keepSrcUsable(el)
      } catch (err) {
        if (window.console) {
          console.warn('https://bit.ly/ofi-old-browser')
        }
      }
    }

    polyfillCurrentSrc(ofi.img)

    el.style.backgroundImage = 'url("' + ((ofi.img.currentSrc || ofi.img.src).replace(/"/g, '\\"')) + '")'
    el.style.backgroundPosition = style['object-position'] || 'center'
    el.style.backgroundRepeat = 'no-repeat'
    el.style.backgroundOrigin = 'content-box'

    if (/scale-down/.test(style['object-fit'])) {
      onImageReady(ofi.img, function () {
        if (ofi.img.naturalWidth > el.width || ofi.img.naturalHeight > el.height) {
          el.style.backgroundSize = 'contain'
        } else {
          el.style.backgroundSize = 'auto'
        }
      })
    } else {
      el.style.backgroundSize = style['object-fit'].replace('none', 'auto').replace('fill', '100% 100%')
    }

    onImageReady(ofi.img, function (img) {
      setPlaceholder(el, img.naturalWidth, img.naturalHeight)
    })
  }

  function keepSrcUsable (el) {
    var descriptors = {
      get: function get (prop) {
        if (el[OFI].img[prop]) {
          return el[OFI].img[prop]
        } else {
          return el[OFI].img['src']
        }
      },
      set: function set (value, prop) {
        if (el[OFI].img[prop]) {
          el[OFI].img[prop] = value
        } else {
          el[OFI].img['src'] = value
        }
        nativeSetAttribute.call(el, ('data-ofi-' + prop), value) // preserve for any future cloneNode
        fixOne(el)
        return value
      }
    }
    Object.defineProperty(el, 'src', descriptors)
    Object.defineProperty(el, 'currentSrc', {
      get: function () { return descriptors.get('currentSrc') }
    })
    Object.defineProperty(el, 'srcset', {
      get: function () { return descriptors.get('srcset') },
      set: function (ss) { return descriptors.set(ss, 'srcset') }
    })
  }

  function hijackAttributes () {
    function getOfiImageMaybe (el, name) {
      return el[OFI] && el[OFI].img && (name === 'src' || name === 'srcset') ? el[OFI].img : el
    }
    if (!supportsObjectPosition) {
      HTMLImageElement.prototype.getAttribute = function (name) {
        return nativeGetAttribute.call(getOfiImageMaybe(this, name), name)
      }
      HTMLImageElement.prototype.setAttribute = function (name, value) {
        return nativeSetAttribute.call(getOfiImageMaybe(this, name), name, String(value))
      }
    }
  }

  function fix (imgs, opts) {
    var startAutoMode = !autoModeEnabled && !imgs
    opts = opts || {}
    imgs = imgs || 'img'

    if ((supportsObjectPosition && !opts.skipTest) || !supportsOFI) {
      return false
    }

    // use imgs as a selector or just select all images
    if (imgs === 'img') {
      imgs = document.getElementsByTagName('img')
    } else if (typeof imgs === 'string') {
      imgs = document.querySelectorAll(imgs)
    } else if (!('length' in imgs)) {
      imgs = [imgs]
    }

    // apply fix to all
    for (var i = 0; i < imgs.length; i++) {
      imgs[i][OFI] = imgs[i][OFI] || {
        skipTest: opts.skipTest
      }
      fixOne(imgs[i])
    }

    if (startAutoMode) {
      document.body.addEventListener('load', function (e) {
        if (e.target.tagName === 'IMG') {
          fix(e.target, {
            skipTest: opts.skipTest
          })
        }
      }, true)
      autoModeEnabled = true
      imgs = 'img' // reset to a generic selector for watchMQ
    }

      // if requested, watch media queries for object-fit change
    if (opts.watchMQ) {
      window.addEventListener('resize', fix.bind(null, imgs, {
        skipTest: opts.skipTest
      }))
    }
  }

  fix.supportsObjectFit = supportsObjectFit
  fix.supportsObjectPosition = supportsObjectPosition

  hijackAttributes()

  return fix
}())

objectFitImages()


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

  // Apply dotdotdot.js jquery function on elements with ".js__dotdotdot" class.
  var $dotdotdot = $('.js__dotdotdot')

  if ($dotdotdot.length) {
    $dotdotdot.each(function () {
      $(this).dotdotdot({
        watch: 'window'
      })
    })
  }
})(jQuery)

// ^^^^^^^^^^ general.js ^^^^^^^^^^^


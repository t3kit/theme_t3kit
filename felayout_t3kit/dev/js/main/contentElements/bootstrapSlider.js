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

      // Update quick link focus on keyboard use
      // This is needed because we navigate with left(37) and right(39) key
      $this.on('keydown.bs.carousel', function (event) {
        if (event.which === 37 || event.which === 39) {
          updateFocusOnQuickLinks()
        }
      })

        // Set aria-selected and tab index to true only for active item
      function setAriaOnQuickLinks () {
        $quickLinks.each(function () {
          var link = $(this)
          if (link.hasClass('active')) {
            link.attr({'aria-selected': 'true', 'tabindex': '0'})
          } else {
            link.attr({'aria-selected': 'false', 'tabindex': '-1'})
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

        if (element.next().length > 0) {
          nextLabel = element.next().attr('data-controllabel')
        } else {
          nextLabel = element.parent().children('.item').first().attr('data-controllabel')
        }

        if (element.prev().length > 0) {
          prevLabel = element.prev().attr('data-controllabel')
        } else {
          prevLabel = element.parent().children('.item').last().attr('data-controllabel')
        }

        $slideLeft.attr('aria-label', nextLabel)
        $slideRight.attr('aria-label', prevLabel)
      }
    })
  })
})(jQuery)

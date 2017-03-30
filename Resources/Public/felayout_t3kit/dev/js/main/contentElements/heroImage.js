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

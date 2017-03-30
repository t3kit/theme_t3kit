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

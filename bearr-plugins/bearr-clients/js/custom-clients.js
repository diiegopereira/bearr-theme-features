//Use Strict Mode
(function ($) {
    "use strict";

    //Begin - Window Load
    $(window).load(function () {

        $(".clients-carousel").owlCarousel({
            nav: false,
            margin: 20,
            responsive : {
                0 : {
                    items: 1,
                },
                // breakpoint from 768 up
                768 : {
                   items: 2,
                },
                980 : {
                    items: 4,
                }
            }
        });

       

    });

    //End - Use Strict mode
})(jQuery);
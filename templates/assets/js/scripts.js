/* ---------------------------------------------
 common scripts
 --------------------------------------------- */
(function ($) {
    "use strict"; // use strict to start

    // Countdown
    if ($('.countdown[data-countdown]').length) {

        $('.countdown[data-countdown]').each(function () {

            var $this = $(this),
                finalDate = $(this).data('countdown');

            $this.countdown(finalDate, function (event) {

                $this.html(event.strftime(
                    '<div class="counter-container"><div class="box"><div class="number">%-D</div><span>Day%!d</span></div><div class="box"><div class="number">%H</div><span>Hours</span></div><div class="box"><div class="number">%M</div><span>Minutes</span></div><div class="box"><div class="number">%S</div><span>Seconds</span></div></div>'
                ));
            });
        });
    }



    // Fullscreen Elements
    function getWindowWidth() {
        return Math.max($(window).width(), window.innerWidth);
    }

    function getWindowHeight() {
        return Math.max($(window).height(), window.innerHeight);
    }

    function fullscreenElements() {
        $('body').each(function () {
            $(this).css('min-height', getWindowHeight());
        });
    }

    fullscreenElements();


})(jQuery);
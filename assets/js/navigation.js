$(() => {
    $('nav').hide();
});

function toggleNavigation() {
    const navigationBarsElement = $('#nav-bars');
    const navigationElement = $('nav');
    const bodyElement = $('body');

    if (navigationElement.is(':visible')) {
        navigationElement.slideUp(250);
        bodyElement.css('overflow', 'scroll');
        navigationBarsElement.animate({
            deg: 180
        }, {
            duration: 250,
            step: function(now) {
                $(this).css({ transform: 'rotate(' + now + 'deg)' });
            }
        });
    }
    else {
        navigationElement.slideDown(250);
        bodyElement.css('overflow', 'hidden');
        navigationBarsElement.animate({
            deg: 90
        }, {
            duration: 250,
            step: function(now) {
                $(this).css({ transform: 'rotate(' + now + 'deg)' });
            }
        });
    }
}
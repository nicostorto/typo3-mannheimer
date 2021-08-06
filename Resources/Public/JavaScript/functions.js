/*!
 * Base Template v1.0.0 (http://typo3.local)
 * Copyright 2017-2019 Nico Storto
 * Licensed under the GPL-2.0-or-later license
 */


/*Open widget houselist - Desktop*/
$('#requestListTrigger').click(function() {
    $('#widgetHouseList').toggleClass('widgetListOpen');
});

$('#requestListTrigger').click(function() {
    $('#widgetHouseList').toggleClass('widgetListOpen');
});

$('.SitePlan area').click(function(e) {
    e.preventDefault();
    var openPopup = $(this).attr('href');
    $(openPopup).toggleClass('hidden');
    $('.popupContainer').not($(openPopup)).addClass('hidden');
});

$('map').imageMapResize();

/*ImageCarusel - DFC Detail*/
$('#houseImageCarousel.slick').slick({
    infinite: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: true,
    responsive: [
        {
            breakpoint: 992,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]
});

var fixmeTopHouse = $('.houseArrangement').offset().top;
var fixmeTopManufacturer = $('.manufacturerArrangement').offset().top;
$(window).scroll(function() {
    var currentScroll = $(window).scrollTop();
    if (currentScroll >= fixmeTopHouse) {
        $('.houseArrangement').addClass('stickyHouseBar');
    } else {
        $('.houseArrangement').removeClass('stickyHouseBar');
    }
    if (currentScroll >= fixmeTopManufacturer) {
        $('.houseArrangement').addClass('stickyManufacturerBar');
    } else {
        $('.houseArrangement').removeClass('stickyManufacturerBar');
    }
});
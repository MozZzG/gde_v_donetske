function resize_news() {
    $min = 170;
    $('.city_news img').each(function() {
        if ($(this).height() < $min) $min = $(this).height();
    });
    $('.city_news .new_img').height($min);
    $('.city_news img').each(function() {
        if ($(this).height() < $(this).width()) {
            $(this).height($min);
        }
        else {
            $(this).css('width', '100%');
        }
    });
    $h = $('.city_news li').height();
    $('.city_news li a').each(function() {
        $(this).height($h);
    });
}

$(document).ready(function() {
    setTimeout(resize_news(), 100);
});

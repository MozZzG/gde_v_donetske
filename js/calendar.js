function banner_height() {
    var table_h = $('.calendar').height();
    var banner_h = table_h - ($('.calendar_h').height() + $('img.da').height() + $('.black').height()) - 8;
    $('.calendar_banner').height(banner_h);
}

$(document).ready(function() {
    $('#w0').calendar();
    banner_height();

    $('body').on('click', 'ul#cal_cat a', function(e) {
        e.preventDefault();
        var cat = $(this).attr('data-key');
        $('#calendar_block').css('opacity', '0.5');
        $.ajax({
            url: 'calendar?cat='+cat,
            success: function(response){
                $('#calendar_block').replaceWith(response);
                $('#w0').calendar();
                banner_height();
            }
        });
    });

    $('body').on('click', 'ul.calendar_subcategory a', function(e) {
        e.preventDefault();
        var sub = $(this).attr('data-key');
        $('#calendar_block').css('opacity', '0.5');
        $.ajax({
            url: 'calendar?subcat='+sub,
            success: function(response){
                $('#calendar_block').replaceWith(response);
                $('#w0').calendar();
                banner_height();
            }
        });
    });

    $('body').on('click', '#cat_back', function(e) {
        e.preventDefault();
        $('#calendar_block').css('opacity', '0.5');
        $.ajax({
            url: 'calendar',
            success: function(response){
                $('#calendar_block').replaceWith(response);
                $('#w0').calendar();
                banner_height();
            }
        });
    });

    $('body').on('click', '#sub_back', function(e) {
        e.preventDefault();
        var cat = $(this).attr('data-key');
        $('#calendar_block').css('opacity', '0.5');
        $.ajax({
            url: 'calendar?cat='+cat,
            success: function(response){
                $('#calendar_block').replaceWith(response);
                $('#w0').calendar();
                banner_height();
            }
        });
    });
});

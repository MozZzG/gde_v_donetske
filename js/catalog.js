function resize() {
    $min = 2000;
    $min_top = 2000;

        $('.podcat img').each(function() {
            if ($(this).height() < $min) $min = $(this).height();
        });
        $('.podcat_top img').each(function() {
            if ($(this).height() < $min_top) $min_top = $(this).height();
        });
        $('.podcat img').each(function() {
            $(this).height($min);
        });
        $('.podcat_top img').each(function() {
            $(this).height($min_top);
        });
}

function resize_news() {
    $h = $('.news a').width();
    $('.news .new_img').height($h);
    $('.news a img').each(function() {
        if ($(this).height() < $(this).width()) {
            $(this).height($h);
        }
        else {
            $(this).width($h);
        }
    });
    $max = 1;
    $('.news div a').each(function() {
        if ($(this).parent().height() > $max) $max = $(this).height();
    });
    $('.news div a').each(function() {
        $(this).parent().height($max);
    });
}

$(document).ready(function() {

    setTimeout(resize(), 100);
    setTimeout(resize_news(), 100);

    $('body').on('click', 'a.show_more', function(e) {
        e.preventDefault();
        var k = $('.podcat li').length;
        alert (k);
        var id = $(this).attr('id');
        $.ajax({
            url: 'catalog?id='+id+'&k='+k,
            success: function(response){
                $('.podcat').append(response);
                setTimeout(resize(), 100);
            }
        });
        k = $('.podcat li').length;
        $.ajax({
            url: 'catalog/catalogshowmore?id='+id+'&k='+k,
            success: function(response){
                if (!response) {
                    $('a.show_more').hide();
                }
            }
        });
    });
});

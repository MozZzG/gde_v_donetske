function resize_news() {
    $min = 170;
    $('.news img').each(function() {
        if ($(this).height() < $min) $min = $(this).height();
    });
    $('.news .new_img').height($min);
    $('.news img').each(function() {
        if ($(this).height() < $(this).width()) {
            $(this).height($min);
        }
        else {
            $(this).css('width', '100%');
        }
    });
    $h = $('.news li').height();
    $('.news li a').each(function() {
        $(this).height($h);
    });
}

function resize_rec() {
    $min = 2000;

    $('.podcat img').each(function() {
        if ($(this).height() < $min) $min = $(this).height();
    });
    $('.podcat img').each(function() {
        $(this).height($min);
    });
}

function resize_events() {
    $min = 2000;

    $('.events img').each(function() {
        if ($(this).height() < $min) $min = $(this).height();
    });
    $('.events img').each(function() {
        $(this).height($min);
    });
}

$(document).ready(function() {
    //$('#myCarousel').carousel('pause');
    setTimeout(resize_news(), 100);
    setTimeout(resize_rec(), 100);
    setTimeout(resize_events(), 100);
    $('#video_link').click(function(e) {
        e.preventDefault();
        $('.establ_menu li').each(function() {
            $(this).removeClass('active');
        });
        $(this).parent().addClass('active');
        $('#video iframe').height($('.about_block').height()-$('.establ_menu').height()-5);
        $('.live_block').each(function() {
            $(this).hide();
        });
        $('#video').show();
    });
    $('#main_link').click(function(e) {
        e.preventDefault();
        $('.establ_menu li').each(function() {
            $(this).removeClass('active');
        });
        $(this).parent().addClass('active');
        $('.live_block').each(function() {
            $(this).hide();
        });
        $('#main').show();
    });
    $('#about_link').click(function(e) {
        e.preventDefault();
        $('.establ_menu li').each(function() {
            $(this).removeClass('active');
        });
        $(this).parent().addClass('active');
        $('#about .about_text').height($('.about_block').height()-$('.establ_menu').height()-45);
        $('.live_block').each(function() {
            $(this).hide();
        });
        $('#about').show();
    });
    $('#map_link').click(function(e) {
        e.preventDefault();
        $('.establ_menu li').each(function() {
            $(this).removeClass('active');
        });
        $(this).parent().addClass('active');
        $('#map ymaps:first').css('width', 'auto');
        $('#map ymaps:first').height($('.about_block').height()-$('.establ_menu').height());
        $('.live_block').each(function() {
            $(this).hide();
        });
        $('#map').show();
    });

    $('.events').on('click', 'a', function(e) {
        e.preventDefault();
        $('#event_window').modal('show');
    });

    $('body').on('click', 'a.add_photo', function(e) {
        e.preventDefault();
        $('#add_photo').click();
    });

    $('body').on('click', 'a.del_photo', function(e) {
        e.preventDefault();
        var photo = $('#myCarousel .active input').val();
        $.ajax({
            url: 'del_img?photo='+photo,
            success: function(response){
                if (response) {
                    $('#myCarousel .active input').val('');
                    $('#myCarousel .active img').attr('src', 'img/photo_null.jpg');
                    $('.del_photo').hide();
                    $('.add_photo').show();
                }
            }
        });
    });

    $('#add_photo').change(function() {
        $('#photo_num').val($('#myCarousel .active').attr('data-key'));
        $('#adding_img').submit();
    });

    $('#hiddenframe').load(function() {
        $('#add_photo').val('');
        var photo = $('#hiddenframe').contents().find('body').html();
        $('#myCarousel .active img').attr('src', 'img/establishments/'+photo);
        $('.add_photo').hide();
        $('.del_photo').show();
        $('#myCarousel .active input').val(photo);
    });

    $('#est_edit a.prev').click(function(e) {
        e.preventDefault();
        $('#myCarousel').carousel('prev');
        setTimeout(function() {
            if ($('#myCarousel .active img').attr('src') == 'img/photo_null.jpg') {
                $('.del_photo').hide();
                $('.add_photo').show();
            }
            else {
                $('.add_photo').hide();
                $('.del_photo').show();
            }
        }, 600);
    });
    $('#est_edit a.next').click(function(e) {
        e.preventDefault();
        $('#myCarousel').carousel('next');
        setTimeout(function() {
            if ($('#myCarousel .active img').attr('src') == 'img/photo_null.jpg') {
                $('.del_photo').hide();
                $('.add_photo').show();
            }
            else {
                $('.add_photo').hide();
                $('.del_photo').show();
            }
        }, 600);
    });
});

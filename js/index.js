function resize_news() {
    $min = 170;
    $('.city_news img').each(function() {
        if (($(this).height() < $min)&($(this).height()>0)) $min = $(this).height();
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
    $h = $('.part_news .city_news a').width();
    $('.part_news .city_news .new_img').height($h);
    $('.part_news .city_news img').each(function() {
        if ($(this).height() < $(this).width()) {
            $(this).height($h);
        }
        else {
            $(this).width($h);
        }
        var top = $h / 2 + $(this).parent().parent().find('.partner_new_view').height() / 2;
        var left = $h / 2 - $(this).parent().parent().find('.partner_new_view').outerWidth() / 2;
        $(this).parent().parent().find('.partner_new_view').css('marginTop', '-'+top+'px');
        $(this).parent().parent().find('.partner_new_view').css('marginLeft', left+'px');
    });
    $h = $('.city_news li').height();
    $('.city_news li a').each(function() {
        $(this).height($h);
    });
    $('.part_news .city_news li a').each(function() {
        $(this).removeAttr('style');
    });
    /*$h = $('.pn1 li').height();
    $('.pn1 li a').each(function() {
        $(this).height($h);
    });*/
    var h = 0;
    $('.pn1 li a').each(function() {
        if ($(this).height() > h) h = $(this).height();
    });
    $('.pn1 li a').each(function() {
        $(this).height(h);
    });
    /*$h1 = $('.pn2 li').height();
     alert($h);
    $('.pn2 li a').each(function() {
        $(this).height($h);
    });*/
    var h1 = 0;
    $('.pn2 li a').each(function() {
        if ($(this).height() > h1) h1 = $(this).height();
    });
    $('.pn2 li a').each(function() {
        $(this).height(h1);
    });
}

function forum_resize(av, pw) {
    if (av.width() >= av.height()) {
        av.attr('style', 'height: 100%;');
        var l = (av.width() - parseInt(pw))/2;
        av.attr('style', 'height: 100%; margin-left: -'+l+'px;');
    }
    else {
        av.css('width', '100%');
    }
}

$(document).ready(function() {
    $('.city_news li').width(Math.floor($('.city_news').width() / 5));
    setTimeout(resize_news(), 100);

    setTimeout(function() {
        $('.avatar').each(function() {
            forum_resize($(this).find('img'), $('.avatar').css('width'));
        });
        var min_est = 1000;
        $('.podcat_top a .img').each(function() {
            if ($(this).height() < min_est) min_est = $(this).height();
        });
        $('.podcat_top a .img').each(function() {
            $h = min_est;
            $(this).height($h);
            $w = $(this).width();
            var p_width = $(this).parent().find('.est_view').outerWidth();
            if ($(this).parent().find('.est_like').outerWidth() > p_width) p_width = $(this).parent().find('.est_like').outerWidth();
            if ($(this).parent().find('.est_com').outerWidth() > p_width) p_width = $(this).parent().find('.est_com').outerWidth();

            var top = $h / 2 + $(this).parent().find('.est_view').height() / 2;
            $(this).parent().find('.est_view').css('marginTop', '-'+top+'px');
            $(this).parent().find('.est_like').css('marginTop', '-'+top+'px');
            $(this).parent().find('.est_com').css('marginTop', '-'+top+'px');
            var left = $w / 2 - (p_width + p_width + p_width + 40) / 2;
            $(this).parent().find('.est_com').css('marginLeft', left+'px');
            var left = left + p_width + 25;
            $(this).parent().find('.est_like').css('marginLeft', left+'px');
            var left = left + p_width + 25;
            $(this).parent().find('.est_view').css('marginLeft', left+'px');
        });
    }, 100);

    var w = $('.widgets .col-sm-4').width();
    VK.Widgets.Group("vk_groups", {mode: 0, width: w, height: "240", color1: 'FFFFFF', color2: '2B587A', color3: '5B7FA6'}, 57981472);
    $('#instaw').attr('src', 'inwidget/index.php?toolbar=false&view=18&inline=6&width='+$('#instaw').parent().width());

    $('.cinema_link').click(function() {
        $('.main_tabs li').removeClass('active');
        $(this).addClass('active');
        $('.afisha_index').fadeOut();
        setTimeout(function() {$('.cinema').fadeIn();}, 350);
    });
    $('.party_link').click(function() {
        $('.main_tabs li').removeClass('active');
        $(this).addClass('active');
        $('.afisha_index').fadeOut();
        setTimeout(function() {$('.party').fadeIn();}, 350);
    });
    $('.theatre_link').click(function() {
        $('.main_tabs li').removeClass('active');
        $(this).addClass('active');
        $('.afisha_index').fadeOut();
        setTimeout(function() {$('.theatre').fadeIn();}, 350);
    });
});
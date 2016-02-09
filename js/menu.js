$(document).ready(function() {
    $('ul.menu').on('click', 'a.nolink', function(e) {
        e.preventDefault();
        if ($(this).parent().hasClass('active')) {
            $(this).parent().removeClass('active');
            $(this).parent().removeAttr('style');
            $('ul.menu').removeClass('open');
            $('ul.menu li ul').hide();
        }
        else {
            $('ul.menu li').each(function () {
                if ($(this).hasClass('active')) {
                    $(this).removeClass('active');
                    $(this).removeAttr('style');
                    $('ul.menu').removeClass('open');
                }
            });
            $('ul.menu').toggleClass('open');
            $(this).parent().toggleClass('active');
            $('ul.menu li ul').hide();
            $('ul.menu li.active ul').css('display', 'flex');
            $('ul.menu li.active ul').css('marginLeft', '-'+$('ul.menu li.active ul').position().left+'px');
            $('ul.menu li.active').css('marginBottom', $('ul.menu li.active ul').height() - 5 + 'px');
        }
    });
    var logo_width = $('header h1').outerWidth();
    var head_center = $('header .head_center').width();
    $('#search_form').width(head_center - logo_width - 10);
});

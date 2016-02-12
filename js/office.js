$(document).ready(function() {
    $('#myCarousel').carousel('pause');

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

    $('.events').on('click', 'a', function(e) {
        e.preventDefault();
        var event = $(this).attr('data-key');
        var est = $('#est_id').val();
        $.ajax({
            url: 'office/eventedit?event='+event+'&est='+est,
            success: function(response){
                if (response) {
                    $('#window_afisha .modal-body').html(response);
                    $('#window_afisha #eventtestform-date').attr('placeholder', 'выбрать дату');
                    if ($('#window_afisha #eventtestform-date').val()) {
                        $month = $('#window_afisha #eventtestform-date').val().substring(0, $('#window_afisha #eventtestform-date').val().indexOf(' '));
                        switch ($month) {
                            case 'January': {$month = '01'; break;}
                            case 'February': {$month = '02'; break;}
                            case 'March': {$month = '03'; break;}
                            case 'April': {$month = '04'; break;}
                            case 'May': {$month = '05'; break;}
                            case 'June': {$month = '06'; break;}
                            case 'July': {$month = '07'; break;}
                            case 'August': {$month = '08'; break;}
                            case 'September': {$month = '09'; break;}
                            case 'October': {$month = '10'; break;}
                            case 'November': {$month = '11'; break;}
                            case 'December': {$month = '12'; break;}
                        }
                        $year = $('#window_afisha #eventtestform-date').val().substring($('#window_afisha #eventtestform-date').val().indexOf(',')+1);
                        $day = $('#window_afisha #eventtestform-date').val().substring($('#window_afisha #eventtestform-date').val().indexOf(' ')+1, $('#window_afisha #eventtestform-date').val().indexOf(','))
                        if ($day.length == 1) $day = '0'+$day;
                        $('#window_afisha #eventtestform-date').val($year+'-'+$month+'-'+$day);
                    }
                    $('#window_afisha').modal('show');
                }
            }
        });
    });

    $('body').on('change', '#event_cat', function() {
        $.ajax({
            url: 'office/geteventsubs?cat='+$(this).val(),
            success: function(response){
                if (response) {
                    $('#event_subcat').html(response);
                }
            }
        });
    });

    $('#window_afisha').on('click', '.img img', function() {
        $('#add_photo_event').click();
    });
    $('#window_afisha').on('change', '#add_photo_event', function() {
        $('#adding_img_event').submit();
    });
    $('#hiddenframe1').load(function() {
        $('#add_photo_event').val('');
        var photo = $('#hiddenframe1').contents().find('body').html();
        $('#window_afisha .img img').attr('src', 'img/events/'+photo);
        $('#del_photo_event').show();
        $('#window_afisha #eventtestform-photo').val(photo);
    });
    $('#window_afisha').on('click', '#del_photo_event', function(e) {
        e.preventDefault();
        var photo = $('#eventtestform-photo').val();
        $.ajax({
            url: 'del_img_event?photo='+photo,
            success: function(response){
                if (response) {
                    $('#window_afisha #eventtestform-photo').val('');
                    $('#window_afisha .img img').attr('src', 'img/afisha_null.jpg');
                    $('#del_photo_event').hide();
                }
            }
        });
    });
    $('#window_afisha').on('submit', '#event_form', function(e) {
        e.preventDefault();
        var form = $(this).serialize();
        $.ajax({
            url: 'test_event?est='+$('#est_id').val(), //Адрес подгружаемой страницы
            type: 'post', //Тип запроса
            data: form,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            success: function (response) { //Если все нормально
                if (!response) {
                    $('#window_afisha').modal('hide');
                    $('#window_thanks .modal-title').html('Спасибо за сотрудничество!');
                    $('#window_thanks .modal-body').html('Ваша афиша была отправлена на проверку. Как только она будет размещена на сайте, вы получите уведомление на email.');
                    $('#window_thanks').modal('show');
                }
                else {
                    $('#window_afisha .modal-body').html(response);
                    if ($('#window_afisha #eventtestform-date').val()) {
                        $month = $('#window_afisha #eventtestform-date').val().substring(0, $('#window_afisha #eventtestform-date').val().indexOf(' '));
                        switch ($month) {
                            case 'January': {$month = '01'; break;}
                            case 'February': {$month = '02'; break;}
                            case 'March': {$month = '03'; break;}
                            case 'April': {$month = '04'; break;}
                            case 'May': {$month = '05'; break;}
                            case 'June': {$month = '06'; break;}
                            case 'July': {$month = '07'; break;}
                            case 'August': {$month = '08'; break;}
                            case 'September': {$month = '09'; break;}
                            case 'October': {$month = '10'; break;}
                            case 'November': {$month = '11'; break;}
                            case 'December': {$month = '12'; break;}
                        }
                        $year = $('#window_afisha #eventtestform-date').val().substring($('#window_afisha #eventtestform-date').val().indexOf(',')+1);
                        $day = $('#window_afisha #eventtestform-date').val().substring($('#window_afisha #eventtestform-date').val().indexOf(' ')+1, $('#window_afisha #eventtestform-date').val().indexOf(','))
                        if ($day.length == 1) $day = '0'+$day;
                        $('#window_afisha #eventtestform-date').val($year+'-'+$month+'-'+$day);
                    }
                    $('#event_cat').css('borderColor', 'red');
                }
            }
        });
    });


    $('body').on('click', '#add_news', function(e) {
        e.preventDefault();
        $('#window_add_new').modal('show');
    });
    $('body').on('click', '#window_add_new a', function(e) {
        e.preventDefault();
        var phone = $('#window_add_new #new_number').val();
        var est = $('#est_id').val();
        $.ajax({
            url: 'add_new?phone='+phone+'&est='+est,
            success: function(response){
                if (response) {
                    $('#window_add_new').modal('hide');
                    $('#window_thanks .modal-title').html('Спасибо за Ваш заказ!');
                    $('#window_thanks .modal-body').html('В ближайшее время наш менеджер с Вами свяжется.');
                    $('#window_thanks').modal('show');
                }
            }
        });
    });
});

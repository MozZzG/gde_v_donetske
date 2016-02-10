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
            url: 'site/eventedit?event='+event+'&est='+est,
            success: function(response){
                if (response) {
                    $('#window_afisha .modal-body').html(response);
                    $('#window_afisha #eventtestform-date').attr('placeholder', 'выбрать дату');
                    $('#window_afisha').modal('show');
                }
            }
        });
    });

    $('body').on('change', '#event_cat', function() {
        $.ajax({
            url: 'site/geteventsubs?cat='+$(this).val(),
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
});

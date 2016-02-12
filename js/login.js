$(document).ready(function() {
    $('body').on('click', '#remember', function() {
        if ($(this).val() == 1) {
            $(this).val(0);
        }
        else {
            $(this).val(1);
        }
    });
    $('body').on('click', '#remember_bus', function() {
        if ($(this).val() == 1) {
            $(this).val(0);
        }
        else {
            $(this).val(1);
        }
    });
    $('body').on('click', '#accept', function() {
        if ($(this).val() == 1) {
            $(this).val(0);
        }
        else {
            $(this).val(1);
        }
    });

    $('#reg').click(function(e) {
        e.preventDefault();
        $('#sign_up_user').hide();
        $('#soc_block').hide();
        $('#sign_in').hide();
        $('#reg1').parent().removeClass('active');
        $(this).parent().addClass('active');
        $('#sign_up').show();
        $('#sign_in_businessman').show();
        $('.call_to_manager').show();
    });
    $('#reg1').click(function(e) {
        e.preventDefault();
        $('#sign_up').hide();
        $('#sign_in_businessman').hide();
        $('#reg').parent().removeClass('active');
        $(this).parent().addClass('active');
        $('.call_to_manager').hide();
        $('#sign_up_user').show();
        $('#sign_in').show();
        $('#soc_block').show();
    });

    $('#user_sms').click(function(e) {
        e.preventDefault();
        var but = $(this);
        var phone = $('#signupform-phone').val();
        if (((phone.length == 12) & (phone.indexOf('38') == 0)) | ((phone.length == 11) & (phone.indexOf('7') == 0))) {

            var code = Math.floor(Math.random() * (99999 - 10000 + 1)) + 10000;
            $('#signupform-activation_code').val(code);
            var url = 'http://api.smsfeedback.ru/messages/v2/send/?login=gdevdonetskecom&password=1qaz2wsx&phone='+phone+'&text=Ваш код подтверждения: '+code+'. gdevdonetske.com';
            $('#sms_link').attr('href', url);
            alert(code);
            //$('#sms_link')[0].click();
            but.attr('disabled', '');
            but.addClass('disabled');
            but.html('отправлено');
        }
        else {
            $('#window_phone_error').modal('show');
        }
    });

    $('#bus_sms').click(function(e) {
        e.preventDefault();
        var but = $(this);
        var phone = $('#signupbusinessmanform-phone').val();
        if (((phone.length == 12) & (phone.indexOf('38') == 0)) | ((phone.length == 11) & (phone.indexOf('7') == 0))) {

            var code = Math.floor(Math.random() * (99999 - 10000 + 1)) + 10000;
            $('#signupbusinessmanform-activation_code').val(code);
            var url = 'http://api.smsfeedback.ru/messages/v2/send/?login=gdevdonetskecom&password=1qaz2wsx&phone='+phone+'&text=Ваш код подтверждения: '+code+'. gdevdonetske.com';
            $('#sms_link').attr('href', url);
            alert(code);
            //$('#sms_link')[0].click();
            but.attr('disabled', '');
            but.addClass('disabled');
            but.html('отправлено');
        }
        else {
            $('#window_phone_error').modal('show');
        }
    });

    $('body').click(function() {
        $('#window_reg').fadeOut();
    });

    $('body').on('submit', '#sign_up', function(e) {
        e.preventDefault();
        var form = $(this).serialize();
        $.ajax({
            url: 'signupbusinessman', //Адрес подгружаемой страницы
            type: 'post', //Тип запроса
            data: form,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            success: function (response) { //Если все нормально
                if (!response) {
                    $('#window_reg').modal('show');
                }
                else {
                    $('.sign_up_form_block').html(response);
                }
            }
        });
    });

    $('#window_reg').on('hidden.bs.modal', function() {
        document.location.href = 'office';
    });

    $('body').on('click', 'a.soglas', function(e) {
        e.preventDefault();
        $('#window_soglas').fadeIn();
    });

    $('body').on('click', '#window_soglas .close', function(e) {
        e.preventDefault();
        $('#window_soglas').fadeOut();
    });

    $('#signupbusinessmanform-category').change(function() {
        var select = $(this);
        $.ajax({
            url: 'site/getsubcat?id='+select.val(),
            success: function(response){
                $('#signupbusinessmanform-subcategory').html('<option value="">подкатегория</option>'+response);
            }
        });
    });
});

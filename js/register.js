function password_recovery() {
    $.ajax({
        data: {'email': $('#email').val()},
        dataType: 'json',
        type: 'POST',
        url: '/user/userPasswordRecovery',
        success: function (data) {
            if (data.success == 1) {
                $('.popup-title').html('На указанную вами электронную почту отправлен новый парoль.');
                $('#form_password_recovery').remove();
            }
            else
            {
                $('#email').addClass('error');
                $('.recoveryEmail').addClass('standart-error');
                $('#error-text-recovery').html(data.error);
            }
        }
    });
}

function send_login_form() {
    var form = $('#form-login').serialize();
    $.ajax({
        data: form,
        dataType: 'json',
        type: 'POST',
        url: '/user/loginForm',
        success: function (data) {
            if (data.success == 1) {
                location.reload();
            }
            else
            {
                var form = $('#form-login');
                var errors = [];
                errors = data.error;
                form.find('.form-register-row').each(function () {
                    var input_element = $(this).find('input'),
                            input = input_element.attr('name');

                    input = input.replace('login[', '');
                    input = input.replace(']', '');
                    if (errors[input] > '') {
                        input_element.addClass('error');
                        input_element.parents('.form-register-row').addClass('standart-error');
                        input_element.next('.error-text').html(errors[input][0]);
                    }
                });
            }
        }
    });
}


function formRegisterSubmit() {
    $('.input-simple').removeClass('error');
    $('.form-person-col').removeClass('standart-error');
    $('.error-text').html('');
    $('.form-captcha-input').removeClass('error');
    $('.form-captcha').removeClass('standart-error');
    $('#error-text-captcha').html('');

    var form = $('#form-registration');
    $.ajax({
        data: $('#form-registration').serialize(),
        dataType: 'json',
        type: 'POST',
        url: 'user/RegistrationUser',
        success: function (data) {
            if (data.success == 1) {
                location.href = '/settings';
            }
            else {
                var peremscroll = $('.header-content-title').offset().top;
                $('body').animate({scrollTop: peremscroll}, 1100);
                $('.form-captcha-img').html(data.captcha);
                var errors = [];
                errors = data.error;
                form.find('.form-register-row').each(function () {
                    var input_element = $(this).find('input,textarea'),
                            input = input_element.attr('name');

                    input = input.replace('user[', '');
                    input = input.replace(']', '');
                    if (errors[input] > '') {
                        input_element.addClass('error');
                        input_element.parents('.form-register-row').addClass('standart-error');
                        input_element.next('.error-text').html(errors[input][0]);
                    }
                });
                // пpоверим капчу
                if (errors['verifyCode']) {
                    $('.form-captcha-input').addClass('error');
                    $('.form-captcha').addClass('standart-error');
                    $('#error-text-captcha').html(errors['verifyCode'][0]);
                }
            }
        }
    });
}


function nick_register(name) {
    $('#ajax_loader_nick').attr('style', 'display:block');
    $('#form-register-nickname-text').parent().removeClass('type-free');
    $('#form-register-nickname-text').html('');
    $.ajax({
        data: {'name': name},
        dataType: 'json',
        type: 'POST',
        url: 'user/RegistrationNick',
        success: function (data) {
            $('#ajax_loader_nick').attr('style',
                    'display:none');
            if (data.success == 1) {
                $('#form-register-nickname-text').html('Свободен');
                $('#form-register-nickname-text').parent().addClass('type-free');
                $('#nick-register').removeClass('error');
            }
            else {
                $('#nick-register').addClass('error');
                $('#form-register-nickname-text').html('Занят');
                $('#form-register-nickname-text').addClass('error-text');
                return false;
            }
        }
    });
}
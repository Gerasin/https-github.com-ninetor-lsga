$(document).ready(function () {
    $("#fileToUpload").change(function () {
        $('.ans_loader').attr('style', 'display: initial;');
        $('.error-load-photo').html('');
        var form = document.forms.form_img_settings;
        var formData = new FormData(form);
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "profile/ProfileUpdateImg");

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    data = JSON.parse(xhr.responseText);                   
                    if (data.success == '1') {
                        $('.person-ava-img-inner').attr('style', data.image);
                        $('.ans_loader').attr('style', 'display:none');
                    } else {
                        $('.ans_loader').attr('style', 'display:none');
                        $('.error-load-photo').html(data.error);
                    }
                }
            }
        };
        xhr.send(formData);
    });

    $('#form-profile-settings-submit').click(function () {
        $('.input-simple').removeClass('error');
        $('.form-person-col').removeClass('standart-error');
        $('.error-text').html('');
        $('.error-load-photo').html('');

        var form = $('#form_prfile_settings');
        $.ajax({
            data: $('#form_prfile_settings').serialize(),
            dataType: 'json',
            type: 'POST',
            url: 'profile/ProfileUpdate',
            success: function (data) {
                if (data.success == 1) {
                    location.href = '/settings';
                }
                else {
                    var errors = [];
                    errors = data.error;
                    var form1 = $('#form_prfile_settings');
                    form1.find('.form-person-col').each(function () {
                        var input_element = $(this).find('input,textarea,select,checkbox'),
                                input = input_element.attr('name');
                        input = input.replace('user[', '');
                        input = input.replace(']', '');
                        if (errors[input] > '') {
                            input_element.addClass('error');
                            input_element.parents('.form-person-col').addClass('standart-error');
                            input_element.next('.error-text').html(errors[input][0]);
                        }
                    });
                }
            }
        });
    });
});
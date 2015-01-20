// подтверждение резервации
function reservationFinishStatus() {
    $.ajax({
            data: {},
            dataType: 'json',
            type: 'POST',
            url: '/dynoReservation/stepFinish',
            success: function(data) {
                $('#finish-step').prop('disabled', true);
            }
        });
}
// выбор активного элемената свободного времени
$(document).ready(function() {
    $('.time-variant').bind('click', function() {
        var start = $(this).attr('data-start');
        var finish = $(this).attr('data-finish');        
        $('.time-variant').removeClass('active');
        $('#next-step').prop('disabled', true);
        var thisElement=$(this);
        
        $.ajax({
            data: {'start': start, 'finish': finish},
            dataType: 'json',
            type: 'POST',
            url: '/dynoReservation/dynoReservationTimeVariant',
            success: function(data) {
                if (data.success == 1) {
                    thisElement.addClass('active');
                    $('#textForUserStatus').html(data.textResult);
                    $('#next-step').prop('disabled', false);
                }
                else
                {

                }
            }
        });

    });
})
// Согласен с "Условиями Эксплуатации Диностенда"
function reserv_rules_ok(status) {
    if (status) {
        $('#next-step').prop('disabled', false);
    } else {
        $('#next-step').prop('disabled', true);
    }
}
// валидация формы по первом шаге выполнения
function dyno_reservation_step1() {
    var form = $('#reservation_step_1').serialize();
    var result1 = false;
    console.log(result1 + '1');
    $.ajax({
        data: form,
        dataType: 'json',
        type: 'POST',
        url: '/dynoReservation/dynoReservationStep1',
        success: function(data) {
            console.log(data);
            if (data.success == 1) {
                $('form').removeAttr('onsubmit'); // prevent endless loop
                $('form').submit();
            }
            else
            {
                result1 = false;
                var form = $('#reservation_step_1');
                var errors = [];
                errors = data.error;
                form.find('.form-register-row').each(function() {
                    var input_element = $(this).find('input'),
                            input = input_element.attr('name');

                    input = input.replace('reservation[', '');
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
    return false;
}

// модели выбранного бренда
function select_auto_models(brands_id) {
    $('#auto_models').prop('disabled', true).trigger("chosen:updated");
    $.ajax({
        data: {'brands_id': brands_id},
        dataType: 'json',
        type: 'POST',
        url: '/dynoReservation/selectAutoModels',
        success: function(data) {
            if (data.success == 1) {
                $('#auto_models').empty(); //remove all child nodes                
                $('#auto_models').append(data.auto_models);
                $('#auto_models').trigger("chosen:updated");
                $('#auto_models').prop('disabled', false).trigger("chosen:updated");
            }
            else
            {
                $('#auto_models').empty();
                $('#auto_models').prop('disabled', false).trigger("chosen:updated");
            }
        }
    });
}
window.onload = function() {
    if ($('#reserv-rules').change() == true) {
        $('#next-step').prop('disabled', false);
    }
}
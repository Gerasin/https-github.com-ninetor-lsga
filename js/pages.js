function filterPages(id_category) {
    $("#formFilter").submit();
    return false;
    var list = null, res = [], i = 0;
    list = $(':checkbox:checked', $('#filterpages'));
    list.each(function (ind) {
        res[i] = $(this).val();
        i++;
    });
    $.ajax({
        url: '/category/filterPages',
        type: 'POST',
        dataType: "json",
        data: {
            'res': res,
            'id_category': id_category,
        },
        success: function (data) {
            if (data != null) {
                if (data.success == 1) {
                    console.log(data);
                }
                else {
                    console.log(data);
                }
            }
        }
    });
}

function userMessagePages() {
    var form = $('#form_user_message_pages');
    $.ajax({
        data: $('#form_user_message_pages').serialize(),
        dataType: 'json',
        type: 'POST',
        url: 'pagesText/messageUser',
        success: function (data) {
            if (data.success == 1) {                
                $('#form_user_message_pages').html('Спасибо. Ваше сообщение отправлено.');                                    
            }
            else {                
                var errors = [];
                errors = data.error;
                form.find('.aright').each(function () {
                    var input_element = $(this).find('input,textarea,select,checkbox'),
                            input = input_element.attr('name');

                    input = input.replace('message[', '');
                    input = input.replace(']', '');
                    if (errors[input] > '') {                        
                        input_element.addClass('error');
                        input_element.parents('.aright').addClass('standart-error');
                        input_element.next('.error-text').html(errors[input][0]);
                    }
                });
            }
        }
    });
}

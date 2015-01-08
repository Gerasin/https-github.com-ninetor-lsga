function feedbackUserForm() {
    var message = $('#message').val();
    $.ajax({
        data: {'message': message},
        dataType: 'json',
        type: 'POST',
        url: '/feedback/index',
        success: function (data) {
            if (data.success == 1) {                
                $('.standart-form').hide();
                $('#feedback-title').html('Спасибо. Ваше сообщение отправлено.');
            }
            else {                
                $('#message').addClass('error');
                $('.arightMessage').addClass('standart-error');
                $('.error-text').html('Вы не ввели текст сообщения');
                return false;
            }
        }
    });
}
function thankyouUser() {
    $.ajax({
        data: {},
        dataType: 'json',
        type: 'POST',
        url: '/thankyou/index',
        success: function (data) {
            if (data.success == 1) {                
                $('#thankyou').html(data.count);
                $('#thankyou').addClass('thankyou');
            }
            else {
                return false;
            }
        }
    });
}

function startLessonUser(idClass) {
    $.ajax({
        data: {'idClass': idClass},
        dataType: 'json',
        type: 'POST',
        url: '/education/addUserExem',
        success: function (data) {
            if (data.success == 1) {
                location.href = '/education/lesson/' + data.id_problem;
            }
            else {
                return false;
            }
        }
    });
}

function problem_ans_form_end() {
    $('.ans_loader').attr('style', 'display: initial;');
    $('.klass-partitons li a').removeClass('active');
    $.ajax({
        data: $('#form_problem_ans').serialize(),
        dataType: 'json',
        type: 'POST',
        url: '/problem/newProblemEnd',
        success: function (data) {
            if (data.success == 1) {
                location.href = '/education/category/' + data.id_category;
            }
            else {
                return false;
            }
        }
    });
}

function problem_ans_form() {
    $('.ans_loader').attr('style', 'display: initial;');
    $('.klass-partitons li a').removeClass('active');
    $.ajax({
        data: $('#form_problem_ans').serialize(),
        dataType: 'json',
        type: 'POST',
        url: '/problem/newProblem',
        success: function (data) {
            if (data.success == 1) {
                $('#form_problem_ans').html(data.userForm);
                $('#comment_ans').html(data.problem['comment']);
                $('#h2_ans').html(data.problem['text']);
                $('.ans_loader').attr('style', 'display:none');
                $('#value' + data.position).addClass('active');
                if (data.endProblem) {
                    $('#nextButton').attr('onclick', 'problem_ans_form_end(); return false;');
                    $('#nextButton').html('Завершить экзамен');
                }
            }
            else {
                return false;
            }
        }
    });
}

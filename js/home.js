function homeProblem() {
    $('.ans_loader').attr('style', 'display: initial;');
    $('.klass-partitons li a').removeClass('active');
    $.ajax({
        data: $('#poll_bl_inner').serialize(),
        dataType: 'json',
        type: 'POST',
        url: '/main/newProblem',
        success: function (data) {
            if (data.success == 1) {
                $('#poll_bl_inner').html(data.userForm);                
            }
            else {
                return false;
            }
        }
    });
}

function homeProblemClose(e) {
    $('.hide-block_button').closest('.poll-bl').slideUp(200);
    $('.poll-bl-inner').preventDefault();
}
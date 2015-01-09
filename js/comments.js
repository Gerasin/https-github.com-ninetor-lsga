/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function dislikeComment(id_comment) {
    $.ajax({
        url: '/comments/addDislikeComment',
        type: 'POST',
        dataType: "json",
        data: {
            'id': id_comment
        },
        success: function (data) {
            if (data != null) {
                if (data.success == 1) {
                    
                    $('#comment-dislike-' + id_comment).parent().addClass('select-dislike');
                    $('#comment-like-' + id_comment).removeAttr('href');
                    $('#comment-like-' + id_comment).removeAttr('onclick');
                    $('#comment-dislike-' + id_comment).removeAttr('href');
                    $('#comment-dislike-' + id_comment).removeAttr('onclick');
                    $('#comment-rating-value-' + id_comment).html('(' + data.like + ')');
                }                
            }
        }
    });
}

function likeComment(id_comment) {
    $.ajax({
        url: '/comments/addLikeComment',
        type: 'POST',
        dataType: "json",
        data: {
            'id': id_comment
        },
        success: function (data) {
            if (data != null) {
                if (data.success == 1) {
                    
                    $('#comment-like-' + id_comment).parent().addClass('select-like');
                    $('#comment-like-' + id_comment).removeAttr('href');
                    $('#comment-like-' + id_comment).removeAttr('onclick');
                    $('#comment-dislike-' + id_comment).removeAttr('href');
                    $('#comment-dislike-' + id_comment).removeAttr('onclick');
                    $('#comment-rating-value-' + id_comment).html('(' + data.like + ')');
                }                
            }
        }
    });
}

function addComment(id_page) {
    $.ajax({
        url: '/comments/addComment',
        type: 'POST',
        dataType: "json",
        data: {
            'id_page': id_page,
            'id_parent': $('#id_parent').val(),
            'message': $('#comment').val(),
        },
        success: function (data) {
            if (data != null) {
                if (data.success == 1) {                    
                    location.reload();
                }
                else {
                    $('.comment-text').addClass('error');
                    $('.arightMessage').addClass('standart-error');
                    $('.error-text').html('Вы не ввели текст сообщения');                    
                }
            }
        }
    });
}

function replyComment(id_comment, nameUser) {
    $('#id_parent').val(id_comment);
    $('#comment').val(nameUser + ', ');
    $("html,body").animate({scrollTop: $("#detail-sharing").offset().top}, 1000);
}

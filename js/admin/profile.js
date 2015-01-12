// edit pages text
function formpagestexteditsubmit(menu_id) {
    $('.input-simple').removeClass('input-error');
    $('.error-edit-user').attr('style', 'display:none');
    var form = $('#form_pages_edit');
    $.ajax({
        data: $('#form_pages_edit').serialize(),
        dataType: 'json',
        type: 'POST',
        url: '/administration/pagesText/update/' + menu_id,
        success: function(data) {
            if (data.success == 1) {
                $('.success-edit-user').attr('style', 'display:block');
                setTimeout(function() {
                    //document.location.href = "/administration/menu/edit/" + data.menu_id;
                }, 1000);
            }
            else {
                var errors = [];
                errors = data.error;
                form.find('.list-group-item').each(function() {
                    var input_element = $(this).find('input,textarea,select,checkbox');
                    var input = input_element[0]['name'];
                    input = input.replace('pages[', '');
                    input = input.replace(']', '');
                    if (errors[input] > '') {
                        input_element.addClass('input-error');
                        $('.error-edit-user').attr('style', 'display:block');
                    }
                });
            }
        }
    });
}
// add pages text
function formpagesediteditsubmitadd() {
    $('.input-simple').removeClass('input-error');
    $('.error-edit-user').attr('style', 'display:none');
    var form = $('#form_pages_edit');
    $.ajax({
        data: $('#form_pages_edit').serialize(),
        dataType: 'json',
        type: 'POST',
        url: '/administration/pagesText/addform',
        success: function(data) {
            if (data.success == 1) {
                $('.success-edit-user').attr('style', 'display:block');
                setTimeout(function() {
                    //document.location.href = "/administration/menu/edit/" + data.menu_id;
                }, 1000);
            }
            else {
                var errors = [];
                errors = data.error;
                form.find('.list-group-item').each(function() {
                    var input_element = $(this).find('input,textarea,select,checkbox');
                    var input = input_element[0]['name'];
                    input = input.replace('pages[', '');
                    input = input.replace(']', '');
                    if (errors[input] > '') {
                        input_element.addClass('input-error');
                        $('.error-edit-user').attr('style', 'display:block');
                    }
                });
            }
        }
    });
}




// edit menu
function formmenueditsubmit(menu_id) {
    $('.input-simple').removeClass('input-error');
    $('.error-edit-user').attr('style', 'display:none');
    var form = $('#form_menu_edit');
    $.ajax({
        data: $('#form_menu_edit').serialize(),
        dataType: 'json',
        type: 'POST',
        url: '/administration/menu/update/' + menu_id,
        success: function(data) {
            if (data.success == 1) {
                $('.success-edit-user').attr('style', 'display:block');
                setTimeout(function() {
                    document.location.href = "/administration/menu/edit/" + data.menu_id;
                }, 1000);
            }
            else {
                var errors = [];
                errors = data.error;
                form.find('.list-group-item').each(function() {
                    var input_element = $(this).find('input,textarea,select,checkbox');
                    var input = input_element[0]['name'];
                    input = input.replace('menu[', '');
                    input = input.replace(']', '');
                    if (errors[input] > '') {
                        input_element.addClass('input-error');
                        $('.error-edit-user').attr('style', 'display:block');
                    }
                });
            }
        }
    });
}
// add menu
function formmenueditsubmitadd() {
    $('.input-simple').removeClass('input-error');
    $('.error-edit-user').attr('style', 'display:none');
    var form = $('#form_menu_edit');
    $.ajax({
        data: $('#form_menu_edit').serialize(),
        dataType: 'json',
        type: 'POST',
        url: '/administration/menu/addform',
        success: function(data) {
            if (data.success == 1) {
                $('.success-edit-user').attr('style', 'display:block');
                setTimeout(function() {
                    document.location.href = "/administration/menu/edit/" + data.menu_id;
                }, 1000);
            }
            else {
                var errors = [];
                errors = data.error;
                form.find('.list-group-item').each(function() {
                    var input_element = $(this).find('input,textarea,select,checkbox');
                    var input = input_element[0]['name'];
                    input = input.replace('menu[', '');
                    input = input.replace(']', '');
                    if (errors[input] > '') {
                        input_element.addClass('input-error');
                        $('.error-edit-user').attr('style', 'display:block');
                    }
                });
            }
        }
    });
}

// add block
function add_ans_home(id_block) {
    var myBlock = '';
    myBlock = '<span id="id_ans_' + id_block + '"><input class="input-simple" type="text" id="person-nick" name="ans[' + id_block + ']" style="width: 50%" value=""/> -- <a href="#" onclick="formhomeproblemdeleteblock(' + id_block + '); return false;">удл.</a><Br><Br></span>';
    $('#add_ans_block').append(myBlock);
    var myBlockLin, newid = ++id_block;
    myBlockLin = "add_ans_home('" + newid + "'); return false;";
    $('#lin_add_ans').attr('onClick', myBlockLin);
}

// delete block
function formhomeproblemdeleteblock(id_block, problem) {
    $('#id_ans_' + id_block).html('');
    $('#id_ans_' + id_block).remove();
    if (problem) {
        $.ajax({
            data: {problem: problem},
            dataType: 'json',
            type: 'POST',
            url: '/administration/dashboard/deleteAnsTable',
            success: function(data) {
            }
        });
    }
}

// add problem
function formhomeproblemeditsubmitadd() {
    $('.input-simple').removeClass('input-error');
    $('.error-edit-user').attr('style', 'display:none');
    var form = $('#form_problem_edit');
    $.ajax({
        data: $('#form_problem_edit').serialize(),
        dataType: 'json',
        type: 'POST',
        url: '/administration/homeproblem/formadd',
        success: function(data) {
            if (data.success == 1) {
                $('.success-edit-user').attr('style', 'display:block');
                setTimeout(function() {
                    document.location.href = "/administration/homeproblem/edit/" + data.problem_id;
                }, 1000);
            }
            else {
                $('.input-simple').removeClass('input-error');
                $('.error-edit-user').attr('style', 'display:block');
                var errors = [];
                errors = data.error;
                form.find('.list-group-item').each(function() {
                    var input_element = $(this).find('input,textarea,select,checkbox');
                    var input = input_element[0]['name'];
                    input = input.replace('problem[', '');
                    input = input.replace(']', '');
                    if (errors[input] > '') {
                        input_element.addClass('input-error');
                        $('.error-edit-user').attr('style', 'display:block');
                    }
                });
            }
        }
    });
}
// edit problem
function formhomeproblemeditsubmit(problem_id) {
    $('.input-simple').removeClass('input-error');
    $('.error-edit-user').attr('style', 'display:none');
    var form = $('#form_problem_edit');
    $.ajax({
        data: $('#form_problem_edit').serialize(),
        dataType: 'json',
        type: 'POST',
        url: '/administration/homeproblem/update/' + problem_id,
        success: function(data) {
            if (data.success == 1) {
                $('.success-edit-user').attr('style', 'display:block');
                setTimeout(function() {
                    document.location.href = "/administration/homeproblem/edit/" + data.problem_id;
                }, 1000);
            }
            else {
                $('.input-simple').removeClass('input-error');
                $('.error-edit-user').attr('style', 'display:block');
                var errors = [];
                errors = data.error;
                form.find('.list-group-item').each(function() {
                    var input_element = $(this).find('input,textarea,select,checkbox');
                    var input = input_element[0]['name'];
                    input = input.replace('problem[', '');
                    input = input.replace(']', '');
                    if (errors[input] > '') {
                        input_element.addClass('input-error');
                    }
                });

            }
        }
    });
}



// edir pages
function formpageseditsubmit(pages_id) {
    $('.input-simple').removeClass('input-error');
    $('.error-edit-user').attr('style', 'display:none');

    var form = document.forms.form_pages_edit;

    var formData = new FormData(form);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/administration/pages/update/" + pages_id);

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                data = JSON.parse(xhr.responseText);
                if (data.success == '1') {
                    $('.success-edit-user').attr('style', 'display:block');
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    var errors = [];
                    errors = data.error;
                    var form1 = $('#form_pages_edit');

                    form1.find('.list-group-item').each(function() {
                        var input_element = $(this).find('input,textarea,select,checkbox');
                        var input = input_element[0]['name'];
                        input = input.replace('pages[', '');
                        input = input.replace(']', '');
                        if (errors[input] > '') {
                            input_element.addClass('input-error');
                            $('.error-edit-user').attr('style', 'display:block');
                        }
                    });
                }
            }
        }
    };

    xhr.send(formData);

}
function newProrertisPage(id) {
    $.ajax({
        data: {'id_category': id},
        dataType: 'json',
        type: 'POST',
        url: '/administration/adminCompany/AddPagesPropertis',
        success: function(data) {
            if (data.success == 1) {
                $('#pageProperties').html(data.propertis);
            }
        }
    });
}
// add pages
function formpageseditsubmitadd() {
    $('.input-simple').removeClass('input-error');
    $('.error-edit-user').attr('style', 'display:none');

    var form = document.forms.form_pages_edit;
    var formData = new FormData(form);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/administration/pages/addform");

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                data = JSON.parse(xhr.responseText);

                if (data.success == '1') {
                    return false;
                    $('.success-edit-user').attr('style', 'display:block');
                    setTimeout(function() {
                        document.location.href = "/administration/pages/edit/" + data.education_id;
                    }, 1000);
                } else {
                    var errors = [];
                    errors = data.error;
                    var form1 = $('#form_pages_edit');

                    form1.find('.list-group-item').each(function() {
                        var input_element = $(this).find('input,textarea,select,checkbox');
                        var input = input_element[0]['name'];
                        input = input.replace('pages[', '');
                        input = input.replace(']', '');
                        if (errors[input] > '') {
                            input_element.addClass('input-error');
                            $('.error-edit-user').attr('style', 'display:block');
                        }
                    });
                }
            }
        }
    };

    xhr.send(formData);
}


function blockCategoryView(valueParent) {
    if (valueParent == 0) {
        $('#idCategoryBlock').show();
    } else {
        $('#idCategoryBlock').hide();
    }
}
// edit properties
function formpropertieseditsubmit(properties_id) {
    $('.input-simple').removeClass('input-error');
    $('.error-edit-user').attr('style', 'display:none');
    var form = $('#form_properties_edit');
    $.ajax({
        data: $('#form_properties_edit').serialize(),
        dataType: 'json',
        type: 'POST',
        url: '/administration/properties/update/' + properties_id,
        success: function(data) {
            if (data.success == 1) {
                $('.success-edit-user').attr('style', 'display:block');
                setTimeout(function() {
                    document.location.href = "/administration/properties/edit/" + data.properties_id;
                }, 1000);
            }
            else {
                var errors = [];
                errors = data.error;
                form.find('.list-group-item').each(function() {
                    var input_element = $(this).find('input,textarea,select,checkbox');
                    var input = input_element[0]['name'];
                    input = input.replace('properties[', '');
                    input = input.replace(']', '');
                    if (errors[input] > '') {
                        input_element.addClass('input-error');
                        $('.error-edit-user').attr('style', 'display:block');
                    }
                });
            }
        }
    });
}

// add properties
function formpropertieseditsubmitadd() {
    $('.input-simple').removeClass('input-error');
    $('.error-edit-user').attr('style', 'display:none');
    var form = $('#form_properties_edit');
    $.ajax({
        data: $('#form_properties_edit').serialize(),
        dataType: 'json',
        type: 'POST',
        url: '/administration/properties/add',
        success: function(data) {
            if (data.success == 1) {
                $('.success-edit-user').attr('style', 'display:block');
                setTimeout(function() {
                    document.location.href = "/administration/properties/edit/" + data.properties_id;
                }, 1000);
            }
            else {
                $('.input-simple').removeClass('input-error');
                $('.error-edit-user').attr('style', 'display:block');
                var errors = [];
                errors = data.error;
                form.find('.list-group-item').each(function() {
                    var input_element = $(this).find('input,textarea,select,checkbox');
                    var input = input_element[0]['name'];
                    input = input.replace('properties[', '');
                    input = input.replace(']', '');
                    if (errors[input] > '') {
                        input_element.addClass('input-error');
                        $('.error-edit-user').attr('style', 'display:block');
                    }
                });
            }
        }
    });
}


// edit category
function formcategoryeditsubmit(category_id) {
    $('.input-simple').removeClass('input-error');
    $('.error-edit-user').attr('style', 'display:none');
    var form = $('#form_category_edit');
    $.ajax({
        data: $('#form_category_edit').serialize(),
        dataType: 'json',
        type: 'POST',
        url: '/administration/category/update/' + category_id,
        success: function(data) {
            if (data.success == 1) {
                $('.success-edit-user').attr('style', 'display:block');
                setTimeout(function() {
                    document.location.href = "/administration/category/edit/" + data.category_id;
                }, 1000);
            }
            else {
                var errors = [];
                errors = data.error;
                form.find('.list-group-item').each(function() {
                    var input_element = $(this).find('input,textarea,select,checkbox');
                    var input = input_element[0]['name'];
                    input = input.replace('category[', '');
                    input = input.replace(']', '');
                    if (errors[input] > '') {
                        input_element.addClass('input-error');
                        $('.error-edit-user').attr('style', 'display:block');
                    }
                });
            }
        }
    });
}
// add category
function formcategoryeditsubmitadd() {
    $('.input-simple').removeClass('input-error');
    $('.error-edit-user').attr('style', 'display:none');
    var form = $('#form_category_edit');
    $.ajax({
        data: $('#form_category_edit').serialize(),
        dataType: 'json',
        type: 'POST',
        url: '/administration/category/add',
        success: function(data) {
            if (data.success == 1) {

                $('.success-edit-user').attr('style', 'display:block');
                setTimeout(function() {
                    document.location.href = "/administration/category/edit/" + data.category_id;
                }, 1000);
            }
            else {
                $('.input-simple').removeClass('input-error');
                $('.error-edit-user').attr('style', 'display:block');
                var errors = [];
                errors = data.error;
                form.find('.list-group-item').each(function() {
                    var input_element = $(this).find('input,textarea,select,checkbox');
                    var input = input_element[0]['name'];
                    input = input.replace('category[', '');
                    input = input.replace(']', '');
                    if (errors[input] > '') {
                        input_element.addClass('input-error');
                        $('.error-edit-user').attr('style', 'display:block');
                    }
                });
            }
        }
    });
}

// edit problem
function formproblemeditsubmit(problem_id) {
    $('.input-simple').removeClass('input-error');
    $('.error-edit-user').attr('style', 'display:none');
    var form = $('#form_problem_edit');
    $.ajax({
        data: $('#form_problem_edit').serialize(),
        dataType: 'json',
        type: 'POST',
        url: '/administration/problem/update/' + problem_id,
        success: function(data) {
            if (data.success == 1) {
                $('.success-edit-user').attr('style', 'display:block');
                setTimeout(function() {
                    document.location.href = "/administration/problem/edit/" + data.problem_id;
                }, 1000);
            }
            else {
                $('.input-simple').removeClass('input-error');
                $('.error-edit-user').attr('style', 'display:block');
                var errors = [];
                errors = data.error;
                form.find('.list-group-item').each(function() {
                    var input_element = $(this).find('input,textarea,select,checkbox');
                    var input = input_element[0]['name'];
                    input = input.replace('problem[', '');
                    input = input.replace(']', '');
                    if (errors[input] > '') {
                        input_element.addClass('input-error');
                    }
                });

            }
        }
    });
}

// add block
function add_ans(id_block) {
    var myBlock = '';
    myBlock = '<span id="id_ans_' + id_block + '"><input class="input-simple" type="text" id="person-nick" name="ans[' + id_block + ']" style="width: 50%" value=""/> <input type="radio" name="problem[status]" value="' + id_block + '"> Верный  -- <a href="#" onclick="formproblemdeleteblock(' + id_block + '); return false;">удл.</a><Br><Br></span>';
    $('#add_ans_block').append(myBlock);
    var myBlockLin, newid = ++id_block;
    myBlockLin = "add_ans('" + newid + "'); return false;";
    $('#lin_add_ans').attr('onClick', myBlockLin);
}

// delete block
function formproblemdeleteblock(id_block, problem) {

    if (problem) {
        $.ajax({
            data: {problem: problem},
            dataType: 'json',
            type: 'POST',
            url: '/administration/AdminCompany/deleteAnsTable',
            success: function(data) {
                $('#id_ans_' + id_block).html('');
                $('#id_ans_' + id_block).remove();
            }
        });
    }
}

// add problem
function formproblemeditsubmitadd() {
    $('.input-simple').removeClass('input-error');
    $('.error-edit-user').attr('style', 'display:none');
    var form = $('#form_problem_edit');
    $.ajax({
        data: $('#form_problem_edit').serialize(),
        dataType: 'json',
        type: 'POST',
        url: '/administration/problem/formadd',
        success: function(data) {
            if (data.success == 1) {
                $('.success-edit-user').attr('style', 'display:block');
                setTimeout(function() {
                    document.location.href = "/administration/problem/edit/" + data.problem_id;
                }, 1000);
            }
            else {
                $('.input-simple').removeClass('input-error');
                $('.error-edit-user').attr('style', 'display:block');
                var errors = [];
                errors = data.error;
                form.find('.list-group-item').each(function() {
                    var input_element = $(this).find('input,textarea,select,checkbox');
                    var input = input_element[0]['name'];
                    input = input.replace('problem[', '');
                    input = input.replace(']', '');
                    if (errors[input] > '') {
                        input_element.addClass('input-error');
                        $('.error-edit-user').attr('style', 'display:block');
                    }
                });
            }
        }
    });
}

// edit lesson
function formlessoneditsubmit(lesson_id) {
    $('.input-simple').removeClass('input-error');
    $('.error-edit-user').attr('style', 'display:none');
    var form = $('#form_lesson_edit');
    $.ajax({
        data: $('#form_lesson_edit').serialize(),
        dataType: 'json',
        type: 'POST',
        url: '/administration/lesson/update/' + lesson_id,
        success: function(data) {
            if (data.success == 1) {
                $('.success-edit-user').attr('style', 'display:block');
                setTimeout(function() {
                    document.location.href = "/administration/lesson/edit/" + data.lesson_id;
                }, 1000);
            }
            else {
                var errors = [];
                errors = data.error;
                form.find('.list-group-item').each(function() {
                    var input_element = $(this).find('input,textarea,select,checkbox');
                    var input = input_element[0]['name'];
                    input = input.replace('lesson[', '');
                    input = input.replace(']', '');
                    if (errors[input] > '') {
                        input_element.addClass('input-error');
                        $('.error-edit-user').attr('style', 'display:block');
                    }
                });
            }
        }
    });
}
// add lesson
function formlessoneditsubmitadd() {
    $('.input-simple').removeClass('input-error');
    $('.error-edit-user').attr('style', 'display:none');
    var form = $('#form_lesson_edit');
    $.ajax({
        data: $('#form_lesson_edit').serialize(),
        dataType: 'json',
        type: 'POST',
        url: '/administration/lesson/add',
        success: function(data) {
            if (data.success == 1) {
                $('.success-edit-user').attr('style', 'display:block');
                setTimeout(function() {
                    document.location.href = "/administration/lesson/edit/" + data.lesson_id;
                }, 1000);
            }
            else {
                var errors = [];
                errors = data.error;
                form.find('.list-group-item').each(function() {
                    var input_element = $(this).find('input,textarea,select,checkbox');
                    var input = input_element[0]['name'];
                    input = input.replace('lesson[', '');
                    input = input.replace(']', '');
                    if (errors[input] > '') {
                        input_element.addClass('input-error');
                        $('.error-edit-user').attr('style', 'display:block');
                    }
                });
            }
        }
    });
}

// edit classroom
function formclassroomeditsubmit(classroom_id) {
    $('.input-simple').removeClass('input-error');
    $('.error-edit-user').attr('style', 'display:none');
    var form = $('#form_classroom_edit');
    $.ajax({
        data: $('#form_classroom_edit').serialize(),
        dataType: 'json',
        type: 'POST',
        url: '/administration/classroom/update/' + classroom_id,
        success: function(data) {
            if (data.success == 1) {
                $('.success-edit-user').attr('style', 'display:block');
                setTimeout(function() {
                    document.location.href = "/administration/classroom/edit/" + data.classroom_id;
                }, 1000);
            }
            else {
                var errors = [];
                errors = data.error;
                form.find('.list-group-item').each(function() {
                    var input_element = $(this).find('input,textarea,select,checkbox');
                    var input = input_element[0]['name'];
                    input = input.replace('classroom[', '');
                    input = input.replace(']', '');
                    if (errors[input] > '') {
                        input_element.addClass('input-error');
                        $('.error-edit-user').attr('style', 'display:block');
                    }
                });
            }
        }
    });
}
// add classroom
function formclassroomeditsubmitadd() {
    $('.input-simple').removeClass('input-error');
    $('.error-edit-user').attr('style', 'display:none');
    var form = $('#form_classroom_edit');
    $.ajax({
        data: $('#form_classroom_edit').serialize(),
        dataType: 'json',
        type: 'POST',
        url: '/administration/classroom/add',
        success: function(data) {
            if (data.success == 1) {
                $('.success-edit-user').attr('style', 'display:block');
                setTimeout(function() {
                    document.location.href = "/administration/classroom/edit/" + data.classroom_id;
                }, 1000);
            }
            else {
                var errors = [];
                errors = data.error;
                form.find('.list-group-item').each(function() {
                    var input_element = $(this).find('input,textarea,select,checkbox');
                    var input = input_element[0]['name'];
                    input = input.replace('classroom[', '');
                    input = input.replace(']', '');
                    if (errors[input] > '') {
                        input_element.addClass('input-error');
                        $('.error-edit-user').attr('style', 'display:block');
                    }
                });
            }
        }
    });
}

// add education
function formeducationeditsubmitadd() {
    $('.input-simple').removeClass('input-error');
    $('.error-edit-user').attr('style', 'display:none');

    var form = document.forms.form_education_edit;
    var formData = new FormData(form);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/administration/education/add");

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                data = JSON.parse(xhr.responseText);
                if (data.success == '1') {
                    $('.success-edit-user').attr('style', 'display:block');
                    setTimeout(function() {
                        document.location.href = "/administration/education/edit/" + data.education_id;
                    }, 1000);
                } else {
                    var errors = [];
                    errors = data.error;
                    var form1 = $('#form_education_edit');

                    form1.find('.list-group-item').each(function() {
                        var input_element = $(this).find('input,textarea,select,checkbox');
                        var input = input_element[0]['name'];
                        input = input.replace('education[', '');
                        input = input.replace(']', '');
                        if (errors[input] > '') {
                            input_element.addClass('input-error');
                            $('.error-edit-user').attr('style', 'display:block');
                        }
                    });
                }
            }
        }
    };

    xhr.send(formData);

}
// edir education
function formeducationeditsubmit(education_id) {
    $('.input-simple').removeClass('input-error');
    $('.error-edit-user').attr('style', 'display:none');

    var form = document.forms.form_education_edit;

    var formData = new FormData(form);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/administration/education/update/" + education_id);

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                data = JSON.parse(xhr.responseText);
                if (data.success == '1') {
                    $('.success-edit-user').attr('style', 'display:block');
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    var errors = [];
                    errors = data.error;
                    var form1 = $('#form_education_edit');

                    form1.find('.list-group-item').each(function() {
                        var input_element = $(this).find('input,textarea,select,checkbox');
                        var input = input_element[0]['name'];
                        input = input.replace('education[', '');
                        input = input.replace(']', '');
                        if (errors[input] > '') {
                            input_element.addClass('input-error');
                            $('.error-edit-user').attr('style', 'display:block');
                        }
                    });
                }
            }
        }
    };

    xhr.send(formData);

}
function formusereditsubmit(user_id) {
    $('.input-simple').removeClass('input-error');
    $('.error-edit-user').attr('style', 'display:none');

    var form = document.forms.form_user_edit;
    var formData = new FormData(form);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/administration/user/user_update/" + user_id);

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                data = JSON.parse(xhr.responseText);
                if (data.success == '1') {
                    $('.success-edit-user').attr('style', 'display:block');
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    var errors = [];
                    errors = data.error;
                    var form1 = $('#form_user_edit');
                    form1.find('.list-group-item').each(function() {
                        var input_element = $(this).find('input,textarea,select,checkbox');
                        var input = input_element[0]['name'];
                        input = input.replace('user[', '');
                        input = input.replace(']', '');
                        if (errors[input] > '') {
                            input_element.addClass('input-error');
                            $('.error-edit-user').attr('style', 'display:block');
                        }
                    });
                }
            }
        }
    };
    xhr.send(formData);
}

function formusereditsubmit123(user_id) {
    $('.input-simple').removeClass('input-error');
    $('.error-edit-user').attr('style', 'display:none');
    var form = $('#form-user-edit');
    $.ajax({
        data: $('#form-user-edit').serialize(),
        dataType: 'json',
        type: 'POST',
        url: '/administration/user/user_update/' + user_id,
        success: function(data) {
            if (data.success == 1) {
                $('.success-edit-user').attr('style', 'display:block');
                setTimeout(function() {
                    location.reload();
                }, 1000);
            }
            else {
                var errors = [];
                errors = data.error;
                form.find('.list-group-item').each(function() {
                    var input_element = $(this).find('input,textarea,select,checkbox');
                    var input = input_element[0]['name'];
                    input = input.replace('user[', '');
                    input = input.replace(']', '');
                    if (errors[input] > '') {
                        input_element.addClass('input-error');
                        $('.error-edit-user').attr('style', 'display:block');
                    }
                });
            }
        }
    });
}

// edit posts
function formpostseditsubmit(post_id) {
    $('#blockLoader').show();

    $('.input-simple').removeClass('input-error');
    $('.error-edit-user').attr('style', 'display:none');

    var form = document.forms.form_posts_edit;

    var formData = new FormData(form);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/administration/mainBlocks/posts/update/" + post_id);

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                data = JSON.parse(xhr.responseText);
                if (data.success == '1') {
                    $('.success-edit-user').attr('style', 'display:block');
                    setTimeout(function() {
                        window.history.back();
                    }, 1000);
                    // console.log('1');
                } else {
                    $('#blockLoader').hide();
                    var errors = [];
                    errors = data.error;
                    var form1 = $('#form_posts_edit');
                    var ImageErrors = data.imageError;
                    form1.find('.list-group-item').each(function() {
                        var input_element = $(this).find('input,textarea,select,checkbox');
                        var input = input_element[0]['name'];
                        console.log(input);
                        if (errors[input] > '') {
                            input_element.addClass('input-error');
                            $('.error-edit-user').attr('style', 'display:block');
                        }
                    });
                    if (ImageErrors)
                    {
                        $('#fileToUploadmain').addClass('input-error');
                        $('.error-edit-user').attr('style', 'display:block');
                        $('.error-edit-user').text(ImageErrors);
                    }
                    var ImageErrorsAdditional = data.imageErrorsAdditional;
                    var boolImageErrorView = false;
                    for (var i = 0; i < ImageErrorsAdditional.length; i++)
                    {
                        if (ImageErrorsAdditional[i] !== null) {
                            boolImageErrorView = true;
                            $('#fileToUploadAdd' + (i + 1)).addClass('input-error');
                        }
                    }
                    if (boolImageErrorView)
                    {
                        $('.error-edit-user').attr('style', 'display:block');
                        $('.error-edit-user').text('Произошли ошибки при загрузке дополнительных изображений!');
                    }
                }
            }
        }
    };

    xhr.send(formData);

}

function formpostsaddsubmit(block_id) {
    $('#blockLoader').show();

    $('.input-simple').removeClass('input-error');

    $('.error-edit-user').attr('style', 'display:none');
    var form = document.forms.form_posts_edit;
    var formData = new FormData(form);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/administration/mainBlocks/posts/update/" + block_id + "?new=true");

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                data = JSON.parse(xhr.responseText);
                if (data.success == '1') {
                    $('.success-edit-user').attr('style', 'display:block');
                    setTimeout(function() {
                        location.href = "/administration/mainBlocks/edit/" + block_id;
                    }, 1000);
                } else {
                    $('#blockLoader').hide();
                    var errors = [];
                    errors = data.error;
                    var form1 = $('#form_posts_edit');
                    form1.find('.list-group-item').each(function() {
                        var input_element = $(this).find('input,textarea,select,checkbox');
                        var input = input_element[0]['name'];
                        if (errors[input] > '') {
                            input_element.addClass('input-error');
                            $('.error-edit-user').attr('style', 'display:block');
                        }
                    });
                    var ImageErrors = (data.imageError != null) ? data.imageError : 'Не выбрано изображение';
                    if (ImageErrors) {
                        $('#fileToUploadmain').addClass('input-error');
                        $('.error-edit-user').attr('style', 'display:block');
                        $('.error-edit-user').text(ImageErrors);
                    }
                    var ImageErrorsAdditional = data.imageErrorsAdditional;
                    var boolImageErrorView = false;
                    for (var i = 0; i < ImageErrorsAdditional.length; i++)
                    {
                        if (ImageErrorsAdditional[i] != false) {
                            boolImageErrorView = true;
                            $('#fileToUploadAdd' + (i + 1)).addClass('input-error');
                        }
                    }
                    if (boolImageErrorView)
                    {
                        $('.error-edit-user').attr('style', 'display:block');
                        $('.error-edit-user').text('Произошли ошибки при загрузке дополнительных изображений!');
                    }
                }

            }
        }
    };

    xhr.send(formData);
}


function formshopcategoryeditsubmit(category_id) {
    $('#blockLoader').show();
    $('.input-simple').removeClass('input-error');
    $('.error-edit-user').attr('style', 'display:none');
    var new_name = $('#form_shop_category_edit #name').val();
    $.ajax({
        data: { name: new_name },
        dataType: 'json',
        type: 'POST',
        url: '/administration/adminShop/shopCategoryEditName?id=' + category_id,
        success: function (data) {
            if (data.success == 1) {
                $('.success-edit-user').attr('style', 'display:block');
                setTimeout(function () {
                    document.location.href = "/administration/shopCategory/edit/" + category_id;
                }, 1000);
            }
            else {
                var errors = [];
                    errors = data.error;
                        $('#form_shop_category_edit #name').addClass('input-error');
                        $('.error-edit-user').attr('style', 'display:block');
            }
        }
    });
}

function formshopcategoryadd(parent_id) {
    $('#blockLoader').show();
    $('.input-simple').removeClass('input-error');
    $('.error-edit-user').attr('style', 'display:none');
    var new_name = $('#form_shop_category_add #name').val();
    $.ajax({
        data: { name: new_name, parent_id: parent_id },
        dataType: 'json',
        type: 'POST',
        url: '/administration/adminShop/shopCategoryAddNew',
        success: function (data) {
            if (data.success == 1) {
                $('.success-edit-user').attr('style', 'display:block');
                setTimeout(function () {
                   history.back();
                }, 1000);
            }
            else {
                var errors = [];
                    errors = data.error;
                        $('#form_shop_category_add #name').addClass('input-error');
                        $('.error-edit-user').attr('style', 'display:block');
            }
        }
    });
}

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Добавление вопросов на главной странице
                </h1>
                <ol class="breadcrumb">
                    <li><i class="fa"></i><a href="/administration">Главная</a></li>                   
                    <li><i class="fa"></i>Добавление</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form enctype="multipart/form-data" action="/administration/homeproblem/add" method="post" id="form_problem_edit" onsubmit="return false;">
                    <li class="list-group-item">Вопрос: <textarea style="height: 100px" class="form-control" name="problem[text]"></textarea></li>
                    <li class="list-group-item">Статус: 
                        <select class="form-control" name="active" id="active">
                            <option value="1" selected="selected">Ативен</option>
                            <option value="0">Не активен</option>                            
                        </select>
                    </li>
                    <li class="list-group-item" id="add_ans_block">Ответы: 

                        <a href="#" id="lin_add_ans" onclick="add_ans_home('4');
                        return false;">+ добавить</a></br>
                        <span id="id_ans_1">
                            <input class="input-simple" type="text" id="person-nick" name="ans[1]" style="width: 50%" value=""/> -- <a href="#" onclick="formhomeproblemdeleteblock(1);
                        return false;">удл.</a><Br><Br>
                        </span>
                        <span id="id_ans_2">
                            <input class="input-simple" type="text" id="person-nick" name="ans[2]" style="width: 50%" value=""/> -- <a href="#" onclick="formhomeproblemdeleteblock(2);
                        return false;">удл.</a><Br><Br>
                        </span>
                        <span id="id_ans_3">
                            <input class="input-simple" type="text" id="person-nick" name="ans[3]" style="width: 50%" value=""/> -- <a href="#" onclick="formhomeproblemdeleteblock(3);
                        return false;">удл.</a><Br><Br>
                        </span>

                    </li>
                    <div class="error-edit-user">Заполните корректно выделеные поля.</div>
                    <div class="success-edit-user">Данные сохранены</div> 
                    <button type="submit" class="form-personal-submit" onclick="formhomeproblemeditsubmitadd()"  id="form-user-edit-submit">Создать</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Добавление/Редактирование вопросов к экзамену
                </h1>
                <ol class="breadcrumb">
                    <li><i class="fa"></i><a href="/administration">Главная</a></li>
                    <li><i class="fa"></i><a href="/administration/classroom">Классы</a></li>
                    <li><i class="fa"></i><a href="/administration/problem/<?= $classId ?>">Вопросы</a></li>
                    <li><i class="fa"></i>Добавление</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form enctype="multipart/form-data" action="/administration/problem/add" method="post" id="form_problem_edit" onsubmit="return false;">                       
                    <li class="list-group-item">Класс: 
                        <select class="form-control" name="id_class" id="lesson[id_class]">
                            <?php foreach ($classroom as $item): ?>
                                <option value="<?= $item->id ?>" <?php if ($classId == $item->id): ?>selected="selected"<?php endif; ?>><?php echo $item->name ?></option>                          
                            <?php endforeach; ?>
                        </select>
                    </li>
                    <li class="list-group-item">Вопрос: <textarea style="height: 100px" class="form-control" name="problem[text]"></textarea></li>
                    <li class="list-group-item">Комментарий к вопросу: <textarea style="height: 100px" class="form-control" name="problem[comment]"></textarea></li>
                    <li class="list-group-item" id="add_ans_block">Ответы: 
                        <?php if (isset($edit) && $edit == 1): ?>
                            <a href="#" id="lin_add_ans" onclick="add_ans('<?= count($ans) + 1 ?>');
                                    return false;">+ добавить</a></br>
                               <?php $countAns = 1;
                               foreach ($ans as $value):
                                   ?>
                                <span id="id_ans_<?= $countAns ?>">
                                    <input class="input-simple" type="text" id="person-nick" name="ans[<?= $countAns ?>]" style="width: 50%" value="<?php echo $value->text ?>"/> <input type="radio" <?php if ($value->id == $problem->status_ans): ?>checked<?php endif; ?> name="problem[status]" value="<?= $countAns ?>"> Верный  -- <a href="#" onclick="formproblemdeleteblock(<?= $countAns ?>);
                                            return false;">удл.</a><Br><Br>
                                </span>
                                <?php $countAns++ ?>
                            <?php endforeach; ?>
                           <?php else: ?>  
                            <a href="#" id="lin_add_ans" onclick="add_ans('4');
                                    return false;">+ добавить</a></br>
                            <span id="id_ans_1">
                                <input class="input-simple" type="text" id="person-nick" name="ans[1]" style="width: 50%" value=""/> <input type="radio" name="problem[status]" value="1"> Верный  -- <a href="#" onclick="formproblemdeleteblock(1); return false;">удл.</a><Br><Br>
                            </span>
                            <span id="id_ans_2">
                                <input class="input-simple" type="text" id="person-nick" name="ans[2]" style="width: 50%" value=""/> <input type="radio" name="problem[status]" value="2"> Верный  -- <a href="#" onclick="formproblemdeleteblock(2);
                                        return false;">удл.</a><Br><Br>
                            </span>
                            <span id="id_ans_3">
                                <input class="input-simple" type="text" id="person-nick" name="ans[3]" style="width: 50%" value=""/> <input type="radio" name="problem[status]" value="3"> Верный  -- <a href="#" onclick="formproblemdeleteblock(3);
                                        return false;">удл.</a><Br><Br>
                            </span>
<?php endif; ?>                        
                    </li>
                    <div class="error-edit-user">Заполните корректно выделеные поля. Обязательно укажите верный ответ на вопрос.</div>
                    <div class="success-edit-user">Данные сохранены</div>  
                        <button type="submit" class="form-personal-submit" onclick="formproblemeditsubmitadd()"  id="form-user-edit-submit">Создать</button>
                </form>
            </div>
        </div>
    </div>
</div>
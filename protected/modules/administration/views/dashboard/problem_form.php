<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Добавление/Редактирование вопросов на главной странице
                </h1>
                <ol class="breadcrumb">
                    <li><i class="fa"></i><a href="/administration">Главная</a></li>                   
                    <li><i class="fa"></i>Добавление/Редактирование</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form enctype="multipart/form-data" action="/administration/homeproblem/add" method="post" id="form_problem_edit" onsubmit="return false;">
                    <li class="list-group-item">Вопрос: <textarea style="height: 100px" class="form-control" name="problem[text]"><?php echo htmlspecialchars($problem->text) ?></textarea></li>
                    <li class="list-group-item">Статус: 
                        <select class="form-control" name="active" id="active">
                            <option value="1" <?php if ($problem->active == 1): ?>selected="selected"<?php endif; ?>>Ативен</option>
                            <option value="0" <?php if ($problem->active != 1): ?>selected="selected"<?php endif; ?>>Не активен</option>                            
                        </select>
                    </li>
                    <li class="list-group-item" id="add_ans_block">Ответы: 
                        <?php if (isset($edit) && $edit == 1): ?>
                            <a href="#" id="lin_add_ans" onclick="add_ans_home('<?= count($ans) + 1 ?>');return false;">+ добавить</a></br>
                               <?php $countAns = 1;
                               foreach ($ans as $value):
                                   ?>
                                <span id="id_ans_<?= $countAns ?>">
                                    <input class="input-simple" type="text" id="person-nick" name="ans[<?= $value->id ?>]" style="width: 50%" value="<?php echo $value->text ?>"/> -- <a href="#" onclick="formhomeproblemdeleteblock(<?= $countAns ?>, <?= $value->id?>);
                                            return false;">удл.</a><Br><Br>
                                </span>
                                <?php $countAns++ ?>
                            <?php endforeach; ?>
                           <?php else: ?>  
                            <a href="#" id="lin_add_ans" onclick="add_ans_home('4'); return false;">+ добавить</a></br>
                            <span id="id_ans_1">
                                <input class="input-simple" type="text" id="person-nick" name="ans[1]" style="width: 50%" value="<?php echo $lesson->name ?>"/> -- <a href="#" onclick="formhomeproblemdeleteblock(1);
                                        return false;">удл.</a><Br><Br>
                            </span>
                            <span id="id_ans_2">
                                <input class="input-simple" type="text" id="person-nick" name="ans[2]" style="width: 50%" value="<?php echo $lesson->name ?>"/> -- <a href="#" onclick="formhomeproblemdeleteblock(2);
                                        return false;">удл.</a><Br><Br>
                            </span>
                            <span id="id_ans_3">
                                <input class="input-simple" type="text" id="person-nick" name="ans[3]" style="width: 50%" value="<?php echo $lesson->name ?>"/> -- <a href="#" onclick="formhomeproblemdeleteblock(3);
                                        return false;">удл.</a><Br><Br>
                            </span>
<?php endif; ?>                        
                    </li>
                    <div class="error-edit-user">Заполните корректно выделеные поля.</div>
                    <div class="success-edit-user">Данные сохранены</div>  
                    <?php if (isset($edit) && $edit == 1): ?>
                        <button type="submit" class="form-personal-submit" onclick="formhomeproblemeditsubmit(<?php echo $problem->id ?>)"  id="form-user-edit-submit">Сохранить</button>
                    <?php else: ?>
                        <button type="submit" class="form-personal-submit" onclick="formhomeproblemeditsubmitadd()"  id="form-user-edit-submit">Создать</button>
<?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>
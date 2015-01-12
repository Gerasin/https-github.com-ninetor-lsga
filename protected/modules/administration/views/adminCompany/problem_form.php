<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Добавление/Редактирование вопросов на главной странице
                </h1>
                <ol class="breadcrumb">
                    <li><i class="fa"></i><a href="/administration">Главная</a></li>
                    <li><i class="fa"></i><a href="/administration/classroom">Классы</a></li>
                    <li><i class="fa"></i><a href="/administration/problem/<?= $problem->id_class?>">Вопросы</a></li>                                  
                    <li><i class="fa"></i>Редактирование</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form enctype="multipart/form-data" action="/administration/problem/add" method="post" id="form_problem_edit" onsubmit="return false;">
                    <li class="list-group-item">Класс: 
                        <select class="form-control" name="id_class" id="lesson[id_class]">
                            <?php foreach ($classroom as $item): ?>
                                <option value="<?= $item->id ?>" <?php if ($problem->id_class == $item->id): ?>selected="selected"<?php endif; ?>><?php echo $item->name ?></option>                          
                            <?php endforeach; ?>
                        </select>
                    </li>
                    <li class="list-group-item">Вопрос: <textarea style="height: 100px" class="form-control" name="problem[text]"><?php echo htmlspecialchars($problem->text) ?></textarea></li>
                    <li class="list-group-item">Комментарий к вопросу: <textarea style="height: 100px" class="form-control" name="problem[comment]"><?php echo htmlspecialchars($problem->comment) ?></textarea></li>
                    <li class="list-group-item" id="add_ans_block">Ответы: 
                       <a href="#" id="lin_add_ans" onclick="add_ans('<?= count($ans) + 1 ?>'); return false;">+ добавить</a></br>
                               <?php $countAns = 1;
                               foreach ($ans as $value):
                                   ?>
                                <span id="id_ans_<?= $countAns ?>">
                                    <input class="input-simple" type="text" id="person-nick" name="ans[<?= $countAns ?>]" style="width: 50%" value="<?php echo $value->text ?>"/> <input type="radio" <?php if ($value->id == $problem->status_ans): ?>checked<?php endif; ?> name="problem[status]" value="<?= $countAns ?>"> Верный  -- <a href="#" onclick="formproblemdeleteblock(<?= $countAns ?>, <?php echo $value->id ?>); return false;">удл.</a><Br><Br>
                                </span>
                                <?php $countAns++ ?>
                            <?php endforeach; ?>                      
                    </li>
                    <div class="error-edit-user">Заполните корректно выделеные поля.</div>
                    <div class="success-edit-user">Данные сохранены</div>  
                     <?php if (isset($edit) && $edit == 1): ?>
                        <button type="submit" class="form-personal-submit" onclick="formproblemeditsubmit(<?php echo $problem->id ?>)"  id="form-user-edit-submit">Сохранить</button>
                    <?php else: ?>
                        <button type="submit" class="form-personal-submit" onclick="formproblemeditsubmitadd()"  id="form-user-edit-submit">Создать</button>
<?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>
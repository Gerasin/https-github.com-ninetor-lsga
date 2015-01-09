<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Добавление/Редактирование данных об уроке
                </h1>
                <ol class="breadcrumb">
                    <li><i class="fa"></i><a href="/administration">Главная</a></li>
                    <li><i class="fa"></i><a href="/administration/lesson">Уроки</a></li>
                    <li><i class="fa"></i>Добавление/Редактирование</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form enctype="multipart/form-data" action="/administration/lesson/add" method="post" id="form_lesson_edit" onsubmit="return false;">                       
                    <li class="list-group-item">Название: </br><input class="input-simple" type="text" id="person-nick" name="lesson[name]" value="<?php echo $lesson->name ?>"/></li>
                    <li class="list-group-item">Полное содержание: <textarea style="height: 200px" class="form-control" name="lesson[description]"><?php echo htmlspecialchars($lesson->description) ?></textarea></li>
                    <li class="list-group-item">Класс: 
                        <select class="form-control" name="id_class" id="lesson[id_class]">
                            <?php foreach ($classroom as $item): ?>
                                <option value="<?= $item->id ?>" <?php if ($lesson->id_class == $item->id): ?>selected="selected"<?php endif; ?>><?php echo $item->name ?></option>                          
                            <?php endforeach; ?>
                        </select>
                    </li>
                    <li class="list-group-item">Статус: 
                        <select class="form-control" name="active" id="active">
                            <option value="1" <?php if ($lesson->active == 1): ?>selected="selected"<?php endif; ?>>Ативен</option>
                            <option value="0" <?php if ($lesson->active != 1): ?>selected="selected"<?php endif; ?>>Не активен</option>                            
                        </select>
                    </li> 
                    <b>
                        <li class="list-group-item">Дата создания: 
                            <?php if (isset($lesson->created)): ?>
                                <?= Yii::app()->dateFormatter->format('d MMMM yyyy', $lesson->created); ?>
                            <?php else: ?>
                                <?= date('Y-m-d', time()) ?>
                            <?php endif; ?>
                        </li> 
                    </b>
                    <div class="error-edit-user">Заполните корректно выделеные поля.</div>
                    <div class="success-edit-user">Данные сохранены</div>  
                    <?php if (isset($edit) && $edit == 1): ?>
                        <button type="submit" class="form-personal-submit" onclick="formlessoneditsubmit(<?php echo $lesson->id ?>)"  id="form-user-edit-submit">Сохранить</button>
                    <?php else: ?>
                        <button type="submit" class="form-personal-submit" onclick="formlessoneditsubmitadd()"  id="form-user-edit-submit">Создать</button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>
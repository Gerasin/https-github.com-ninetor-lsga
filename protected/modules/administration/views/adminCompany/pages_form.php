<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Добавление/Редактирование данных о странице
                </h1>
                <ol class="breadcrumb">
                    <li><i class="fa"></i><a href="/administration">Главная</a></li>
                    <li><i class="fa"></i><a href="/administration/pages">Страницы</a></li>
                    <li><i class="fa"></i>Добавление/Редактирование</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form enctype="multipart/form-data" action="/administration/pages/add" method="post" id="form_pages_edit" onsubmit="return false;">       
                    <li class="list-group-item">Категория: 
                        <select class="form-control" name="id_category" id="pages[id_categorys]" onchange="newProrertisPage(this.value);">
                            <?php foreach ($categorys as $item): ?>
                                <option value="<?= $item->id ?>" <?php if ($pages->id_category == $item->id): ?>selected="selected"<?php endif; ?>><?php echo $item->name ?></option>                          
                            <?php endforeach; ?>
                        </select>
                    </li>
                    <li class="list-group-item">Название: </br><input class="input-simple" type="text" style="width: 100%" id="person-nick" name="pages[name]" value="<?php echo $pages->name ?>"/></li>
                    <li class="list-group-item">Предварительное содержание: <textarea class="form-control" name="pages[prev_text]"><?php echo $pages->prev_text ?></textarea></li>
                    <li class="list-group-item">Полное содержание: <textarea class="form-control" name="pages[full_text]" style="height: 150px"><?php echo $pages->full_text ?></textarea></li>
                    <li class="list-group-item">Изображение (превью): 
                        <input id="fileToUpload" type="file" size="45" name="fileToUpload" class="input">
                        <?php if (!empty($pages->img)): ?>
                        </br>
                        <img src="/upload/images/pages/_temp/<?php echo $pages->img ?>" />
                        <?php endif; ?>
                    </li>
                    <li class="list-group-item">Дата публикации: </br><input class="input-simple" type="text" id="person-nick" name="updatePage" value="<?php if (isset($edit) && $edit == 1): ?><?php echo date('Y-m-d', $pages->update) ?><?php else: ?><?php echo date('Y-m-d', time()) ?><?php endif; ?>"/></li>
                    <li class="list-group-item">Статус: 
                        <select class="form-control" name="active" id="education[active]">
                            <option value="1" <?php if ($pages->active == 1): ?>selected="selected"<?php endif; ?>>Ативен</option>
                            <option value="0" <?php if ($pages->active != 1): ?>selected="selected"<?php endif; ?>>Не активен</option>                            
                        </select>
                    </li>
                   
                    <b>
                        <li class="list-group-item">Дата создания: 
                            <?php if (isset($pages->created)): ?>
                                <?= Yii::app()->dateFormatter->format('d MMMM yyyy', $pages->created); ?>
                            <?php else: ?>
                                <?= date('Y-m-d', time()) ?>
                            <?php endif; ?>
                        </li>
                    </b>
                    <div class="error-edit-user">Заполните корректно выделеные поля. Формат загружаемого файла должен быть JPG, PNG или GIF</div>
                    <div class="success-edit-user">Данные сохранены</div>  
                    <?php if (isset($edit) && $edit == 1): ?>
                        <button type="submit" class="form-personal-submit" onclick="formpageseditsubmit(<?php echo $pages->id ?>)"  id="form-user-edit-submit">Сохранить</button>
                    <?php else: ?>
                        <button type="submit" class="form-personal-submit" onclick="formpageseditsubmitadd()"  id="form-user-edit-submit">Создать</button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>
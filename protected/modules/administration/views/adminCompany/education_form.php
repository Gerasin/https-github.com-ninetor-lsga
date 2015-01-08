<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Добавление/Редактирование данных о школе
                </h1>
                <ol class="breadcrumb">
                    <li><i class="fa"></i><a href="/administration">Главная</a></li>
                    <li><i class="fa"></i><a href="/administration/education">Школа(образование)</a></li>
                    <li><i class="fa"></i>Добавление/Редактирование</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <form enctype="multipart/form-data" action="/administration/education/add" method="post" id="form_education_edit" onsubmit="return false;">                       
                    <li class="list-group-item">Название: </br><input class="input-simple" type="text" id="person-nick" name="education[name]" value="<?php echo $education->name ?>"/></li>
                    <li class="list-group-item">Описание: <textarea class="form-control" name="education[description]"><?php echo $education->description ?></textarea></li>
                    <li class="list-group-item">Изображение: 
                        <input id="fileToUpload" type="file" size="45" name="fileToUpload" class="input">
                        <?php if (!empty($education->img)): ?>
                            <img src="/upload/images/education/<?php echo $education->img ?>" style="height: 100px; margin-top: 10px" />
                        <?php endif; ?>
                    </li>
                    <li class="list-group-item">Статус: 
                        <select class="form-control" name="active" id="education[active]">
                            <option value="1" <?php if ($education->active==1):?>selected="selected"<?php endif;?>>Ативен</option>
                            <option value="0" <?php if ($education->active!=1):?>selected="selected"<?php endif;?>>Не активен</option>                            
                        </select>
                    </li> 
                    <b><li class="list-group-item">Дата созданиЯ: 
                            <?php if (isset($education->created)):?>
                            <?= Yii::app()->dateFormatter->format('d MMMM yyyy', $education->created); ?>
                            <?php else:?>
                            <?= date('Y-m-d', time()) ?>
                            <?php endif;?>
                        </li></b>
                    <div class="error-edit-user">Заполните корректно выделеные поля. Формат загружаемого файла должен быть JPG, PNG или GIF</div>
                    <div class="success-edit-user">Данные сохранены</div>  
                    <?php if (isset($edit) && $edit == 1): ?>
                        <button type="submit" class="form-personal-submit" onclick="formeducationeditsubmit(<?php echo $education->id ?>)"  id="form-user-edit-submit">Сохранить</button>
                    <?php else: ?>
                        <button type="submit" class="form-personal-submit" onclick="formeducationeditsubmitadd()"  id="form-user-edit-submit">Создать</button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>
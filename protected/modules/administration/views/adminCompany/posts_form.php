<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <?php if (isset($edit) && $edit == 1) echo 'Редактирование поста в блоке';
                    else 'Добавление поста'; ?>
                </h1>
                <ol class="breadcrumb">
                    <li><i class="fa"></i><a href="/administration">Главная</a></li>
                    <li>
                        <i class="fa"></i><a href="/administration/mainBlocks">Блоки на главной странице</a>
                    </li>
                    <?php if (isset($edit) && $edit == 1): ?>
                        <li><i class="fa"></i>Редактирование поста</li>
                    <?php else: ?>
                    <li><i class="fa"></i>Добавление поста</li>
                    <?php endif; ?>
                </ol>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <form enctype="multipart/form-data" method="post" id="form_posts_edit" onsubmit="return false;">
                    <li class="list-group-item">URL: </br><input class="input-simple" type="text" style="width: 100%" id="post_url" name="url"  value="<?php if (isset($edit)) echo $post->url?>"/></li>
                    <li class="list-group-item">Текст: </br><input class="input-simple" type="text" style="width: 100%" id="post_name" name="name"  value="<?php if (isset($edit))  echo $post->name?>"/></li>
                    <li class="list-group-item">Изображение:
                        <input id="fileToUploadmain" type="file" size="45" name="fileToUpload" class="input">
                        <?php if (isset($edit)): ?>
                            <img src="/upload/images/main/<?php echo $post->photo ?>" style="height: 100px; margin-top: 10px" />
                        <?php endif; ?>
                    </li>
                    <?php if ((isset($post->block->type) && $post->block->type == 4) || (isset($add_images) && ($add_images == true))): ?>
                    <li class="list-group-item">Дополнительные изображения:<br>
                        <?php if (isset($post->additional_photos))
                        {
                        $dop_Add = unserialize($post->additional_photos);
                        echo '<img src="/upload/images/main/'.$dop_Add[0].'" style="max-width: 100px; max-height: 100px;"><input id="fileToUploadAdd1" type="file" size="45" name="fileToUploadAddone" class="input"><br>';
                        echo '<img src="/upload/images/main/'.$dop_Add[1].'" style="max-width: 100px; max-height: 100px;"><input id="fileToUploadAdd2" type="file" size="45" name="fileToUploadAddtwo" class="input"><br>';
                        echo '<img src="/upload/images/main/'.$dop_Add[2].'" style="max-width: 100px; max-height: 100px;"><input id="fileToUploadAdd3" type="file" size="45" name="fileToUploadAddthree" class="input"><br>';
                        echo '<img src="/upload/images/main/'.$dop_Add[3].'" style="max-width: 100px; max-height: 100px;"><input id="fileToUploadAdd4" type="file" size="45" name="fileToUploadAddfour" class="input"><br>';
                        echo '<img src="/upload/images/main/'.$dop_Add[4].'" style="max-width: 100px; max-height: 100px;"><input id="fileToUploadAdd5" type="file" size="45" name="fileToUploadAddfive" class="input"><br>';
                        }
                        else
                        {
                        echo '<input id="fileToUploadAdd1" type="file" size="45" name="fileToUploadAddone" class="input">';
                        echo '<input id="fileToUploadAdd2" type="file" size="45" name="fileToUploadAddtwo" class="input">';
                        echo '<input id="fileToUploadAdd3" type="file" size="45" name="fileToUploadAddthree" class="input">';
                        echo '<input id="fileToUploadAdd4" type="file" size="45" name="fileToUploadAddfour" class="input">';
                        echo '<input id="fileToUploadAdd5" type="file" size="45" name="fileToUploadAddfive" class="input">';
                        }
                        endif; ?>
                    </li>
                    <div class="error-edit-user">Заполните корректно выделеные поля. Формат загружаемого файла должен быть JPG, PNG или GIF</div>
                    <div class="success-edit-user">Данные сохранены</div>
                    <?php if (isset($edit) && $edit == 1): ?>
                        <button type="submit" class="form-personal-submit" onclick="formpostseditsubmit(<?= $post->id ?>)"  id="form-user-edit-submit">Сохранить</button>
                    <?php else: ?>
                        <button type="submit" class="form-personal-submit" onclick="formpostsaddsubmit(<?= Yii::app()->request->getParam('id') ?>)"  id="form-user-edit-submit">Создать</button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>
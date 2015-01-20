<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Добавление/Редактирование свойства товара
                </h1>
                <ol class="breadcrumb">
                    <li><i class="fa"></i><a href="/administration">Главная</a></li>
                    <li>
                        <i class="fa"></i><a href="/administration/shopGoods">Товары</a>
                    </li>
                    <li><i class="fa"></i>Добавление/Редактирование свойства товара</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <form enctype="multipart/form-data" method="post" id="form_property_edit" onsubmit="return false;">
                    <li class="list-group-item">Заголовок: </br><input class="input-simple" type="text" id="title_property" name="title" value="<?php if (isset($property)) echo $property->title ?>"/></li>
                    <li class="list-group-item">Содержание: <textarea class="form-control"  id="text_property"  name="text"><?php if (isset($property)) echo $property->text ?></textarea></li>
                    <div class="error-edit-user">Заполните корректно выделеные поля. Формат загружаемого файла должен быть JPG, PNG или GIF</div>
                    <div class="success-edit-user">Данные сохранены</div>
                    <?php if (isset($property)): ?>
                        <button type="submit" class="form-personal-submit" onclick="formshoppropertyedit(<?= Yii::app()->request->getParam('id')?>, <?= Yii::app()->request->getParam('property')?>)"  id="form-user-edit-submit">Сохранить</button>
                    <?php else: ?>
                        <button type="submit" class="form-personal-submit" onclick="formshoppropertyadd(<?= Yii::app()->request->getParam('id')?>)"  id="form-user-edit-submit">Создать</button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>
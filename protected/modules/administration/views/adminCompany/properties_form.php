<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Добавление/Редактирование свойствa
                </h1>
                <ol class="breadcrumb">
                    <li><i class="fa"></i><a href="/administration">Главная</a></li>
                    <li><i class="fa"></i><a href="/administration/properties">Свойства</a></li>
                    <li><i class="fa"></i>Добавление/Редактирование</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form enctype="multipart/form-data" action="/administration/properties/add" method="post" id="form_properties_edit" onsubmit="return false;"> 
                    <?php if (count($categorys) > 0): ?>
                    <li class="list-group-item" id="idCategoryBlock">Категория: 
                            <select class="form-control" name="id_category" id="properties[id_category]">
                                <?php foreach ($categorys as $item): ?>
                                    <option value="<?= $item->id ?>" <?php if ($properties->id_category == $item->id): ?>selected="selected"<?php endif; ?>><?php echo $item->name ?></option>                          
                                <?php endforeach; ?>
                            </select>
                        </li>
                    <?php endif; ?>
                    <?php if (count($propert) > 0): ?>
                        <li class="list-group-item">Родительский класс: 
                            <select class="form-control" name="id_properties" id="properties[id_properties]" onchange="blockCategoryView(this.value)">
                                <option value="0" <?php if ($properties->id_properties == 0): ?>selected="selected"<?php endif; ?>>--</option> 
                                <?php foreach ($propert as $item): ?>
                                    <option value="<?= $item->id ?>" <?php if ($properties->id_properties == $item->id): ?>selected="selected"<?php endif; ?>><?php echo $item->text ?></option>                          
                                <?php endforeach; ?>
                            </select>
                        </li>
                    <?php endif; ?>
                    <li class="list-group-item">Название: </br><input style="width: 100%" class="input-simple" type="text" name="properties[text]" value="<?php echo $properties->text ?>"/></li>
                    <b>
                        <li class="list-group-item">Дата создания: 
                            <?php if (isset($properties->created)): ?>
                                <?= Yii::app()->dateFormatter->format('d MMMM yyyy', $category->created); ?>
                            <?php else: ?>
                                <?= date('Y-m-d', time()) ?>
                            <?php endif; ?>
                        </li> 
                    </b>
                    <div class="error-edit-user">Заполните корректно выделеные поля.</div>
                    <div class="success-edit-user">Данные сохранены</div>  
                    <?php if (isset($edit) && $edit == 1): ?>
                        <button type="submit" class="form-personal-submit" onclick="formpropertieseditsubmit(<?php echo $properties->id ?>)"  id="form-user-edit-submit">Сохранить</button>
                    <?php else: ?>
                        <button type="submit" class="form-personal-submit" onclick="formpropertieseditsubmitadd()"  id="form-user-edit-submit">Создать</button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>
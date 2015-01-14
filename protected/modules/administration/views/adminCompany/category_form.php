<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Добавление/Редактирование данных о категории
                </h1>
                <ol class="breadcrumb">
                    <li><i class="fa"></i><a href="/administration">Главная</a></li>
                    <li><i class="fa"></i><a href="/administration/category">Категории</a></li>
                    <li><i class="fa"></i>Добавление/Редактирование</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form enctype="multipart/form-data" action="/administration/category/add" method="post" id="form_category_edit" onsubmit="return false;">                       
                    <li class="list-group-item">Название: </br><input style="width: 100%" class="input-simple" type="text" id="person-nick" name="category[name]" value="<?php echo $category->name ?>"/></li>
                    <li class="list-group-item">Описание: <textarea style="height: 100px" class="form-control" name="category[description]"><?php echo $category->description ?></textarea></li>
                    <li class="list-group-item">Статус: 
                        <select class="form-control" name="active" id="active">
                            <option value="1" <?php if ($category->active == 1): ?>selected="selected"<?php endif; ?>>Ативен</option>
                            <option value="0" <?php if ($category->active != 1): ?>selected="selected"<?php endif; ?>>Не активен</option>                            
                        </select>

                        <b>
                            <li class="list-group-item">Дата создания: 
                                <?php if (isset($category->created)): ?>
                                    <?= Yii::app()->dateFormatter->format('d MMMM yyyy', $category->created); ?>
                                <?php else: ?>
                                    <?= date('Y-m-d', time()) ?>
                                <?php endif; ?>
                            </li> 
                        </b>
                        <div class="error-edit-user">Заполните корректно выделеные поля.</div>
                        <div class="success-edit-user">Данные сохранены</div>  
                        <?php if (isset($edit) && $edit == 1): ?>
                            <button type="submit" class="form-personal-submit" onclick="formcategoryeditsubmit(<?php echo $category->id ?>)"  id="form-user-edit-submit">Сохранить</button>
                        <?php else: ?>
                            <button type="submit" class="form-personal-submit" onclick="formcategoryeditsubmitadd()"  id="form-user-edit-submit">Создать</button>
                        <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>

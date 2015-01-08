<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Добавление/Редактирование данных о классе
                </h1>
                <ol class="breadcrumb">
                    <li><i class="fa"></i><a href="/administration">Главная</a></li>
                    <li><i class="fa"></i><a href="/administration/classroom">Классы</a></li>
                    <li><i class="fa"></i>Добавление/Редактирование</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <form enctype="multipart/form-data" action="/administration/classroom/add" method="post" id="form_classroom_edit" onsubmit="return false;">                       
                    <li class="list-group-item">Название: </br><input class="input-simple" type="text" id="person-nick" name="classroom[name]" value="<?php echo $classroom->name ?>"/></li>
                    <li class="list-group-item">Школа(образование): 
                        <select class="form-control" name="id_education" id="classroom[id_education]">
                            <?php foreach ($education as $item): ?>
                                <option value="<?= $item->id ?>" <?php if ($classroom->id_education==$item->id):?>selected="selected"<?php endif;?>><?php echo $item->name ?></option>                          
                            <?php endforeach; ?>
                        </select>
                    </li>
                    <li class="list-group-item">Статус: 
                        <select class="form-control" name="active" id="active">
                            <option value="1" <?php if ($classroom->active==1):?>selected="selected"<?php endif;?>>Ативен</option>
                            <option value="0" <?php if ($classroom->active!=1):?>selected="selected"<?php endif;?>>Не активен</option>                            
                        </select>
                    </li> 
                    <b>
                        <li class="list-group-item">Дата создания: 
                            <?php if (isset($education->created)):?>
                            <?= Yii::app()->dateFormatter->format('d MMMM yyyy', $classroom->created); ?>
                            <?php else:?>
                            <?= date('Y-m-d', time()) ?>
                            <?php endif;?>
                        </li> 
                    </b>
                    <div class="error-edit-user">Заполните корректно выделеные поля.</div>
                    <div class="success-edit-user">Данные сохранены</div>  
                    <?php if (isset($edit) && $edit == 1): ?>
                        <button type="submit" class="form-personal-submit" onclick="formclassroomeditsubmit(<?php echo $classroom->id ?>)"  id="form-user-edit-submit">Сохранить</button>
                    <?php else: ?>
                        <button type="submit" class="form-personal-submit" onclick="formclassroomeditsubmitadd()"  id="form-user-edit-submit">Создать</button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>
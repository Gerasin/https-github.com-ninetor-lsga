<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Добавление/Редактирование данных о странице
                </h1>
                <ol class="breadcrumb">
                    <li><i class="fa"></i><a href="/administration">Главная</a></li>
                    <li><i class="fa"></i><a href="/administration/pagesText">Страницы</a></li>
                    <li><i class="fa"></i>Добавление/Редактирование</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form enctype="multipart/form-data" action="/administration/pagesText/add" method="post" id="form_pages_edit" onsubmit="return false;">       
                    <li class="list-group-item">Название: </br><input class="input-simple" type="text" style="width: 100%" id="person-nick" name="pages[name]" value="<?php echo $pages->name ?>"/></li>
                    <li class="list-group-item">Полное содержание: <textarea class="form-control" name="pages[full_text]" style="height: 150px"><?php echo $pages->full_text ?></textarea></li>
                    <b>
                        <li class="list-group-item">Дата создания: 
                            <?php if (isset($pages->created)): ?>
                                <?= Yii::app()->dateFormatter->format('d MMMM yyyy', $pages->created); ?>
                            <?php else: ?>
                                <?= date('Y-m-d', time()) ?>
                            <?php endif; ?>
                        </li>
                        <li class="list-group-item">Дата обновления: 
                            <?php if (isset($pages->update)): ?>
                                <?= Yii::app()->dateFormatter->format('d MMMM yyyy', $pages->update); ?>
                            <?php else: ?>
                                <?= date('Y-m-d', time()) ?>
                            <?php endif; ?>
                        </li>
                    </b>
                    <div class="error-edit-user">Заполните корректно выделеные поля</div>
                    <div class="success-edit-user">Данные сохранены</div>  
                    <?php if (isset($edit) && $edit == 1): ?>
                        <button type="submit" class="form-personal-submit" onclick="formpagestexteditsubmit(<?php echo $pages->id ?>)"  id="form-user-edit-submit">Сохранить</button>
                    <?php else: ?>
                        <button type="submit" class="form-personal-submit" onclick="formpagesediteditsubmitadd()"  id="form-user-edit-submit">Создать</button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>
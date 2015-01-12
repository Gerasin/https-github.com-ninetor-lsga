<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Редактирование категории товаров
                </h1>
                <ol class="breadcrumb">
                    <li><i class="fa"></i><a href="/administration">Главная</a></li>
                    <li>
                        <i class="fa"></i><a href="/administration/shopCategory">Категории товаров</a>
                    </li>
                    <li><i class="fa"></i>Редактирование категории</li>
                </ol>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <form enctype="multipart/form-data" method="post" id="form_shop_category_edit" onsubmit="return false;">
                    <li class="list-group-item">Название: </br><input class="input-simple" type="text" style="width: 100%" id="name" name="name" value="<?php echo $category->name?>"/></li>

                    <li class="list-group-item">
                        <?php
                        echo' <p>Дочерние категории </p>';
                        echo '<a href="/administration/shopCategory/add/'.$category->id.'" class="btn btn-xs btn-primary">Добавить</a> ';
                        if (count($child_categories)){?>
                        <div class="table-responsive">
                                <table id="table-shop-categories" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Категория</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($child_categories as $item): ?>
                                        <tr id="<?= $item->name; ?>">
                                            <td>
                                                <?= $item->name; ?>
                                            </td>
                                            <td>
                                                <a href="/administration/shopCategory/edit/<?= $item->id; ?>">ред.</a>
                                            </td>
                                            <td>
                                                <a href="/administration/shopCategory/delete/<?= $item->id; ?>?category=<?=$category->id ?>">удл.</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                        </div>
                        <?php } ?>
                    </li>
                    <div class="error-edit-user">Заполните корректно выделеные поля.</div>
                    <div class="success-edit-user">Данные сохранены</div>
                    <button type="submit" class="form-personal-submit" onclick="formshopcategoryeditsubmit(<?=$category->id ?>)"  id="form_shop_category_edit-submit">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
</div>
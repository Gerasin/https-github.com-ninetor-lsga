<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Добавление категории товаров
                </h1>
                <ol class="breadcrumb">
                    <li><i class="fa"></i><a href="/administration">Главная</a></li>
                    <li>
                        <i class="fa"></i><a href="/administration/shopCategory">Категории товаров</a>
                    </li>
                    <li><i class="fa"></i>Добавление</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <form enctype="multipart/form-data" action="/administration/menu/add" method="post" id="form_shop_category_add" onsubmit="return false;">
                    <li class="list-group-item">Название: </br><input class="input-simple" type="text" style="width: 100%" id="name" name="name" value=""/></li>

                    <div class="error-edit-user">Заполните корректно выделеные поля</div>
                    <div class="success-edit-user">Данные сохранены</div>
                    <button type="submit" class="form-personal-submit" onclick="formshopcategoryadd(<?= $category_id ?>)"  id="form-user-edit-submit">Создать</button>
                </form>
            </div>
        </div>
    </div>
</div>
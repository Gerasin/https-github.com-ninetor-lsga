<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Добавление данных о пункте меню
                </h1>
                <ol class="breadcrumb">
                    <li><i class="fa"></i><a href="/administration">Главная</a></li>
                    <li>
                        <i class="fa"></i><a href="/administration/menu/category">Категориии меню</a>
                    </li>
                    <li><i class="fa"></i>Добавление</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <form enctype="multipart/form-data" action="/administration/menu/add" method="post" id="form_menu_edit" onsubmit="return false;">                       
                    <li class="list-group-item">Название: </br><input class="input-simple" type="text" id="person-nick" style="width: 100%" name="menu[name]" value=""/></li>
                    <li class="list-group-item">Категория: 
                        <select class="form-control" name="id_menu" id="id_menu">
                            <?php foreach ($menu_category as $item): ?>
                                <option value="<?= $item->id ?>" ><?php echo $item->name ?></option>                          
                            <?php endforeach; ?>
                        </select>
                    </li>
                    <li class="list-group-item">URL: </br><input class="input-simple" type="text" id="person-nick" style="width: 100%" name="menu[url]" value=""/></li>
                    <li class="list-group-item">Стиль/Класс: </br><input class="input-simple" type="text" id="person-nick" style="width: 100%" name="menu[class]" value=""/></li>

                    <div class="error-edit-user">Заполните корректно выделеные поля</div>
                    <div class="success-edit-user">Данные сохранены</div>                     
                        <button type="submit" class="form-personal-submit" onclick="formmenueditsubmitadd()"  id="form-user-edit-submit">Создать</button>                   
                </form>
            </div>
        </div>
    </div>
</div>
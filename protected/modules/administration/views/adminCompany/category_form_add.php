<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Добавление данных о категории
                </h1>
                <ol class="breadcrumb">
                    <li><i class="fa"></i><a href="/administration">Главная</a></li>
                    <li><i class="fa"></i><a href="/administration/category">Категории</a></li>
                    <li><i class="fa"></i>Добавление</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form enctype="multipart/form-data" action="/administration/category/add" method="post" id="form_category_edit" onsubmit="return false;">                       
                    <li class="list-group-item">Название: </br><input style="width: 100%" class="input-simple" type="text" id="person-nick" name="category[name]" value=""/></li>
                    <li class="list-group-item">Описание: <textarea style="height: 100px" class="form-control" name="category[description]"></textarea></li>
                    <li class="list-group-item">Статус: 
                        <select class="form-control" name="active" id="active">
                            <option value="1" >Ативен</option>
                            <option value="0">Не активен</option>                            
                        </select>
                        <b>
                            <li class="list-group-item">Дата создания: 
                                <?= date('Y-m-d', time()) ?>
                            </li> 
                        </b>
                        <div class="error-edit-user">Заполните корректно выделеные поля.</div>
                        <div class="success-edit-user">Данные сохранены</div>  
                        <button type="submit" class="form-personal-submit" onclick="formcategoryeditsubmitadd()"  id="form-user-edit-submit">Создать</button>
                </form>
            </div>
        </div>
    </div>
</div>
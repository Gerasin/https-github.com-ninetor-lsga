<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Добавление данных о странице
                </h1>
                <ol class="breadcrumb">
                    <li><i class="fa"></i><a href="/administration">Главная</a></li>
                    <li><i class="fa"></i><a href="/administration/pagesText">Страницы</a></li>
                    <li><i class="fa"></i>Добавление</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form enctype="multipart/form-data" action="/administration/pagesText/add" method="post" id="form_pages_edit" onsubmit="return false;">       
                    <li class="list-group-item">Название: </br><input class="input-simple" type="text" style="width: 100%" id="person-nick" name="pages[name]" value=""/></li>
                    <li class="list-group-item">Полное содержание: <textarea class="form-control" name="pages[full_text]" style="height: 150px"></textarea></li>
                    <div class="error-edit-user">Заполните корректно выделеные поля</div>
                    <div class="success-edit-user">Данные сохранены</div>                     
                    <button type="submit" class="form-personal-submit" onclick="formpagesediteditsubmitadd()"  id="form-user-edit-submit">Создать</button>                   
                </form>
            </div>
        </div>
    </div>
</div>
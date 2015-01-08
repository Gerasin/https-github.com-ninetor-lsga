<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Добавление данных о классе
                </h1>
                <ol class="breadcrumb">
                    <li><i class="fa"></i><a href="/administration">Главная</a></li>
                    <li><i class="fa"></i><a href="/administration/classroom">Классы</a></li>
                    <li><i class="fa"></i>Добавление</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <form enctype="multipart/form-data" action="/administration/classroom/add" method="post" id="form_classroom_edit" onsubmit="return false;">                       
                    <li class="list-group-item">Название: </br><input class="input-simple" type="text" id="person-nick" name="classroom[name]" value=""/></li>
                    <li class="list-group-item">Школа(образование): 
                        <select class="form-control" name="id_education" id="classroom[id_education]">
                            <?php foreach ($education as $item): ?>
                                <option value="<?= $item->id ?>" ><?php echo $item->name ?></option>                          
                            <?php endforeach; ?>
                        </select>
                    </li>
                    <li class="list-group-item">Статус: 
                        <select class="form-control" name="active" id="active">
                            <option value="1">Ативен</option>
                            <option value="0">Не активен</option>                            
                        </select>
                    </li> 
                    <b>
                        <li class="list-group-item">Дата создания:                            
                            <?= date('Y-m-d', time()) ?>                           
                        </li> 
                    </b>
                    <div class="error-edit-user">Заполните корректно выделеные поля.</div>
                    <div class="success-edit-user">Данные сохранены</div>                      
                    <button type="submit" class="form-personal-submit" onclick="formclassroomeditsubmitadd()"  id="form-user-edit-submit">Создать</button>                    
                </form>
            </div>
        </div>
    </div>
</div>
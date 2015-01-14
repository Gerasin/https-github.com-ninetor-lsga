<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Редактирование фиксированных блоков
                </h1>
                <ol class="breadcrumb">
                    <li><i class="fa"></i><a href="/administration">Главная</a></li>                   
                    <li><i class="fa"></i>Редактирование блоков</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form enctype="multipart/form-data" action="/administration/settings" method="post" id="form_home_edit">                   
                    <li class="list-group-item">Содержимое шапки страницы школы: <textarea style="height: 200px" class="form-control" name="education_block"><?php echo htmlspecialchars($home[0]->value) ?></textarea></li>
                    <li class="list-group-item">Контакты: координата Y: </br>
                        <input class="input-simple" type="text" id="person-nick" style="width: 100%" name="x" value="<?php echo $home[1]->value ?>"/>
                    </li>
                    <li class="list-group-item">Контакты: координата X: </br>
                        <input class="input-simple" type="text" id="person-nick" style="width: 100%" name="y" value="<?php echo $home[2]->value ?>"/>                        
                        <div class="success-edit-user">Данные сохранены</div>  
                        <button type="submit" class="form-personal-submit" id="form-user-edit-submit">Сохранить</button>
                    </li>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Редактирование блока на главной странице
                </h1>
                <ol class="breadcrumb">
                    <li><i class="fa"></i><a href="/administration">Главная</a></li>                   
                    <li><i class="fa"></i>Редактирование блока на главной странице</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form enctype="multipart/form-data" action="/administration/home/edit" method="post" id="form_home_edit">
                    <input type="hidden" value="<?= $home->id ?>" name="id"/>
                    <li class="list-group-item">Содержимое: <textarea style="height: 200px" class="form-control" name="text"><?php echo htmlspecialchars($home->value) ?></textarea></li>
                    <div class="success-edit-user">Данные сохранены</div>  
                    <button type="submit" class="form-personal-submit" id="form-user-edit-submit">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    О компании
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="/administration">Главная</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-file"></i> О компании
                    </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <h3>Слайдер на главной</h3>
                <p><a href="/administration/company/add" class="btn btn-xs btn-primary">Добавить</a></p>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>№</th>
                                <th>Название</th>
                                <th>Описание</th>
                                <th>Изображение</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($presentations as $presentation): ?>
                                <?php if ($presentation->section == 1): ?>
                                    <tr>
                                        <td><?= $presentation->id ?></td>
                                        <td><?= $presentation->title ?></td>
                                        <td><?= $presentation->description ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?> 
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-6">
                <h3>Информация для заказчика/перевозчика</h3>
                <p><a href="/administration/company/add" class="btn btn-xs btn-primary">Добавить</a></p>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>№</th>
                                <th>Название</th>
                                <th>Описание</th>
                                <th>Изображение</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($presentations as $presentation): ?>
                                <?php if ($presentation->section == 2 || $presentation->section == 3): ?>
                                    <tr>
                                        <td><?= $presentation->id ?></td>
                                        <td><?= $presentation->title ?></td>
                                        <td><?= $presentation->description ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div> 
        </div>
    </div>
</div>

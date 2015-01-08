<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Категории и свойства
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa"></i> <a href="/administration">Главная</a>
                    </li>
                    <li class="active">
                        <i class="fa"></i>Категории и свойства
                    </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <h3>Список свойств</h3>
                <p><a href="/administration/properties/add" class="btn btn-xs btn-primary">Добавить свойство</a>
                    <a href="/administration/category" class="btn btn-xs btn-primary">Категории</a>                    
                <div class="table-responsive">
                    <?php if (count($properties) > 0): ?>
                    <table id="table-3" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Название</th>
                                    <th>Категория</th>
                                    <th>Родительское свойство</th>                                   
                                    
                                    <th></th>
                                </tr>                            
                            </thead>
                            <tbody>
                                <?php foreach ($properties as $item): ?>
                                    <tr id="<?= $item->id; ?>">
                                        <td>
                                            <?= $item->id; ?>
                                        </td>
                                        <td>
                                            <a href="/administration/properties/edit/<?= $item->id; ?>"> <?= $item->text; ?></a>
                                        </td>
                                        <td>
                                            <a href="/administration/category/edit/<?= $item->id_category; ?>" ><?= $category[$item->id_category]; ?></a>
                                        </td>
                                        <td>
                                            <?= $propertiName[$item->id_properties]; ?>
                                        </td>
                                        <td>                                       
                                            <a href="/administration/properties/delete/<?= $item->id; ?>">удл.</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        Нет данных
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
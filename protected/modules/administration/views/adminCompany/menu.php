<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <?= $menu_category->name; ?>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa"></i><a href="/administration">Главная</a>
                    </li>
                    <li>
                        <i class="fa"></i><a href="/administration/menu/category">Категориии меню</a>
                    </li>
                    <li class="active">
                        <i class="fa"></i> <?= $menu_category->name; ?>
                    </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <h3>Список пунктов меню</h3>
                <p><a href="/administration/menu/add" class="btn btn-xs btn-primary">Добавить</a></p>
                <div class="table-responsive">
                    <?php if (count($menu) > 0): ?>
                        <table id="table-7" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Название</th>
                                    <th>URL</th>
                                    <th>Стиль/класс</th>                                
                                    <th></th>
                                    <th></th>
                                </tr>                            
                            </thead>
                            <tbody>
                                <?php foreach ($menu as $item): ?>
                                    <tr id="<?= $item->id; ?>">
                                        <td>
                                            <?= $item->id; ?>
                                        </td>
                                        <td>
                                            <a href="/administration/menu/edit/<?= $item->id; ?>"> <?= $item->name; ?></a>
                                        </td>
                                        <td>
                                            <?= $item->url; ?>
                                        </td>
                                        <td>
                                            <?= $item->class; ?>
                                        </td>                                    
                                        <td>                                       
                                            <a href="/administration/menu/edit/<?= $item->id; ?>">ред.</a>
                                        </td>
                                        <td>                                       
                                            <a href="/administration/menu/delete/<?= $item->id; ?>">удл.</a>
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
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Категории товаров в магазине
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa"></i>  <a href="/administration">Главная</a>
                    </li>
                    <li class="active">
                        <i class="fa"></i>   Категории товаров в магазине
                    </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h3>Категории</h3>
                <p><a href="/administration/shopCategory/add" class="btn btn-xs btn-primary">Добавить</a></p>
                <div class="table-responsive">
                    <?php if (count($categories) > 0): ?>
                        <table id="table-shop-categories" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Категория</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($categories as $item): ?>
                                <tr id="<?= $item->name; ?>">
                                    <td>
                                        <?= $item->name; ?>
                                    </td>
                                    <td>
                                        <a href="/administration/shopCategory/edit/<?= $item->id; ?>">ред.</a>
                                    </td>
                                    <td>
                                        <a href="/administration/shopCategory/delete/<?= $item->id; ?>">удл.</a>
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

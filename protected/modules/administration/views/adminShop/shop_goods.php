<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Товары в магазине
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa"></i>  <a href="/administration">Главная</a>
                    </li>
                    <li class="active">
                        <i class="fa"></i>   Товары в магазине
                    </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h3>Товары</h3>
                <p><a href="/administration/shopGoods/add" class="btn btn-xs btn-primary">Добавить</a></p>
                <div class="table-responsive">
                    <?php if (count($goods) > 0): ?>
                        <table id="table-shop-goods" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Название</th>
                                <th>Код товара</th>
                                <th>Категория</th>
                                <th>Кол-во на складе</th>
                                <th>Стоимость, руб.</th>
                                <th>Скидка, %</th>
                                <th>Изображение</th>
                                <th>Создано</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($goods as $item): ?>
                                <tr id="<?= $item->id; ?>">
                                    <td>
                                        <?= $item->name; ?>
                                    </td>
                                     <td>
                                        <?= $item->code; ?>
                                    </td>
                                     <td>
                                        <?= $item->shopCategory->name; ?>
                                    </td>
                                     <td>
                                        <?= $item->warehouse_count; ?>
                                    </td>
                                     <td>
                                        <?= $item->price; ?>
                                    </td>
                                     <td>
                                        <?= $item->discount; ?>
                                    </td>
                                    <td>
                                      <?php if (isset($item->picture)) echo "<img src='/upload/images/tovars/$item->picture' style='max-width: 100px; max-height: 100px'> ";?>
                                    </td>
                                    <td>
                                        <?= $item->created; ?>
                                    </td>

                                    <td>
                                        <a href="/administration/shopGoods/edit/<?= $item->id; ?>">ред.</a>
                                    </td>
                                    <td>
                                        <a href="/administration/shopGoods/delete/<?= $item->id; ?>">удл.</a>
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

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Школа(образование)
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa"></i>  <a href="/administration">Главная</a>
                    </li>
                    <li class="active">
                        <i class="fa"></i>  Школа(образование)
                    </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <h3>Список категорий</h3>
                <div class="table-responsive">
                    <?php if (count($education) > 0): ?>
                        <table id="table-6" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Название</th>
                                    <th>Статус</th>
                                    <th>Дата создания</th>                                
                                    <th></th>
                                    <th></th>
                                </tr>                            
                            </thead>
                            <tbody>
                                <?php foreach ($education as $item): ?>
                                    <tr id="<?= $item->id; ?>">
                                        <td>
                                            <?= $item->id; ?>
                                        </td>
                                        <td>
                                            <a href="/administration/education/edit/<?= $item->id; ?>"> <?= $item->name; ?></a>
                                        </td>
                                        <td>
                                            <?php if ($item->active == 1):; ?>
                                                Ативна
                                            <?php else: ?>
                                                Не активна
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?= date('Y-m-d', $item->created); ?>
                                        </td>                                    
                                        <td>                                       
                                            <a href="/administration/education/edit/<?= $item->id; ?>">ред.</a>
                                        </td>
                                        <td>                                       
                                            <a href="/administration/education/delete/<?= $item->id; ?>">удл.</a>
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

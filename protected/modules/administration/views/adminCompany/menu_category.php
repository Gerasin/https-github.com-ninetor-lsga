<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                   Категории меню
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa"></i>  <a href="/administration">Главная</a>
                    </li>                   
                    <li class="active">
                        <i class="fa"></i>  Категории меню
                    </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-5">
                <h3>Список категорий меню</h3>                
                <div class="table-responsive">
                    <?php if (count($menu) > 0): ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Название</th>                                   
                                </tr>                            
                            </thead>
                            <tbody>
                                <?php foreach ($menu as $item): ?>
                                    <tr>
                                        <td>
                                            <?= $item->id; ?>
                                        </td>
                                        <td>
                                            <a href="/administration/menu/<?= $item->id; ?>"> <?= $item->name; ?></a>
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

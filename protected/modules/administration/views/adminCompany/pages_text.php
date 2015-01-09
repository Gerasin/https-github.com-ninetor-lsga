<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Текстовые страницы
                </h1>
                <ol class="breadcrumb">  
                    <li>
                        <i class="fa"></i>  <a href="/administration">Главная</a>
                    </li>
                    <li class="active">
                        <i class="fa"></i>  Текстовые страницы
                    </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h3>Страницы</h3>
                <p><a href="/administration/pagesText/add" class="btn btn-xs btn-primary">Добавить</a></p>
                <div class="table-responsive">
                    <?php if (count($pages) > 0): ?>                       
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>№</th>                                    
                                    <th>Название</th> 
                                    <th>Дата создания</th>
                                    <th>Дата обновления</th>                                
                                    <th></th>
                                    <th></th>
                                </tr>                            
                            </thead>
                            <tbody>
                                <?php foreach ($pages as $item): ?>
                                    <tr>
                                        <td>
                                            <?= $item->id; ?>
                                        </td>                                       
                                        <td>
                                            <a href="/administration/pagesText/edit/<?= $item->id; ?>"> <?= $item->name; ?></a>
                                        </td>
                                        <td>
                                            <?= date('Y-m-d', $item->created); ?>
                                        </td> 
                                        <td>
                                            <?= date('Y-m-d', $item->update); ?>
                                        </td> 
                                        <td>                                       
                                            <a href="/administration/pagesText/edit/<?= $item->id; ?>">ред.</a>
                                        </td>
                                        <td>                                       
                                            <a href="/administration/pagesText/delete/<?= $item->id; ?>">удл.</a>
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

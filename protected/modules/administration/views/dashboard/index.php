<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Главная страница
                </h1>                
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <p><a href="/administration/homeproblem/add" class="btn btn-xs btn-primary">Добавить опрос</a>                 
                <h3>Список опросов</h3>                
                <div class="table-responsive">
                    <?php if (count($problem) > 0): ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Вопрос</th> 
                                    <th>Статус</th> 
                                    <th>Вариатны ответа/Статистика</th> 
                                    <th></th>
                                    <th></th>
                                </tr>                            
                            </thead>
                            <tbody>
                                <?php foreach ($problem as $item): ?>
                                    <tr>
                                        <td>
                                            <?= $item->id; ?>
                                        </td>
                                        <td>
                                            <a href="/administration/homeproblem/edit/<?= $item->id; ?>"> <?= $item->text; ?></a>
                                        </td>  
                                        <td>    
                                            <?php if ($item->active == 1): ?>
                                                Активен
                                            <?php else: ?>
                                                Не автивен
                                            <?php endif; ?>
                                        </td>
                                        <td>  <?php if ($homeAns[$item->id] != false && count($homeAns[$item->id]) > 0): ?>                                     
                                                <?php foreach ($homeAns[$item->id] as $value): ?>
                                                    <b><?= number_format($value['statistic'], 2, '.', ' ') ?>%</b> -- <?= $value['text'] ?></br>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </td>
                                        <td>                                       
                                            <a href="/administration/homeproblem/edit/<?= $item->id; ?>">ред.</a>
                                        </td>
                                        <td>                                       
                                            <a href="/administration/homeproblem/delete/<?= $item->id; ?>">удл.</a>
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
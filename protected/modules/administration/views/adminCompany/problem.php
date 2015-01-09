<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Вопросы к экзамен по "<?= $classroom->name ?>"
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa"></i> <a href="/administration">Главная</a>
                    </li>
                    <li>
                        <i class="fa"></i> <a href="/administration/classroom">Классы</a>
                    </li>
                    <li class="active">
                        <i class="fa"></i>Вопросы
                    </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <h3>Список вопросов</h3>
                <p><a href="/administration/problem/add/<?= $classId ?>" class="btn btn-xs btn-primary">Добавить</a></p>
                <div class="table-responsive">
                    <?php if (count($problem) > 0): ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Вопрос</th>                                    
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
                                            <a href="/administration/problem/edit/<?= $item->id; ?>"> <?= $item->text; ?></a>
                                        </td>                                        
                                        <td>                                       
                                            <a href="/administration/problem/edit/<?= $item->id; ?>">ред.</a>
                                        </td>
                                        <td>                                       
                                            <a href="/administration/problem/delete/<?= $item->id; ?>">удл.</a>
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
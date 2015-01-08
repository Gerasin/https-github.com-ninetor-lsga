<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Обратная связь
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa"></i> <a href="/administration">Главная</a>
                    </li>
                    <li class="active">
                        <i class="fa"></i>Обратная связь
                    </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <h3>Обратная связь</h3>                
                <div class="table-responsive">
                    <?php if (count($feedback) > 0): ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Пользователь</th>                                    
                                    <th>Сообщение</th>                                    
                                    <th>Дата создания</th> 
                                    <th></th>
                                </tr>                            
                            </thead>
                            <tbody>
                                <?php foreach ($feedback as $item): ?>
                                    <tr>
                                        <td>
                                            <?= $item['id']; ?>
                                        </td>
                                        <td>
                                            <a href="/administration/user/edit/<?= $item['id_user']; ?>"><?= $item['user']; ?></a>
                                        </td>                                        
                                        <td>
                                           <?= $item['message']; ?>
                                        </td> 
                                        <td>
                                            <?= date('Y-m-d', $item['date']); ?>
                                        </td> 
                                        <td>                                       
                                            <a href="/administration/feedback/delete/<?= $item['id']; ?>">удл.</a>
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
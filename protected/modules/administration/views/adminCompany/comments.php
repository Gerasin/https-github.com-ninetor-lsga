<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Комментарии <?= $pages->name ?>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa"></i><a href="/administration">Главная</a>
                    </li>
                    <li class="active">
                        <i class="fa"></i>Комментарии
                    </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h3>Список комментариев</h3>                
                <div class="table-responsive">
                    <?php if (count($comments) > 0 && $comments != false): ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Ответ</th>
                                    <th>Текст</th>
                                    <th>Пользователь</th>
                                    <th>ID страницы</th>
                                    <th>Лайк</th>
                                    <th>Дизлайк</th>
                                    <th>Дата создания</th>                                
                                    <th></th>
                                </tr>                            
                            </thead>
                            <tbody>
                                <?php foreach ($comments as $item): ?>
                                    <tr>
                                        <td>
                                            <?= $item['id']; ?>
                                        </td>
                                        <td>

                                        </td>
                                        <td>
                                            <?= $item['text']; ?>
                                        </td>
                                        <td>
                                            <a href="/administration/user/edit/<?= $item['user_id']; ?>"><?= $item['user_name']; ?></a>
                                        </td>
                                        <td>
                                             <a href="/administration/pages/edit/<?= $item['id_page']; ?>"><?= $item['id_page']; ?></a>
                                        </td>
                                        <td>
                                            + <?= $item['like']; ?>
                                        </td>
                                        <td>
                                            - <?= $item['notlike']; ?>
                                        </td>
                                        <td>
                                            <?= date('Y-m-d', $item['date']); ?>
                                        </td>                                    
                                        <td>                                       
                                            <a href="/administration/comments/delete/<?= $item['id']; ?>">удл.</a>
                                        </td>                                        
                                    </tr>
                                    <?php if ($item['children']): ?>
                                        <?php foreach ($item['children'] as $value): ?>
                                            <tr>
                                                <td>
                                                    <?= $value['id']; ?>
                                                </td>
                                                <td>
                                                    <?= $value['id_parent']; ?>
                                                </td>
                                                <td>
                                                    <?= $value['text']; ?>
                                                </td>
                                                <td>
                                                    <a href="/administration/user/edit/<?= $value['user_id']; ?>"><?= $value['user_name']; ?></a>                                                  
                                                </td>
                                                <td>
                                                     <a href="/administration/pages/edit/<?= $value['id_page']; ?>"><?= $value['id_page']; ?></a>
                                                </td>
                                                <td>
                                                    + <?= $value['like']; ?>
                                                </td>
                                                <td>
                                                    - <?= $value['notlike']; ?>
                                                </td>
                                                <td>
                                                    <?= date('Y-m-d', $value['date']); ?>
                                                </td>                                    
                                                <td>                                       
                                                    <a href="/administration/comments/delete/<?= $value['id']; ?>">удл.</a>
                                                </td>                                        
                                            </tr>                                           
                                        <?php endforeach; ?>
                                    <?php endif; ?>
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
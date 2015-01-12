<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Страницы категории
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa"></i>  <a href="/administration">Главная</a>
                    </li>
                    <li>
                        <i class="fa"></i>  <a href="/administration/category">Категории</a>
                    </li>
                    <li class="active">
                        <i class="fa"></i>  Страницы категории
                    </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h3>Страницы</h3>
                <p><a href="/administration/pages/add" class="btn btn-xs btn-primary">Добавить</a></p>
                <div class="table-responsive">
                    <?php if (count($pages) > 0): ?>                       
                        <table id="table-1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Изображение</th>
                                    <th>Название</th>
                                    <th>Категория</th>
                                    <th>Предварительное содежание</th> 
                                    <th>Кол. коммент.</th>
                                    <th>Дата создания</th>                                
                                    <th></th>
                                    <th></th>
                                </tr>     
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>
                                        <select class="form-control" name="id_category" id="id_category" onchange="document.location.href = '/administration/pages?id_category=' + this.value;">
                                            <option <?php if (empty($_GET['id_category']) || $_GET['id_category'] <= 0): ?>selected<?php endif; ?>value="0">Всё</option>
                                            <?php foreach ($category as $item): ?>
                                                <option value="<?= $item->id ?>" <?php if (!empty($_GET['id_category']) &&$_GET['id_category'] == $item->id): ?>selected<?php endif; ?>><?php echo $item->name ?></option>                          
                                            <?php endforeach; ?>
                                        </select>
                                    </th>
                                    <th></th> 
                                    <th></th>
                                    <th></th>                                
                                    <th></th>
                                    <th></th>
                                </tr>    
                            </thead>
                            <tbody>
                                <?php foreach ($pages as $item): ?>
                                    <tr id="<?= $item->id; ?>">
                                        <td>
                                            <?= $item->id; ?>
                                        </td>
                                        <td>
                                            <?php if (!empty($item->img)): ?>
                                                <img src="/upload/images/pages/_temp/<?php echo $item->img ?>" />
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="/administration/pages/edit/<?= $item->id; ?>"> <?= $item->name; ?></a>
                                        </td>
                                        <td>
                                            <?= $categoryName[$item->id_category]; ?>
                                        </td>
                                        <td>
                                            <?= strip_tags($item->prev_text) ?>
                                        </td>
                                        <td>
                                            <?php if ($comments[$item->id] > 0): ?>
                                                <a href="/administration/comments/<?= $item->id; ?>"><?= $comments[$item->id] ?></a>
                                            <?php else: ?>
                                                <?= $comments[$item->id] ?>
                                            <?php endif; ?>                                            
                                        </td>  
                                        <td>
                                            <?= date('Y-m-d', $item->created); ?>
                                        </td>  
                                        <td>                                       
                                            <a href="/administration/pages/edit/<?= $item->id; ?>">ред.</a>
                                        </td>
                                        <td>                                       
                                            <a href="/administration/pages/delete/<?= $item->id; ?>">удл.</a>
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

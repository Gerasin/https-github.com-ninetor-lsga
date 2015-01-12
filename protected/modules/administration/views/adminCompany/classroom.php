<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Классы
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa"></i> <a href="/administration">Главная</a>
                    </li>
                    <li class="active">
                        <i class="fa"></i>Классы
                    </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <h3>Список категорий классов</h3>
                <p><a href="/administration/classroom/add" class="btn btn-xs btn-primary">Добавить</a></p>
                <div class="table-responsive">
                    <?php if (count($classroom) > 0): ?>
                        <table id="table-5" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Название</th>
                                    <th>Статус</th>
                                    <th>Школа(образование)</th>
                                    <th>Дата создания</th>                                
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>  
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th> <?php if (count($education) > 0): ?>
                                            <select class="form-control" name="id_education" id="id_education" onchange="document.location.href = '/administration/classroom?id_education=' + this.value;">
                                                <option <?php if (empty($_GET['id_education']) || $_GET['id_education'] <= 0): ?>selected<?php endif; ?>value="0">Всё</option>
                                                <?php foreach ($education as $item): ?>
                                                    <option value="<?= $item->id ?>" <?php if (!empty($_GET['id_education'])&&$_GET['id_education'] == $item->id): ?>selected<?php endif; ?>><?php echo $item->name ?></option>                          
                                                <?php endforeach; ?>
                                            </select>
                                        <?php endif; ?>
                                    </th>
                                    <th></th>                                
                                    <th></th>
                                    <th></th>
                                </tr>    
                            </thead>
                            <tbody>
                                <?php foreach ($classroom as $item): ?>
                                    <tr id="<?= $item->id; ?>">
                                        <td>
                                            <?= $item->id; ?>
                                        </td>
                                        <td>
                                            <a href="/administration/classroom/edit/<?= $item->id; ?>"> <?= $item->name; ?></a>
                                        </td>
                                        <td>
                                            <?php if ($item->active == 1):; ?>
                                                Ативна
                                            <?php else: ?>
                                                Не активна
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?= $educationName[$item->id_education]; ?>
                                        </td> 
                                        <td>
                                            <?= date('Y-m-d', $item->created); ?>
                                        </td>                                    
                                        <td>                                       
                                            <a href="/administration/problem/<?= $item->id; ?>">Экзамен по "<?= $item->name; ?>"</a>
                                        </td>
                                        <td>                                       
                                            <a href="/administration/classroom/edit/<?= $item->id; ?>">ред.</a>
                                        </td>
                                        <td>                                       
                                            <a href="/administration/classroom/delete/<?= $item->id; ?>">удл.</a>
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
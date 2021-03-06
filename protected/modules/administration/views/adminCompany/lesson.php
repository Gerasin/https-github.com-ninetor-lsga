<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Уроки
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa"></i> <a href="/administration">Главная</a>
                    </li>
                    <li class="active">
                        <i class="fa"></i>Уроки
                    </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <h3>Список уроков</h3>
                <p><a href="/administration/lesson/add" class="btn btn-xs btn-primary">Добавить</a></p>
                <div class="table-responsive">
                    <?php if (count($lesson) > 0): ?>
                        <table id="table-4" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Название</th>                                    
                                    <th>Класс</th>
                                    <th>Статус</th>
                                    <th>Дата создания</th> 
                                    <th></th>
                                    <th></th>
                                </tr>    
                                <tr>
                                    <th></th>
                                    <th></th>                                    
                                    <th>
                                        <select class="form-control" name="id_classroom" id="id_classroom" onchange="document.location.href = '/administration/lesson?id_classroom=' + this.value;">
                                            <option <?php if (empty($_GET['id_classroom']) || $_GET['id_classroom'] <= 0): ?>selected<?php endif; ?>value="0">Всё</option>
                                            <?php foreach ($classroom as $item): ?>
                                                <option value="<?= $item->id ?>" <?php if (!empty($_GET['id_classroom']) && $_GET['id_classroom'] == $item->id): ?>selected<?php endif; ?>><?php echo $item->name ?></option>                          
                                            <?php endforeach; ?>
                                        </select>
                                    </th>                                   
                                    <th></th> 
                                    <th></th>
                                    <th></th> 
                                    <th></th>
                                </tr>     
                            </thead>
                            <tbody>
                                <?php foreach ($lesson as $item): ?>
                                    <tr id="<?= $item->id; ?>">
                                        <td>
                                            <?= $item->id; ?>
                                        </td>
                                        <td>
                                            <a href="/administration/lesson/edit/<?= $item->id; ?>"> <?= $item->name; ?></a>
                                        </td>                                        
                                        <td>
                                            <?= $classroomName[$item->id_class]; ?>
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
                                            <a href="/administration/lesson/edit/<?= $item->id; ?>">ред.</a>
                                        </td>
                                        <td>                                       
                                            <a href="/administration/lesson/delete/<?= $item->id; ?>">удл.</a>
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
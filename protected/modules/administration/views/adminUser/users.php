<div id="page-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Список пользователей
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="/administration">Главная</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-file"></i> Список пользователей
                    </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>№</th>
                                <th></th>
                                <th>Никнейм</th>
                                <th>Эл. почта</th>
                                <th>Имя/Название</th>
                                <th>Страна</th>
                                <th>Город</th>                                
                                <th>Телефон</th>
                                <th>Тип пользователя</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <? foreach ($users as $user):?>
                            <tr>
                                <td><?= $user->id; ?></td>
                                <td style="width: 34px"> <?php if (!empty($user->img)): ?>
                                    </br>
                                    <img src="/upload/images/users/_temp/<?php echo $user->img ?>" />
                                    <?php endif; ?></td>
                                <td><a href="/administration/user/edit/<?= $user->id ?>"><?= $user->name ?></a></td>
                                <td><?= $user->email ?></td>
                                <td><?= $user->title ?></td>
                                <td><?= $user->country ?></td>
                                <td><?= $user->city ?></td>
                                <td><?= $user->phone ?></td>
                                <td>
                                    <?php if ($user->role == 'administrator'): ?>
                                        Администратор                                           
                                    <?php else: ?>
                                        Пользователь
                                    <?php endif; ?>
                                </td>
                                <td>                                       
                                    <a href="/administration/user/edit/<?= $user->id; ?>">ред.</a>
                                </td>
                                <td>                                       
                                    <a href="/administration/user/delete/<?= $user->id; ?>">удл.</a>
                                </td>
                            </tr>
                            <? endforeach;?>                                      
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
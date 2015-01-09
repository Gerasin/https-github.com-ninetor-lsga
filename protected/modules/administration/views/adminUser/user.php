<div id="page-wrapper">
            <div class="container-fluid">
              
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                          Пользователь: <?= $user->name?>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="/administration">Главная</a>
                            </li>
                            <li>
                                <i class="fa fa-file"></i> <a href="/administration/users">Список пользователей</a>
                            </li>
                        </ol>
                    </div>
                </div>
               
                <div class="row">
                    
                    <div class="col-sm-6">
                        <ul class="list-group">
                            <li class="list-group-item">Имя: <?= $user->name?></li>
                            <li class="list-group-item">Почта: <?= $user->email?></li>
                            <li class="list-group-item">Телефон: <?= $user->phone?></li>
                            <li class="list-group-item">Пол: <?= $user->gender?></li>                            
                            <li class="list-group-item"> Последний раз был на сайте: <?= Yii::app()->dateFormatter->format('d MMMM yyyy', $user->last_time);?></li>
                        </ul>
                    </div>                   
            </div>
        </div>
    </div>
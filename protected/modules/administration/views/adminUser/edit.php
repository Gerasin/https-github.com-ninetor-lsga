<div id="page-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Редактирование данных. Пользователь: <?= $user->name ?>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa"></i>  <a href="/administration">Главная</a>
                    </li>
                    <li>
                        <i class="fa"></i> <a href="/administration/users">Список пользователей</a>
                    </li>
                    <li>
                        <i class="fa"></i>Редактирование данных</a>
                    </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <ul class="list-group">
                    <form id="form_user_edit" onsubmit="return false;">                       
                        <li class="list-group-item">Никнейм: <?php echo $user->name ?></li>
                        <li class="list-group-item">Почта: <input class="input-simple" type="email" id="person-email" name="user[email]" value="<?php echo $user->email ?>" /></li>
                        <li class="list-group-item">Имя/Название: <input class="input-simple" type="text" id="person-name" name="user[title]" value="<?php echo $user->title ?>" /></li>
                        <li class="list-group-item">Фото: 
                            <input id="fileToUpload" type="file" size="45" name="fileToUpload" class="input">
                            <?php if (!empty($user->img)): ?>
                                </br>
                                <img src="/upload/images/users/temp/<?php echo $user->img ?>" />
                            <?php endif; ?>
                        </li>
                        <li class="list-group-item">Дата рождения: <input class="input-simple" type="text" id="person-birth" name="user[bdate]" value="<?php echo $user->bdate ?>" /></li> 
                        <li class="list-group-item">Номер телефона: <input class="input-simple" type="text" id="person-phone" name="user[phone]" value="<?php echo $user->phone ?>" /></li> 
                        <li class="list-group-item">Страна: <input class="input-simple" type="text" id="person-country" name="user[country]" value="<?php echo $user->country ?>" /></li>
                        <li class="list-group-item">Города: <input class="input-simple" type="text" id="person-city" name="user[city]" value="<?php echo $user->city ?>" /></li>
                        <li class="list-group-item">Улица: <input class="input-simple" type="text" id="person-street" name="user[street]" value="<?php echo $user->street ?>" /></li>
                        <li class="list-group-item">Дом: <input class="input-simple" type="text" id="person-house" name="user[house]" value="<?php echo $user->house ?>" /></li>
                        <li class="list-group-item">Квартира: <input class="input-simple" type="text" id="person-floor" name="user[apartment]" value="<?php echo $user->apartment ?>" /></li>
                        <li class="list-group-item">Почтовый индекс: <input class="input-simple" type="text" id="person-index" name="user[postcode]" value="<?php echo $user->postcode ?>" /></li>                       
                        <li class="list-group-item">Новый пароль: <input class="input-simple" type="password" id="person-pass" name="user[password]" value="" /></li>
                        <li class="list-group-item">Повторите новый пароль: <input class="input-simple" type="password" id="person-pass-again" name="user[password_repeat]" value="" /></li>
                        <b>
                            <li class="list-group-item">Дата регистрации: <?= Yii::app()->dateFormatter->format('d MMMM yyyy', $user->created); ?></li>                            
                            <li class="list-group-item" style="display: none">Последний раз на сайте: <?= Yii::app()->dateFormatter->format('d MMMM yyyy', $user->last_time); ?></li>
                        </b>
                        <div class="error-edit-user">Заполните корректно выделеные поля</div>
                        <div class="success-edit-user">Данные сохранены</div>                        
                        <button type="submit" class="form-personal-submit" onclick="formusereditsubmit(<?php echo $user->id ?>)" id="form-user-edit-submit">Сохранить</button>                        
                    </form>
                </ul>
            </div>                   
        </div>
    </div>
</div>
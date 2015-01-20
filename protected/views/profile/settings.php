<?php
$this->pageTitle = "Личные данные";
?>
<script type="text/javascript" src="js/profile.js"></script>

<ul class="breadcrumbs-bl">
    <li>
        <a class="breadcrumbs-link" href="/">Главная</a>
    </li>
    <li>&rarr;</li>
    <li>
        <a class="breadcrumbs-link">Личный кабинет</a>
    </li>
    <li>&rarr;</li>
    <li>
        Настройки аккаунта
    </li>
</ul> <!-- end breadcrumbs-bl -->

<div class="cabinet-content">

    <div class="cabinet-content-main" style="margin: 20px auto 0; width: 643px;">
        <form id="form_img_settings" onsubmit="return false;">
            <div class="person-data">
                <div class="person-ava">
                    <div class="person-ava-img">
                        <?php if ($user->img): ?>
                            <div class="person-ava-img-inner" style="background: url('/upload/images/users/<?= $user->img ?>')  no-repeat;"></div>
                        <?php else: ?>
                            <div class="person-ava-img-inner" style="background: url(/upload/images/users/avatar.png)"></div>                         
                        <?php endif; ?>                        
                        <span class="person-ava-img-link link-simple">
                            Изменить <img class="ans_loader" src="/images/ajax_loader.gif" />
                            <input type="file" name="fileToUpload" id="fileToUpload"/>
                        </span>
                    </div> <!-- end of person-ava-->

                    <div class="person-ava-content">
                        <label class="person-ava-label" for="person-nick">Мой никнейм</label>
                        <span class="current-nickname"><?php echo $user->name ?></span>


                    </div> <!-- end of person-ava-content -->
                </div>  <!-- end of person-ava -->

                <div class="person-level">
                    <h3 class="person-level-title">
                        Кредитов на счету
                    </h3>
                    <div class="person-level-value">
                        <b><?php echo $user->credit ?></b>
                    </div>                        
                </div> <!-- end of person-level -->
                <div class="error-load-photo"></div>
            </div>
        </form>
        <form class="form-person" id="form_prfile_settings" onsubmit="return false;">
            <div class="form-person-col first">
                <label class="form-person-label" for="person-email">Ваша эл. почта</label>
                <input class="input-simple" type="email" id="person-email" name="user[email]" value="<?php echo $user->email ?>" />
                <span class="error-text"></span>
            </div>

            <div class="form-person-col">
                <label class="form-person-label" for="person-phone">Телефон (с кодом города)</label>
                <input class="input-simple" type="text" name="user[phone]" value="<?php echo $user->phone ?>" placeholder="+7  ( 123 )  123 - 45 - 67"/>
                <span class="error-text"></span>
            </div>

            <div class="form-person-col first">
                <label class="form-person-label" for="person-name">Имя и фамилия / Название фирмы</label>
                <input class="input-simple" type="text" id="person-name" name="user[title]" value="<?php echo $user->title ?>" />
                <span class="error-text"></span>
            </div>

            <div class="form-person-col">
                <label class="form-person-label" for="person-street">Улица</label>
                <input class="input-simple" type="text" id="person-street" name="user[street]" value="<?php echo $user->street ?>" />               
            </div>

            <div class="form-person-col first">
                <label class="form-person-label" for="person-country">Страна</label>
                <input class="input-simple" type="text" id="person-country" name="user[country]" value="<?php echo $user->country ?>" />      
                <span class="error-text"></span>
            </div>

            <div class="form-person-col">
                <div class="form-person-sub-col">
                    <label class="form-person-label" for="person-house">Дом</label>
                    <input class="input-simple" type="text" id="person-house" name="user[house]" value="<?php echo $user->house ?>" />                    
                </div>

                <div class="form-person-sub-col">
                    <label class="form-person-label" for="person-index">Почтовый индекс</label>
                    <input class="input-simple" type="text" id="person-index" name="user[postcode]" value="<?php echo $user->postcode ?>" />                    
                </div>
            </div> <!-- end of form-person-col -->

            <div class="form-person-col first">
                <label class="form-person-label" for="person-city">Город</label>
                <input class="input-simple" type="text" id="person-city" name="user[city]" value="<?php echo $user->city ?>" />
                <span class="error-text"></span>
            </div>

            <div class="form-person-col">
                <div class="form-person-sub-col">
                    <label class="form-person-label" for="person-floor">Квартира</label>
                    <input class="input-simple" type="text" id="person-floor" name="user[apartment]" value="<?php echo $user->apartment ?>" />                   
                </div>

                <div class="form-person-sub-col">
                    <label class="form-person-label" for="person-birth">Дата рождения</label>
                    <input class="input-simple datepicker" type="text" id="person-birth" name="user[bdate]" value="<?php echo $user->bdate ?>" />                   
                </div>
            </div> <!-- end of form-person-col -->

            <div class="form-person-sep"></div>

            <div class="form-person-col first">
                <label class="form-person-label" for="person-pass">Новый пароль</label>
                <input class="input-simple" type="password" id="person-pass" name="user[password]" value="" />
                <span class="error-text"></span>
            </div>

            <div class="form-person-col">
                <label class="form-person-label" for="person-pass-again">Подтвердите новый пароль</label>
                <input class="input-simple" type="password" id="person-pass-again" name="user[password_repeat]" value="" />
                <span class="error-text"></span>
            </div>                   

            <div class="aright">
                <button type="submit" class="form-personal-submit btn-simple" id="form-profile-settings-submit">
                    <span>Сохранить</span>
                </button>
            </div>

        </form> <!-- end of form-person -->

    </div> <!-- end of cabinet-content-main -->
</div> <!-- end of cabinet-content -->
<?php
    $this->pageTitle = "Регистрация";
?>

    <ul class="breadcrumbs-bl">
        <li>
            <a class="breadcrumbs-link" href="/">Главная</a>
        </li>
        <li>&rarr;</li>
        <li>
            Регистрация
        </li>
    </ul> <!-- end breadcrumbs-bl -->

    <form action="#" class="form-register" id="form-registration" onsubmit="return false;">
        <div class="form-register-row">
            <label for="email-register" class="form-register-label">Ваша эл. почта</label>
            <input class="input-simple form-register-input" id="email-register" name="user[email]" type="email"/>
            <span class="error-text"></span>
        </div>

        <div class="form-register-row">
            <label for="phone-register" class="form-register-label">Телефон (с кодом города)</label>
            <input class="input-simple form-register-input" type="text" name="user[phone]" value="" placeholder="+7  ( 123 )  123 - 45 - 67" />  
            <span class="error-text"></span>
        </div>

        <div class="form-register-sep"></div>

        <div class="form-register-row">
            <label for="nick-register" class="form-register-label">Желаемые никнейм</label>
            <div class="form-register-nickname">
                <input class="input-simple form-register-input" id="nick-register" name="user[name]"  type="text" onchange="nick_register(this.value)"/>
                <img src="/images/ajax_loader.gif" id="ajax_loader_nick" />
                <div class="form-register-nickname-text" id="form-register-nickname-text">       
                    <span class="error-text"></span>
                </div>
            </div> <!-- end form-register-nickname -->
        </div> <!-- end of form-register-row -->

        <div class="form-register-row">
            <label for="pass-register" class="form-register-label">Ваш пароль</label>
            <input class="input-simple form-register-input" id="pass-register" name="user[password]" type="password"/>
            <span class="error-text"></span>
        </div>

        <div class="form-register-row">
            <label for="pass-again-register" class="form-register-label">Пароль еще раз</label>
            <input class="input-simple form-register-input" id="pass-again-register" name="user[password_repeat]" type="password"/>
            <span class="error-text"></span>
        </div>

        <div class="form-register-bottom">
            

            <div class="form-captcha"> 
                <div class="form-captcha-title">Введите символы, показанные на картинке</div>
                <div class="form-captcha-img">
                   <?php $this->widget('CCaptcha', array('buttonLabel' => 'Обновить')); ?>                   
                </div>
                <input class="form-captcha-input input-simple" name="user[verifyCode]" id="verify" type="text"/>
                <span class="error-text" id="error-text-captcha"></span>

            </div> <!-- end of form-captcha -->

            <button type="submit" class="form-register-submit btn-simple" onclick="formRegisterSubmit()" id="form-register-submit">
                <span>Завершить регистрацию</span>
            </button>
        </div>
    </form> <!-- end form-register -->
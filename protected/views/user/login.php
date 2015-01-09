<?php
$this->pageTitle = "Вход на сайт";
?>
<form action="#" class="form-register form-login" name="form-login" id="form-login" onsubmit="return false;">
    <div class="form-register-row">
        <label for="email-register" class="form-register-label">Ваша эл. почта</label>
        <input class="input-simple form-register-input" id="email-register" type="email" name="login[username]"/>
        <span class="error-text"></span>
    </div>

    <div class="form-register-row">
        <label for="pass-register" class="form-register-label">Пароль</label>
        <input class="input-simple form-register-input" id="pass-register" type="password" name="login[password]"/>
        <span class="error-text"></span>
        <div class="aright clearfix">
            <a class="forget-password popup-open" href="#" data-key="repair-pass">Забыли пароль?</a>
        </div>
    </div>
    <div class="form-register-row">
        <button type="submit" class="form-login-enter btn-simple pull-right" onclick="send_login_form()">
            <span>Войти</span>
        </button>
        <label class="check-simple form-remind-me" >
            <input class="check-simple-input" checked="checked" type="checkbox"/>
            <span class="check-simple-text">Запомнить меня</span>
        </label>
        <hr />
        <button type="submit" class="form-register-submit btn-simple" onclick="location.href = '/registration'">
            <span>Регистрация</span>
        </button>
    </div>
</form> <!-- end form-register -->
<?php if(Yii::app()->user->isGuest):?>
<?php $this->renderPartial('/user/_password_recovery'); ?>
<?php endif;?>
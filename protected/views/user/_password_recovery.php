<div class="mask_popup"></div>
<div class="popup" id="repair-pass">
    <article>
        <a class="close"></a>
        <p class="popup-title">Восстановление пароля</p>
        <form class="standart-form repair-pass" id="form_password_recovery" onsubmit="return false;">
            <fieldset class="recoveryEmail">
                <label>Ваша эл. почта</label>
                <input type="text" id="email" value="" />
                <span class="error-text" id="error-text-recovery"></span>
            </fieldset>
            <fieldset class="aright">
                <button type="submit" class="btn-simple popup-form-submit" onclick="password_recovery()"><span>Продолжить</span></button>
            </fieldset>
        </form>
    </article>
</div>
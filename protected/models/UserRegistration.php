<?php

/**
 * Description of UserRegistration
 *
 * @author gnesenka
 */
class UserRegistration extends CFormModel {

    public $email;
    public $name;
    public $phone;
    public $password;
    public $password_repeat;
    public $verifyCode;

    public function rules() {
        return array(
            array('email', 'required', 'message' => 'Вы не указали электронную почту'),
            array('email', 'email'),
            array('email', 'emailUnique'),
            array('name', 'required', 'message' => 'Вы не указали никнейм'),
            array('name', 'nameUnique'),
            array('phone', 'required', 'message' => 'Вы не указали телефон'),
            array('password', 'required', 'message' => 'Вы не ввели пароль'),
            array('password_repeat', 'required', 'message' => 'Вы не ввели повторный пароль'),
            array('password, password_repeat', 'length', 'min' => 6, 'tooShort' => 'Длина поля должна быть больше 6 символов'),
            array('password', 'compare', 'compareAttribute' => 'password_repeat', 'message' => 'Введенные пароли не совпадают'),           
            array('verifyCode', 'captcha', 'allowEmpty' => !CCaptcha::checkRequirements(), 'except' => 'admin'),
                
        );
    }

    public function emailUnique($attribute, $params) {
        if (!User::model()->check_email($this->email)) {
            $this->addError($attribute, 'Адрес уже занят');
        }
    }

    public function nameUnique($attribute, $params) {
        if (!User::model()->check_name($this->name)) {
            $this->addError($attribute, 'Никнейм уже занят');
        }
    }

    public function validateCaptcha() {
        var_dump($this->verifyCodeRequired);
        if ($this->verifyCodeRequired) {
            $validator = new CCaptchaValidator();
            $validator->attributes = array("verifyCode");
            return $validator->validate($this);
        } else {
            return true;
        }
    }

}

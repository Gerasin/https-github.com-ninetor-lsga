<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'MainController'.
 */
class LoginForm extends CFormModel {

    public $username;
    public $password;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
            array('username', 'required', 'message' => 'Вы не ввели эл. почту'),
            array('username', 'emailValidate'),
            array('password', 'required', 'message' => 'Вы не ввели пароль'),
            array('password', 'authenticate'),
        );
    }

    public function emailValidate($attribute, $params) {
        if ($this->username != '') {
            if (!User::model()->validate_email($this->username))
                $this->addError($attribute, 'Вы ввели неккоректный адрес почты');
        }
    }

    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate($attribute, $params) {
        if ($this->username && $this->password) {
            $user = User::model()->findByAttributes(array('email' => $this->username));
            $identity = new UserIdentity($this->username, $this->password);
            if ($user && $identity->authenticate()) {
                Yii::app()->user->login($identity);
                $user->last_time = time();
                $user->update();
                $message = array('success' => 1);
                return $message;
            } else {
                $this->addError('password', 'Неверный логин или пароль');
            }
        }
    }

}
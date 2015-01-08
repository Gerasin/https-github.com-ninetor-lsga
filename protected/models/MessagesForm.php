<?php

/**
 * This is the model class for table "MessagesForm".
 *
 * The followings are the available columns in table 'MessagesForm':
 * @property string $name
 * @property string $email
 * @property string $message
 */
class MessagesForm extends CFormModel {

    public $name;
    public $email;
    public $message;

    public function rules() {
        return array(
            array('email', 'required', 'message' => 'Вы не указали электронную почту'),
            array('email', 'email', 'message' => "Вы указали не верный формат электронной почты"),
            array('name', 'required', 'message' => 'Вы не указали имя'),
            array('message', 'required', 'message' => 'Вы не указали сообщение'),
        );
    }

    public function emailUnique($attribute, $params) {
        if (!User::model()->check_email($this->email)) {
            $this->addError($attribute, 'Адрес уже занят');
        }
    }

}

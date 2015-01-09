<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserUpdate
 *
 * @author gnesenka
 */
class UserUpdate extends CFormModel {

    public $email;
    public $name;
    public $phone;
    public $title;
    public $country;
    public $city;
    public $password;
    public $password_repeat;
    public $volume;
    public $verifyCode;
    public $street;
    public $house;
    public $postcode;
    public $apartment;
    public $bdate;

    public function rules() {
        return array(            
            array('email', 'required', 'message' => 'Вы не указали электронную почту'),
            array('phone', 'required', 'message' => 'Вы не указали телефон'),
            array('title', 'required', 'message' => 'Вы не указали имя и фамилию/название фирмы'),
            array('country', 'required', 'message' => 'Вы не указали дстрану'),
            array('city', 'required', 'message' => 'Вы не указали город'),
            array('password, password_repeat', 'length', 'min' => 6, 'tooShort' => 'Длина поля должна быть больше 6 символов'),
            array('street, house, apartment, postcode, bdate', 'length', 'min' => 1, 'tooShort' => 'Длина поля должна быть больше 1 символов'),
            array('password', 'compare', 'compareAttribute' => 'password_repeat', 'message' => 'Введенные пароли не совпадают'),
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

}

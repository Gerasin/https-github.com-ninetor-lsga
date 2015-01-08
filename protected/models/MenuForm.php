<?php

/**
 * This is the model class for table "MenuForm".
 *
 * The followings are the available columns in table 'MenuForm':
 * @property string $name
 * @property string $url
 * @property string $class
 */
class MenuForm extends CFormModel {

    public $name;
    public $url;
    public $class;

    public function rules() {
        return array(
            array('name', 'required', 'message' => 'Вы не заполинили поля'),
            array('url', 'required', 'message' => 'Вы не заполинили поля'),
            array('class', 'required', 'message' => 'Вы не заполинили поля'),
        );
    }

}

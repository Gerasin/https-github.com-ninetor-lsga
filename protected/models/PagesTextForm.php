<?php

/**
 * This is the model class for table "PagesTextForm".
 *
 * The followings are the available columns in table 'PagesForm':
 * @property string $name
 * @property string $full_text
 */
class PagesTextForm extends CFormModel {

    public $name;
    public $full_text;

    public function rules() {
        return array(
            array('name', 'required', 'message' => 'Вы не заполнили поля'),
            array('full_text', 'required', 'message' => 'Вы не заполнили поля'),
        );
    }

}

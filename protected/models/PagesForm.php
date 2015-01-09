<?php

/**
 * This is the model class for table "PagesForm".
 *
 * The followings are the available columns in table 'PagesForm':
 * @property string $name
 * @property string $prev_text
 * @property string $full_text
 */
class PagesForm extends CFormModel {

    public $name;
    public $prev_text;
    public $full_text;

    public function rules() {
        return array(
            array('name', 'required', 'message' => 'Вы не заполинили поля'),
            array('prev_text', 'required', 'message' => 'Вы не заполинили поля'),
            array('full_text', 'required', 'message' => 'Вы не заполинили поля'),

        );
    }
    
}

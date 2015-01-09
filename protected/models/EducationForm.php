<?php

/**
 * This is the model class for table "EducationForm".
 *
 * The followings are the available columns in table 'EducationForm':
 * @property string $name
 * @property string $description
 */
class EducationForm extends CFormModel {

    public $name;
    public $description;

    public function rules() {
        return array(
            array('name', 'required', 'message' => 'Вы не заполинили поля'),
            array('description', 'required', 'message' => 'Вы не заполинили поля'),           
        );
    }
    
}

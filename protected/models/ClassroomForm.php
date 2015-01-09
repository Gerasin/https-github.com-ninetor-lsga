<?php

/**
 * This is the model class for table "ClassroomForm".
 *
 * The followings are the available columns in table 'ClassroomForm':
 * @property string $name
 */
class ClassroomForm extends CFormModel {

    public $name;   

    public function rules() {
        return array(
            array('name', 'required', 'message' => 'Вы не заполинили поля'),
        );
    }

}

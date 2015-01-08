<?php

/**
 * This is the model class for table "Lesson".
 *
 * The followings are the available columns in table 'Lesson':
 * @property string $name
 * @property string $description
 */
class LessonForm extends CFormModel {

    public $name;
    public $description;
   

    public function rules() {
        return array(
            array('name', 'required', 'message' => 'Вы не заполинили поля'),
            array('description', 'required', 'message' => 'Вы не заполинили поля'),            

        );
    }
    
}

<?php

/**
 * This is the model class for table "HomeProblemForm".
 *
 * The followings are the available columns in table 'HomeProblemForm':
 * @property string $text
 */
class HomeProblemForm extends CFormModel {

    public $text; 

    public function rules() {
        return array(
            array('text', 'required', 'message' => 'Вы не заполинили поля'),            
        );
    }

}

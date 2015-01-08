<?php

/**
 * This is the model class for table "CategoryPropertiesForm".
 *
 * The followings are the available columns in table 'CategoryPropertiesForm':
 * @property string $text
 */
class CategoryPropertiesForm extends CFormModel {

    public $text;

    public function rules() {
        return array(
            array('text', 'required', 'message' => 'Вы не заполинили поля'),           
        );
    }

}

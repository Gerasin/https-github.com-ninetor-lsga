<?php

/**
 * This is the model class for table "ProblemForm".
 *
 * The followings are the available columns in table 'ProblemForm':
 * @property string $name
 * @property string $comment
 * @property string $status
 */
class ProblemForm extends CFormModel {

    public $text; 
    public $comment;
    public $status;

    public function rules() {
        return array(
            array('text', 'required', 'message' => 'Вы не заполинили поля'),
            array('comment', 'length', 'min' => 1, 'tooShort' => 'Длина поля должна быть больше 1 символa'),
            array('status', 'required', 'message' => 'Не выбран верный ответ'),
        );
    }

}

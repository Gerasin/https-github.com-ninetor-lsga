<?php


class MainPostsForm extends CFormModel {

    public $name;
    public $url;
    public $photo;
    public $additional_photos;

    public function rules() {
        return array(
            array('name', 'required', 'message' => 'Вы не заполинили поля'),
            array('url', 'required', 'message' => 'Вы не заполинили поля'),
            //array('fileToUpload', 'file', 'types'=>'jpg, gif, png'),

        );
    }

}

<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 13.01.15
 * Time: 11:32
 */
class ShopGoodsForm extends CFormModel {

    public $name;
    public $code;
    public $category;
    public $warehouse_count;
    public $price;
    public $discount;
    public $fileToUpload;

    public function rules() {
        return array(
            array('name', 'required', 'message' => 'Вы не заполнили поля'),
            array('code', 'required', 'message' => 'Вы не заполнили поля'),
            array('category', 'required', 'message' => 'Вы не заполнили поля'),
            array('warehouse_count', 'required', 'message' => 'Вы не заполнили поля'),
            array('price', 'required', 'message' => 'Вы не заполнили поля'),
            array('discount', 'required', 'message' => 'Вы не заполнили поля'),
//            array('fileToUpload', 'file', 'types'=>'jpg, gif, png'),
        );
    }

}

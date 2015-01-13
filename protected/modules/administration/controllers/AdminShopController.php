<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 12.01.15
 * Time: 16:57
 */
class AdminShopController extends AdminController
{

    public function accessRules() {
        return array(
            array(
                'allow',
                'roles' => array('administrator'),
                'actions' => array(),
            ),
            array('deny'),
        );
    }

    /**
     * SHOP category
     */
    public function actionShopCategory()
    {
        $categories = ShopCategory::model()->findAllByAttributes(array('parent_id' => null));
        $this->render('shop_category', array('categories' => $categories));
    }

    public function actionShopCategoryEdit()
    {
        $category_id = Yii::app()->request->getParam('id');
        $category = ShopCategory::model()->findByPk($category_id);
        $child_categories = ShopCategory::model()->findAllByAttributes(array('parent_id' => $category_id));
        $this->render('shop_category_edit', array('category' => $category, 'child_categories' => $child_categories));
    }

    public function actionShopCategoryEditName()
    {
        $category_id = Yii::app()->request->getParam('id');
        $category_name = Yii::app()->request->getPost('name');
        if (isset($category_name) && isset($category_id)) {
            $category = ShopCategory::model()->findByPk($category_id);
            $category->name = $category_name;
            $category->save();
        }
        header('Content-type: application/json');
        echo CJSON::encode(array('success' => 1));
        Yii::app()->end();
    }

    public function actionShopCategoryDelete()
    {
        $category_id = Yii::app()->request->getParam('id');
        $category_url = Yii::app()->request->getParam('category');
        ShopCategory::model()->getCategoriesForDelete($category_id);
        $category = ShopCategory::model()->findByPk($category_id);
        $category->delete();
//
        $url = (isset($category_url)) ? "/administration/shopCategory/edit/$category_url" : "/administration/shopCategory";
        header("Location: " . $url);
        return;
    }

    public function actionShopCategoryAdd()
    {
        $category_id = Yii::app()->request->getParam('id');
        $this->render('shop_category_add', array('category_id' => $category_id));
    }

    public function actionShopCategoryAddNew()
    {
        $parent_id = Yii::app()->request->getPost('parent_id');
        if ($parent_id == 'undefined') $parent_id = null;
        $category_name = Yii::app()->request->getPost('name');
        if (isset($category_name)) {
            $category = new ShopCategory();
            $category->name = $category_name;
            $category->parent_id = $parent_id;
            $res = $category->save();
        }
        header('Content-type: application/json');
        echo CJSON::encode(array('success' => 1));
        Yii::app()->end();
    }

    /**
     * SHOP goods
     */
    public function actionShopGoods()
    {
        $goods = ShopGoods::model()->findAll();
        $this->render('shop_goods', array('goods' => $goods));
    }

    public function actionShopGoodsAdd()
    {
        $goods = ShopGoods::model()->findAll();
        $categories = ShopCategory::model()->findAll();
        $this->render('shop_goods_add', array('goods' => $goods, 'categories' => $categories));
    }

    public function actionShopGoodsAddNew()
    {
        $form = new ShopGoodsForm();
        $form->attributes = Yii::app()->request->getPost('goods');
        $imageError = AdminMethods::checkImage('fileToUpload');
        if ($form->validate() && !$imageError) {
            $goods = new ShopGoods();
            $goods->name = $form->name;
            $goods->code = $form->code;
            $goods->shop_category_id = $form->category;
            $goods->warehouse_count = $form->warehouse_count;
            $goods->price = $form->price;
            $goods->discount = $form->discount;
            $goods->created = Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm:ss', time());
            $nameImage = 'tovar' . time() . '.jpg';
            $image = AdminMethods::addImageForm('fileToUpload', 450, 300, 'tovars', $nameImage);
            $goods->picture = $image;
            $goods->save();

            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 1));
        } else {
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 0, 'error' => array($form->getErrors(), $imageError)));
        }
        Yii::app()->end();
    }

    public function actionShopGoodsEdit()
    {
        $goods_id = Yii::app()->request->getParam('id');
        $goods = ShopGoods::model()->findByPk($goods_id);
        $categories = ShopCategory::model()->findAll();

        $this->render('shop_goods_edit', array('goods' => $goods, 'categories' => $categories));
    }
    public function actionShopGoodsDelete()
    {
        $goods_id = Yii::app()->request->getParam('id');
        $goods = ShopGoods::model()->findByPk($goods_id);
        $goods->delete();
        header("Location: /administration/shopGoods");
        return;
    }

    public function actionShopGoodsUpdate()
    {
        $form = new ShopGoodsForm();
        $form->attributes = Yii::app()->request->getPost('goods');
        $imageError = AdminMethods::checkImage('fileToUpload');
        if ($form->validate() && !$imageError) {
            $goods = ShopGoods::model()->findByPk($form->id);
            $goods->name = $form->name;
            $goods->code = $form->code;
            $goods->shop_category_id = $form->category;
            $goods->warehouse_count = $form->warehouse_count;
            $goods->price = $form->price;
            $goods->discount = $form->discount;
           if (!is_null($imageError)) {
               $nameImage = 'tovar' . time() . '.jpg';
               $image = AdminMethods::addImageForm('fileToUpload', 450, 300, 'tovars', $nameImage);
               $goods->picture = $image;
            }
            $goods->update();

            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 1));
        } else {
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 0, 'error' => array($form->getErrors(), $imageError)));
        }
        Yii::app()->end();
    }

}
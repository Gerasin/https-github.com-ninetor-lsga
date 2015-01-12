<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 12.01.15
 * Time: 16:57
 */
class AdminShopController extends AdminController
{

    /**
     * SHOP
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
}
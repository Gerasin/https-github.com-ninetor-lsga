<?php

class ShopController extends Controller
{
    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {
        return array(
            array(
                'allow',
                'users' => array('@'),
                'actions' => array(),
            ),
            array('deny'),
        );
    }

    public function actionIndex()
	{

        $categories = ShopCategory::model()->getCategories(NULL);
        $criteria = new CDbCriteria();
        $count = ShopGoods::model()->count($criteria);
        $pages=new CPagination($count);
        $pages->pageSize=10;
        $pages->applyLimit($criteria);
        $goods = ShopGoods::model()->findAll($criteria);

        $cart = CHtml::listData(ShopCart::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->getId())),'id', 'shop_goods_id');
        $this->render('index', array('categories' => $categories,   'pages' => $pages,   'goods' => $goods,   'cart' => $cart));
	}

    public function actionGoods()
	{
        $goods_id = Yii::app()->request->getParam('id');
        $goods = ShopGoods::model()->findByPk($goods_id);
        $cart = CHtml::listData(ShopCart::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->getId())),'id', 'shop_goods_id');
        $this->render('goods', array('goods' => $goods,   'cart' => $cart));
	}

    public function actionAddToCart()
	{
        $goods_id = Yii::app()->request->getPost('goods_id');
        $count = Yii::app()->request->getPost('count');
        $cart = new ShopCart();
        $cart->shop_goods_id = $goods_id;
        $cart->user_id = Yii::app()->user->getId();
        $cart->count = $count;
        $result = $cart->save();
        header('Content-type: application/json');
        echo CJSON::encode(array('success' => (($result) ? 1 : 0)));
        Yii::app()->end();
	}

    public function actionChangeCountCart()
	{
        $goods_cart_id = Yii::app()->request->getPost('id');
        $count = Yii::app()->request->getPost('count');
        $cart = ShopCart::model()->findByPk($goods_cart_id);
        $cart->count = $count;
        $result = $cart->save();
        header('Content-type: application/json');
        echo CJSON::encode(array('success' => (($result) ? 1 : 0)));
        Yii::app()->end();
	}
    public function actionCart()
	{
        $user = User::model()->findByPk(Yii::app()->user->getId());
        $cart = ShopCart::model()->findAllByAttributes(array('user_id'=>$user->id));
        $this->render('cart' , array('user'=>$user, 'cart'=>$cart));
	}

    public function actionDelete()
	{
        $goods_cart_id = Yii::app()->request->getPost('id');
        $cart = ShopCart::model()->findByPk($goods_cart_id);
        $result = $cart->delete();
        header('Content-type: application/json');
        echo CJSON::encode(array('success' => (($result) ? 1 : 0)));
        Yii::app()->end();
	}

    public function actionCartStepOne()
	{
       $this->render('cart_step_one');
	}
}
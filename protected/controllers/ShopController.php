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
        $price = Yii::app()->request->getPost('price');
        $discount = Yii::app()->request->getPost('discount');
        $credits = Yii::app()->request->getPost('credits');
        Yii::app()->session['cart_price'] = $price;
        Yii::app()->session['cart_discount'] = $discount;
        Yii::app()->session['cart_credits'] = $credits;
        $this->render('cart_step_one');
	}

    public function actionCartStepTwo()
	{
        $country = Yii::app()->request->getPost('country');
        $city = Yii::app()->request->getPost('city');
        $telephone = Yii::app()->request->getPost('telephone');
        $street = Yii::app()->request->getPost('street');
        $home = Yii::app()->request->getPost('home');
        $apartment = Yii::app()->request->getPost('apartment');
        Yii::app()->session['cart_telephone'] = $telephone;
        Yii::app()->session['cart_street'] = $street;
        Yii::app()->session['cart_home'] = $home;
        Yii::app()->session['cart_apartment'] = $apartment;
        Yii::app()->session['cart_city'] = $city;
        Yii::app()->session['cart_country'] = $country;
//        $this->render('cart_step_two');
        header("Location: /shop/cart_step_three");
        return;
	}
    public function actionCartStepThree()
    {
//      $type_delivery = Yii::app()->request->getPost('type_delivery');
        $type_delivery = "Без доставки";
        $cost_delivery = 0;
        Yii::app()->session['cart_type_delivery'] = $type_delivery;
        Yii::app()->session['cart_total_price'] = Yii::app()->session['cart_price'] + $cost_delivery;

        $this->render('cart_step_three');
    }

    public function actionCartStepFour()
    {
        $type_payment = Yii::app()->request->getPost('type_payment');
        Yii::app()->session['cart_type_payment'] = $type_payment;
        $user = User::model()->findByPk(Yii::app()->user->getId());
        $cart = ShopCart::model()->findAllByAttributes(array('user_id'=>$user->id));
        $this->render('cart_step_four', array('cart'=>$cart));
    }


}
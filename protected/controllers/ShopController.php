<?php

class ShopController extends Controller
{
	public function actionIndex()
	{
        $categories = ShopCategory::model()->getCategories(NULL);

        $criteria = new CDbCriteria();
        $count = ShopGoods::model()->count($criteria);
        $pages=new CPagination($count);
        $pages->pageSize=10;
        $pages->applyLimit($criteria);
        $goods = ShopGoods::model()->findAll($criteria);

        $this->render('index', array('categories' => $categories,   'pages' => $pages,   'goods' => $goods));
	}

    public function actionGoods()
	{
        $goods_id = Yii::app()->request->getParam('id');
        $goods = ShopGoods::model()->findByPk($goods_id);

        $this->render('goods', array('goods' => $goods));
	}
}
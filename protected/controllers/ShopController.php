<?php

class ShopController extends Controller
{
	public function actionIndex()
	{
        $categories = ShopCategory::model()->getCategories(NULL);

        $criteria = new CDbCriteria();
        $count = ShopGoods::model()->count($criteria);
        $pages=new CPagination($count);
        // элементов на страницу
        $pages->pageSize=1;
        $pages->applyLimit($criteria);
        $goods = ShopGoods::model()->findAll($criteria);

        $this->render('index', array('categories' => $categories,   'pages' => $pages,   'goods' => $goods));
	}
}
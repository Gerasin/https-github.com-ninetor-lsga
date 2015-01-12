<?php

class CategoryController extends Controller
{

    public $layout = '//layouts/inner';

    public function actionIndex()
    {
        $this->layout = '//layouts/inner_block';
        $id = Yii::app()->request->getParam('id');
        $category = Category::model()->findByPk($id);
        $res = Yii::app()->request->getParam('res');
        if (isset($res)) {
            $pages = $this->filterPages($res);
        } else {
            $pages = Pages::model()->findAllByAttributes(array('id_category' => $id), array("order" => "position ASC"));
            $res = array();
        }
        $this->render('index', array('properties' => $this->allPropertyCategory($category->id), 'pages' => $pages, 'category' => $category, 'res' => $res));
    }

    /**
     * получем все свойства категории с вложеностями
     */
    private function allPropertyCategory($id_category = '')
    {
        $properties = FALSE;
        $propertiesNo = CategoryProperties::model()->findAllByAttributes(array('id_category' => $id_category, 'id_properties' => 0), array("order" => "position ASC"));
        foreach ($propertiesNo as $value) {
            $properties[$value->id]['id'] = $value->id;
            $properties[$value->id]['text'] = $value->text;
            $properties[$value->id]['position'] = $value->position;
            $properties[$value->id]['children'] = CategoryProperties::model()->findAllByAttributes(array('id_category' => $id_category, 'id_properties' => $value->id), array("order" => "position ASC"));
        }
        return $properties;
    }

    /**
     * выводим страницы, с учетом фильтра 
     * */
//    public function actionFilterPages() {
//        $res = Yii::app()->request->getPost('res');
//        $id_category = Yii::app()->request->getPost('id_category');
//        if (!is_null($res)) {
//            //$data = Yii::app()->db->createCommand()->select('*')->from('pages_properties')->where(array('in', 'id_propertie', $res))->queryAll();
//            $str = '';
//            for ($i = 0; $i < count($res); $i++) {
//                if ($i != 0) {
//                    $str.=' OR ';
//                }
//                $str.='pages_properties.id_propertie=' . $res[$i];
//            }
//            
//            $data = Yii::app()->db->createCommand('SELECT pages.name FROM `pages` JOIN `pages_properties` ON pages.id=pages_properties.id_pages WHERE ' . $str . ' GROUP BY pages.id ORDER BY pages.position ASC')->queryAll();
//
//            header('Content-type: application/json');
//            echo CJSON::encode(array('success' => 1, 'str' => $str, 'data' => $data, 'res' => $res, 'id_category' => $id_category));
//            Yii::app()->end();
//        } else {
//            header('Content-type: application/json');
//            echo CJSON::encode(array('success' => 0));
//            Yii::app()->end();
//        }
//    }

    private function filterPages($res = '')
    {
        if (!is_null($res)) {
            $str = '';
            $i = 0;
            foreach ($res as $value) {
                if ($i != 0) {
                    $str.=' OR ';
                }
                $str.='pages_properties.id_propertie=' . $value;
                $i++;
            }
            // $data = Yii::app()->db->createCommand('SELECT pages.id FROM `pages` JOIN `pages_properties` ON pages.id=pages_properties.id_pages WHERE ' . $str . ' GROUP BY pages.id ORDER BY pages.position ASC')->queryAll(false);
            // $data = Yii::app()->db->createCommand('SELECT id_pages FROM `pages_properties` WHERE ' . $str . ' ')->queryAll(false);

            $data = Yii::app()->db->createCommand()->select('id_pages')->from('pages_properties')->where(array('in', 'id_propertie', $res))->queryAll();
            foreach ($data as $key) {
                foreach ($key as $value) {
                    $mas[] = $value;
                }
            }
            $pages = Pages::model()->findAllByAttributes(array('id' => $mas), array("order" => "position ASC"));
            return $pages;
        } else {
            return FALSE;
        }
    }

    /**
     * выводим нужную страницу
     */
    public function actionPage()
    {
        $id_user = (int) Yii::app()->user->id;
        $user = User::model()->findByPk($id_user);
        $id = Yii::app()->request->getParam('id');
        $page = Pages::model()->findByPk($id);
        $category = Category::model()->findByPk($page->id_category);
        $categoryPages = Pages::model()->findAllByAttributes(array('id_category' => $page->id_category), array('condition' => 'id!=' . $id, "order" => "created DESC", 'limit' => '3'));
        $this->render('page', array('comments' => $this->allCommentsPage($id), 'page' => $page, 'category' => $category, 'user' => $user, 'categoryPages' => $categoryPages));
    }

    /**
     * получем все комментории к странице 
     */
    private function allCommentsPage($id_page = '')
    {
        $comments = FALSE;
        $commNo = Comments::model()->findAllByAttributes(array('id_parent' => null, 'id_page' => $id_page), array("order" => "date ASC"));
        foreach ($commNo as $value) {
            $comments[$value->id]['id'] = $value->id;
            $comments[$value->id]['text'] = $value->text;
            $comments[$value->id]['date'] = $value->date;
            $comments[$value->id]['like'] = $value->like - $value->notlike;
            if ($comments[$value->id]['like'] > 0) {
                $comments[$value->id]['like'] = '+' . $comments[$value->id]['like'];
            }
            $comments[$value->id]['children'] = $this->allCommentsPageChildren($id_page, $value->id);
            $user = User::model()->findByPk($value->id_user);
            if (!is_null($user)) {
                $comments[$value->id]['user_name'] = $user->name;
                $comments[$value->id]['user_img'] = $user->img;
                $comments[$value->id]['user_like'] = $this->userReytinrComments($value->id_user);
                $comments[$value->id]['user_click'] = $this->userLikeOneComments(Yii::app()->user->id, $value->id);
            } else {
                $comments[$value->id] = NULL;
            }
        }
        return $comments;
    }

    // дочерние комментарии
    private function allCommentsPageChildren($id_page = '', $id_parent = '')
    {
        $comments = FALSE;
        $commNo = Comments::model()->findAllByAttributes(array('id_page' => $id_page, 'id_parent' => $id_parent), array("order" => "date ASC"));
        foreach ($commNo as $value) {
            $comments[$value->id]['id'] = $value->id;
            $comments[$value->id]['text'] = $value->text;
            $comments[$value->id]['date'] = $value->date;
            $comments[$value->id]['like'] = $value->like - $value->notlike;
            if ($comments[$value->id]['like'] > 0) {
                $comments[$value->id]['like'] = '+' . $comments[$value->id]['like'];
            }
            $user = User::model()->findByPk($value->id_user);
            if (!is_null($user)) {
                $comments[$value->id]['user_name'] = $user->name;
                $comments[$value->id]['user_img'] = $user->img;
                $comments[$value->id]['user_like'] = $this->userReytinrComments($value->id_user);
                $comments[$value->id]['user_click'] = $this->userLikeOneComments(Yii::app()->user->id, $value->id);
            } else {
                $comments[$value->id] = NULL;
            }
        }
        return $comments;
    }

    // рейтинг пользователя по комментариям
    private function userReytinrComments($id_user)
    {
        $sumLike = Yii::app()->db->createCommand('SELECT SUM(`like`) AS `sum` FROM `comments` WHERE `id_user`=' . $id_user)->queryAll();
        $sumNotlike = Yii::app()->db->createCommand('SELECT SUM(`notlike`) AS `sum` FROM `comments` WHERE `id_user`=' . $id_user)->queryAll();
        $sumLike = $sumLike[0]['sum'] - $sumNotlike[0]['sum'];
        if ($sumLike > 0) {
            $sumLike = '+' . $sumLike;
        }
        return $sumLike;
    }

    // лайк пользователя по комментариям
    private function userLikeOneComments($id_user = '', $id_comment = '')
    {
        if (Yii::app()->user->isGuest) {
            return 2;
        } else {
            $commNo = CommentsUser::model()->findAllByAttributes(array('id_user' => $id_user, 'id_comments' => $id_comment));
            if (count($commNo) > 0) {
                return $commNo[0]->like;
            } else {
                return null;
            }
        }
    }

}

<?php

class MainController extends Controller {

    public $layout = '//layouts/inner';
    const countLoadMainBlock = 10;

    public function actionIndex() {
        $this->layout = '//layouts/main';
        // выводим тест на главную
        $homeProblem = HomeProblem::model()->findAllByAttributes(array('active' => '1'));
        $homeProblemUser = HomeProblemUser::model()->findAllByAttributes(array('id_problem' => $homeProblem[0]->id, 'ip' => $this->getRealIpAddr()));

        if (count($homeProblemUser) <= 0) {
            $homeAns = HomeAns::model()->findAllByAttributes(array('id_problem' => $homeProblem[0]->id), array("order" => "rand()"));
        } else {
            $homeProblem = NULL;
        }
        // содержимое главной
        $form = Settings::model()->findAllByAttributes(array('category' => 'home'));
        $pos = MainBlocks::model()->findAll(array('order'=>'position DESC','limit' => 1));
        $main_block_main = MainBlocks::model()->findByAttributes(array('position'=>0));
        $this->render('index', array('home' => $form[0], 'homeProblem' => $homeProblem[0], 'homeAns' => $homeAns, 'blocks_pos' => $pos[0]->position, 'main_block_main'=>$main_block_main));
    }

    public function actionLoadBlocks() {
        $lastPos = Yii::app()->request->getPost('position');
        $blocks = MainBlocks::model()->findAll(array('order'=>'position DESC','condition'=>'position<'.$lastPos.' and position > 0','limit' => $this::countLoadMainBlock));
        $view = $this->renderPartial('index_blocks_template', array('blocks'=>$blocks), true, false);
        header('Content-type: application/json');
        echo CJSON::encode(array('success' => 1, 'blocks' => $view));
        Yii::app()->end();
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {

        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest) {
                echo $error['message'];
            } elseif ($error['code'] == 404) {
                //$this->layout = '//layouts/404';
                $this->render('error404');
            } else {
                $this->render('error', $error);
            }
        }
    }

    /**
     * получаем голос на главной
     */
    public function actionNewProblem() {
        $ans = Yii::app()->request->getPost('poll');

        if (!is_null($ans)) {
            foreach ($ans as $value) {
                $homeAns = HomeAns::model()->findByPk($value);
                $homeAns->count = $homeAns->count + 1;
                $homeAns->update();
            }
            $homeProblem = HomeProblem::model()->findByPk($homeAns->id_problem);
            $homeAns = HomeAns::model()->findAllByAttributes(array('id_problem' => $homeProblem->id), array("order" => "rand()"));
            $sumAnsProblem = Yii::app()->db->createCommand('SELECT SUM(`count`) AS `sum` FROM `home_ans` WHERE `id_problem`=' . $homeProblem->id)->queryAll();
            // запишем что пользователь поголосовал
            $userProblem = new HomeProblemUser();
            $userProblem->id_problem = $homeProblem->id;
            $userProblem->ip = $this->getRealIpAddr();
            $userProblem->date = time();
            $userProblem->save();

            $view = '<h3 class="poll-title">' . $homeProblem->text . '</h3><div class="poll-variants_answer">';
            foreach ($homeAns as $value) {
                $count = number_format($value->count * 100 / $sumAnsProblem[0]['sum'], 2, '.', ' ');
                $view.='<div class="poll-variant_answer_item">
                        <span class="poll-variant_answer_item_view" style="width: ' . $count . '%;"></span>
                        <em>' . $count . '%</em>
                        <i>' . $value->text . '</i>
                    </div><!--
                    -->';
            }
            $view .= '<div class="poll_answers_hide"><a href="#" class="hide-block_button" onclick="homeProblemClose(); return false;">Свернуть</a></div></div>';
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 1, 'ans' => $ans, 'userForm' => $view));
            Yii::app()->end();
        }
    }

    // ip пользователя
    private function getRealIpAddr() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

//    public function filters() {
//        return array(
//            'accessControl',
//        );
//    }
//
//    public function accessRules() {
//        return array(
//            // если используется проверка прав, не забывайте разрешить доступ к
//            // действию, отвечающему за генерацию изображения
//            array('allow',
//                'actions' => array('captcha'),
//                'users' => array('*'),
//            ),
//            array('deny',
//                'users' => array('*'),
//            ),
//        );
//    }
//
//    public function actions() {
//        return array(
//            'captcha' => array(
//                'class' => 'CCaptchaAction',
//            ),
//        );
//    }
}

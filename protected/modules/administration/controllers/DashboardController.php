<?php

class DashboardController extends AdminController {

    public function actionIndex() {
        $problems = HomeProblem::model()->findAll();
        $homeAns = $this->ansStatistickHome($problems);
        $this->render('index', array('problem' => $problems, 'homeAns' => $homeAns));
    }

    private function ansStatistickHome($problems = '') {
        if (count($problems) > 0) {
            foreach ($problems as $value) {
                $sumAnsProblem = Yii::app()->db->createCommand('SELECT SUM(`count`) AS `sum` FROM `home_ans` WHERE `id_problem`=' . $value->id)->queryAll();
                $homeAns = HomeAns::model()->findAllByAttributes(array('id_problem' => $value->id), array("order" => "rand()"));
                $homeAnsArray[$value->id] = $this->ansStatistickHomeCount($homeAns, $sumAnsProblem[0]['sum']);
            }
            return $homeAnsArray;
        } else {
            return false;
        }
    }

    private function ansStatistickHomeCount($homeAns = '', $sumAnsProblem = '') {
        if (count($homeAns) > 0) {
            foreach ($homeAns as $value) {
                $homeAnsArray[$value->id]['id'] = $value->id;
                $homeAnsArray[$value->id] ['text'] = $value->text;
                if ($sumAnsProblem > 0) {
                    $homeAnsArray[$value->id] ['statistic'] = $value->count * 100 / $sumAnsProblem;
                } else {
                    $homeAnsArray[$value->id] ['statistic'] = 0;
                }
            }
            return $homeAnsArray;
        } else {
            return false;
        }
    }

    public function actionAddProblem() {
        $this->render('problem_form');
    }

    public function actionProblemFormAdd() {
        $form = new HomeProblemForm(); // problem form 
        $form->attributes = Yii::app()->request->getPost('problem');
        $active = Yii::app()->request->getPost('active');
        if ($active == 1) { // обнулим все активные вопросы
            HomeProblem::model()->updateAll(array('active' => '0'));
        }
        if ($form->validate()) {
            $problem = new HomeProblem();
            $problem->text = $form->text;
            $problem->active = $active;
            $problem->save();

            // сохраняем варианты ответа
            $ans = Yii::app()->request->getPost('ans');
            $this->addAnsTable($ans, $problem->id);
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 1, 'problem_id' => $problem->id, 'ans' => $ans));
            Yii::app()->end();
            die;
        } else {
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 0, 'error' => $form->getErrors()));
            Yii::app()->end();
            die;
        }
    }

    private function addAnsTable($ans, $problem) {
        foreach ($ans as $value) {
            $new_ans = new HomeAns();
            $new_ans->id_problem = $problem;
            $new_ans->text = $value;
            $new_ans->count = 0;
            $new_ans->save();
        }
    }

    public function actionEditProblem() {
        $id = Yii::app()->request->getParam('id');
        $form = HomeProblem::model()->findByPk($id);
        $ans = HomeAns::model()->findAllByAttributes(array('id_problem' => $id));
        $this->render('problem_form', array('problem' => $form, 'ans' => $ans, 'edit' => 1));
    }

    public function actionUpdateProblem() {
        $form = new HomeProblemForm();
        $form->attributes = Yii::app()->request->getPost('problem');
        if ($form->validate()) {
            $id = Yii::app()->request->getParam('id');
            $active = Yii::app()->request->getPost('active');
            if ($active == 1) { // обнулим все активные вопросы
                HomeProblem::model()->updateAll(array('active' => '0'));
            }

            $problem = HomeProblem::model()->findByPk($id);
            $problem->text = $form->text;
            $problem->active = $active;
            $problem->update();

            // сохраняем варианты ответа            
            $ans = Yii::app()->request->getPost('ans');
            $this->updateHomeAns($ans, $problem->id);

            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 1, 'problem_id' => $id));
            Yii::app()->end();
        } else {
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 0, 'error' => $form->getErrors()));
            Yii::app()->end();
        }
    }

    // обновить данные по ответам, если нет создать новый варинт
    private function updateHomeAns($ans = '', $problem = '') {
        if (count($ans) > 0) {
            foreach ($ans as $item => $value) {
                $ans = HomeAns::model()->findByPk($item);
                if ($ans) {
                    $ans->text = $value;
                    $ans->update();
                } else {
                    $new_ans = new HomeAns();
                    $new_ans->id_problem = $problem;
                    $new_ans->text = $value;
                    $new_ans->count = 0;
                    $new_ans->save();
                }
            }
        }
    }

    public function actionDeleteAnsTable() {
        $problem = Yii::app()->request->getPost('problem');
        HomeAns::model()->deleteAll('id=' . $problem);

        header('Content-type: application/json');
        echo CJSON::encode(array('success' => 1, 'problem_id' => $problem));
        Yii::app()->end();
    }

    private function deleteAnsTable($problem) {
        HomeAns::model()->deleteAll('id_problem=' . $problem);
    }

    public function actionDeleteHomeProblem() {
        $id = Yii::app()->request->getParam('id');
        $problem = HomeProblem::model()->findByPk($id);
        $problem->delete();
        $this->deleteAnsTable($id);
        $this->redirect($this->createUrl('/administration'));
    }

    public function actionEditHome() {
        $id = Yii::app()->request->getPost('id');
        $text = Yii::app()->request->getPost('text');
        if (isset($id) && isset($text)) {
            $home = Settings::model()->findByPk($id);
            $home->value = $text;
            $home->update();
        }
        $form = Settings::model()->findAllByAttributes(array('category' => 'home'));
        $this->render('home_block', array('home' => $form[0]));
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

<?php

class EducationController extends Controller {

    public $layout = '//layouts/inner';

    public function __construct($id, $module = null) {
        parent::__construct($id, $module);
        if (Yii::app()->user->isGuest) {
            $this->redirect('/registration');
        }
    }

    public function actionIndex() {
        $this->layout = '//layouts/inner_block';
        $education = Education::model()->findAll(array("order" => "position ASC"));
        $education_block = Settings::model()->findAllByAttributes(array('category' => 'education_block'));
        $this->render('index', array('education' => $education, 'education_block' => $education_block[0]['value']));
    }

    public function actionCategory() {
        $id = Yii::app()->request->getParam('id');
        $id_user = Yii::app()->user->id;
        $education = Education::model()->findByPk($id);
        $classroom = Classroom::model()->findAllByAttributes(array('id_education' => $id), array("order" => "position ASC"));
        $procent = 0;
        $prev_name = '';
        $priv_satus = 0;
        $count = 1;
        foreach ($classroom as $value) {
            $mas[$value->id]['prev_name'] = $prev_name;
            $mas[$value->id]['id'] = $value->id;
            $mas[$value->id]['name'] = $value->name;
            $mas[$value->id]['id_education'] = $value->id_education;
            $exam = $this->userClassDate($value->id, $id_user);
            if (isset($exam)) {
                $mas[$value->id]['procent'] = $exam->procent;
                $procent+=$exam->procent;
                $mas[$value->id]['status'] = $exam->status;
            } else {
                $mas[$value->id]['procent'] = 0;
                if ($priv_satus == 2 || $priv_satus == 3 || $count == 1) {
                    $mas[$value->id]['status'] = 4;
                } else {
                    $mas[$value->id]['status'] = 0;
                }
            }
            $prev_name = $mas[$value->id]['name'];
            $priv_satus = $mas[$value->id]['status'];
            $count++;
        }
        $procent = $procent / count($classroom);
        
        $this->render('category', array('classroom' => $mas, 'education' => $education, 'procent' => $procent));
    }

    /**
     * получаем данные, которые привязано к пользователю и классу
     */
    private function userClassDate($id_class = '', $id_user = '') {
        $exams = UserProblem ::model()->findAllByAttributes(array('id_problem' => $id_class, 'id_user' => $id_user));
        if (isset($exams[0])) {
            return $exams[0];
        } else {
            return null;
        }
    }

    public function actionLessonList() {
        $cid = Yii::app()->request->getParam('cid');
        $id = Yii::app()->request->getParam('id');
        $id_user = Yii::app()->user->id;
        $exam = $this->userClassDate($cid, $id_user);
        if (isset($id)) {
            $lesson = Lesson::model()->findByAttributes(array('id' => $id, 'id_class' => $cid));
        } else {
            $lesson = Lesson::model()->findByAttributes(array('id_class' => $cid));
        }

        if (isset($lesson)) {
            $list = Lesson::model()->findAllByAttributes(array('id_class' => $cid), array("order" => "position ASC"));
            $this->render('lesson', array('lesson' => $lesson, 'list' => $list, 'cid' => $cid));
        } else {
            $this->redirect('/education');
        }
    }

    /**
     * создаем запись для изучения для поьзователя
     */
    public function actionAddUserExem() {
        $id_problem = Yii::app()->request->getPost('idClass');
        $id_user = Yii::app()->user->id;
        $userProblem = new UserProblem();
        $userProblem->id_user = $id_user;
        $userProblem->id_problem = $id_problem;
        $userProblem->ans = NULL;
        $userProblem->procent = 0;
        $userProblem->status = 1;
        $userProblem->date = time();
        $userProblem->save();

        header('Content-type: application/json');
        echo CJSON::encode(array('success' => 1, 'id_problem' => $id_problem));
        Yii::app()->end();
    }

    // Uncomment the following methods and override them if needed
    /*
      public function filters()
      {
      // return the filter configuration for this controller, e.g.:
      return array(
      'inlineFilterName',
      array(
      'class'=>'path.to.FilterClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }

      public function actions()
      {
      // return external action classes, e.g.:
      return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
      'class'=>'path.to.AnotherActionClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }
     */
}

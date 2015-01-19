<?php

/**
 * status
 * 1 -- начат тест
 * 2 -- завершен 75-100%
 * 3 -- пересдача через год
 * 0 -- еще рано проходить тест
 */
class ProblemController extends Controller
{

    public $layout = '//layouts/inner';

    public function __construct($id, $module = null)
    {
        parent::__construct($id, $module);
        if (Yii::app()->user->isGuest) {
            $this->redirect('/registration');
        }
    }

    public function actionIndex()
    {
        $id_problem = Yii::app()->request->getParam('id');
        $id_user = Yii::app()->user->id;
        $problems = Problem::model()->findAllByAttributes(array('id_class' => $id_problem));
        $userProblem = $this->userProblemAddTable($id_user, $id_problem);
        $statusExem = $this->statusExemForUser($id_user, $id_problem);
        if (!$statusExem || $statusExem == 2 || $statusExem == 3 || $statusExem == 0) { // проверим статус теста для пользователя
            $this->render('index', array('problems' => $problems, 'problem' => FALSE));
        } else {
            $ans = Ans::model()->findAllByAttributes(array('id_problem' => $userProblem->id), array('order' => 'rand()'));
            $this->render('index', array('problems' => $problems, 'problem' => $userProblem, 'ans' => $ans, 'id_problem' => $id_problem));
        }
    }

    /**
     * Проверим можно ли пользователю проходить тест
     */
    private function userProblemAddTable($id_user = '', $id_problem = '')
    {
        $exam = UserProblem ::model()->findAllByAttributes(array('id_problem' => $id_problem, 'id_user' => $id_user));
        if (isset($exam) && $exam != NULL) {
            $problems = Problem::model()->findAllByAttributes(array('id_class' => $id_problem), array('order' => 'rand()'));
            $mass = NULL;
            foreach ($problems as $value) {
                $mass[$value->id] = NULL;
            }
            $ans = ($mass);
            $this->userProblemUpdateTable($ans, $exam[0]->id);
            return $problems[0];
        } else {
            return false;
        }
    }

    private function userProblemUpdateTable($ans = '', $rr)
    {
        $userProblem = UserProblem::model()->findByPk($rr);
        $userProblem->ans = serialize($ans);
        $userProblem->date = time();
        $userProblem->save();
    }

    /**
     * получам статус теста для пользователя
     */
    private function statusExemForUser($id_user = '', $id_problem = '')
    {
        $exam = UserProblem ::model()->findAllByAttributes(array('id_problem' => $id_problem, 'id_user' => $id_user));
        return $exam[0]->status;
    }

    /**
     *  текущие ответы пользователя на вопросы теста (кроме последнего и без подсчета)
     */
    public function actionNewProblem()
    {
        $id_problem = Yii::app()->request->getPost('problem');
        $user_ans = Yii::app()->request->getPost('ans');
        $id_class = Yii::app()->request->getPost('class');
        $position = Yii::app()->request->getPost('position');
        $position++;
        $id_user = Yii::app()->user->id;
        // записываем ответ пользователя
        $exams = UserProblem ::model()->findAllByAttributes(array('id_problem' => $id_class, 'id_user' => $id_user));
        $exam = $exams[0];
        $ans = unserialize($exam->ans);
        $ans[$id_problem] = $user_ans;
        $this->userProblemUpdateTable($ans, $exam->id);
        if ($position == count($ans)) {
            $endProblem = true;
        } else {
            $endProblem = false;
        }
        // следующий вопрос для пользователя
        $nextid = $this->newIdProblem($ans);
        $nextid = Problem::model()->findByPk($nextid);

        //ответы для этого вопроса
        $ans = Ans::model()->findAllByAttributes(array('id_problem' => $nextid->id), array('order' => 'rand()'));

        // новая форма для отбражения данных
        $userForm = '<input type="hidden" name="problem" value="' . $nextid->id . '"/>
            <input type="hidden" name="class" value="' . $id_class . '"/><input type="hidden" name="position" value="' . $position . '"/>';
        $countAns = 1;
        foreach ($ans as $value) {
            $userForm.='<fieldset>';
            $userForm.='<input type="radio" checked value="' . $value->id . '" id="radio-' . $countAns . '" name="ans" />';
            $userForm.='<label for="radio-' . $countAns . '">' . $value->text . '</label>';
            $userForm.='</fieldset>';
            $countAns++;
        }

        header('Content-type: application/json');
        echo CJSON::encode(array('success' => 1, 'ans' => $ans, 'userForm' => $userForm, 'problem' => $nextid, 'position' => $position, 'endProblem' => $endProblem));
        Yii::app()->end();
    }

    private function newIdProblem($ans)
    {
        foreach ($ans as $key => $value) {
            if (is_null($value)) {
                return $key;
            }
        }
        return false;
    }

    public function actionNewProblemEnd()
    {
        $id_problem = Yii::app()->request->getPost('problem');
        $user_ans = Yii::app()->request->getPost('ans');
        $id_class = Yii::app()->request->getPost('class');
        $id_user = Yii::app()->user->id;

        // записываем ответ пользователя
        $exams = UserProblem ::model()->findAllByAttributes(array('id_problem' => $id_class, 'id_user' => $id_user));
        $exam = $exams[0];
        $ans = unserialize($exam->ans);
        $ans[$id_problem] = $user_ans;
        $this->userProblemUpdateTable($ans, $exam->id);
        // подсчитаем количество верных ответов
        $ansTrue = 0;
        foreach ($ans as $key => $value) {
            $ansTrue+=$this->trueAnsUserProblem($key, $value);
        }
        // подсчитаем процент верных ответов
        $procentTrue = $ansTrue * 100 / count($ans);
        // установим статус и запишем полученные данные в базу
        if ($procentTrue >= 75) {
            $statusTrue = 2;
        } else {
            $statusTrue = 3;
        }
        $this->newStatusProcent($exam->id, $procentTrue, $statusTrue);

        header('Content-type: application/json');
        echo CJSON::encode(array('success' => 1, 'id_category' => $this->categoryExem($exam->id_problem)));
        Yii::app()->end();
    }

    /**
     * верно ли ответил пользователь на вопрос
     */
    private function trueAnsUserProblem($id_problem = '', $id_ans = '')
    {
        $problem = Problem::model()->findAllByAttributes(array('id' => $id_problem, 'status_ans' => $id_ans));
        return count($problem);
    }

    /**
     *  обновляем данные о пройденном тесте
     */
    private function newStatusProcent($id_problem = '', $procentTrue = '', $statusTrue = '')
    {
        $userProblem = UserProblem::model()->findByPk($id_problem);
        $userProblem->procent = $procentTrue;
        $userProblem->status = $statusTrue;
        $userProblem->date = time();
        $userProblem->update();
        $this->updateUser($procentTrue);
    }

    /**
     * Обновить даные по кредиту
     * @param type $procentTrue
     * @return type
     */
    private function updateUser($procentTrue)
    {
        $id = (int) Yii::app()->user->id;
        $user = User::model()->findByPk($id);
        if ($procentTrue >= 75 && $procentTrue < 100) {
            $credit = $user->credit + 1;
        } elseif ($procentTrue == 100) {
            $credit = $user->credit + 2;
        } else {
            $credit = $user->credit;
        }
        $user->credit = $credit;
        $user->update();

        return $user;
    }

    /**
     * получаем категорию для просмотра статистики
     */
    private function categoryExem($pk = '')
    {
        $classroom = Classroom::model()->findByPk($pk);
        return $classroom['id_education'];
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

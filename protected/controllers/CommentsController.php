<?php

class CommentsController extends Controller {

    public function __construct($id, $module = null) {
        parent::__construct($id, $module);
        if (Yii::app()->user->isGuest) {
            $this->redirect('/registration');
        }
    }

    /**
     * добавляем новый комментариц
     */
    public function actionAddComment() {
        $id_user = Yii::app()->user->id;
        $id_page = Yii::app()->request->getParam('id_page');
        $id_parent = Yii::app()->request->getParam('id_parent');
        $text = trim(strip_tags(Yii::app()->request->getParam('message')));
        if ($text == '' || !isset($text)) {
            header('Content-type: application/json');
            echo json_encode(array('success' => 0));
            Yii::app()->end();
        } else {
            $comments = new Comments();
            $comments->id_user = $id_user;
            $comments->id_page = $id_page;
            $comments->id_parent = $id_parent;
            $comments->text = $text;
            $comments->like = 0;
            $comments->notlike = 0;
            $comments->date = time();
            $comments->save();
            //  отправить уведомление админу
            header('Content-type: application/json');
            echo json_encode(array('success' => 1, 'id' => $comments->id));
            Yii::app()->end();
        }
    }

    /**
     * Лайк для коммментария
     */
    public function actionAddLikeComment() {
        $id_user = Yii::app()->user->id;
        $id = Yii::app()->request->getParam('id');
        if ($id == '' || !isset($id)) {
            header('Content-type: application/json');
            echo json_encode(array('success' => 0, 'id' => $id));
            Yii::app()->end();
        } else {
            $comments = Comments::model()->findByPk($id);
            $comments->like = $comments->like + 1;
            $comments->update();
            $like = $comments->like - $comments->notlike;
            if ($like > 0) {
                $like = '+' . $like;
            }
            $this->addUserCommentsTable($id_user, $id, 1);
            //  отправить уведомление админу
            header('Content-type: application/json');
            echo json_encode(array('success' => 1, 'id' => $id, 'like' => $like, 'like1' => $comments->like));
            Yii::app()->end();
        }
    }

    /**
     * Дізлайк для комментария
     */
    public function actionAddDislikeComment() {
        $id_user = Yii::app()->user->id;
        $id = Yii::app()->request->getParam('id');
        if ($id == '' || !isset($id)) {
            header('Content-type: application/json');
            echo json_encode(array('success' => 0, 'id' => $id));
            Yii::app()->end();
        } else {
            $comments = Comments::model()->findByPk($id);
            $comments->notlike = $comments->notlike + 1;
            $comments->update();
            $like = $comments->like - $comments->notlike;
            if ($like > 0) {
                $like = '+' . $like;
            }
            $this->addUserCommentsTable($id_user, $id, 0);
            //  отправить уведомление админу
            header('Content-type: application/json');
            echo json_encode(array('success' => 1, 'id' => $id, 'like' => $like, 'notlike' => $comments->notlike));
            Yii::app()->end();
        }
    }

    private function addUserCommentsTable($id_user = '', $id_comment = '', $like = '') {
        $comments = new CommentsUser();
        $comments->id_user = $id_user;
        $comments->id_comments = $id_comment;
        $comments->like = $like;
        $comments->save();
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

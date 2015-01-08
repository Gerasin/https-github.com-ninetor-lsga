<?php

class FeedbackController extends Controller {

    public function actionIndex() {
        $id_user = Yii::app()->user->id;
        $message = Yii::app()->request->getParam('message');
        if ($message == '' || !isset($message)) {
            header('Content-type: application/json');
            echo json_encode(array('success' => 0));
            Yii::app()->end();
        } else {
            $feedback = new Feedback();
            $feedback->id_user = $id_user;
            $feedback->message = strip_tags($message);
            $feedback->date = time();
            $feedback->save();
            //  отправить уведомление админу
            $mail = Yii::app()->mail_manager->sendFeedbackUser($feedback->id_user,  $feedback->message);
            header('Content-type: application/json');
            echo json_encode(array('success' => 1, 'id' => $feedback->id));
            Yii::app()->end();
        }
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

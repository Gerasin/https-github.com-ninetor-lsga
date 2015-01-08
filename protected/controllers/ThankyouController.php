<?php

class ThankyouController extends Controller {

    public function actionIndex() {
        $id_user = Yii::app()->user->id;
        $user = Thankyou::model()->findAllByAttributes(array('id_user' => $id_user));
        if (count($user) > 0||!isset($user)) {
             header('Content-type: application/json');
            echo json_encode(array('success' => 0));
            Yii::app()->end();
        } else {
            $thankyou = new Thankyou();
            $thankyou->id_user = $id_user;
            $thankyou->thank = 1;
            $thankyou->date = time();
            $thankyou->save();
            $count = Thankyou::model()->findAll();
            $count = 'Cказали спасибо ' . count($count) . ' человек';
            header('Content-type: application/json');
            echo json_encode(array('success' => 1, 'id' => $thankyou->id, 'count' => $count));
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

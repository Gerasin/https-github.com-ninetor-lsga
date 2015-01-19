<?php

class DynoReservationController extends Controller
{

    public $layout = '//layouts/inner';

    public function actionIndex()
    {
        $auto_brands = AutoBrands::model()->findAll();
        $auto_models = AutoModels::model()->findAllByAttributes(array('brand_id' => $auto_brands[0]['id']));
        $dyno_works = DynoWorks::model()->findAll(array("order" => "position ASC"));
        $this->render('index', array('auto_brands' => $auto_brands, 'auto_models' => $auto_models, 'dyno_works' => $dyno_works));
    }

    /**
     *  подгружаем модели выбранной марки 
     */
    public function actionselectAutoModels()
    {
        $brands_id = Yii::app()->request->getPost('brands_id');
        if (!empty($brands_id)) {
            $auto_models = AutoModels::model()->findAllByAttributes(array('brand_id' => $brands_id));
            if (count($auto_models) > 0) {
                $foreach = '';
                foreach ($auto_models as $value) {
                    $foreach.= '<option value="' . $value->id . '">' . $value->name . '</option>';
                }
            }
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 1, 'auto_models' => $foreach));
            Yii::app()->end();
        } else {
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 0));
            Yii::app()->end();
            die;
        }
    }

    /**
     *  валидация формы на первом этапе
     */
    public function actionDynoReservationStep1()
    {
        $post = Yii::app()->request->getPost('reservation');
        $form = new ReservationForm();
        $form->attributes = $post;
        if (!$form->validate()) {
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 0, 'error' => $form->getErrors()));
            Yii::app()->end();
        } else {
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 1));
            Yii::app()->end();
        }
    }

    /**
     * вывод календаря для выбора даты и времени регистрации
     */
    public function actionStep2()
    {
        $seconds_in_a_day = 86400;
        $next = strtotime("next Sunday");
        // Get date for 7 days from Monday (inclusive)
        for ($i = 0; $i < 7; $i++) {
            $dates_next[$i] = $next + ($seconds_in_a_day * $i); // следующая неделя
            echo date('d.m.Y', $dates_next[$i]).'</br>';
        }
        die;
        $post = Yii::app()->request->getPost('reservation');
        Yii::app()->cache->set('reservation.name', $post['name']);
        Yii::app()->cache->set('reservation.email', $post['email']);
        Yii::app()->cache->set('reservation.phone', $post['phone']);
        Yii::app()->cache->set('reservation.auto_brands', $post['auto_brands']);
        Yii::app()->cache->set('reservation.auto_models', $post['auto_models']);
        Yii::app()->cache->set('reservation.displacement', $post['displacement']);
        Yii::app()->cache->set('reservation.reserv', $post['reserv']);

// получить текущие даты
        
        $this->render('step2', array('auto_brands' => '1'));
    }

    //echo Yii::app()->cache->get('reservation.name') . '</br>';
    // Yii::app()->cache->delete('reservation.name');

    /**
     * вывод окончательных данных для подтвеждения
     */
    public function actionStep3()
    {
        die;
        $auto_brands = AutoBrands::model()->findAll();
        $auto_models = AutoModels::model()->findAllByAttributes(array('brand_id' => $auto_brands[0]['id']));
        $dyno_works = DynoWorks::model()->findAll(array("order" => "position ASC"));
        $this->render('step3', array('auto_brands' => $auto_brands, 'auto_models' => $auto_models, 'dyno_works' => $dyno_works));
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
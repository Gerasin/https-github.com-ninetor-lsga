<?php

class DynoReservationController extends Controller
{

    public $layout = '//layouts/inner';

    public function actionIndex()
    {
        $auto_brands = AutoBrands::model()->findAll();
        if (!empty($auto_brands[0]['id'])) {
            $auto_models = AutoModels::model()->findAllByAttributes(array('brand_id' => $auto_brands[0]['id']));
        } else {
            $auto_models = NULL;
        }
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
        $post = Yii::app()->request->getPost('reservation');
        if (!empty($post)) {
            Yii::app()->cache->set('reservation.name', $post['name']);
            Yii::app()->cache->set('reservation.email', $post['email']);
            Yii::app()->cache->set('reservation.phone', $post['phone']);
            Yii::app()->cache->set('reservation.auto_brands', $post['auto_brands']);
            if (!empty($post['auto_models'])) {
                Yii::app()->cache->set('reservation.auto_models', $post['auto_models']);
            }
            Yii::app()->cache->set('reservation.displacement', $post['displacement']);
            Yii::app()->cache->set('reservation.reserv', $post['reserv']);
            $dynoWork = DynoWorks::model()->findByPk($post['reserv']);

            $thisTime = time();
            $hours = 3600;
            $startTime = 9;
            $finishTime = 21;
            $stepTime = $dynoWork->time;
            $stepTimeMinut = $dynoWork->minuts;
            $myTime = $stepTime * $hours + $stepTimeMinut * 60; // продолжительность вида работы
            $countStepTime = $stepTime . '.' . $stepTimeMinut;
            $timeDayWeek = ($finishTime - $startTime) / $countStepTime;

            //текущая неделя
            $dayWeek[1] = $thisTime - (date("N") - 1) * 24 * 60 * 60;
            $dayWeek[2] = $thisTime - (date("N") - 2) * 24 * 60 * 60;
            $dayWeek[3] = $thisTime - (date("N") - 3) * 24 * 60 * 60;
            $dayWeek[4] = $thisTime - (date("N") - 4) * 24 * 60 * 60;
            $dayWeek[5] = $thisTime - (date("N") - 5) * 24 * 60 * 60;

            foreach ($dayWeek as $key => $value) {
                $day = date("d", $value);
                $month = date("m", $value);
                $year = date("Y", $value);
                $startTimeDay = mktime($startTime, '0', '0', $month, $day, $year);
                $finishTimeDay = mktime($finishTime, '0', '0', $month, $day, $year);
                for ($i = 0; $i < $timeDayWeek; $i++) {
                    $startTimeWork = $startTimeDay + ($myTime * $i);
                    $finishTimeWork = $startTimeWork + ($hours * $stepTime) + ($stepTimeMinut * 60);
                    if ($finishTimeWork > $finishTimeDay) {
                        break;
                    }
                    if ($startTimeWork > $thisTime && $finishTimeWork <= $finishTimeDay) {
                        //echo date("d.m.Y H:i:s", $startTimeWork) . '--' . date("d.m.Y H:i:s", $finishTimeWork) . '</br>';

                        if ($this->timeInDB($startTimeWork, $finishTimeWork)) {
                            $timetable[$i][$key]['startTimeWork'] = FALSE;
                            $timetable[$i][$key]['finishTimeWork'] = FALSE; //                     
                        } else {
                            $timetable[$i][$key]['startTimeWork'] = $startTimeWork;
                            $timetable[$i][$key]['finishTimeWork'] = $finishTimeWork;
                        }
                    } else {
                        //echo $key . 'Недоступно ' . date("d.m.Y H:i:s", time()) . '</br>';
                        $timetable[$i][$key]['startTimeWork'] = FALSE;
                        $timetable[$i][$key]['finishTimeWork'] = FALSE;
                    }
                }
                // echo '</br></br>';
            }

            $this->render('step2', array('dayWeek' => $dayWeek, 'timetable' => $timetable));
        } else {
            $this->redirect('/dyno-reservation');
        }
    }

    /**
     * сверем значения с теми что в базе
     */
    private function timeInDB($start = '', $finish = '')
    {
        $dyno_reservation = DynoReservation::model()->findAll();
        if (count($dyno_reservation) > 0) {
            foreach ($dyno_reservation as $value) {
                $startDB = $value['date_reservation'];
                $finishDB = $value['time_reservation'];
                if (($start >= $startDB && $start < $finishDB) || ($finish > $startDB && $finish <= $finishDB) || ($startDB >= $start && $startDB < $finish) || ($finishDB > $start && $finishDB <= $finish)) {
                    return TRUE;
                    die;
                }
            }
        } else {
            return FALSE;
        }
    }

    //echo Yii::app()->cache->get('reservation.name') . '</br>';
    // Yii::app()->cache->delete('reservation.name');
    /**
     * Выбрано время для проведения работ в диноценте, отоюражение результата
     */
    public function actionDynoReservationTimeVariant()
    {
        $start = Yii::app()->request->getPost('start');
        $finish = Yii::app()->request->getPost('finish');
        if (empty($start) && empty($finish)) {
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 0, 'error' => $form->getErrors()));
            Yii::app()->end();
        } else {
            $textResult = 'Вы выбрали время c <strong>' . date("H:i", $start) . '</strong> до <strong>' . date("H:i", $finish) . '</strong>, <strong>' . Yii::app()->dateFormatter->formatDayInWeek("cccc", $finish) . ' ' . Yii::app()->dateFormatter->format('d MMMM yyyy', $finish) . '</strong>';
            Yii::app()->cache->set('reservation.start', $start);
            Yii::app()->cache->set('reservation.finish', $finish);
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 1, 'textResult' => $textResult));
            Yii::app()->end();
        }
    }

    /**
     * вывод окончательных данных для подтвеждения
     */
    public function actionStep3()
    {
        $finish = Yii::app()->request->getPost('finish');
        if ($finish == 1) {
            $reservation = $this->datata();
            $auto_brands = AutoBrands::model()->findByPk($reservation['auto_brands']);
            $auto_models = AutoModels::model()->findByPk($reservation['auto_models']);
            $dyno_works = DynoWorks::model()->findByPk($reservation['reserv']);
            if (!$reservation['name']) {
                $this->redirect('/dyno-reservation');
                die;
            }
            $this->render('step3', array('reservation' => $reservation, 'auto_brands' => $auto_brands, 'auto_models' => $auto_models, 'dyno_works' => $dyno_works));
        } else {
            $this->redirect('/dyno-reservation');
        }
    }

    /**
     * Записываем данные из памяти в масиив
     * @return type
     */
    private function datata()
    {
        $reservation['name'] = Yii::app()->cache->get('reservation.name');
        $reservation['email'] = Yii::app()->cache->get('reservation.email');
        $reservation['phone'] = Yii::app()->cache->get('reservation.phone');
        $reservation['auto_brands'] = Yii::app()->cache->get('reservation.auto_brands');
        $reservation['auto_models'] = Yii::app()->cache->get('reservation.auto_models');
        $reservation['displacement'] = Yii::app()->cache->get('reservation.displacement');
        $reservation['reserv'] = Yii::app()->cache->get('reservation.reserv');
        $reservation['finish'] = Yii::app()->cache->get('reservation.finish');
        $reservation['start'] = Yii::app()->cache->get('reservation.start');
        return $reservation;
    }

    /**
     * Сохраняем данные о резервации и очистим память
     */
    public function actionStepFinish()
    {
        $reservation = $this->datata();
        $auto_brands = AutoBrands::model()->findByPk($reservation['auto_brands']);
        $auto_models = AutoModels::model()->findByPk($reservation['auto_models']);

        if (!empty($reservation['name'])) {
            $dynoReservation = new DynoReservation();
            $dynoReservation->name = $reservation['name'];
            $dynoReservation->email = $reservation['email'];
            $dynoReservation->phone = $reservation['phone'];
            $dynoReservation->auto_brands = $auto_brands['name'];
            $dynoReservation->auto_models = $auto_models['name'];
            $dynoReservation->displacement = $reservation['displacement'];
            $dynoReservation->dyno_works_id = $reservation['reserv'];
            $dynoReservation->date_reservation = $reservation['start'];
            $dynoReservation->time_reservation = $reservation['finish'];
            $dynoReservation->create = time();
            $dynoReservation->save();
            // отправить письмо админу и пользователю
        }

        Yii::app()->cache->delete('reservation.name');
        Yii::app()->cache->delete('reservation.email');
        Yii::app()->cache->delete('reservation.phone');
        Yii::app()->cache->delete('reservation.auto_brands');
        Yii::app()->cache->delete('reservation.auto_models');
        Yii::app()->cache->delete('reservation.displacement');
        Yii::app()->cache->delete('reservation.reserv');
        Yii::app()->cache->delete('reservation.finish');
        Yii::app()->cache->delete('reservation.start');

        header('Content-type: application/json');
        echo CJSON::encode(array('success' => 1, 'textResult' => 'ok'));
        Yii::app()->end();
    }

}
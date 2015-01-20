<?php

class ClassroomController extends Controller
{

    public function actionIndex()
    {
        $classroom = Classroom::model()->findByAttributes(array('id_class' => $id));
        $this->render('index', array('classroom' => $classroom));
    }

}

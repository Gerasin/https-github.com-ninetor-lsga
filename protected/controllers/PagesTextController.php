<?php

class PagesTextController extends Controller {

    public $layout = '//layouts/inner';

    public function actionAbout() {
        $about = PagesText::model()->findByPk(1);
        $this->render('about', array('about' => $about));
    }

    public function actionContacts() {
        $contacts = PagesText::model()->findByPk(3);
        $array = array('x', 'y');
        $settings = Settings::model()->findAllByAttributes(array('category' => $array));
        $this->render('contacts', array('contacts' => $contacts, 'settings' => $settings));
    }

    public function actionDealers() {
        $dealers = PagesText::model()->findByPk(2);
        $this->render('dealers', array('dealers' => $dealers));
    }
    public function actionSitemap() {        
        $this->render('sitemap');
    }

    public function actionMessageUser() {
        $form = new MessagesForm();
        $form->attributes = Yii::app()->request->getPost('message');
        if (!$form->validate()) {
            header('Content-type: application/json');
            echo json_encode(array('success' => 0, 'error' => $form->getErrors()));
            Yii::app()->end();
        } else {
            $message= new Messages();
            $message->name = $form->name;
            $message->title = Yii::app()->request->getPost('title');
            $message->email = $form->email;
            $message->message = strip_tags($form->message);
            $message->date = time();
            $message->save();
            //  отправить уведомление админу
            $mail = Yii::app()->mail_manager->sendContactUser($message->email, $message->name,  $message->message);
            header('Content-type: application/json');
            echo json_encode(array('success' => 1, 'id' => $message->id));
            Yii::app()->end();
        }
    }

}

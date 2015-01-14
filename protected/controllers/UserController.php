<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserController
 *
 * @author gnesenka
 */
class UserController extends Controller {

    public $layout = '//layouts/inner';

    /**
     *  регистрация пользователя
     */
    public function actionRegistrationUser() {
        $form = new UserRegistration();
        $form->attributes = Yii::app()->request->getPost('user');
        //$form->verifyCode = $_POST['user']['captcha'];
        if (!$form->validate()) {
            $captchaAction = new CCaptcha();
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 0, 'error' => $form->getErrors(), 'captcha' => $captchaAction->renderImageNew()));
            Yii::app()->end();
        } else {
            $user = $this->createUser('user', $form);
            if ($user->id != '') {
                Yii::app()->user->setId($user->id);
                Yii::app()->user->setUserObj($user);
                $mail = Yii::app()->mail_manager->sendRegistrationUser($user->email, $form->password, $user->name, $user->title);
                header('Content-type: application/json');
                echo json_encode(array('success' => 1));
                Yii::app()->end();
            } else {
                header('Content-type: application/json');
                echo CJSON::encode(array('success' => 0, 'error' => $form->getErrors()));
                Yii::app()->end();
            }
        }
    }

    public function actionRegistation() {

        if (Yii::app()->user->isGuest) {
            $this->render('registration', array(
                'captcha' => array(
                    'class' => 'CCaptchaAction',
            )));
        } else {
            header('Location: /', true, 307);
        }
    }

    public function actionLogin() {
        if (Yii::app()->user->isGuest) {
            $this->render('login');
        } else {
            header('Location: /', true, 307);
        }
    }

    public function actions() {
        return array(
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xEBF4FB,
                'testLimit' => 1
            ),
        );
    }

    /**
     * проверяем на уникальность введенный ник пользователя
     */
    public function actionRegistrationNick() {
        $name = Yii::app()->request->getPost('name');

        if (User::model()->check_name($name)) {
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 1, 'error' => 1));
            Yii::app()->end();
        } else {
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 0, 'error' => 2));
            Yii::app()->end();
        }
    }

    public function actionLoginForm() {
        //echo CJSON::encode(array('success' => 0, 'error' => Yii::app()->request->getPost('login'))); die;
        $post = Yii::app()->request->getPost('login');
        $form = new LoginForm();
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

    public function actionLogout() {
        $user = User::model()->findByPk(Yii::app()->user->getId());
        if ($user) {
            $user->last_time = time();
            $user->update();
        }
        Yii::app()->user->logout();
        $this->redirect("/");
    }

    private function createUser($role, UserRegistration $form) {

        $user = new User();
        $user->name = $form->name;
        $user->email = $form->email;
        $user->phone = $form->phone;
        $user->role = $role;
        $user->password = crypt($form->password);
        $user->last_time = time();
        $user->created = time();
        $user->save();

        return $user;
    }

    public function actionUserPasswordRecovery() {
        $email = Yii::app()->request->getParam('email');
        if (!User::model()->validate_email($email)) {
            $response = array('success' => 0, 'error' => 'Вы ввели не правильный андрес эл. почты');

            header('Content-type: application/json');
            echo json_encode($response);
            Yii::app()->end();
        }
        $user = User::model()->findByAttributes(array('email' => $email));
        if (empty($user)) {
            $response = array('success' => 0, 'error' => 'Пользователь с такой почтой не найден');

            header('Content-type: application/json');
            echo json_encode($response);
            Yii::app()->end();
        } else {
            $new_password = $user->id . uniqid();
            $user->password = crypt($new_password);
            $user->update();

            $mail = Yii::app()->mail_manager->sendPasswordRecovery($new_password, $user->email);

            $response = array('success' => 1, 'new_password' => $new_password);

            header('Content-type: application/json');
            echo json_encode($response);
            Yii::app()->end();
        }
    }

}

?>

<?php

/**
 * Description of ProfileController
 *
 * @author gnesenka
 */
class ProfileController extends Controller
{

    public $layout = '//layouts/inner';

    public function __construct($id, $module = null)
    {
        parent::__construct($id, $module);
        if (Yii::app()->user->isGuest) {
            $this->redirect('/registration');
        }
    }

    public function actionProfileSettings()
    {
        $id = (int) Yii::app()->user->id;
        $user = User::model()->findByPk($id);

        if (!empty($_POST['User'])) {
            var_dump('asd');
            die;
        }

        $this->render('settings', array('user' => $user));
    }

    public function actionProfileUpdate()
    {
        $form = new UserUpdate();
        $form->attributes = Yii::app()->request->getPost('user');

        if (!$form->validate()) {
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 0, 'error' => $form->getErrors()));
            Yii::app()->end();
        } else {

            $user = $this->updateUser($form);
            if ($user->id != '') {
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

    private function updateUser($form)
    {
        $id = (int) Yii::app()->user->id;
        $user = User::model()->findByPk($id);
        $user->email = $form->email;
        $user->phone = $form->phone;
        $user->title = $form->title;
        $user->country = $form->country;
        $user->city = $form->city;
        if (isset($form->password) && $form->password != NULL) {
            $user->password = crypt($form->password);
            // отправить письмо на почту с новый паролем
            $mail = Yii::app()->mail_manager->sendNewPassword($form->password, $form->email);
        }
        $user->street = $form->street;
        $user->house = $form->house;
        $user->postcode = $form->postcode;
        $user->apartment = $form->apartment;
        //$user->bdate = strtotime($form->bdate);
        $user->bdate = $form->bdate;
        $user->update();

        return $user;
    }

    /**
     * image
     */
    public function actionProfileUpdateImg()
    {
        $fileName = 'fileToUpload';
        $imageError = $this->addImageFormError($fileName);
        if ($imageError != false) {
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 0, 'error' => $imageError));
            Yii::app()->end();
        } else {
            $nameImage = FALSE;
            if (!empty($_FILES[$fileName]['tmp_name'])) {
                $nameImage = 'pages' . time() . '.jpg';
                $image = $this->addImageForm($fileName, 50, 50, 'users/temp', $nameImage);
                $image = $this->addImageForm($fileName, 34, 34, 'users/_temp', $nameImage);
                $image = $this->addImageForm($fileName, 110, 140, 'users', $nameImage);
            }
            $id = (int) Yii::app()->user->id;
            $user = User::model()->findByPk($id);
            if ($nameImage) {
                $user->img = $nameImage;
            }
            $user->update();
            header('Content-type: application/json');
            echo json_encode(array('success' => 1, 'image' => "background: url('/upload/images/users/" . $nameImage . "')  no-repeat;"));
            Yii::app()->end();
        }
    }

    /**
     * Загружаем картинку на сервер
     * @param type $fileName
     * @param type $toWidth
     * @param type $toHeight
     * @param type $toDirectory
     * @return string
     */
    private function addImageForm($fileName, $toWidth, $toHeight, $toDirectory, $nameImage)
    {
        if (!empty($_FILES[$fileName]['tmp_name'])) {
            //$nameImage = 'education' . time() . '.jpg';
            $ih = new CImageHandler();
            Yii::app()->ih
                    ->load($_FILES[$fileName]['tmp_name'])
                    ->adaptiveThumb($toWidth, $toHeight)
                    ->save($_SERVER['DOCUMENT_ROOT'] . '/upload/images/' . $toDirectory . '/' . $nameImage);
            return $nameImage;
        }
    }

    /**
     * Проверяем данные картинки
     * 
     * @param type $fileName
     * @return type
     */
    private function addImageFormError($fileName)
    {
        if (!empty($_FILES[$fileName]['tmp_name'])) {
            return Education::model()->imageFormValidate($_FILES[$fileName]);
        }
    }

}

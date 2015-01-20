<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminUserController
 *
 */
class AdminUserController extends AdminController
{

    public function actionIndex()
    {
        $users = User::model()->findAll();
        $this->render('users', array('users' => $users));
    }

    public function actionUserDetail()
    {
        $id = (int) Yii::app()->request->getParam('id');
        $user = User::model()->findByPk($id);

        $this->render('user', array('user' => $user));
    }

    /**
     * 
     * @return type
     */
    public function actionUserEdit()
    {
        $id = (int) Yii::app()->request->getParam('id');
        $user = User::model()->findByPk($id);

        $this->render('edit', array('user' => $user));
    }

    /*
     * edit user
     */

    public function actionUserUpdate()
    {
        $user_id = (int) Yii::app()->request->getParam('id');
        $form = new UserUpdate();
        $form->attributes = Yii::app()->request->getPost('user');
        //echo json_encode(array('success' => 1, 'data' => $user_id));
        //die;
        $fileName = 'fileToUpload';
        $imageError = $this->addImageFormError($fileName, 330, 240, 'users/temp');
        if (!$form->validate() && !$imageError) {
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 0, 'error' => $form->getErrors()));
            Yii::app()->end();
        } else {
            if (!empty($_FILES[$fileName]['tmp_name'])) {
                $nameImage = 'pages' . time() . '.jpg';
                $image = $this->addImageForm($fileName, 50, 50, 'users/temp', $nameImage);
                $image = $this->addImageForm($fileName, 34, 34, 'users/_temp', $nameImage);
                $image = $this->addImageForm($fileName, 110, 140, 'users', $nameImage);
            }
            $user = $this->updateUser($form, $user_id, $nameImage);
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

    private function updateUser($form, $id, $nameImage)
    {
        //$id = (int) Yii::app()->user->id;
        $user = User::model()->findByPk($id);
        $user->email = $form->email;
        $user->phone = $form->phone;
        $user->title = $form->title;
        $user->country = $form->country;
        $user->city = $form->city;
        if (isset($form->password) && $form->password != NULL) {
            $user->password = crypt($form->password);
            // отправить письмо на почту с новый паролем
        }
        $user->street = $form->street;
        $user->house = $form->house;
        $user->postcode = $form->postcode;
        $user->apartment = $form->apartment;
        $user->bdate = $form->bdate;
        if (!empty($nameImage)) {
            $user->img = $nameImage;
        }
        $user->update();

        return $user;
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
     * @param type $toWidth
     * @param type $toHeight
     * @param type $toDirectory
     * @return type
     */
    private function addImageFormError($fileName, $toWidth, $toHeight, $toDirectory)
    {
        if (!empty($_FILES[$fileName]['tmp_name'])) {
            return Education::model()->imageFormValidate($_FILES[$fileName]);
        }
    }

    public function actionDeleteUser()
    {
        $id = Yii::app()->request->getParam('id');
        $user = User::model()->findByPk($id);
        $user->delete();
        CommentsUser::model()->deleteAll('id_user=' . $id);
        Comments::model()->deleteAll('id_user=' . $id);

        $this->redirect($this->createUrl('/administration/users'));
    }

    public function accessRules()
    {
        return array(
            array(
                'allow',
                'roles' => array('administrator'),
                'actions' => array(),
            ),
            array('deny'),
        );
    }

}

?>

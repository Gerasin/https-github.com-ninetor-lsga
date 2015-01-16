<?php

/**
 * Created by PhpStorm.
 * User: roman
 * Date: 12.01.15
 * Time: 18:22
 */
class AdminMethods extends CApplicationComponent
{

    public static function checkImage($fileName)
    {
        if (!empty($_FILES[$fileName]['name'])) {
            if (!empty($_FILES[$fileName]['tmp_name'])) {
                return self::imageFormValidate($_FILES[$fileName]);
            }
            else
                return 'Невозможно загрузить выбранный файл! Попробуйте загрузить файл меньшего размера!';
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
    public static function addImageForm($fileName, $toWidth, $toHeight, $toDirectory, $nameImage)
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

    private static function imageFormValidate($param)
    {
        $error = false;
        if (!empty($param['error'])) {
            switch ($param['error']) {

                case '1':
                    $error = 'размер загруженного файла превышает размер установленный параметром upload_max_filesize  в php.ini ';
                    break;
                case '2':
                    $error = 'размер загруженного файла превышает размер установленный параметром MAX_FILE_SIZE в HTML форме. ';
                    break;
                case '3':
                    $error = 'загружена только часть файла ';
                    break;
                case '4':
                    $error = 'файл не был загружен (Пользователь в форме указал неверный путь к файлу). ';
                    break;
                case '6':
                    $error = 'неверная временная дирректория';
                    break;
                case '7':
                    $error = 'ошибка записи файла на диск';
                    break;
                case '8':
                    $error = 'загрузка файла прервана';
                    break;
                case '999':
                default:
                    $error = 'No error code avaiable';
            }
        } elseif (empty($param['tmp_name']) || $param['tmp_name'] == 'none') {
            $error = 'No file was uploaded..';
        } else {
            $allowedTypes = array('image/gif', 'image/png', 'image/jpg', 'image/jpeg');
            if (!in_array($param['type'], $allowedTypes)) {
                $error = "Формат файла должен быть JPG, PNG или GIF";
            }
        }
        return $error;
    }

    public static function addAnsTable($ans, $id_problem, $status)
    {
        foreach ($ans as $value) {
            $new_ans = new Ans();
            $new_ans->id_problem = $id_problem;
            $new_ans->text = $value;
            $st = ($ans[$status] == $value) ? 1 : NULL;
            $new_ans->status = $st;
            $new_ans->save();
            if ($st == 1) {
                $problem = Problem::model()->findByPk($id_problem);
                $problem->status_ans = $new_ans->id;
                $problem->update();
            }
        }
    }

    public static function processLessonFormUpdate($form, $id, $active, $id_class)
    {
        $lesson = Lesson::model()->findByPk($id);
        $lesson->name = $form->name;
        $lesson->description = $form->description;
        $lesson->id_class = $id_class;
        $lesson->active = $active;
        $lesson->update();
    }

    public static function userFeeback($id_user = '')
    {
        $user = User::model()->findByPk($id_user);
        if (!empty($user)) {
            return $user->name;
        } else {
            return NULL;
        }
    }

    public static function processCategoryFormUpdate($form)
    {
        $id = Yii::app()->request->getParam('id');
        $category = Category::model()->findByPk($id);
        $category->name = $form->name;
        $category->description = $form->description;
        $category->active = Yii::app()->request->getParam('active');
        $category->update();
    }

    /**
     *  получим id родительско категории
     */
    public static function parentIdCategory($id = '')
    {
        $properties = CategoryProperties::model()->findByPk($id);
        return $properties->id_category;
    }

    /**
     *  записываем все свойства страницы
     */
    public static function addAllPropertisPages($propertis = '', $id_page = '')
    {
        foreach ($propertis as $value) {
            $pages = new PagesProperties();
            $pages->id_pages = $id_page;
            $pages->id_propertie = $value;
            $pages->save();
        }
    }

    public static function deleteAllPropertisPages($id_page = '')
    {
        $pages = PagesProperties::model()->findAllByAttributes(array('id_pages' => $id_page));
        foreach ($pages as $value) {
            $properties = PagesProperties::model()->findByPk($value->id);
            $properties->delete();
        }
    }

    /**
     * КОММЕНТАРИИ
     */
    public static function coutPagesComments($pages = '')
    {
        foreach ($pages as $value) {
            $comm = Comments::model()->findAllByAttributes(array('id_page' => $value->id));
            $mas[$value->id] = count($comm);
        }
        return $mas;
    }

    public static function allCommentsNotPages()
    {
        $comments = FALSE;
        $commNo = Comments::model()->findAllByAttributes(array('id_parent' => null), array("order" => "date ASC"));
        foreach ($commNo as $value) {
            $comments[$value->id]['id'] = $value->id;
            $comments[$value->id]['text'] = $value->text;
            $comments[$value->id]['date'] = $value->date;
            $comments[$value->id]['like'] = $value->like;
            $comments[$value->id]['notlike'] = $value->notlike;
            $comments[$value->id]['children'] = self::allCommentsNotPageChildren($value->id);
            $user = User::model()->findByPk($value->id_user);
            $comments[$value->id]['user_name'] = $user->title;
            $comments[$value->id]['user_id'] = $user->id;
            $comments[$value->id]['id_page'] = $value->id_page;
        }
        return $comments;
    }

    // дочерние комментарии
    public static function allCommentsNotPageChildren($id_parent = '')
    {
        $comments = FALSE;
        $commNo = Comments::model()->findAllByAttributes(array('id_parent' => $id_parent), array("order" => "date ASC"));
        foreach ($commNo as $value) {
            $comments[$value->id]['id'] = $value->id;
            $comments[$value->id]['id_page'] = $value->id_page;
            $comments[$value->id]['text'] = $value->text;
            $comments[$value->id]['id_parent'] = $value->id_parent;
            $comments[$value->id]['date'] = $value->date;
            $comments[$value->id]['like'] = $value->like;
            $comments[$value->id]['notlike'] = $value->notlike;
            $user = User::model()->findByPk($value->id_user);
            $comments[$value->id]['user_name'] = $user->title;
            $comments[$value->id]['user_id'] = $user->id;
        }
        return $comments;
    }

    public static function allCommentsPages($id_page = '')
    {
        $comments = FALSE;
        $commNo = Comments::model()->findAllByAttributes(array('id_parent' => null, 'id_page' => $id_page), array("order" => "date ASC"));
        foreach ($commNo as $value) {
            $comments[$value->id]['id_page'] = $value->id_page;
            $comments[$value->id]['id'] = $value->id;
            $comments[$value->id]['text'] = $value->text;
            $comments[$value->id]['date'] = $value->date;
            $comments[$value->id]['like'] = $value->like;
            $comments[$value->id]['notlike'] = $value->notlike;
            $comments[$value->id]['children'] = self::allCommentsPageChildren($id_page, $value->id);
            $user = User::model()->findByPk($value->id_user);
            $comments[$value->id]['user_name'] = $user->title;
            $comments[$value->id]['user_id'] = $user->id;
        }
        return $comments;
    }

    // дочерние комментарии

    public static function allCommentsPageChildren($id_page = '', $id_parent = '')
    {
        $comments = FALSE;
        $commNo = Comments::model()->findAllByAttributes(array('id_page' => $id_page, 'id_parent' => $id_parent), array("order" => "date ASC"));
        foreach ($commNo as $value) {
            $comments[$value->id]['id_page'] = $value->id_page;
            $comments[$value->id]['id'] = $value->id;
            $comments[$value->id]['text'] = $value->text;
            $comments[$value->id]['id_parent'] = $value->id_parent;
            $comments[$value->id]['date'] = $value->date;
            $comments[$value->id]['like'] = $value->like;
            $comments[$value->id]['notlike'] = $value->notlike;
            $user = User::model()->findByPk($value->id_user);
            $comments[$value->id]['user_name'] = $user->title;
            $comments[$value->id]['user_id'] = $user->id;
        }
        return $comments;
    }

    public static function processPostFormUpdate($form, $id, $image, $additional_photos, $isNew)
    {
        $post = (!$isNew) ? MainPosts::model()->findByPk($id) : new MainPosts();
        if ($isNew)
            $post->block_id = $id;
        $post->name = $form->name;
        $post->url = $form->url;
        if ($additional_photos)
            $post->additional_photos = $additional_photos;
        if (isset($image)) {
            $post->photo = $image;
        }
        return (!$isNew) ? $post->update() : $post->save();
    }

}
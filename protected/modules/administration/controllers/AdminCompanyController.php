<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminCompanyController
 */
class AdminCompanyController extends AdminController {

    public function actionIndex() {
        $presentations = CompanyPresentation::model()->findAll();
        $this->render('index', array('presentations' => $presentations));
    }

    public function actionAddAboutCompany() {
        $form = new CompanyPresentation();
        $this->processAboutCompanyForm($form);
    }

    public function actionEditAboutCompany() {
        $id = Yii::app()->request->getParam('id');
        $form = CompanyPresentation::model()->findByPk($id);
        $this->processAboutCompanyForm($form);
    }

    private function processAboutCompanyForm($form) {
        if (!empty($_POST['CompanyPresentation'])) {

            $form->attributes = $_POST['CompanyPresentation'];
            $image = CUploadedFile::getInstance($form, 'image');

            if ($image !== null)
                $form->image = $image->name;

            if ($form->validate()) {
                if ($form->save()) {
                    if ($image !== null)
                        $image->saveAs($form->getImageFilesystemPath());

                    $this->redirect($this->createUrl('/administration/company'));
                }
            }
        }


        $this->render('about_company_form', array('form' => $form));
    }

    /**
     * ОБРАЗОВАНИЕ
     */
    public function actionEducation() {
        $education = Education::model()->findAll(array("order" => "position ASC"));
        $this->render('education', array('education' => $education));
    }

    public function actionAddEducation() {
        $form = new EducationForm();
        $this->processEducationFormAdd($form);
    }

    public function actionEditEducation() {
        $id = Yii::app()->request->getParam('id');
        $form = Education::model()->findByPk($id);
        $this->render('education_form', array('education' => $form, 'edit' => 1));
    }

    public function actionUpdateEducation() {

        $form = new EducationForm();
        $form->attributes = Yii::app()->request->getPost('education');
        $imageError = $this->addImageFormError('fileToUpload', 300, 460, 'education');
        if ($form->validate() && !$imageError) {
            $id = Yii::app()->request->getParam('id');
            $nameImage = 'education' . time() . '.jpg';
            $image = $this->addImageForm('fileToUpload', 300, 460, 'education', $nameImage);
            $this->processEducationFormUpdate($form, $id, $image, Yii::app()->request->getParam('active'));

            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 1, 'education_id' => $id));
            Yii::app()->end();
        } else {
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 0, 'error' => $form->getErrors(), 'imageError' => $imageError));
            Yii::app()->end();
        }
    }

    public function actionDeleteEducation() {
        $id = Yii::app()->request->getParam('id');
        $Education = Education::model()->findByPk($id);
        $Education->delete();

        $this->redirect($this->createUrl('/administration/education'));
    }

    private function processEducationFormAdd($form) {
        if (!empty($_POST['education'])) {
            $form->attributes = Yii::app()->request->getPost('education');
            $imageError = $this->addImageFormError('fileToUpload', 300, 460, 'education');

            if ($form->validate() && !$imageError) {
                $nameImage = 'education' . time() . '.jpg';
                $image = $this->addImageForm('fileToUpload', 300, 460, 'education', $nameImage);

                $education = new Education();
                $education->name = $form->name;
                $education->description = $form->description;
                $education->img = $image;
                $education->active = Yii::app()->request->getParam('active');
                $education->position = 0;
                $education->created = time();
                $education->save();

                header('Content-type: application/json');
                echo CJSON::encode(array('success' => 1, 'education_id' => $education->id));
                Yii::app()->end();
                die;
            } else {
                header('Content-type: application/json');
                echo CJSON::encode(array('success' => 0, 'error' => $form->getErrors(), 'imageError' => $imageError));
                Yii::app()->end();
                die;
            }
        } else {
            $this->render('education_form', array('form' => $form));
        }
    }

    private function processEducationFormUpdate($form, $id, $image, $active) {
        $education = Education::model()->findByPk($id);
        $education->name = $form->name;
        $education->description = $form->description;
        if (isset($image)) {
            $education->img = $image;
        }
        $education->active = $active;
        $education->update();
    }

    /**
     * Загружаем картинку на сервер
     * @param type $fileName
     * @param type $toWidth
     * @param type $toHeight
     * @param type $toDirectory
     * @return string
     */
    private function addImageForm($fileName, $toWidth, $toHeight, $toDirectory, $nameImage) {
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
    private function addImageFormError($fileName, $toWidth, $toHeight, $toDirectory) {
        if (!empty($_FILES[$fileName]['tmp_name'])) {
            return Education::model()->imageFormValidate($_FILES[$fileName]);
        }
    }

    /**
     * КЛАССЫ
     */
    public function actionClassroom() {
        if (empty($_GET['id_education']) || $_GET['id_education'] <= 0) {
            $classroom = Classroom::model()->findAll(array("order" => "position ASC"));
        } else {
            $classroom = Classroom::model()->findAllByAttributes(array('id_education' => $_GET['id_education']));
        }
        $education = Education::model()->findAll();
        foreach ($education as $value) {
            $education_mas[$value->id] = $value->name;
        }
        $this->render('classroom', array('classroom' => $classroom, 'educationName' => $education_mas, 'education' => $education));
    }

    public function actionAddClassroom() {
        $form = new ClassroomForm();
        $this->processClassroomFormAdd($form);
    }

    public function actionEditClassroom() {
        $id = Yii::app()->request->getParam('id');
        $form = Classroom::model()->findByPk($id);
        $education = Education::model()->findAll();
        $this->render('classroom_form', array('classroom' => $form, 'education' => $education, 'edit' => 1));
    }

    public function actionUpdateClassroom() {
        $form = new ClassroomForm();
        $form->attributes = Yii::app()->request->getPost('classroom');
        if ($form->validate()) {
            $id = Yii::app()->request->getParam('id');
            $active = Yii::app()->request->getParam('active');
            $id_education = Yii::app()->request->getParam('id_education');
            $this->processClassroomFormUpdate($form, $id, $active, $id_education);

            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 1, 'classroom_id' => $id));
            Yii::app()->end();
        } else {
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 0, 'error' => $form->getErrors()));
            Yii::app()->end();
        }
    }

    public function actionDeleteClassroom() {
        $id = Yii::app()->request->getParam('id');
        $classroom = Classroom::model()->findByPk($id);
        $classroom->delete();

        $this->redirect($this->createUrl('/administration/classroom'));
    }

    private function processClassroomFormAdd($form) {
        if (!empty($_POST['classroom'])) {
            $form->attributes = Yii::app()->request->getPost('classroom');
            if ($form->validate()) {
                $classroom = new Classroom();
                $classroom->name = $form->name;
                $classroom->id_education = Yii::app()->request->getParam('id_education');
                $classroom->active = Yii::app()->request->getParam('active');
                $classroom->position = 0;
                $classroom->created = time();
                $classroom->save();

                header('Content-type: application/json');
                echo CJSON::encode(array('success' => 1, 'classroom_id' => $classroom->id));
                Yii::app()->end();
                die;
            } else {
                header('Content-type: application/json');
                echo CJSON::encode(array('success' => 0, 'error' => $form->getErrors()));
                Yii::app()->end();
                die;
            }
        } else {
            $education = Education::model()->findAll();
            $this->render('classroom_form_add', array('form' => $form, 'education' => $education));
        }
    }

    private function processClassroomFormUpdate($form, $id, $active, $id_education) {
        $classroom = Classroom::model()->findByPk($id);
        $classroom->name = $form->name;
        $classroom->id_education = $id_education;
        $classroom->active = $active;
        $classroom->update();
    }

    /**
     * Вопросы
     */
    public function actionProblem() {
        $id = Yii::app()->request->getParam('id');
        $problem = Problem::model()->findAllByAttributes(array('id_class' => $id));
        $classroom = Classroom::model()->findByPk($id);
        $this->render('problem', array('problem' => $problem, 'classroom' => $classroom, 'classId' => $id));
    }

    public function actionAddProblem() {
        $classId = Yii::app()->request->getParam('id');
        $classroom = Classroom::model()->findAll();
        $this->render('problem_form_add', array('classroom' => $classroom, 'classId' => $classId));
    }

    public function actionProblemFormAdd() {
        if (!empty($_POST['problem'])) {
            $form = new ProblemForm(); // problem form
            $form->attributes = Yii::app()->request->getPost('problem');
            if ($form->validate()) {
                $problem = new Problem();
                $problem->text = $form->text;
                $problem->comment = $form->comment;
                $problem->status_ans = $form->status;
                $problem->id_class = Yii::app()->request->getParam('id_class');
                $problem->save();

                // сохраняем варианты ответа
                $ans = Yii::app()->request->getPost('ans');
                $this->addAnsTable($ans, $problem->id, $form->status);
                header('Content-type: application/json');
                echo CJSON::encode(array('success' => 1, 'problem_id' => $problem->id, 'ans' => $ans));
                Yii::app()->end();
                die;
            } else {
                header('Content-type: application/json');
                echo CJSON::encode(array('success' => 0, 'error' => $form->getErrors()));
                Yii::app()->end();
                die;
            }
        } else {
            $classroom = Classroom::model()->findAll();
            $this->render('lesson_form', array('form' => $form, 'classroom' => $classroom));
        }
    }

    private function addAnsTable($ans, $problem, $status) {
        foreach ($ans as $value) {
            $new_ans = new Ans();
            $new_ans->id_problem = $problem;
            $new_ans->text = $value;
            $st = ($ans[$status] == $value) ? 1 : NULL;
            $new_ans->status = $st;
            $new_ans->save();
            if ($st == 1) {
                $this->newStatusForProblem($problem, $new_ans->id);
            }
        }
    }

    private function newStatusForProblem($id, $andId) {
        $problem = Problem::model()->findByPk($id);
        $problem->status_ans = $andId;
        $problem->update();
    }

    public function actionEditProblem() {
        $id = Yii::app()->request->getParam('id');
        $form = Problem::model()->findByPk($id);
        $classroom = Classroom::model()->findAll();
        $ans = Ans::model()->findAllByAttributes(array('id_problem' => $id));
        $this->render('problem_form', array('problem' => $form, 'classroom' => $classroom, 'ans' => $ans, 'edit' => 1));
    }

    public function actionUpdateProblem() {
        $form = new ProblemForm();
        $form->attributes = Yii::app()->request->getPost('problem');
        if ($form->validate()) {
            $id = Yii::app()->request->getParam('id');

            $problem = Problem::model()->findByPk($id);
            $problem->text = $form->text;
            $problem->comment = $form->comment;
            $problem->id_class = Yii::app()->request->getParam('id_class');
            $problem->update();

            // сохраняем варианты ответа
            $ans = Yii::app()->request->getPost('ans');
            Ans::model()->deleteAllByAttributes(array('id_problem' => $problem->id));
            $this->addAnsTable($ans, $problem->id, $form->status);
            //$this->deleteAnsTable($ans, $problem->id);

            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 1, 'problem_id' => $id));
            Yii::app()->end();
        } else {
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 0, 'error' => $form->getErrors()));
            Yii::app()->end();
        }
    }

    /**
     * УРОКИ
     */
    public function actionLesson() {
        if (empty($_GET['id_classroom']) || $_GET['id_classroom'] <= 0) {
            $lesson = Lesson::model()->findAll(array("order" => "position ASC"));
        } else {
            $lesson = Lesson::model()->findAllByAttributes(array('id_class' => $_GET['id_classroom']));
        }
        $classroom = Classroom::model()->findAll();
        foreach ($classroom as $value) {
            $classroom_mas[$value->id] = $value->name;
        }
        $this->render('lesson', array('lesson' => $lesson, 'classroom' => $classroom, 'classroomName' => $classroom_mas));
    }

    public function actionAddLesson() {
        $form = new LessonForm(); // Lesson form
        $this->processLessonFormAdd($form);
    }

    public function actionEditLesson() {
        $id = Yii::app()->request->getParam('id');
        $form = Lesson::model()->findByPk($id);
        $classroom = Classroom::model()->findAll();
        $this->render('lesson_form', array('lesson' => $form, 'classroom' => $classroom, 'edit' => 1));
    }

    public function actionUpdateLesson() {
        $form = new LessonForm();
        $form->attributes = Yii::app()->request->getPost('lesson');
        if ($form->validate()) {
            $id = Yii::app()->request->getParam('id');
            $active = Yii::app()->request->getParam('active');
            $id_class = Yii::app()->request->getParam('id_class');
            $this->processLessonFormUpdate($form, $id, $active, $id_class);

            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 1, 'lesson_id' => $id));
            Yii::app()->end();
        } else {
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 0, 'error' => $form->getErrors()));
            Yii::app()->end();
        }
    }

    public function actionDeleteLesson() {
        $id = Yii::app()->request->getParam('id');
        $lesson = Lesson::model()->findByPk($id);
        $lesson->delete();

        $this->redirect($this->createUrl('/administration/lesson'));
    }

    private function processLessonFormAdd($form) {
        if (!empty($_POST['lesson'])) {
            $form->attributes = Yii::app()->request->getPost('lesson');
            if ($form->validate()) {
                $lesson = new Lesson();
                $lesson->name = $form->name;
                $lesson->description = $form->description;
                $lesson->id_class = Yii::app()->request->getParam('id_class');
                $lesson->active = Yii::app()->request->getParam('active');
                $lesson->position = 0;
                $lesson->created = time();
                $lesson->save();

                header('Content-type: application/json');
                echo CJSON::encode(array('success' => 1, 'lesson_id' => $lesson->id));
                Yii::app()->end();
                die;
            } else {
                header('Content-type: application/json');
                echo CJSON::encode(array('success' => 0, 'error' => $form->getErrors()));
                Yii::app()->end();
                die;
            }
        } else {
            $classroom = Classroom::model()->findAll();
            $this->render('lesson_form_add', array('lesson' => $form, 'classroom' => $classroom));
        }
    }

    private function processLessonFormUpdate($form, $id, $active, $id_class) {
        $lesson = Lesson::model()->findByPk($id);
        $lesson->name = $form->name;
        $lesson->description = $form->description;
        $lesson->id_class = $id_class;
        $lesson->active = $active;
        $lesson->update();
    }

    public function accessRules() {
        return array(
            array(
                'allow',
                'roles' => array('administrator'),
                'actions' => array(),
            ),
            array('deny'),
        );
    }

    /**
     * Обратная связь
     */
    public function actionFeedback() {
        $feedback = Feedback::model()->findAll();
        foreach ($feedback as $item) {
            $array[$item->id]['id'] = $item->id;
            $array[$item->id]['id_user'] = $item->id_user;
            $array[$item->id]['user'] = $this->userFeeback($item->id_user);
            $array[$item->id]['message'] = $item->message;
            $array[$item->id]['date'] = $item->date;
        }
        $this->render('feedback', array('feedback' => $array));
    }

    private function userFeeback($id_user = '') {
        $user = User::model()->findByPk($id_user);
        return $user->name;
    }

    public function actionDeleteFeeback() {
        $id = Yii::app()->request->getParam('id');
        $feedback = Feedback::model()->findByPk($id);
        $feedback->delete();
        $this->redirect($this->createUrl('/administration/feedback'));
    }

    /**
     * КАТЕГОРИИ
     */
    public function actionCategory() {
        $category = Category::model()->findAll(array("order" => "position ASC"));
        $this->render('category', array('category' => $category));
    }

    public function actionAddCategory() {
        $form = new CategoryForm();
        $this->processCategoryFormAdd($form);
    }

    public function actionEditCategory() {
        $id = Yii::app()->request->getParam('id');
        $form = Category::model()->findByPk($id);
        //$properties = CategoryProperties::model()->findAllByAttributes(array('id_category' => $id));
        $this->render('category_form', array('category' => $form, 'edit' => 1));
    }

    public function actionUpdateCategory() {
        $form = new CategoryForm();
        $form->attributes = Yii::app()->request->getPost('category');
        if ($form->validate()) {
            $id = Yii::app()->request->getParam('id');
            $active = Yii::app()->request->getParam('active');
            $this->processCategoryFormUpdate($form, $id, $active);

            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 1, 'category_id' => $id));
            Yii::app()->end();
        } else {
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 0, 'error' => $form->getErrors()));
            Yii::app()->end();
        }
    }

    public function actionDeleteCategory() {
        $id = Yii::app()->request->getParam('id');
        $category = Category::model()->findByPk($id);
        $category->delete();

        $this->redirect($this->createUrl('/administration/category'));
    }

    private function processCategoryFormAdd($form) {
        if (!empty($_POST['category'])) {
            $form->attributes = Yii::app()->request->getPost('category');
            if ($form->validate()) {
                $category = new Category();
                $category->name = $form->name;
                $category->description = $form->description;
                $category->active = Yii::app()->request->getParam('active');
                $category->position = 0;
                $category->created = time();
                $category->save();

                header('Content-type: application/json');
                echo CJSON::encode(array('success' => 1, 'category_id' => $category->id));
                Yii::app()->end();
                die;
            } else {
                header('Content-type: application/json');
                echo CJSON::encode(array('success' => 0, 'error' => $form->getErrors()));
                Yii::app()->end();
                die;
            }
        } else {
            $this->render('category_form_add', array('form' => $form));
        }
    }

    private function processCategoryFormUpdate($form) {

        $id = Yii::app()->request->getParam('id');
        $category = Category::model()->findByPk($id);
        $category->name = $form->name;
        $category->description = $form->description;
        $category->active = Yii::app()->request->getParam('active');
        $category->update();
    }

    /**
     * СВОЙСТВА
     */
    public function actionProperties() {
        $properties = CategoryProperties::model()->findAll(array("order" => "position ASC"));
        $category = Category::model()->findAll();
        foreach ($category as $value) {
            $masCategoryName[$value->id] = $value->name;
        }
        foreach ($properties as $value) {
            $maspropertiesName[$value->id] = $value->text;
        }
        $this->render('properties', array('properties' => $properties, 'category' => $masCategoryName, 'propertiName' => $maspropertiesName));
    }

    public function actionAddProperties() {
        $form = new CategoryPropertiesForm();
        $this->processPropertiesFormAdd($form);
    }

    public function actionEditProperties() {
        $id = Yii::app()->request->getParam('id');
        $form = CategoryProperties::model()->findByPk($id);
        $properties = CategoryProperties::model()->findAllByAttributes(array('id_properties' => 0));
        $category = Category::model()->findAll();
        $this->render('properties_form', array('properties' => $form, 'edit' => 1, 'propert' => $properties, 'categorys' => $category));
    }

    public function actionUpdateProperties() {
        $form = new CategoryPropertiesForm();
        $form->attributes = Yii::app()->request->getPost('properties');
        if ($form->validate()) {
            $id = Yii::app()->request->getParam('id');
            $properties = CategoryProperties::model()->findByPk($id);
            $properties->text = $form->text;
            $id_properties = Yii::app()->request->getPost('id_properties');
            if (is_null($id_properties)) {
                $id_properties = 0;
            }
            $properties->id_properties = $id_properties;
            if ($id_properties == 0) {
                $properties->id_category = Yii::app()->request->getPost('id_category');
            } else {
                $properties->id_category = $this->parentIdCategory(Yii::app()->request->getPost('id_properties'));
            }
            $properties->update();

            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 1, 'properties_id' => $id));
            Yii::app()->end();
        } else {
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 0, 'error' => $form->getErrors()));
            Yii::app()->end();
        }
    }

    public function actionDeleteProperties() {
        $id = Yii::app()->request->getParam('id');
        $properties = CategoryProperties::model()->findByPk($id);
        $properties->delete();

        $this->redirect($this->createUrl('/administration/properties'));
    }

    private function processPropertiesFormAdd($form) {
        if (!empty($_POST['properties'])) {
            $form->attributes = Yii::app()->request->getPost('properties');
            if ($form->validate()) {
                $properties = new CategoryProperties();
                $properties->text = $form->text;
                $id_properties = Yii::app()->request->getPost('id_properties');
                if (is_null($id_properties)) {
                    $id_properties = 0;
                }
                $properties->id_properties = $id_properties;
                if ($id_properties == 0) {
                    $properties->id_category = Yii::app()->request->getPost('id_category');
                } else {
                    $properties->id_category = $this->parentIdCategory(Yii::app()->request->getPost('id_properties'));
                }
                $properties->save();

                header('Content-type: application/json');
                echo CJSON::encode(array('success' => 1, 'properties_id' => $properties->id));
                Yii::app()->end();
                die;
            } else {
                header('Content-type: application/json');
                echo CJSON::encode(array('success' => 0, 'error' => $form->getErrors()));
                Yii::app()->end();
                die;
            }
        } else {
            $properties = CategoryProperties::model()->findAllByAttributes(array('id_properties' => 0));
            $category = Category::model()->findAll();
            $this->render('properties_form', array('form' => $form, 'propert' => $properties, 'categorys' => $category,));
        }
    }

    /**
     *  получим id родительско категории
     */
    private function parentIdCategory($id = '') {
        $properties = CategoryProperties::model()->findByPk($id);
        return $properties->id_category;
    }

    /**
     * СТРАНИЦЫ КАТЕГОРИЙ
     */
    public function actionPages() {
        if (empty($_GET['id_category']) || $_GET['id_category'] <= 0) {
            $pages = Pages::model()->findAll(array("order" => "position ASC"));
        } else {
            $pages = Pages::model()->findAllByAttributes(array('id_category' => $_GET['id_category']));
        }

        $comments = $this->coutPagesComments($pages);
        $category = Category::model()->findAll();
        foreach ($category as $value) {
            $masCategoryName[$value->id] = $value->name;
        }
        $this->render('pages', array('pages' => $pages, 'categoryName' => $masCategoryName,'category' => $category, 'comments' => $comments));
    }

    public function actionAddPages() {
        //$classId = Yii::app()->request->getParam('id');
        $category = Category::model()->findAll();
        $properties = CategoryProperties::model()->findAllByAttributes(array('id_category' => $category[0]['id']));
        $this->render('pages_form_add', array('categorys' => $category, 'properties' => $properties));
    }

    // передаем новые свойства для страницы
    public function actionAddPagesPropertis() {
        $id = Yii::app()->request->getPost('id_category');
        if (!empty($id)) {
            $properties = CategoryProperties::model()->findAllByAttributes(array('id_category' => Yii::app()->request->getPost('id_category')));
            if (count($properties) > 0) {
                $foreach = 'Свойства для фильтра: </br>';
                foreach ($properties as $value) {
                    $foreach.= '<input type="checkbox" checked="checked" name="properties[id' . $value->id . ']" id="propertie' . $value->id . '" value="' . $value->id . '"/> 
                        <label for="propertie' . $value->id . '">' . $value->text . '</label> </br>';
                }
            }
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 1, 'propertis' => $foreach));
            Yii::app()->end();
        } else {
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 0));
            Yii::app()->end();
            die;
        }
    }

    public function actionAddPagesForm() {
        if (!empty($_POST['pages'])) {
            $form = new PagesForm();
            $form->attributes = Yii::app()->request->getPost('pages');
            $imageError = $this->addImageFormError('fileToUpload', 330, 240, 'pages/temp');

            if ($form->validate() && !$imageError) {
                $nameImage = 'pages' . time() . '.jpg';
                $image = $this->addImageForm('fileToUpload', 330, 240, 'pages/temp', $nameImage);
                $image = $this->addImageForm('fileToUpload', 220, 130, 'pages/_temp', $nameImage);

                $pages = new Pages();
                $pages->name = $form->name;
                $pages->id_category = Yii::app()->request->getParam('id_category');
                $pages->prev_text = $form->prev_text;
                $pages->full_text = $form->full_text;
                $pages->img = $nameImage;
                $pages->active = Yii::app()->request->getParam('active');
                $pages->position = 0;
                $pages->update = strtotime(Yii::app()->request->getParam('updatePage'));
                $pages->created = time();
                $pages->save();

                $properties = Yii::app()->request->getPost('properties');
                if (isset($properties) && !is_null($properties)) {
                    $this->addAllPropertisPages($properties, $pages->id);
                }
                header('Content-type: application/json');
                echo CJSON::encode(array('success' => 1, 'pages_id' => $pages->id));
                Yii::app()->end();
                die;
            } else {
                header('Content-type: application/json');
                echo CJSON::encode(array('success' => 0, 'error' => $form->getErrors(), 'imageError' => $imageError));
                Yii::app()->end();
                die;
            }
        } else {
            $this->render('pages_form', array('form' => $form));
        }
    }

    public function actionEditPages() {
        $id = Yii::app()->request->getParam('id');
        $form = Pages::model()->findByPk($id);
        $category = Category::model()->findAll();
        $properties = CategoryProperties::model()->findAllByAttributes(array('id_category' => $category[0]['id']));
        $propertiesPage = PagesProperties::model()->findAllByAttributes(array('id_pages' => $id));
        $mas = array();
        foreach ($propertiesPage as $value) {
            $mas[] = $value->id_propertie;
        }

        $this->render('pages_form', array('pages' => $form, 'edit' => 1, 'categorys' => $category, 'properties' => $properties, 'mas' => $mas));
    }

    /**
     *  записываем все свойства страницы
     */
    private function addAllPropertisPages($propertis = '', $id_page = '') {
        foreach ($propertis as $value) {
            $pages = new PagesProperties();
            $pages->id_pages = $id_page;
            $pages->id_propertie = $value;
            $pages->save();
        }
    }

    private function deleteAllPropertisPages($id_page = '') {
        $pages = PagesProperties::model()->findAllByAttributes(array('id_pages' => $id_page));
        foreach ($pages as $value) {
            $properties = PagesProperties::model()->findByPk($value->id);
            $properties->delete();
        }
    }

    public function actionUpdatePages() {
        $form = new PagesForm();
        $form->attributes = Yii::app()->request->getPost('pages');
        $imageError = $this->addImageFormError('fileToUpload', 330, 240, 'pages/temp');
        if ($form->validate() && !$imageError) {
            $id = Yii::app()->request->getParam('id');
            $fileName = 'fileToUpload';
            if (!empty($_FILES[$fileName]['tmp_name'])) {
                $nameImage = 'pages' . time() . '.jpg';
                $image = $this->addImageForm($fileName, 330, 240, 'pages/temp', $nameImage);
                $image = $this->addImageForm($fileName, 220, 130, 'pages/_temp', $nameImage);
            }
            $pages = Pages::model()->findByPk($id);
            $pages->name = $form->name;
            $pages->id_category = Yii::app()->request->getParam('id_category');
            $pages->prev_text = $form->prev_text;
            $pages->full_text = $form->full_text;
            if (!empty($_FILES[$fileName]['tmp_name'])) {
                $pages->img = $nameImage;
            }
            $pages->active = Yii::app()->request->getParam('active');
            $pages->update = strtotime(Yii::app()->request->getParam('updatePage'));
            $pages->update();

            $this->deleteAllPropertisPages($id);
            $properties = Yii::app()->request->getPost('properties');
            if (isset($properties) && !is_null($properties)) {
                $this->addAllPropertisPages($properties, $pages->id);
            }
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 1, 'pages_id' => $id));
            Yii::app()->end();
        } else {
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 0, 'error' => $form->getErrors(), 'imageError' => $imageError));
            Yii::app()->end();
        }
    }

    public function actionDeletePages() {
        $id = Yii::app()->request->getParam('id');
        $pages = Pages::model()->findByPk($id);
        $pages->delete();
        $this->redirect($this->createUrl('/administration/pages'));
    }

    /**
     * КОММЕНТАРИИ
     */
    private function coutPagesComments($pages = '') {
        foreach ($pages as $value) {
            $comm = Comments::model()->findAllByAttributes(array('id_page' => $value->id));
            $mas[$value->id] = count($comm);
        }
        return $mas;
    }

    public function actionComments() {
        $this->render('comments', array('comments' => $this->allCommentsNotPages()));
    }

    private function allCommentsNotPages() {
        $comments = FALSE;
        $commNo = Comments::model()->findAllByAttributes(array('id_parent' => null), array("order" => "date ASC"));
        foreach ($commNo as $value) {
            $comments[$value->id]['id'] = $value->id;
            $comments[$value->id]['text'] = $value->text;
            $comments[$value->id]['date'] = $value->date;
            $comments[$value->id]['like'] = $value->like;
            $comments[$value->id]['notlike'] = $value->notlike;
            $comments[$value->id]['children'] = $this->allCommentsNotPageChildren($value->id);
            $user = User::model()->findByPk($value->id_user);
            $comments[$value->id]['user_name'] = $user->title;
            $comments[$value->id]['user_id'] = $user->id;
            $comments[$value->id]['id_page'] = $value->id_page;
        }
        return $comments;
    }

    // дочерние комментарии
    private function allCommentsNotPageChildren($id_parent = '') {
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

    public function actionCommentsPage() {
        $id = Yii::app()->request->getParam('id');
        $pages = Pages::model()->findByPk($id);
        $this->render('comments', array('pages' => $pages, 'comments' => $this->allCommentsPages($pages->id)));
    }

    private function allCommentsPages($id_page = '') {
        $comments = FALSE;
        $commNo = Comments::model()->findAllByAttributes(array('id_parent' => null, 'id_page' => $id_page), array("order" => "date ASC"));
        foreach ($commNo as $value) {
            $comments[$value->id]['id_page'] = $value->id_page;
            $comments[$value->id]['id'] = $value->id;
            $comments[$value->id]['text'] = $value->text;
            $comments[$value->id]['date'] = $value->date;
            $comments[$value->id]['like'] = $value->like;
            $comments[$value->id]['notlike'] = $value->notlike;
            $comments[$value->id]['children'] = $this->allCommentsPageChildren($id_page, $value->id);
            $user = User::model()->findByPk($value->id_user);
            $comments[$value->id]['user_name'] = $user->title;
            $comments[$value->id]['user_id'] = $user->id;
        }
        return $comments;
    }

    // дочерние комментарии

    private function allCommentsPageChildren($id_page = '', $id_parent = '') {
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

    public function actionDeleteComments() {
        $id = Yii::app()->request->getParam('id');
        $comments = Comments::model()->findByPk($id);
        $comments->delete();
        $this->redirect($this->createUrl('/administration/comments'));
    }

    /**
     * МЕНЮ
     */
    // вывести меню
    public function actionMenuCategory() {
        $menu = MenuCategory::model()->findAll();
        $this->render('menu_category', array('menu' => $menu));
    }

    public function actionMenu() {
        $id = Yii::app()->request->getParam('id');
        $menu = Menu::model()->findAllByAttributes(array("id_menu" => $id), array("order" => "position ASC"));
        $menu_category = MenuCategory::model()->findByPk($id);
        $this->render('menu', array('menu_category' => $menu_category, 'menu' => $menu));
    }

    // добавление нового пункта
    public function actionAddMenu() {
        $menu = MenuCategory::model()->findAll();
        $this->render('menu_form_add', array('menu_category' => $menu));
    }

    public function actionAddMenuForm() {
        $form = new MenuForm();
        $form->attributes = Yii::app()->request->getPost('menu');
        if ($form->validate()) {
            $menu = new Menu();
            $menu->name = trim($form->name);
            $menu->id_menu = Yii::app()->request->getPost('id_menu');
            $menu->url = trim($form->url);
            $menu->class = trim($form->class);
            $menu->position = 0;
            $menu->save();

            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 1, 'menu_id' => $menu->id));
            Yii::app()->end();
            die;
        } else {
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 0, 'error' => $form->getErrors()));
            Yii::app()->end();
            die;
        }
    }

    // редактивароник

    public function actionEditMenu() {
        $id = Yii::app()->request->getParam('id');
        $form = Menu::model()->findByPk($id);
        $menu_category = MenuCategory::model()->findAll();
        $this->render('menu_form', array('menu' => $form, 'edit' => 1, 'menu_category' => $menu_category));
    }

    public function actionUpdateMenu() {
        $form = new MenuForm();
        $form->attributes = Yii::app()->request->getPost('menu');
        if ($form->validate()) {
            $id = Yii::app()->request->getParam('id');
            $menu = Menu::model()->findByPk($id);
            $menu->name = trim($form->name);
            $menu->id_menu = Yii::app()->request->getPost('id_menu');
            $menu->url = trim($form->url);
            $menu->class = trim($form->class);
            $menu->update();

            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 1, 'menu_id' => $id));
            Yii::app()->end();
        } else {
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 0, 'error' => $form->getErrors()));
            Yii::app()->end();
        }
    }

    // удаление
    public function actionDeleteMenu() {
        $id = Yii::app()->request->getParam('id');
        $menu = Menu::model()->findByPk($id);
        $menu->delete();
        $this->redirect($this->createUrl('/administration/menu/category'));
    }

    /**
     * ПОЗИЦИИ ЭЛЕМЕНТОВ
     */
    // позиции для страниц категорий
    public function actionPositionPages() {
        if ($_POST['position']) {
            $position = $_POST['position'];
            $count = 0;
            foreach ($position as $value) {
                $pages = Pages::model()->findByPk($value);
                $pages->position = $count;
                $pages->update();
                $count++;
            }
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 1, 'pages_id' => $position));
            Yii::app()->end();
        } else {
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 0));
            Yii::app()->end();
        }
    }

    // позиции для категорий
    public function actionPositionCategory() {
        if ($_POST['position']) {
            $position = $_POST['position'];
            $count = 0;
            foreach ($position as $value) {
                $pages = Category::model()->findByPk($value);
                $pages->position = $count;
                $pages->update();
                $count++;
            }
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 1, 'pages_id' => $position));
            Yii::app()->end();
        } else {
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 0));
            Yii::app()->end();
        }
    }

    // позиции для свойств
    public function actionPositionProperties() {
        if ($_POST['position']) {
            $position = $_POST['position'];
            $count = 0;
            foreach ($position as $value) {
                $pages = CategoryProperties::model()->findByPk($value);
                $pages->position = $count;
                $pages->update();
                $count++;
            }
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 1, 'pages_id' => $position));
            Yii::app()->end();
        } else {
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 0));
            Yii::app()->end();
        }
    }

    // позиции для уроков
    public function actionPositionLesson() {
        if ($_POST['position']) {
            $position = $_POST['position'];
            $count = 0;
            foreach ($position as $value) {
                $pages = Lesson::model()->findByPk($value);
                $pages->position = $count;
                $pages->update();
                $count++;
            }
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 1, 'pages_id' => $position));
            Yii::app()->end();
        } else {
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 0));
            Yii::app()->end();
        }
    }

    // позиции для класов
    public function actionPositionClassroom() {
        if ($_POST['position']) {
            $position = $_POST['position'];
            $count = 0;
            foreach ($position as $value) {
                $pages = Classroom::model()->findByPk($value);
                $pages->position = $count;
                $pages->update();
                $count++;
            }
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 1, 'pages_id' => $position));
            Yii::app()->end();
        } else {
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 0));
            Yii::app()->end();
        }
    }

    // позиции для школа(образовнаие)
    public function actionPositionEducation() {
        if ($_POST['position']) {
            $position = $_POST['position'];
            $count = 0;
            foreach ($position as $value) {
                $pages = Education::model()->findByPk($value);
                $pages->position = $count;
                $pages->update();
                $count++;
            }
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 1, 'pages_id' => $position));
            Yii::app()->end();
        } else {
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 0));
            Yii::app()->end();
        }
    }

    // позиции для школа(образовнаие)
    public function actionPositionMenu() {
        if ($_POST['menu']) {
            $menu = $_POST['menu'];
            $count = 0;
            foreach ($menu as $value) {
                $menu = Menu::model()->findByPk($value);
                $menu->position = $count;
                $menu->update();
                $count++;
            }
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 1, 'menu' => $position));
            Yii::app()->end();
        } else {
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 0));
            Yii::app()->end();
        }
    }

    /**
     * СТРАНИЦЫ
     */
    public function actionPagesText() {
        $pages = PagesText::model()->findAll();
        $this->render('pages_text', array('pages' => $pages));
    }

    public function actionAddPagesText() {
        $this->render('pages_text_form_add');
    }

    public function actionAddPagesTextForm() {
        if (!empty($_POST['pages'])) {
            $form = new PagesTextForm();
            $form->attributes = Yii::app()->request->getPost('pages');

            if ($form->validate()) {
                $pages = new PagesText();
                $pages->name = $form->name;
                $pages->full_text = $form->full_text;
                $pages->update = time();
                $pages->created = time();
                $pages->save();

                header('Content-type: application/json');
                echo CJSON::encode(array('success' => 1, 'pages_id' => $pages->id));
                Yii::app()->end();
                die;
            } else {
                header('Content-type: application/json');
                echo CJSON::encode(array('success' => 0, 'error' => $form->getErrors()));
                Yii::app()->end();
                die;
            }
        } else {
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 0, 'error' => $form->getErrors()));
            Yii::app()->end();
            die;
        }
    }

    public function actionEditPagesText() {
        $id = Yii::app()->request->getParam('id');
        $form = PagesText::model()->findByPk($id);

        $this->render('pages_text_form', array('pages' => $form, 'edit' => 1));
    }

    public function actionUpdatePagesText() {
        $form = new PagesTextForm();
        $form->attributes = Yii::app()->request->getPost('pages');
        if ($form->validate()) {
            $id = Yii::app()->request->getParam('id');
            $pages = PagesText::model()->findByPk($id);
            $pages->name = $form->name;
            $pages->full_text = $form->full_text;
            $pages->update = time();
            $pages->update();

            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 1, 'pages_id' => $id));
            Yii::app()->end();
        } else {
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 0, 'error' => $form->getErrors()));
            Yii::app()->end();
        }
    }

    public function actionDeletePagesText() {
        $id = Yii::app()->request->getParam('id');
        $pages = PagesText::model()->findByPk($id);
        $pages->delete();
        $this->redirect($this->createUrl('/administration/pagesText'));
    }

    /**
     * настройки (переписать)
     */
    public function actionEditSettings() {
        $education_block = trim(Yii::app()->request->getPost('education_block'));
        $x = trim(Yii::app()->request->getPost('x'));
        $y = trim(Yii::app()->request->getPost('y'));

        if (isset($education_block) && $education_block != '' && isset($x) && $x != '' && isset($y) && $y != '') {
            $settings = Settings::model()->findByPk(2);
            $settings->value = $education_block;
            $settings->update();

            $settings = Settings::model()->findByPk(3);
            $settings->value = $x;
            $settings->update();

            $settings = Settings::model()->findByPk(4);
            $settings->value = $y;
            $settings->update();
        }
        $array = array('education_block', 'x', 'y');
        $form = Settings::model()->findAllByAttributes(array('category' => $array));
        $this->render('settings', array('home' => $form));
    }

    /*  private function propertiesCategory($id_category = '', $text = '', $id_properties = null) {
      $category = new CategoryProperties();
      $category->id_category = $id_category;
      $category->id_properties = $id_properties;
      $category->text = $text;
      $category->save();
      return $category->id;
      }

      private function propertiesCategoryChildren($id_category = '', $id_properties = '', $properties = '') {
      foreach ($properties as $key => $value) {
      $id_propertie = $this->propertiesCategory($id_category, $value, $id_properties);
      }
      }

      private function processPropertiesyFormUpdate($form, $id) {
      $category = Category::model()->findByPk($id);
      $category->name = $form->name;
      $category->description = $form->description;
      $category->active = $active;
      $category->update();
      } */




    /*
    * БЛОКИ НА ГЛАВНОЙ
    */
    public function actionMainBlocks() {
        $blocks = MainBlocks::model()->findAll(array('order'=>'position DESC'));
//        var_dump($blocks); die;
        $this->render('main_blocks', array('blocks' => $blocks));
    }

    public function actionEditMainBlocks() {
        $block_id = Yii::app()->request->getParam('id');
        $block = MainBlocks::model()->findByPk($block_id);
        $this->render('main_blocks_edit', array('block' => $block, 'edit' => 1));
    }

    public function actionEditPositionMainBlocks() {
        if (Yii::app()->request->getPost('position')!== NULL) {
            $position = Yii::app()->request->getPost('position');
            $count = 1;
            foreach ($position as $value) {
                $pages = MainBlocks::model()->findByPk($value);
                $pages->position = $count;
                $pages->update();
                $count++;
            }
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 1, 'position_id' => $position));
            Yii::app()->end();
        } else {
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 0));
            Yii::app()->end();
        }
    }

    public function actionDeleteMainBlocks() {
        $block_id = Yii::app()->request->getParam('id');
        $block = MainBlocks::model()->findByPk($block_id);
        $block->delete();
        header("Location: /administration/mainBlocks"); return;
    }


    /*
    * ПОСТЫ В БЛОКАХ НА ГЛАВНОЙ
    */
    public function actionEditPostsMainBlocks() {
        $post_id = Yii::app()->request->getParam('id');
        $post = MainPosts::model()->findByPk($post_id);
        $this->render('posts_form', array('post' => $post, 'edit' => 1));
    }

    private function processPostFormUpdate($form, $id, $image, $additional_photos, $isNew)
    {
        $post = (!$isNew) ? MainPosts::model()->findByPk($id) : new MainPosts();
        if ($isNew) $post->block_id = $id;
        $post->name = $form->name;
        $post->url = $form->url;
        if ($additional_photos) $post->additional_photos = $additional_photos;
        if (isset($image)) {
            $post->photo = $image;
        }
        return (!$isNew) ? $post->update() : $post->save();
    }

    private function addImagePostFormError($fileName) {
        if (!empty($_FILES[$fileName]['name'])){
            if (!empty($_FILES[$fileName]['tmp_name'])) {

                return MainPosts::model()->imageFormValidate($_FILES[$fileName]);
            }
            else
                return 'Невозможно загрузить выбранный файл! Попробуйте загрузить файл меньшего размера!';
        }
    }

    public function actionUpdatePostsMainBlocks() {
        $isNew = Yii::app()->request->getParam('new');
        $id = Yii::app()->request->getParam('id'); // id = id блока если новая запись, если изменяем то это id поста
        $type_block = (!$isNew) ? MainPosts::model()->findByPk($id)->block->type : MainBlocks::model()->findByPk($id)->type;

        $form = new MainPostsForm();
        $form->name = Yii::app()->request->getPost('name');
        $form->url = Yii::app()->request->getPost('url');
        $form->photo = Yii::app()->request->getPost('fileToUpload');
        $imageError = $this->addImagePostFormError('fileToUpload');
        $DopImage = ($type_block == 4) ? true : false; //имеет доп картинки блок

        $addImageError = false;
        $imageErrorsAdditional = array();
        if ($DopImage)
        {
            $imageErrorsAdditional[0] = $this->addImagePostFormError('fileToUploadAddone');
            $imageErrorsAdditional[1] = $this->addImagePostFormError('fileToUploadAddtwo');
            $imageErrorsAdditional[2] = $this->addImagePostFormError('fileToUploadAddthree');
            $imageErrorsAdditional[3] = $this->addImagePostFormError('fileToUploadAddfour');
            $imageErrorsAdditional[4] = $this->addImagePostFormError('fileToUploadAddfive');
            if ($isNew)
            {
                if (in_array(NULL,$imageErrorsAdditional, true))
                    $addImageError = true;
            }
            else
            {
                foreach ($imageErrorsAdditional as $image) {
                    if (!($image === NULL || $image===false))
                    {
                        $addImageError = true;
                        break;
                    }
                }
            }
        }
        if (($form->validate() && !$imageError) && (!(!isset($imageError) && $isNew)) && !$addImageError) {

            $width = 100;
            $height = 100;
            switch ($type_block)
            {
                case 1 :
                    $width = 310;
                    $height = 190;
                    break;
                case 2 :
                    $width = 180;
                    $height = 140;
                    break;
                case 3 :
                    $width = 480;
                    $height = 360;
                    break;
                case 4 :
                    $width = 480;
                    $height = 310;
                    break;
                case 5 :
                    $width = 230;
                    $height = 190;
                    break;
                case 6 :
                    $width = 980;
                    $height = 400;
                    break;
            }
            $nameImage = 'mainPost' . time() . '.jpg';
            $image = $this->addImageForm('fileToUpload', $width, $height, 'main', $nameImage);
            $userAddImages = '';
            if ($DopImage)
            {

                $imageAdd[0] = $this->addImageForm('fileToUploadAddone', $width, $height, 'main','mainPostAddOne' . time() . '.jpg');
                $imageAdd[1] = $this->addImageForm('fileToUploadAddtwo', $width, $height, 'main','mainPostAddTwo' . time() . '.jpg');
                $imageAdd[2] = $this->addImageForm('fileToUploadAddthree', $width, $height, 'main','mainPostAddThree' . time() . '.jpg');
                $imageAdd[3] = $this->addImageForm('fileToUploadAddfour', $width, $height, 'main','mainPostAddFour' . time() . '.jpg');
                $imageAdd[4] = $this->addImageForm('fileToUploadAddfive', $width, $height, 'main','mainPostAddFive' . time() . '.jpg');
                if (!$isNew)
                {
                    $dop_images = unserialize(MainPosts::model()->findByPk($id)->additional_photos);
                    for ($i=0; $i<5; $i++) {
                        if ($imageAdd[$i]===NULL)
                        {
                            $imageAdd[$i] = $dop_images[$i];
                        }
                    }
                }
                if (!in_array(NULL, $imageAdd, true))
                {
                    $userAddImages = serialize($imageAdd);
                }
                $userAddImages = serialize($imageAdd);
            }

            $update = $this->processPostFormUpdate($form, $id, $image, $userAddImages, $isNew);
            $return = ($update) ? 1 : 0;
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => $return, 'post_id' => $id));
            Yii::app()->end();
        } else {
            header('Content-type: application/json');
            echo CJSON::encode(array('success' => 0, 'error' => $form->getErrors(), 'imageError' => $imageError, 'imageErrorsAdditional' => $imageErrorsAdditional));
            Yii::app()->end();
        }
    }

    public function actionAddMainBlocks() {
        if ((Yii::app()->request->getPost('type')!== NULL && Yii::app()->request->getPost('position')!== NULL))
        {
            $block = new MainBlocks();
            $block->type = Yii::app()->request->getPost('type') ;
            $block->position = Yii::app()->request->getPost('position');
            $block->save();
            header("Location: /administration/mainBlocks/edit/".$block->getPrimaryKey()); return;
        }
        $blocks = MainBlocks::model()->findAll(array('order'=>'position DESC'));
        $pos = (isset($blocks[0]->position)) ? (($blocks[0]->position)+1) : $pos=1;
        $this->render('main_blocks_add', array('position' => $pos));
    }

    public function actionAddPostsMainBlocks() {
        $block = MainBlocks::model()->findByPk(Yii::app()->request->getParam('id'));
        $add_images = ($block->type == 4) ? true : false;
        $this->render('posts_form', array('add_images' => $add_images));
    }


    /**
     * SHOP
     */
    public function actionShopCategory() {
        $categories = ShopCategory::model()->findAllByAttributes(array('parent_id'=>null));
        $this->render('shopCategory', array('categories'=>$categories));
    }

}



?>
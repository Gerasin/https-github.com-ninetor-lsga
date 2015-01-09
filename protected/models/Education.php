<?php

/**
 * This is the model class for table "education".
 *
 * The followings are the available columns in table 'education':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $img
 * @property integer $active
 * @property integer $position
 * @property integer $created
 */
class Education extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'education';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('active, position, created', 'numerical', 'integerOnly' => true),
            array('name, img', 'length', 'max' => 255),
            array('description', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, description, img, active, position, created', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'img' => 'Img',
            'active' => 'Active',
            'position' => 'Position',
            'created' => 'Created',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('img', $this->img, true);
        $criteria->compare('active', $this->active);
        $criteria->compare('position', $this->position);
        $criteria->compare('created', $this->created);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Education the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function imageFormValidate($param) {
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

}
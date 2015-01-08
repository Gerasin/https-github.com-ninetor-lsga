<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $title
 * @property string $phone
 * @property string $country
 * @property string $city
 * @property string $street
 * @property string $postcode
 * @property string $apartment
 * @property string $house
 * @property integer $bdate
 * @property string $img
 * @property string $gender
 * @property string $role
 * @property string $password
 * @property integer $credit
 * @property string $last_time
 * @property integer $created
 */
class User extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, email, phone, role, password', 'required'),
            array('bdate, credit, created', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 100),
            array('email, phone, country, city', 'length', 'max' => 50),
            array('title, img, password, last_time', 'length', 'max' => 255),
            array('street', 'length', 'max' => 200),
            array('postcode, apartment, house', 'length', 'max' => 10),
            array('gender, role', 'length', 'max' => 20),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, email, title, phone, country, city, street, postcode, apartment, house, bdate, img, gender, role, password, credit, last_time, created', 'safe', 'on' => 'search'),
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
            'email' => 'Email',
            'title' => 'Title',
            'phone' => 'Phone',
            'country' => 'Country',
            'city' => 'City',
            'street' => 'Street',
            'postcode' => 'Postcode',
            'apartment' => 'Apartment',
            'house' => 'House',
            'bdate' => 'Bdate',
            'img' => 'Img',
            'gender' => 'Gender',
            'role' => 'Role',
            'password' => 'Password',
            'credit' => 'Credit',
            'last_time' => 'Last Time',
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
        $criteria->compare('email', $this->email, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('country', $this->country, true);
        $criteria->compare('city', $this->city, true);
        $criteria->compare('street', $this->street, true);
        $criteria->compare('postcode', $this->postcode, true);
        $criteria->compare('apartment', $this->apartment, true);
        $criteria->compare('house', $this->house, true);
        $criteria->compare('bdate', $this->bdate);
        $criteria->compare('img', $this->img, true);
        $criteria->compare('gender', $this->gender, true);
        $criteria->compare('role', $this->role, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('credit', $this->credit);
        $criteria->compare('last_time', $this->last_time, true);
        $criteria->compare('created', $this->created);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function check_email($email) {
        $user = User::model()->findByAttributes(array('email' => $email));

        if ($user !== null) {
            return false;
        }
        return true;
    }

    public function validate_email($email) {
        $validate_email = new CEmailValidator();

        if ($validate_email->validateValue($email))
            return true;
        else
            return false;
    }

    public function check_name($name) {
        $user = User::model()->findByAttributes(array('name' => $name));

        if ($user !== null) {
            return false;
        }
        return true;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}

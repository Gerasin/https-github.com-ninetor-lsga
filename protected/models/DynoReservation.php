<?php

/**
 * This is the model class for table "dyno_reservation".
 *
 * The followings are the available columns in table 'dyno_reservation':
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $auto_brands
 * @property string $auto_models
 * @property string $displacement
 * @property integer $dyno_works_id
 * @property integer $date_reservation
 * @property string $time_reservation
 * @property integer $create
 */
class DynoReservation extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'dyno_reservation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dyno_works_id, date_reservation, create', 'numerical', 'integerOnly'=>true),
			array('name, email', 'length', 'max'=>255),
			array('phone, time_reservation', 'length', 'max'=>20),
			array('displacement', 'length', 'max'=>100),
			array('auto_brands, auto_models', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, email, phone, auto_brands, auto_models, displacement, dyno_works_id, date_reservation, time_reservation, create', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'email' => 'Email',
			'phone' => 'Phone',
			'auto_brands' => 'Auto Brands',
			'auto_models' => 'Auto Models',
			'displacement' => 'Displacement',
			'dyno_works_id' => 'Dyno Works',
			'date_reservation' => 'Date Reservation',
			'time_reservation' => 'Time Reservation',
			'create' => 'Create',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('auto_brands',$this->auto_brands,true);
		$criteria->compare('auto_models',$this->auto_models,true);
		$criteria->compare('displacement',$this->displacement,true);
		$criteria->compare('dyno_works_id',$this->dyno_works_id);
		$criteria->compare('date_reservation',$this->date_reservation);
		$criteria->compare('time_reservation',$this->time_reservation,true);
		$criteria->compare('create',$this->create);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DynoReservation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

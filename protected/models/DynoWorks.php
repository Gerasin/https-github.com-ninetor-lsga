<?php

/**
 * This is the model class for table "dyno_works".
 *
 * The followings are the available columns in table 'dyno_works':
 * @property integer $id
 * @property string $name
 * @property string $time
 * @property string $count
 * @property string $value
 * @property string $img
 * @property integer $position
 * @property integer $create
 */
class DynoWorks extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'dyno_works';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('position, create', 'numerical', 'integerOnly'=>true),
			array('name, img', 'length', 'max'=>255),
			array('time', 'length', 'max'=>100),
			array('count', 'length', 'max'=>20),
			array('value', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, time, count, value, img, position, create', 'safe', 'on'=>'search'),
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
			'time' => 'Time',
			'count' => 'Count',
			'value' => 'Value',
			'img' => 'Img',
			'position' => 'Position',
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
		$criteria->compare('time',$this->time,true);
		$criteria->compare('count',$this->count,true);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('img',$this->img,true);
		$criteria->compare('position',$this->position);
		$criteria->compare('create',$this->create);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DynoWorks the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

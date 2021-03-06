<?php

/**
 * This is the model class for table "main_posts".
 *
 * The followings are the available columns in table 'main_posts':
 * @property integer $id
 * @property string $url
 * @property string $photo
 * @property string $name
 * @property integer $block_id
 * @property string $additional_photos
 *
 * The followings are the available model relations:
 * @property MainBlocks $block
 */
class MainPosts extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'main_posts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('url, photo, name, block_id', 'required'),
			array('block_id', 'numerical', 'integerOnly'=>true),
			array('photo, name', 'length', 'max'=>300),
			array('additional_photos', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, url, photo, name, block_id, additional_photos', 'safe', 'on'=>'search'),
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
			'block' => array(self::BELONGS_TO, 'MainBlocks', 'block_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'url' => 'Url',
			'photo' => 'Photo',
			'name' => 'Name',
			'block_id' => 'Block',
			'additional_photos' => 'Additional Photos',
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
		$criteria->compare('url',$this->url,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('block_id',$this->block_id);
		$criteria->compare('additional_photos',$this->additional_photos,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MainPosts the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

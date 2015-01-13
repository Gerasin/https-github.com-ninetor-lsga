<?php

/**
 * This is the model class for table "shop_goods".
 *
 * The followings are the available columns in table 'shop_goods':
 * @property integer $id
 * @property string $code
 * @property integer $shop_category_id
 * @property integer $warehouse_count
 * @property integer $price
 * @property integer $discount
 * @property string $picture
 * @property string $created
 */
class ShopGoods extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'shop_goods';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, shop_category_id, warehouse_count, price, created', 'required'),
			array('shop_category_id, warehouse_count, price, discount', 'numerical', 'integerOnly'=>true),
			array('code', 'length', 'max'=>100),
			array('picture', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, code, shop_category_id, warehouse_count, price, discount, picture, created', 'safe', 'on'=>'search'),
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
            'shopCategory' => array(self::BELONGS_TO, 'ShopCategory', 'shop_category_id'),
            'shopGoodsProperties' => array(self::HAS_MANY, 'ShopGoodsProperties', 'shop_goods_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'code' => 'Code',
			'shop_category_id' => 'Shop Category',
			'warehouse_count' => 'Warehouse Count',
			'price' => 'Price',
			'discount' => 'Discount',
			'picture' => 'Picture',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('shop_category_id',$this->shop_category_id);
		$criteria->compare('warehouse_count',$this->warehouse_count);
		$criteria->compare('price',$this->price);
		$criteria->compare('discount',$this->discount);
		$criteria->compare('picture',$this->picture,true);
		$criteria->compare('created',$this->created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ShopGoods the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


}

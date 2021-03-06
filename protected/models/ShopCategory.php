<?php

/**
 * This is the model class for table "shop_category".
 *
 * The followings are the available columns in table 'shop_category':
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 */
class ShopCategory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'shop_category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('parent_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, parent_id', 'safe', 'on'=>'search'),
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
            'shopGoods' => array(self::HAS_MANY, 'ShopGoods', 'shop_category_id'),
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
			'parent_id' => 'Parent',
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
		$criteria->compare('parent_id',$this->parent_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}



    public function getCategories($id)
    {
       $categories = $this->model()->findAllByAttributes(array('parent_id'=>$id));
       $new_categories = null;
        if (count($categories))
            {
                foreach ($categories as $category) {
                    $new_categories[$category->id] = array($category->name, $category->parent_id);
                }
                foreach ($new_categories as $id_category => $category) {
                    $new_categories[$id_category]['child'] = $this->getCategories($id_category);
                }
            }
        return $new_categories;
    }
    public function getCategoriesForDelete($id)
    {
       $categories = $this->model()->findAllByAttributes(array('parent_id'=>$id));
       $new_categories = null;
        if (count($categories)>0)
            {
                foreach ($categories as $category) {
                    $new_categories[] = $category->id;
                }
                foreach ($new_categories as $category) {
                 $this->getCategoriesForDelete($category);
                }
            }
        else
        {
            return;
        }
        foreach ($new_categories as $category) {
        $category = $this->model()->findByPk($category);
        $category->delete();
        }
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ShopCategory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

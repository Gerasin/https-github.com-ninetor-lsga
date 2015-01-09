<?php

class m150108_144602_create_shop_goods extends CDbMigration
{
	public function up()
	{
        $this->createTable('shop_goods', array(
            'id' => 'pk',
            'code' => 'string NOT NULL',
            'shop_category_id' => 'int NOT NULL',
            'warehouse_count' => 'int NOT NULL',
//            'description' => 'text NULL',
//            'delivery' => 'text NULL',
//            'guarantee' => 'text NULL',
//            'seller' => 'text NULL',
            'price' => 'int NOT NULL',
            'discount' => 'int NULL',
            'picture' => 'text NULL',
            'created' => 'timestamp NOT NULL',
        ));
	}

	public function down()
	{
        $this->dropTable('shop_goods');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}
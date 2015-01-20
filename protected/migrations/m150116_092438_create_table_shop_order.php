<?php

class m150116_092438_create_table_shop_order extends CDbMigration
{
    public function up()
    {
        $this->createTable('shop_order', array(
            'id' => 'pk',
            'user_id' => 'int NOT NULL',
            'country' => 'varchar(100) NOT NULL',
            'city' => 'varchar(100) NOT NULL',
            'telephone' => 'varchar(50) NOT NULL',
            'street' => 'varchar(100) NOT NULL',
            'home' => 'varchar(100) NOT NULL',
            'apartment' => 'varchar(100) NULL',
            'price' => 'int NULL',
            'discount' => 'float NULL',
            'type_delivery' => 'int NULL',
            'delivery_price' => 'int NULL',
            'total_price' => 'int NULL',
            'status' => 'varchar(100) NULL',
            'type_payment' => 'int NULL',
            'credits' => 'int NULL',
            'date' => 'timestamp NOT NULL',
            'active' => 'int NOT NULL',
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
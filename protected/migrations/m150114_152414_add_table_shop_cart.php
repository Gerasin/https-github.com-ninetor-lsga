<?php

class m150114_152414_add_table_shop_cart extends CDbMigration
{
		public function up()
        {
            $this->createTable('shop_cart', array(
                'id' => 'pk',
                'user_id' => 'int NOT NULL',
                'shop_goods_id' => 'int NOT NULL',
                'count' => 'int NOT NULL',
            ));
        }

	public function down()
    {
        $this->dropTable('shop_cart');
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
<?php

class m150109_083450_create_shop_goods_properties_table extends CDbMigration
{
    public function up()
    {
        $this->createTable('shop_goods_properties', array(
            'id' => 'pk',
            'shop_goods_id' => 'int NOT NULL',
            'title' => 'varchar(100) NOT NULL',
            'text' => 'text NOT NULL',
            'position' => 'int NOT NULL',
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
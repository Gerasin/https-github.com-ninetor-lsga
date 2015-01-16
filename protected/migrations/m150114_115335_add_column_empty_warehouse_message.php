<?php

class m150114_115335_add_column_empty_warehouse_message extends CDbMigration
{
	public function up()
	{
        $this->addColumn('shop_goods', 'empty_warehouse_message','varchar(100)');
	}

	public function down()
	{
        $this->dropColumn('shop_goods', 'empty_warehouse_message');
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
<?php

class m150114_093636_drop_column_position extends CDbMigration
{
	public function up()
	{
        $this->dropColumn('shop_goods_properties', 'position');
	}

	public function down()
	{
        $this->addColumn('shop_goods_properties', 'position','int');
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
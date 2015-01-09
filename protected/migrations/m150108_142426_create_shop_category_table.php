<?php

class m150108_142426_create_shop_category_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('shop_category', array(
            'id' => 'pk',
            'name' => 'string NOT NULL',
            'parent_id' => 'int NULL',
        ));
	}

	public function down()
	{
        $this->dropTable('shop_category');
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
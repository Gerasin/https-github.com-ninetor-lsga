<?php

class m150109_091440_add_menu_table_shop extends CDbMigration
{
	public function up()
	{
        $this->insert('menu', array(
            'id_menu' => '1',
            'name' => 'Магазин',
            'url' => '/shop',
            'class' => 'menu-main-link',
            'position' => '0',
        ));
	}

	public function down()
	{
		echo "m150109_091440_add_menu_table_shop does not support migration down.\n";
		return false;
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
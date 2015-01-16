<?php

class m150114_120545_auto_param_names extends CDbMigration
{

    public function up()
    {
        $this->createTable('auto_param_names', array(
            'id' => 'pk',
            'name' => 'text NULL',
            'group_id' => 'int NULL',
            'units' => 'text NULL',
        ));
    }

    public function down()
    {
        echo "m150114_120545_auto_param_names does not support migration down.\n";
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
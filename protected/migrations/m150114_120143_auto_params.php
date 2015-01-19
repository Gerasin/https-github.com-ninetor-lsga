<?php

class m150114_120143_auto_params extends CDbMigration
{

    public function up()
    {
        $this->createTable('auto_params', array(
            'id' => 'pk',
            'param_id' => 'int NULL',
            'group_id' => 'int NULL',
            'modify_id' => 'int NULL',
            'value' => 'text NULL',
        ));
    }

    public function down()
    {
        echo "m150114_120143_auto_params does not support migration down.\n";
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
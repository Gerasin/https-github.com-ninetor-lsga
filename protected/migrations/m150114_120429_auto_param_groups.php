<?php

class m150114_120429_auto_param_groups extends CDbMigration
{

    public function up()
    {
        $this->createTable('auto_param_groups', array(
            'id' => 'pk',
            'name' => 'text NULL',
        ));
    }

    public function down()
    {
        echo "m150114_120429_auto_param_groups does not support migration down.\n";
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
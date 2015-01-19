<?php

class m150114_115435_auto_models extends CDbMigration
{

    public function up()
    {
        $this->createTable('auto_models', array(
            'id' => 'pk',            
            'name' => 'text NULL',
            'brand_id' => 'int NULL',
            'url' => 'text NULL',
            'updated' => 'int NULL',
        ));
    }

    public function down()
    {
        echo "m150114_115435_auto_models does not support migration down.\n";
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
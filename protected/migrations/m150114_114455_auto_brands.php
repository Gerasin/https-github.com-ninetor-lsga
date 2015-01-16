<?php

class m150114_114455_auto_brands extends CDbMigration
{

    public function up()
    {
        $this->createTable('auto_brands', array(
            'id' => 'pk',          
            'name' => 'text NULL',
            'url' => 'text NULL',
            'updated' => 'int NULL',
        ));
    }

    public function down()
    {
        echo "m150114_114455_auto_brands does not support migration down.\n";
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
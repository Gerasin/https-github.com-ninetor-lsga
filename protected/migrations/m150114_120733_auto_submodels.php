<?php

class m150114_120733_auto_submodels extends CDbMigration
{

    public function up()
    {
        $this->createTable('auto_submodels', array(
            'id' => 'pk',
            'name' => 'text NULL',
            'brand_id' => 'int NULL',
            'model_id' => 'int NULL',
            'url' => 'text NULL',
            'updated' => 'int NULL',
        ));
    }

    public function down()
    {
        echo "m150114_120733_auto_submodels does not support migration down.\n";
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
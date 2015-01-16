<?php

class m150114_115755_auto_modify extends CDbMigration
{

    public function up()
    {
        $this->createTable('auto_modify', array(
            'id' => 'pk',
            'name' => 'text NULL',
            'longname' => 'text NULL',
            'brand_id' => 'int NULL',
            'model_id' => 'int NULL',
            'submodel_id' => 'int NULL',
            'engine_type' => 'text NULL',
            'drive_type' => 'text NULL',
            'release_from' => 'text NULL',
            'release_to' => 'int NULL',
            'url' => 'text NULL',
            'updated' => 'int NULL',
        ));
    }

    public function down()
    {
        echo "m150114_115755_auto_modify does not support migration down.\n";
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
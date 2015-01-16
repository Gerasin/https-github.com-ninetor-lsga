<?php

class m150114_130008_dyno_works extends CDbMigration
{

    public function up()
    {
        $this->createTable('dyno_works', array(
            'id' => 'pk',
            'name' => 'varchar(255) NULL',
            'time' => 'varchar(100) NULL',
            'count' => 'varchar(20) NULL',
            'value' => 'text NULL',
            'img' => 'varchar(255) NULL',
            'position' => 'int NULL',
            'create' => 'int NULL',
        ));
    }

    public function down()
    {
        echo "m150114_130008_dyno_works does not support migration down.\n";
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
<?php

class m150114_124451_dyno_reservation extends CDbMigration
{

    public function up()
    {
        $this->createTable('dyno_reservation', array(
            'id' => 'pk',
            'name' => 'varchar(255) NULL',
            'email' => 'varchar(255) NULL',
            'phone' => 'varchar(20) NULL',
            'auto_brands' => 'text NULL',
            'auto_models' => 'text NULL',
            'displacement' => 'varchar(100) NULL',
            'dyno_works_id' => 'int NULL',
            'date_reservation' => 'int NULL',
            'time_reservation' => 'varchar(20) NULL',
            'create' => 'int NULL',
        ));
    }

    public function down()
    {
        echo "m150114_124451_dyno_reservation does not support migration down.\n";
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

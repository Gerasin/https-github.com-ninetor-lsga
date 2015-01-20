<?php

class m150120_070813_addColumnMinut extends CDbMigration
{

    public function up()
    {
        $this->addColumn('dyno_works', 'minuts', 'int(11) DEFAULT 0');
    }

    public function down()
    {
        echo "m150120_070813_addColumnMinut does not support migration down.\n";
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
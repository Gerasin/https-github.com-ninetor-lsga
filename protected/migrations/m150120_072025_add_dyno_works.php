<?php

class m150120_072025_add_dyno_works extends CDbMigration
{

    public function up()
    {
        $this->insert('dyno_works', array(
            'name' => 'Измерение мощности',
            'time' => '1',
            'count' => '1000',
            'value' => 'Test text',
            'img' => 'reserv_img-01.jpg',
            'position' => '0',
            'create' => '0',
            'minuts' => '0',
        ));
        $this->insert('dyno_works', array(
            'name' => 'Аренда стенда на целый день для настройки',
            'time' => '12',
            'count' => '6000',
            'value' => 'Test text2',
            'img' => 'reserv_img-02.jpg',
            'position' => '1',
            'create' => '0',
            'minuts' => '0',
        ));
    }

    public function down()
    {
        echo "m150120_072025_add_dyno_works does not support migration down.\n";
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
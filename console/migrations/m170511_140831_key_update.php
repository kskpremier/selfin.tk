<?php

use yii\db\Migration;

class m170511_140831_key_update extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
//
//        $this->addColumn('{{%key}}', 'start_date', $this->string());
//        $this->addColumn('{{%key}}', 'end_date', $this->string());


    }

    public function down()
    {
        echo "m170511_140831_key_update cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}

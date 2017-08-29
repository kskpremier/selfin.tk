<?php

use yii\db\Migration;

class m170305_230205_image extends Migration
{
    public function up()
    {

        $this->addColumn('{{%photo_image}}', 'file_name', $this->string());

    }

    public function down()
    {
        echo "m170305_230205_image cannot be reverted.\n";

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

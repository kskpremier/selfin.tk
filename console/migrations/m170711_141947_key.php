<?php

use yii\db\Migration;

class m170711_141947_key extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%key}}', 'user_id', $this->integer());

        $this->createIndex('idx-key-user_id', '{{%key}}', 'user_id');
        $this->addForeignKey('fk-key-user_id', '{{%key}}', 'user_id', '{{%users}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function safeDown()
    {

        $this->dropColumn('{{%key}}', 'user_id');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170711_141947_key cannot be reverted.\n";

        return false;
    }
    */
}

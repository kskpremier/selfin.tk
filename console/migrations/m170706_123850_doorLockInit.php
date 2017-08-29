<?php

use yii\db\Migration;

class m170706_123850_doorLockInit extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%door_lock}}', 'lock_key', $this->double());
        $this->addColumn('{{%door_lock}}', 'aes_key_str', $this->double());
        $this->addColumn('{{%door_lock}}', 'key_id', $this->double());

    }

    public function safeDown()
    {
        $this->dropColumn('{{%door_lock}}', 'lock_key');
        $this->dropColumn('{{%door_lock}}', 'aes_key_str');
        $this->dropColumn('{{%door_lock}}', 'key_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170706_123850_doorLockInit cannot be reverted.\n";

        return false;
    }
    */
}

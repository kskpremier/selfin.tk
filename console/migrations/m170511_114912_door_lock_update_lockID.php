<?php

use yii\db\Migration;

class m170511_114912_door_lock_update_lockID extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->addColumn('{{%door_lock}}', 'lockId', $this->string());
    }

    public function down()
    {
        echo "m170511_114912_door_lock_update_lockID cannot be reverted.\n";

        $this->dropColumn('{{%door_lock}}', 'lockId', $this->string());
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

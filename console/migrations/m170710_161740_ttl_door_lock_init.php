<?php

use yii\db\Migration;

class m170710_161740_ttl_door_lock_init extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%door_lock}}', 'model_number', $this->string(255));
        $this->addColumn('{{%door_lock}}', 'hardware_revision', $this->string(255));
        $this->addColumn('{{%door_lock}}', 'firmware_revision', $this->string(255));

    }

    public function safeDown()
    {
        $this->dropColumn('{{%door_lock}}', 'model_number');
        $this->dropColumn('{{%door_lock}}', 'hardware_revision');
        $this->dropColumn('{{%door_lock}}', 'firmware_revision');
    }
}

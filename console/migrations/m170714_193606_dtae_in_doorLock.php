<?php

use yii\db\Migration;

class m170714_193606_dtae_in_doorLock extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{door_lock}}','date',$this->bigInteger());
    }

    public function safeDown()
    {
        $this->dropColumn('{{door_lock}}','date');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170714_193606_dtae_in_doorLock cannot be reverted.\n";

        return false;
    }
    */
}

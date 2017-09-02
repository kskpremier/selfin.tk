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

}

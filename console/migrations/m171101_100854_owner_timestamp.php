<?php

use yii\db\Migration;

class m171101_100854_owner_timestamp extends Migration
{
    public function safeUp()
    {
    $this->addColumn("owner", "update",$this->timestamp() );
    }

    public function safeDown()
    {
        echo "m171101_100854_owner_timestamp cannot be reverted.\n";
        $this->dropColumn("owner", "update");
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171101_100854_owner_timestamp cannot be reverted.\n";

        return false;
    }
    */
}

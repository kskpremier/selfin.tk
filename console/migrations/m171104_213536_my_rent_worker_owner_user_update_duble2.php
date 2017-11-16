<?php

use yii\db\Migration;

class m171104_213536_my_rent_worker_owner_user_update_duble2 extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{users}}','external_id', $this->string(20));
        $this->addColumn('{{users}}','contact_name', $this->string(255));
        $this->addColumn('{{users}}','myrent_update', $this->integer(15));
        $this->addColumn('{{users}}','guid', $this->string(255));
        $this->addColumn('{{worker}}','guid', $this->string(255));
        $this->addColumn('{{owner}}','guid', $this->string(255));
        $this->addColumn('{{worker}}','myrent_update', $this->integer(15));
    }

    public function safeDown()
    {
        echo "m171104_213536_my_rent_worker_owner_user_update_duble2 cannot be reverted.\n";
        $this->dropColumn('{{users}}','guid');
        $this->dropColumn('{{worker}}','guid');
        $this->dropColumn('{{owner}}','guid');
        $this->dropColumn('{{users}}','external_id');
        $this->dropColumn('{{worker}}','myrent_update');
        $this->dropColumn('{{users}}','contact_name');
        $this->dropColumn('{{users}}','myrent_update');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171104_213536_my_rent_worker_owner_user_update_duble2 cannot be reverted.\n";

        return false;
    }
    */
}

<?php

use yii\db\Migration;

class m171106_134847_my_rent_door_lock_external_di extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{door_lock}}','external_id', $this->integer(20));
        $this->addColumn('{{door_lock}}','user_id', $this->integer());
        $this->addColumn('{{door_lock}}','myrent_update', $this->integer(15));

        $this->addColumn('{{apartment}}','country', $this->string(100));
        $this->addColumn('{{apartment}}','guid', $this->string(255));
        $this->addColumn('{{apartment}}','myrent_update', $this->integer(15));

        $this->addColumn('{{booking}}','in_advance', $this->float(20));
        $this->addColumn('{{booking}}','rent_adults', $this->integer());
        $this->addColumn('{{booking}}','rent_children', $this->integer());
        $this->addColumn('{{booking}}','rent_status', $this->string(20));
        $this->addColumn('{{booking}}','currency_id', $this->integer());
        $this->addColumn('{{booking}}','note', $this->text(1000));
        $this->addColumn('{{booking}}','myrent_update', $this->integer(15));

        $this->addColumn('{{guest}}','contact_country', $this->string(100));
        $this->addColumn('{{guest}}','contact_country_code1', $this->string(5));
        $this->addColumn('{{guest}}','contact_name', $this->string(255));
        $this->addColumn('{{guest}}','myrent_update', $this->integer(15));

        $this->addColumn('{{users}}','external_id', $this->integer());
        $this->createIndex('{{%idx-users-external_id}}', '{{%users}}', 'external_id');

        $this->createIndex('{{%idx-door_lock-user_id}}', '{{%door_lock}}', 'user_id');
        $this->addForeignKey('{{%fk-door_lock-user_id}}', '{{%door_lock}}', 'user_id', '{{%users}}', 'id', 'CASCADE');

    }

    public function safeDown()
    {
        echo "m171104_213536_my_rent_worker_owner_user_update_duble2 cannot be reverted.\n";

        $this->dropForeignKey('{{%fk-door_lock-user_id}}',"door_lock");
        $this->dropColumn('{{door_lock}}','external_id');
        $this->dropColumn('{{door_lock}}','user_id');
        $this->dropColumn('{{door_lock}}','myrent_update');

        $this->dropColumn('{{apartment}}','country');
        $this->dropColumn('{{apartment}}','guid');
        $this->dropColumn('{{apartment}}','myrent_update');

        $this->dropColumn('{{booking}}','in_advance');
        $this->dropColumn('{{booking}}','rent_adults');
        $this->dropColumn('{{booking}}','rent_children');
        $this->dropColumn('{{booking}}','rent_status');
        $this->dropColumn('{{booking}}','currency_id');
        $this->dropColumn('{{booking}}','note');
        $this->dropColumn('{{booking}}','myrent_update');

        $this->addColumn('{{guest}}','contact_country');
        $this->addColumn('{{guest}}','contact_country_code1');
        $this->addColumn('{{guest}}','contact_name');
        $this->dropColumn('{{guest}}','myrent_update');

        $this->dropIndex('{{%idx-users-external_id}}', '{{%users}}');
        $this->dropColumn('{{users}}','external_id');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171106_134847_my_rent_door_lock_external_di cannot be reverted.\n";

        return false;
    }
    */
}

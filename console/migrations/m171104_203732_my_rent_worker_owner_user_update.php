<?php

use yii\db\Migration;

class m171104_203732_my_rent_worker_owner_user_update extends Migration
{
    public function safeUp()
    {

        $this->renameTable('{{%receptionist}}', '{{%worker}}');


        $this->addColumn('{{apartment}}','user_id', $this->integer());
        $this->createIndex('{{%idx-apartment-user_id}}', '{{%apartment}}', 'user_id');
        $this->addForeignKey('{{%fk-apartment-user_id}}', '{{%apartment}}', 'user_id', '{{%users}}', 'id', 'SET NULL');

        $this->addColumn('{{apartment}}','worker_id', $this->integer());
        $this->createIndex('{{%idx-apartment-worker_id}}', '{{%apartment}}', 'worker_id');
        $this->addForeignKey('{{%fk-apartment-worker_id}}', '{{%apartment}}', 'worker_id', '{{%users}}', 'id', 'SET NULL');

    }

    public function safeDown()
    {
        echo "m171104_203732_my_rent_worker_owner_user_update cannot be reverted.\n";
        $this->renameTable('{{%worker}}','{{%receptionist}}');

        $this->dropForeignKey('{{%fk-apartment-user_id}}', '{{%apartment}}');
        $this->dropIndex('{{%idx-apartment-user_id}}', '{{%apartment}}');
        $this->dropColumn('{{apartment}}','user_id');

        $this->dropIndex('{{%idx-apartment-worker_id}}', '{{%apartment}}');
        $this->dropForeignKey('{{%fk-apartment-worker_id}}', '{{%apartment}}');
        $this->dropColumn('{{apartment}}','worker_id');


        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171104_203732_my_rent_worker_owner_user_update cannot be reverted.\n";

        return false;
    }
    */
}

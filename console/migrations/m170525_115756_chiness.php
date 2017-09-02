<?php

use yii\db\Migration;

class m170525_115756_chiness extends Migration
{
    public function up()
    {
        $this->addColumn('{{%key}}', 'remarks', $this->text());
        $this->addColumn('{{%key}}', 'email', $this->string());
        $this->addColumn('{{%key}}', 'key_status', $this->string());
        $this->addColumn('{{%key}}', 'key_id', $this->integer());

        $this->addColumn('{{%keyboard_pwd}}', 'keyboard_pwd_id', $this->string());

        $this->addColumn('{{%door_lock}}', 'lock_id', $this->integer());
        $this->addColumn('{{%door_lock}}', 'lock_mac', $this->string());
        $this->addColumn('{{%door_lock}}', 'lock-alias', $this->string());
        $this->addColumn('{{%door_lock}}', 'lock_name', $this->string());
        $this->addColumn('{{%door_lock}}', 'electric_quantity', $this->integer());
        $this->addColumn('{{%door_lock}}', 'last_update_date', $this->string(15));


        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%lock_version}}', [
            'id' => $this->primaryKey(),
            'group_id' => $this->integer(),
            'protocol_version' => $this->integer(),
            'protocol_type' => $this->integer(),
            'org_idd' => $this->integer(),
            "logo_url" => $this->string(16),
            'scene' => $this->integer(),
//            'door_lock_id' => $this->integer(),
        ], $tableOptions);

//        $this->createIndex('{{%idx-lock_version-door_lock_id}}', '{{%lock_version}}', 'door_lock_id');
//        $this->addForeignKey('{{%fk-lock_version-door_lock_id}}', '{{%lock_version}}', 'door_lock_id', '{{%door_lock}}', 'id', 'CASCADE');

    }

    public function down()
    {
        $this->dropColumn('{{%key}}', 'remarks');
        $this->dropColumn('{{%key}}', 'email');
        $this->dropColumn('{{%key}}', 'key_status');
        $this->dropColumn('{{%key}}', 'key_id');

        $this->dropColumn('{{%keyboard_pwd}}', 'keyboardPwdId');

        $this->dropColumn('{{%door_lock}}', 'lock_id');
        $this->dropColumn('{{%door_lock}}', 'lock_mac');
        $this->dropColumn('{{%door_lock}}', 'lock-alias');
        $this->dropColumn('{{%door_lock}}', 'lock_name');
        $this->dropColumn('{{%door_lock}}', 'electric_quantity');
        $this->dropColumn('{{%door_lock}}', 'last_update_date');

        

        $this->dropTable('{{%lock_version}}');
    }

}    
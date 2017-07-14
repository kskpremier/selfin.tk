<?php

use yii\db\Migration;

class m170601_055516_expand_door_lock extends Migration
{
    public function up()
    {
        $this->addColumn('{{%door_lock}}', 'flag_pos', $this->integer());
        $this->addColumn('{{%key}}', 'aes_key_str', $this->string(50));
        $this->addColumn('{{%door_lock}}', 'no_key_pwd', $this->string());
        $this->addColumn('{{%door_lock}}', 'delete_pwd', $this->string());
        $this->addColumn('{{%door_lock}}', 'pwd_info', $this->string());
        $this->addColumn('{{%door_lock}}', 'timestamp', $this->string(15));
        $this->addColumn('{{%door_lock}}', 'special_value', $this->integer());
        $this->addColumn('{{%door_lock}}', 'timezone_raw_offset', $this->integer());

        $this->addColumn('{{%key}}', 'last_update_date', $this->string(15));
        $this->addColumn('{{%key}}', 'open_id', $this->integer());
        $this->addColumn('{{%key}}', 'lock_key', $this->string(50));

        $this->addColumn('{{%booking}}', 'status', $this->integer());


        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%door_lock_user}}', [
            'id' => $this->primaryKey(),
            'client_id' => $this->string(),
            'client_secret' => $this->string(),
            'username' => $this->string(),
            'password' => $this->string(),

        ], $tableOptions);

        $this->createIndex('{{%idx-door_lock-lock_version_id}}', '{{%door_lock}}', 'lock_version_id');
        $this->addForeignKey('{{%fk-door_lock-lock_version}}', '{{%door_lock}}', 'lock_version_id', '{{%lock_version}}', 'id', 'CASCADE');


    }

    public function down()
    {
        $this->dropColumn('{{%door_lock}}', 'flag_pos');
        $this->dropColumn('{{%key}}', 'aes_key_str');
        $this->dropColumn('{{%door_lock}}', 'no_key_pwd');
        $this->dropColumn('{{%door_lock}}', 'delete_pwd');
        $this->dropColumn('{{%door_lock}}', 'pwd_info');
        $this->dropColumn('{{%door_lock}}', 'timestamp');
        $this->dropColumn('{{%door_lock}}', 'special_value');
        $this->dropColumn('{{%door_lock}}', 'timezone_raw_offset');
        $this->dropcolumn('{{%key}}', 'lock_key');

        $this->dropColumn('{{%booking}}', 'status');

        $this->dropColumn('{{%key}}', 'open_id');
        $this->dropColumn('{{%key}}', 'last_update_date');

        $this->dropTable('{{%door_lock_user}}');
    }

}

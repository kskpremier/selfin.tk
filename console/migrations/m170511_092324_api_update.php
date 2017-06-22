<?php

use yii\db\Migration;

class m170511_092324_api_update extends Migration
{
    public function up()
    {



        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->addColumn('{{%key}}', 'door_lock_id', $this->integer());
        $this->addColumn('{{%key}}', 'type', $this->string());
        $this->createIndex('idx-key-door_lock_id', '{{%key}}', 'door_lock_id');
        $this->addForeignKey('fk-key-door_lock_id', '{{%key}}', 'door_lock_id', '{{%door_lock}}', 'id', 'CASCADE', 'RESTRICT');

        //таблица для хранения инфо о сгенерированных пинах
        $this->createTable('{{%keyboard_pwd}}', [
            'id' => $this->primaryKey(), //внутренний уникальный идентификатор
            'start_date'=> $this->dateTime(),
            'end_date' => $this->dateTime(),
            'value' => $this->integer(),
            'keyboard_pwd_type'=>$this->string(),
            'keyboard_pwd_version'=>$this->integer(),
            'door_lock_id'=>$this->integer(),
            'booking_id'=>$this->integer(),

        ], $tableOptions);

        //связь ключа с заявкой на букирование
        $this->createIndex('idx-keyboard_pwd-booking_id', '{{%keyboard_pwd}}', 'booking_id');
        $this->addForeignKey('fk-keyboard_pwd-booking_id', '{{%keyboard_pwd}}', 'booking_id', '{{%booking}}', 'id', 'CASCADE', 'RESTRICT');
        $this->createIndex('idx-keyboard_pwd-door_lock_id', '{{%keyboard_pwd}}', 'door_lock_id');
        $this->addForeignKey('fk-keyboard_pwd-door_lock_id', '{{%keyboard_pwd}}', 'door_lock_id', '{{%door_lock}}', 'id', 'CASCADE', 'RESTRICT');

    }

    public function down()
    {
        echo "m170511_092324_api_update cannot be reverted.\n";

        $this->dropTable('{{%keyboard_pwd}}');
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

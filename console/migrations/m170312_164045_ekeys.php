<?php

use yii\db\Migration;

class m170312_164045_ekeys extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        //таблица для хранения инфо о выданных гостям ключах
        $this->createTable('{{%key}}', [
            'id' => $this->primaryKey(), //внутренний уникальный идентификатор
            'from'=> $this->dateTime(),
            'till' => $this->dateTime(),
            'pin' => $this->integer(),
            'e_key'=>$this->string(15),
            'booking_id'=>$this->integer(),

        ], $tableOptions);

        //связь ключа с заявкой на букирование
        $this->createIndex('idx-apartment-booking_id', '{{%key}}', 'booking_id');
        $this->addForeignKey('fk-apartment-booking_id', '{{%key}}', 'booking_id', '{{%booking}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%key}}');
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

<?php

use yii\db\Migration;

class m170312_131746_manyTOmany extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        //создание промежуточной таблицы для связи букингов и гостей
        //уходим от связи многие-ко-многим двух таблиц к
        // двум таблицам и промежуточной, связанных 1-М - М-1
//        $this->createTable('{{%booking_guest}}', [
//
//            'booking_id' => $this->integer()->primaryKey(),
//            'guest_id' => $this->integer()->primaryKey(),
//
//        ], $tableOptions);

        $this->createTable('{{%booking_guest}}', [
            'booking_id' =>'int NOT NULL',
            'guest_id' =>'int NOT NULL',
            'PRIMARY KEY (guest_id,booking_id)'
        ], $tableOptions);


//        //связь букинга с гостем, на которого оформлен букинг
//
//        $this->dropForeignKey('fk-booking-guest_id', '{{%booking}}', 'guest_id', '{{%guest}}', 'id', 'CASCADE', 'RESTRICT');
//        $this->dropIndex('idx-booking-guest_id', '{{%booking}}', 'guest_id');
        //связь гостя со списком гостей в букинге
//        $this->createIndex('idx-booking_guest-guest_id', '{{%booking_guest}}', 'guest_id');
        $this->addForeignKey('fk-booking_guest-guest_id', '{{%booking_guest}}', 'guest_id', '{{%guest}}', 'id', 'CASCADE', 'RESTRICT');
        //связь букинга со списком гостей
//        $this->createIndex('idx-booking_guest-booking_id', '{{%booking_guest}}', 'booking_id');
        $this->addForeignKey('fk-booking_guest-booking_id', '{{%booking_guest}}', 'booking_id', '{{%booking}}', 'id', 'CASCADE', 'RESTRICT');


    }

    public function down()
    {
        $this->dropTable('{{%booking_guest}}');
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
}<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 08.04.17
 * Time: 19:46
 */
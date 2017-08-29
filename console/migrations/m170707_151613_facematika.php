<?php

use yii\db\Migration;

class m170707_151613_facematika extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        //таблица для хранения инфо про выданные фейсматикой токенах
        $this->createTable('{{%facematika}}', [
            'id' => $this->primaryKey(), //внутренний уникальный идентификатор
            'token'=> $this->string(255),
            'type'=> $this->string(50),
            'expires' => $this->string(255),
            'status' => $this->integer(1),
        ], $tableOptions);

        //связь ключа с заявкой на букирование
    }

    public function safeDown()
    {
        $this->dropTable('{{%facematika}}');
    }

}

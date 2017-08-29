<?php

use yii\db\Migration;

class m170710_095246_ttl extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        //таблица для хранения инфо про выданные фейсматикой токенах
        $this->createTable('{{%ttl}}', [
            'id' => $this->primaryKey(), //внутренний уникальный идентификатор
            'access_token'=> $this->string(255),
            'refresh_token'=> $this->string(255),
            'openid'=> $this->integer(),
            'scope'=> $this->string(50),
            'expires_in' => $this->integer(),
            'status' => $this->integer(1),
            'expires' => $this->string(255),
            'user_id' => $this->integer(1),
            'client_id'=>$this->string(255),
            'client_secret'=>$this->string(255),
        ], $tableOptions);

        $this->createIndex('idx-ttl-user_id', '{{%ttl}}', 'user_id');
        $this->addForeignKey('fk-ttl-user_id', '{{%ttl}}', 'user_id', '{{%users}}', 'id', 'CASCADE', 'RESTRICT');

    }

    public function safeDown()
    {
        $this->dropTable('{{%ttl}}');
    }

}

<?php

use yii\db\Migration;

class m170414_211808_token_update extends Migration
{
    public function up()
    {
        $this->dropTable('{{%token}}');

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%token}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'token' => $this->string()->notNull()->unique(),
            'expired_at' => $this->integer()->notNull(),
        ], $tableOptions);
        $this->createIndex('idx-token-user_id', '{{%token}}', 'user_id');
        $this->addForeignKey('fk-token-user_id', '{{%token}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');

    }

    public function down()
    {
        $this->dropTable('{{%token}}');

        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('{{%token}}', [
            'id' => $this->primaryKey(), //внутренний уникальный идентификатор
            'token' => $this->string()->notNull(),
            'expires' => $this->timestamp()->notNull(),
            'type' => $this->string()->notNull(),
        ], $tableOptions);
        $this->createIndex('idx-token-door_lock_id', '{{%token}}', 'door_lock_id');
        $this->addForeignKey('fk-token-door_lock_id', '{{%token}}', 'door_lock_id', '{{%door_lock}}', 'id', 'CASCADE', 'RESTRICT');
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

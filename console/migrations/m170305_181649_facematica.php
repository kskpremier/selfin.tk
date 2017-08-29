<?php

use yii\db\Migration;

class m170305_181649_facematica extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%token}}', [
            'id' => $this->primaryKey(), //внутренний уникальный идентификатор
            'token' => $this->string()->notNull(),
            'expires' => $this->timestamp()->notNull(),
            'type' => $this->string()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
//        echo "m170305_181649_facematica cannot be reverted.\n";
        $this->dropTable('{{%token}}');
//        return false;
    }

}

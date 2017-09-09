<?php

use yii\db\Migration;

class m170908_111736_owner extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%owner}}', [
            'id' => $this->primaryKey(),
            'external_id' => $this->string(),
            'user_id' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('{{%idx-owner-user_id}}', '{{%owner}}', 'user_id');
        $this->addForeignKey('{{%fk-owner-user_id}}', '{{%owner}}', 'user_id', '{{%users}}', 'id', 'CASCADE');

        $this->addColumn('{{apartment}}','owner_id', $this->integer());

        $this->createIndex('{{%idx-apartment-owner_id}}', '{{%apartment}}', 'owner_id');
        $this->addForeignKey('{{%fk-apartment-owner_id}}', '{{%apartment}}', 'owner_id', '{{%owner}}', 'id', 'CASCADE');

    }

    public function down()
    {
        $this->dropIndex('{{%idx-apartment-owner_id}}', '{{%apartment}}');
        $this->dropForeignKey('{{%fk-apartment-owner_id}}', '{{%apartment}}');
        $this->dropColumn('{{apartment}}','owner_id');

        $this->dropIndex('{{%idx-owner-user_id}}', '{{%owner}}');
        $this->dropForeignKey('{{%fk-owner-user_id}}', '{{%owner}}');
        $this->dropTable('{{%owner}}');
    }

}

<?php

use yii\db\Migration;

class m171101_155208_receptionist extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%receptionist}}', [
            'id' => $this->primaryKey(),
            'external_id' => $this->string(),
            'user_id' => $this->integer(),
            //'owner_id' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('{{%idx-receptionist-user_id}}', '{{%receptionist}}', 'user_id');
        $this->addForeignKey('{{%fk-receptionist-user_id}}', '{{%receptionist}}', 'user_id', '{{%users}}', 'id', 'CASCADE');

//        $this->createIndex('{{%idx-receptionist-owner_id}}', '{{%receptionist}}', 'owner_id');
//        $this->addForeignKey('{{%fk-receptionist-owner_id}}', '{{%receptionist}}', 'owner_id', '{{%owner}}', 'id', 'CASCADE');

        $this->addColumn('{{owner}}','receptionist_id', $this->integer());

        $this->createIndex('{{%idx-owner-receptionist_id}}', '{{%owner}}', 'receptionist_id');
        $this->addForeignKey('{{%fk-owner-receptionist_id}}', '{{%owner}}', 'receptionist_id', '{{%receptionist}}', 'id', 'CASCADE');
    }

    public function safeDown()
    {
        echo "m171101_155208_receptionist cannot be reverted.\n";

        $this->dropForeignKey('{{%fk-owner-receptionist_id}}',"owner");
        $this->dropColumn("owner", 'receptionist_id');

        $this->dropTable("receptionist");


        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171101_155208_receptionist cannot be reverted.\n";

        return false;
    }
    */
}

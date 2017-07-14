<?php

use yii\db\Migration;

class m170606_201423_feces_compearing extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%face_comparation}}', [
            'origin_id' => $this->integer()->notNull(),
            'face_id'=>$this->string()->notNull(),
            'probability' => $this->float(20),
            'created_at' => $this->dateTime()->defaultValue('CURRENT_TIMESTAMP'),
            'PRIMARY KEY (origin_id,face_id)',

        ], $tableOptions);

        $this->createIndex('idx-face_comparation-origin_id', '{{%face_comparation}}', 'origin_id');
        $this->createIndex('idx-face_comparation-face_id', '{{%face_comparation}}', 'face_id');
        $this->addForeignKey('fk-face_comparation-origin_id', '{{%face_comparation}}', 'origin_id', '{{%face}}', 'id', 'CASCADE', 'RESTRICT');

    }

    public function down()
    {
        $this->dropTable('{{%face_comparation}}');
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

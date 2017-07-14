<?php

use yii\db\Migration;

class m170601_224054_faces extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%face}}', [
            'id' => $this->primaryKey(),
            'face_id' => $this->string(),
            'x' => $this->float(15),
            'y' => $this->float(15),
            'width' => $this->float(15),
            'angle' => $this->float(15),
            'photo_image_id'=>$this->integer()

        ], $tableOptions);

        $this->createIndex('{{%idx-face-photo_image_id}}', '{{%face}}', 'photo_image_id');
        $this->addForeignKey('{{%fk-face-photo_image}}', '{{%face}}', 'photo_image_id', '{{%photo_image}}', 'id', 'CASCADE');

        $this->addColumn('{{%photo_image}}', 'type', $this->string(15));
        $this->addColumn('{{%photo_image}}', 'dimensions', $this->string(15));
        $this->addColumn('{{%photo_image}}', 'size', $this->integer());
        $this->addColumn('{{%photo_image}}', 'uploaded', $this->string());
        $this->addColumn('{{%photo_image}}', 'facematika_id', $this->string());

    }

    public function down()
    {
        $this->dropIndex('{{%idx-face-photo_image_id}}', '{{%face}}');
        $this->dropForeignKey('{{%fk-face-photo_image}}', '{{%face}}');
        $this->dropTable('{{%face}}');

        $this->dropColumn('{{%photo_image}}', 'type', $this->string(15));
        $this->dropColumn('{{%photo_image}}', 'dimensions', $this->string(15));
        $this->dropColumn('{{%photo_image}}', 'size', $this->integer());
        $this->dropColumn('{{%photo_image}}', 'uploaded', $this->string());
        $this->dropColumn('{{%photo_image}}', 'facematika_id', $this->string());
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

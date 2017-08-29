<?php

use yii\db\Migration;

class m170306_113543_adding_image_camera_connection extends Migration
{
    public function up()
    {
        //связи фото изображения - камера
        $this->createIndex('idx-photo_image-camera_id', '{{%photo_image}}', 'camera_id');
        $this->addForeignKey('fk-photo_image-camera_id', '{{%photo_image}}', 'camera_id', '{{%camera}}', 'id', 'CASCADE', 'RESTRICT');


    }

    public function down()
    {
        echo "m170306_113543_adding_image_camera_connection cannot be reverted.\n";

        return false;
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

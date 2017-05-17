<?php

use yii\db\Migration;

class m170515_131924_photo_image_update extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->addColumn('{{%photo_image}}', 'user_id', $this->integer());
        $this->addColumn('{{%photo_image}}', 'booking_id', $this->integer());

        $this->createIndex('idx-photo_image-user_id', '{{%photo_image}}', 'user_id');
        $this->addForeignKey('fk-photo_image-user_id', '{{%photo_image}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');

        $this->createIndex('idx-photo_image-booking_id', '{{%photo_image}}', 'booking_id');
        $this->addForeignKey('fk-photo_image-booking_id', '{{%photo_image}}', 'booking_id', '{{%booking}}', 'id', 'CASCADE', 'RESTRICT');

    }

    public function down()
    {
       $this->dropForeignKey('fk-photo_image-booking_id','{{%photo_image}}');
       $this->dropForeignKey('fk-photo_image-user_id','{{%photo_image}}');

       $this->dropIndex('fk-photo_image-booking_id','{{%photo_image}}');
       $this->dropIndex('fk-photo_image-user_id','{{%photo_image}}');

       $this->dropColumn('{{%photo_image}}', 'user_id');
       $this->dropColumn('{{%photo_image}}', 'booking_id');

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

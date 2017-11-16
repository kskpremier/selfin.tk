<?php

use yii\db\Migration;

class m170910_193831_document_photo_face_extraction extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%face}}', 'photo_document_id', $this->integer());
        $this->addColumn('{{%photo_document}}', 'status', $this->integer());

        $this->createIndex('{{%idx-face-photo_document_id}}', '{{%face}}', 'photo_document_id');
        $this->addForeignKey('{{%fk-face-photo_document_id}}', '{{%face}}', 'photo_document_id', '{{%photo_document}}', 'id', 'CASCADE');

        $this->addColumn('{{%photo_document}}', 'type', $this->string(15));
        $this->addColumn('{{%photo_document}}', 'dimensions', $this->string(15));
        $this->addColumn('{{%photo_document}}', 'size', $this->integer());
        $this->addColumn('{{%photo_document}}', 'uploaded', $this->string());
        $this->addColumn('{{%photo_document}}', 'facematika_id', $this->string());
    }

    public function safeDown()
    {
        $this->dropIndex('{{%idx-face-photo_document_id}}', '{{%face}}');
        $this->dropForeignKey('{{%fk-face-photo_document_id}}', '{{%face}}');
        $this->dropColumn('{{%face}}', 'photo_document_id');

        $this->dropColumn('{{%photo_document}}', 'type', $this->string(15));
        $this->dropColumn('{{%photo_document}}', 'dimensions', $this->string(15));
        $this->dropColumn('{{%photo_document}}', 'size', $this->integer());
        $this->dropColumn('{{%photo_document}}', 'uploaded', $this->string());
        $this->dropColumn('{{%photo_document}}', 'facematika_id', $this->string());
        $this->dropColumn('{{%photo_document}}', 'status');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170910_193831_document_photo_face_extraction cannot be reverted.\n";

        return false;
    }
    */
}

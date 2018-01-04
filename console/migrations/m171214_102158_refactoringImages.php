<?php

use reception\entities\Image\Album;
use yii\db\Migration;

/**
 * Class m171214_102158_refactoringImages
 */
class m171214_102158_refactoringImages extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->dropTable('{{%image}}');

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%image}}', [
            'id' => $this->primaryKey(),
            'type' => $this->string(15)->defaultValue(null),
            'file_name' => $this->string(255)->defaultValue(null),
            'facematika_id' => $this->string()->defaultValue(null),
            'date' => $this->string(20)->defaultValue(null),
            'status' => $this->smallInteger()->defaultValue(10),
            'album_id' => $this->integer(11),
            'booking_id' => $this->integer(11),
            'document_id' => $this->integer(11),
            'size' => $this->integer()->notNull(11),
            'uploaded' => $this->string(255),
            'dimensions' => $this->string(15),

        ], $tableOptions);

        $this->addColumn('{{%album}}', 'description', $this->string());
        $album = Album::findOne(1);
        if ($album) {}
        else {
            $album = new Album();
            $album->id=1;
            $album->name="Unrecognized";
            $album->description="Album for non-recognize images";
            $album->save();
        }
        $album = Album::findOne(2);
        if ($album) {}
        else {
            $album = new Album();
            $album->id=2;
            $album->name="Faces";
            $album->description="Album for faces that just detected";
            $album->save();
        }

        $this->addColumn('{{%image}}', 'user_id', $this->integer());
        $this->addColumn('{{%image}}', 'booking_id', $this->integer());

        $this->createIndex('idx-image-document_id', '{{%image}}', 'document_id');
        $this->addForeignKey('fk-image-document_id', '{{%image}}', 'document_id', '{{%document}}', 'id', 'CASCADE', 'RESTRICT');

        $this->createIndex('idx-image-album_id', '{{%image}}', 'album_id');
        $this->addForeignKey('fk-image-album_id', '{{%image}}', 'album_id', '{{%album}}', 'id', 'CASCADE', 'RESTRICT');

        $this->createIndex('idx-image-booking_id', '{{%image}}', 'booking_id');
        $this->addForeignKey('fk-image-booking_id', '{{%image}}', 'booking_id', '{{%booking}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m171214_102158_refactoringImages cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171214_102158_refactoringImages cannot be reverted.\n";

        return false;
    }
    */
}

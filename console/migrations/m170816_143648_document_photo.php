<?php

use yii\db\Migration;

class m170816_143648_document_photo extends Migration
{
    public function safeUp()
    {

    }

    public function up()
    {
        $this->addColumn('{{photo_document}}','document_id',$this->integer());

        $this->createIndex('idx-photo_document-document_id', '{{%photo_document}}', 'document_id');
        $this->addForeignKey('fk-photo_document-document_id', '{{%photo_document}}', 'document_id', '{{%document}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }
*/
    public function down()
    {

        $this->dropForeignKey('fk-photo_document-document_id', '{{%photo_document}}');
        $this->dropIndex('idx-photo_document-document_id', '{{%photo_document}}');
        $this->dropColumn('{{photo_document}}','document_id');
    }

}

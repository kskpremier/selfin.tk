<?php

use yii\db\Migration;

class m170829_144716_document_connections_application extends Migration
{
    public function safeUp()
    {
        $this->dropForeignKey('fk-photo_document-application_id', '{{%photo_document}}');
        $this->dropIndex('idx-photo_document-application_id', '{{%photo_document}}');
        $this->dropColumn('{{photo_document}}','application_id');

        $this->dropColumn('{{photo_document}}','date');
        $this->addColumn('{{photo_document}}','date', $this->string(20));
    }

    public function safeDown()
    {
        echo "m170829_144716_document_connections_application cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170829_144716_document_connections_application cannot be reverted.\n";

        return false;
    }
    */
}

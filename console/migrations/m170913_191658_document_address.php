<?php

use yii\db\Migration;

class m170913_191658_document_address extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%document}}', 'address', $this->string());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%document}}', 'address');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170913_191658_document_address cannot be reverted.\n";

        return false;
    }
    */
}

<?php

use yii\db\Migration;

class m170628_162328_geotagging extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%photo_image}}', 'latitude', $this->double());
        $this->addColumn('{{%photo_image}}', 'longitude', $this->double());
        $this->addColumn('{{%photo_image}}', 'altitude', $this->double());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%photo_image}}', 'latitude');
        $this->dropColumn('{{%photo_image}}', 'longitude');
        $this->dropColumn('{{%photo_image}}', 'altitude');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170628_162328_geotagging cannot be reverted.\n";

        return false;
    }
    */
}

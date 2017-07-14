<?php

use yii\db\Migration;

class m170615_094909_external_id_fields_in_booking_apartment extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%booking}}', 'external_id', $this->string(20));
        $this->addColumn('{{%apartment}}', 'external_id', $this->string(20));
        $this->createIndex('idx-booking-external_id', '{{%booking}}', 'external_id');
        $this->createIndex('idx-apartment-external_id', '{{%apartment}}', 'external_id');

    }

    public function safeDown()
    {
        $this->dropColumn('{{%booking}}', 'external_id');
        $this->dropColumn('{{%apartment}}', 'external_id');
        $this->dropIndex('idx-booking-external_id', '{{%booking}}');
        $this->dropIndex('idx-apartment-external_id', '{{%apartment}}');
    }

}

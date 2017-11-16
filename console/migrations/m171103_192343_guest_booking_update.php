<?php

use yii\db\Migration;

class m171103_192343_guest_booking_update extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%booking}}', 'guid', $this->string(50));
        $this->addColumn('{{%booking}}', 'rent_status', $this->string(20));
        $this->addColumn('{{%booking}}', 'from_time', $this->string(8));
        $this->addColumn('{{%booking}}', 'until_time', $this->string(8));
        $this->addColumn('{{%booking}}', 'price', $this->float());
        $this->addColumn('{{%booking}}', 'exchange', $this->float());
        $this->addColumn('{{%booking}}', 'label', $this->string(5));
        $this->addColumn('{{%booking}}', 'price_local', $this->float());
        $this->addColumn('{{%booking}}', 'paid', $this->string(1));
        $this->addColumn('{{%booking}}', 'created', $this->string(20));
        $this->addColumn('{{%booking}}', 'changed', $this->string(20));

        $this->addColumn('{{%guest}}', 'contact_tel', $this->string(20));

        $this->addColumn('{{%apartment}}', 'latitude', $this->float(20));
        $this->addColumn('{{%apartment}}', 'longitude', $this->float(20));
        $this->addColumn('{{%apartment}}', 'city_name', $this->string(50));
        $this->addColumn('{{%apartment}}', 'adress', $this->string(250));
        $this->addColumn('{{%apartment}}', 'object_color', $this->string(10));


    }

    public function safeDown()
    {
        echo "m171103_192343_guest_booking_update cannot be reverted.\n";

        $this->dropColumn('{{%photo_document}}', 'type');
        $this->dropColumn('{{%booking}}', 'guid');
        $this->dropColumn('{{%booking}}', 'rent_status');
        $this->dropColumn('{{%booking}}', 'from_time');
        $this->dropColumn('{{%booking}}', 'until_time');
        $this->dropColumn('{{%booking}}', 'price');
        $this->dropColumn('{{%booking}}', 'exchange');
        $this->dropColumn('{{%booking}}', 'label');
        $this->dropColumn('{{%booking}}', 'price_local');
        $this->dropColumn('{{%booking}}', 'paid');
        $this->dropColumn('{{%booking}}', 'created');
        $this->dropColumn('{{%booking}}', 'changed');
        $this->dropColumn('{{%guest}}', 'contact_tel');

        $this->dropColumn('{{%apartment}}', 'latitude');
        $this->dropColumn('{{%apartment}}', 'longitude');
        $this->dropColumn('{{%apartment}}', 'city_name');
        $this->dropColumn('{{%apartment}}', 'adress');
        $this->dropColumn('{{%apartment}}', 'object_color');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171103_192343_guest_booking_update cannot be reverted.\n";

        return false;
    }
    */
}

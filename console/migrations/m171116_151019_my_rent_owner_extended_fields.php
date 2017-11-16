<?php

use yii\db\Migration;

class m171116_151019_my_rent_owner_extended_fields extends Migration
{
    public function safeUp()

        //$external_id, $guid, $name, $country_id, $tel, $email,
//                                   $contact_name, $created, $changed, $language_id, $country,
//                                   $name_local, $telephone_code,  $user_id,
    {
        $this->addColumn('{{owner}}','contact_name', $this->string(255));
        $this->addColumn('{{owner}}','myrent_update', $this->integer(15));
        $this->addColumn('{{owner}}','guid', $this->string(255));
        $this->addColumn('{{owner}}','contact_tel', $this->string(255));
        $this->addColumn('{{owner}}','contact_email', $this->string(255));
        $this->addColumn('{{owner}}','country_id', $this->string(5));
        $this->addColumn('{{owner}}','created', $this->integer(15));
        $this->addColumn('{{owner}}','changed', $this->integer(15));
        $this->addColumn('{{guest}}','guid', $this->string(255));
        $this->addColumn('{{guest}}','country_id', $this->string(5));
    }

    public function safeDown()
    {
        echo "m171104_213536_my_rent_worker_owner_user_update_duble2 cannot be reverted.\n";

        $this->dropColumn('{{owner}}','contact_name');
        $this->dropColumn('{{owner}}','myrent_update');
        $this->dropColumn('{{owner}}','guid');
        $this->dropColumn('{{owner}}','contact_tel');
        $this->addColumn('{{owner}}','contact_name');
        $this->dropColumn('{{owner}}','created');
        $this->dropColumn('{{owner}}','changed');
        $this->dropColumn('{{owner}}','country_id');
        $this->dropColumn('{{owner}}','update');
        $this->dropColumn('{{guest}}','guid');
        $this->dropColumn('{{guest}}','country_id');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171116_151019_my_rent_owner_extended_fields cannot be reverted.\n";

        return false;
    }
    */
}

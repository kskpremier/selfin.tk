<?php

use yii\db\Migration;

class m170803_122219_document_guest extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{document}}','gender',$this->string(10));
        $this->addColumn('{{document}}','city',$this->string(10));
        $this->addColumn('{{document}}','country_of_birth_id',$this->integer());
        $this->addColumn('{{document}}','citizenship_of_birth_id',$this->integer());
        $this->addColumn('{{document}}','city_of_birth',$this->string(50));
        $this->addColumn('{{document}}','date_of_birth',$this->string(15));

        
    }

    public function safeDown()
    {
        $this->dropColumn('{{document}}','gender');
        $this->dropColumn('{{document}}','city');
        $this->dropColumn('{{document}}','country_of_birth_id');
        $this->dropColumn('{{document}}','citizenship_of_birth_id');
        $this->dropColumn('{{document}}','city_of_birth');
        $this->dropColumn('{{document}}','date_of_birth');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170803_122219_document_guest cannot be reverted.\n";

        return false;
    }
    */
}

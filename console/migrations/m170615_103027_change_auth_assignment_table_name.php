<?php

use yii\db\Migration;

class m170615_103027_change_auth_assignment_table_name extends Migration
{

    public function up()
    {
        $this->renameTable('{{%auth_assignment}}', '{{%auth_assignments}}');
    }

    public function down()
    {
        $this->renameTable('{{%auth_assignments}}', '{{%auth_assignment}}');
    }

}

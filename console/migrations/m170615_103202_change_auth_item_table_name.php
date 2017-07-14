<?php

use yii\db\Migration;

class m170615_103202_change_auth_item_table_name extends Migration
{
    public function up()
    {
        $this->renameTable('{{%auth_item}}', '{{%auth_items}}');
    }

    public function down()
    {
        $this->renameTable('{{%auth_items}}', '{{%auth_item}}');
    }
}

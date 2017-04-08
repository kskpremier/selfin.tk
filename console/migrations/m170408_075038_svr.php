<?php

use yii\db\Migration;

class m170408_075038_svr extends Migration
{
    public function up()
    {
//        Связь таблицы “Apartment” и таблицы “Door_Lock”. Удалить из  “Apartment” поле door_lock_id, добавить в таблицу “Door_Lock” поле apartment_id и соответствующую связь (constrain).
        //убиваю старые связи и индекс
        $this->dropForeignKey('fk-apartment-door_lock_id', '{{%apartment}}', 'door_lock_id', '{{%door_lock}}', 'id', 'CASCADE', 'RESTRICT');
        $this->dropIndex('idx-apartment-door_lock_id', '{{%apartment}}', 'door_lock_id');

        $this->dropColumn('{{%apartment}}', 'door_lock_id');
        //прописываю новые
        $this->addColumn('{{%door_lock}}', 'apartment_id', 'integer');
        $this->createIndex('idx-door_lock-apartment_id', '{{%door_lock}}', 'apartment_id');
        $this->addForeignKey('fk-door_lock-apartment', '{{%door_lock}}', 'apartment_id', '{{%apartment}}', 'id', 'CASCADE', 'RESTRICT');
//    2.       Связь таблицы “Apartment” и таблицы “camera”. Удалить из  “Apartment” поле camera_id, добавить в таблицу “camera” поле apartment_id и соответствующую связь (constrain).
        //убиваю старые связи и индекс

        $this->dropForeignKey('fk-apartment-camera_id', '{{%apartment}}', 'camera_id', '{{%camera}}', 'id', 'CASCADE', 'RESTRICT');
        $this->dropIndex('idx-apartment-camera_id', '{{%apartment}}', 'camera_id');
        $this->dropColumn('{{%apartment}}', 'camera_id');
        //прописываю новые
        $this->addColumn('{{%camera}}', 'apartment_id', 'integer');
        $this->createIndex('idx-camera-apartment_id', '{{%camera}}', 'apartment_id');
        $this->addForeignKey('fk-camera-apartment_id', '{{%camera}}', 'apartment_id', '{{%apartment}}', 'id', 'CASCADE', 'RESTRICT');

//
//    3.       В таблице “Apartment” изменить типы полей location, name.
//поменяй их вручную в самой базе, я так и сделал))
//    4.       Удалить таблицу “Application” со связями.
//пока не буду удалять - пусть болтается, не мешает она
//    5.       Добавить в таблицу “Guest” поле user_id для связи с таблицей “User”.

        $this->addColumn('{{%guest}}', 'user_id', 'integer');
        $this->createIndex('idx-guest-user_id', '{{%guest}}', 'user_id');
        $this->addForeignKey('fk-guest-user_id', '{{%guest}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');

//6.       Добавить в таблицу “Token” поле door_lock_id для связи с таблицей “ Door_Lock”. Добавить в таблицу “Token” поле начальной даты действия токена.

        $this->addColumn('{{%token}}', 'door_lock_id', 'integer');
        $this->createIndex('idx-token-door_lock_id', '{{%token}}', 'door_lock_id');
        $this->addForeignKey('fk-token-door_lock_id', '{{%token}}', 'door_lock_id', '{{%door_lock}}', 'id', 'CASCADE', 'RESTRICT');

//    7.       Перевернуть связь таблиц “Guest” и “Document”. Удалить из  “Guest” поле document_id, добавить в таблицу “Document” поле guest_id и соответствующую связь (constrain).
//что имеется в виду? что гость может иметь несколько документов?
        //убиваю старые связи и индекс

        $this->dropForeignKey('fk-guest-document_id', '{{%guest}}', 'document_id', '{{%document}}', 'id', 'CASCADE', 'RESTRICT');
        $this->dropIndex('idx-guest-document_id', '{{%guest}}', 'document_id');
        $this->dropColumn('{{%guest}}', 'document_id');
        //прописываю новые
        $this->addColumn('{{%document}}', 'guest_id', 'integer');
        $this->createIndex('idx-document-guest_id', '{{%document}}', 'guest_id');
        $this->addForeignKey('fk-document-guest_id', '{{%document}}', 'guest_id', '{{%guest}}', 'id', 'CASCADE', 'RESTRICT');

//    8.       Соответственно поправить модели и вьюшки.
    }

    public function down()
    {
        echo "m170408_075038_svr cannot be reverted.\n";

        //связи фото изображения - камера
       // ничего тут делать не буду, хотя это и неправильно
        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}

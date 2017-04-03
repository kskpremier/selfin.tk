<?php

use yii\db\Migration;

class m170304_130627_reception extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%document}}', [
            'id' => $this->primaryKey(), //внутренний уникальный идентификатор
            'first_name' => $this->string(32),
            'second_name' => $this->string(32),
            'number' => $this->string()->notNull(),
            'seria'=>$this->string(),
            'date_of_issue' => $this->string(),
            'photo_document_face_id' => $this->integer(), //ссылка на фото лица, если удалось выделить фото лица с документа
            'document_type_id' => $this->integer()->notNull()->defaultValue(10),
            'country_id' => $this->integer(),//ссылка на справочник стран
            'valid_before' => $this->date(),
            'photo_document_id'=>$this->integer(), //ссылка на фотографию документа
        ], $tableOptions);
        //справочная таблица типов документов
        $this->createTable('{{%document_type}}', [
            'id' => $this->primaryKey(), //внутренний уникальный идентификатор
            'name' => $this->string(32),
        ], $tableOptions);


        //справочная таблица стран
        $this->createTable('{{%country}}', [
            'id' => $this->primaryKey(), //внутренний уникальный идентификатор
            'name' => $this->string(32),
        ], $tableOptions);


        $this->createTable('{{%guest}}', [
            'id' => $this->primaryKey(), //внутренний уникальный идентификатор
            'first_name' => $this->string(32),
            'second_name' => $this->string(32),
            'contact_email'=>$this->string(), //контактный емейл
            'application_id'=>$this->integer(), //ссылка на приложение, если гость его имеет
            'document_id' => $this->integer(), //ссылка на документ, если он уже создан
        ], $tableOptions);

        //таблица для хранения установленных в апартаментах замков (предполагаем, что они могут менятся или их может быть несколько)
        $this->createTable('{{%application}}', [
            'id' => $this->primaryKey(), //внутренний уникальный идентификатор
            'name' => $this->string(),
            'type' => $this->string(),
            'token' => $this->string()//потом можно справочник
        ], $tableOptions);



        //таблица для хранения информации об апартаментах
        $this->createTable('{{%apartment}}', [
            'id' => $this->primaryKey(), //внутренний уникальный идентификатор
            'location' => $this->date(),
            'name' => $this->date(),
            'door_lock_id' => $this->integer()->notNull(),
            'camera_id' => $this->integer()->notNull(),

        ], $tableOptions);


        //таблица для хранения установленных в апартаментах замков (предполагаем, что они могут менятся или их может быть несколько)
        $this->createTable('{{%door_lock}}', [
            'id' => $this->primaryKey(), //внутренний уникальный идентификатор
            'admin_pin' => $this->integer(),
            'type' => $this->string(), //потом можно справочник
        ], $tableOptions);
        //таблица для хранения установленных в апартаментах камер видеонаблюдения(предполагаем, что они могут менятся или их может быть несколько)
        $this->createTable('{{%camera}}', [
            'id' => $this->primaryKey(), //внутренний уникальный идентификатор
            'admin_pin' => $this->integer(),
            'ip' => $this->string(),//ip-адрес
            'type' => $this->string(),//какой-то тип
        ], $tableOptions);


        //таблицы для хранения альбомов фото с камер в апартаментах
        $this->createTable('{{%album}}', [
            'id' => $this->primaryKey(), //внутренний уникальный идентификатор
            'name' => $this->string(),
        ], $tableOptions);

        //таблицы для хранения ссылок на файлы фотографий изображений с камер в апартаментах - таблица фото изображений
        $this->createTable('{{%photo_image}}', [
            'id' => $this->primaryKey(), //внутренний уникальный идентификатор
            'date' => $this->date()->notNull(), // время и дата снимка
            'camera_id' => $this->integer()->notNull(), //с какой камеры сделано
            'album_id' => $this->integer()->notNull(), //в случае, если фоток паспорта будет много
        ], $tableOptions);

        //таблицы для хранения ссылок на файлы фотографий изображений документов - таблица фото документов
        $this->createTable('{{%photo_document}}', [
            'id' => $this->primaryKey(), //внутренний уникальный идентификатор
            'date' => $this->date()->notNull(), // время и дата снимка
            'application_id' => $this->integer()->notNull(), //каким гостем сделано пока так, но потом это будет некое приложение
            'file_name' => $this->string(),
            'album_id' => $this->integer()->notNull(), //в случае, если фоток паспорта будет много
        ], $tableOptions);

        //таблицы для хранения ссылок на файлы фотографий выделенных лиц с документов - таблица фото лиц с документов
        $this->createTable('{{%photo_document_face}}', [
            'id' => $this->primaryKey(), //внутренний уникальный идентификатор
            'date' => $this->date()->notNull(), // время и дата снимка
            'photo_document_id' => $this->integer()->notNull(), //из какого файла выделено лицо
            'file_name' => $this->string(),
            'album_id' => $this->integer()->notNull(), //в случае, если фоток паспорта будет много
            'x1'=>$this->float(), //координата лица на съемке
            'y2'=>$this->float(), //координата лица на съемке
            'x2'=>$this->float(), //координата лица на съемке
            'y2'=>$this->float(), //координата лица на съемке
        ], $tableOptions);

        //таблицы для хранения ссылок на файлы фотографий выделенных лиц с реального снимка - таблица фото лиц
        $this->createTable('{{%photo_real_face}}', [
            'id' => $this->primaryKey(), //внутренний уникальный идентификатор
            'date' => $this->date()->notNull(), // время и дата процедуры выделения
            'photo_image_id' => $this->integer()->notNull(), //из какого файла выделено лицо
            'file_name' => $this->string(),
            'album_id' => $this->integer()->notNull(), //в случае, если фоток паспорта будет много
            'x1'=>$this->float(), //координата лица на съемке
            'y2'=>$this->float(), //координата лица на съемке
            'x2'=>$this->float(), //координата лица на съемке
            'y2'=>$this->float(), //координата лица на съемке
        ], $tableOptions);

        //таблица для хранения инфо о букировании
        $this->createTable('{{%booking}}', [
            'id' => $this->primaryKey(), //внутренний уникальный идентификатор
            'arrival_date' => $this->date()->notNull(),
            'depature_date' => $this->date()->notNull(),
            'apartment_id' => $this->integer(),
            'number_of_tourist'=>$this->integer()->notNull()->defaultValue(1),
            'guest_id' => $this->integer()->notNull(),
        ], $tableOptions);


        //связь апартаментов с дверными замками
        $this->createIndex('idx-apartment-door_lock_id', '{{%apartment}}', 'door_lock_id');
        $this->addForeignKey('fk-apartment-door_lock_id', '{{%apartment}}', 'door_lock_id', '{{%door_lock}}', 'id', 'CASCADE', 'RESTRICT');
        //связь апартаментов с камерами видеонаблюдения
        $this->createIndex('idx-apartment-camera_id', '{{%apartment}}', 'camera_id');
        $this->addForeignKey('fk-apartment-camera_id', '{{%apartment}}', 'camera_id', '{{%camera}}', 'id', 'CASCADE', 'RESTRICT');


        //связи фото документа - приложение
        $this->createIndex('idx-photo_document-application_id', '{{%photo_document}}', 'application_id');
        $this->addForeignKey('fk-photo_document-application_id', '{{%photo_document}}', 'application_id', '{{%application}}', 'id', 'CASCADE', 'RESTRICT');


        //связи документ-лицо
        $this->createIndex('idx-photo_document_face-photo_document_id', '{{%photo_document_face}}', 'photo_document_id');
        $this->addForeignKey('fk-photo_document_face-photo_document_id', '{{%photo_document_face}}', 'photo_document_id', '{{%photo_document}}', 'id', 'CASCADE', 'RESTRICT');

        //связи фото с камеры - лицо
        $this->createIndex('idx-photo_real_face-photo_document_id', '{{%photo_real_face}}', 'photo_image_id');
        $this->addForeignKey('fk-photo_real_face-photo_document_id', '{{%photo_real_face}}', 'photo_image_id', '{{%photo_image}}', 'id', 'CASCADE', 'RESTRICT');

        //связи с альбомами всех единичных фото для
        //реальных лиц
        $this->createIndex('idx-photo_real_face-album_id', '{{%photo_real_face}}', 'album_id');
        $this->addForeignKey('fk-photo_real_face-album_id', '{{%photo_real_face}}', 'album_id', '{{%album}}', 'id', 'CASCADE', 'RESTRICT');
        //лиц с документов
        $this->createIndex('idx-photo_document_face-album_id', '{{%photo_document_face}}', 'album_id');
        $this->addForeignKey('fk-photo_document_face-album_id', '{{%photo_document_face}}', 'album_id', '{{%album}}', 'id', 'CASCADE', 'RESTRICT');
        //просто документов
        $this->createIndex('idx-photo_document-album_id', '{{%photo_document}}', 'album_id');
        $this->addForeignKey('fk-photo_document-album_id', '{{%photo_document}}', 'album_id', '{{%album}}', 'id', 'CASCADE', 'RESTRICT');
        //просто изображений
        $this->createIndex('idx-photo_image-album_id', '{{%photo_image}}', 'album_id');
        $this->addForeignKey('fk-photo_image-album_id', '{{%photo_image}}', 'album_id', '{{%album}}', 'id', 'CASCADE', 'RESTRICT');


        //связь букинга с апартаментами
        $this->createIndex('idx-booking-apartment_id', '{{%booking}}', 'apartment_id');
        $this->addForeignKey('fk-booking-apartment_id', '{{%booking}}', 'apartment_id', '{{%apartment}}', 'id', 'CASCADE', 'RESTRICT');
        //связь букинга с гостем, на которого оформлен букинг
        $this->createIndex('idx-booking-guest_id', '{{%booking}}', 'guest_id');
        $this->addForeignKey('fk-booking-guest_id', '{{%booking}}', 'guest_id', '{{%guest}}', 'id', 'CASCADE', 'RESTRICT');

        //связь документов со справочником типов документов
        $this->createIndex('idx-document-document_type_id', '{{%document}}', 'document_type_id');
        $this->addForeignKey('fk-document-document_type_id', '{{%document}}', 'document_type_id', '{{%document_type}}', 'id', 'CASCADE', 'RESTRICT');
        //связь документов со справочником стран
        $this->createIndex('idx-document-country_id', '{{%document}}', 'country_id');
        $this->addForeignKey('fk-document-country_id', '{{%document}}', 'country_id', '{{%country}}', 'id', 'CASCADE', 'RESTRICT');

        //индекс и связь гостя с документом
        $this->createIndex('idx-guest-document_id', '{{%guest}}', 'document_id');
        $this->addForeignKey('fk-guest-document_id', '{{%guest}}', 'document_id', '{{%document}}', 'id', 'CASCADE', 'RESTRICT');
        //индекс и связь гостя с приложением
        $this->createIndex('idx-guest-application_id', '{{%guest}}', 'application_id');
        $this->addForeignKey('fk-guest-application_id', '{{%guest}}', 'application_id', '{{%application}}', 'id', 'CASCADE', 'RESTRICT');

        //индекс и связь документа с фото документо
        $this->createIndex('idx-document-photo_document_id', '{{%document}}', 'photo_document_id');
        $this->addForeignKey('fk-document-photo_document_id', '{{%document}}', 'photo_document_id', '{{%photo_document}}', 'id', 'CASCADE', 'RESTRICT');
        //индекс и связь документа с фото лица
        $this->createIndex('idx-document-photo_document_face_id', '{{%document}}', 'photo_document_face_id');
        $this->addForeignKey('fk-document-photo_document_face_id', '{{%document}}', 'photo_document_face_id', '{{%photo_document_face}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        //echo "m170304_130627_reception cannot be reverted.\n";

        $this->dropTable('{{%booking}}');
        $this->dropTable('{{%guest}}');
        $this->dropTable('{{%apartment}}');
        $this->dropTable('{{%document}}');
        $this->dropTable('{{%camera}}');
        $this->dropTable('{{%door_lock}}');

        $this->dropTable('{{%photo_real_face}}');
        $this->dropTable('{{%photo_document_face}}');
        $this->dropTable('{{%photo_image}}');
        $this->dropTable('{{%photo_document}}');
        $this->dropTable('{{%album}}');
        $this->dropTable('{{%country}}');
        $this->dropTable('{{%document_type}}');
        $this->dropTable('{{%application}}');

        //return false;
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

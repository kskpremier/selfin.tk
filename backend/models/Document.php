<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "document".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $second_name
 * @property string $number
 * @property string $seria
 * @property string $date_of_issue
 * @property integer $photo_document_face_id
 * @property integer $document_type_id
 * @property integer $country_id
 * @property string $valid_before
 * @property integer $photo_document_id
 * @property integer $guest_id
 *
 * @property Country $country
 * @property DocumentType $documentType
 * @property Guest $guest
 * @property PhotoDocumentFace $photoDocumentFace
 * @property PhotoDocument $photoDocument
 */
class Document extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'document';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number'], 'required'],
            [['photo_document_face_id', 'document_type_id', 'country_id', 'photo_document_id', 'guest_id'], 'integer'],
            [['valid_before'], 'safe'],
            [['first_name', 'second_name'], 'string', 'max' => 32],
            [['number', 'seria', 'date_of_issue'], 'string', 'max' => 255],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
            [['document_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => DocumentType::className(), 'targetAttribute' => ['document_type_id' => 'id']],
            [['guest_id'], 'exist', 'skipOnError' => true, 'targetClass' => Guest::className(), 'targetAttribute' => ['guest_id' => 'id']],
            [['photo_document_face_id'], 'exist', 'skipOnError' => true, 'targetClass' => PhotoDocumentFace::className(), 'targetAttribute' => ['photo_document_face_id' => 'id']],
            [['photo_document_id'], 'exist', 'skipOnError' => true, 'targetClass' => PhotoDocument::className(), 'targetAttribute' => ['photo_document_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'first_name' => Yii::t('app', 'First Name'),
            'second_name' => Yii::t('app', 'Second Name'),
            'number' => Yii::t('app', 'Number'),
            'seria' => Yii::t('app', 'Seria'),
            'date_of_issue' => Yii::t('app', 'Date Of Issue'),
            'photo_document_face_id' => Yii::t('app', 'Photo Document Face ID'),
            'document_type_id' => Yii::t('app', 'Document Type ID'),
            'country_id' => Yii::t('app', 'Country ID'),
            'valid_before' => Yii::t('app', 'Valid Before'),
            'photo_document_id' => Yii::t('app', 'Photo Document ID'),
            'guest_id' => Yii::t('app', 'Guest ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentType()
    {
        return $this->hasOne(DocumentType::className(), ['id' => 'document_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGuest()
    {
        return $this->hasOne(Guest::className(), ['id' => 'guest_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotoDocumentFace()
    {
        return $this->hasOne(PhotoDocumentFace::className(), ['id' => 'photo_document_face_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotoDocument()
    {
        return $this->hasOne(PhotoDocument::className(), ['id' => 'photo_document_id']);
    }
}

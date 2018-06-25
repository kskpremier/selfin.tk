<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\B2b;
use reception\entities\MyRent\Language;

/**
 * This is the model class for table "languages_b2b".
 *
 * @property int $id
 * @property int $b2b_id
 * @property int $language_id
 * @property string $value
 * @property string $created
 * @property string $changed
 *
 * @property B2b $b2b
 * @property Languages $language
 */
class LanguagesB2b extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'languages_b2b';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbMyRent');
    }

    /**
        * @param int $id//
        * @param int $b2b_id//
        * @param int $language_id//
        * @param string $value//
        * @param string $created//
        * @param string $changed//
        * @return LanguagesB2b    */
    public static function create($id, $b2b_id, $language_id, $value, $created, $changed): LanguagesB2b
    {
        $languagesB2b = new static();
                $languagesB2b->id = $id;
                $languagesB2b->b2b_id = $b2b_id;
                $languagesB2b->language_id = $language_id;
                $languagesB2b->value = $value;
                $languagesB2b->created = $created;
                $languagesB2b->changed = $changed;
        
        return $languagesB2b;
    }

    /**
            * @param int $id//
            * @param int $b2b_id//
            * @param int $language_id//
            * @param string $value//
            * @param string $created//
            * @param string $changed//
        * @return LanguagesB2b    */
    public function edit($id, $b2b_id, $language_id, $value, $created, $changed): LanguagesB2b
    {

            $this->id = $id;
            $this->b2b_id = $b2b_id;
            $this->language_id = $language_id;
            $this->value = $value;
            $this->created = $created;
            $this->changed = $changed;
    
        return $this;
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'b2b_id' => Yii::t('app', 'B2b ID'),
            'language_id' => Yii::t('app', 'Language ID'),
            'value' => Yii::t('app', 'Value'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getB2b()
    {
        return $this->hasOne(B2b::class, ['id' => 'b2b_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Languages::class, ['id' => 'language_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\LanguagesB2bQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\LanguagesB2bQuery(get_called_class());
    }
}

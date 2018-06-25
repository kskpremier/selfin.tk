<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\User;

/**
 * This is the model class for table "guests_regular".
 *
 * @property int $id
 * @property int $user_id
 * @property string $name_first
 * @property string $name_last
 * @property string $note
 * @property string $email
 * @property string $telephone
 * @property string $option1
 * @property string $option2
 * @property string $created
 * @property string $changed
 *
 * @property Users $user
 */
class GuestsRegular extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'guests_regular';
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
        * @param int $user_id//
        * @param string $name_first//
        * @param string $name_last//
        * @param string $note//
        * @param string $email//
        * @param string $telephone//
        * @param string $option1//
        * @param string $option2//
        * @param string $created//
        * @param string $changed//
        * @return GuestsRegular    */
    public static function create($id, $user_id, $name_first, $name_last, $note, $email, $telephone, $option1, $option2, $created, $changed): GuestsRegular
    {
        $guestsRegular = new static();
                $guestsRegular->id = $id;
                $guestsRegular->user_id = $user_id;
                $guestsRegular->name_first = $name_first;
                $guestsRegular->name_last = $name_last;
                $guestsRegular->note = $note;
                $guestsRegular->email = $email;
                $guestsRegular->telephone = $telephone;
                $guestsRegular->option1 = $option1;
                $guestsRegular->option2 = $option2;
                $guestsRegular->created = $created;
                $guestsRegular->changed = $changed;
        
        return $guestsRegular;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param string $name_first//
            * @param string $name_last//
            * @param string $note//
            * @param string $email//
            * @param string $telephone//
            * @param string $option1//
            * @param string $option2//
            * @param string $created//
            * @param string $changed//
        * @return GuestsRegular    */
    public function edit($id, $user_id, $name_first, $name_last, $note, $email, $telephone, $option1, $option2, $created, $changed): GuestsRegular
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->name_first = $name_first;
            $this->name_last = $name_last;
            $this->note = $note;
            $this->email = $email;
            $this->telephone = $telephone;
            $this->option1 = $option1;
            $this->option2 = $option2;
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
            'user_id' => Yii::t('app', 'User ID'),
            'name_first' => Yii::t('app', 'Name First'),
            'name_last' => Yii::t('app', 'Name Last'),
            'note' => Yii::t('app', 'Note'),
            'email' => Yii::t('app', 'Email'),
            'telephone' => Yii::t('app', 'Telephone'),
            'option1' => Yii::t('app', 'Option1'),
            'option2' => Yii::t('app', 'Option2'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\GuestsRegularQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\GuestsRegularQuery(get_called_class());
    }
}

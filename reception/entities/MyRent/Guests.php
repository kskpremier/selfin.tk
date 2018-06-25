<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Rent;
use reception\entities\MyRent\User;
use reception\entities\MyRent\GuestsCityTaxes;
use reception\entities\MyRent\GuestsEvisitors;
use reception\entities\MyRent\LogGuestsB2bs;

/**
 * This is the model class for table "guests".
 *
 * @property int $id
 * @property int $user_id
 * @property int $rent_id
 * @property string $name_first
 * @property string $name_last
 * @property string $vaucher
 * @property string $note
 * @property string $email
 * @property string $telephone
 * @property string $picture link to the picture
 * @property string $picture_preview small picture
 * @property string $picture_document_first
 * @property string $picture_document_second
 * @property double $picture_comparison picture probability in %
 * @property string $date_from
 * @property string $date_until
 * @property string $visible_on_invoice
 * @property string $city_tax
 * @property double $city_tax_price city tax price
 * @property string $type
 * @property string $option1
 * @property string $option2
 * @property string $request save request from API
 * @property string $created
 * @property string $changed
 *
 * @property Rents $rent
 * @property Users $user
 * @property GuestsCityTaxes[] $guestsCityTaxes
 * @property GuestsEvisitor[] $guestsEvisitors
 * @property LogGuestsB2b[] $logGuestsB2bs
 */
class Guests extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'guests';
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
        * @param int $rent_id//
        * @param string $name_first//
        * @param string $name_last//
        * @param string $vaucher//
        * @param string $note//
        * @param string $email//
        * @param string $telephone//
        * @param string $picture// link to the picture
        * @param string $picture_preview// small picture
        * @param string $picture_document_first//
        * @param string $picture_document_second//
        * @param double $picture_comparison// picture probability in %
        * @param string $date_from//
        * @param string $date_until//
        * @param string $visible_on_invoice//
        * @param string $city_tax//
        * @param double $city_tax_price// city tax price
        * @param string $type//
        * @param string $option1//
        * @param string $option2//
        * @param string $request// save request from API
        * @param string $created//
        * @param string $changed//
        * @return Guests    */
    public static function create($id, $user_id, $rent_id, $name_first, $name_last, $vaucher, $note, $email, $telephone, $picture, $picture_preview, $picture_document_first, $picture_document_second, $picture_comparison, $date_from, $date_until, $visible_on_invoice, $city_tax, $city_tax_price, $type, $option1, $option2, $request, $created, $changed): Guests
    {
        $guests = new static();
                $guests->id = $id;
                $guests->user_id = $user_id;
                $guests->rent_id = $rent_id;
                $guests->name_first = $name_first;
                $guests->name_last = $name_last;
                $guests->vaucher = $vaucher;
                $guests->note = $note;
                $guests->email = $email;
                $guests->telephone = $telephone;
                $guests->picture = $picture;
                $guests->picture_preview = $picture_preview;
                $guests->picture_document_first = $picture_document_first;
                $guests->picture_document_second = $picture_document_second;
                $guests->picture_comparison = $picture_comparison;
                $guests->date_from = $date_from;
                $guests->date_until = $date_until;
                $guests->visible_on_invoice = $visible_on_invoice;
                $guests->city_tax = $city_tax;
                $guests->city_tax_price = $city_tax_price;
                $guests->type = $type;
                $guests->option1 = $option1;
                $guests->option2 = $option2;
                $guests->request = $request;
                $guests->created = $created;
                $guests->changed = $changed;
        
        return $guests;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $rent_id//
            * @param string $name_first//
            * @param string $name_last//
            * @param string $vaucher//
            * @param string $note//
            * @param string $email//
            * @param string $telephone//
            * @param string $picture// link to the picture
            * @param string $picture_preview// small picture
            * @param string $picture_document_first//
            * @param string $picture_document_second//
            * @param double $picture_comparison// picture probability in %
            * @param string $date_from//
            * @param string $date_until//
            * @param string $visible_on_invoice//
            * @param string $city_tax//
            * @param double $city_tax_price// city tax price
            * @param string $type//
            * @param string $option1//
            * @param string $option2//
            * @param string $request// save request from API
            * @param string $created//
            * @param string $changed//
        * @return Guests    */
    public function edit($id, $user_id, $rent_id, $name_first, $name_last, $vaucher, $note, $email, $telephone, $picture, $picture_preview, $picture_document_first, $picture_document_second, $picture_comparison, $date_from, $date_until, $visible_on_invoice, $city_tax, $city_tax_price, $type, $option1, $option2, $request, $created, $changed): Guests
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->rent_id = $rent_id;
            $this->name_first = $name_first;
            $this->name_last = $name_last;
            $this->vaucher = $vaucher;
            $this->note = $note;
            $this->email = $email;
            $this->telephone = $telephone;
            $this->picture = $picture;
            $this->picture_preview = $picture_preview;
            $this->picture_document_first = $picture_document_first;
            $this->picture_document_second = $picture_document_second;
            $this->picture_comparison = $picture_comparison;
            $this->date_from = $date_from;
            $this->date_until = $date_until;
            $this->visible_on_invoice = $visible_on_invoice;
            $this->city_tax = $city_tax;
            $this->city_tax_price = $city_tax_price;
            $this->type = $type;
            $this->option1 = $option1;
            $this->option2 = $option2;
            $this->request = $request;
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
            'rent_id' => Yii::t('app', 'Rent ID'),
            'name_first' => Yii::t('app', 'Name First'),
            'name_last' => Yii::t('app', 'Name Last'),
            'vaucher' => Yii::t('app', 'Vaucher'),
            'note' => Yii::t('app', 'Note'),
            'email' => Yii::t('app', 'Email'),
            'telephone' => Yii::t('app', 'Telephone'),
            'picture' => Yii::t('app', 'Picture'),
            'picture_preview' => Yii::t('app', 'Picture Preview'),
            'picture_document_first' => Yii::t('app', 'Picture Document First'),
            'picture_document_second' => Yii::t('app', 'Picture Document Second'),
            'picture_comparison' => Yii::t('app', 'Picture Comparison'),
            'date_from' => Yii::t('app', 'Date From'),
            'date_until' => Yii::t('app', 'Date Until'),
            'visible_on_invoice' => Yii::t('app', 'Visible On Invoice'),
            'city_tax' => Yii::t('app', 'City Tax'),
            'city_tax_price' => Yii::t('app', 'City Tax Price'),
            'type' => Yii::t('app', 'Type'),
            'option1' => Yii::t('app', 'Option1'),
            'option2' => Yii::t('app', 'Option2'),
            'request' => Yii::t('app', 'Request'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRent()
    {
        return $this->hasOne(Rents::class, ['id' => 'rent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGuestsCityTaxes()
    {
        return $this->hasMany(GuestsCityTaxes::class, ['guest_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGuestsEvisitors()
    {
        return $this->hasMany(GuestsEvisitor::class, ['guest_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogGuestsB2bs()
    {
        return $this->hasMany(LogGuestsB2b::class, ['guest_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\GuestsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\GuestsQuery(get_called_class());
    }
}

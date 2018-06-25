<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Rent;
use reception\entities\MyRent\RentSource;

/**
 * This is the model class for table "rents_apartments".
 *
 * @property int $id
 * @property int $rent_id
 * @property int $rent_source_id
 * @property int $adults
 * @property int $children
 * @property int $children_young
 * @property int $older_people
 * @property int $pets
 * @property int $keys
 * @property int $beds
 * @property string $note
 * @property string $note_cleaning
 * @property string $crib
 * @property string $parking
 * @property string $gift
 * @property string $gift_note
 * @property string $rent_source_link
 * @property string $beds_description how many beds to prepare
 * @property string $created
 * @property string $changed
 *
 * @property Rents $rent
 * @property RentsSources $rentSource
 */
class RentsApartments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rents_apartments';
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
        * @param int $rent_id//
        * @param int $rent_source_id//
        * @param int $adults//
        * @param int $children//
        * @param int $children_young//
        * @param int $older_people//
        * @param int $pets//
        * @param int $keys//
        * @param int $beds//
        * @param string $note//
        * @param string $note_cleaning//
        * @param string $crib//
        * @param string $parking//
        * @param string $gift//
        * @param string $gift_note//
        * @param string $rent_source_link//
        * @param string $beds_description// how many beds to prepare
        * @param string $created//
        * @param string $changed//
        * @return RentsApartments    */
    public static function create($id, $rent_id, $rent_source_id, $adults, $children, $children_young, $older_people, $pets, $keys, $beds, $note, $note_cleaning, $crib, $parking, $gift, $gift_note, $rent_source_link, $beds_description, $created, $changed): RentsApartments
    {
        $rentsApartments = new static();
                $rentsApartments->id = $id;
                $rentsApartments->rent_id = $rent_id;
                $rentsApartments->rent_source_id = $rent_source_id;
                $rentsApartments->adults = $adults;
                $rentsApartments->children = $children;
                $rentsApartments->children_young = $children_young;
                $rentsApartments->older_people = $older_people;
                $rentsApartments->pets = $pets;
                $rentsApartments->keys = $keys;
                $rentsApartments->beds = $beds;
                $rentsApartments->note = $note;
                $rentsApartments->note_cleaning = $note_cleaning;
                $rentsApartments->crib = $crib;
                $rentsApartments->parking = $parking;
                $rentsApartments->gift = $gift;
                $rentsApartments->gift_note = $gift_note;
                $rentsApartments->rent_source_link = $rent_source_link;
                $rentsApartments->beds_description = $beds_description;
                $rentsApartments->created = $created;
                $rentsApartments->changed = $changed;
        
        return $rentsApartments;
    }

    /**
            * @param int $id//
            * @param int $rent_id//
            * @param int $rent_source_id//
            * @param int $adults//
            * @param int $children//
            * @param int $children_young//
            * @param int $older_people//
            * @param int $pets//
            * @param int $keys//
            * @param int $beds//
            * @param string $note//
            * @param string $note_cleaning//
            * @param string $crib//
            * @param string $parking//
            * @param string $gift//
            * @param string $gift_note//
            * @param string $rent_source_link//
            * @param string $beds_description// how many beds to prepare
            * @param string $created//
            * @param string $changed//
        * @return RentsApartments    */
    public function edit($id, $rent_id, $rent_source_id, $adults, $children, $children_young, $older_people, $pets, $keys, $beds, $note, $note_cleaning, $crib, $parking, $gift, $gift_note, $rent_source_link, $beds_description, $created, $changed): RentsApartments
    {

            $this->id = $id;
            $this->rent_id = $rent_id;
            $this->rent_source_id = $rent_source_id;
            $this->adults = $adults;
            $this->children = $children;
            $this->children_young = $children_young;
            $this->older_people = $older_people;
            $this->pets = $pets;
            $this->keys = $keys;
            $this->beds = $beds;
            $this->note = $note;
            $this->note_cleaning = $note_cleaning;
            $this->crib = $crib;
            $this->parking = $parking;
            $this->gift = $gift;
            $this->gift_note = $gift_note;
            $this->rent_source_link = $rent_source_link;
            $this->beds_description = $beds_description;
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
            'rent_id' => Yii::t('app', 'Rent ID'),
            'rent_source_id' => Yii::t('app', 'Rent Source ID'),
            'adults' => Yii::t('app', 'Adults'),
            'children' => Yii::t('app', 'Children'),
            'children_young' => Yii::t('app', 'Children Young'),
            'older_people' => Yii::t('app', 'Older People'),
            'pets' => Yii::t('app', 'Pets'),
            'keys' => Yii::t('app', 'Keys'),
            'beds' => Yii::t('app', 'Beds'),
            'note' => Yii::t('app', 'Note'),
            'note_cleaning' => Yii::t('app', 'Note Cleaning'),
            'crib' => Yii::t('app', 'Crib'),
            'parking' => Yii::t('app', 'Parking'),
            'gift' => Yii::t('app', 'Gift'),
            'gift_note' => Yii::t('app', 'Gift Note'),
            'rent_source_link' => Yii::t('app', 'Rent Source Link'),
            'beds_description' => Yii::t('app', 'Beds Description'),
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
    public function getRentSource()
    {
        return $this->hasOne(RentsSources::class, ['id' => 'rent_source_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\RentsApartmentsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\RentsApartmentsQuery(get_called_class());
    }
}

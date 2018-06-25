<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Amenities;
use reception\entities\MyRent\AmenitiesB2bs;
use reception\entities\MyRent\B2bSettings;
use reception\entities\MyRent\CountriesB2bs;
use reception\entities\MyRent\GuestsImports;
use reception\entities\MyRent\ItemsB2bs;
use reception\entities\MyRent\LanguagesB2bs;
use reception\entities\MyRent\LogApis;
use reception\entities\MyRent\LogB2bs;
use reception\entities\MyRent\LogGuestsB2bs;
use reception\entities\MyRent\ObjectsAdditionalChargesB2bs;
use reception\entities\MyRent\ObjectsB2bs;
use reception\entities\MyRent\ObjectsDistancesPlacesB2bs;
use reception\entities\MyRent\ObjectsFacilitiesB2bs;
use reception\entities\MyRent\ObjectsGroupsB2bs;
use reception\entities\MyRent\ObjectsRealestatesDescriptionsB2bs;
use reception\entities\MyRent\ObjectsRealestatesPicturesB2bs;
use reception\entities\MyRent\ObjectsRentsSources;
use reception\entities\MyRent\ObjectsRoomsB2bs;
use reception\entities\MyRent\ObjectsRoomsTypesB2bs;
use reception\entities\MyRent\ObjectsTypesB2bs;
use reception\entities\MyRent\OwnersB2bs;
use reception\entities\MyRent\PaymentsRecives;
use reception\entities\MyRent\ProfilesOtas;
use reception\entities\MyRent\RentsB2bs;
use reception\entities\MyRent\RentsDoorsLocks;
use reception\entities\MyRent\RentsImports;
use reception\entities\MyRent\RentsSources;
use reception\entities\MyRent\UsersB2bs;

/**
 * This is the model class for table "b2b".
 *
 * @property int $id
 * @property int $status_id status id for new rents
 * @property string $type
 * @property string $grp
 * @property string $code
 * @property string $name
 * @property string $alias
 * @property string $company
 * @property string $web web page of b2b
 * @property string $member_of
 * @property string $help_link
 * @property string $link
 * @property string $tolken
 * @property string $option1
 * @property string $option2
 * @property string $option3
 * @property string $rents_export export calendars
 * @property string $rents_import import rents
 * @property string $rents_import_change sync full bookings
 * @property string $price sync prices
 * @property string $photo sync photos & data
 * @property string $export_sync_time
 * @property string $import_sync_time
 * @property string $color
 * @property string $picture
 * @property string $note
 * @property string $description
 * @property string $sync_datetime
 * @property string $changed
 * @property string $created
 *
 * @property Amenities[] $amenities
 * @property AmenitiesB2b[] $amenitiesB2bs
 * @property B2bSettings[] $b2bSettings
 * @property CountriesB2b[] $countriesB2bs
 * @property GuestsImport[] $guestsImports
 * @property ItemsB2b[] $itemsB2bs
 * @property LanguagesB2b[] $languagesB2bs
 * @property LogApi[] $logApis
 * @property LogB2b[] $logB2bs
 * @property LogGuestsB2b[] $logGuestsB2bs
 * @property ObjectsAdditionalChargesB2b[] $objectsAdditionalChargesB2bs
 * @property ObjectsB2b[] $objectsB2bs
 * @property ObjectsDistancesPlacesB2b[] $objectsDistancesPlacesB2bs
 * @property ObjectsFacilitiesB2b[] $objectsFacilitiesB2bs
 * @property ObjectsGroupsB2b[] $objectsGroupsB2bs
 * @property ObjectsRealestatesDescriptionsB2b[] $objectsRealestatesDescriptionsB2bs
 * @property ObjectsRealestatesPicturesB2b[] $objectsRealestatesPicturesB2bs
 * @property ObjectsRentsSources[] $objectsRentsSources
 * @property ObjectsRoomsB2b[] $objectsRoomsB2bs
 * @property ObjectsRoomsTypesB2b[] $objectsRoomsTypesB2bs
 * @property ObjectsTypesB2b[] $objectsTypesB2bs
 * @property OwnersB2b[] $ownersB2bs
 * @property PaymentsRecive[] $paymentsRecives
 * @property ProfilesOtas[] $profilesOtas
 * @property RentsB2b[] $rentsB2bs
 * @property RentsDoorsLocks[] $rentsDoorsLocks
 * @property RentsImports[] $rentsImports
 * @property RentsSources[] $rentsSources
 * @property UsersB2b[] $usersB2bs
 */
class B2b extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'b2b';
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
        * @param int $status_id// status id for new rents
        * @param string $type//
        * @param string $grp//
        * @param string $code//
        * @param string $name//
        * @param string $alias//
        * @param string $company//
        * @param string $web// web page of b2b
        * @param string $member_of//
        * @param string $help_link//
        * @param string $link//
        * @param string $tolken//
        * @param string $option1//
        * @param string $option2//
        * @param string $option3//
        * @param string $rents_export// export calendars
        * @param string $rents_import// import rents
        * @param string $rents_import_change// sync full bookings
        * @param string $price// sync prices
        * @param string $photo// sync photos & data
        * @param string $export_sync_time//
        * @param string $import_sync_time//
        * @param string $color//
        * @param string $picture//
        * @param string $note//
        * @param string $description//
        * @param string $sync_datetime//
        * @param string $changed//
        * @param string $created//
        * @return B2b    */
    public static function create($id, $status_id, $type, $grp, $code, $name, $alias, $company, $web, $member_of, $help_link, $link, $tolken, $option1, $option2, $option3, $rents_export, $rents_import, $rents_import_change, $price, $photo, $export_sync_time, $import_sync_time, $color, $picture, $note, $description, $sync_datetime, $changed, $created): B2b
    {
        $b2b = new static();
                $b2b->id = $id;
                $b2b->status_id = $status_id;
                $b2b->type = $type;
                $b2b->grp = $grp;
                $b2b->code = $code;
                $b2b->name = $name;
                $b2b->alias = $alias;
                $b2b->company = $company;
                $b2b->web = $web;
                $b2b->member_of = $member_of;
                $b2b->help_link = $help_link;
                $b2b->link = $link;
                $b2b->tolken = $tolken;
                $b2b->option1 = $option1;
                $b2b->option2 = $option2;
                $b2b->option3 = $option3;
                $b2b->rents_export = $rents_export;
                $b2b->rents_import = $rents_import;
                $b2b->rents_import_change = $rents_import_change;
                $b2b->price = $price;
                $b2b->photo = $photo;
                $b2b->export_sync_time = $export_sync_time;
                $b2b->import_sync_time = $import_sync_time;
                $b2b->color = $color;
                $b2b->picture = $picture;
                $b2b->note = $note;
                $b2b->description = $description;
                $b2b->sync_datetime = $sync_datetime;
                $b2b->changed = $changed;
                $b2b->created = $created;
        
        return $b2b;
    }

    /**
            * @param int $id//
            * @param int $status_id// status id for new rents
            * @param string $type//
            * @param string $grp//
            * @param string $code//
            * @param string $name//
            * @param string $alias//
            * @param string $company//
            * @param string $web// web page of b2b
            * @param string $member_of//
            * @param string $help_link//
            * @param string $link//
            * @param string $tolken//
            * @param string $option1//
            * @param string $option2//
            * @param string $option3//
            * @param string $rents_export// export calendars
            * @param string $rents_import// import rents
            * @param string $rents_import_change// sync full bookings
            * @param string $price// sync prices
            * @param string $photo// sync photos & data
            * @param string $export_sync_time//
            * @param string $import_sync_time//
            * @param string $color//
            * @param string $picture//
            * @param string $note//
            * @param string $description//
            * @param string $sync_datetime//
            * @param string $changed//
            * @param string $created//
        * @return B2b    */
    public function edit($id, $status_id, $type, $grp, $code, $name, $alias, $company, $web, $member_of, $help_link, $link, $tolken, $option1, $option2, $option3, $rents_export, $rents_import, $rents_import_change, $price, $photo, $export_sync_time, $import_sync_time, $color, $picture, $note, $description, $sync_datetime, $changed, $created): B2b
    {

            $this->id = $id;
            $this->status_id = $status_id;
            $this->type = $type;
            $this->grp = $grp;
            $this->code = $code;
            $this->name = $name;
            $this->alias = $alias;
            $this->company = $company;
            $this->web = $web;
            $this->member_of = $member_of;
            $this->help_link = $help_link;
            $this->link = $link;
            $this->tolken = $tolken;
            $this->option1 = $option1;
            $this->option2 = $option2;
            $this->option3 = $option3;
            $this->rents_export = $rents_export;
            $this->rents_import = $rents_import;
            $this->rents_import_change = $rents_import_change;
            $this->price = $price;
            $this->photo = $photo;
            $this->export_sync_time = $export_sync_time;
            $this->import_sync_time = $import_sync_time;
            $this->color = $color;
            $this->picture = $picture;
            $this->note = $note;
            $this->description = $description;
            $this->sync_datetime = $sync_datetime;
            $this->changed = $changed;
            $this->created = $created;
    
        return $this;
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'status_id' => Yii::t('app', 'Status ID'),
            'type' => Yii::t('app', 'Type'),
            'grp' => Yii::t('app', 'Grp'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'alias' => Yii::t('app', 'Alias'),
            'company' => Yii::t('app', 'Company'),
            'web' => Yii::t('app', 'Web'),
            'member_of' => Yii::t('app', 'Member Of'),
            'help_link' => Yii::t('app', 'Help Link'),
            'link' => Yii::t('app', 'Link'),
            'tolken' => Yii::t('app', 'Tolken'),
            'option1' => Yii::t('app', 'Option1'),
            'option2' => Yii::t('app', 'Option2'),
            'option3' => Yii::t('app', 'Option3'),
            'rents_export' => Yii::t('app', 'Rents Export'),
            'rents_import' => Yii::t('app', 'Rents Import'),
            'rents_import_change' => Yii::t('app', 'Rents Import Change'),
            'price' => Yii::t('app', 'Price'),
            'photo' => Yii::t('app', 'Photo'),
            'export_sync_time' => Yii::t('app', 'Export Sync Time'),
            'import_sync_time' => Yii::t('app', 'Import Sync Time'),
            'color' => Yii::t('app', 'Color'),
            'picture' => Yii::t('app', 'Picture'),
            'note' => Yii::t('app', 'Note'),
            'description' => Yii::t('app', 'Description'),
            'sync_datetime' => Yii::t('app', 'Sync Datetime'),
            'changed' => Yii::t('app', 'Changed'),
            'created' => Yii::t('app', 'Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmenities()
    {
        return $this->hasMany(Amenities::class, ['b2b_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmenitiesB2bs()
    {
        return $this->hasMany(AmenitiesB2b::class, ['b2b_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getB2bSettings()
    {
        return $this->hasMany(B2bSettings::class, ['b2b_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountriesB2bs()
    {
        return $this->hasMany(CountriesB2b::class, ['b2b_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGuestsImports()
    {
        return $this->hasMany(GuestsImport::class, ['b2b_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsB2bs()
    {
        return $this->hasMany(ItemsB2b::class, ['b2b_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguagesB2bs()
    {
        return $this->hasMany(LanguagesB2b::class, ['b2b_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogApis()
    {
        return $this->hasMany(LogApi::class, ['b2b_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogB2bs()
    {
        return $this->hasMany(LogB2b::class, ['b2b_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogGuestsB2bs()
    {
        return $this->hasMany(LogGuestsB2b::class, ['b2b_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsAdditionalChargesB2bs()
    {
        return $this->hasMany(ObjectsAdditionalChargesB2b::class, ['b2b_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsB2bs()
    {
        return $this->hasMany(ObjectsB2b::class, ['b2b_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsDistancesPlacesB2bs()
    {
        return $this->hasMany(ObjectsDistancesPlacesB2b::class, ['b2b_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsFacilitiesB2bs()
    {
        return $this->hasMany(ObjectsFacilitiesB2b::class, ['b2b_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsGroupsB2bs()
    {
        return $this->hasMany(ObjectsGroupsB2b::class, ['b2b_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsRealestatesDescriptionsB2bs()
    {
        return $this->hasMany(ObjectsRealestatesDescriptionsB2b::class, ['b2b_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsRealestatesPicturesB2bs()
    {
        return $this->hasMany(ObjectsRealestatesPicturesB2b::class, ['b2b_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsRentsSources()
    {
        return $this->hasMany(ObjectsRentsSources::class, ['b2b_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsRoomsB2bs()
    {
        return $this->hasMany(ObjectsRoomsB2b::class, ['b2b_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsRoomsTypesB2bs()
    {
        return $this->hasMany(ObjectsRoomsTypesB2b::class, ['b2b_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsTypesB2bs()
    {
        return $this->hasMany(ObjectsTypesB2b::class, ['b2b_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwnersB2bs()
    {
        return $this->hasMany(OwnersB2b::class, ['b2b_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentsRecives()
    {
        return $this->hasMany(PaymentsRecive::class, ['b2b_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfilesOtas()
    {
        return $this->hasMany(ProfilesOtas::class, ['b2b_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsB2bs()
    {
        return $this->hasMany(RentsB2b::class, ['b2b_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsDoorsLocks()
    {
        return $this->hasMany(RentsDoorsLocks::class, ['b2b_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsImports()
    {
        return $this->hasMany(RentsImports::class, ['b2b_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsSources()
    {
        return $this->hasMany(RentsSources::class, ['b2b_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersB2bs()
    {
        return $this->hasMany(UsersB2b::class, ['b2b_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\B2bQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\B2bQuery(get_called_class());
    }
}

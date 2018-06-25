<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Blogs;
use reception\entities\MyRent\InvoicesHeaders;
use reception\entities\MyRent\InvoicesHeaders0;
use reception\entities\MyRent\InvoicesLogs;
use reception\entities\MyRent\InvoicesPayments;
use reception\entities\MyRent\LogRentsCards;
use reception\entities\MyRent\LogUsersLogins;
use reception\entities\MyRent\Messages;
use reception\entities\MyRent\Objects;
use reception\entities\MyRent\ObjectsChecksLogs;
use reception\entities\MyRent\Offices;
use reception\entities\MyRent\PaymentsBoxes;
use reception\entities\MyRent\PaymentsRecives;
use reception\entities\MyRent\RentsCleanings;
use reception\entities\MyRent\RentsItems;
use reception\entities\MyRent\RentsLogs;
use reception\entities\MyRent\RentsWorkersLogs;
use reception\entities\MyRent\SupportTicketMessages;
use reception\entities\MyRent\SupportTickets;
use reception\entities\MyRent\Treasuries;
use reception\entities\MyRent\Language;
use reception\entities\MyRent\Picture;
use reception\entities\MyRent\User;
use reception\entities\MyRent\WorkerType;

/**
 * This is the model class for table "workers".
 *
 * @property int $id
 * @property int $user_id
 * @property int $worker_type_id
 * @property int $picture_id
 * @property int $language_id
 * @property string $primary primary conctact
 * @property string $color
 * @property string $name
 * @property string $guid
 * @property string $tax_id
 * @property string $email
 * @property string $telephone
 * @property string $username
 * @property string $password
 * @property string $note
 * @property string $facebook_id
 * @property string $active
 * @property string $super_user
 * @property string $online
 * @property string $created
 * @property string $changed
 *
 * @property Blogs[] $blogs
 * @property InvoicesHeader[] $invoicesHeaders
 * @property InvoicesHeader[] $invoicesHeaders0
 * @property InvoicesLog[] $invoicesLogs
 * @property InvoicesPayments[] $invoicesPayments
 * @property LogRentsCards[] $logRentsCards
 * @property LogUsersLogin[] $logUsersLogins
 * @property Messages[] $messages
 * @property Objects[] $objects
 * @property ObjectsChecksLogs[] $objectsChecksLogs
 * @property Offices[] $offices
 * @property PaymentsBoxes[] $paymentsBoxes
 * @property PaymentsRecive[] $paymentsRecives
 * @property RentsCleaning[] $rentsCleanings
 * @property RentsItems[] $rentsItems
 * @property RentsLog[] $rentsLogs
 * @property RentsWorkersLog[] $rentsWorkersLogs
 * @property SupportTicketMessages[] $supportTicketMessages
 * @property SupportTickets[] $supportTickets
 * @property Treasury[] $treasuries
 * @property Languages $language
 * @property Pictures $picture
 * @property Users $user
 * @property WorkersTypes $workerType
 */
class Workers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'workers';
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
        * @param int $worker_type_id//
        * @param int $picture_id//
        * @param int $language_id//
        * @param string $primary// primary conctact
        * @param string $color//
        * @param string $name//
        * @param string $guid//
        * @param string $tax_id//
        * @param string $email//
        * @param string $telephone//
        * @param string $username//
        * @param string $password//
        * @param string $note//
        * @param string $facebook_id//
        * @param string $active//
        * @param string $super_user//
        * @param string $online//
        * @param string $created//
        * @param string $changed//
        * @return Workers    */
    public static function create($id, $user_id, $worker_type_id, $picture_id, $language_id, $primary, $color, $name, $guid, $tax_id, $email, $telephone, $username, $password, $note, $facebook_id, $active, $super_user, $online, $created, $changed): Workers
    {
        $workers = new static();
                $workers->id = $id;
                $workers->user_id = $user_id;
                $workers->worker_type_id = $worker_type_id;
                $workers->picture_id = $picture_id;
                $workers->language_id = $language_id;
                $workers->primary = $primary;
                $workers->color = $color;
                $workers->name = $name;
                $workers->guid = $guid;
                $workers->tax_id = $tax_id;
                $workers->email = $email;
                $workers->telephone = $telephone;
                $workers->username = $username;
                $workers->password = $password;
                $workers->note = $note;
                $workers->facebook_id = $facebook_id;
                $workers->active = $active;
                $workers->super_user = $super_user;
                $workers->online = $online;
                $workers->created = $created;
                $workers->changed = $changed;
        
        return $workers;
    }

    /**
            * @param int $id//
            * @param int $user_id//
            * @param int $worker_type_id//
            * @param int $picture_id//
            * @param int $language_id//
            * @param string $primary// primary conctact
            * @param string $color//
            * @param string $name//
            * @param string $guid//
            * @param string $tax_id//
            * @param string $email//
            * @param string $telephone//
            * @param string $username//
            * @param string $password//
            * @param string $note//
            * @param string $facebook_id//
            * @param string $active//
            * @param string $super_user//
            * @param string $online//
            * @param string $created//
            * @param string $changed//
        * @return Workers    */
    public function edit($id, $user_id, $worker_type_id, $picture_id, $language_id, $primary, $color, $name, $guid, $tax_id, $email, $telephone, $username, $password, $note, $facebook_id, $active, $super_user, $online, $created, $changed): Workers
    {

            $this->id = $id;
            $this->user_id = $user_id;
            $this->worker_type_id = $worker_type_id;
            $this->picture_id = $picture_id;
            $this->language_id = $language_id;
            $this->primary = $primary;
            $this->color = $color;
            $this->name = $name;
            $this->guid = $guid;
            $this->tax_id = $tax_id;
            $this->email = $email;
            $this->telephone = $telephone;
            $this->username = $username;
            $this->password = $password;
            $this->note = $note;
            $this->facebook_id = $facebook_id;
            $this->active = $active;
            $this->super_user = $super_user;
            $this->online = $online;
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
            'worker_type_id' => Yii::t('app', 'Worker Type ID'),
            'picture_id' => Yii::t('app', 'Picture ID'),
            'language_id' => Yii::t('app', 'Language ID'),
            'primary' => Yii::t('app', 'Primary'),
            'color' => Yii::t('app', 'Color'),
            'name' => Yii::t('app', 'Name'),
            'guid' => Yii::t('app', 'Guid'),
            'tax_id' => Yii::t('app', 'Tax ID'),
            'email' => Yii::t('app', 'Email'),
            'telephone' => Yii::t('app', 'Telephone'),
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'note' => Yii::t('app', 'Note'),
            'facebook_id' => Yii::t('app', 'Facebook ID'),
            'active' => Yii::t('app', 'Active'),
            'super_user' => Yii::t('app', 'Super User'),
            'online' => Yii::t('app', 'Online'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogs()
    {
        return $this->hasMany(Blogs::class, ['worker_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoicesHeaders()
    {
        return $this->hasMany(InvoicesHeader::class, ['fis_worker_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoicesHeaders0()
    {
        return $this->hasMany(InvoicesHeader::class, ['worker_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoicesLogs()
    {
        return $this->hasMany(InvoicesLog::class, ['worker_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoicesPayments()
    {
        return $this->hasMany(InvoicesPayments::class, ['worker_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogRentsCards()
    {
        return $this->hasMany(LogRentsCards::class, ['worker_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogUsersLogins()
    {
        return $this->hasMany(LogUsersLogin::class, ['worker_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Messages::class, ['worker_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjects()
    {
        return $this->hasMany(Objects::class, ['worker_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsChecksLogs()
    {
        return $this->hasMany(ObjectsChecksLogs::class, ['worker_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOffices()
    {
        return $this->hasMany(Offices::class, ['worker_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentsBoxes()
    {
        return $this->hasMany(PaymentsBoxes::class, ['worker_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentsRecives()
    {
        return $this->hasMany(PaymentsRecive::class, ['worker_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsCleanings()
    {
        return $this->hasMany(RentsCleaning::class, ['worker_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsItems()
    {
        return $this->hasMany(RentsItems::class, ['worker_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsLogs()
    {
        return $this->hasMany(RentsLog::class, ['worker_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsWorkersLogs()
    {
        return $this->hasMany(RentsWorkersLog::class, ['worker_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupportTicketMessages()
    {
        return $this->hasMany(SupportTicketMessages::class, ['worker_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupportTickets()
    {
        return $this->hasMany(SupportTickets::class, ['worker_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTreasuries()
    {
        return $this->hasMany(Treasury::class, ['worker_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Languages::class, ['id' => 'language_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPicture()
    {
        return $this->hasOne(Pictures::class, ['id' => 'picture_id']);
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
    public function getWorkerType()
    {
        return $this->hasOne(WorkersTypes::class, ['id' => 'worker_type_id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\WorkersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\WorkersQuery(get_called_class());
    }
}

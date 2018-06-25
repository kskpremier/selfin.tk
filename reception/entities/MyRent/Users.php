<?php


namespace reception\entities\MyRent;

use Yii;
use reception\entities\MyRent\Amenities;
use reception\entities\MyRent\B2bSettings;
use reception\entities\MyRent\Blogs;
use reception\entities\MyRent\Cleaners;
use reception\entities\MyRent\CountriesSettlments;
use reception\entities\MyRent\CreditCards;
use reception\entities\MyRent\CurrencyExchanges;
use reception\entities\MyRent\Customers;
use reception\entities\MyRent\CustomersGroups;
use reception\entities\MyRent\CustomersObjects;
use reception\entities\MyRent\CustomersPrices;
use reception\entities\MyRent\CustomersTypes;
use reception\entities\MyRent\DoorsLocks;
use reception\entities\MyRent\EmailsTemplates;
use reception\entities\MyRent\EmailsTimers;
use reception\entities\MyRent\EmailsTypes;
use reception\entities\MyRent\Excursions;
use reception\entities\MyRent\ExcursionsPictures;
use reception\entities\MyRent\Friends;
use reception\entities\MyRent\Friends0;
use reception\entities\MyRent\Guests;
use reception\entities\MyRent\GuestsCityTaxes;
use reception\entities\MyRent\GuestsEvisitors;
use reception\entities\MyRent\GuestsImports;
use reception\entities\MyRent\GuestsRegulars;
use reception\entities\MyRent\InvoicesFis;
use reception\entities\MyRent\InvoicesHeaders;
use reception\entities\MyRent\InvoicesItems;
use reception\entities\MyRent\InvoicesLogs;
use reception\entities\MyRent\InvoicesPayments;
use reception\entities\MyRent\InvoicesTypes;
use reception\entities\MyRent\Items;
use reception\entities\MyRent\ItemsB2bs;
use reception\entities\MyRent\ItemsPeriods;
use reception\entities\MyRent\ItemsPrices;
use reception\entities\MyRent\Laundries;
use reception\entities\MyRent\LocationsAreas;
use reception\entities\MyRent\LocationsRegions;
use reception\entities\MyRent\LogB2bs;
use reception\entities\MyRent\LogEmails;
use reception\entities\MyRent\LogErrors;
use reception\entities\MyRent\LogRentsCards;
use reception\entities\MyRent\LogSms;
use reception\entities\MyRent\LogSqls;
use reception\entities\MyRent\LogUsersLogins;
use reception\entities\MyRent\Messages;
use reception\entities\MyRent\ObjectRealstateMailDescriptions;
use reception\entities\MyRent\Objects;
use reception\entities\MyRent\ObjectsAdditionChargesGroups;
use reception\entities\MyRent\ObjectsAdditionalCharges;
use reception\entities\MyRent\ObjectsAdditionalChargesCalculations;
use reception\entities\MyRent\ObjectsAmenites;
use reception\entities\MyRent\ObjectsB2bs;
use reception\entities\MyRent\ObjectsChecks;
use reception\entities\MyRent\ObjectsChecksLogs;
use reception\entities\MyRent\ObjectsCleanLinens;
use reception\entities\MyRent\ObjectsCleanNotLinens;
use reception\entities\MyRent\ObjectsCleans;
use reception\entities\MyRent\ObjectsDistances;
use reception\entities\MyRent\ObjectsDistancesPlaces;
use reception\entities\MyRent\ObjectsDistancesUnits;
use reception\entities\MyRent\ObjectsDoorsLocks;
use reception\entities\MyRent\ObjectsFacilities;
use reception\entities\MyRent\ObjectsGroups;
use reception\entities\MyRent\ObjectsGroupsB2bs;
use reception\entities\MyRent\ObjectsGroupsObjects;
use reception\entities\MyRent\ObjectsGroupsPricesDays;
use reception\entities\MyRent\ObjectsItems;
use reception\entities\MyRent\ObjectsLeisureActivities;
use reception\entities\MyRent\ObjectsLeisureActivityTypes;
use reception\entities\MyRent\ObjectsMaintenances;
use reception\entities\MyRent\ObjectsNames;
use reception\entities\MyRent\ObjectsPaymentMethods;
use reception\entities\MyRent\ObjectsPaymentOptions;
use reception\entities\MyRent\ObjectsPricesCustomers;
use reception\entities\MyRent\ObjectsPricesDays;
use reception\entities\MyRent\ObjectsPricesDaysCustomers;
use reception\entities\MyRent\ObjectsPricesDaysNetos;
use reception\entities\MyRent\ObjectsPricesNotes;
use reception\entities\MyRent\ObjectsPricesStayings;
use reception\entities\MyRent\ObjectsRealestates;
use reception\entities\MyRent\ObjectsRealestatesDescriptions;
use reception\entities\MyRent\ObjectsRealestatesDescriptionsB2bs;
use reception\entities\MyRent\ObjectsRealestatesPictures;
use reception\entities\MyRent\ObjectsRentsSources;
use reception\entities\MyRent\ObjectsRooms;
use reception\entities\MyRent\ObjectsRoomsB2bs;
use reception\entities\MyRent\ObjectsRoomsBeds;
use reception\entities\MyRent\ObjectsRoomsBedsTypes;
use reception\entities\MyRent\ObjectsRoomsEquipments;
use reception\entities\MyRent\ObjectsRoomsEquipmentFeatures;
use reception\entities\MyRent\ObjectsRoomsFloors;
use reception\entities\MyRent\ObjectsRoomsTypes;
use reception\entities\MyRent\ObjectsSeos;
use reception\entities\MyRent\ObjectsSurroundings;
use reception\entities\MyRent\ObjectsTravelTimes;
use reception\entities\MyRent\ObjectsTypesItems;
use reception\entities\MyRent\Offers;
use reception\entities\MyRent\Offices;
use reception\entities\MyRent\Owners;
use reception\entities\MyRent\OwnersContracts;
use reception\entities\MyRent\PaymentMethods;
use reception\entities\MyRent\PaymentsBoxes;
use reception\entities\MyRent\PaymentsRecives;
use reception\entities\MyRent\Profiles;
use reception\entities\MyRent\ProfilesOtas;
use reception\entities\MyRent\Rents;
use reception\entities\MyRent\RentsCards;
use reception\entities\MyRent\RentsCleanings;
use reception\entities\MyRent\RentsDocuments;
use reception\entities\MyRent\RentsDoorsLocks;
use reception\entities\MyRent\RentsGroups;
use reception\entities\MyRent\RentsGroupsRents;
use reception\entities\MyRent\RentsImports;
use reception\entities\MyRent\RentsItems;
use reception\entities\MyRent\RentsItemsTemplates;
use reception\entities\MyRent\RentsLogs;
use reception\entities\MyRent\RentsOffers;
use reception\entities\MyRent\RentsPricesDays;
use reception\entities\MyRent\RentsSources;
use reception\entities\MyRent\RentsStatuses;
use reception\entities\MyRent\RentsWorkersLogs;
use reception\entities\MyRent\Reports;
use reception\entities\MyRent\ReportsTypes;
use reception\entities\MyRent\Reviews;
use reception\entities\MyRent\Settings;
use reception\entities\MyRent\SupportTicketMessages;
use reception\entities\MyRent\SupportTickets;
use reception\entities\MyRent\Surroundings;
use reception\entities\MyRent\TransactionsAccounts;
use reception\entities\MyRent\Treasuries;
use reception\entities\MyRent\UnitWelcomeDescriptions;
use reception\entities\MyRent\Units;
use reception\entities\MyRent\UnitsFiles;
use reception\entities\MyRent\CompanyCountry;
use reception\entities\MyRent\Picture;
use reception\entities\MyRent\Logo;
use reception\entities\MyRent\Reseller;
use reception\entities\MyRent\Super;
use reception\entities\MyRent\UserType;
use reception\entities\MyRent\UsersB2bs;
use reception\entities\MyRent\UsersBraintrees;
use reception\entities\MyRent\UsersEmails;
use reception\entities\MyRent\UsersFisLocations;
use reception\entities\MyRent\UsersGeneralsTerms;
use reception\entities\MyRent\UsersGuests;
use reception\entities\MyRent\UsersIbans;
use reception\entities\MyRent\UsersMyrentContracts;
use reception\entities\MyRent\UsersMyrentInvoicesHeaders;
use reception\entities\MyRent\UsersSettings;
use reception\entities\MyRent\UsersWspays;
use reception\entities\MyRent\Workers;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property int $reseller_id
 * @property int $user_type_id
 * @property int $super_id
 * @property string $admin is it free account
 * @property string $free
 * @property string $code user for code of location
 * @property string $user
 * @property string $password
 * @property string $guid
 * @property string $oib VAT id
 * @property string $tax_id TAX id
 * @property string $company_id company ID number
 * @property string $name
 * @property string $email
 * @property string $tel
 * @property string $tel_mobile
 * @property string $skype
 * @property string $note
 * @property string $note_user not for users to display
 * @property int $picture_id
 * @property int $logo_id
 * @property string $longitude for maps
 * @property string $latitude for maps
 * @property string $company_name
 * @property string $company_adress
 * @property string $company_city_zip
 * @property string $company_city_name
 * @property int $company_country_id
 * @property int $timezone
 * @property string $bank_name
 * @property string $vat_obligation
 * @property double $vat
 * @property string $invoice_text display text on invoice - invoice note
 * @property string $invoice_footer display text on footer invoice
 * @property string $invoice_msg promo message on invoice & voucher
 * @property string $IBAN
 * @property string $SWIFT
 * @property string $mail_confirmation
 * @property string $mail_reminder
 * @property string $link_web
 * @property string $link_web_object link for web site for object details
 * @property string $link_payment link for payment from web page
 * @property string $link_facebook
 * @property string $link_youtube
 * @property string $link_tweeter
 * @property string $link_instagram
 * @property string $owners_domain use it for payment gatway link portal
 * @property string $key
 * @property string $translate enable translate, or not
 * @property string $fix_currency use fix or daily currency
 * @property string $booking_engine eneble booking engine
 * @property string $active
 * @property string $online see if user is online
 * @property string $card_blocked set this Y if he miss pin for 3 times
 * @property string $invoice_more show all invoce report types or just default
 * @property string $blp_display what to show in blp
 * @property string $created
 * @property string $changed
 *
 * @property Amenities[] $amenities
 * @property B2bSettings[] $b2bSettings
 * @property Blogs[] $blogs
 * @property Cleaners[] $cleaners
 * @property CountriesSettlments[] $countriesSettlments
 * @property CreditCards[] $creditCards
 * @property CurrencyExchange[] $currencyExchanges
 * @property Customers[] $customers
 * @property CustomersGroups[] $customersGroups
 * @property CustomersObjects[] $customersObjects
 * @property CustomersPrices[] $customersPrices
 * @property CustomersTypes[] $customersTypes
 * @property DoorsLocks[] $doorsLocks
 * @property EmailsTemplates[] $emailsTemplates
 * @property EmailsTimers[] $emailsTimers
 * @property EmailsTypes[] $emailsTypes
 * @property Excursions[] $excursions
 * @property ExcursionsPictures[] $excursionsPictures
 * @property Friends[] $friends
 * @property Friends[] $friends0
 * @property Guests[] $guests
 * @property GuestsCityTaxes[] $guestsCityTaxes
 * @property GuestsEvisitor[] $guestsEvisitors
 * @property GuestsImport[] $guestsImports
 * @property GuestsRegular[] $guestsRegulars
 * @property InvoicesFis[] $invoicesFis
 * @property InvoicesHeader[] $invoicesHeaders
 * @property InvoicesItems[] $invoicesItems
 * @property InvoicesLog[] $invoicesLogs
 * @property InvoicesPayments[] $invoicesPayments
 * @property InvoicesTypes[] $invoicesTypes
 * @property Items[] $items
 * @property ItemsB2b[] $itemsB2bs
 * @property ItemsPeriod[] $itemsPeriods
 * @property ItemsPrices[] $itemsPrices
 * @property Laundries[] $laundries
 * @property LocationsAreas[] $locationsAreas
 * @property LocationsRegions[] $locationsRegions
 * @property LogB2b[] $logB2bs
 * @property LogEmail[] $logEmails
 * @property LogError[] $logErrors
 * @property LogRentsCards[] $logRentsCards
 * @property LogSms[] $logSms
 * @property LogSql[] $logSqls
 * @property LogUsersLogin[] $logUsersLogins
 * @property Messages[] $messages
 * @property ObjectRealstateMailDescription[] $objectRealstateMailDescriptions
 * @property Objects[] $objects
 * @property ObjectsAdditionChargesGroups[] $objectsAdditionChargesGroups
 * @property ObjectsAdditionalCharges[] $objectsAdditionalCharges
 * @property ObjectsAdditionalChargesCalculations[] $objectsAdditionalChargesCalculations
 * @property ObjectsAmenites[] $objectsAmenites
 * @property ObjectsB2b[] $objectsB2bs
 * @property ObjectsChecks[] $objectsChecks
 * @property ObjectsChecksLogs[] $objectsChecksLogs
 * @property ObjectsCleanLinens[] $objectsCleanLinens
 * @property ObjectsCleanNotLinens[] $objectsCleanNotLinens
 * @property ObjectsCleans[] $objectsCleans
 * @property ObjectsDistances[] $objectsDistances
 * @property ObjectsDistancesPlaces[] $objectsDistancesPlaces
 * @property ObjectsDistancesUnits[] $objectsDistancesUnits
 * @property ObjectsDoorsLocks[] $objectsDoorsLocks
 * @property ObjectsFacilities[] $objectsFacilities
 * @property ObjectsGroups[] $objectsGroups
 * @property ObjectsGroupsB2b[] $objectsGroupsB2bs
 * @property ObjectsGroupsObjects[] $objectsGroupsObjects
 * @property ObjectsGroupsPricesDays[] $objectsGroupsPricesDays
 * @property ObjectsItems[] $objectsItems
 * @property ObjectsLeisureActivity[] $objectsLeisureActivities
 * @property ObjectsLeisureActivityType[] $objectsLeisureActivityTypes
 * @property ObjectsMaintenance[] $objectsMaintenances
 * @property ObjectsNames[] $objectsNames
 * @property ObjectsPaymentMethods[] $objectsPaymentMethods
 * @property ObjectsPaymentOptions[] $objectsPaymentOptions
 * @property ObjectsPricesCustomers[] $objectsPricesCustomers
 * @property ObjectsPricesDays[] $objectsPricesDays
 * @property ObjectsPricesDaysCustomers[] $objectsPricesDaysCustomers
 * @property ObjectsPricesDaysNeto[] $objectsPricesDaysNetos
 * @property ObjectsPricesNotes[] $objectsPricesNotes
 * @property ObjectsPricesStaying[] $objectsPricesStayings
 * @property ObjectsRealestates[] $objectsRealestates
 * @property ObjectsRealestatesDescriptions[] $objectsRealestatesDescriptions
 * @property ObjectsRealestatesDescriptionsB2b[] $objectsRealestatesDescriptionsB2bs
 * @property ObjectsRealestatesPictures[] $objectsRealestatesPictures
 * @property ObjectsRentsSources[] $objectsRentsSources
 * @property ObjectsRooms[] $objectsRooms
 * @property ObjectsRoomsB2b[] $objectsRoomsB2bs
 * @property ObjectsRoomsBeds[] $objectsRoomsBeds
 * @property ObjectsRoomsBedsType[] $objectsRoomsBedsTypes
 * @property ObjectsRoomsEquipment[] $objectsRoomsEquipments
 * @property ObjectsRoomsEquipmentFeatures[] $objectsRoomsEquipmentFeatures
 * @property ObjectsRoomsFloors[] $objectsRoomsFloors
 * @property ObjectsRoomsTypes[] $objectsRoomsTypes
 * @property ObjectsSeo[] $objectsSeos
 * @property ObjectsSurroundings[] $objectsSurroundings
 * @property ObjectsTravelTime[] $objectsTravelTimes
 * @property ObjectsTypesItems[] $objectsTypesItems
 * @property Offers[] $offers
 * @property Offices[] $offices
 * @property Owners[] $owners
 * @property OwnersContracts[] $ownersContracts
 * @property PaymentMethods[] $paymentMethods
 * @property PaymentsBoxes[] $paymentsBoxes
 * @property PaymentsRecive[] $paymentsRecives
 * @property Profiles[] $profiles
 * @property ProfilesOtas[] $profilesOtas
 * @property Rents[] $rents
 * @property RentsCards[] $rentsCards
 * @property RentsCleaning[] $rentsCleanings
 * @property RentsDocuments[] $rentsDocuments
 * @property RentsDoorsLocks[] $rentsDoorsLocks
 * @property RentsGroups[] $rentsGroups
 * @property RentsGroupsRents[] $rentsGroupsRents
 * @property RentsImports[] $rentsImports
 * @property RentsItems[] $rentsItems
 * @property RentsItemsTemplates[] $rentsItemsTemplates
 * @property RentsLog[] $rentsLogs
 * @property RentsOffers[] $rentsOffers
 * @property RentsPricesDays[] $rentsPricesDays
 * @property RentsSources[] $rentsSources
 * @property RentsStatus[] $rentsStatuses
 * @property RentsWorkersLog[] $rentsWorkersLogs
 * @property Reports[] $reports
 * @property ReportsTypes[] $reportsTypes
 * @property Reviews[] $reviews
 * @property Settings[] $settings
 * @property SupportTicketMessages[] $supportTicketMessages
 * @property SupportTickets[] $supportTickets
 * @property Surroundings[] $surroundings
 * @property TransactionsAccounts[] $transactionsAccounts
 * @property Treasury[] $treasuries
 * @property UnitWelcomeDescription[] $unitWelcomeDescriptions
 * @property Units[] $units
 * @property UnitsFiles[] $unitsFiles
 * @property Countries $companyCountry
 * @property Pictures $picture
 * @property Pictures $logo
 * @property Resellers $reseller
 * @property UsersSuper $super
 * @property WorkersTypes $userType
 * @property UsersB2b[] $usersB2bs
 * @property UsersBraintree[] $usersBraintrees
 * @property UsersEmail[] $usersEmails
 * @property UsersFisLocations[] $usersFisLocations
 * @property UsersGeneralsTerms[] $usersGeneralsTerms
 * @property UsersGuests[] $usersGuests
 * @property UsersIbans[] $usersIbans
 * @property UsersMyrentContract[] $usersMyrentContracts
 * @property UsersMyrentInvoicesHeaders[] $usersMyrentInvoicesHeaders
 * @property UsersSettings[] $usersSettings
 * @property UsersWspay[] $usersWspays
 * @property Workers[] $workers
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
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
        * @param int $reseller_id//
        * @param int $user_type_id//
        * @param int $super_id//
        * @param string $admin// is it free account
        * @param string $free//
        * @param string $code// user for code of location
        * @param string $user//
        * @param string $password//
        * @param string $guid//
        * @param string $oib// VAT id
        * @param string $tax_id// TAX id
        * @param string $company_id// company ID number
        * @param string $name//
        * @param string $email//
        * @param string $tel//
        * @param string $tel_mobile//
        * @param string $skype//
        * @param string $note//
        * @param string $note_user// not for users to display
        * @param int $picture_id//
        * @param int $logo_id//
        * @param string $longitude// for maps
        * @param string $latitude// for maps
        * @param string $company_name//
        * @param string $company_adress//
        * @param string $company_city_zip//
        * @param string $company_city_name//
        * @param int $company_country_id//
        * @param int $timezone//
        * @param string $bank_name//
        * @param string $vat_obligation//
        * @param double $vat//
        * @param string $invoice_text// display text on invoice - invoice note
        * @param string $invoice_footer// display text on footer invoice
        * @param string $invoice_msg// promo message on invoice & voucher
        * @param string $IBAN//
        * @param string $SWIFT//
        * @param string $mail_confirmation//
        * @param string $mail_reminder//
        * @param string $link_web//
        * @param string $link_web_object// link for web site for object details
        * @param string $link_payment// link for payment from web page
        * @param string $link_facebook//
        * @param string $link_youtube//
        * @param string $link_tweeter//
        * @param string $link_instagram//
        * @param string $owners_domain// use it for payment gatway link portal
        * @param string $key//
        * @param string $translate// enable translate, or not
        * @param string $fix_currency// use fix or daily currency
        * @param string $booking_engine// eneble booking engine
        * @param string $active//
        * @param string $online// see if user is online
        * @param string $card_blocked// set this Y if he miss pin for 3 times
        * @param string $invoice_more// show all invoce report types or just default
        * @param string $blp_display// what to show in blp
        * @param string $created//
        * @param string $changed//
        * @return Users    */
    public static function create($id, $reseller_id, $user_type_id, $super_id, $admin, $free, $code, $user, $password, $guid, $oib, $tax_id, $company_id, $name, $email, $tel, $tel_mobile, $skype, $note, $note_user, $picture_id, $logo_id, $longitude, $latitude, $company_name, $company_adress, $company_city_zip, $company_city_name, $company_country_id, $timezone, $bank_name, $vat_obligation, $vat, $invoice_text, $invoice_footer, $invoice_msg, $IBAN, $SWIFT, $mail_confirmation, $mail_reminder, $link_web, $link_web_object, $link_payment, $link_facebook, $link_youtube, $link_tweeter, $link_instagram, $owners_domain, $key, $translate, $fix_currency, $booking_engine, $active, $online, $card_blocked, $invoice_more, $blp_display, $created, $changed): Users
    {
        $users = new static();
                $users->id = $id;
                $users->reseller_id = $reseller_id;
                $users->user_type_id = $user_type_id;
                $users->super_id = $super_id;
                $users->admin = $admin;
                $users->free = $free;
                $users->code = $code;
                $users->user = $user;
                $users->password = $password;
                $users->guid = $guid;
                $users->oib = $oib;
                $users->tax_id = $tax_id;
                $users->company_id = $company_id;
                $users->name = $name;
                $users->email = $email;
                $users->tel = $tel;
                $users->tel_mobile = $tel_mobile;
                $users->skype = $skype;
                $users->note = $note;
                $users->note_user = $note_user;
                $users->picture_id = $picture_id;
                $users->logo_id = $logo_id;
                $users->longitude = $longitude;
                $users->latitude = $latitude;
                $users->company_name = $company_name;
                $users->company_adress = $company_adress;
                $users->company_city_zip = $company_city_zip;
                $users->company_city_name = $company_city_name;
                $users->company_country_id = $company_country_id;
                $users->timezone = $timezone;
                $users->bank_name = $bank_name;
                $users->vat_obligation = $vat_obligation;
                $users->vat = $vat;
                $users->invoice_text = $invoice_text;
                $users->invoice_footer = $invoice_footer;
                $users->invoice_msg = $invoice_msg;
                $users->IBAN = $IBAN;
                $users->SWIFT = $SWIFT;
                $users->mail_confirmation = $mail_confirmation;
                $users->mail_reminder = $mail_reminder;
                $users->link_web = $link_web;
                $users->link_web_object = $link_web_object;
                $users->link_payment = $link_payment;
                $users->link_facebook = $link_facebook;
                $users->link_youtube = $link_youtube;
                $users->link_tweeter = $link_tweeter;
                $users->link_instagram = $link_instagram;
                $users->owners_domain = $owners_domain;
                $users->key = $key;
                $users->translate = $translate;
                $users->fix_currency = $fix_currency;
                $users->booking_engine = $booking_engine;
                $users->active = $active;
                $users->online = $online;
                $users->card_blocked = $card_blocked;
                $users->invoice_more = $invoice_more;
                $users->blp_display = $blp_display;
                $users->created = $created;
                $users->changed = $changed;
        
        return $users;
    }

    /**
            * @param int $id//
            * @param int $reseller_id//
            * @param int $user_type_id//
            * @param int $super_id//
            * @param string $admin// is it free account
            * @param string $free//
            * @param string $code// user for code of location
            * @param string $user//
            * @param string $password//
            * @param string $guid//
            * @param string $oib// VAT id
            * @param string $tax_id// TAX id
            * @param string $company_id// company ID number
            * @param string $name//
            * @param string $email//
            * @param string $tel//
            * @param string $tel_mobile//
            * @param string $skype//
            * @param string $note//
            * @param string $note_user// not for users to display
            * @param int $picture_id//
            * @param int $logo_id//
            * @param string $longitude// for maps
            * @param string $latitude// for maps
            * @param string $company_name//
            * @param string $company_adress//
            * @param string $company_city_zip//
            * @param string $company_city_name//
            * @param int $company_country_id//
            * @param int $timezone//
            * @param string $bank_name//
            * @param string $vat_obligation//
            * @param double $vat//
            * @param string $invoice_text// display text on invoice - invoice note
            * @param string $invoice_footer// display text on footer invoice
            * @param string $invoice_msg// promo message on invoice & voucher
            * @param string $IBAN//
            * @param string $SWIFT//
            * @param string $mail_confirmation//
            * @param string $mail_reminder//
            * @param string $link_web//
            * @param string $link_web_object// link for web site for object details
            * @param string $link_payment// link for payment from web page
            * @param string $link_facebook//
            * @param string $link_youtube//
            * @param string $link_tweeter//
            * @param string $link_instagram//
            * @param string $owners_domain// use it for payment gatway link portal
            * @param string $key//
            * @param string $translate// enable translate, or not
            * @param string $fix_currency// use fix or daily currency
            * @param string $booking_engine// eneble booking engine
            * @param string $active//
            * @param string $online// see if user is online
            * @param string $card_blocked// set this Y if he miss pin for 3 times
            * @param string $invoice_more// show all invoce report types or just default
            * @param string $blp_display// what to show in blp
            * @param string $created//
            * @param string $changed//
        * @return Users    */
    public function edit($id, $reseller_id, $user_type_id, $super_id, $admin, $free, $code, $user, $password, $guid, $oib, $tax_id, $company_id, $name, $email, $tel, $tel_mobile, $skype, $note, $note_user, $picture_id, $logo_id, $longitude, $latitude, $company_name, $company_adress, $company_city_zip, $company_city_name, $company_country_id, $timezone, $bank_name, $vat_obligation, $vat, $invoice_text, $invoice_footer, $invoice_msg, $IBAN, $SWIFT, $mail_confirmation, $mail_reminder, $link_web, $link_web_object, $link_payment, $link_facebook, $link_youtube, $link_tweeter, $link_instagram, $owners_domain, $key, $translate, $fix_currency, $booking_engine, $active, $online, $card_blocked, $invoice_more, $blp_display, $created, $changed): Users
    {

            $this->id = $id;
            $this->reseller_id = $reseller_id;
            $this->user_type_id = $user_type_id;
            $this->super_id = $super_id;
            $this->admin = $admin;
            $this->free = $free;
            $this->code = $code;
            $this->user = $user;
            $this->password = $password;
            $this->guid = $guid;
            $this->oib = $oib;
            $this->tax_id = $tax_id;
            $this->company_id = $company_id;
            $this->name = $name;
            $this->email = $email;
            $this->tel = $tel;
            $this->tel_mobile = $tel_mobile;
            $this->skype = $skype;
            $this->note = $note;
            $this->note_user = $note_user;
            $this->picture_id = $picture_id;
            $this->logo_id = $logo_id;
            $this->longitude = $longitude;
            $this->latitude = $latitude;
            $this->company_name = $company_name;
            $this->company_adress = $company_adress;
            $this->company_city_zip = $company_city_zip;
            $this->company_city_name = $company_city_name;
            $this->company_country_id = $company_country_id;
            $this->timezone = $timezone;
            $this->bank_name = $bank_name;
            $this->vat_obligation = $vat_obligation;
            $this->vat = $vat;
            $this->invoice_text = $invoice_text;
            $this->invoice_footer = $invoice_footer;
            $this->invoice_msg = $invoice_msg;
            $this->IBAN = $IBAN;
            $this->SWIFT = $SWIFT;
            $this->mail_confirmation = $mail_confirmation;
            $this->mail_reminder = $mail_reminder;
            $this->link_web = $link_web;
            $this->link_web_object = $link_web_object;
            $this->link_payment = $link_payment;
            $this->link_facebook = $link_facebook;
            $this->link_youtube = $link_youtube;
            $this->link_tweeter = $link_tweeter;
            $this->link_instagram = $link_instagram;
            $this->owners_domain = $owners_domain;
            $this->key = $key;
            $this->translate = $translate;
            $this->fix_currency = $fix_currency;
            $this->booking_engine = $booking_engine;
            $this->active = $active;
            $this->online = $online;
            $this->card_blocked = $card_blocked;
            $this->invoice_more = $invoice_more;
            $this->blp_display = $blp_display;
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
            'reseller_id' => Yii::t('app', 'Reseller ID'),
            'user_type_id' => Yii::t('app', 'User Type ID'),
            'super_id' => Yii::t('app', 'Super ID'),
            'admin' => Yii::t('app', 'Admin'),
            'free' => Yii::t('app', 'Free'),
            'code' => Yii::t('app', 'Code'),
            'user' => Yii::t('app', 'User'),
            'password' => Yii::t('app', 'Password'),
            'guid' => Yii::t('app', 'Guid'),
            'oib' => Yii::t('app', 'Oib'),
            'tax_id' => Yii::t('app', 'Tax ID'),
            'company_id' => Yii::t('app', 'Company ID'),
            'name' => Yii::t('app', 'Name'),
            'email' => Yii::t('app', 'Email'),
            'tel' => Yii::t('app', 'Tel'),
            'tel_mobile' => Yii::t('app', 'Tel Mobile'),
            'skype' => Yii::t('app', 'Skype'),
            'note' => Yii::t('app', 'Note'),
            'note_user' => Yii::t('app', 'Note User'),
            'picture_id' => Yii::t('app', 'Picture ID'),
            'logo_id' => Yii::t('app', 'Logo ID'),
            'longitude' => Yii::t('app', 'Longitude'),
            'latitude' => Yii::t('app', 'Latitude'),
            'company_name' => Yii::t('app', 'Company Name'),
            'company_adress' => Yii::t('app', 'Company Adress'),
            'company_city_zip' => Yii::t('app', 'Company City Zip'),
            'company_city_name' => Yii::t('app', 'Company City Name'),
            'company_country_id' => Yii::t('app', 'Company Country ID'),
            'timezone' => Yii::t('app', 'Timezone'),
            'bank_name' => Yii::t('app', 'Bank Name'),
            'vat_obligation' => Yii::t('app', 'Vat Obligation'),
            'vat' => Yii::t('app', 'Vat'),
            'invoice_text' => Yii::t('app', 'Invoice Text'),
            'invoice_footer' => Yii::t('app', 'Invoice Footer'),
            'invoice_msg' => Yii::t('app', 'Invoice Msg'),
            'IBAN' => Yii::t('app', 'Iban'),
            'SWIFT' => Yii::t('app', 'Swift'),
            'mail_confirmation' => Yii::t('app', 'Mail Confirmation'),
            'mail_reminder' => Yii::t('app', 'Mail Reminder'),
            'link_web' => Yii::t('app', 'Link Web'),
            'link_web_object' => Yii::t('app', 'Link Web Object'),
            'link_payment' => Yii::t('app', 'Link Payment'),
            'link_facebook' => Yii::t('app', 'Link Facebook'),
            'link_youtube' => Yii::t('app', 'Link Youtube'),
            'link_tweeter' => Yii::t('app', 'Link Tweeter'),
            'link_instagram' => Yii::t('app', 'Link Instagram'),
            'owners_domain' => Yii::t('app', 'Owners Domain'),
            'key' => Yii::t('app', 'Key'),
            'translate' => Yii::t('app', 'Translate'),
            'fix_currency' => Yii::t('app', 'Fix Currency'),
            'booking_engine' => Yii::t('app', 'Booking Engine'),
            'active' => Yii::t('app', 'Active'),
            'online' => Yii::t('app', 'Online'),
            'card_blocked' => Yii::t('app', 'Card Blocked'),
            'invoice_more' => Yii::t('app', 'Invoice More'),
            'blp_display' => Yii::t('app', 'Blp Display'),
            'created' => Yii::t('app', 'Created'),
            'changed' => Yii::t('app', 'Changed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmenities()
    {
        return $this->hasMany(Amenities::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getB2bSettings()
    {
        return $this->hasMany(B2bSettings::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogs()
    {
        return $this->hasMany(Blogs::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCleaners()
    {
        return $this->hasMany(Cleaners::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountriesSettlments()
    {
        return $this->hasMany(CountriesSettlments::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreditCards()
    {
        return $this->hasMany(CreditCards::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrencyExchanges()
    {
        return $this->hasMany(CurrencyExchange::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customers::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomersGroups()
    {
        return $this->hasMany(CustomersGroups::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomersObjects()
    {
        return $this->hasMany(CustomersObjects::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomersPrices()
    {
        return $this->hasMany(CustomersPrices::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomersTypes()
    {
        return $this->hasMany(CustomersTypes::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoorsLocks()
    {
        return $this->hasMany(DoorsLocks::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmailsTemplates()
    {
        return $this->hasMany(EmailsTemplates::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmailsTimers()
    {
        return $this->hasMany(EmailsTimers::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmailsTypes()
    {
        return $this->hasMany(EmailsTypes::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExcursions()
    {
        return $this->hasMany(Excursions::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExcursionsPictures()
    {
        return $this->hasMany(ExcursionsPictures::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFriends()
    {
        return $this->hasMany(Friends::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFriends0()
    {
        return $this->hasMany(Friends::class, ['friend_user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGuests()
    {
        return $this->hasMany(Guests::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGuestsCityTaxes()
    {
        return $this->hasMany(GuestsCityTaxes::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGuestsEvisitors()
    {
        return $this->hasMany(GuestsEvisitor::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGuestsImports()
    {
        return $this->hasMany(GuestsImport::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGuestsRegulars()
    {
        return $this->hasMany(GuestsRegular::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoicesFis()
    {
        return $this->hasMany(InvoicesFis::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoicesHeaders()
    {
        return $this->hasMany(InvoicesHeader::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoicesItems()
    {
        return $this->hasMany(InvoicesItems::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoicesLogs()
    {
        return $this->hasMany(InvoicesLog::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoicesPayments()
    {
        return $this->hasMany(InvoicesPayments::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoicesTypes()
    {
        return $this->hasMany(InvoicesTypes::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Items::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsB2bs()
    {
        return $this->hasMany(ItemsB2b::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsPeriods()
    {
        return $this->hasMany(ItemsPeriod::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsPrices()
    {
        return $this->hasMany(ItemsPrices::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLaundries()
    {
        return $this->hasMany(Laundries::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocationsAreas()
    {
        return $this->hasMany(LocationsAreas::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocationsRegions()
    {
        return $this->hasMany(LocationsRegions::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogB2bs()
    {
        return $this->hasMany(LogB2b::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogEmails()
    {
        return $this->hasMany(LogEmail::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogErrors()
    {
        return $this->hasMany(LogError::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogRentsCards()
    {
        return $this->hasMany(LogRentsCards::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogSms()
    {
        return $this->hasMany(LogSms::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogSqls()
    {
        return $this->hasMany(LogSql::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogUsersLogins()
    {
        return $this->hasMany(LogUsersLogin::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Messages::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectRealstateMailDescriptions()
    {
        return $this->hasMany(ObjectRealstateMailDescription::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjects()
    {
        return $this->hasMany(Objects::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsAdditionChargesGroups()
    {
        return $this->hasMany(ObjectsAdditionChargesGroups::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsAdditionalCharges()
    {
        return $this->hasMany(ObjectsAdditionalCharges::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsAdditionalChargesCalculations()
    {
        return $this->hasMany(ObjectsAdditionalChargesCalculations::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsAmenites()
    {
        return $this->hasMany(ObjectsAmenites::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsB2bs()
    {
        return $this->hasMany(ObjectsB2b::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsChecks()
    {
        return $this->hasMany(ObjectsChecks::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsChecksLogs()
    {
        return $this->hasMany(ObjectsChecksLogs::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsCleanLinens()
    {
        return $this->hasMany(ObjectsCleanLinens::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsCleanNotLinens()
    {
        return $this->hasMany(ObjectsCleanNotLinens::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsCleans()
    {
        return $this->hasMany(ObjectsCleans::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsDistances()
    {
        return $this->hasMany(ObjectsDistances::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsDistancesPlaces()
    {
        return $this->hasMany(ObjectsDistancesPlaces::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsDistancesUnits()
    {
        return $this->hasMany(ObjectsDistancesUnits::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsDoorsLocks()
    {
        return $this->hasMany(ObjectsDoorsLocks::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsFacilities()
    {
        return $this->hasMany(ObjectsFacilities::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsGroups()
    {
        return $this->hasMany(ObjectsGroups::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsGroupsB2bs()
    {
        return $this->hasMany(ObjectsGroupsB2b::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsGroupsObjects()
    {
        return $this->hasMany(ObjectsGroupsObjects::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsGroupsPricesDays()
    {
        return $this->hasMany(ObjectsGroupsPricesDays::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsItems()
    {
        return $this->hasMany(ObjectsItems::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsLeisureActivities()
    {
        return $this->hasMany(ObjectsLeisureActivity::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsLeisureActivityTypes()
    {
        return $this->hasMany(ObjectsLeisureActivityType::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsMaintenances()
    {
        return $this->hasMany(ObjectsMaintenance::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsNames()
    {
        return $this->hasMany(ObjectsNames::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsPaymentMethods()
    {
        return $this->hasMany(ObjectsPaymentMethods::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsPaymentOptions()
    {
        return $this->hasMany(ObjectsPaymentOptions::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsPricesCustomers()
    {
        return $this->hasMany(ObjectsPricesCustomers::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsPricesDays()
    {
        return $this->hasMany(ObjectsPricesDays::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsPricesDaysCustomers()
    {
        return $this->hasMany(ObjectsPricesDaysCustomers::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsPricesDaysNetos()
    {
        return $this->hasMany(ObjectsPricesDaysNeto::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsPricesNotes()
    {
        return $this->hasMany(ObjectsPricesNotes::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsPricesStayings()
    {
        return $this->hasMany(ObjectsPricesStaying::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsRealestates()
    {
        return $this->hasMany(ObjectsRealestates::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsRealestatesDescriptions()
    {
        return $this->hasMany(ObjectsRealestatesDescriptions::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsRealestatesDescriptionsB2bs()
    {
        return $this->hasMany(ObjectsRealestatesDescriptionsB2b::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsRealestatesPictures()
    {
        return $this->hasMany(ObjectsRealestatesPictures::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsRentsSources()
    {
        return $this->hasMany(ObjectsRentsSources::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsRooms()
    {
        return $this->hasMany(ObjectsRooms::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsRoomsB2bs()
    {
        return $this->hasMany(ObjectsRoomsB2b::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsRoomsBeds()
    {
        return $this->hasMany(ObjectsRoomsBeds::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsRoomsBedsTypes()
    {
        return $this->hasMany(ObjectsRoomsBedsType::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsRoomsEquipments()
    {
        return $this->hasMany(ObjectsRoomsEquipment::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsRoomsEquipmentFeatures()
    {
        return $this->hasMany(ObjectsRoomsEquipmentFeatures::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsRoomsFloors()
    {
        return $this->hasMany(ObjectsRoomsFloors::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsRoomsTypes()
    {
        return $this->hasMany(ObjectsRoomsTypes::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsSeos()
    {
        return $this->hasMany(ObjectsSeo::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsSurroundings()
    {
        return $this->hasMany(ObjectsSurroundings::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsTravelTimes()
    {
        return $this->hasMany(ObjectsTravelTime::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectsTypesItems()
    {
        return $this->hasMany(ObjectsTypesItems::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOffers()
    {
        return $this->hasMany(Offers::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOffices()
    {
        return $this->hasMany(Offices::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwners()
    {
        return $this->hasMany(Owners::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwnersContracts()
    {
        return $this->hasMany(OwnersContracts::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentMethods()
    {
        return $this->hasMany(PaymentMethods::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentsBoxes()
    {
        return $this->hasMany(PaymentsBoxes::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentsRecives()
    {
        return $this->hasMany(PaymentsRecive::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profiles::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfilesOtas()
    {
        return $this->hasMany(ProfilesOtas::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRents()
    {
        return $this->hasMany(Rents::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsCards()
    {
        return $this->hasMany(RentsCards::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsCleanings()
    {
        return $this->hasMany(RentsCleaning::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsDocuments()
    {
        return $this->hasMany(RentsDocuments::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsDoorsLocks()
    {
        return $this->hasMany(RentsDoorsLocks::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsGroups()
    {
        return $this->hasMany(RentsGroups::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsGroupsRents()
    {
        return $this->hasMany(RentsGroupsRents::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsImports()
    {
        return $this->hasMany(RentsImports::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsItems()
    {
        return $this->hasMany(RentsItems::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsItemsTemplates()
    {
        return $this->hasMany(RentsItemsTemplates::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsLogs()
    {
        return $this->hasMany(RentsLog::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsOffers()
    {
        return $this->hasMany(RentsOffers::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsPricesDays()
    {
        return $this->hasMany(RentsPricesDays::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsSources()
    {
        return $this->hasMany(RentsSources::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsStatuses()
    {
        return $this->hasMany(RentsStatus::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentsWorkersLogs()
    {
        return $this->hasMany(RentsWorkersLog::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReports()
    {
        return $this->hasMany(Reports::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReportsTypes()
    {
        return $this->hasMany(ReportsTypes::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Reviews::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSettings()
    {
        return $this->hasMany(Settings::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupportTicketMessages()
    {
        return $this->hasMany(SupportTicketMessages::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupportTickets()
    {
        return $this->hasMany(SupportTickets::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurroundings()
    {
        return $this->hasMany(Surroundings::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionsAccounts()
    {
        return $this->hasMany(TransactionsAccounts::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTreasuries()
    {
        return $this->hasMany(Treasury::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnitWelcomeDescriptions()
    {
        return $this->hasMany(UnitWelcomeDescription::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnits()
    {
        return $this->hasMany(Units::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnitsFiles()
    {
        return $this->hasMany(UnitsFiles::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanyCountry()
    {
        return $this->hasOne(Countries::class, ['id' => 'company_country_id']);
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
    public function getLogo()
    {
        return $this->hasOne(Pictures::class, ['id' => 'logo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReseller()
    {
        return $this->hasOne(Resellers::class, ['id' => 'reseller_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuper()
    {
        return $this->hasOne(UsersSuper::class, ['id' => 'super_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserType()
    {
        return $this->hasOne(WorkersTypes::class, ['id' => 'user_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersB2bs()
    {
        return $this->hasMany(UsersB2b::class, ['users_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersBraintrees()
    {
        return $this->hasMany(UsersBraintree::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersEmails()
    {
        return $this->hasMany(UsersEmail::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersFisLocations()
    {
        return $this->hasMany(UsersFisLocations::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersGeneralsTerms()
    {
        return $this->hasMany(UsersGeneralsTerms::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersGuests()
    {
        return $this->hasMany(UsersGuests::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersIbans()
    {
        return $this->hasMany(UsersIbans::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersMyrentContracts()
    {
        return $this->hasMany(UsersMyrentContract::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersMyrentInvoicesHeaders()
    {
        return $this->hasMany(UsersMyrentInvoicesHeaders::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersSettings()
    {
        return $this->hasMany(UsersSettings::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersWspays()
    {
        return $this->hasMany(UsersWspay::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkers()
    {
        return $this->hasMany(Workers::class, ['user_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \reception\entities\MyRent\queries\UsersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \reception\entities\MyRent\queries\UsersQuery(get_called_class());
    }
}

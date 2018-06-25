<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 5/15/18
 * Time: 8:19 AM
 */
namespace reception\forms\MyRent;

use reception\forms\CompositeForm;
use reception\forms\MyRent\formsFacilitiesForm;
use reception\forms\MyRent\formsRealEstatesForm;

/**
 * This is the form class for detail filter.
 *
 * @property FacilitiesForm $facilities
 * @property RealEstatesForm $realEstates
* @property RoomsFacilitiesForm $roomsFacilities
 ** @property ObjectsForm $object
 ** @property GeoSearchForm $geo
 * @property AvailabilityForm $availability
 * @property ValuesForm  $values
 *  * @property SearchForm  $search
 **/

class DetailFilterForm extends CompositeForm
{

    public $priceRange;
    public $stars;
    public $location;
    public $from;
    public $to;
    public $numberOfGuests;
    public $numberOfRooms;
    public $space;
    public $user;

    /**
     * DetailFilterForm constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
//        $this->search = new SearchForm();
        $this->facilities = new FacilitiesForm();
        $this->realEstates = new RealEstatesForm();
        $this->roomsFacilities = new RoomsFacilitiesForm();
        $this->object = new ObjectsForm();
        $this->geo = new GeoSearchForm();
        $this->availability = new AvailabilityForm();

        $this->values = array_map( function ($attribute) {
            return new ValuesForm($attribute);
        }, $this->realEstates->getAttributes());
        parent::__construct($config);

    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['priceRange', 'user_id','stars','user'], 'safe'],
            [['location'], 'string'],
            [['from','to'],'string'],
            [['numberOfGuests', 'numberOfRooms','space'], 'integer'],
        ];
    }

    protected function internalForms(): array
    {
        return ['search','facilities','realEstates','object','geo','availability','values','roomsFacilities']; //'objects'
    }


}
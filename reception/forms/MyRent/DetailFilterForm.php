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
 * @property RealEstatesForm realEstates

 **/

class DetailFilterForm extends CompositeForm
{
    /**
     * BookingForm constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        parent::__construct($config);
        $this->facilities = new FacilitiesForm();
        $this->realEstates = new RealEstatesForm();
//        $this->object = new ObjectsForm();
//        $this->geo = new GeoSearchForm();

    }

    protected function internalForms(): array
    {
        return ['facilities','realEstates']; //'objects'
    }


}
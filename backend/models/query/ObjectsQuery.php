<?php

namespace backend\models\query;

use backend\helpers\AvailabilityHelper;
use backend\models\Rents;
use reception\forms\MyRent\DetailFilterForm;
use const SORT_ASC;
use const SORT_DESC;


/**
 * This is the ActiveQuery class for [[Objects]].
 *
 * @see Objects
 */
class ObjectsQuery extends \yii\db\ActiveQuery
{


    /**
     * @inheritdoc
     * @return Objects[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Objects|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @inheritdoc
     * @return Objects|array|null
     */
    public function forUsers($userIds)
    {
        return $this->andWhere(['objects.user_id'=>$userIds]);
    }

    public function active()
    {
        return $this->andWhere(['objects.active'=>"Y"]);
    }

    public function withUnit() {
        return $this->andWhere(['not',['objects.unit_id'=>null]]);
    }

    /**
     * @inheritdoc
     * @return Objects|array|null
     */
    public function notFullOccupied($start, $until, $userIds)
    {
        //получаем все букинги за период
        $rentsQuery = Rents::find()->select('rents.from_date, rents.until_date, rents.id, rents.object_id ')
            ->leftJoin('objects', 'objects.id = rents.object_id')->andwhere(['objects.user_id' => $userIds])
            ->andFilterWhere([
                'or',
                ['and', ['<',  'rents.from_date', $start], ['>',  'rents.until_date', $until] ],
                ['and', ['>=', 'rents.from_date', $start], ['<=', 'rents.until_date', $until] ],
                ['and', ['<',  'rents.from_date', $start], ['<',  'rents.until_date', $until],['>=', 'rents.until_date',  $start] ],
                ['and', ['>',  'rents.from_date', $start], ['>',  'rents.until_date', $until],['<=', 'rents.from_date', $until] ]
            ])
            ->active()
            ->orderBy(['objects.id' => SORT_ASC, 'rents.from_date' => SORT_ASC]);
        //получаем занятые апартаменты
        $bookedObjectIDs = AvailabilityHelper::getAvailabilityIDs($rentsQuery->asArray()->all(), $start, $until);

        return  $this->andWhere(['not in','objects.id',$bookedObjectIDs]);
    }

    
    /**
     * @inheritdoc
     * @return Rents|array|null
     */
    public function forReception($reception)
    {
        if (!$reception || $reception == '')
            return $this->andFilterWhere(['objects.user_id'=>[606,607,608,609,610,611,612]]);
        return $this->andFilterWhere(['objects.user_id'=>$reception]);
    }

    private function getUserId($reception) {
        if (!$reception) return [606,607,608,609,610,611,612];
        switch ($reception){
            case "Kvarner":
                return 611 ;
            case "Gajac":
                return 610;
            case "Cervar":
                return 607;
            case "Savudrija":
                return 612;
            case "Zaglav":
                return 609;
            case "Barbariga":
                return 608;
            case "Mareda":
                return 606;
            default:
                return [606,607,608,609,610,611,612];
        }
    }

//    public function availabilityCalc($start,$until)
//    {
//        $subquery=$this->select()->joinWith("rents")->joinWitn("units")
//
//        $query = $this->select("TO_DAYS('2018-06-15') - TO_DAYS('2018-05-29') as Period,
//        ( LEAST(TO_DAYS(`rents`.`until_date`), TO_DAYS('2018-06-15') ) - GREATEST ( TO_DAYS(`rents`.`from_date`),TO_DAYS('2018-05-29') ) ) as Intersection")->orderBy(['Intersection' => SORT_DESC]);
//    }
    public function forPeriod($start,$until)
    {
        return $this->andFilterWhere([
            'or',
            ['and', ['<',  'rents.from_date', $start], ['>',  'rents.until_date', $until] ],
            ['and', ['>=', 'rents.from_date', $start], ['<=', 'rents.until_date', $until] ],
            ['and', ['<',  'rents.from_date', $start], ['<',  'rents.until_date', $until],['>=', 'rents.until_date',  $start] ],
            ['and', ['>',  'rents.from_date', $start], ['>',  'rents.until_date', $until],['<=', 'rents.from_date', $until] ]
        ]);
    }
//for RealEstate

    public function forDetailFilter(DetailFilterForm $filter)
    {
        $this->joinWith('objectsFacilities');
        $this->joinWith('objectsRealEstates');
        $this->andFilterWhere([
            'id' => $filter->realEstates->id,
            'object_id' => $filter->realEstates->object_id,
            'object_type_id' => $filter->realEstates->object_type_id,
            'property_type_id' => $filter->realEstates->property_type_id,
            'object_name_id' => $filter->realEstates->object_name_id,
            'can_sleep_max' => $filter->realEstates->can_sleep_max,
            'promotion_id' => $filter->realEstates->promotion_id,
            'can_sleep_optimal' => $filter->realEstates->can_sleep_optimal,
            'beds' => $filter->realEstates->beds,
            'beds_extra' => $filter->realEstates->beds_extra,
            'bathrooms' => $filter->realEstates->bathrooms,
            'bedrooms' => $filter->realEstates->bedrooms,
            'toilets' => $filter->realEstates->toilets,
            'baby_coat' => $filter->realEstates->baby_coat,
            'high_chair' => $filter->realEstates->high_chair,
            'floor' => $filter->realEstates->floor,
            'min_stay' => $filter->realEstates->min_stay,
            'security_deposit_type' => $filter->realEstates->security_deposit_type,
            'security_deposit' => $filter->realEstates->security_deposit,
            'down_deposit_type' => $filter->realEstates->down_deposit_type,
            'down_deposit' => $filter->realEstates->down_deposit,
            'cleaning_price' => $filter->realEstates->cleaning_price,
            'space' => $filter->realEstates->space,
            'space_yard' => $filter->realEstates->space_yard,
            'standard_guests' => $filter->realEstates->standard_guests,
            'classification_star' => $filter->realEstates->classification_star,
            'price_standard' => $filter->realEstates->price_standard,
            'guest_review' => $filter->realEstates->guest_review,
            'created' => $filter->realEstates->created,
            'changed' => $filter->realEstates->changed,
        ]);

        $this->andFilterWhere(['like', 'name', $filter->realEstates->name])
            ->andFilterWhere(['like', 'motto', $filter->realEstates->motto])
            ->andFilterWhere(['like', 'note', $filter->realEstates->note])
            ->andFilterWhere(['like', 'description', $filter->realEstates->description])
            ->andFilterWhere(['like', 'changeover', $filter->realEstates->changeover])
            ->andFilterWhere(['like', 'wifi_network', $filter->realEstates->wifi_network])
            ->andFilterWhere(['like', 'wifi_password', $filter->realEstates->wifi_password])
            ->andFilterWhere(['like', 'check_in', $filter->realEstates->check_in])
            ->andFilterWhere(['like', 'check_out', $filter->realEstates->check_out])
            ->andFilterWhere(['like', 'smoking', $filter->realEstates->smoking])
            ->andFilterWhere(['like', 'luxurius', $filter->realEstates->luxurius])
            ->andFilterWhere(['like', 'air_conditioning', $filter->realEstates->air_conditioning])
            ->andFilterWhere(['like', 'internet', $filter->realEstates->internet])
            ->andFilterWhere(['like', 'wheelchair_accessible', $filter->realEstates->wheelchair_accessible])
            ->andFilterWhere(['like', 'pets', $filter->realEstates->pets])
            ->andFilterWhere(['like', 'swimming_pool', $filter->realEstates->swimming_pool])
            ->andFilterWhere(['like', 'parking', $filter->realEstates->parking])
            ->andFilterWhere(['like', 'loc_beach', $filter->realEstates->loc_beach])
            ->andFilterWhere(['like', 'loc_country', $filter->realEstates->loc_country])
            ->andFilterWhere(['like', 'loc_city', $filter->realEstates->loc_city])
            ->andFilterWhere(['like', 'tripadvisor_review', $filter->realEstates->tripadvisor_review]);

//for facilities

        $this->andFilterWhere([
            'id' => $filter->facilities->id,
            'user_id' => $filter->facilities->user_id,
            'object_id' => $filter->facilities->object_id,
            'created' => $filter->facilities->created,
            'changed' => $filter->facilities->changed,
        ]);

        $this->andFilterWhere(['like', 'seaview', $filter->facilities->seaview])
            ->andFilterWhere(['like', 'babycot', $filter->facilities->babycot])
            ->andFilterWhere(['like', 'breakfast', $filter->facilities->breakfast])
            ->andFilterWhere(['like', 'halfboard', $filter->facilities->halfboard])
            ->andFilterWhere(['like', 'fullboard', $filter->facilities->fullboard])
            ->andFilterWhere(['like', 'berth', $filter->facilities->berth])
            ->andFilterWhere(['like', 'jacuzzi', $filter->facilities->jacuzzi])
            ->andFilterWhere(['like', 'terrace', $filter->facilities->terrace])
            ->andFilterWhere(['like', 'tv_satelite', $filter->facilities->tv_satelite])
            ->andFilterWhere(['like', 'wifi', $filter->facilities->wifi])
            ->andFilterWhere(['like', 'internet_fast', $filter->facilities->internet_fast])
            ->andFilterWhere(['like', 'internet', $filter->facilities->internet])
            ->andFilterWhere(['like', 'smoking', $filter->facilities->smoking])
            ->andFilterWhere(['like', 'luxurious', $filter->facilities->luxurious])
            ->andFilterWhere(['like', 'air_conditioning', $filter->facilities->air_conditioning])
            ->andFilterWhere(['like', 'tv_lcd', $filter->facilities->tv_lcd])
            ->andFilterWhere(['like', 'wheelchair_accessible', $filter->facilities->wheelchair_accessible])
            ->andFilterWhere(['like', 'near_beach', $filter->facilities->near_beach])
            ->andFilterWhere(['like', 'pets', $filter->facilities->pets])
            ->andFilterWhere(['like', 'near_country', $filter->facilities->near_country])
            ->andFilterWhere(['like', 'near_city', $filter->facilities->near_city])
            ->andFilterWhere(['like', 'in_city', $filter->facilities->in_city])
            ->andFilterWhere(['like', 'in_country', $filter->facilities->in_country])
            ->andFilterWhere(['like', 'swimming_pool', $filter->facilities->swimming_pool])
            ->andFilterWhere(['like', 'swimming_pool_indoor', $filter->facilities->swimming_pool_indoor])
            ->andFilterWhere(['like', 'swimming_pool_indoor_heated', $filter->facilities->swimming_pool_indoor_heated])
            ->andFilterWhere(['like', 'swimming_pool_outdoor', $filter->facilities->swimming_pool_outdoor])
            ->andFilterWhere(['like', 'swimming_pool_outdoor_heated', $filter->facilities->swimming_pool_outdoor_heated])
            ->andFilterWhere(['like', 'parking', $filter->facilities->parking])
            ->andFilterWhere(['like', 'sauna', $filter->facilities->sauna])
            ->andFilterWhere(['like', 'gym', $filter->facilities->gym])
            ->andFilterWhere(['like', 'separate_kitchen', $filter->facilities->separate_kitchen])
            ->andFilterWhere(['like', 'elevator', $filter->facilities->elevator])
            ->andFilterWhere(['like', 'heating', $filter->facilities->heating])
            ->andFilterWhere(['like', 'towels', $filter->facilities->towels])
            ->andFilterWhere(['like', 'linen', $filter->facilities->linen])
            ->andFilterWhere(['like', 'for_couples', $filter->facilities->for_couples])
            ->andFilterWhere(['like', 'for_family', $filter->facilities->for_family])
            ->andFilterWhere(['like', 'for_friends', $filter->facilities->for_friends])
            ->andFilterWhere(['like', 'for_large_groups', $filter->facilities->for_large_groups])
            ->andFilterWhere(['like', 'for_wedings', $filter->facilities->for_wedings])
            ->andFilterWhere(['like', 'total_privacy', $filter->facilities->total_privacy]);
    }
}

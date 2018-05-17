<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 24.07.17
 * Time: 11:36
 */


namespace reception\repositories\Booking;

use reception\entities\Apartment\Owner;
use reception\entities\Booking\Booking;
use reception\repositories\NotFoundException;

class BookingRepository
{
    public function get($id): Booking
    {
        if (!$booking = Booking::findOne($id)) {
            throw new NotFoundException('Booking is not found.');
        }
        return $booking;
    }
    public function getByExternalId($externalId): Booking
    {
        if (!$booking = Booking::find()->where(['external_id'=>$externalId])->one()) {
            throw new NotFoundException('Booking is not found.');
        }
        return $booking;
    }
    public function findByMyRentId($externalId)
    {
        if (!$booking = Booking::find()->where(['external_id'=>$externalId])->one()) {
            return null;
        }
        return $booking;
    }
    public function getByGuestId($guestId)
    {
        $bookings = Booking::find()
                ->andWhere(['status' => Booking::STATUS_ACTIVE])
//                ->andwhere(['>=', 'start_date',  date("Y-m-d", time())])
//                ->orWhere(['<=', 'end_date',  date("Y-m-d", time())])
                //->andWhere(['<=', 'end_date', $to])
                ->joinWith('guests')
                ->andWhere(['or', ['guest.id' => $guestId], ['booking.guest_id' => $guestId]])
                ->all();
        return ($bookings)? $bookings: [];
    }

    public function getBookingsForApartmentsSet($apartments) {
        $bookings = Booking::find()
                    ->andWhere(['in','apartment_id',$apartments])
                    ->all();
        return ($bookings)? $bookings: [];
    }

    public function getBookingsForApartmentsSetAndFromTime($apartments, $lastUpdateTime) {
        $bookings = Booking::find()
            ->andFilterWhere(['>=','from_date', date('Y-m-d',$lastUpdateTime)])
            ->andWhere(['in','apartment_id',$apartments])
            ->all();
        return ($bookings)? $bookings: [];
    }

    public function isBookingExist($externalId, $startDate,$endDate,$status,$apartmentId)
    {
        if ($booking = Booking::find()->where([
                    'external_id' => $externalId,
//                    'start_date'=>$startDate,
//                    'end_date'=>$endDate,
//                    'status'=>$status,
//                    'apartment_id'=>$apartmentId
                    ])
//                    ->joinWith('apartment')
//                    ->andWhere( ['apartment.external_id'=>$externalApartmentId])
                    ->one()
            )
            return $booking;
        return false;
    }

    public function getBookingsByReceptionistAndDate($receptionistId,$from,$to) {
        $owners = (new \yii\db\Query())->select(["`owner`.`id`"])->from('receptionist')
                    ->leftJoin("owner","`owner`.`receptionist_id`=`receptionist`.`id`",[])
                    ->where(["`owner`.`receptionist_id`"=>$receptionistId]);
        $apartments = (new \yii\db\Query())->select('apartment.id')->from('apartment')
                    ->where(["apartment.owner_id"=>$owners]);
        $query = (new \yii\db\Query())->from("booking")
                ->where(["booking.apartment_id"=>$apartments])
                ->andwhere(['or',['like','start_date', $from],['>=', 'start_date', $from]])
                ->andWhere(['<=', 'end_date', $to]);
        if ($bookings = $query->all())
            return $bookings;
        return [];
    }

    public function getBookingsByOwnerAndDate($ownerId,$from,$to) {
        $bookings = Booking::find()
            ->where(['or',['like','start_date', '%'.$from.'%'],['>=', 'start_date', $from]])
            ->andWhere(['<=', 'end_date', $to])
            ->joinWith('apartment')
            ->andWhere(['apartment.owner_id'=>$ownerId])
            ->all();
        return ($bookings)? $bookings: [];
    }

    public function getBookingsByGuest($guest,$from,$to){
        //найти ве букинги, где гость является автором букинга или входит в список гостей
        if ($from===$to) {
            $bookings = Booking::find()
                ->andWhere(['status' => Booking::STATUS_ACTIVE])
                ->where(['or',['like','start_date', '%'.$from.'%'],['<=', 'start_date', $from],['>=', 'end_date', $to]])
//                ->andWhere(['like', 'start_date',  $from])
//                ->orWhere(['<=', 'end_date', $to])
                ->joinWith('guests')
                ->andWhere(['or', ['guest.id' => $guest->id], ['booking.guest_id' => $guest->id]])
                ->all();
        }
        else
            $bookings = Booking::find()
                ->andWhere(['status' => Booking::STATUS_ACTIVE])
                ->andwhere(['or', ['like', 'start_date',  $from ], ['>=', 'start_date', $from]])
                ->andWhere(['<=', 'start_date', $to])
                ->joinWith('guests')
                ->andWhere(['or', ['guest.id' => $guest->id], ['booking.guest_id' => $guest->id]])
                ->all();
        return ($bookings)? $bookings: [];
    }

    public function getBookingsByMobileUser($user_id,$from,$to){
        //найти ве букинги, где гость является мобильным пользователем $user
       if ($from===$to) {
           $bookings = Booking::find()
               ->andFilterwhere(['status' => Booking::STATUS_ACTIVE])
               ->andFilterwhere( ['like', 'start_date', $from])
//               ->orFilterWhere(['<=', 'start_date', $to])
//               ->andFilterwhere(['or',['like','end_date', $to],['<=', 'end_date', $to]])
               ->joinWith('apartment')
               ->andFilterwhere(['apartment.user_id' => $user_id])
               ->orderBy(['apartment.name'=>SORT_ASC])
               ->all();
       }
        else $bookings = Booking::find()
            ->andWhere(['status' => Booking::STATUS_ACTIVE])
            ->andwhere(['or',['like','start_date', $from],['>=', 'start_date', $from]])
            ->andwhere(['<=','start_date', $to])
            //->andWhere(['or',['like','end_date', $to],['<=', 'end_date', $to]])
            ->joinWith('apartment')
            ->andWhere(['apartment.user_id'=>$user_id])
            ->all();

        return ($bookings)? $bookings: [];
    }
    public function getBookingsByOwner($owner_id,$from,$to){
        //найти ве букинги, где гость является мобильным пользователем $user
        if ($from===$to) {
            $bookings = Booking::find()
                ->andWhere(['status' => Booking::STATUS_ACTIVE])
                ->andwhere( ['like', 'start_date', $from])
                //->andwhere(['<=', 'start_date', $to])
                //->andWhere(['or',['like','end_date', $to],['<=', 'end_date', $to]])
                ->joinWith('apartment')
                ->andWhere(['apartment.owner_id' => $owner_id])
                ->all();
        }
        else $bookings = Booking::find()
            ->andWhere(['status' => Booking::STATUS_ACTIVE])
            ->andwhere(['or',['like','start_date', $from],['>=', 'start_date', $from]])
            ->andwhere(['<=','start_date', $to])
            //->andWhere(['or',['like','end_date', $to],['<=', 'end_date', $to]])
            ->joinWith('apartment')
            ->andWhere(['apartment.owner_id'=>$owner_id])
            ->all();

        return ($bookings)? $bookings: [];
    }

    public function save(Booking $booking): void
    {
        if (!$booking->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Booking $booking): void
    {
        if (!$booking->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

    public function removeById (int $id) {
        $booking = $this->get ($id);
        if ($booking) {
            if (!$booking->delete()) {
                throw new \RuntimeException('Removing error.');
            }
        }
    }
}
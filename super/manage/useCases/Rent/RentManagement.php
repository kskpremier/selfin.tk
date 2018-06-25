<?php

namespace superuser\useCases\Rent;

use yii\base\ErrorHandler;

//use reception\services\TransactionManager;

/**
 * Class MyRentManageService
 * @package reception\useCases\manage\MyRentReception
 */
class RentManageService
{
    use EventTrait;

    private $repository;
   
    /**
     * @var Newsletter
     */
    //  private $newsletter;

    public function __construct(
       $this->rents = RentsRepository ; 
    )
    {
        $this->repository = $repository;
        $this->transaction = $transaction;
        $this->errorHandler = $errorHandler;

    }

    public function createMyRentUser(MyRentUserForm $form): User
    {
        $user = User::create($form->username, $form->contact_email, $form->password, $form->contact_name, $form->contact_tel, $form->id, $form->guid, strtotime($form->changed));
        $this->transaction->wrap(function() use ($form, $user) {
            $owner=null; $guest=null;
            $this->repository->save($user);
            if (in_array("owner", $form->roles)) {
                $owner = Owner::create($form->id, $form->guid, $form->username, $form->country_id, $form->contact_tel, $form->contact_email,
                    $form->contact_name, strtotime($form->created), strtotime($form->changed), null, $form->country_id,
                    null, null, $user->id, $apartments = null);
                $masterUser = $this->repository->getByExternalId($form->user_id);
                $this->repository->save($masterUser);
                $this->ownerRepository->saveMyRentOwner($owner);
            }
            if (in_array("worker", $form->roles)) {
                $owner = Worker::create($form->id, $form->guid, $form->username, $form->country_id, $form->contact_tel, $form->contact_email,
                    $form->contact_name, strtotime($form->created), strtotime($form->changed), null, $form->country_id,
                    null, null, $user->id, $apartments = null);
                $masterUser = $this->repository->getByExternalId($form->user_id);
                $this->repository->save($masterUser);
                $this->ownerRepository->saveMyRentOwner($owner);
            }
            if (in_array("tourist", $form->roles)) {
                $booking = $this->bookingService->updateBookings($form->rent, $user->id, time());
                $guest = Guest::createContact($form->rent->contact, time());
                $guest->user_id=$user->id;//'', $form->contact_name, $form->contact_email, $user, $booking, $form->contact_tel, time(), $form->guid);
                $this->guestRepository->save($guest);
            }
            if (in_array("checkin", $form->roles)) {
            }

            $this->roles->assignRoles($user->id, $form->roles);
            $user->recordEvent(new UserMobileCreated($user, $owner, $guest));
            $this->repository->save($user);
        });
        return $user;
    }


    /**
     * Making synchronization data with MyRentReception for user
     * Get apartments list for user, update every apartment with its door locks
     * If apartment were disconnect from this user - make unlink
     * @param User $user
     */
    public function updateMyRentUser(User $user)
    {

        $this->transaction->wrap(function () use ($user) {
            $updateTime = time();
            if (($user->myrent_update == null) || ($updateTime - $user->myrent_update > MyRent::MyRent_UPDATE_INTERVAL)) {
                //запросить список апартаментов на момент обновления в MyRentReception
                $apartmentList = MyRent::getApartmentsForUser($user->external_id);
                //Сохранить список апартаментов из нашей базы
                $apartmentDBList = $user->apartments;
                //по каждому из апартаментов по списку сделать или апдейт или криэйт
                //если к апартаменту присоединен замок -> повторить это же и в базе
                foreach ($apartmentList as $apartmentData) {
                    try {$form = new ApartmentForm();
                        $form->load($apartmentData, '');
                        if ($form->validate()) {
                            //ищем уже существующие апартаменты
                            $apartment = $this->apartmentRepository->findByMyRentId($form->id);
                            //           $doorLocks = [];
                            if (!isset($apartment)) {
                                //если не найдены - создаем
                                $apartment = Apartment::addProperty($form, $user->id, $updateTime);
                            }
                            else // если найдены - вносим испраления, если они были
                            {
                                $apartment = $apartment->edit($form, $user->id, $updateTime);
                                //сохраняем замки, которые уже присоеденины к апартаменту

                                /** изъял все, что касается обновления замков до определения новой стратегии взаимодействия */
//                                $doorLocks=$apartment->doorLocks;
                            }
//                            //обновляем замки в апартаменте
//                            if ($apartmentData["door_id"]) {
//                                $doorlock = $this->doorlockRepository->get($apartmentData["door_id"]);
//                                if ($doorlock && $dorlock->apartments) {
//                                    $doorlock->installInApartment($apartment->id, $user->id, $updateTime);
//                                    $this->doorlockRepository->save($doorlock);
//                                } else throw new \DomainException ('Failed to find door lock with id => ' . $apartmentData["door_id"]);
//                            }
//                            else {
//                                foreach ($doorLocks as $lock){
//                                    $lock->uninstallDoorLock($user->id, $updateTime);
//                                    $this->doorlockRepository->save($lock);
//                                }
//                            }
                            $this->apartmentRepository->save($apartment);
                        }
                        else throw new \DomainException ('Failed to create the object => ' . \GuzzleHttp\json_encode($form->getFirstErrors()));
                    }
                    catch(\DomainException $e) {
                        $this->errorHandler->handleException($e);
                    }
                }
                $formerUserApartmentArray = $this->compareInternalExternalApartmentsLists($apartmentDBList, $apartmentList);
                foreach ($formerUserApartmentArray as $apartment) {
                    $apartment->user_id = null; //делаем дисконнект апартамента, НО !!! не удаляем его из базы, а просто пишем, что они "ничьи"
                    $this->apartmentRepository->save($apartment);
                }
                $user->setMyRentUpdateTime($updateTime);
                $this->repository->save($user);
            }
        });
    }

    public function saveUpdateTime(User $user, $updateTime)
    {
        $user->setUpdateTime($updateTime);
        $this->repository->save($user);
    }


    public function edit($id, UserEditForm $form): void
    {
        $user = $this->repository->get($id);
        $user->edit(
            $form->username,
            $form->email //,
//            $form->phone
        );
        //     $this->transaction->wrap(function () use ($user, $form) {
        // $this->roles->assign($user->id, $form->existRoles);
        $this->roles->assignRoles($user->id, $form->existRoles);
        $this->repository->save($user);
        // $this->roles->assign($user->id, $form->role);
        //      });
    }

    public function assignRole($id, $role): void
    {
        $user = $this->repository->get($id);
        $this->roles->assign($user->id, $role);
    }
    public function getRoles($id)
    {
        return $this->roles->getRoles($id);
    }

    public function remove($id): void
    {
        $user = $this->repository->get($id);
        $this->repository->remove($user);
    }

    private function compareInternalExternalApartmentsLists($internal,$external){
        $lostList = [];
        if (is_array($internal) && is_array($external)){
            foreach ($internal as $apartment){
                if (!$this->findInList($apartment->external_id, $external) ){
                    $lostList[]=$apartment;
                }
            }
        }
        return $lostList;
    }

    private function findInList($needle,$array){
        foreach ($array as $element){
            if (key_exists("id",$element)){
                if (  $needle == $element["id"])
                    return true;
            }
        }
        return false;
    }
    /**
     * Making synchronization data with MyRentReception for user
     * Get bookings list for $user, from $user->myrent_update
     * $owner_id is used for creating new apartment, if it has not built before
     * if $owner_id = null , then no link between apartment and owner will be done
     * Make editing every booking
     * @param User $user

     * @param integer $owner_id (if this user is onw of the Owner)
     */
    public function updateBookings(User $user, $owner_id=null)
    {
        $updateTime = time();
        if (($user->myrent_update == null) || ($updateTime - $user->myrent_update > MyRent::MyRent_UPDATE_INTERVAL)) {
            $rentList = MyRent::getBookingsUpdateForUser($user->external_id,  date("Y-m-dTH:i:s",$user->myrent_update));
            foreach ($rentList as $rentInfo) {
                $rent = new RentForm($rentInfo);
                $rent->load($rentInfo, '');
                try {
                    if ($rent->validate()) {
                        if ($rent->until_date > date("Y-m-dTH:i:s",$user->myrent_update))
                            $this->bookingService->updateBookings($rent, $user->id, $updateTime, $owner_id);
                    } else throw new \DomainException ('Failed to create the object => ' . json_encode($rent->getFirstErrors()));
                } catch (\DomainException $e) {
                    $this->errorHandler->logException($e);
                }
            }
            $user->setMyRentUpdateTime($updateTime);
            $this->repository->save($user);
        }
    }
}
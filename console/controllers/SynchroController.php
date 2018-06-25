<?php

namespace console\controllers;

use const PHP_EOL;
use reception\entities\Feefo\FeefoSales;
use reception\entities\User\User;
use reception\repositories\Booking\BookingRepository;
use reception\repositories\Feefo\FeefoSalesRepository;
use reception\repositories\Feefo\FeefoScheduleRepository;
use reception\repositories\MyRent\RentsRepository;
use reception\repositories\Objects\ObjectsReadRepository;

use reception\services\MyRent\MyRent;
use reception\useCases\manage\Booking\BookingManageService;
use reception\useCases\manage\Booking\SynchroService;
use reception\useCases\manage\Feefo\FeefoManageService;
use reception\useCases\manage\MyRent\MyRentManageService;
use Yii;
use yii\console\Controller;
use yii\helpers\ArrayHelper;

class SynchroController extends Controller
{
    private $booking;
    private $service;
    private $myRentService;
    private $synchroService;
    private $feefoScheduleRepository;
    private $objects;
    private $feefoService;
    private $feefoRentsRepository;
    private $rents;


    public function __construct($id, $module,
                                BookingManageService $service,
                                MyRentManageService $myRentService,
                                BookingRepository $booking,
                                SynchroService $synchroService,
                                FeefoScheduleRepository $feefoScheduleRepository,
                                ObjectsReadRepository $objects,
                                FeefoManageService $feefoService,
                                RentsRepository $rents,
                                FeefoSalesRepository $feefoRentsRepository,

                                $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->booking = $booking;
        $this->service = $service;
        $this->myRentService = $myRentService;
        $this->synchroService = $synchroService;
        $this->feefoScheduleRepository = $feefoScheduleRepository;
        $this->objects = $objects;
        $this->feefoService = $feefoService;
        $this->feefoRentsRepository = $feefoRentsRepository;
        $this->rents = $rents;
    }


    public function actionTest(): void
    {
        $data =1234;
        Yii::$app->redis->set('mykey', $data);
        echo Yii::$app->redis->get('mykey');
        echo PHP_EOL;
    }

    public function actionUser(): void
    {
            echo "Ya!";
            echo PHP_EOL;
    }
    
    public function actionUserUpdate () :void {
        $updateTime = time();
//        $users = User::find()->where(['id'=>[201,202,200,174,179,199,151,176,204,205]])->all();//
        $users = User::find()->where(['id'=>[174]])->all();//
//            ->andFilterWhere(['!=','external_id',null])->andFilterWhere(['status'=>User::STATUS_ACTIVE])
//            ->andFilterWhere(['<=','updated_at', $updateTime - MyRentReception::MyRent_USER_UPDATE_INTERVAL ])->all();
        foreach ($users as $user) {
//            if ($user->can('mobile', []) || $user->can('owner', []) || $user->can('receptionist', [])) {
                $apartments = $this->synchroService->synchroApartmentsForUser($user, $updateTime, null);
//                    ($user->can('owner', [])
//                    && !$user->can('mobile', [])) ? $user->owner->id : null);
                $rents = $this->synchroService->synchroRentsForUser($user, $updateTime, null);
//                    ($user->can('owner', [])
//                    && !$user->can('mobile', [])) ? $user->owner->id : null);
//            }
//            else $rents = $this->synchroService->synchroChangesRentsForUser($user, $lastUpdate, $updateTime, (Yii::$app->user->can('owner',[]))?$user->owner->external_id:null);
//
//            }

        }
    }

    public function actionRentsUpdate () :void {
        $updateTime = time();
        $users = User::find()->andFilterWhere(['!=','external_id',null])->andFilterWhere(['status'=>User::STATUS_ACTIVE])->andFilterWhere(['<=','myrent_update', $updateTime - MyRent::MyRent_UPDATE_INTERVAL ])->all();
        foreach ($users as $user) {

            $rents = $this->synchroService->synchroChangesRentsForUser($user, $user->myrent_update, $updateTime, (Yii::$app->user->can('owner', [])) ? $user->owner->external_id : null);
        }
    }

    public function actionFeefo ($date=null)  {
        $array=[];
        $feefoObjectsId = ArrayHelper::getColumn($this->feefoScheduleRepository->getObjectsIDs(($date)? strtotime($date):time()), 'object_id');
        $rents =  $this->rents->getCheckedInForObjectsOnDate(($date)?$date:date("Y-d-m",time()),$feefoObjectsId);
        foreach($rents as $rent) {
            if (!($feefoRents = $this->feefoRentsRepository->getByBookingID($rent->id)))
                    $array[]=$rent;
            }
        $result = $this->feefoService->addSales($array);
        echo "Make ".count($result)." FeefoSales records from ".count($array)." new checked in rents";
        echo PHP_EOL;
        return Yii::info("Make ".count($result)." FeefoSales records from ".count($array)." new checked in rents"); //запись в лог
    }

}
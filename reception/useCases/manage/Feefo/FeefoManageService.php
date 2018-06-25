<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 24.07.17
 * Time: 11:49
 */



namespace reception\useCases\manage\Feefo;


use backend\helpers\FeefoHelper;
use reception\entities\Feefo\FeefoProducts;
use reception\entities\MyRent\FeefoSchedule;
use reception\entities\Feefo\FeefoSales;
use reception\repositories\Feefo\FeefoProductsRepository;
use reception\repositories\Feefo\FeefoSalesRepository;
use function is_array;
use reception\forms\MyRent\FeefoSalesForm;
use reception\repositories\Feefo\FeefoScheduleRepository;
use reception\repositories\UserRepository;
use reception\services\Feefo\FeefoService;
use Yii;


class FeefoManageService
{
    private $scheduleRepository;
    private $userRepository;
    private $feefoSalesRepository;
    private $feefoProductsRepository;


    public function __construct(FeefoScheduleRepository $scheduleRepository,
                                UserRepository $userRepository,
                                FeefoSalesRepository $feefoSalesRepository,
                                FeefoProductsRepository $feefoProductsRepository
    )
    {
        $this->scheduleRepository = $scheduleRepository;
        $this->userRepository = $userRepository;
        $this->feefoSalesRepository = $feefoSalesRepository;
        $this->feefoProductsRepository = $feefoProductsRepository;

    }


    public function addSales ($bookingsList)
    {
        $array = [];$forFileArray=[];$log="not connected yet";
       foreach ($bookingsList as $rent) {
           $object = $rent->object;
           $params =[];
           $params['orderref']=$rent->id;
           $params['productsearchcode']= $object->id;
           $params['date'] = $rent->until_date;
           $params['name'] = $rent->contact_name;
           $params['email'] = $rent->contact_email;
           $params['description'] = count($object->objectsRealestates)?($object->objectsRealestates[0])->name:'';
           $params['tags']= 'country:'.(($rent->country)?$rent->country->country??'Croatia':'Croatia').',accommodationtype:'.(($object->objectType)?$object->objectType->name??'':'');
           $params['amount'] = '';
           $params['currency']='';
           $params['productattributes']='Cleanliness,Facilities,Location,Service,Value for Money,Destination';
           $params['feedbackdate']='';//date("Y-m-d", strtotime($rent->until_date)+24*60*60);
           $params['locale']='en';//($rent->country)?($rent->country->language)?$rent->country->language->code??'hr':'hr':'hr';
           $params['productlink']="https://www.vipholidaybooker.com/en/".$object->id;
           $params['merchantidentifier']=FeefoService::FEEFO_MERCHANT_ID;
           $forFileArray[]=$params;
           if (!($feefoSales = $this->feefoSalesRepository->getByBookingID($rent->id))) {
               $feefoSales = FeefoSales::create($rent->id, time(), $log, $params);
           }
           else {
               $feefoSales->edit($rent->id, time(), $log, $params);
           }
           ($feefoSales->log=="not connected yet"|| $feefoSales->log=="Not sent. Email is in stop list!") ? $feefoSales->log = FeefoService::enterSalesRemotely($params):$feefoSales->log; //если еще не посылали - то шлем, иначе просто сохраняем
           $this->feefoSalesRepository->save($feefoSales);
           $array[] = $feefoSales->rent_id;

       }
        $file = FeefoService::recordToExcel(Yii::getAlias("@backend")."/web/uploads/feefo/".date("Y-m-d",time())."_vipholiday_rents.csv",$forFileArray,
            [
                'Order Ref',
                'Product Search Code',
                'Date',
                'Name',
                'Email',
                'Description',
                'Tags',
                'Amount',
                'Currency',
                'Product Attributes',
                'Feedback Date',
                'Locale',
                'Product Link',
                'Merchant Identifier'
            ]);
       return $array;
    }

    public function addOneFeefoSale ($rent)
    {
        $array = [];
        $forFileArray=[];
        $log="not connected yet";
            $object = $rent->object;
            $params =[];
            $params['orderref']=$rent->id;
            $params['productsearchcode']= $object->id;
            $params['date'] = $rent->until_date;
            $params['name'] = $rent->contact_name;
            $params['email'] = $rent->contact_email;
            $params['description'] = count($object->objectsRealestates)?($object->objectsRealestates[0])->name:'';
            $params['tags']= 'country:'.(($rent->country)?$rent->country->country??'Croatia':'Croatia').',accommodationtype:'.(($object->objectType)?$object->objectType->name??'':'');
            $params['amount'] = '';
            $params['currency']='';
            $params['productattributes']='Cleanliness,Facilities,Location,Service,Value for Money,Destination';
            $params['feedbackdate']='';//date("Y-m-d", strtotime($rent->until_date)+24*60*60);
            $params['locale']='en';//($rent->country)?($rent->country->language)?$rent->country->language->code??'hr':'hr':'hr';
            $params['productlink']="https://www.vipholidaybooker.com/en/".$object->id;
            $params['merchantidentifier']=FeefoService::FEEFO_MERCHANT_ID;
            $forFileArray[]=$params;
            if (!($feefoSales = $this->feefoSalesRepository->getByBookingID($rent->id))) {
                $feefoSales = FeefoSales::create($rent->id, $rent->object_id, time(), $log, $params);
            }
            else {
                $feefoSales->edit($rent->id, time(), $log, $params);
            }
            ($feefoSales->log=="not connected yet" || $feefoSales->log=="Not sent. Email is in stop list!") ? $feefoSales->log = FeefoService::enterSalesRemotely($params):$feefoSales->log; //если еще не посылали - то шлем, иначе просто сохраняем
            $this->feefoSalesRepository->save($feefoSales);
            $array[] = $feefoSales->rent_id;

        $file = FeefoService::recordToExcel(Yii::getAlias("@backend")."/web/uploads/feefo/".date("Y-m-d",time())."_vipholiday_rent_".$rent->contact_name.".csv",$forFileArray,
            [
                'Order Ref',
                'Product Search Code',
                'Date',
                'Name',
                'Email',
                'Description',
                'Tags',
                'Amount',
                'Currency',
                'Product Attributes',
                'Feedback Date',
                'Locale',
                'Product Link',
                'Merchant Identifier'
            ]);
        return $array;
    }

    public function addProducts($objects)
    {
        $array = []; $forFileArray=[];
        foreach ($objects->query->each() as $object) {
                $params =[];
                $params['searchcode']= $object->id;
                $params['productdescription'] = ($object->objectsRealestates && is_array($object->objectsRealestates))?$object->objectsRealestates[0]->name:'';//FeefoHelper::getShortDesription($object); //strip_tags (($object->objectsRealestatesDescriptions && is_array($object->objectsRealestatesDescriptions))?$object->objectsRealestatesDescriptions[0]->short:'');
                $params['tags']= '';
                $params['title'] = ($object->objectsRealestates && is_array($object->objectsRealestates))?$object->objectsRealestates[0]->name:'';
                $params['url']="https://www.vipholidaybooker.com/en/".$object->id;
                $params['ratableattributes']='Cleanliness,Facilities,Location,Service,Value for Money,Destination';
                $params['imagelink']= "https://api.my-rent.net/objects/picture_main/".$object->id;//$object->pictures->name;
                $params['merchantidentifier'] = FeefoService::FEEFO_MERCHANT_ID;
                $forFileArray[]=$params;
                 if (!($feefoProducts=$this->feefoProductsRepository->getProductId($object->id))) {
                     $feefoProducts = FeefoProducts::create($object->id, time(), $params);
                 }
                else {
                    $feefoProducts->edit($object->id, time(), $params);
                }
                $this->feefoProductsRepository->save($feefoProducts);
                $array[] = $feefoProducts->object_id;
        }
        $file = FeefoService::recordProductsToCSV(Yii::getAlias("@backend")."/web/uploads/feefo/".date("Y-m-d",time())."_vipholiday_objects.csv", $forFileArray,
            [
                'Search Code',
                'Product Description',
                'Tags',
                'Title',
                'Url',
                'Ratable Attributes',
                'Image Link',
                'Merchant Identifier'
            ]);
        return $array;
    }

    public function addSchedule($keys, $from,$to)
    {
        $array=[];
        foreach ($keys as $key) {
            $schedule = $this->scheduleRepository->getByKey($key);
            if ($schedule) {
                $schedule->edit($key, strtotime($from), strtotime($to), time(), time());
            }
            else {
                $schedule = FeefoSchedule::create($key, strtotime($from), strtotime($to), time(), time());
            }
            $this->scheduleRepository->save($schedule);
            $array[]=$schedule;
        }
        return $array;
    }

    public function removeSchedule($keys)
    {   $i=0;
        foreach ($keys as $key) {
            $schedule = $this->scheduleRepository->getByKey($key);
            if ($schedule) {
                $this->scheduleRepository->remove($schedule);
                $i++;
            }
        }
        return $i;
    }

    public function editSales($id, FeefoSalesForm $form): void
    {
        $feefoSales = $this->feefoSalesRepository->get($id);

        $feefoSales->edit($form->id, $form->rent_id, $form->created, $form->log);

        $this->feefoSalesRepository->save($feefoSales);
    }

    public function removeSales($id): void
    {
        $feefoSales = $this->feefoSalesRepository->get($id);
        $this->feefoSalesRepository->remove($feefoSales);
    }


}
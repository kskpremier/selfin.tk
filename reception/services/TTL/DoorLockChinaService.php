<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 3/16/18
 * Time: 12:37 PM
 */

namespace reception\services\TTL;


use reception\entities\DoorLock\DoorLock;
use reception\entities\DoorLock\KeyboardPwd;
use reception\entities\User\User;
use reception\helpers\TTLHelper;
use reception\repositories\DoorLock\KeyboardPwdRepository;
use reception\useCases\manage\TTL\TTL;
use yii\web\ServerErrorHttpException;

class DoorLockChinaService
{

    /**
     * @var KeyboardPwdRepository
     */
    private $keyboardPwdRepository;

    /**
     * DoorLockChinaService constructor.
     * @param KeyboardPwdRepository $keyboardPwdRepository
     */
    public function __construct(KeyboardPwdRepository $keyboardPwdRepository )
    {
        $this->keyboardPwdRepository = $keyboardPwdRepository;

    }

    /**
     * Этот вызов будет дергать китайский api контроллер
     * При успешном получении ответа запишет данные в модель и сохранит ее, вернет json
     * @return string json like {"keyboardPwdId":501168,"keyboardPwd":"45866000","success":"true"}
     * */

    public function getKeyboardPwdFromChina(DoorLock $doorLock, KeyboardPwd $keyboarPwd)
    {
        // ghbdjlbv lfns r byntl;th
        $this->setDateToInteger ($keyboarPwd);

        $startDate = $this->getStartDateNormalize($doorLock, $keyboarPwd);
        $endDate = $this->getEndDateNormalize($doorLock, $keyboarPwd);

        $token = TTL::getToken((User::find()->where(['username'=>TTL::TTL_DOOR_LOCK_ADMIN_USERNAME])->one())->id);
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_HTTPHEADER, array('Content-type: application/x-www-form-urlencoded'));
        curl_setopt_array($ch, array(
            CURLOPT_URL => TTL::TTL_URL_TO_KEYBOARD_PWD_GET,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query([
                'clientId' =>  TTL::TTL_CLIENT_ID,
                'date'=> 1000*time(),
                'accessToken'=>$token->access_token,
                'startDate'=> $startDate,
                'endDate'=> $endDate,
                'keyboardPwdVersion'=>$keyboarPwd->keyboard_pwd_version,
                'lockId'=>$keyboarPwd->doorLock->lock_id,
                'keyboardPwdType'=>(int)($keyboarPwd->keyboard_pwd_type)
            ])
        ));
        $response = curl_exec ($ch) or die(curl_error($ch));
        curl_close ($ch);


        $data = json_decode($response,true);
        //в китайском ответе должно быть поле keyboardPwd
        if (is_array($data)){
            if (array_key_exists('keyboardPwd', $data)) {
                $keyboarPwd->value = $data['keyboardPwd'];
                $keyboarPwd->keyboard_pwd_id = $data['keyboardPwdId'];
                $keyboarPwd->start_date = $startDate/1000;
                $keyboarPwd->end_date = ($keyboarPwd->keyboard_pwd_type == TTLHelper::TTL_KEY_PERMANENT_TYPE)? 0: $endDate/1000;
                $data['success'] = true;
            }
            else if (array_key_exists('errcode', $data) ) {
                if ($data['errcode']!=0) $data['success'] = false;
            }
            return json_encode($data);
        }
        else throw new ServerErrorHttpException('Problems with request '. $response);
    }


    /**
     * Add Custom KeyboardPWD
     *
     * @param DoorLock $doorLock
     * @param KeyboardPwd $keyboardPwd
     * @param int $addType - TTLHelper::TTL_RECORD_VIA_BLUETOOTH or TTLHelper::TTL_RECORD_VIA_GATEWAY
     * @return string
     * @throws ServerErrorHttpException
     */
    public function addKeyboardPwd (DoorLock $doorLock, KeyboardPwd $keyboardPwd, $addType) {

        $this->setDateToInteger ($keyboardPwd);
        $startDate = $this->getStartDateNormalize($doorLock, $keyboardPwd);
        $endDate = $this->getEndDateNormalize($doorLock, $keyboardPwd);
        $token = TTL::getToken((User::find()->where(['username'=>TTL::TTL_DOOR_LOCK_ADMIN_USERNAME])->one())->id);
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_HTTPHEADER, array('Content-type: application/x-www-form-urlencoded'));
        curl_setopt_array($ch, array(
            CURLOPT_URL => TTL::TTL_URL_TO_ADD_PASSCODE,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query([
                'clientId' =>  TTL::TTL_CLIENT_ID,
                'date'=> 1000*time(),
                'accessToken'=>$token->access_token,
                'startDate'=> $startDate,
                'endDate'=> $endDate,
                'keyboardPwd'=>$keyboardPwd->value,
                'addType'=>($addType==TTLHelper::TTL_RECORD_VIA_GATEWAY)?TTLHelper::TTL_RECORD_VIA_GATEWAY:TTLHelper::TTL_RECORD_VIA_BLUETOOTH,
                'keyboardPwdVersion'=>$keyboardPwd->keyboard_pwd_version,
                'lockId'=>$keyboardPwd->doorLock->lock_id,
                'keyboardPwdType'=>(int)($keyboardPwd->keyboard_pwd_type)
            ])
        ));
        $response = curl_exec ($ch) or die(curl_error($ch));
        curl_close ($ch);


        $data = json_decode($response,true);
        //в китайском ответе должно быть поле keyboardPwd
        if (is_array($data)){
            if (array_key_exists('keyboardPwdId', $data)) {
                $keyboardPwd->keyboard_pwd_id = $data['keyboardPwdId'];
                $keyboardPwd->start_date = $startDate/1000;
                $keyboardPwd->end_date =  $endDate/1000;
                $data['success'] = true;
            }
            else  {
                $data['success'] = false;
            }
            return json_encode($data);
        }
        else throw new ServerErrorHttpException('Problems with request '. $response);

    }

    /**
     * @param DoorLock $doorLock
     * @param KeyboardPwd $keyboarPwd
     * @return float|int
     */
    private function getStartDateNormalize(DoorLock $doorLock, KeyboardPwd $keyboardPwd)
    {
        $start_date = 0;
        //определение времени на сервере
        $dateTimeZone = new \DateTimeZone(date_default_timezone_get());
        $date = new \DateTime(null, new \DateTimeZone(date_default_timezone_get()));
        $offset = $dateTimeZone->getOffset($date);

        $offsetByType = $this->getOffsetByDayaWeek($keyboardPwd->start_date, $keyboardPwd->keyboard_pwd_type);

        $start_date = ($keyboardPwd->start_date + $this->getSummerWinterDoorLockInit($doorLock, $keyboardPwd) + $offset - 3600) * 1000 + $offsetByType;  //вставил разницу в 1 час - проверяю

        $start_date = $this->getIntOurs($start_date, $keyboardPwd);

        return $start_date;
    }

    /**
     * @param DoorLock $doorLock
     * @param KeyboardPwd $keyboarPwd
     * @return float|int
     */
    private function getEndDateNormalize(DoorLock $doorLock, KeyboardPwd $keyboarPwd)
    {
        $end_date = 0;
        //определение времени на сервере
        $dateTimeZone = new \DateTimeZone(date_default_timezone_get());
        $date = new \DateTime(null, new \DateTimeZone(date_default_timezone_get()));
        $offset = $dateTimeZone->getOffset($date);
        if ($keyboarPwd->keyboard_pwd_type >= TTLHelper::TTL_KEYBOARD_MONDAY_REPEAT &&
            $keyboarPwd->keyboard_pwd_type <= TTLHelper::TTL_KEYBOARD_SUNDAY_REPEAT) {
            $keyboarPwd->end_date = $keyboarPwd->start_date;
        }
        else {
            if ($keyboarPwd->end_date != 0 || $keyboarPwd->end_date != "") {
                $end_date = ($keyboarPwd->end_date + $this->getSummerWinterDoorLockInit($doorLock, $keyboarPwd) + $offset) * 1000;
                $end_date = $this->getIntOurs($end_date, $keyboarPwd);
            }
        }
        return $end_date;
    }

    private function setDateToInteger (KeyboardPwd $keyboardPwd)
    {
        if (gettype($keyboardPwd->start_date) != 'integer') {
            $keyboardPwd->start_date = strtotime($keyboardPwd->start_date);
        }
        if (gettype($keyboardPwd->end_date) != 'integer') {
            $keyboardPwd->end_date = strtotime($keyboardPwd->end_date);
        }
    }
    /**
     * Calculate and set time to Chines requrements - int hour etc...
     * @param int $millis
     * @param KeyboardPwd $keyboarPwd
     * @return float|int
     */
    private function getIntOurs(int $millis, KeyboardPwd $keyboarPwd) {
        //берем целую часть в часах
        $timeFromRequestNormilized= ((int)($millis/1000/60/60))*1000*60*60;
        $nowNormilized = ((int)(time()/60/60))*1000*60*60;

        if ($keyboarPwd->keyboard_pwd_type == TTLHelper::TTL_KEYBOARD_ONETIME_TYPE)
            return (($timeFromRequestNormilized - $nowNormilized) > 6*60*60*1000) ? $timeFromRequestNormilized : $nowNormilized + 6*60*60*1000;
        else
        return $timeFromRequestNormilized;


    }
    private function getOffsetByDayaWeek ($date, $type):int {
        switch ($type){
            case TTLHelper::TTL_KEYBOARD_MONDAY_REPEAT :   //Monday = 1
                $diff = getDiffOfWeek($date, 1);
                break;
            case TTLHelper:: TTL_KEYBOARD_TUESDAY_REPEAT:
                $diff = getDiffOfWeek($date, 2);
                break;
            case TTLHelper:: TTL_KEYBOARD_WEDNESDAY_REPEAT:
                $diff = getDiffOfWeek($date, 3);
                break;
            case TTLHelper:: TTL_KEYBOARD_THURSDAY_REPEAT:
                $diff = getDiffOfWeek($date, 4);
                break;
            case TTLHelper:: TTL_KEYBOARD_FRIDAY_REPEAT:
                $diff = getDiffOfWeek($date, 5);
                break;
            case TTLHelper:: TTL_KEYBOARD_SATURDAY_REPEAT:
                $diff = getDiffOfWeek($date, 6);
                break;
            case TTLHelper:: TTL_KEYBOARD_SUNDAY_REPEAT: //Sunday = 0
                $diff = getDiffOfWeek($date, 0);
                break;
            default:
                $diff = 0;
                break;
        }
        return $diff * 24 * 60 * 60 * 1000 ; // количество дней в милисекунды
    }

    private function getDiffOfWeek($date, $day) {
       $diff = abs( date('w',$date) - $day);

       return $diff*24*60*60;
    }

    /**
        Исправляем китайский косяк - определяем сколько секунд надо добавить к дате начала или окончания действия замка,
     * в зависимости от того в какое время был инициализирован замок и генерируется ключ
     * Пока по умолчанию считаем, что время берется в европейской тайм зоне с переходом на летнее/зимнее
     */
    private function getSummerWinterDoorLockInit(DoorLock $doorlock , KeyboardPwd $keyboarPwd)
    {
        $doorLockInitTime = $doorlock->date/1000;
        $doorLockTimeZone = 'Europe/Zurich'; /** TODO разобраться с временной зоной замка */ //$keyboarPwd->doorLock->timeZone;
        $currentTime = time();
        if (date('I', $doorLockInitTime) && date('I', $currentTime)) {
            //оба времени летние или зимние
            return 0;
        } elseif (date('I', $doorLockInitTime)) //замок летом, ключ зимой => надо вычитать час ??
        {
            return -1 * $this->getWinterSummerTimeDifference($doorLockTimeZone,$currentTime);
        }
        return 1 * $this->getWinterSummerTimeDifference($doorLockTimeZone,$currentTime);
    }
    /** Возвращает разницу в секундах (!)в летнем и зимнем времени в зависимости от TimeZone и времени
     */
    private function getWinterSummerTimeDifference($timezone, $time){
        return 3600;
    }

}
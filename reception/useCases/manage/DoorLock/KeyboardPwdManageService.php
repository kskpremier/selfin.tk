<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 13.07.17
 * Time: 8:36
 */


namespace reception\useCases\manage\DoorLock;

use reception\entities\DoorLock\KeyboardPwd;
use reception\useCases\manage\TTL\TTL;
use reception\forms\KeyboardPwdForm;
use reception\repositories\DoorLock\KeyboardPwdRepository;
use yii\httpclient\Client;
use reception\entities\User\User;
use yii\web\ServerErrorHttpException;


class KeyboardPwdManageService
{
    private $KeyboardPwdRepository;

    public function __construct(KeyboardPwdRepository $KeyboardPwdRepository)
    {
        $this->KeyboardPwdRepository = $KeyboardPwdRepository;

    }

    public function generate(KeyboardPwdForm $form): KeyboardPwd
    {
        $KeyboardPwd = KeyboardPwd::create(
            strtotime($form->startDate),
            strtotime($form->endDate),
            $form->type,
            $form->keyboardPwdVersion,
            $form->bookingId,
            $form->doorLockId
        );

        $this->KeyboardPwdRepository->save($KeyboardPwd);
        return $KeyboardPwd;
    }

    public function edit(KeyboardPwdEditForm $form): void
    {
        $KeyboardPwd = KeyboardPwd::edit(
            strtotime($form->startDate),
            strtotime($form->endDate),
            $form->type,
            $form->bookingId,
            $form->doorLockId,
            $form->userId,
            $form->remarks,
            $form->value,
            $form->keyboardPwdId

        );
        $this->KeyboardPwdRepository->save($KeyboardPwd);
    }

    public function getKeyboardPwdLocal()
    {
        //тут надо сформировать запрос и послать
        $client = $client = new Client([
            //  'baseUrl' => DOMOUPRAV::DOMOUPRAV_URL_TO_KEYBOARD_PWD_GET,
        ]);
        $response = $client->createRequest()
            ->setMethod('post')
            ->setHeaders(['content-type' => 'application/x-www-form-urlencoded'])
            ->addHeaders(['Authorization' => 'Bearer ' . DOMOUPRAV:: DOMOUPRAV_ADMIN_TOKEN])
            ->setUrl(DOMOUPRAV::DOMOUPRAV_URL_TO_KEYBOARD_PWD_GET)
            ->setData([
                'door_lock_id' => $this->door_lock_id,
                'booking_id' => $this->booking_id,
                'keyboard_pwd_version' => $this->keyboard_pwd_version,
                'keyboard_pwd_type' => $this->keyboard_pwd_type,
                'start_date' => $this->start_date,
                'end_date' => ($this->keyboard_pwd_type == 2) ? 0 : $this->end_date,
                'accessToken' => DOMOUPRAV:: DOMOUPRAV_ADMIN_TOKEN
            ])
            ->send();
        if ($response->isOk) {
//            $this->value = $response->data['value']; //пока непонятно какой ответ возвращает сервер
//            $this->keyboard_pwd_id = $response->data['keyboard_pwd_id']; //пока непонятно какой ответ возвращает сервер
            return $response->data['id'];
        } else return false;
    }
    /**
     * Этот вызов будет дергать китайский api контроллер
     * При успешном получении ответа запишет данные в модель и сохранит ее, вернет json
     * @return string json like {"keyboardPwdId":501168,"keyboardPwd":"45866000","success":"true"}
     * */

    public function getKeyboardPwdValueFromChina($keyboardPwd) : array
    {
        $client = $client = new Client([
            'baseUrl' => TTL::TTL_URL_TO_KEYBOARD_PWD_GET,
            'responseConfig' => [
                'format' => Client::FORMAT_JSON
            ],
        ]);
        $accessToken = TTL::getToken(User::findOne(['username'=>TTL::TTL_DOOR_LOCK_ADMIN_USERNAME])->id);
        $response = $client->createRequest()
            ->setMethod('post')
            ->setData([
                'clientId'=>TTL::TTL_CLIENT_ID,
                'date'=> 1000 * time(),
                'accessToken'=>$accessToken->access_token,
                'startDate'=> $keyboardPwd->start_date*1000,
                'endDate'=> ($keyboardPwd->keyboard_pwd_type == 2)?  0 : $keyboardPwd->end_date*1000,//китайцы добавляют милисекунды
                'keyboardPwdVersion'=>$keyboardPwd->keyboard_pwd_version,
                'lockId'=>$keyboardPwd->doorLock->lock_id,
                'keyboardPwdType'=>$keyboardPwd->keyboard_pwd_type
            ])
            ->send();
        $data = $response->data;
        //в китайском ответе должно быть поле keyboardPwd
        if (is_array($data)) {
            if (array_key_exists('keyboardPwd', $data)) {
                return $data;
            } else if (array_key_exists('errcode', $data)) {
                throw new ServerErrorHttpException('Response from TTL consider error :  code ' . $data['errcode']);
            }
        }
        else throw new ServerErrorHttpException('Problems with request '. $response);
    }
}
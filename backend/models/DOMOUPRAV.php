<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 11.05.17
 * Time: 1:47
 */

namespace backend\models;


class DOMOUPRAV
{
 public const DOMOUPRAV_TOKEN = "bsAo_jbsPUPCpibo3mxx3m-sFYzjIGsI";
 public const DOMOUPRAV_ADMIN_TOKEN = "cWADri54WVNIs_ammPUDmwQSuuhDTw6-";
 public const DOMOUPRAV_RECIEVE_USERNAME = "doorlockadmin@domouprav.hr";

    public const DOMOUPRAV_BASE_API_URL = 'http://api.domouprav.local';
    public const DOMOUPRAV_URL_TO_KEY_SEND = '/sendKey';
    public const DOMOUPRAB_ABSOLUTE_URL_TO_SEND_EKEY = 'http://api.domouprav.local/e-key';
    public const DOMOUPRAB_ABSOLUTE_URL_TO_CREATE_BOOKING = 'http://api.domouprav.local/booking';
    public const DOMOUPRAV_URL_TO_KEYBOARD_PWD_GET = 'http://api.domouprav.local/password';
    public const DOMOUPRAV_URL_TO_PHOTO_IMAGE_ADD = '/photoimage';

}
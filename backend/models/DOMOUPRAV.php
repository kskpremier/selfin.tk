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
 public const DOMOUPRAV_TOKEN = "d60fca2b2a2f9445bfc7860fa458a32ec28f1c05";
 public const DOMOUPRAV_ADMIN_TOKEN = "e48e0bd5a3322f0d2aa815a16794be72274272a7";
 public const DOMOUPRAV_RECIEVE_USERNAME = "doorlockadmin@domouprav.hr";

    public const DOMOUPRAV_BASE_API_URL = 'http://restapi.domouprav.local';
    public const DOMOUPRAV_URL_TO_KEY_SEND = '/sendKey';
    public const DOMOUPRAB_ABSOLUTE_URL_TO_SEND_EKEY = 'http://restapi.domouprav.local/e-key';
    public const DOMOUPRAB_ABSOLUTE_URL_TO_CREATE_BOOKING = 'http://restapi.domouprav.local/booking';
    public const DOMOUPRAV_URL_TO_KEYBOARD_PWD_GET = 'http://restapi.domouprav.local/password';
    public const DOMOUPRAV_URL_TO_PHOTO_IMAGE_ADD = '/photoimage';

}
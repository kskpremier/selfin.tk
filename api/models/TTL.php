<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 11.05.17
 * Time: 1:06
 */

namespace api\models;


class TTL
{
    //пока захардкорил клиентский идентификатор и полученный токен
 public const TTL_CLIENT_ID ="7946f0d923934a61baefb3303de4d132";
 public const TTL_TOKEN = "7c714894bea74accb1b98d028dbc8dd5";
 public const TTL_LOCKID = "50088";
 public const TTL_OPEN_ID = "1200586764";

 public const TTL_URL_TO_KEY_SEND = 'https://api.sciener.cn/v3/key/send';
 public const TTL_URL_TO_KEYBOARD_PWD_GET = 'https://api.sciener.cn/v3/keyboardPwd/get';
    public const TTL_URL_TO_REFRESH_TOKEN = 'https://api.sciener.cn/v3/oauth2/token';
    public const TTL_URL_TO_INIT_DOOR_LOCK = 'https://api.sciener.cn/v3/lock/init';
}
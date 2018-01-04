<?php

namespace reception\services\newsletter;

interface Newsletter
{
    public function subscribe($email): void;
    public function unsubscribe($email): void;
//    public function notifyError($mail):void;
}
<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 16.06.17
 * Time: 10:55
 */

namespace api\helpers;

class KeyboardPwdHelper {
    public static function type($type) {
        switch ($type) {
            case 1: return "Single";
            case 5: return "Cycle";
            case 3: return "Period";
            case 2: return "Permanent";
            default: return "Unknown";
        }


    }
}
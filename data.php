<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 24.05.17
 * Time: 17:12
 */

echo time();
echo PHP_EOL;
echo date('y-m-d H:i:s');
echo PHP_EOL;

echo PHP_EOL;
echo strtotime("‎2017-07-31");
echo PHP_EOL;
echo strtotime("‎2017-08-12");
echo PHP_EOL;
echo time()+60*60*24;
echo PHP_EOL;
echo time()+60*60*24*4;
echo PHP_EOL;
echo password_hash("myrent123",1,['cost'=>13]);
echo PHP_EOL;
echo time();
echo PHP_EOL;

echo PHP_EOL;

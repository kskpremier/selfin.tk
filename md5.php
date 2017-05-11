<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 10.05.17
 * Time: 22:08
 */

echo md5("rona123");
echo PHP_EOL;
echo date('v');
echo PHP_EOL;
echo microtime();
echo PHP_EOL;
list($usec, $sec) = explode(" ", microtime());
echo ((float)$usec + (float)$sec);
echo PHP_EOL;
echo PHP_EOL;
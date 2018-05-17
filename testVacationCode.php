<?php
/* GLOBAL CONSTANTS please use your own credentials */
define('_username','ORGON'); define('_password','OR#GON45');
define('_partner_id','2565');
$result=sendXML('/Users/superbrodyaga/Desktop/test_from_site.xml');
var_dump($result);
/* Simple SENDXML function */
function sendXML($file)
{
    if (!file_exists($file)) return "$file not found";
    $cfile = curl_file_create($file,'text/xml','PRODUCTS_PARTNER_ID_'._partner_id.'.XML');
    $payload = array('XML' => $cfile);
    $url='http://api.vacationkey.com/2.0.1/'._partner_id."/sendXMLProducts";
    $process = curl_init();

    curl_setopt($process,CURLOPT_URL,$url);
    curl_setopt($process,CURLOPT_HTTPHEADER, array( 'Content-Type: multipart/form-data'));
    curl_setopt($process,CURLOPT_USERAGENT,'VACATIONKEY, PARTNER_ID:'. _partner_id);
    curl_setopt($process,CURLOPT_HEADER, 0);
    curl_setopt($process,CURLOPT_SAFE_UPLOAD, 1);
    curl_setopt($process,CURLOPT_USERPWD, _username . ":" . _password);
    curl_setopt($process,CURLOPT_TIMEOUT, 30);
    curl_setopt($process,CURLOPT_POST, 1);
    curl_setopt($process,CURLOPT_POSTFIELDS, $payload);
    curl_setopt($process,CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($process, CURLOPT_VERBOSE, FALSE);

    $return = curl_exec($process);
$info = curl_getinfo($process);
curl_close($process);
return $return;
}
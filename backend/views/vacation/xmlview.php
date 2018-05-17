


<?php

header("Content-type: text/xml; charset=utf-8");
foreach($xmlValues as $key => $value){
    echo '<setting id="'.$key.'">'.$value.'</settting>';
}

//echo $xml->asXML();
//$file = fopen($filename, "r");
//$content = "";
//while($f = fgets($file,4096))
//{
//    $content .= $f;
//}
//echo $content

?>


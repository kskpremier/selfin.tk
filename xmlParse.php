<?php

/**
 * This example demonstrates recursively iterating over an XML file
 * to any particular path.
 */

include "text_xml.php";

try {

    $document = new DOMDocument();
    $document->loadXml($xmlstring);

    parse ($document->firstChild);

    } catch (Exception $e) {
    die($e->getMessage());
}


function parse($DOMnode){

    if ($DOMnode->hasChildNodes()) {
        if (hasTagsInside($DOMnode)) {
            echo 'xml.WriteStartElement("'.$DOMnode->tagName.'");'. PHP_EOL;
        }
        else {
            if (get_class($DOMnode->firstChild) == DOMCdataSection::class) {
                echo 'xml.WriteStartElement("'.$DOMnode->nodeName .'");'. PHP_EOL;
                echo '  '.'xml.WriteCData("' . $DOMnode->firstChild->nodeValue . '");'. PHP_EOL;
                echo 'xml.WriteEndElement();'. PHP_EOL;
            }
            elseif (get_class($DOMnode->firstChild) == DOMText::class) {
                echo 'xml.WriteElementString("' . $DOMnode->nodeName . '","' . $DOMnode->firstChild->nodeValue . '");' . PHP_EOL;
            }
            //надо проверить наличие "младших братьев этого элемента
            if ($DOMnode->nextSibling->firstChild==null)
                echo "";
//                echo 'xml.WriteEndElement();'. PHP_EOL;
        }
        parse($DOMnode->firstChild);
    }
    if ($DOMnode->nextSibling != null) {
        parse($DOMnode->nextSibling);
    }
}

function hasTagsInside($node)
{
    $nodelist = $node->childNodes; // Получаем объект NodeList, содержащий список дочерних узлов у root
    for ($i = 0; $i < $nodelist->length; $i++) {
        $child = $nodelist->item($i); // Получаем i-й узел
        if (get_class($child) == DOMElement::class)
            return true;
    }
}
//function recorsiveByDOM(DOMDocument $document){
//    foreach ($document->documentElement->childNodes as $childNode) {
//        var_dump(get_class($childNode));
//        echo PHP_EOL;
//    }
//}

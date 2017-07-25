<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 23.05.17
 * Time: 15:07
 */
//namespace api\models\test;

// Подключаем класс-контейнер содержимого файла
include "oFile.php";
//use api\models\test\BodyPost;
//use api\models\test\oFile;
// Подключаем класс для формирования тела POST запроса
include "BodyPost.php";


// Генерируем уникальную строку для разделения частей POST запроса
$delimiter = '-------------'.uniqid();

// Формируем объект oFile содержащий файл
$file = new oFile('sample.txt', 'text/plain', 'Content file');

// Формируем тело POST запроса
$post = BodyPost::Get(array('field'=>'text', 'file'=>$file), $delimiter);

// Инициализируем  CURL
$ch = curl_init();

// Указываем на какой ресурс передаем файл
curl_setopt($ch, CURLOPT_URL, 'http://server/upload/');
// Указываем, что будет осуществляться POST запрос
curl_setopt($ch, CURLOPT_POST, 1);
// Передаем тело POST запроса
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

/* Указываем дополнительные данные для заголовка:
     Content-Type - тип содержимого,
     boundary - разделитель и
     Content-Length - длина тела сообщения */
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data; boundary=' . $delimiter,
    'Content-Length: ' . strlen($post)));
echo $post.PHP_EOL;
echo strlen($post).PHP_EOL;
// Отправляем POST запрос на удаленный Web сервер
echo curl_exec($ch);


<?php
// Запись из БД в файл data.json
error_reporting(-1);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
// Подключение к базе
$server = 'localhost';
$user = 'root';
$password = '';
$dblink = mysqli_connect($server, $user, $password);
require_once("PHPDebug.php");
$debug = new PHPDebug();

if($dblink)
    $debug -> debug("Соединение установлено");
else
    $debug -> debug("Ошибка подключения к серверу баз данных");

$database = 'mysql';
$selected = mysqli_select_db($dblink, $database);
if($selected)
    $debug -> debug("Подключение к базе данных прошло успешно");
else
    $debug -> debug("База данных не найдена или отсутствует доступ");

$ch = mysqli_query($dblink, "SELECT * FROM `hydrant`") or die(mysql_error());
$list = array();
while ($list = mysqli_fetch_assoc($ch)){
    $id = json_decode($list['id']);
    $address = $list['address'];
    $address = "Адрес: $address";
    $type = $list['type'];
    $type = "<b>Тип гидранта:</b> $type<br>";
    $lastCheck = $list['lastCheck'];
    $lastCheck = "<b>Дата последней проверки:</b> $lastCheck<br>";
    $power = $list['power'];
    $power = "<b>Мощность гидранта:</b> $power<br>";
    $status = $list['status'];
    $status = "<b>Статус гидранта:</b> $status<br>";
    $photo = $list['photo'];
    $photo = "<img src=\"images/$photo\" width=\"150\" height=\"200\"><br>";
    $notation = $list['notation'];
    $notation = "<b>Примечание:</b>$notation";
    $longitude = json_decode($list['longitude']);
    $latitude = json_decode($list['latitude']);
    $type1 = "Feature";
    $type2 = "Point";

    $point = array($longitude, $latitude);
    $balloonContentBody = array($type, $lastCheck, $power, $status, $photo, $notation);
    $properties = array('balloonContentHeader' => $address, 'balloonContentBody'=> $balloonContentBody);
    $geometry = array('type' => $type2, 'coordinates' => $point);
    $taskList[] = array('type' => $type1, 'id' => $id, 'geometry' => $geometry, 'properties' => $properties);

    $data = json_encode($taskList, JSON_UNESCAPED_UNICODE);
    file_put_contents('data.json',"{\n\"type\": \"FeatureCollection\",\n \"features\":\n $data }");
}
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
    $type = $list['type'];
    $lastCheck = $list['lastCheck'];
    $power = $list['power'];
    $status = $list['status'];
    $photo = $list['photo'];
    $notation = $list['notation'];
    $longitude = json_decode($list['longitude']);
    $latitude = json_decode($list['latitude']);
    $point = array($longitude, $latitude);
    $type1 = "Feature";
    $type2 = "Point";
    $balloonContentBody = array($type, $lastCheck, $power, $status, $photo, $notation);
    $properties = array('balloonContentHeader' => $address, 'balloonContentBody'=> $balloonContentBody);
    $geometry = array('type' => $type2, 'coordinates' => $point);
    $taskList[] = array('type' => $type1, 'id' => $id, 'geometry' => $geometry, 'properties' => $properties);
    $data = json_encode($taskList, JSON_UNESCAPED_UNICODE);
    file_put_contents('data.json',"{\n\"type\": \"FeatureCollection\",\n \"features\":\n $data }");
}
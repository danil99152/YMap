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

$ch = mysqli_query($dblink, "SELECT * FROM `objects`") or die(mysql_error());
$list = array();
while ($list = mysqli_fetch_assoc($ch)){
    $id = json_decode($list['id']);
    $name = $list['name'];
    $longitude = json_decode($list['longitude']);
    $latitude = json_decode($list['latitude']);
    $point = array($longitude, $latitude);
    $type1 = "Feature";
    $type2 = "Point";
    $properties = array('balloonContentHeader'=> $name);
    $geometry = array('type' => $type2, 'coordinates' => $point);
    $taskList[] = array('type' => $type1, 'id' => $id, 'geometry' => $geometry, 'properties' => $properties);
    $data = json_encode($taskList, JSON_UNESCAPED_UNICODE);
    file_put_contents('data.json',"{\n\"type\": \"FeatureCollection\",\n \"features\":\n $data }");
}
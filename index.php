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
    $id = $list['id'];
    $name = $list['name'];
    $point = $list['point'];

    $taskList[] = array('id' => $id, 'name' => $name, 'point' => $point);
    file_put_contents('data.json', json_encode($taskList, JSON_UNESCAPED_UNICODE));
}
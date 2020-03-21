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

if($dblink)
    echo 'Соединение установлено.';
else
    die('Ошибка подключения к серверу баз данных.');

$database = 'mysql';
$selected = mysqli_select_db($dblink, $database);
if($selected)
    echo ' Подключение к базе данных прошло успешно.<br>';
else
    die(' База данных не найдена или отсутствует доступ.');

$ch = mysqli_query($dblink, "SELECT * FROM `objects`") or die(mysql_error());
$list = array();
while ($list = mysqli_fetch_assoc($ch)){
    echo 'id-'.$list['id'].'>Улица-'.$list['name'].'Координаты-'.$list['point'].'<br>';
}
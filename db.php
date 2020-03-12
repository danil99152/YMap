<?php
// Запись из БД в файл data.json
error_reporting(-1);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
// Подключение к базе
$server = 'localhost';
$port = '5432';
$dbname = 'postgres';
$user = 'postgres';
$password = '1234';
$dblink = pg_connect("$server, $port, $dbname, $user, $password");

if($dblink)
    echo 'Соединение установлено.';
else
    die('Ошибка подключения к серверу баз данных.');

$ch = pg_query($dblink, "SELECT * FROM `hydrant`") or die(pg_last_error());
$list = array();
while ($list = pg_fetch_row($ch)){
    //запись в data.json
}
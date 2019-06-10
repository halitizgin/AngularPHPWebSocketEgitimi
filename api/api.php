<?php
$db = new PDO("mysql:host=localhost;dbname=angular-php;charset=utf8", "root", "");
require_once("functions.php");
error_reporting(1);
ini_set("display_errors", 1);
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "GET")
{
    get_select();
}
else if ($method == "POST")
{
    $get_data['name'] = $_POST['name'];
    $get_data['sort'] = $_POST['sort'];
    $get_data['year'] = $_POST['year'];
    $get_data['imdb'] = $_POST['imdb'];
    get_insert($get_data);
}
else if ($method == "DELETE")
{
    parse_str(file_get_contents("php://input"), $DELETE);
    $get_data = $DELETE['id'];
    get_delete($get_data);
}
else if ($method == "PUT")
{
    parse_str(file_get_contents("php://input"), $PUT);
    $get_data['id'] = $PUT['id'];
    $get_data['name'] = $PUT['name'];
    $get_data['sort'] = $PUT['sort'];
    $get_data['year'] = $PUT['year'];
    $get_data['imdb'] = $PUT['imdb'];
    get_update($get_data);
}
else
{
    echo "Hatalı istek metodu!";
}
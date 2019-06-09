<?php
$db = new PDO("mysql:host=localhost;dbname=angular-php;charset=utf8", "root", "");
require_once("functions.php");
error_reporting(1);
ini_set("display_errors", 1);
$get_type = $_POST['type'];
if ($get_type == "select")
{
    get_select();
}
else if ($get_type == "insert")
{
    $get_data['name'] = $_POST['name'];
    $get_data['sort'] = $_POST['sort'];
    $get_data['year'] = $_POST['year'];
    $get_data['imdb'] = $_POST['imdb'];
    get_insert($get_data);
}
else if ($get_type == "delete")
{
    $get_data = $_POST['id'];
    get_delete($get_data);
}
else if ($get_type == "update")
{
    $get_data['id'] = $_POST['id'];
    $get_data['name'] = $_POST['name'];
    $get_data['sort'] = $_POST['sort'];
    $get_data['year'] = $_POST['year'];
    $get_data['imdb'] = $_POST['imdb'];
    get_update($get_data);
}
else
{
    echo "Hatalı type parametresi";
}
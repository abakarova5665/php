<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



include_once '../src/database.php';
include_once '../models/user.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);



if (
    !empty($_POST['username']) &&
    !empty($_POST['id']) &&
    !empty($_POST['city_id']) &&
    !empty($_POST['name']) 
) {
    $user->id = $_POST['id'];
    $user->name = $_POST['name'];
    $user->username = $_POST['username'];
    $user->city_id = $_POST['city_id'];

    if ($user->update()) {

        http_response_code(201);
        echo json_encode(array("message" => "Пользователь был обновлен."));
    } else {
        http_response_code(503);

        echo json_encode(["message" => "Невозможно обновить пользователя."]);
    }
}
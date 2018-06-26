<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use helpers\Validator;
use models\Concert;
$address = $_POST['address'];
$city = $_POST['city'];
$date = $_POST['date'];
$spots = $_POST['spots'];
$title = $_POST['title'];

$is_address_valid = Validator::exists($address);
$is_city_valid = Validator::exists($city);
$is_date_valid = Validator::exists($date);
$is_title_valid = Validator::exists($title);

session_start();
if (!isset($_SESSION['current_user_id'])) {
    $error = new Error("Only authorized users can create new project.", 401);
    echo json_encode($error);
}
if (!$is_address_valid || !$is_city_valid || !$is_date_valid || !$is_title_valid) {
    header('Location: ../views/Host.php?address=' . json_encode($is_address_valid) . '&city=' . json_encode($is_city_valid) . '&date=' . json_encode($is_date_valid) . '&title=' . json_encode($is_title_valid));
} else {
    $current_user = $_SESSION['current_user_id'];
    $concert = Concert::create($address, $city, $date, $current_user, $title, $spots);

    try {
        $concert->insert();
        header('Location: ./GetConcert.php?id='.$concert->getId());
    } catch (Exception $ex) {
        http_response_code(500);
        header('Location: ../views/Error.php?message=Server error.&status_code=500');
    }
}

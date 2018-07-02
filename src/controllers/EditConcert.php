<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use helpers\Validator;
use models\Concert;

session_start();

if(!isset($_SESSION['current_user_id'])) {
    http_response_code(401);
} else {
    $current_user = $_SESSION['current_user_id'];
    $id = $_GET['id'];
    
    $address = $_POST['address'];
    $city = $_POST['city'];
    $date = $_POST['date'];
    $spots = $_POST['spots'];
    $title = $_POST['title'];

    $is_address_valid = Validator::exists($address);
    $is_city_valid = Validator::exists($city);
    $is_date_valid = Validator::exists($date);
    $is_title_valid = Validator::exists($title);
    
if (!$is_address_valid || !$is_city_valid || !$is_date_valid || !$is_title_valid) {
    header('Location: ../views/EditConcert.php?address=' . json_encode($is_address_valid) . '&city=' . json_encode($is_city_valid) . '&date=' . json_encode($is_date_valid) . '&title=' . json_encode($is_title_valid));
} else {
        $concert = Concert::getById($id);

        if($concert->getHostId() === $current_user)
        {
          $isSuccessful = Concert::edit($id, $address, $city, $date, $title, $spots);
          if ($isSuccessful) {
            header('Location: ./GetConcert.php?id='.$id);
          }  
        } else {
          http_response_code(401);
        }
    }
}
?> 
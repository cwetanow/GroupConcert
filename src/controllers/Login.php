<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use helpers\Validator;
use models\User;

$username = $_POST['username'];
$password = $_POST['password'];

$is_username_valid = Validator::exists($username);
$is_password_valid = Validator::exists($password);

if (!$is_username_valid || !$is_password_valid) {
    header('Location: ../views/Login.php?username=' . json_encode($is_username_valid) . '&password=' . json_encode($is_password_valid));
} else {
    $user = User::getUser($username, $password);
    if($user->getUsername() && $user->getId())
    {
    	session_start();
    	$_SESSION['current_user_username'] = $user->getUsername();
    	$_SESSION['current_user_id'] = $user->getId();

    	header('Location: ../views/GetAllConcerts.php');
    }
    else
    {
    	http_response_code(404);
    }
}
?> 
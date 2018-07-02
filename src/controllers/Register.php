<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use helpers\Validator;
use models\User;

$username        = $_POST['username'];
$password        = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];
$email           = $_POST['email'];
$full_name       = $_POST['fullName'];

$is_username_valid        = Validator::exists($username);
$is_password_valid        = Validator::exists($password);
$is_confirmPassword_valid = Validator::exists($confirmPassword) && Validator::arePasswordsEqual($password, $confirmPassword);
$is_email_valid           = Validator::exists($email) && Validator::isValidEmail($email);
$is_full_name_valid       = Validator::exists($full_name);

$user = User::getUserByUsername($username);
if ($user->getId()) {
    $is_username_valid = false;
}

if (!$is_username_valid || !$is_password_valid || !$is_confirmPassword_valid || !$is_email_valid || !$is_full_name_valid) {
    header('Location: ../views/Register.php?username=' . json_encode($is_username_valid) . '&password=' . json_encode($is_password_valid) . '&confirmPassword=' . json_encode($is_confirmPassword_valid) . '&email=' . json_encode($is_email_valid) . '&full_name=' . json_encode($is_full_name_valid));
} else {
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $user         = User::create($username, $password_hash, $email, $full_name);
    $isSuccessful = $user->insert();
    
    if ($isSuccessful) {
        header('Location: ../views/Login.php');
    } else {
        echo "<p> Error! The subject was not inserted! </p>";
    }
}
?> 
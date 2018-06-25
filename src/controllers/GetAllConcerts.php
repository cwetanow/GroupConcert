<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use models\Concert;
use models\User;

session_start();

if(!isset($_SESSION['current_user_id'])) {
    http_response_code(401);
 	// header('Location: ../views/Error.php?message=Only authenticated users can get projects.&status_code=401');
} else {
  $active_concerts = Concert::getAllConcerts();
	
	require_once('../views/ConcertsList.php');
}
?>
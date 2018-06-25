<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use models\Concert;
use models\User;
use models\Error;

session_start();

if(!isset($_SESSION['current_user_id'])) {
    http_response_code(401);
 	// header('Location: ../views/Error.php?message=Only authenticated users can view project details.&status_code=401');
} else {
	$current_user = $_SESSION['current_user_id'];
	
	$concert_id = $_GET['id'];
	$concert = Concert::getById($concert_id);

	if($concert->getTitle()) {
	  require_once('../views/ConcertDetails.php');	
	} else {
		http_response_code(404);
 		// header('Location: ../views/Error.php?message=Project was not found.&status_code=404');
	}
}
?>
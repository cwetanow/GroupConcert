<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use models\Concert;

session_start();

if(!isset($_SESSION['current_user_id'])) {
    http_response_code(401);
 	// header('Location: ../views/Error.php?message=Only authenticated users can view project details.&status_code=401');
} else {
	$current_user = $_SESSION['current_user_id'];
	
	$concert_id = $_POST['id'];
	$concert = Concert::getById($concert_id);

	if($concert->getTitle()) {
    if($concert->getHostId() === $current_user){
        Concert::delete($concert_id);

        header('Location: ./GetAllConcerts.php');
    }else {
		  http_response_code(401);
    }
	} else {
		http_response_code(404);
 		// header('Location: ../views/Error.php?message=Project was not found.&status_code=404');
	}
}
?>
<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use models\Concert;
use models\User;
use models\Error;

session_start();

if(!isset($_SESSION['current_user_id'])) {
    http_response_code(401);
		header('Location: ../views/Error.php?message=Only concert host can edit.&status_code=401');

} else {
	$current_user = $_SESSION['current_user_id'];
	
	$concert_id = $_GET['id'];
	$concert = Concert::getById($concert_id);

  if($concert->getHostId() === $current_user){
	if($concert->getTitle()) {
	  require_once('../views/EditConcert.php');	
	} else {
		http_response_code(404);
		header('Location: ../views/Error.php?message=Concert not found.&status_code=401');
	}
  } else {
    http_response_code(401);
  }

}
?>
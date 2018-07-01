<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use models\Concert;
use models\User;

session_start();
	
  $user_id = $_GET['id'];
  $user = User::getById($user_id);

	if($user) {
	  $concerts = Concert::getUserConcerts($user_id);

	  require_once('../views/UserProfile.php');	
	} else {
		http_response_code(404);
	}
?>
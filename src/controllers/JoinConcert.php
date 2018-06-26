<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use models\Concert;
use models\User;
use models\ConcertParticipant;

session_start();

if(!isset($_SESSION['current_user_id'])) {
    http_response_code(401);
 	// header('Location: ../views/Error.php?message=Only authenticated users can view project details.&status_code=401');
} else {
	$current_user = $_SESSION['current_user_id'];
	
	$concert_id = $_GET['id'];
	$concert = Concert::getById($concert_id);

	if($concert->getTitle()) {
    if($concert->hasEmptySlots()){
        $existing_participant = ConcertParticipant::isUserParticipant($concert_id, $current_user);

    if($existing_member->getId())
    {
		  http_response_code(409);
    } else {
      $member = ConcertParticipant::create($project_id, $current_user);

      try {
					$member->insert();

					header('Location: ../views/ConcertDetails.php?id='.$concert_id);
				} catch (Exceprion $ex) {
		      http_response_code(500);          
      	}
      } 
    } else {
    }
	} else {
		http_response_code(404);
	}
}
?>
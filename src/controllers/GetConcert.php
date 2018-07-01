<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use models\Concert;
use models\ConcertPerformRequest;
use models\ConcertParticipant;
use models\User;
use models\Comment;

session_start();

	
	$concert_id = $_GET['id'];
	$concert = Concert::getById($concert_id);
	$concert->populateHost();
  $concert->populatePerformer();

	if($concert->getTitle()) {
    if(isset($_SESSION['current_user_id'])) {
	$current_user = $_SESSION['current_user_id'];  
    
      if($concert->getHostId() === $current_user && !$concert->getPerformerId())
    {
      $perform_requests = ConcertPerformRequest::getConcertPerformRequests($concert_id);
    }

    if($concert->getHostId() !== $current_user){
      $hasSentRequest = !!(ConcertPerformRequest::hasUserSentPerformRequest($concert_id, $current_user)->getId());
    }

    $isUserParticipant = !!(ConcertParticipant::isUserParticipant($concert_id, $current_user)->getId());

    if($isUserParticipant || $concert->getHostId() === $current_user){
      $comments = Comment::getConcertComments($concert_id);
    }}

	  require_once('../views/ConcertDetails.php');	
	} else {
		http_response_code(404);
	}
?>
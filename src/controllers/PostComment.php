<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use models\Concert;
use models\ConcertPerformRequest;
use models\ConcertParticipant;
use models\User;
use models\Comment;
use helpers\Validator;

session_start();

if(!isset($_SESSION['current_user_id'])) {
    http_response_code(401);
} else {
	$current_user = $_SESSION['current_user_id'];
	$comment_text = $_POST['comment_text'];

	$concert_id = $_GET['id'];
  $is_text_valid = Validator::exists($comment_text);

  if(ConcertParticipant::isUserParticipant($concert_id, $current_user)){
    $comment = Comment::create(date(), $current_user, $comment_text, $concert_id);  
    $comment->insert();    
 
	header('Location: ./GetConcert.php?id='.$concert_id);    
  }
    http_response_code(401);

}
?>
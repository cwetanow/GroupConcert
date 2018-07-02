<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use models\Concert;
use models\User;
use models\ConcertParticipant;

session_start();

if (!isset($_SESSION['current_user_id'])) {
    http_response_code(401);
    header('Location: ../views/Error.php?message=Only authenticated users can join concert.&status_code=401');
    
} else {
    $current_user = $_SESSION['current_user_id'];
    
    $concert_id = $_GET['id'];
    $concert    = Concert::getById($concert_id);
    
    if ($concert->getTitle()) {
        if ($concert->hasEmptySlots()) {
            $existing_participant = ConcertParticipant::isUserParticipant($concert_id, $current_user);
            
            if ($existing_participant->getId()) {
                http_response_code(409);
            } else {
                $member = ConcertParticipant::create($current_user, $concert_id);
                
                try {
                    $member->insert();
                    $concert->joinPerson();
                    
                    header('Location: ./GetConcert.php?id=' . $concert_id);
                }
                catch (Exceprion $ex) {
                    http_response_code(500);
                }
            }
        } else {
        }
    } else {
        http_response_code(404);
        header('Location: ../views/Error.php?message=Concert not found.&status_code=404');
    }
}
?> 
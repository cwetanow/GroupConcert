<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use models\Concert;
use models\User;
use models\ConcertPerformRequest;

session_start();

if (!isset($_SESSION['current_user_id'])) {
    http_response_code(401);
    // header('Location: ../views/Error.php?message=Only authenticated users can view project details.&status_code=401');
} else {
    $current_user = $_SESSION['current_user_id'];
    
    $concert_id = $_GET['id'];
    $concert    = Concert::getById($concert_id);
    
    if ($concert->getTitle()) {
        if ($concert->getPerformerId()) {
            http_response_code(409);
        } else {
            $performer = ConcertPerformRequest::create($current_user, $concert_id);
            
            try {
                $performer->insert();
                
                header('Location: ./GetConcert.php?id=' . $concert_id);
            }
            catch (Exceprion $ex) {
                http_response_code(500);
            }
        }
    } else {
        http_response_code(404);
    }
}
?> 
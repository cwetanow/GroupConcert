<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use models\Concert;
session_start();

$active_concerts = Concert::getAllConcerts();
	
require_once('../views/ConcertsList.php');
?>
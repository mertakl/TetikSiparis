<?php 

session_start();

require_once 'db/db.php';

header('Content-Type: text/html; charset=utf-8');

// echo $_SESSION['userId'];

if(!$_SESSION['userId']) {
	header('location: http://yarkasiparis.xyz/index.php');		
} 



?>

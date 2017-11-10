<?php

require_once 'db/db.php';

if(!$_SESSION['userId']) {

	header('location: http://yarkasiparis.xyz/index.php');		

} 


if($_GET['id']){
	
	$id = $_GET['id'];
	
	echo $id;
	
	$sql = "DELETE FROM users where user_id = '".$id."'";
	
    	$result = $connect->query($sql); 
	
	
	$connect->close();
	
	
	
	header("Location: /showusers.php");
}


?>

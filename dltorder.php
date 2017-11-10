<?php

require_once 'db/db.php';

if(!$_SESSION['userId']) {

	header('location: http://yarkasiparis.xyz/index.php');	

} 

if($_GET['id']){
	
	$id = $_GET['id'];
	
	$sql = "DELETE FROM deleted_orders where order_id = '".$id."'";
	
	$result = $connect->query($sql) or die("Something has gone wrong! ".$sql->errorno);
	
	$connect->close();

}

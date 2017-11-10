<?php

require_once 'db/db.php';

if(!$_SESSION['userId']) {

	header('location: http://yarkasiparis.xyz/index.php');		

} 

if($_GET['id']){

	
	$id = $_GET['id'];
	
//	echo $id;

	$sql2 = "INSERT INTO deleted_orders select * from orders where order_id = '".$id."'";
	
	$result2 = $connect->query($sql2) or die("Something has gone wrong! ".$sql2->errorno);
	
	$sql = "DELETE FROM orders where order_id = '".$id."'";
	
	$result = $connect->query($sql) or die("Something has gone wrong! ".$sql->errorno);
	
	
	$connect->close();
	
	header("Location: /homepage.php");
}


?>

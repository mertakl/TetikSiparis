<?php 	

$localhost = "127.0.0.1";
$username = "root";
$password = "password";
$dbname = "dbname";

// db connection
$connect = new mysqli($localhost, $username, $password, $dbname);

mysqli_set_charset( $connect,'utf8');

// check connection
if($connect->connect_error) {
  die("Connection Failed : " . $connect->connect_error);
} else {
   //echo "Successfully connected";
}

?>

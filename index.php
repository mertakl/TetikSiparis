<?php 
require_once 'db/db.php';

session_start();

if(isset($_SESSION['userId'])) {
	header('location: http://yarkasiparis.xyz/homepage.php');		
}

$errors = array();

if($_POST) {		

	$username = $_POST['username'];
	$password = $_POST['password'];

	if(empty($username) || empty($password)) {
		if($username == "") {
			$errors[] = "Kullanıcı adı gerekli!";
		} 

		if($password == "") {
			$errors[] = "Şifre gerekli!";
		}
	} else {
		$sql = "SELECT * FROM users WHERE username = '$username'";
		$result = $connect->query($sql);

		if($result->num_rows == 1) {
			$password = $password;
			// exists
			$mainSql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
			$mainResult = $connect->query($mainSql);

			if($mainResult->num_rows == 1) {
				$value = $mainResult->fetch_assoc();
				$user_id = $value['user_id'];

				// set session
				$_SESSION['userId'] = $user_id;
				$_SESSION['username'] = $username;

				header('location: http://yarkasiparis.xyz/homepage.php');		
				
			} else{
				
				$errors[] = "Kullanıcı adı veya şifre geçersiz!";
			} // /else
		} else {		
			$errors[] = "Kullanıcı adı bulunmamaktadır!";		
		} // /else
	} // /else not empty username // password
	
} // /if $_POST
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <title>Tetik Sipariş</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/loginstyle.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class = "container">
	<div class="messages">
		<?php if($errors) {
			foreach ($errors as $key => $value) {
				echo '<div class="alert alert-warning" role="alert">
				<i class="glyphicon glyphicon-exclamation-sign"></i>
				'.$value.'</div>';										
				}
			} ?>
	</div>
	<div class="wrapper">
		<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" id="loginForm" class="form-signin">       
		    <h3 class="form-signin-heading">Lütfen Giriş Yapın</h3>
			  <hr class="colorgraph"><br>
			  
			  <input type="text" class="form-control" name="username" id="username" placeholder="Kullanıcı Adı" required="" autofocus="" />
			  <input type="password" class="form-control" name="password" id="password" placeholder="Şifre" required=""/>     		  
			 
			  <button class="btn btn-lg btn-primary btn-block"  name="Submit" value="Giriş Yap" type="Submit">Giriş Yap</button>  			
		</form>			
	</div>
</div>
<script>
	if ( window.history.replaceState ) {
		window.history.replaceState( null, null, window.location.href );
	}
</script>

</body>
</html>


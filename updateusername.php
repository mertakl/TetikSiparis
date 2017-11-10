<?php 
		
	  require_once 'header.php'; 
	  
	  require_once 'db/db.php'; 

	if(!$_SESSION['userId']) {

		header('location: http://yarkasiparis.xyz/index.php');	

	} 
	
	
	if(isset($_GET['id'])){
		
		$_SESSION['userrowid'] = $_GET['id'];
		
		$sql = "SELECT * FROM users where user_id = '".$_SESSION['userrowid']."'";
		$result = $connect->query($sql) or die($connect->error);
		$connect->close();
	}

	
	if(isset($_POST['Update'])){
		
			$username = $_POST["username"];
			
			$check_sql = "SELECT * FROM users WHERE username= '".$username."'";
			
			$result = $connect->query($check_sql) or die($connect->error); 
		

		if(mysqli_num_rows($result)>=1){	

			echo "<script type='text/javascript'>alert('Bu kullanıcı zaten var!');</script>";
		
		}else{

			$sql = "UPDATE users SET username = '$username'	WHERE user_id='".$_SESSION['userrowid']."'";
						 
			$connect->query($sql) or die($connect->error);
			
			echo "<script type='text/javascript'>alert('Kullanıcı Adı Başarıyla Değiştirildi!');</script>";

		}
		
		$connect->close();
		
		
	}	
		
?>		
			
		
	<div class="container">
		<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" id="loginForm" class="form-signin">   
			<?php  if (isset($result)) {while($userdata = $result->fetch_assoc()){?>
			  <input type="text" class="form-control" name="username" id="username" value="<?php echo $userdata['username']; ?>" placeholder="Kullanıcı Adı" required="" autofocus="" />
			  <button class="btn btn-primary"  name="Update" value="Giriş Yap" type="Submit" style="margin-top: 10px;">Güncelle</button>  			
			<?php }}?>  
		</form>		
	</div>	

<!--Avoids data insert on refresh-->
<script>
	if ( window.history.replaceState ) {
		window.history.replaceState( null, null, window.location.href );
	}
</script>	
	
<?php require_once 'footer.php'; ?>	

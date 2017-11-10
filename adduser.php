<?php require_once 'header.php';
      require_once 'db/db.php';
	  
if(!$_SESSION['userId']) {

	header('location: http://yarkasiparis.xyz/index.php');	

} 	  
	  
?>


<script>
	function validate(){

		var a = document.getElementById("password").value;
		var b = document.getElementById("password_confirm").value;
		if (a!=b) {
		   alert("Şifreler aynı değil");
		   return false;
		}
	}
 </script>
 
 <?php

	 if($_POST){

			$username = $_POST["username"];
			$password = $_POST["password"];	
			
			
			$check_sql = "SELECT * FROM users WHERE username= '".$username."'";
			
			$result = $connect->query($check_sql);
			
			if(mysqli_num_rows($result)>= 1){
				
				echo "<script type='text/javascript'>alert('Bu kullanıcı zaten var!');</script>";
				
			}else{
			
				$sql ="INSERT INTO users (username, password) VALUES ('$username', '$password')";
				
				
				if ($connect->query($sql) === TRUE) {
					echo "<script type='text/javascript'>alert('Yeni kullanıcı kaydedildi!');</script>";
					echo "<script>redirect('/showusers.php'); </script>";
					
				} else {
					echo "Error: " . $sql . "<br>" . $connect->error;
					//echo "<script type='text/javascript'>alert('$connect->error');</script>";
				}

				$connect->close();
			}

		
	}

 ?>

 
<div class="container">
	<form class="form-horizontal" action='<?php echo $_SERVER['PHP_SELF'] ?>' method="POST" onSubmit="return validate();">
		  <fieldset>
			<div id="legend">
			  <legend class="">Kullanıcı Kaydet</legend>
			</div>
			<div class="control-group">
			  <!-- Username -->
			  <label class="control-label"  for="username">Kullanıcı Adı:</label>
			  <div class="controls">
				<input type="text" id="username" name="username" placeholder="" class="form-control">
			  </div>
			</div>
		 
			<div class="control-group">
			  <!-- Password-->
			  <label class="control-label" for="password">Şifre</label>
			  <div class="controls">
				<input type="password" id="password" name="password" placeholder="" class="form-control">
			  </div>
			</div>
		 
			<div class="control-group">
			  <!-- Password -->
			  <label class="control-label"  for="password_confirm">Şifre Tekrar</label>
			  <div class="controls">
				<input type="password" id="password_confirm" name="password_confirm" placeholder="" class="form-control">
			  </div>
			</div>
		 
			<div class="control-group">
			  <!-- Button -->
			  <div class="controls">
				<input type="submit" value="Kaydet" class="btn btn-success"/>
			  </div>
			</div>
		  </fieldset>
	</form>
</div>
<script>
	if ( window.history.replaceState ) {
		window.history.replaceState( null, null, window.location.href );
	}
</script>

<?php require_once 'footer.php'; ?>	
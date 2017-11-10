<?php
		
	  require_once 'header.php'; 
	  
	  require_once 'db/db.php'; 

	if(!$_SESSION['userId']) {

		header('location: http://yarkasiparis.xyz/index.php');	

	} 
	

	if(count($_POST)>0) {
		
		$_SESSION['userrowid'] = $_GET['id'];
		
		$sql ="SELECT *from users WHERE user_id='" . $_SESSION["userrowid"] . "'";
		
		$result = $connect->query($sql) or die($connect->error);
		
		$row = mysqli_fetch_array($result);
		
		if($_POST["currentPassword"] == $row["password"]) {
			
			$update_query = "UPDATE users set password='" . $_POST["newPassword"] . "' WHERE user_id='" . $_SESSION["userrowid"] . "'";
			
			$result = $connect->query($update_query) or die($connect->error);
			
			$connect->close();
			
			echo "<script type='text/javascript'>alert('Şifre Başarıyla Değiştirildi!');</script>";
	
	} else 
		
		echo "<script type='text/javascript'>alert('Eski şifreniz yanlış!');</script>";
	
	}
	
	?>
	
	<script>
		function validatePassword() {
		var currentPassword,newPassword,confirmPassword,output = true;

		currentPassword = document.frmChange.currentPassword;
		newPassword = document.frmChange.newPassword;
		confirmPassword = document.frmChange.confirmPassword;

		if(!currentPassword.value) {
			currentPassword.focus();
			document.getElementById("currentPassword").innerHTML = "required";
			output = false;
		}
		else if(!newPassword.value) {
			newPassword.focus();
			document.getElementById("newPassword").innerHTML = "required";
			output = false;
		}
		else if(!confirmPassword.value) {
			confirmPassword.focus();
			document.getElementById("confirmPassword").innerHTML = "required";
			output = false;
		}
		if(newPassword.value != confirmPassword.value) {
			newPassword.value="";
			confirmPassword.value="";
			newPassword.focus();
			document.getElementById("confirmPassword").innerHTML = "Şifreler Uyuşmamaktadır";
			output = false;
		} 	
		return output;
		}
	</script>
	
	<div class="container">
	  <h2>Şifreyi Değiştir</h2>
	  <form name="frmChange" method="post" class="form-horizontal" action="" onSubmit="return validatePassword()">
		<div class="form-group">
		  <label class="control-label col-sm-2">Şimdiki Şifreniz:</label>
		  <div class="col-sm-10">
			<input type="password" name="currentPassword" class="form-control" class="txtField" placeholder="Şimdiki Şifreniz:"/><span id="currentPassword"  class="required"></span>
		  </div>
		</div>
		<div class="form-group">
		  <label class="control-label col-sm-2" for="pwd">Yeni Şifreniz:</label>
		  <div class="col-sm-10">
			<input type="password" name="newPassword" class="form-control" placeholder="Yeni Şifreniz:"/><span id="newPassword" class="required"></span>         
		  </div>
		</div>
		<div class="form-group">
		  <label class="control-label col-sm-2" for="pwd">Şifre Tekrarı:</label>
		  <div class="col-sm-10">
			<input type="password" name="confirmPassword" class="form-control" placeholder="Şifre Tekrarı:"/><span id="confirmPassword" class="required"></span>
		  </div>
		</div>
		<div class="form-group">        
		  <div class="col-sm-offset-2 col-sm-10">
			<input type="submit" name="submit" value="Güncelle" class="btn btn-primary">
		  </div>
		</div>
	  </form>
	</div>	
	
		<!--Avoids data insert on refresh-->
	<script>
		if ( window.history.replaceState ) {
			window.history.replaceState( null, null, window.location.href );
		}
	</script>
	
<?php require_once 'footer.php'; ?>

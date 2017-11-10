<?php require_once 'header.php'; 
	  require_once 'db/db.php'; 

if(!$_SESSION['userId']) {

	header('location: http://yarkasiparis.xyz/index.php');	

} 

$errors = array();
	  
if (isset($_POST['Submit'])){

		$situation = "Beklemede";
		$name = $_POST["name"];
		$surname = $_POST["surname"];
		$city = $_POST["city"];
		$district = $_POST["district"];
		$area = $_POST["area"];
		$address = $_POST["address"];
		$gsm1 = $_POST["gsm1"];
		$gsm2 = $_POST["gsm2"];
		$product = $_POST["product"];
		$quantity = $_POST["quantity"];
		$price = $_POST["price"];
		$down_payment = $_POST["down_payment"];
		$explanation = $_POST["explanation"];
		$user_id = $_SESSION['userId'];
		$user_name = $_SESSION['username'];
		$date = date('Y-m-d H:i:s');

		//Form Validation

		if(empty($name)) {
			
			if($name == "") {
				$errors[] = "İsim gerekli!";
			}
		}else if(empty($surname) || empty($city)) {
			if($surname == "") {
				$errors[] = "Soyadı gerekli!";
			} 

			if($city == "") {
				$errors[] = "Şehir gerekli!";
			}
		}else if(empty($district) || empty($area)) {
			if($district == "") {
				$errors[] = "İlçe gerekli!";
			} 

			if($area == "") {
				$errors[] = "Bölge gerekli!";
			}
		}else if(empty($address) || empty($gsm1)) {
			if($address == "") {
				$errors[] = "Adres gerekli!";
			} 

			if($gsm1 == "") {
				$errors[] = "Gsm 1 gerekli!";
			}
		}else if(empty($product) || empty($quantity)) {
			if($product == "") {
				$errors[] = "Ürün gerekli!";
			} 

			if($quantity == "") {
				$errors[] = "Adet gerekli!";
			}
		}else if(empty($price) || empty($down_payment)) {
			if($price == "") {
				$errors[] = "Fiyat gerekli!";
			} 

			if($down_payment == "") {
				$errors[] = "Kapora gerekli!";
			}
		}else{			

		$sql = "INSERT INTO orders (order_situation, client_name, client_last_name , city, district, area, address, tel_no1, tel_no2, product, quantity, price, down_payment, explanation, user_id, username, date)
		VALUES ('$situation', '$name', '$surname', '$city', '$district', '$area', '$address', '$gsm1', '$gsm2', '$product', $quantity, '$price', '$down_payment', '$explanation', $user_id, '$user_name', '$date')";
		
			if ($connect->query($sql) === TRUE) {
				echo "<script type='text/javascript'>alert('Yeni sipariş kaydedildi!');</script>";
			} else {
				echo "Error: " . $sql . "<br>" . $connect->error;
				//echo "<script type='text/javascript'>alert('$connect->error');</script>";
			}

		$connect->close();
	}
	
}
?>

<div class="container">
	<div class="messages">
		<?php if($errors) {
			foreach ($errors as $key => $value) {
				echo '<div class="alert alert-warning" role="alert">
				<i class="glyphicon glyphicon-exclamation-sign"></i>
				'.$value.'</div>';										
				}
			} ?>
	</div>

    <h1 class="well">Sipariş Ver</h1>
	<div class="col-lg-12 well">
	<div class="row">
				<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
					<div class="col-sm-12">
						<div class="row">
						<p style= "margin-left: 15px; color: red">* olan alanlar zorunludur</p>
							<div class="col-sm-6 form-group">
								<label>Ad: *</label>
								<input type="text" name = "name" placeholder="Adı buraya girin..." class="form-control">
							</div>
							<div class="col-sm-6 form-group">
								<label>Soyad: *</label>
								<input type="text" name = "surname" placeholder="Soyadını buraya girin.." class="form-control">
							</div>
						</div>					
						<div class="row">
							<div class="col-sm-4 form-group">
								<label>İl: *</label>
								<input type="text" name = "city" placeholder="İli buraya girin.." class="form-control">
							</div>	
							<div class="col-sm-4 form-group">
								<label>İlçe: *</label>
								<input type="text" name = "district" placeholder="İlçeyi buraya girin.." class="form-control">
							</div>		
							<div class="col-sm-4 form-group">
								<label for="area"> Bölge Seçin: *</label>
								  <select class="form-control" name = "area">
									<option disabled="disabled" selected="selected">Bölge Seçin</option>
									<option value="Karadeniz">Karadeniz</option>
									<option value="Marmara">Marmara</option>
									<option value="İç Anadolu">İç Anadolu</option>
									<option value="Doğu Anadolu">Doğu Anadolu</option>
									<option value="Güneydoğu Anadolu">Güneydoğu Anadolu</option>
									<option value="Ege">Ege</option>
									<option value="Akdeniz">Akdeniz</option>
								  </select>
							</div>		
						</div>
						<div class="form-group">
							<label>Adres: *</label>
							<textarea name = "address" placeholder="Adresinizi buraya girin..." rows="3" class="form-control"></textarea>
						</div>	
						<div class="row">
							<div class="col-sm-6 form-group">
								<label>GSM no 1: *</label>
								<input type="text" name = "gsm1" placeholder="Birinci tel numarası..." class="form-control">
							</div>		
							<div class="col-sm-6 form-group">
								<label>GSM no 2:</label>
								<input type="text" name = "gsm2" placeholder="İkinci tel numarası..." class="form-control">
							</div>	
						</div>						
						<div class="row">
							<div class="col-sm-6 form-group">
								<label for="produt">Ürün Seçin: *</label>
								  <select class="form-control" name = "product">
									<option disabled="disabled" selected="selected">Ürün Seçin</option>
									<option value="Ataks">Ataks</option>
									<option value="Lohman">Lohman</option>
									<option value="İsa Dekalp">İsa Dekalp</option>
									<option value="Horoz">Horoz</option>
								  </select>
							</div>	
							<div class="col-sm-6 form-group">
								<label>Adet: *</label>
								<input type="text" name = "quantity" placeholder="Adeti buraya girin.." class="form-control">
							</div>			
						</div>	
						<div class="row">
							<div class="col-sm-6 form-group">
								<label>Fiyat: *</label>
								<input type="text" name = "price" placeholder="Fiyatı buraya girin.." class="form-control">
							</div>	
							<div class="col-sm-6 form-group">
								<label>Kapora: *</label>
								<input type="text" name = "down_payment" placeholder="Kaporayı buraya girin.." class="form-control">
							</div>			
						</div>	
						<div class="form-group">
							<label>Açıklama</label>
							<textarea name = "explanation" placeholder="Açıklamayı buraya girin..." rows="3" class="form-control"></textarea>
						</div>
						<input type="submit" name="Submit" value = "Kaydet" class="btn btn-lg btn-info">
							
					</div>
				</form> 
			</div>
		</div>
	</div>
	<script>
		if ( window.history.replaceState ) {
			window.history.replaceState( null, null, window.location.href );
		}
	</script>
<?php require_once 'footer.php'; ?>

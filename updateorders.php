
<?php require_once 'header.php'; 
	  require_once 'db/db.php'; 

	if(!$_SESSION['userId']) {

		header('location: http://yarkasiparis.xyz/index.php');

	} 
	
	
	if(isset($_GET['id'])){
		
		$_SESSION['rowid'] = $_GET['id'];
		
		$sql = "SELECT * FROM orders where order_id = '".$_SESSION['rowid']."'";
		$result = $connect->query($sql) or die($connect->error);
		$connect->close();
	}
	
	$errors = array();
	
	if(isset($_POST['update'])){
		
		
			$situation = $_POST["situation"];
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
			
			
			//Form Validation

		if(empty($name) || empty($situation)) {
			
			if($name == "") {
				$errors[] = "İsim gerekli!";
			}
			
			if($situation == "") {
				$errors[] = "Durum gerekli!";
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


				$sql = "UPDATE orders SET order_situation = '$situation',
							 client_name = '$name', client_last_name ='$surname' , city ='$city' , district ='$district' 
							 , area ='$area' , address ='$address' , tel_no1 ='$gsm1' , tel_no2 ='$gsm2' , product ='$product' 
							 , quantity ='$quantity' , price ='$price' , down_payment ='$down_payment' , explanation ='$explanation' WHERE order_id='".$_SESSION['rowid']."'";
							 
				$connect->query($sql) or die($connect->error);

				$connect->close();
				
			}
				
		header('Location: /homepage.php');
		
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
				<?php  if (isset($result)) {while($userdata = $result->fetch_assoc()){?>
					<div class="col-sm-12">
						<div class="row">
							<p style= "margin-left: 15px; color: red">* olan alanlar zorunludur</p>
							<div class="col-sm-4 form-group">
							 <label for="situation"> Durum Seçin: *</label>
								  <select class="form-control" name = "situation">
									<option value="Beklemede" <?php if($userdata['order_situation'] == "Beklemede"){  ?> selected <?php  }  ?>> Beklemede </option>   
									<option value="Hazırlanıyor" <?php if($userdata['order_situation'] == "Hazırlanıyor"){  ?> selected <?php  }  ?>> Hazırlanıyor </option>
									<option value="Yolda" <?php if($userdata['order_situation'] == "Yolda"){  ?> selected <?php  }  ?>> Yolda </option>
									<option value="Tamamlandı" <?php if($userdata['order_situation'] == "Tamamlandı"){  ?> selected <?php  }  ?>> Tamamlandı </option>
									<option value="İptal Edildi" <?php if($userdata['order_situation'] == "İptal Edildi"){  ?> selected <?php  }  ?>> İptal Edildi </option>
									<option value="Araç 1" <?php if($userdata['order_situation'] == "Araç 1"){  ?> selected <?php  }  ?>> Araç 1 </option>
									<option value="Araç 2" <?php if($userdata['order_situation'] == "Araç 2"){  ?> selected <?php  }  ?>> Araç 2 </option>
									<option value="Araç 3" <?php if($userdata['order_situation'] == "Araç 3"){  ?> selected <?php  }  ?>> Araç 3 </option>
								</select>
							</div>
							<div class="col-sm-4 form-group">
								<label>Ad: *</label>
								<input type="text" name = "name" value="<?php echo $userdata['client_name']; ?>" placeholder="Adınızı buraya girin..." class="form-control">
							</div>
							<div class="col-sm-4 form-group">
								<label>Soyad: *</label>
								<input type="text" name = "surname" value="<?php echo $userdata['client_last_name']; ?>" placeholder="Soyadınızı buraya girin.." class="form-control">
							</div>
						</div>					
						<div class="row">
							<div class="col-sm-4 form-group">
								<label>İl: *</label>
								<input type="text" name = "city" value="<?php echo $userdata['city']; ?>" placeholder="İli buraya girin.." class="form-control">
							</div>	
							<div class="col-sm-4 form-group">
								<label>İlçe: *</label>
								<input type="text" name = "district" value="<?php echo $userdata['district']; ?>" placeholder="İlçeyi buraya girin.." class="form-control">
							</div>		
							<div class="col-sm-4 form-group">
								<label for="area"> Bölge Seçin: *</label>
								  <select class="form-control" name = "area">
									<option value="Karadeniz" <?php if($userdata['area'] == "Karadeniz"){  ?> selected <?php  }  ?>> Karadeniz </option>   
									<option value="Marmara" <?php if($userdata['area'] == "Marmara"){  ?> selected <?php  }  ?>> Marmara </option>
									<option value="İç Anadolu" <?php if($userdata['area'] == "İç Anadolu"){  ?> selected <?php  }  ?>> İç Anadolu </option>
									<option value="Doğu Anadolu" <?php if($userdata['area'] == "Doğu Anadolu"){  ?> selected <?php  }  ?>> Doğu Anadolu </option>
									<option value="Güneydoğu Anadolu" <?php if($userdata['area'] == "Güneydoğu Anadolu"){  ?> selected <?php  }  ?>> Güneydoğu Anadolu </option>
									<option value="Ege" <?php if($userdata['area'] == "Ege"){  ?> selected <?php  }  ?>> Ege </option>
								  </select>
								  
							</div>		
						</div>
						<div class="form-group">
							<label>Adres: *</label>
							<textarea name = "address" placeholder="Adresinizi buraya girin..." rows="3" class="form-control"><?php echo $userdata['address']; ?></textarea>
						</div>	
						<div class="row">
							<div class="col-sm-6 form-group">
								<label>GSM no 1: *</label>
								<input type="text" name = "gsm1" value="<?php echo $userdata['tel_no1']; ?>" placeholder="Birinci tel numarası..." class="form-control">
							</div>		
							<div class="col-sm-6 form-group">
								<label>GSM no 2:</label>
								<input type="text" name = "gsm2" value="<?php echo $userdata['tel_no2']; ?>" placeholder="İkinci tel numarası..." class="form-control">
							</div>	
						</div>						
						<div class="row">
							<div class="col-sm-6 form-group">
								<label for="product">Ürün Seçin: *</label>
								    <select class="form-control" name = "product">
										<option value="Ataks" <?php if($userdata['product'] == "Ataks"){  ?> selected <?php  }  ?>> Ataks </option>   
										<option value="Lohman" <?php if($userdata['product'] == "Lohman"){  ?> selected <?php  }  ?>> Lohman </option>
										<option value="İsa Dekalp" <?php if($userdata['product'] == "İsa Dekalp"){  ?> selected <?php  }  ?>> İsa Dekalp </option>
										<option value="Horoz" <?php if($userdata['product'] == "Horoz"){  ?> selected <?php  }  ?>> Horoz </option>
									</select>
							</div>	
							<div class="col-sm-6 form-group">
								<label>Adet: *</label>
								<input type="text" name = "quantity" value="<?php echo $userdata['quantity']; ?>" placeholder="Adeti buraya girin.." class="form-control">
							</div>			
						</div>	
						<div class="row">
							<div class="col-sm-6 form-group">
								<label>Fiyat: *</label>
								<input type="text" name = "price" value="<?php echo $userdata['price']; ?>" placeholder="Fiyatı buraya girin.." class="form-control">
							</div>	
							<div class="col-sm-6 form-group">
								<label>Kapora: *</label>
								<input type="text" name = "down_payment" value="<?php echo $userdata['down_payment']; ?>" placeholder="Kaporayı buraya girin.." class="form-control">
							</div>			
						</div>	
						<div class="form-group">
							<label>Açıklama:</label>
							<textarea name = "explanation" placeholder="Açıklamayı buraya girin..." rows="3" class="form-control"><?php echo $userdata['explanation']; ?></textarea>
						</div>
						<input type="submit" name = "update" value = "Güncelle" class="btn btn-lg btn-info">
							
					</div>
				<?php }}?>
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

<?php 

	  require_once 'header.php'; 

      require_once 'db/db.php';
	  

	if(!$_SESSION['userId']) {

		header('location: http://yarkasiparis.xyz/index.php');	

	} 

			$sql1 = "SELECT is_admin FROM users where user_id = '".$_SESSION['userId']."'";
			$sql2 = "SELECT * FROM users where user_id = '".$_SESSION['userId']."'";
			$sql3 = "SELECT * FROM users";
			$result = $connect->query($sql2); 	
			$uresult = $connect->query($sql1); 
			$aresult = $connect->query($sql3); 
			$userdata = $uresult->fetch_assoc();
			$connect->close(); 
	?>		
			<div class="container">
			<div class="table-responsive">  
			  <table class="table table-striped">
					<thead>
					  <tr>
						<th>Kullanıcı Adı</th>
						<th>Şifre</th>
						<th>İşlem</th>
					  </tr>
					</thead>
				<tbody>
				<?php
					if($userdata['is_admin'] == 0){
						
						$data['password'] = $password;
						
								foreach( $result as $data ) // using foreach  to display each element of array
									{
										echo "<tr><td>".$data['username']."</td>
												  <td>".$data['password']."</td>
												  <td><a href=\"updateusername.php?id=".$data['user_id']."\"><button class='btn btn-primary'>Kullanıcı Adını Değiştir</button></a>
												  <a href=\"updatepassword.php?id=".$data['user_id']."\"><button class='btn btn-success'>Şifreyi Değiştir</button></a></td>
											   </tr>";

									}
							}else if($userdata['is_admin'] == 1){
								foreach( $aresult as $data ) // using foreach  to display each element of array
									{
										echo "<tr><td>".$data['username']."</td>
												  <td>".$data['password']."</td>
												  <td><a href=\"updatepassword.php?id=".$data['user_id']."\"><button class='btn btn-success'>Şifreyi Değiştir</button></a>
												  ";
												  if($data['username'] == "admin"){
													  
												  }else{  
												  echo "<a href=\"updateusername.php?id=".$data['user_id']."\"><button class='btn btn-primary'>Kullanıcı Adını Değiştir</button></a>
														<a href=\"deleteuser.php?id=".$data['user_id']."\"><button class='btn btn-danger'>Sil</button></a></td></br>
													  </tr>";
												  }
									}
							}	
							   
				?>
				<tr>
					<td>
			<?php		if($userdata['is_admin'] == 1){ ?>
						<div><!-- Add user button -->
							<a href="/adduser.php" class="btn btn-primary">Yeni Kullanıcı Ekle</a>
						</div>
			<?php		}	?>
					</td>
				</tr>
			</tbody>        
		</table>
	</div>
</div>

<?php require_once 'footer.php'; ?>

<?php require_once 'header.php'; 

      require_once 'db/db.php';

if(!$_SESSION['userId']) {

	header('location: http://yarkasiparis.xyz/index.php');		

} 
	$condition = "Araç 2";
	
	$query = "SELECT is_admin FROM users WHERE user_id = '".$_SESSION['userId']."'";
	$sql = "SELECT * FROM orders WHERE user_id = '".$_SESSION['userId']."' AND order_situation = '".$condition."' ORDER BY order_id DESC";
 	$adminsql = "SELECT * FROM orders WHERE order_situation = '".$condition."' ORDER BY order_id DESC";
	$result = $connect->query($sql); 	
	$uresult = $connect->query($query); 
	$aresult = $connect->query($adminsql); 
	$userdata = $uresult->fetch_assoc();
	$connect->close(); 
?>
<style>
#myInput {
  background-position: 10px 10px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}

</style>

<div class="container-fluid">
<input type="text" id="search" placeholder="Lütfen aradığınız kelimeyi girin.." class = "form-control" style = "margin-bottom : 10px;">
	<div class="table-responsive">  
	  <table class="table table-hover table-bordered" id = "tableExport">
			<thead>
			  <tr>
			    <th>Sipariş Durumu</th>
				<th>Müşteri Adı</th>
				<th>Müşteri Soyadı</th>
				<th>Şehir</th>
				<th>İlçe</th>
				<th>Bölge</th>
				<th>Adres</th>
				<th>Tel no 1</th>
				<th>Tel no 2</th>
				<th>Ürün</th>
				<th>Miktarı</th>
				<th>Fiyat</th>
				<th>Kapora</th>
				<th>Açıklama</th>
				<th>Kullanıcı</th>
				<th>Tarih</th>
				<th>İşlem</th>
			  </tr>
			</thead>
		<tbody>

		   <?php 
				if($userdata['is_admin'] == 0){ //İf it is no admin
					foreach( $result as $data ) // using foreach  to display each element of array
						{
						  
							echo "<tr><td>".$data['order_situation']."</td>
									  <td>".$data['client_name']."</td>
									  <td>".$data['client_last_name']."</td>
									  <td>".$data['city']."</td>
									  <td>".$data['district']."</td>
									  <td>".$data['area']."</td>
									  <td>".$data['address']."</td>
									  <td>".$data['tel_no1']."</td>
									  <td>".$data['tel_no2']."</td>
									  <td>".$data['product']."</td>
									  <td>".$data['quantity']."</td>
									  <td>".$data['price']."</td>
									  <td>".$data['down_payment']."</td>
									  <td>".$data['explanation']."</td>
									  <td>".$data['username']."</td>
									  <td>".$data['date']."</td>
								   </tr>";
							
						}
						
				}else if($userdata['is_admin'] == 1){ //if it is admin
					foreach( $aresult as $data ) // using foreach  to display each element of array
						{
							
							echo "<tr><td>".$data['order_situation']."</td>
							          <td>".$data['client_name']."</td>
									  <td>".$data['client_last_name']."</td>
									  <td>".$data['city']."</td>
									  <td>".$data['district']."</td>
									  <td>".$data['area']."</td>
									  <td>".$data['address']."</td>
									  <td>".$data['tel_no1']."</td>
									  <td>".$data['tel_no2']."</td>
									  <td>".$data['product']."</td>
									  <td>".$data['quantity']."</td>
									  <td>".$data['price']."</td>
									  <td>".$data['down_payment']."</td>
									  <td>".$data['explanation']."</td>
									  <td>".$data['username']."</td>
									  <td>".$data['date']."</td>
									 <td><a href=\"updateorders.php?id=".$data['order_id']."\"><button class='btn btn-primary'>Güncelle</button></a>
										  <a href=\"deleteorders.php?id=".$data['order_id']."\"><button class='btn btn-danger'>Sil</button></a>	  
									  </td>
								   </tr>";
							   

						}

				}	
			   ?>
			</tbody>        

		</table>
	</div>
	<button id="btnExport" onclick="exportExcel();" class = "btn btn-success">Excel'e Aktar</button>
</div>
<script>

var $rows = $('#tableExport tr');
$('#search').keyup(function() {
    
    var val = '^(?=.*\\b' + $.trim($(this).val()).split(/\s+/).join('\\b)(?=.*\\b') + ').*$',
        reg = RegExp(val, 'i'),
        text;
    
    $rows.show().filter(function() {
        text = $(this).text().replace(/\s+/g, ' ');
        return !reg.test(text);
    }).hide();
});

function exportExcel() {
     var tableExport = document.getElementById('tableExport');
     var html = tableExport.outerHTML;

     while (html.indexOf('ç') != -1) html = html.replace('ç', '&ccedil;');
     while (html.indexOf('ğ') != -1) html = html.replace('ğ', '&#287;');
     while (html.indexOf('ı') != -1) html = html.replace('ı', '&#305;');
     while (html.indexOf('ö') != -1) html = html.replace('ö', '&ouml;');
     while (html.indexOf('ş') != -1) html = html.replace('ş', '&#351;');
     while (html.indexOf('ü') != -1) html = html.replace('ü', '&uuml;');

     while (html.indexOf('Ç') != -1) html = html.replace('Ç', '&Ccedil;');
     while (html.indexOf('Ğ') != -1) html = html.replace('Ğ', '&#286;');
     while (html.indexOf('İ') != -1) html = html.replace('İ', '&#304;');
     while (html.indexOf('Ö') != -1) html = html.replace('Ö', '&Ouml;');
     while (html.indexOf('Ş') != -1) html = html.replace('Ş', '&#350;');
     while (html.indexOf('Ü') != -1) html = html.replace('Ü', '&Uuml;');

     window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
}
</script>

<?php require_once 'footer.php'; ?>
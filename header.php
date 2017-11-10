<?php

session_start();

?>

<!DOCTYPE html>

<html lang="tr">

<head>

  <title>Tetik Sipariş</title>

  <?php header('Content-type: text/html; charset=utf-8'); ?>

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  	

</head>

<body>



<nav class="navbar navbar-default">

  <div class="container-fluid">

    <div class="navbar-header">
               
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>

      <a class="navbar-brand" href="/homepage.php">TetikSipariş</a>

    </div>

<div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">
      <li><a href="/homepage.php">Anasayfa</a></li>

      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Sipariş <span class="caret"></span></a>

        <ul class="dropdown-menu">

          <li><a href="/giveorder.php">Sipariş Ver</a></li>

        </ul>

      </li>

	  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Durum <span class="caret"></span></a>

        <ul class="dropdown-menu">

          <li><a href="/canceled.php">İptal Edilenler</a></li>
		  <li><a href="/dltdorders.php">Silinenler</a></li>
		  <li><a href="/preparedorder.php">Hazırlananlar</a></li>
		  <li><a href="/wayorder.php">Yolda Olanlar</a></li>
		  <li><a href="/finishedorders.php">Tamamlananlar</a></li>
		  <li><a href="/waiting.php">Beklemede</a></li>
		  <li><a href="/arac1.php">Araç 1</a></li>
		  <li><a href="/arac2.php">Araç 2</a></li>
		  <li><a href="/arac3.php">Araç 3</a></li>

        </ul>

      </li>

	  <li><a href="/showusers.php">Hesap Ayarları</a></li>

    </ul>

    
	<ul class="nav navbar-nav navbar-right">

      <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo "Merhaba " . $_SESSION["username"] . "<br>";?></a></li>

      <li><a href="/logout.php"><span class="glyphicon glyphicon-log-in"></span> Çıkış Yap</a></li>

    </ul>
   </div>
 </div>

</nav>

  



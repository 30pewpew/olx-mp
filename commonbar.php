<?php
	function showheader($title)
	{
?>
    
		<!DOCTYPE HTML>
			<html>
			<head>
				<meta charset="utf-8">
				<title><?php echo $title; ?></title>
				<link rel="stylesheet" href="style/css/index.css">
				<link rel="stylesheet" href="style/css/bootstrap.min.css">
			    <script src="style/js/jquery.min.js"></script>
			    <script src="style/js/bootstrap.min.js"></script>
			</head>
		    
		    <body>
				<div class="container-fluid" style="background-image: url(images/background_by_hadouuuken-dc9yxs6.png);">
		        <a href="index.php">   
				<img src = "images/imageedit_7_5986917331_by_hadouuuken-dc9yxd0.png" align = "middle" style = "margin-top: 2%; margin-left: 2%; width: 250px; height: 115px;"></img>
		        </a>
				<h4 style="text-align:center"><span class="label label-default">BUY</span> <span class="label label-default">SELL</span> <span class="label label-default">LEND</span> <span class="label label-default">BORROW</span></h4>
		    </div>

<?php
	}
?>
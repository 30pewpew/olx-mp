<?php
function showheader($title){
	?>
    
<!doctype html>
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
            
		<img src = "images/imageedit_7_5986917331_by_hadouuuken-dc9yxd0.png" align = "middle" style = "width: 100px; height: 50px;"></img>
        
	<h4 style="text-align:center"><span class="label label-default">buy</span> or <span class="label label-default">sell</span>, <span class="label label-default">lend</span> or <span class="label label-default">borrow</span></h4>
    <hr>
    </div>
<?php
}
?>
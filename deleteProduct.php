<?php
if(@$_SERVER['HTTP_REFERER']==='http://localhost/olx-mp/auction.php')
{
if(isset($_GET['productId'])&&!empty($_GET['productId']))
{
   require_once('include/config.inc.php');
   require_once('include/connect.inc.php');
   $productId=(int)$_GET['productId'];
   $query="delete from products where productId=?";
   try{
   $query_prepare=$conn->prepare($query);
   $query_prepare->execute(array($productId));
   echo 'Auction product deleted successfully';
   }
   catch(PDOException $e)
            {
             echo 'some error occur ',$e->getMessage();
            }
}
}
else
die('WTF');




?>
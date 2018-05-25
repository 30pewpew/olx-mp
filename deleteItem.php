<?php
if(@$_SERVER['HTTP_REFERER']==='http://localhost/olx/sell.php')
{
if(isset($_GET['productId'])&&!empty($_GET['productId']))
{
   require_once('include/config.inc.php');
   require_once('include/connect.inc.php');
   $productId=(int)$_GET['productId'];
   $query="DELETE FROM productssale WHERE productId=?";
   try{
   $query_prepare=$conn->prepare($query);
   $query_prepare->execute(array($productId));
   echo 'Item deleted successfully';
   }
   catch(PDOException $e)
            {
             echo 'some error occur ',$e->getMessage();
            }
}
}
else
die('Error deleting selected item');
?>
<?php
if(@$_SERVER['HTTP_REFERER']==='http://localhost/olx/sell.php')
{
if(isset($_GET['productID'])&&!empty($_GET['productID']))
{
   require_once('include/config.inc.php');
   require_once('include/connect.inc.php');
   $productID=(int)$_GET['productID'];
   $query="DELETE FROM productssale WHERE productID=?";
   try{
   $query_prepare=$conn->prepare($query);
   $query_prepare->execute(array($productID));
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
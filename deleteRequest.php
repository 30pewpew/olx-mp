<?php
if(@$_SERVER['HTTP_REFERER']==='http://localhost/olx/auctionrequests.php')
{
if(isset($_GET['serialNo'])&&!empty($_GET['serialNo']))
{
   require_once('include/config.inc.php');
   require_once('include/connect.inc.php');
   $serialNo=(int)$_GET['serialNo'];
   $query="delete from requests where serialNo=?";
   try{
   $query_prepare=$conn->prepare($query);
   $query_prepare->execute(array($serialNo));
   echo 'Auction bid cancelled';
   }
   catch(PDOException $e)
            {
             echo 'some error occur ',$e->getMessage();
            }
}
}
else
die('Error cancelling auction bid');
?>
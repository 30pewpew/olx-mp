<?php
if(@$_SERVER['HTTP_REFERER']==='http://localhost/olx/seller.php')
{
if(isset($_GET['serialNo'])&&!empty($_GET['serialNo']))
{
   require_once('include/config.inc.php');
   require_once('include/connect.inc.php');
   $serialNo=(int)$_GET['serialNo'];
   $query="update requests set accepted='y',statusTime=CURRENT_TIMESTAMP where serialNo=?";
   try{
   $query_prepare=$conn->prepare($query);
   $query_prepare->execute(array($serialNo));
   $query="select requests.buyerId,users.name,users.phoneno from requests,users where serialNo =? and requests.buyerId=users.id";
   $query_prepare=$conn->prepare($query);
   $query_prepare->execute(array($serialNo));
   $row=$query_prepare->fetch();
   echo 'Name: '.$row['name'].'</br>';
   echo 'Phone no: '.$row['phoneno'].'</br>';
   }
   catch(PDOException $e)
            {
             echo 'some error occur ',$e->getMessage();
            }
}
}
else
die('chalaki');
?>
<?php
session_start();
if(isset($_GET['productId'])&&isset($_SESSION['ID'])&&!empty($_GET['productId'])&&!empty($_SESSION['ID'])&&isset($_GET['price'])&&!empty($_GET['price']))
{
  $productId=$_GET['productId'];
  $buyerId=$_SESSION['ID'];
  $price=$_GET['price'];
   require_once('include/config.inc.php');
   require_once('include/connect.inc.php');
   try
   {
   $query="select COUNT(*) from requestssale where productId=? and buyerId=?";
   $query_prepare=$conn->prepare($query);
   $query_prepare->execute(array($productId,$buyerId));
   $row=$query_prepare->fetch();
   if($row['COUNT(*)']==0)
   {
      $query="insert into requestssale(productId,buyerId,price,accepted) values(?,?,?,'h')";
      $query_prepare=$conn->prepare($query);
      $query_prepare->execute(array($productId,$buyerId,$price));
      $query2="INSERT INTO saleshistory(price, productId,userID,buyer,title) values(?,?,?,?,?)";
      echo '<b>bidding done</b>';
   }
   else
       echo 'request already sent';
   }
   catch(PDOException $e)
   {
       echo 'some error occur,request not sent sucessfully'.$e->getMessage();
   }

}
?>
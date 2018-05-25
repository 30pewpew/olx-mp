<?php
   session_start();
   if(!isset($_SESSION['ID'])){
       header('Location:index.php');
   }
   require_once('commonbar.php');
   require_once('navigation.php');
   showheader("Sale History");
   shownavigation();
?>

<script type="text/javascript">
function deleteRequest(serialNo,i)
{
  var xmlhttp=null;
  var id=i;
  try
  {
     xmlhttp=new XMLHttpRequest();     
  }
  catch(e)
  {
     try
     {
      xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
     }
     catch(e)
     {
       xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
     }
  }
  xmlhttp.onreadystatechange=function(){
  if(xmlhttp.readyState==4&&xmlhttp.status==200)
  {
     document.getElementById(id).innerHTML=xmlhttp.responseText;
  }
  }
  var url='deleteRequest.php?serialNo='+serialNo;
  xmlhttp.open('GET',url,true);
  xmlhttp.send();
}

function updateRequest(serialNo,i)
{
  var xmlhttp=null;
  var id='updatestatus'+i;
  var bidPrice=document.getElementById('bidPrice'+i).value;
  try
  {
     xmlhttp=new XMLHttpRequest();     
  }
  catch(e)
  {
     try
     {
      xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
     }
     catch(e)
     {
       xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
     }
  }
  xmlhttp.onreadystatechange=function(){
  if(xmlhttp.readyState==4&&xmlhttp.status==200)
  {
     document.getElementById(id).innerHTML=xmlhttp.responseText;
  }
  }
  var url='updateRequest.php?serialNo='+serialNo+'&bidPrice='+bidPrice;
  xmlhttp.open('GET',url,true);
  xmlhttp.send();
}
</script>

<?php

   require_once('include/config.inc.php');
   require_once('include/connect.inc.php'); 
   
   try{
       $query='select* from productssale where userId = ?';
       $query_prepare=$conn->prepare($query);
       $query_prepare->execute(array($_SESSION['ID']));             // PDOStatement object
       $rows=$query_prepare->fetchAll();
       $num_rows=count($rows);
       ?>
   
   <div class="container-fluid" style="background-color: cyan; height: 100%;">
    
    <?php echo '<h4 align="center" style="color:#434a56">You have '.$num_rows.' items  on sale right now </br> (after updating keep on refreshing the page)</h4>';?>
  
   <?php
        $i=1;
   echo '<div class="row">';
   foreach($rows as $row)
   {
    echo'<div class="container" style="background-color:#2f4f4f" id="'.$i.'">'; 
         echo'<div class="row well col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-2 " style="" >';
         $query2='select COUNT(*),max(price) from productssale where productId=?';
         $query_prepare2=$conn->prepare($query2);
         $query_prepare2->execute(array($row['productId'])); // PDOStatement object
         $row2=$query_prepare2->fetch();
   ?>
    <div class="row">
     <?php echo '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><image src="forsale/'.$row['productId'].'.jpg" height="240" width="240" alt="image not found" style="border-radius:5%"></div>';
     echo '<div>';
     if($row2['COUNT(*)'] <= 0){
        echo '<p><b>No one else has requested this Item</b></p>';
     }
     else{
        echo '<p><b>Category: </b>'.$row['category']. '</p>';
        echo '<p><b>Description: </b>'.$row['description'].'</p>';
        echo '<p><b>Current Price: </b>'.$row2['max(price)']. ' PHP' .'</b></p>';  
        echo '<p><b>Stock: </b>'.$row['stock']. '</b></p>';
        echo '<p><b>Date: </b>'.$row['uploadedTime']. '</b></p>';

     }
     $query='select users.username,users.name,users.phoneno,productssale.userId from productssale,users where productssale.productId = ? and users.Id=productssale.userId limit 1';
     $query_prepare=$conn->prepare($query);
     $query_prepare->execute(array($row['productId'])); // PDOStatement object
     $row2=$query_prepare->fetch();
     if(!isset($row2['username'])){
     }  

    echo '</div>';
    echo '</div>';  
    echo'</div>';
  echo '</div>';  
   }
  
   }
   
   catch(PDOException $e){
        die('some error occured:'.$e->getMessage());
   }
   $conn=null;
 ?>  
    
  </body>
  </html>
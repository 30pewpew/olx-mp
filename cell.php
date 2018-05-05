<?php
session_start();
if(!isset($_SESSION['ID']))
header("Location:index.php");
  require_once('commonbar.php');
  require_once('navigation.php');
  showheader("home");
  shownavigation();

?>
<script type="text/javascript">

var start=0;
function load(category)
{
  start=0;
  var xmlhttp=getXmlHttpObject();
  xmlhttp.onreadystatechange=function(){
  if(xmlhttp.readyState==4&&xmlhttp.status==200)
  {
     document.getElementById("center").innerHTML=xmlhttp.responseText;
  }
  }
  var url='getProduct.php?pname='+category+'&start='+start;
  xmlhttp.open('GET',url,true);
  xmlhttp.send();
}

function increment(category)
{
  start=start+3;
  var xmlhttp=getXmlHttpObject();
  xmlhttp.onreadystatechange=function(){
  if(xmlhttp.readyState==4&&xmlhttp.status==200)
  {
     document.getElementById("center").innerHTML=xmlhttp.responseText;
  }
  }
  var url='getProduct.php?pname='+category+'&start='+start;
  xmlhttp.open('GET',url,true);
  xmlhttp.send();
}

function decrement(category)
{
  start=start-3;
  var xmlhttp=getXmlHttpObject();
  xmlhttp.onreadystatechange=function(){
  if(xmlhttp.readyState==4&&xmlhttp.status==200)
  {
     document.getElementById("center").innerHTML=xmlhttp.responseText;
  }
  }
  var url='getProduct.php?pname='+category+'&start='+start;
  xmlhttp.open('GET',url,true);
  xmlhttp.send();
}

function sendRequest(productId,i)
{
  var xmlhttp=null;
  var id="showStatus"+i;
  var bidPrice=document.getElementById('bidPrice'+i).value;
  var xmlhttp=getXmlHttpObject();
  xmlhttp.onreadystatechange=function(){
  if(xmlhttp.readyState==4&&xmlhttp.status==200)
  {
     document.getElementById(id).innerHTML=xmlhttp.responseText;
  }
  }
  var url='sendRequest.php?productId='+productId+'&bidPrice='+bidPrice;
  xmlhttp.open('GET',url,true);
  xmlhttp.send();
  document.getElementById('forBid'+i).innerHTML="";
  othersStatus(productId,i);
}

function othersStatus(productId,i)
{
  var xmlhttp=null;
  var id="othersStatus"+i;
  var xmlhttp=getXmlHttpObject();
  xmlhttp.onreadystatechange=function(){
  if(xmlhttp.readyState==4&&xmlhttp.status==200)
  {
     document.getElementById(id).innerHTML=xmlhttp.responseText;
  }
  }
  var url='othersStatus.php?productId='+productId;
  xmlhttp.open('GET',url,true);
  xmlhttp.send();
  }
</script>



<div class="container-fluid" style="background-image: url(images/background_by_hadouuuken-dc9yxs6.png);">
  <div class="container-fluid" sstyle="background-image: url(images/background_by_hadouuuken-dc9yxs6.png);">
    <div class="col-lg-offset-4 col-md-offset-4">
      <div class="dropdown pull-left">
          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Hot Esy<span class="caret"></span></button>
            <ul class="dropdown-menu">
              <li><button class onClick="load('phones')"> Sleeping ESY </button></li>
                <li><button onClick="load('laptops')"> In Bed ESY </button></li>
            </ul>
        </div>
 
        <div class="dropdown pull-left">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Deluxe Esy <span class="caret"></span></button>
            <ul class="dropdown-menu">
              <li><button onClick="load('books')"> With Friends </button></li>
                <li><button onClick="load('notes')"> Pogi Selfies </button></li>
            </ul>
        </div>
 
        <div class="dropdown pull-left">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Hot Esy <span class="caret"></span></button>
            <ul class="dropdown-menu">
              <li><button onClick="load('cycle (boys)')"> shirtless </button></li>
                <li><button onClick="load('cycle (girls)')"> nudes </button></li>
            </ul>
        </div>
        
        <div class="dropdown pull-left">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Budget ESy <span class="caret"></span></button>
            <ul class="dropdown-menu">
              <li><button onClick="load('bucket')"> 7-11 ESy </button></li>
                <li><button onClick="load('mattress')"> Don Pepot's ESy </button></li>
            </ul>
        </div>
     </div>
 </div>

<div id="left" class="col-lg-3 col-md-3 col-sm-3 col-xs-3 >
    <?php
       $fp=fopen("itemlist.txt","r");
       $a;
       while($read=fgets($fp))
       {
          require_once('include/config.inc.php');
          require_once('include/connect.inc.php');
          $read=trim($read);
          $query="select COUNT(*) from products where category=? and userId!=?";
          try{
          $query_prepare=$conn->prepare($query);
          $query_prepare->execute(array($read,$_SESSION['ID']));
          $row=$query_prepare->fetch();
          $a[$read]=$row['COUNT(*)'];
          }
          catch(PDOException $e)
          {
             echo 'some error occured',$e->getMessage();
          } 
       }
       fclose($fp);
       arsort($a);
	   $i=1;
       foreach($a as $key=>$value)
       {
          if($value==0)
          	continue;
          echo '<button class="btn btn-sm btn-primary" onClick="load(\''.$key.'\');">'.$key.'</button>';
          echo '<b>'.$value.' uploads</b><br>';
		  if($i==10){
		  	 break;
		  }
		  $i++;
       }
    ?>
    </div>
    <div class="container-fluid col-lg-6 col-md-6 col-sm-6 col-xs-6" id="center" >
    </div>
</div>
</body>
</html>

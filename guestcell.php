<?php
  session_start();
  if(!isset($_SESSION['ID']))
  // Dependencies
  //header("Location:index.php");
  require_once('commonbar.php');
  require_once('defaultnavigation.php');
  showheader("BUY");
  shownavigation();
?>
  <!-- Javascript Code -->
  <script type="text/javascript">

  var start=0;
  function load(category)
  {
    start=0;
    var xmlhttp = getXmlHttpObject();
    xmlhttp.onreadystatechange = function()
    {
      if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
      {
         document.getElementById("center").innerHTML = xmlhttp.responseText;
      }
    }
    var url = 'getProduct.php?pname=' + category + '&start=' + start;
    xmlhttp.open('GET',url,true);
    xmlhttp.send();
  }

  function increment(category)
  {
    start = start + 3;
    var xmlhttp = getXmlHttpObject();
    xmlhttp.onreadystatechange = function()
    {
      if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
      {
         document.getElementById("center").innerHTML = xmlhttp.responseText;
      }
    }
    var url = 'getProduct.php?pname=' + category + '&start=' + start;
    xmlhttp.open('GET',url,true);
    xmlhttp.send();
  }

  function decrement(category)
  {
    start=start-3;
    var xmlhttp=getXmlHttpObject();
    xmlhttp.onreadystatechange=function()
    {
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
    xmlhttp.onreadystatechange=function()
    {
      if(xmlhttp.readyState==4&&xmlhttp.status==200)
      {
         document.getElementById(id).innerHTML=xmlhttp.responseText;
      }
    }
    var url = 'sendRequest.php?productId=' + productId + '&bidPrice=' + bidPrice;
    xmlhttp.open('GET',url,true);
    xmlhttp.send();
    document.getElementById('forBid' + i).innerHTML = "";
    othersStatus(productId,i);
  }

  function othersStatus(productId,i)
  {
    var xmlhttp = null;
    var id = "othersStatus"+i;
    var xmlhttp = getXmlHttpObject();
    xmlhttp.onreadystatechange = function()
    {
      if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
      {
         document.getElementById(id).innerHTML = xmlhttp.responseText;
      }
    }
    var url = 'othersStatus.php?productId=' + productId;
    xmlhttp.open('GET',url,true);
    xmlhttp.send();
    }
</script>

<!-- CONTAINER -->
<div class="container-fluid" id="background" style="background-color: cyan; display: block; margin-left: auto; margin-right: auto; background-position: 35% 50%;background-repeat: no-repeat; background-size: cover; height: 100%;">
  <div class="container-fluid">
    <div class="col-lg-12">
      <br>
      <!--
      <div class="col-lg-3">
          <ul class="nav nav-pills nav-stacked">
              <li class="active">Home</li>
              <li>Sleeping</li>
              <li>In Bed</li>
          </ul>
      </div>
      -->

      <div class="col-lg-3">
          <!--<button class="btn btn-primary dropdown-toggle col-lg-2" type="button"" style="width: 200%;">Hot<span class="caret"></span></button>-->
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="guestcell.php" style="font-family: Roboto; font-size: 125%">Plain</a></li>
                <li><a onclick="load('Sleeping')">Sleeping</a></li>
                <li><a onclick="load('Group')">Group</a></li>
            </ul>
      </div>

      <div class="col-lg-3">
          <!--<button class="btn btn-primary dropdown-toggle col-lg-2" type="button"" style="width: 200%;">Hot<span class="caret"></span></button>-->
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="guestcell.php" style="font-family: Roboto; font-size: 125%">Pogi</a></li>
                <li><a onclick="load('Flex')">Flex</a></li>
                <li><a onclick="load('Gym')">Solo</a></li>
            </ul>
      </div>

      <div class="col-lg-3">
          <!--<button class="btn btn-primary dropdown-toggle col-lg-2" type="button"" style="width: 200%;">Hot<span class="caret"></span></button>-->
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="guestcell.php" style="font-family: Roboto; font-size: 125%">Normal</a></li>
                <li><a onclick="load('Selfies')">Selfies</a></li>
                <li><a onclick="load('Pair')">Pair</a></li>
            </ul>
      </div>

      <div class="col-lg-3">
          <!--<button class="btn btn-primary dropdown-toggle col-lg-2" type="button"" style="width: 200%;">Hot<span class="caret"></span></button>-->
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="guestcell.php" style="font-family: Roboto; font-size: 125%">Hot</a></li>
                <li><a onclick="load('Shirtless')">Shirtless</a></li>
                <li><a onclick="load('Photoshoot')">Photoshoot</a></li>
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
          $query="select COUNT(*) from products where category= ? and userId != ?";
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
          echo '<button class="btn btn-sm btn-primary" hidden onClick="load(\''.$key.'\');">'.$key.'</button>';
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

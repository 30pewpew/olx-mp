<script>
function getXmlHttpObject()
{
  var xmlhttp = null;
  try
  {
     xmlhttp = new XMLHttpRequest();     
  }
  catch(e)
  {
     try
     {
      xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
     }
     catch(e)
     {
       xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
     }
  }
  return xmlhttp;
}
function getNotifications()
{
	  var xmlhttp = null;
	  var id = "notifications";
	  var xmlhttp = getXmlHttpObject();
	  xmlhttp.onreadystatechange = function(){
	  if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
	  {
		 document.getElementById(id).innerHTML = xmlhttp.responseText;
	  }
	  }
	  if(document.getElementById('getNotifications').innerHTML == 'Notifications')
	  {
		  var url = 'getNotifications.php';
		  xmlhttp.open('GET',url,true);
		  xmlhttp.send();
		  document.getElementById('getNotifications').innerHTML = 'Hide Notifications';
	  }
	  else
	  {
		  document.getElementById(id).innerHTML = '';
		  document.getElementById('getNotifications').innerHTML = 'Notifications';
	  }
 }
</script>

<?php
function shownavigation(){
	?>
        <div class="container-fluid" style="background-color: #c0ded9">
          <div class="col-lg-12">
            <ul class="nav nav-pills nav-justified">
                <li><a href="cell.php" style="font-family: Roboto; font-size: 150%">Buy Products</a></li>
                <li><a href="auction.php" style="font-family: Roboto; font-size: 150%">Auction</a></li>
                <li><a href="sell.php" style="font-family: Roboto; font-size: 150%">Sell</a></li>
                <li><a href="myProfile.php" style="font-family: Roboto; font-size: 150%">Edit Profile</a></li>
                <li><a href="auctionrequests.php" style="font-family: Roboto; font-size: 150%">Auction Requests</a></li>
                <li><a href="cart.php" style="font-family: Roboto; font-size: 150%">My Cart</a></li>
                <li><a href="logout.php" style="font-family: Roboto; font-size: 150%">Logout <b>[<?php echo $_SESSION['username']; ?>]</b></a></li>
                <!--
                <div class="col-lg-2 col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-4">
                    <button class="btn btn-primary col-lg-6" onClick="getNotifications();" id="getNotifications" style="margin-left: 155%; position: absolute; margin-top: 0%; height: 41px">Notifications
                    </button>
                <div id="notifications" style="position:absolute; background-color:rgba(192,220,245,1.00); z-index:1000"></div>
                </div>
              -->
            </ul>  
          </div>
        </div>
	<?php
}
?>

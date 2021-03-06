<?php
  session_start();
  if(!isset($_SESSION['ID']))
  header('Location:index.php');
  if(isset($_GET['pname']) && !empty($_GET['pname']) && isset($_GET['start']))
  {
   $product = $_GET['pname'];
   $start = (int)$_GET['start'];

   // Dependencies
   require_once('include/config.inc.php');
   require_once('include/connect.inc.php');
?>
  <!-- Javascript code -->
  <script type="text/javascript">
    // With JQuery
    $("#ex24").slider({});
  </script>
<?php
   try
   {
      $query = 'SELECT COUNT(*) FROM products WHERE category = ? and userId != ? ';
      $query_prepare = $conn-> prepare($query);
      $query_prepare -> execute(array($product,$_SESSION['ID'])); // PDOStatement object
      $rows = $query_prepare -> fetch();
      $total_pages = ((int)($rows['COUNT(*)']/3)==($rows['COUNT(*)']/3))?($rows['COUNT(*)']/3):(int)($rows['COUNT(*)']/3)+1;

      if($total_pages == 0)

         $total_pages = 1;
         $query = 'SELECT * FROM products WHERE category = ? and userId != ? limit '. $start .',3';
         $query_prepare = $conn -> prepare($query);
         $query_prepare -> execute(array($product,$_SESSION['ID'])); // PDOStatement object
         $rows = $query_prepare -> fetchAll();
         $num_rows = count($rows);
         $i = 1;

    foreach($rows as $row)
    {
        $query1 = 'SELECT COUNT(*) FROM requests WHERE productId = ? and buyerID = ?';
        $query_prepare1 = $conn -> prepare($query1);
        $query_prepare1 -> execute(array($row['productId'],$_SESSION['ID'])); // PDOStatement object
        $row1 = $query_prepare1 -> fetch();
        echo '<div id="'. $i .'" class="container-fluid well" style="width: 203%">';
        // style="margin-right: -103%"
        echo '<div class="row col-lg-5 col-md-5 col-sm-5 col-xs-5"><image src="uploads/'.$row['productId'].'.jpg" height="250" width="250" alt="image not found" style="border-radius:5%"></div>';
        echo '<div class="row col-lg-7 col-md-7 col-sm-7 col-xs-7"><p><b>Category: </b>'.$row['category'].'</p>';
        echo '<p><b>Description: </b>'.$row['description'].'</p>';
        echo '<p><b>Price: </b>'.$row['minPrice']. ' PHP'.'</p>';
        echo '<p><b>Time Uploaded: </b>'.$row['uploadedTime'].'</p>';

        if($row1['COUNT(*)']==0)
        {
            echo '<div id="forBid'.$i.'" class="form-inline">';
            //echo '<input type="text" class="form-control" id="bidPrice'.$i.'" value="'.$row['minPrice'].'">';
            echo '</div>';

        }
?>
   <div id="<?php echo 'othersStatus'.$i;?>">
   <?php
   $query2='select COUNT(*),max(bidPrice) from requests where productId=?';
     $query_prepare2=$conn->prepare($query2);
     $query_prepare2->execute(array($row['productId'])); // PDOStatement object
     $row2=$query_prepare2->fetch();
   if($row2['COUNT(*)']==0){
    $stock = rand(1,20);
    echo '<p><b>Stock: </b>'.$stock.'</p>';
    echo '<form action="purchasehistory.php">';
    echo '<button class="btn btn-md btn-primary" onClick="sendRequest('.$row['productId'].','.$i.')">Buy</button>';
    echo '</form>';

    echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Leave a review</button>';
      echo '<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">';
        echo '<div class="modal-dialog modal-dialog-centered" role="document">';
          echo '<div class="modal-content">';
            echo '<div class="modal-header">';
              echo '<h5 class="modal-title" id="exampleModalLongTitle">Rate Product (1 - 5)</h5>';
              echo '<input type="range" min="1" max="5" step="1">';
              echo '<p>Leave a comment</p>';
              echo '<textarea rows="4" cols="50"></textarea>';
              echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                echo '<span aria-hidden="true">&times;</span>';
              echo '</button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '</div>';
            echo '<div class="modal-footer">';
              echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
              echo '<button type="button" class="btn btn-primary">Save changes</button>';
            echo '</div>';
          echo '</div>';
        echo '</div>';
      echo '</div>';
   }
   else
   {
      $stock = rand(1, 20);
      echo '<p><b>Stock: </b>'.$stock.'</p>';
      echo '<form action="purchasehistory.php">';
      echo '<button class="btn btn-md btn-primary" onClick="sendRequest('.$row['productId'].','.$i.')">Buy</button>';
      echo '</form>';

      echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Leave a review</button>';
      echo '<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">';
        echo '<div class="modal-dialog modal-dialog-centered" role="document">';
          echo '<div class="modal-content">';
            echo '<div class="modal-header">';
              echo '<h5 class="modal-title" id="exampleModalLongTitle">Rate Product (1 - 5)</h5>';
              echo '<input type="range" min="1" max="5" step="1">';
              echo '<p>Leave a comment</p>';
              echo '<textarea rows="4" cols="50"></textarea>';
              echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                echo '<span aria-hidden="true">&times;</span>';
              echo '</button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '</div>';
            echo '<div class="modal-footer">';
              echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
              echo '<button type="button" class="btn btn-primary">Save changes</button>';
            echo '</div>';
          echo '</div>';
        echo '</div>';
      echo '</div>';
   }
   echo '</div>';
   ?>
    </div>
   <div class="container-fluid" id="<?php echo 'showStatus'.$i;?>">
      <?php if($stock == 1) echo '<p><b>Low stock!</b></p>' ; ?></div>
   <?php
   echo '</div>';
   $i++;
   //}
   }
   /*if($i==1)
   echo 'you have already sent request to all of them';
   else
   {*/
   $current_page=(int)($start/3)+1;
   if($current_page==1 && $total_pages!=1)
     echo '<button class="btn btn-success" onClick="increment(\''.$product.'\')">Next</button>';
   else if($current_page<$total_pages)
   {
     echo '<button class="btn btn-success" onClick="decrement(\''.$product.'\')">Previous</button>';
   echo '<button class="btn btn-default" onClick="increment(\''.$product.'\')">Next</button>';
   }
   else if($current_page==$total_pages&&$total_pages!=1)
     echo '<button class="btn btn-success" onClick="decrement(\''.$product.'\')">Previous</button>';  
  //)
   $conn=null;
   }
    catch(PDOException $e)
   {
   die('some error occured:'.$e->getMessage());
   }
  }
else
echo 'some error occur';
?>
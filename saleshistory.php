<?php
session_start();
if(!isset($_SESSION['ID']))
header('Location:index.php');
require_once('include/config.inc.php');
require_once('include/connect.inc.php');
?>

<div class="container-fluid" style="background-color: #ffa500;" >
        <h2 style="text-align:center">Your Items for Auction</h2>
        <?php
            try{
				//	getting the sold 
                $query="SELECT * FROM saleshistory WHERE userId=?";
                $query_prepare=$conn->prepare($query);
                $query_prepare->execute(array($_SESSION['ID']));
				 $rows=$query_prepare->fetchAll();
				 $i=1;	
                foreach($rows as $row)
                {
                     $pos='./uploads/'.$row['productId'].'.jpg';
                  ?>
                    <div class="container-fluid well col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-2" id="<?php echo $i;?>"  style="background-color: #d3d3d3;">
                      
                          <div class="row col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <image src="<?php echo $pos ;?>" height="250" width="250" alt="image not found" style="border-radius:5%">
                            </div>
                          <div class="row col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <p><?php echo '<b>Product Name: </b>'.$row['title'];?></p>
                                <p><?php echo '<b>Description: </b>'.$row['description'];?></p>
                                <p><?php echo '<b>Base price: </b>'.$row['minPrice'];?></p>
                                <button id="requests<?php echo $i;?>" class="btn btn-primary" onClick="showRequests(<?php echo $row['productId'];?>,<?php echo $i;?>);">See Requests</button>;
                            </div>
                        
                            <div class="container col-lg-12 col-md-12 col-sm-12 col-xs-12" id="showRequests<?php echo $i;?>">
                            </div>
                    </div>
                  
                    <?php
                 $i++; 
                }
            }
            catch(PDOException $e)
            {
                echo 'some error occur ',$e->getMessage();
            }
            ?>
    </div>
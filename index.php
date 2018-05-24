<?php
    session_start();

    if(isset($_SESSION['ID']))
    {
        header('Location:cell.php');
    }

    // Stores result of login
    $string1="";

    // Stores result of create account
    $string2="";

    // On Login click
    if (isset($_POST['login_submit']))
    {
      if(isset($_POST['username']) && isset($_POST['password']))
      {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        if(!empty($username) && !empty($password))
        {
          // Database connection
          require_once('include/config.inc.php');
          require_once('include/connect.inc.php');

          // Database query
          $query="SELECT * FROM users WHERE username = ? and password = PASSWORD(?)";

          try
          {
              // PDO Statement Object
              $query_prepare = $conn -> prepare($query);
              $query_prepare -> execute(array($username, $password));
              $rows=$query_prepare -> fetchAll();
              $num_rows = count($rows);

              if($num_rows == 1)
              {
                $_SESSION['ID'] = $rows[0]['id'];
                $_SESSION['username'] = $rows[0]['username'];
                header("Location:cell.php");
              }

              else
              
                $string1 = 'Passwords did not match';
              }

              catch (PDOException $e)
              {
                 $string1 = 'An error occured:'. $e -> getMessage();
              }
              $conn = null;
        }
        else

        $string1 = 'Please supply both username and password';
        }
      }

      else if (isset($_POST['signin_submit']))
      {
        if(isset($_POST['new_username']) && isset($_POST['new_password']) && isset($_POST['email']) && isset($_POST['new_confpassword']) && isset($_POST['new_userfullname']) && isset($_POST['new_userphoneno'])) 
        {
          $username = $_POST['new_username'];
          $password = $_POST['new_password'];
          $email = $_POST['email'];
          $confpassword = $_POST['new_confpassword'];
          $phoneno = $_POST['new_userphoneno'];
          $fullname = strtoupper($_POST['new_userfullname']);

          if(!empty($username) && !empty($email) && !empty($password) && !empty($confpassword))
          {
            if($password === $confpassword)
            {
              require_once('include/config.inc.php');
              require_once('include/connect.inc.php');
              $query="SELECT * FROM users WHERE username = ?";

              try
              {
                $query_prepare = $conn -> prepare($query);
                $query_prepare -> execute(array($username));
                $rows = $query_prepare -> fetchAll();

                if(count($rows) == 0)
                {
                    $query = "INSERT INTO users(username,password,name,phoneno,emailAddress) VALUE (?,password(?),?,?,?)";
                    $query_prepare = $conn -> prepare($query);
                    $query_prepare -> execute(array($username,$password,$fullname,$phoneno,$email)); // PDOStatement object
                    $string2 = "Account Successfully Created";
                 }

                else
                {
                    $string2 = "Username Already Exists";
                }
              }

              catch(PDOException $e)
              {
                 $string2 = 'Oops! An error occured:' . $e -> getMessage();
              }
              $conn = null;
          }
          else
              $string2 = "Passwords did not match";
          }
        else
            $string2 = "Some fields are empty";
        }
      }
  else;
?>

<?php 
  require_once('commonbar.php');
  showheader("home");
?>
        <!-- 786px -->
        <div class="row" style="background-image: url(uploads/40.jpg); display: block; margin-left: auto; margin-right: auto; background-position: center center;background-repeat: no-repeat; background-size: cover; height: 81.4vh;">
            <div class="well col-lg-4 col-md-4 col-sm-4 col-xs-4 col-lg-offset-1 col-md-offset-1 col-xs-offset-1 col-sm-offset-1" style="margin-top: 25px; margin-left: 25px; padding: 30px;">



                <a href="index.php"> 
                    <img src = "images/esy_buys.png" style="margin-left: 17%; margin-top: -5%; width: 375px; height: 105px;">
                    </img>
                </a>

                
                <br>
                <br>
                <h4 style="text-align:center; margin-top: -2%;"><span class="label label-default">BUY</span> <span class="label label-default">SELL</span> <span class="label label-default">LEND</span> <span class="label label-default">BORROW</span></h4>
                
                <!-- CREATE ACCOUNT-->
                <h2>REGISTER <span class="glyphicon glyphicon-exclamation-sign"></span></h2>
                <form action="index.php" method="post">
                    <div class="form-group">
                        <span class="glyphicon glyphicon-user"></span>
                        <label for="username">Username:</label>
                        <input type="text" name="new_username" class="form-control" value="" maxlength="30" placeholder="Enter a username" required>
                    </div>

                    <div class="form-group">
                        <span class="glyphicon glyphicon-edit"></span>
                        <label for="fullname">Name:</label>
                        <input type="text" name="new_userfullname" class="form-control" value="" maxlength="30" placeholder="Enter full name" required>
                    </div>

                    <div class="form-group">
                        <span class="glyphicon glyphicon-earphone"></span>
                        <label for="phoneno">Phone number: </label>
                        <input type="text" name="new_userphoneno" class="form-control" value="" maxlength="10" placeholder="+63 " required>
                    </div>

                    <div class="form-group">
                        <span class="glyphicon glyphicon-home"></span>
                        <label for="address">Address: </label>
                        <input type="text" name="new_useraddress" class="form-control" value="" maxlength="10" placeholder="Enter your own address " required>
                    </div>
                    
                    <div class="form-group">
                        <span class="glyphicon glyphicon-envelope"></span>
                        <label for="EMAIL">Email: </label>
                        <input type="email" name="email" class="form-control" maxlength="41" placeholder="Enter valid email" required>
                    </div>
                    
                    <div class="form-group">
                        <span class="glyphicon glyphicon-lock"></span>
                        <label for="password">Password: </label>
                        <input type="password" name="new_password" class="form-control" maxlength="41" placeholder="Password must be at least 6 characters" required>
                    </div>
                    
                    <div class="form-group">
                        <span class="glyphicon glyphicon-ok-sign"></span>
                        <label for="password">Confirm Password: </label>
                        <input type="password" name="new_confpassword" class="form-control" maxlength="41" placeholder="Enter password again" required>
                    </div>
                    <button input type="submit" name="signin_submit" class="btn btn-lg btn-danger">Create Account</button>             
                </form>
            </div>
            
            <!-- LOGIN -->           
            <div class="well col-lg-3 col-md-3 col-sm-3 col-xs-3 col-lg-offset-3 col-md-offset-3 col-xs-offset-3 col-sm-offset-3" style="margin-top: 175px; margin-left: 39%; padding: 35px">
                <h3 style="underline">LOGIN <span class="glyphicon glyphicon-ok"></span></h3>
                <form action="index.php" method="post">
                    <div class="form-group">
                        <span class="glyphicon glyphicon-user"></span>
                        <label for="username">Username: </label>
                        <input type="text" name="username" class="form-control" value="<?php if(isset($_POST['username'])) echo $_POST['username'];?>" maxlength="30" placeholder="Enter a username" required>
                    </div>
                    
                    <div class="form-group">
                        <span class="glyphicon glyphicon-lock"></span>
                        <label for="password">Password: </label>
                        <input type="password" name="password" size="4" class="form-control" maxlength="41" placeholder="Password must be at least 6 characters" required>
                    </div>
                    
                    <button input type="submit" name="login_submit" class="btn btn-primary">Login</button>
                    <a href="forgotpassword.php">Forgot Password?</a>
                </form>
            </div>
                        
            <?php
                if($string1 != "")
                {
                   echo '<div class="warning">'. $string1 . '</div>';
                }
                  
                if($string2 != "")
                {
                    echo '<div class="warning">' . $string2 . '</div>';
                }
                    
                echo '</div>';
            ?>
          </div>
        </div>    
    </body>
</html>
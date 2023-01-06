<?php


include('includes/config.php');
include('includes/db.php');
include('includes/functions.php');

$msg = "";

if (isset($_GET['reset'])) {
    if (mysqli_num_rows(mysqli_query($db, "SELECT * FROM users WHERE code='{$_GET['reset']}'")) > 0) {
        if (isset($_POST['changepassword'])) {
            $password = mysqli_real_escape_string($db, md5($_POST['password']));
            $confirm_password = mysqli_real_escape_string($db, md5($_POST['confirm-password']));

            if ($password === $confirm_password) {
                $query = mysqli_query($db, "UPDATE users SET password='{$password}', code='' WHERE code='{$_GET['reset']}'");

                if ($query) {
                    header("Location: index.php");
                }
            } else {
                $msg = "<div class='alert alert-danger'>Password and Confirm Password do not match.</div>";
            }
        }
    } else {
        $msg = "<div class='alert alert-danger'>Reset Link do not match.</div>";
    }
} else {
    header("Location: forgot_password.php");
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
   
    <title>Hyprep Educational Support for Ogonis</title>

    <!-- Bootstrap core CSS -->
    
   <!-- <link href="css/main.css" rel="stylesheet">-->
     <link href="css/bootstrap.css" rel="stylesheet">-->

  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">ORM Consult & Ltd</a>
          <img src="images/ormconsult.jpg" width="50" height="50" alt="">
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
          <li><a href="hyprep/index.php">Home</a></li>
            <li><a href="logout.php">Logout</a></li>

          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
<br>
    <div class="container">
        <div class="container-fluid">
        </br>
        <img src="images/hyprep.jfif" alt="hypreplogo" width="100" height="100">
        <div class="container-fluid">
          <br>
          <br>
        <?php echo $msg; ?>

        <form  action="" method="post" style="margin-top:35px;">
         <h2>Change Password</h2>
        
         <hr>
         <div class="form-group">
    <label>Current Password</label>
    <input type="password" name="password" class="form-control" placeholder="Enter Your New Password" required>
  </div>
     
  <div class="form-group">
    <label for="exampleInputNewPassword">New Password</label>
    <input type="password" name="confirm-password" class="form-control" placeholder="Confirm Your New Password" required>
  </div>
 
  <button type="submit" name="changepassword" class="btn btn-primary">Change Password</button>
  </br>
         </br>
  <div class="container-fluid">
  <p>Back to! <a href="index.php">Login</a>.</p>
</div>
</form>







        </div>
    </br>
</div>

<br>
</div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
   
    
  </body>
</html>


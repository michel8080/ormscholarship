<?php

session_start();
if (isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: myaccount.php");
    die();
}

include 'includes/config.php';
include 'includes/db.php';
include 'includes/functions.php';

$msg = "";

if (isset($_GET['verification'])) {
    if (mysqli_num_rows(mysqli_query($db, "SELECT * FROM users WHERE code='{$_GET['verification']}'")) > 0) {
        $query = mysqli_query($db, "UPDATE users SET code='' WHERE code='{$_GET['verification']}'");

        if ($query) {
            $msg = "<div class='alert alert-success'>Account verification has been successfully completed.</div>";
        }
    } else {
        header("Location: index.php");
    }
}

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, md5($_POST['password']));

    $query = "select * from users where email='$email' AND password='$password'";

    $result = $db->query($query);

    if (mysqli_num_rows($result) === 1) {
      $row = mysqli_fetch_assoc($result);

      if (empty($row['code'])) {
          $_SESSION['SESSION_EMAIL'] = $email;
          header("Location: myaccount.php");
      } else {
          $msg = "<div class='alert alert-info'>First verify your account and try again.</div>";
      }
  } else {
      $msg = "<div class='alert alert-danger'>Email or password do not match.</div>";
  }
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Login</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

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
          <a class="navbar-brand" href="/hyprep/index.php">ORM Consult & Ltd</a>
          <img src="images/ormconsult.jpg" width="50" height="50" alt="">
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
          <li><a href="hyprep/index.php">Home</a></li>
            <li class="active"><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
      <br>
    <img src="images/hyprep.jfif" alt="hyprep" width="150" height="72">
    <br>
    <br>
    <?php echo $msg; ?>

    <form action="index.php" method="post" style="margin-top:35px;">
        <h2>Login</h2>

        <?php if (isset($_GET['success'])) {?>

        <div class="alert alert-success"><?php echo $_GET['success']; ?></div>

        <?php }?>

        <?php if (isset($_GET['err'])) {?>

        <div class="alert alert-danger"><?php echo $_GET['err']; ?></div>

        <?php }?>

        <hr>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control" placeholder="Email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" placeholder="Password">
  </div>

  <div class="checkbox">
    <label>
      <input type="checkbox" name="remember_me"> Remember Me
    </label>
  </div>
  <button type="submit" name="login" class="btn btn-primary">Login</button><br>
  <br>
  <div class = "container">
    Forgot Password? <a href = "forgot_password.php">    |  Reset</a>
  </div>
  <div class = "container">
    Create An Account! <a href = "register.php">    |  Sign Up</a>
  </div>
</form>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>

  </body>
</html>


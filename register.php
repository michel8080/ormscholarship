<!-- Code by Brave Coder - https://youtube.com/BraveCoder -->

<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;


session_start();
    if (isset($_SESSION['SESSION_EMAIL'])) {
        header("Location: index.php");
        die();
    }

//Load Composer's autoloader
require 'vendor/autoload.php';

include 'includes/config.php';
include 'includes/db.php';
include 'includes/functions.php';
$msg = "";

if (isset($_POST['register'])) {
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, md5($_POST['password']));
    $confirm_password = mysqli_real_escape_string($db, md5($_POST['confirm_password']));
    $code = mysqli_real_escape_string($db, md5(rand()));
    //$token = bin2hex(openssl_random_pseudo_bytes(32));
    //$token = mysqli_real_escape_string($db, md5(rand()));

    if (mysqli_num_rows(mysqli_query($db, "SELECT * FROM users WHERE email='{$email}'")) > 0) {
        $msg = "<div class='alert alert-danger'>{$email} - This email address has been already exists.</div>";
    } else {
        if ($password === $confirm_password) {
            $sql = "INSERT INTO users (name, email, password, code) VALUES ('{$name}', '{$email}', '{$password}', '{$code}')";
            $result = mysqli_query($db, $sql);

            if ($result) {
                echo "<div style='display: none;'>";
                //Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'devin.com.ng';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'admin@devin.com.ng';                     //SMTP username
                    $mail->Password   = 'cJJ;(1JkFbwk';                               //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                    //Recipients
                    $mail->setFrom('scholarships@ormng.com');
                    $mail->addAddress($email);

                    //Content
                    $mail->isHTML(true); //Set email format to HTML
                    $mail->Subject = 'Activation Email';
                    $mail->Body = 'Here is the verification link <b><a href="http://localhost/hyprepscholarship/?verification='.$code.'">http://localhost/hyprepscholarship/?verification='.$code.'</a></b>';

                    $mail->send();
                    echo 'Message has been sent';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
                echo "</div>";
                $msg = "<div class='alert alert-success'>We've sent a verification link to your email address.</div>";
            } else {
                $msg = "<div class='alert alert-danger'>Something wrong went.</div>";
            }
        } else {
            $msg = "<div class='alert alert-danger'>Password and Confirm Password do not match</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Register</title>

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
          <a class="navbar-brand" href="hyprep/index.php">ORM Consult & Ltd</a>
          <img src="images/ormconsult.jpg" width="50" height="50" alt="">
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
          <li><a href="hyprep/index.php">Home</a></li>
            <li><a href="index.php">Login</a></li>
            <li class="active"><a href="register.php">Register</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
    <br>
    <img src="images/hyprep.jfif" alt="hyprep" width="150" height="72">
    <br>
    <?php echo $msg; ?>
     <form  action="register.php" method="post" style="margin-top:35px;">
         <h2>Register Here</h2>

         <?php if (isset($_GET['err'])) {?>

         <div class="alert alert-danger"><?php echo $_GET['err']; ?></div>

         <?php }?>
         <hr>
         <div class="form-group">
    <label>Name</label>
    <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo @$_SESSION['name']; ?>" required>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo @$_SESSION['email']; ?>" required>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo @$_SESSION['password']; ?>" required>
  </div>

 <div class="form-group">
    <label >Confirm Password</label>
    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" value="<?php echo @$_SESSION['confirm_password']; ?>" required>
  </div>

  <button type="submit" name="register" class="btn btn-primary">Register</button>
  <br>
  <br>
  <div class = "container">
    <p> Have an Account? <a href = "index.php">Login</a>.</p>
  </div>
  <!--<a href="login.php">Have an Account?</a>-->
</form>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>

  </body>
</html>


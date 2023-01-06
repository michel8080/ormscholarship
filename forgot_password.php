<?php

session_start();
if (isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: myaccount.php");
    die();
}

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

include('includes/config.php');
include('includes/db.php');
include('includes/functions.php');
$msg = "";

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $code = mysqli_real_escape_string($db, md5(rand()));

    if (mysqli_num_rows(mysqli_query($db, "SELECT * FROM users WHERE email='{$email}'")) > 0) {
        $query = mysqli_query($db, "UPDATE users SET code='{$code}' WHERE email='{$email}'");

        if ($query) {        
            echo "<div style='display: none;'>";
            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                  //Enable verbose debug output
                $mail->isSMTP();                                        //Send using SMTP
                $mail->Host       = 'devin.com.ng';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                               //Enable SMTP authentication
                $mail->Username   = 'admin@devin.com.ng';               //SMTP username
                $mail->Password   = 'cJJ;(1JkFbwk';                     //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;        //Enable implicit TLS encryption
                $mail->Port       = 465;                                //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('scholarships@ormng.com');
                $mail->addAddress($email);

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Password Reset';
                $mail->Body    = 'Here is the Password Reset link <b><a href="http://localhost/hyprepscholarship/changepassword.php?reset='.$code.'">http://localhost/hyprepscholarship/changepassword.php?reset='.$code.'</a></b>';

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            echo "</div>";        
            $msg = "<div class='alert alert-info'>We've sent a Password Reset link to your email address.</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>$email - This email address is not found.</div>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <title>HYPREP - Forgot Password</title>

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
          <a class="navbar-brand" href="#">ORM Consult & Ltd</a>
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
    <br>
    <?php echo $msg; ?>

     <form  action="" method="post" style="margin-top:35px;">
         <h2>Forgot Password</h2>
        
         <hr>
         <div class="form-group">
     
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control" placeholder="Enter Your Email"  required>
  </div>
  
 
  <button type="submit" name="submit" class="btn btn-primary">Send Reset Link</button>
         </br>
         </br>
  <div class="container-fluid">
  <p>Back to! <a href="index.php">Login</a>.</p>
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


<?php
session_start();
if (!isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: index.php");
    die();
}

include('includes/config.php');
include('includes/db.php');
include('includes/functions.php');

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
            <li><a href="changepassword.php">Change Password</a></li>
            <li><a href="logout.php">Logout</a></li>

          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
    	<div class="jumbotron">
      <h2>Welcome
			<?php $query = mysqli_query($db, "SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL']}'");
      if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        echo $row['name'];
    }
?></h2>
		</div>
        
        <div class="container-fluid">
        </br>
        <img src="images/hyprep.jfif" alt="hypreplogo" width="200" height="100">
        <div class="container-fluid">
            <h3 style="font-weight:bold">Welcome to HYPREP Scholarship for only Ogonis who are in their </br>Final Year carrying out their research project</h3>
            <h2 style="text-align:left; font-weight:bold; color:red"> INSTRUCTIONS </h2>
            <h4 style="color:green">Please ensure you have all needed data and document before proceeding to fill this application.</h4>
        </div>
    </br>
<ul style="font-size:18px">
<li> Please ensure that you fill in all the required sections by the left side of your screen.</li>
<li> Also, ensure that all your document are to the required size.</li>
<li> Ensure your bank account details have no issues.</li>
<li> Please make sure you are actually in your Final Year already carrying out your project.</li>
<li> You can always come back to your page to update your data before the application closing date.</li>
<li> When you submit your application, you will get an application number that starts with "HYPREP" before the next day.</li>
</br> <b>We wish you good luck in your application process.</b>

</ul>
</div>
<div class="container-fluid" style=text-align:center">
    <a class="btn btn-primary btn-lg" href="hyprepscholarship.php" role="button">CLICK HERE TO START YOUR APPLICATION PROCESS</a>
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


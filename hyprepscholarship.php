
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
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>HYPREP - Educational Support For Ogonis</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="images/ORMLogo.jpg" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <div class="border-end bg-white" id="sidebar-wrapper">
                <div class="sidebar-heading border-bottom bg-light">ORM Consult & Ltd</div>
                <img src="images/ormconsult.jpg" alt="orm_logo" width="52" height="52" style="align:center">
                <div class="list-group list-group-flush">
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="personalinfo.php">Add Personal Info</a>
                    <!--<a class="list-group-item list-group-item-action list-group-item-light p-3" href="editpersonalinfo.php">Edit Personal Info</a>-->
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="educationalinfo.php">Add Educational Info</a>
                    <!--<a class="list-group-item list-group-item-action list-group-item-light p-3" href="editeducationalinfo.php">Edit Educational Info</a>-->
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="bankinfo.php">Add Bank Info</a>
                    <!--<a class="list-group-item list-group-item-action list-group-item-light p-3" href="editbankinfo.php">Edit Bank Info</a>-->
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="documentinfo.php">Document Upload</a>
                    <!--<a class="list-group-item list-group-item-action list-group-item-light p-3" href="editdocumentinfo.php">Edit Document</a>-->
                </div>
            </div>
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
                <!-- Top navigation-->
                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                    <div class="container-fluid">
                        <button class="btn btn-primary" id="sidebarToggle">Toggle Menu</button>
                        <h6>Welcome
			<?php $query = mysqli_query($db, "SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL']}'");
      if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        echo $row['name'];
    }
?></h6>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                           
                            <li class="nav-item active"><a class="nav-link" href="hyprep/index.php">Home</a></li>
                                <li class="nav-item"><a class="nav-link" href="changepassword.php">Change Password</a></li>
                                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                             
                                <!--<li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="#!">Action</a>
                                        <a class="dropdown-item" href="#!">Another action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#!">Something else here</a>
                                    </div>
                                </li>-->
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- Page content-->
                <div class="container-fluid">
                <img src="images/Hyprep.jfif" alt="orm_logo" width="120" height="82" style="align:center">
                    <h1 class="mt-4">HYPREP - Educational Support For Ogonis - 2022-2023</h1>
                    <h5 style="color:red; font-weight: bold;">INSTRUCTIONS: PLEASE READ THESE INSTRUCTIONS BELOW BEFORE PROCEEDING.</h5>
                    <hr>
                    <h5>Once again, ensure you carefully fill each required sections that will pop up as a link after you might have submitted a section successfully. It is only when you have done so you will get an application number sent to your registered active email address.</h5>
                    
                        <h5> Make sure <b style="color:red">ALL DATA</b> provided by you is accurate and valid. It is must be your <b style="color:red">PERSONAL ACTIVE EMAIL ADDRESS </b>and <b style="color:red">PHONE NUMBER</b> that must be used during this application process.</h5>
                        <hr>
                        <h5 style="color:green"> ONCE AGAIN GOOD LUCK AS YOU APPLY!<h5>
                
                
                
                    </div>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>

<?php

session_start();
if (!isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: index.php");
    die();
}

include 'includes/config.php';
include 'includes/db.php';
include 'includes/functions.php';

$msg = "";

$dsn = "mysql:host=localhost; dbname=registration";
$db_user = "root";
$db_password = "";

//Create Connection with exception handling
try {
	$db = new PDO($dsn, $db_user, $db_password);
	
//Set Error Mode
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//ho "Connected <hr><br>";

//Insert Data

if (isset($_REQUEST['save'])) {
    $School = $_REQUEST['School'];
    $MatricNo = $_REQUEST['MatricNo'];
	$Faculty = $_REQUEST['Faculty'];
	$Course = $_REQUEST['Course'];
    $CourseDuration = $_REQUEST['CourseDuration'];
	$AdmissionYr= $_REQUEST['AdmissionYr'];
	$GraduationYr = $_REQUEST['GraduationYr'];
	$ProjectTitle = $_REQUEST['ProjectTitle'];
	$Supervisor = $_REQUEST['Supervisor'];
	$SupervisorPhone = $_REQUEST['SupervisorPhone'];
	$SupervisorEmail = $_REQUEST['SupervisorEmail'];
	$Email = $_REQUEST['Email'];
    $sql = "INSERT INTO educationalinfo (School, MatricNo, Faculty, Course, CourseDuration, AdmissionYr, GraduationYr, ProjectTitle, Supervisor, SupervisorPhone, SupervisorEmail, Email) VALUES ('$School', '$MatricNo', '$Faculty', '$Course', '$CourseDuration', '$AdmissionYr', '$GraduationYr', '$ProjectTitle', '$Supervisor', '$SupervisorPhone', '$SupervisorEmail', '$Email')";
    $affected_row = $db->exec($sql);
	//echo"Data Inserted<br>";
    echo "</div>";
    $msg = "<div class='alert alert-success'>Updated Successfully!</div>";
 }
}
 catch(PDOException $e){
	 echo "Connection Failed" . $e->getMessage();
 }
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
        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <div class="border-end bg-white" id="sidebar-wrapper">
                <div class="sidebar-heading border-bottom bg-light">ORM Consult & Ltd</div>
                <img src="images/ormconsult.jpg" alt="orm_logo" width="52" height="52" style="align:center">
                <div class="list-group list-group-flush">
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="hyprepscholarship.php">Back to Home Page</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="educationalinfo.php">Add Educational Info</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="editeducationalinfo.php">Update Educational Info</a>
                    <!--<a class="list-group-item list-group-item-action list-group-item-light p-3" href="educationalinfo.php">Educational Info</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="editeducationalinfo.php">Edit Educational Info</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="bankinfo.php">Bank Info</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="editbankinfo.php">Edit Bank Info</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="documentinfo.php">Document Upload</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="editdocumentinfo.php">Edit Document</a>-->
                </div>
            </div>
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
                <!-- Top navigation-->
                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                    <div class="container-fluid">
                        <button class="btn btn-primary" id="sidebarToggle">Toggle Menu</button>
                        <h6>Welcome
                        <?php $sql= "SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL']}'"; $result = $db->query($sql);
                        if ($result->rowCount() > 0) { $row = $result->fetch(); 
                            echo $row['name'];
                            } ?> </h6>
        
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
    <h2 class="mt-4">UPDATE EDUCATIONAL INFO</h2>
    <br>
    <?php echo $msg; ?>
    <br>
<form method="post" action="educationalinfo.php">
<div class="row">
    <div class="form-group col-md-4">
    <input type="text" class="form-control" name="School" placeholder="Institution" value ="<?php $sql= "SELECT * FROM educationalinfo WHERE email='{$_SESSION['SESSION_EMAIL']}'";
        $result = $db->query($sql);
        if ($result->rowCount() > 0) {
            $row = $result->fetch();
            echo $row['School'];
            } ?>" required>
    </div>

    <div class="form-group col-md-4">
        <input type="text" class="form-control" name="MatricNo" placeholder="Matric No" value ="<?php $sql= "SELECT * FROM educationalinfo WHERE email='{$_SESSION['SESSION_EMAIL']}'";
        $result = $db->query($sql);
        if ($result->rowCount() > 0) {
            $row = $result->fetch();
            echo $row['MatricNo'];
            } ?>" required>
    </div>

    <div class="form-group col-md-4">
        <input type="text" class="form-control" name="Faculty" placeholder="Faculty" value ="<?php $sql= "SELECT * FROM educationalinfo WHERE email='{$_SESSION['SESSION_EMAIL']}'";
        $result = $db->query($sql);
        if ($result->rowCount() > 0) {
            $row = $result->fetch();
            echo $row['Faculty'];
            } ?>" required>
    </div>
</div>
<!-- End of A Row-->
<br>
<div class="row">
    <div class="form-group col-md-4">
        <input type="text" class="form-control" name="Course" placeholder="Course" value ="<?php $sql= "SELECT * FROM educationalinfo WHERE email='{$_SESSION['SESSION_EMAIL']}'";
        $result = $db->query($sql);
        if ($result->rowCount() > 0) {
            $row = $result->fetch();
            echo $row['Course'];
            } ?>" required>
    </div>

    <div class="form-group col-md-4">
    <input type="text" class="form-control" name="CourseDuration" placeholder="Course Duration" value ="<?php $sql= "SELECT * FROM educationalinfo WHERE email='{$_SESSION['SESSION_EMAIL']}'";
        $result = $db->query($sql);
        if ($result->rowCount() > 0) {
            $row = $result->fetch();
            echo $row['CourseDuration'];
            } ?>" required>

    </div>

    <div class="form-group col-md-4">
    <input type="text" class="form-control" name="AdmissionYr" placeholder="Admission Year" value ="<?php $sql= "SELECT * FROM educationalinfo WHERE email='{$_SESSION['SESSION_EMAIL']}'";
        $result = $db->query($sql);
        if ($result->rowCount() > 0) {
            $row = $result->fetch();
            echo $row['AdmissionYr'];
            } ?>" required>

    </div>
</div>
<!-- End of A Row-->
<br>
<div class="row">
    <div class="form-group col-md-4">
    <input type="text" class="form-control" name="GraduationYr" placeholder="Graduation Year" value ="<?php $sql= "SELECT * FROM educationalinfo WHERE email='{$_SESSION['SESSION_EMAIL']}'";
        $result = $db->query($sql);
        if ($result->rowCount() > 0) {
            $row = $result->fetch();
            echo $row['GraduationYr'];
            } ?>" required>

    </div>

    <div class="form-group col-md-4">
        <input type="text" class="form-control" name="ProjectTitle" placeholder="ProjectTitle" value ="<?php $sql= "SELECT * FROM educationalinfo WHERE email='{$_SESSION['SESSION_EMAIL']}'";
        $result = $db->query($sql);
        if ($result->rowCount() > 0) {
            $row = $result->fetch();
            echo $row['ProjectTitle'];
            } ?>" required>
    </div>

    <div class="form-group col-md-4">
    <input type="text" class="form-control" name="Supervisor" placeholder="Supervisor" value ="<?php $sql= "SELECT * FROM educationalinfo WHERE email='{$_SESSION['SESSION_EMAIL']}'";
        $result = $db->query($sql);
        if ($result->rowCount() > 0) {
            $row = $result->fetch();
            echo $row['Supervisor'];
            } ?>" required>

    </div>
</div>
<br>
<!-- End of A Row-->
<div class="row">
    <div class="form-group col-md-4">
        <input type="text" class="form-control" name="SupervisorPhone" maxlength="11" placeholder="SupervisorPhone" value ="<?php $sql= "SELECT * FROM educationalinfo WHERE email='{$_SESSION['SESSION_EMAIL']}'";
        $result = $db->query($sql);
        if ($result->rowCount() > 0) {
            $row = $result->fetch();
            echo $row['SupervisorPhone'];
            } ?>" required>
    </div>

    <div class="form-group col-md-4">
        <input type="email" class="form-control" name="SupervisorEmail" placeholder="SupervisorEnail" value ="<?php $sql= "SELECT * FROM educationalinfo WHERE email='{$_SESSION['SESSION_EMAIL']}'";
        $result = $db->query($sql);
        if ($result->rowCount() > 0) {
            $row = $result->fetch();
            echo $row['SupervisorEmail'];
            } ?>" required>
    </div>

    <div class="form-group col-md-4">
    <input type="hidden" class="form-control" name="Email" placeholder="Email" value ="<?php $sql= "SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL']}'";
        $result = $db->query($sql);
        if ($result->rowCount() > 0) {
            $row = $result->fetch();
            echo $row['email'];
            } ?>" required readonly>
    </div>
</div>
<!-- End of A Row-->
<br>
    <br>
<button type="submit" name="save" class="btn btn-primary">SAVE</button>

</form>

</div>
        <!-- Bootstrap core JS-->
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
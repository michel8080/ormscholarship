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
    $Firstname = $_REQUEST['Firstname'];
    $Middlename = $_REQUEST['Middlename'];
	$Lastname = $_REQUEST['Lastname'];
	$Gender = $_REQUEST['Gender'];
	$Phone = $_REQUEST['Phone'];
	$Email = $_REQUEST['Email'];
	$DOB = $_REQUEST['DOB'];
	$Community = $_REQUEST['Community'];
	$LGA = $_REQUEST['LGA'];
	$ContactAddress = $_REQUEST['ContactAddress'];
	$HomeAddress = $_REQUEST['HomeAddress'];
	$FatherLGACommunity = $_REQUEST['FatherLGACommunity'];
	$MotherLGACommunity = $_REQUEST['MotherLGACommunity'];
	$NOK = $_REQUEST['NOK'];
	$NOKPhone = $_REQUEST['NOKPhone'];
	$NOKEmail = $_REQUEST['NOKEmail'];
    $sql = "UPDATE personalinfo SET (Firstname, Middlename, Lastname, Gender, Phone, Email, DOB, Community, LGA, ContactAddress, HomeAddress, FatherLGACommunity, MotherLGACommunity, NOK, NOKPhone, NOKEmail) VALUES ('$Firstname', '$Middlename', '$Lastname', '$Gender', '$Phone', '$Email', '$DOB', '$Community', '$LGA', '$ContactAddress', '$HomeAddress', '$FatherLGACommunity', '$MotherLGACommunity', '$NOK', '$NOKPhone', '$NOKEmail')";
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
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="personalinfo.php">Add Personal Info</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="editpersonalinfo.php">Update Personal Info</a>
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
    <h2 class="mt-4">UPDATE PERSONAL INFO</h2>
    <br>
    <?php echo $msg; ?>
    <br>
<form method="post" action="personalinfo.php">
<div class="row">
    <div class="form-group col-md-4">
        <input type="text" class="form-control" name="Firstname" placeholder="First Name" value ="<?php $sql= "SELECT * FROM personalinfo WHERE email='{$_SESSION['SESSION_EMAIL']}'";
        $result = $db->query($sql);
        if ($result->rowCount() > 0) {
            $row = $result->fetch();
            echo $row['Firstname'];
            } ?>" required>
    </div>

    <div class="form-group col-md-4">
        <input type="text" class="form-control" name="Middlename" placeholder="Middle Name" value ="<?php $sql= "SELECT * FROM personalinfo WHERE email='{$_SESSION['SESSION_EMAIL']}'";
        $result = $db->query($sql);
        if ($result->rowCount() > 0) {
            $row = $result->fetch();
            echo $row['Middlename'];
            } ?>" required>
    </div>

    <div class="form-group col-md-4">
        <input type="text" class="form-control" name="Lastname" placeholder="Last Name" value ="<?php $sql= "SELECT * FROM personalinfo WHERE email='{$_SESSION['SESSION_EMAIL']}'";
        $result = $db->query($sql);
        if ($result->rowCount() > 0) {
            $row = $result->fetch();
            echo $row['Lastname'];
            } ?>" required>
    </div>
</div>
<!-- End of A Row-->
<br>
<div class="row">
    <div class="form-group col-md-4">
    <input type="text" class="form-control" name="Gender" placeholder="Gender" value ="<?php $sql= "SELECT * FROM personalinfo WHERE email='{$_SESSION['SESSION_EMAIL']}'";
        $result = $db->query($sql);
        if ($result->rowCount() > 0) {
            $row = $result->fetch();
            echo $row['Gender'];
            } ?>" required>
    </div>

    <div class="form-group col-md-4">
        <input type="text" class="form-control" name="Phone" maxlength="11" placeholder="Phone" value ="<?php $sql= "SELECT * FROM personalinfo WHERE email='{$_SESSION['SESSION_EMAIL']}'";
        $result = $db->query($sql);
        if ($result->rowCount() > 0) {
            $row = $result->fetch();
            echo $row['Phone'];
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
<div class="row">
    <div class="form-group col-md-4">
    <input type="date" class="form-control" name="DOB" placeholder="Birth Date. e.g. DD/MM/YYYY" value ="<?php $sql= "SELECT * FROM personalinfo WHERE email='{$_SESSION['SESSION_EMAIL']}'";
        $result = $db->query($sql);
        if ($result->rowCount() > 0) {
            $row = $result->fetch();
            echo $row['DOB'];
            } ?>" required>
    </div>

    <div class="form-group col-md-4">
        <input type="text" class="form-control" name="Community" placeholder="Community" value ="<?php $sql= "SELECT * FROM personalinfo WHERE email='{$_SESSION['SESSION_EMAIL']}'";
        $result = $db->query($sql);
        if ($result->rowCount() > 0) {
            $row = $result->fetch();
            echo $row['Community'];
            } ?>" required>
    </div>

    <div class="form-group col-md-4">
    <input type="text" class="form-control" name="LGA" placeholder="LGA" value ="<?php $sql= "SELECT * FROM personalinfo WHERE email='{$_SESSION['SESSION_EMAIL']}'";
        $result = $db->query($sql);
        if ($result->rowCount() > 0) {
            $row = $result->fetch();
            echo $row['LGA'];
            } ?>" required>

    </div>
</div>
<br>
<!-- End of A Row-->
<div class="row">
    <div class="form-group col-md-4">
        <input type="text" class="form-control" name="ContactAddress" placeholder="Contact Address" value ="<?php $sql= "SELECT * FROM personalinfo WHERE email='{$_SESSION['SESSION_EMAIL']}'";
        $result = $db->query($sql);
        if ($result->rowCount() > 0) {
            $row = $result->fetch();
            echo $row['ContactAddress'];
            } ?>" required>
    </div>

    <div class="form-group col-md-4">
        <input type="text" class="form-control" name="HomeAddress" placeholder="Home Address" value ="<?php $sql= "SELECT * FROM personalinfo WHERE email='{$_SESSION['SESSION_EMAIL']}'";
        $result = $db->query($sql);
        if ($result->rowCount() > 0) {
            $row = $result->fetch();
            echo $row['HomeAddress'];
            } ?>" required>
    </div>

    <div class="form-group col-md-4">
        <input type="text" class="form-control" name="FatherLGACommunity" placeholder="Father LGA/Community" value ="<?php $sql= "SELECT * FROM personalinfo WHERE email='{$_SESSION['SESSION_EMAIL']}'";
        $result = $db->query($sql);
        if ($result->rowCount() > 0) {
            $row = $result->fetch();
            echo $row['FatherLGACommunity'];
            } ?>" required>
    </div>
</div>
<!-- End of A Row-->
<br>
<div class="row">
    <div class="form-group col-md-3">
        <input type="text" class="form-control" name="MotherLGACommunity" placeholder="Mother LGA/Community" value ="<?php $sql= "SELECT * FROM personalinfo WHERE email='{$_SESSION['SESSION_EMAIL']}'";
        $result = $db->query($sql);
        if ($result->rowCount() > 0) {
            $row = $result->fetch();
            echo $row['MotherLGACommunity'];
            } ?>" required>
    </div>

    <div class="form-group col-md-3">
        <input type="text" class="form-control" name="NOK" placeholder="Next of Kin Name" value ="<?php $sql= "SELECT * FROM personalinfo WHERE email='{$_SESSION['SESSION_EMAIL']}'";
        $result = $db->query($sql);
        if ($result->rowCount() > 0) {
            $row = $result->fetch();
            echo $row['NOK'];
            } ?>" required>
    </div>

    <div class="form-group col-md-3">
        <input type="text" class="form-control" name="NOKPhone" maxlength="11" placeholder="Next of Kin Phone" value ="<?php $sql= "SELECT * FROM personalinfo WHERE email='{$_SESSION['SESSION_EMAIL']}'";
        $result = $db->query($sql);
        if ($result->rowCount() > 0) {
            $row = $result->fetch();
            echo $row['NOKPhone'];
            } ?>" required>
    </div>

    <div class="form-group col-md-3">
        <input type="email" class="form-control" name="NOKEmail" placeholder="Next of Kin Email" value ="<?php $sql= "SELECT * FROM personalinfo WHERE email='{$_SESSION['SESSION_EMAIL']}'";
        $result = $db->query($sql);
        if ($result->rowCount() > 0) {
            $row = $result->fetch();
            echo $row['NOKEmail'];
            } ?>" required>
    </div>
</div>
<!-- End of A Row-->
<br>
    <br>
<button type="submit" name="save" class="btn btn-primary">UPDATE</button>

</form>

</div>
        <!-- Bootstrap core JS-->
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
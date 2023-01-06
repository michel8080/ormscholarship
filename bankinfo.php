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
    $bank_name = $_REQUEST['bank_name'];
    $account_name = $_REQUEST['account_name'];
	$account_no = $_REQUEST['account_no'];
	$Email = $_REQUEST['Email'];
    $sql = "INSERT INTO bankinfo (bank_name, account_name, account_no, Email) VALUES ('$bank_name', '$account_name', '$account_no', '$Email')";
    $affected_row = $db->exec($sql);
	//echo"Data Inserted<br>";
	echo "</div>";
    $msg = "<div class='alert alert-success'>Bank Info Saved Successfully!. Click the following link to Upload Document. <b><a href=http://localhost/hyprepscholarship/documentinfo.php>Upload Your Document!</a></b></div>";
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
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="bankinfo.php">Bank Info</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="editbankinfo.php">Edit Bank Info</a>
                    <!--<a class="list-group-item list-group-item-action list-group-item-light p-3" href="documentinfo.php">Document Upload</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="editdocumentinfo.php">Edit Document</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="educationalinfo.php">Add Educational Info</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="editeducationalinfo.php">Edit Educational Info</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="educationalinfo.php">Educational Info</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="editeducationalinfo.php">Edit Educational Info</a>-->
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
    <h2 class="mt-4">BANK INFO</h2>
    <br>
    <?php echo $msg; ?>
    <br>
<form method="post" action="bankinfo.php">
<div class="row">
    <div class="form-group col-md-12">
    <select id="bank_name" name="bank_name" class="form-control">
        <option value="Select Bank" selected>Select Bank</option>
        <option value="Access Bank Plc">Access Bank Plc</option>
        <option value="Citibank Nigeria Limited">Citibank Nigeria Limited</option>
        <option value="Ecobank Nigeria Plc">Ecobank Nigeria Plc</option>
        <option value="Fidelity Bank Plc">Fidelity Bank Plc</option>
        <option value="FIRST BANK NIGERIA LIMITED ">FIRST BANK NIGERIA LIMITED </option>
        <option value="First City Monument Bank Plc ">First City Monument Bank Plc </option>
        <option value="Globus Bank Limited ">Globus Bank Limited </option>
        <option value="Guaranty Trust Bank Plc">Guaranty Trust Bank Plc</option>
        <option value="Fidelity Bank Plc">Fidelity Bank Plc</option>
        <option value="Heritage Banking Company Ltd.">Heritage Banking Company Ltd.</option>
        <option value="Keystone Bank Limited ">Keystone Bank Limited </option>
        <option value="Parallex Bank Ltd">Parallex Bank Ltd</option>
        <option value="Polaris Bank Plc ">Polaris Bank Plc </option>
        <option value="Premium Trust Bank ">Premium Trust Bank </option>
        <option value="Providus Bank">Providus Bank </option>
        <option value="STANBIC IBTC BANK PLC ">STANBIC IBTC BANK PLC  </option>
        <option value="Standard Chartered Bank Nigeria Ltd.  ">Standard Chartered Bank Nigeria Ltd. </option>
        <option value="Sterling Bank Plc">Sterling Bank Plc</option>
        <option value="SunTrust Bank Nigeria Limited">Titan Trust Bank Ltd </option>
        <option value="Heritage Banking Company Ltd.">Union Bank of Nigeria Plc</option>
        <option value="United Bank For Africa Plc  ">United Bank For Africa Plc </option>
        <option value="Unity Bank Plc ">Unity Bank Plc </option>
        <option value="Wema Bank Plc">Wema Bank Plc</option>
        <option value="Zenith Bank Plc">Zenith Bank Plc</option>
      </select>
    </div>
</div>

<br>
<div class="row">
    <div class="form-group col-md-12">
    <input type="text" class="form-control" name="account_name" placeholder="Account Name. It must match with the name you are currently using to apply and also no BVN issues." required>
    </div>
</div>
<br>
<div class="row">
    <div class="form-group col-md-12">
        <input type="text" class="form-control" maxlength="10" name="account_no" placeholder="Account No" required>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-12">
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
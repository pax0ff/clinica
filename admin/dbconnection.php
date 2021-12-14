<?php
require_once("../Utils.php");
//error_reporting(0);
$con=mysqli_connect("localhost", "root", "", "crm");
if(mysqli_connect_errno()){
echo "Connection Fail".mysqli_connect_error();
}

?>

<?php
require_once("../Utils.php");
error_reporting(E_ALL);
$con=mysqli_connect("localhost", "root", "root", "crm");
if(mysqli_connect_errno()){
echo "Connection Fail".mysqli_connect_error();
}

?>

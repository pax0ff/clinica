<?php
session_start();
include("checklogin.php");
check_login();
include("dbconnection.php");
if(isset($_POST['update']))
{
$doctor = $_POST['doctor'];
$cabinet = $_POST['cabinet'];
$data = $_POST['data'];
$oraInt = $_POST['ora_intrare'];
$oraIes = $_POST['ora_iesire'];
$cabinetid=$_GET['id'];
  $ret=mysqli_query($con,"update program_medical set doctor='$doctor',cabinet='$cabinet',data='$data',ora_intrare='$oraInt',ora_iesire='$oraIes' where id='$cabinetid'");
  //print_r($ret);die();
	if($ret)
	{
  echo "<script>alert('Date salvate');</script>";	
  echo "<script>window.location.href = 'schedule_medici.php';</script>";
	}
	}
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="utf-8" />
<title>CRM | Edit </title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta content="" name="description" />
<meta content="" name="author" />
<link href="../assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="../assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
<link href="../assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
<link href="../assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css"/>
<link href="../assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/responsive.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>
</head>
<body class="">
<?php include("header.php");?>
<div class="page-container row-fluid">	
	<?php //include("leftbar.php");?>
	<div class="clearfix"></div> 
  
  <a href="#" class="scrollup">Scroll</a>
   <div class="footer-widget">		
	<div class="progress transparent progress-small no-radius no-margin">
		<div data-percentage="79%" class="progress-bar progress-bar-success animate-progress-bar" ></div>		
	</div>
	<div class="pull-right">
	</div>
  </div>
  <div class="page-content"> 
    <div id="portlet-config" class="modal hide">
      <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button"></button>
        <h3>Widget Settings</h3>
      </div>
      <div class="modal-body"> Widget settings form goes here </div>
    </div>
    <div class="clearfix"></div>
    <div class="content">  
		<div class="page-title">
         <?php $rt=mysqli_query($con,"select * from program_medical where id='".$_GET['id']."'");
			  while($rw=mysqli_fetch_array($rt))
			  {?>	
			<h3>Cabinet <?php echo $rw['cabinet'];?></h3>	
             
                        <form name="muser" method="post" action="" enctype="multipart/form-data">
                        
                     <table width="100%" border="0">
  <tr>
    <td height="42">Cabinet</td>
    <td><input type="text" name="cabinet" id="cabinet" value="<?php echo $rw['cabinet'];?>" class="form-control"></td>
  </tr>
  <tr>
    <td height="42">Doctor</td>
    <td><input type="text" name="doctor" id="doctor" value="<?php echo $rw['doctor'];?>" class="form-control"></td>
  </tr>
  <tr>
    <td height="42">Data</td>
    <td><input type="text" name="data" id="data" value="<?php echo $rw['data'];?>" class="form-control"></td>
  </tr>
  <tr>
    <td height="42">Ora intrare</td>
    <td><input type="text" name="ora_intrare" id="ora_intrare" value="<?php echo $rw['ora_intrare'];?>" class="form-control"></td>
  </tr>
  <tr>
    <td height="42">Ora iesire</td>
    <td><input type="text" name="ora_iesire" id="ora_iesire" value="<?php echo $rw['ora_iesire'];?>" class="form-control"></td>
  </tr>
 
  <tr>
    <td>&nbsp;</td>
    <td height="42">
                          <button type="submit" name="update" class="btn btn-primary">Save changes</button></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<?php } ?>
</form>
    </div>
    </div>
  
  
<script src="../assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script> 
<script src="../assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script> 
<script src="../assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> 
<script src="../assets/plugins/breakpoints.js" type="text/javascript"></script> 
<script src="../assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script> 
<script src="../assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script> 
<script src="../assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
<script src="../assets/plugins/pace/pace.min.js" type="text/javascript"></script>  
<script src="../assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
<script src="../assets/js/core.js" type="text/javascript"></script> 
<script src="../assets/js/chat.js" type="text/javascript"></script> 
<script src="../assets/js/demo.js" type="text/javascript"></script> 

</body>
</html>
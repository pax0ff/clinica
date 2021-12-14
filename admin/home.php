<?php 
session_start();
include("dbconnection.php");
include("checklogin.php");
check_login();
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="utf-8" />
<title>CRM | Admin Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta content="" name="description" />
<meta content="" name="author" />
    <link href="../assets/plugins/jquery-metrojs/MetroJs.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="../assets/plugins/shape-hover/css/demo.css" />
<link rel="stylesheet" type="text/css" href="../assets/plugins/shape-hover/css/component.css" />
<link rel="stylesheet" type="text/css" href="../assets/plugins/owl-carousel/owl.carousel.css" />
<link rel="stylesheet" type="text/css" href="../assets/plugins/owl-carousel/owl.theme.css" />
<link href="../assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="../assets/plugins/jquery-slider/css/jquery.sidr.light.css" rel="stylesheet" type="text/css" media="screen"/>
<link rel="stylesheet" href="../assets/plugins/jquery-ricksaw-chart/css/rickshaw.css" type="text/css" media="screen" >
<link rel="stylesheet" href="../assets/plugins/Mapplic/mapplic/mapplic.css" type="text/css" media="screen" >
<link href="../assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
<link href="../assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
<link href="../assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
<link href="../assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css"/>
<link href="../assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="../assets/css/responsive.css" rel="stylesheet" type="text/css"/>
<link href="../assets/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>
<link href="../assets/css/magic_space.css" rel="stylesheet" type="text/css"/>
       <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/plugins/morris.css" rel="stylesheet">

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>     
</head>
<body class="">
<?php include("../header.php");?>
<div class="page-container row"> 
  
      <?php include("leftbar.php");?>
    
      <div class="clearfix"></div>
      <!-- END SIDEBAR MENU -->
    </div>
  </div>
  <!-- BEGIN PAGE CONTAINER-->
  <div class="page-content">
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div id="portlet-config" class="modal hide">
      <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button"></button>
        <h3>Widget Settings</h3>
      </div>
      <div class="modal-body"> Widget settings form goes here </div>
    </div>
    <div class="clearfix"></div>
    <div class="content sm-gutter">
      <div class="page-title">
      </div>
	   <!-- BEGIN DASHBOARD TILES -->
	  <div class="row">	 
		<div class="col-md-3 col-vlg-3 col-sm-6">
			<div class="tiles green m-b-10">
              <div class="tiles-body">
			  <div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
                <div class="tiles-title text-black">Overall Visitors </div>
			         <div class="widget-stats">
                      <div class="wrapper transparent"> 
                      <?php $ov=mysqli_query($con,"select * from usercheck");
					  $num=mysqli_num_rows($ov);
					  ?>
						<span class="item-title">Overall Visitors</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $num;?>" data-animation-duration="700">0</span>
					  </div>
                    </div>
                  
                    
                    <div class="widget-stats ">
                      <div class="wrapper last"> 
                        <?php
					   $tdate=date("Y/m/d");
					  
					    $tv1=mysqli_query($con,"select * from usercheck where logindate='$tdate'");
					  $num11=mysqli_num_rows($tv1);
					  ?>
									
									
						
						<span class="item-title">Today</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $num11;?>" data-animation-duration="700">0</span> <?php									
									
									?>
					 </div>
                    </div>
                   
                   
			  </div>			
			</div>	
	

		</div>
		<div class="col-md-3 col-vlg-3 col-sm-6">
			<div class="tiles blue m-b-10">
              <div class="tiles-body">
			  <div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
                <div class="tiles-title text-black">Registered Users  </div>
			         <div class="widget-stats">
                      <div class="wrapper transparent">
                      <?php $rt=mysqli_query($con,"select * from user");
					  $rw=mysqli_num_rows($rt);?> 
						<span class="item-title">Registered Users</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $rw;?>" data-     animation-duration="700">0</span>
					  </div>
                    </div>
                    <div class="widget-stats ">
                      <div class="wrapper last"> 
                      <?php 
					  $utd=date('Y-m-d');
					  $rt1=mysqli_query($con,"select * from user where posting_date='$utd'");
					  $rw1=mysqli_num_rows($rt1);?>
						<span class="item-title">Today's</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $rw1;?>" data-animation-duration="700">0</span> 
					 </div>
                    </div>
			  </div>			
			</div>	
		</div>
		<div class="col-md-4 col-vlg-3 col-sm-6">
			<div class="tiles purple m-b-10">
              <div class="tiles-body">
			  <div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
                <div class="tiles-title text-black">Quote Requests </div>
			         <div class="widget-stats">
                      <div class="wrapper transparent"> 
                      <?php
                      $qr=mysqli_query($con,"select * from prequest");
					  $oq=mysqli_num_rows($qr);
					  ?>
						<span class="item-title">Overall Quotes</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $oq?>" data-animation-duration="700">0</span>
					  </div>
                    </div>
                    <div class="widget-stats">
                      <div class="wrapper transparent">
                       <?php
                      $qr1=mysqli_query($con,"select * from prequest where status='0'");
					  $oq1=mysqli_num_rows($qr1);
					  ?>
						<span class="item-title">New Quotes's</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $oq1;?>" data-animation-duration="700">0</span> 
					  </div>
                    </div>
                    <div class="widget-stats ">
                      <div class="wrapper last"> 
                       <?php
                      $qr2=mysqli_query($con,"select * from prequest where status='1'");
					  $oq2=mysqli_num_rows($qr2);
					  ?>
						<span class="item-title">In Progress</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $oq2;?>" data-animation-duration="700">0</span> 
					 </div>
                    </div>
                  
                    
			  </div>			
			</div>	
		</div>	
        
        
        
        
   <div class="row">	 
		<div class="col-md-3 col-vlg-3 col-sm-6">
			<div class="tiles red m-b-10">
              <div class="tiles-body">
			  <div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
                <div class="tiles-title text-black">Overall Tickets </div>
			         <div class="widget-stats">
                      <div class="wrapper transparent"> 
                      <?php $vt=mysqli_query($con,"select * from ticket");
					  $ovt=mysqli_num_rows($vt);
					  ?>
						<span class="item-title">All Tickets</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $ovt;?>" data-animation-duration="700">0</span>
					  </div>
                    </div>
                  
                    
                    <div class="widget-stats ">
                      <div class="wrapper last"> 
                        <?php
					   $tdate=date("Y/m/d");
					  
					    $otv=mysqli_query($con,"select * from ticket where status='Open'");
					  $otv1=mysqli_num_rows($otv);
					  ?>
									
									
						
						<span class="item-title">Pending Tickets</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $otv1;?>" data-animation-duration="700">0</span> <?php									
									
									?>
					 </div>
                    </div>
                   
                   
			  </div>			
			</div>	
	

		</div>
	
        </div>     
		
	 </div>
	  <!-- END DASHBOARD TILES -->
           <!-- START DASHBOARD CHART -->


		   <div class="content">
                <ul class="breadcrumb">
                    <li>
                        <p>YOU ARE HERE</p>
                    </li> 
                    <li><a href="#" class="active">Manage Users</a>

                    </li>
                </ul>
                <div class="page-title">	<i class="icon-custom-left"></i>

                    	<h3>Manage Users </h3>	
                </div>
             
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="grid simple ">
                                    <div class="grid-title no-border">
                                        	<h4>All Users Details</h4>
                                        <div class="tools">	<a href="javascript:;" class="collapse"></a>
											<a href="#grid-config" data-toggle="modal" class="config"></a>
											<a href="javascript:;" class="reload"></a>
											<a href="javascript:;" class="remove"></a>
                                        </div>
                                    </div>
                                    <div class="grid-body no-border">
                              
                                            <table class="table table-hover no-more-tables">
                                                <thead>
                                                    <tr>
                                                        
                                                        <th>Etaj</th>
                                                        <th>Denumire cabinet</th>
														<th>Nume medic</th>
														<th>Interval orar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
												<?php 
												$ret=mysqli_query($con,"SELECT * FROM orar");
												
												$cnt=1;
												while($row=mysqli_fetch_array($ret))
												{
													$_SESSION['ids']=$row['id'];
												?>
                                                    <tr>
                                                        
                                                        <td><?php echo $row['etaj'];?></td>
                                                        <td><?php echo $row['denumire'];?></td>
														<td><?php echo $row['nume'];?></td>
														<td><?php echo $row['nume'];?></td>
                                                          <td>
                                                          <form name="abc" action="" method="post">
                                                           <a href="edit-cabinet.php?id=<?php echo $row['id'];?>" class="btn btn-primary btn-xs btn-mini">View n Edit</a> 
                                                           <button type="button" class="btn btn-danger btn-xs btn-mini">Delete </button>
                                                           </form>
                                                          </td>
                                                    </tr>
                                                    <?php $cnt=$cnt+1; } ?>
                                                </tbody>
                                            </table>
                         
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
					</div>
                </div>
            </div>
                    
                    
                </div>
             
                    <!-- END DASHBOARD CHART --> 
			
               
          
		  </div></div>
<!-- BEGIN CHAT --> 
	  
</div>
<script src="../assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="../assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
<script src="../assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../assets/plugins/breakpoints.js" type="text/javascript"></script>
<script src="../assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
<script src="../assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script>
<script src="../assets/plugins/jquery-lazyload/jquery.lazyload.min.js" type="text/javascript"></script>
<script src="../assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
<!-- END CORE JS FRAMEWORK -->
<!-- BEGIN PAGE LEVEL JS -->
<script src="../assets/plugins/jquery-slider/jquery.sidr.min.js" type="text/javascript"></script>
<script src="../assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="../assets/plugins/pace/pace.min.js" type="text/javascript"></script>
<script src="../assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
<script src="../assets/plugins/jquery-ricksaw-chart/js/raphael-min.js"></script>
<script src="../assets/plugins/jquery-ricksaw-chart/js/d3.v2.js"></script>
<script src="../assets/plugins/jquery-ricksaw-chart/js/rickshaw.min.js"></script>
<script src="../assets/plugins/jquery-sparkline/jquery-sparkline.js"></script>
<script src="../assets/plugins/skycons/skycons.js"></script>
<script src="../assets/plugins/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
<script type="../text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script src="../assets/plugins/jquery-gmap/gmaps.js" type="text/javascript"></script>
<script src="assets/plugins/Mapplic/js/jquery.easing.js" type="text/javascript"></script>
<script src="../assets/plugins/Mapplic/js/jquery.mousewheel.js" type="text/javascript"></script>
<script src="../assets/plugins/Mapplic/js/hammer.js" type="text/javascript"></script>
<script src="../assets/plugins/Mapplic/mapplic/mapplic.js" type="text/javascript"></script>
<script src="../assets/plugins/jquery-flot/jquery.flot.js" type="text/javascript"></script>
<script src="../assets/plugins/jquery-flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="../assets/plugins/jquery-metrojs/MetroJs.min.js" type="text/javascript" ></script>
<script src="../assets/js/core.js" type="text/javascript"></script>
<script src="../assets/js/chat.js" type="text/javascript"></script>
<script src="../assets/js/demo.js" type="text/javascript"></script>
<script src="../assets/js/dashboard_v2.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/highcharts.js"></script>
	<script type="text/javascript" src="js/exporting.js"></script>	
<script type="text/javascript">
        $(document).ready(function () {
            $(".live-tile,.flip-list").liveTile();
        });
</script>
</body>
</html>

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
    <title>Admin | Vezi cabinete</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link href="../assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="../assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="../assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
    <link href="../assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
    <link href="../assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
    <link href="../assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css"/>
    <link href="../assets/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="../assets/css/responsive.css" rel="stylesheet" type="text/css"/>
    <link href="../assets/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>
</head>
<body class="">
<?php include("header.php");?>
<div class="page-container row">

    <?php include("leftbar.php");?>

    <div class="clearfix"></div>
    <!-- END SIDEBAR MENU -->
</div>
</div>
<div class="page-content">
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div id="portlet-config" class="modal hide">
        <div class="modal-header">
            <button data-dismiss="modal" class="close" type="button"></button>
            <h3>Widget Settings</h3>

        </div>
        <div class="modal-body">Widget settings form goes here</div>
    </div>
    <div class="clearfix"></div>
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
                                        <th>Cabinet</th>
                                        <th>Doctor</th>
                                        <?php
                                        $start = strtotime('7:00');
                                        $end = strtotime('20:00');
                                        $range = array();
                                        while ($start !== $end)
                                        {
                                        $start = strtotime('+60 minutes',$start);
                                        $range[] = date('h:ia', $start);
                                        //$range = json_encode($range);



                                        }
                                        $newRange = array();
                                        $count = 0;

                                        foreach($range as $k=>$v){
                                            $newRange[$k] = array($v,$v);
                                        }

                                        //$range = json_encode($range);
                                        echo "<th>".json_encode(array_values($newRange))."</th>";
                                        ?>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $ret=mysqli_query($con,"select a.id,a.etaj,a.denumire,b.nume,b.prenume from cabinet as a join personal as b on b.cabinet_id = a.id");

                                    while($row=mysqli_fetch_array($ret))
                                    {
                                        $_SESSION['ids']=$row['id'];
                                        ?>
                                        <tr>
                                            <td><?php echo $row['etaj'];?></td>
                                            <td><?php echo $row['denumire'];?></td>
                                            <td><?php echo $row['nume'].' '.$row['prenume'];?></td>
                                            <td></td>
                                        </tr>
                                    <?php  } ?>
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
<!-- END PAGE -->
</div>

</div>
<!-- END CONTAINER -->
<!-- BEGIN CORE JS FRAMEWORK-->
<script src="../assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="../assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
<script src="../assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../assets/plugins/breakpoints.js" type="text/javascript"></script>
<script src="../assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
<!-- END CORE JS FRAMEWORK -->
<!-- BEGIN PAGE LEVEL JS -->
<script src="../assets/plugins/pace/pace.min.js" type="text/javascript"></script>
<script src="../assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
<script src="../assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script>
<script src="../assets/plugins/jquery-sparkline/jquery-sparkline.js"></script>
<script src="../assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script>
    //Too Small for new file - Helps the to tick all options in the table
    $('table .checkbox input').click( function() {
        if($(this).is(':checked')){
            $(this).parent().parent().parent().toggleClass('row_selected');
        }
        else{
            $(this).parent().parent().parent().toggleClass('row_selected');
        }
    });
    // Demo charts - not required
    $('.customer-sparkline').each(function () {
        $(this).sparkline('html', { type:$(this).attr("data-sparkline-type"), barColor:$(this).attr("data-sparkline-color") , enableTagOptions: true  });
    });
</script>
<!-- BEGIN CORE TEMPLATE JS -->
<script src="../assets/js/core.js" type="text/javascript"></script>
<script src="../assets/js/chat.js" type="text/javascript"></script>
<script src="../assets/js/demo.js" type="text/javascript"></script>
<!-- END CORE TEMPLATE JS -->
</body>

</html>
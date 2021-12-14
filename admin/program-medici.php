<?php
session_start();
include("dbconnection.php");
include("checklogin.php");
check_login();

$filtru='';
if(isset($_GET['filtru'])){
    $filtru = $_GET['filtru'];

}
$intervalOrarQuery = mysqli_query($con,"select * from interval_orar order by id ASC");
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
                                <div class="row">
                                    <form method="GET" action="program-medici.php">
                                        <div class="col-lg-4 col-md-4 p-t-15">
                                            <h4>Filtreaza dupa: </h4>
                                            <select class="form-select" name="filtru" aria-label="">
                                                <option selected></option>
                                                <option value="currentDay">Data curenta</option>
                                                <option value="5days">Ultimele 5 zile</option>
                                                <option value="30days">Ultimele 30 de zile</option>
                                            </select>
                                            <button type="submit"  id="filter" class="btn btn-success" value="">Filtreaza</button>
                                        </div>
                                    </form>
                                </div>
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
                                            <th>Cabinet</th>
                                            <th>Data</th>
                                            <th>Medic</th>
                                            <?php
                                                while($rows=mysqli_fetch_assoc($intervalOrarQuery))
                                                {
                                                    $hour = $rows['ora'];


                                                    echo '<th id="hour">'.$hour.'</th>';
                                                }
                                                ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    switch($filtru)
                                    {
                                        case 'currentDay':
                                            $query = mysqli_query($con,"select a.cabinet,a.data,a.doctor,a.ora_intrare,a.ora_iesire,b.asistenta,b.ora_intrare_a,b.ora_iesire_a from program_medical as a 
join program_asistente as b on a.data = b.data and a.data=CURRENT_DATE()"); break;
                                        case '5days':
                                            $query = mysqli_query($con,"select a.cabinet,a.data,a.doctor,a.ora_intrare,a.ora_iesire,b.asistenta,b.ora_intrare_a,b.ora_iesire_a from program_medical as a 
join program_asistente as b on a.data = b.data and a.data >= DATE_ADD(CURDATE(), INTERVAL -7 DAY)");    break;
                                        case '30days':
                                            $query = mysqli_query($con,"select a.cabinet,a.data,a.doctor,a.ora_intrare,a.ora_iesire,b.asistenta,b.ora_intrare_a,b.ora_iesire_a from program_medical as a 
join program_asistente as b on a.data = b.data and a.data >= DATE_ADD(CURDATE(), INTERVAL -30 DAY) ");

                                        default: $query=mysqli_query($con,"select a.cabinet,a.data,a.doctor,a.ora_intrare,a.ora_iesire,b.asistenta,b.ora_intrare_a,b.ora_iesire_a from program_medical as a 
join program_asistente as b on a.data = b.data order by a.data DESC");
                                    }


                                    while($row=mysqli_fetch_array($query))
                                    {
                                        ?>
                                        <tr>
                                            <td rowspan="2"><?php echo $row['cabinet'];?></td>
                                            <td rowspan="2"><?php echo $row['data'];?></td>
                                            <td><b style="color:red">Doctor:</b> <?php echo $row['doctor']; ?></td>
                                            <?php
                                            $ora1 = $row['ora_intrare'];
                                            $ora2 = $row['ora_iesire'];
                                            $intrare = hourTransform($ora1);
                                            $iesire = hourTransform($ora2);

                                            for($i=8;$i<=20;$i++){
                                                if($intrare<=$i && $i <= $iesire)
                                                    echo "<td style=background:red;opacity:.2></td>";
                                                else {
                                                    echo "<td style=background:white;opacity:.2></td>";
                                                }
                                            }
                                            ?>

                                        </tr>
                                        <td><b style="color:blue;">Asistenta: </b><?php echo $row['asistenta']; ?></td>
                                        <?php
                                        $ora1 = $row['ora_intrare_a'];
                                        $ora2 = $row['ora_iesire_a'];
                                        $intrareA = hourTransform($ora1);
                                        $iesireA = hourTransform($ora2);
                                        for($i=8;$i<=20;$i++){
                                            if($intrareA<=$i && $i <= $iesireA)
                                                echo "<td style=background:blue;opacity:.2></td>";
                                            else {
                                                echo "<td style=background:white;opacity:.2></td>";
                                            }
                                        }
                                        ?>

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
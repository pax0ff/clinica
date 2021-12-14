<?php
session_start();
include("dbconnection.php");
include("checklogin.php");
check_login();

$doctori = mysqli_query($con,"select nume,prenume from personal order by nume");
$asistente = mysqli_query($con,"select nume,prenume from asistente order by nume");
$cabinete = mysqli_query($con,"select denumire from cabinet order by denumire");

function getHours() {
    $a = '07:00';
    $b = '20:00';

    $period = new DatePeriod(
        new DateTime($a),
        new DateInterval('PT1H'),
        new DateTime($b)
    );
    foreach ($period as $date) {
        echo '<option value="'.$date->format("H:i\n").'">'.$date->format("H:i\n").'</option>';
    }
}

$errors = array();
if(isset($_POST['adauga'])) {
    if (empty($_POST['asistenta'])) {
        $errors[] = "Asistenta nu a fost aleasa";
    } else {
        $doctor = $_POST['asistenta'];
    }
    if (empty($_POST['cabinet'])) {
        $errors[] = "Cabinetul nu a fost ales";
    } else {
        $cabinet = $_POST['cabinet'];
    }
    if (empty($_POST['ora_intrare'])) {
        $errors[] = "Ora de intrare nu a fost ales";
    } else {
        $ora_intrare = $_POST['ora_intrare'];
    }
    if (empty($_POST['ora_iesire'])) {
        $errors[] = "Ora de iesire nu a fost ales";
    } else {
        $ora_iesire = $_POST['ora_iesire'];
    }
    if (count($errors) == 0) {
        $data = $_POST['data_program'];
        $insertQuery = mysqli_query($con,"INSERT INTO `program_asistente`(`id`, `asistenta`, `cabinet`, `data`, `ora_intrare_a`, `ora_iesire_a`) VALUES (NULL,'$doctor','$cabinet','$data','$ora_intrare','$ora_iesire')");

        if($insertQuery) {
            $errors[] = "Datele au fost adaugate cu succes";
        }
    }
}


?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>Admin | Vezi asistente</title>
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
                <li><a href="#" class="active">Personal medical</a>

                </li>
            </ul>

            <div class="page-title">	<i class="icon-custom-left"></i>
                <h3>Personal medical </h3>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="grid simple ">
                                <div class="grid-title no-border">
                                    <h4>Adauga program medical</h4>
                                    <div class="tools">	<a href="javascript:" class="collapse"></a>
                                        <a href="#grid-config" data-toggle="modal" class="config"></a>
                                        <a href="javascript:;" class="reload"></a>
                                        <a href="javascript:;" class="remove"></a>
                                    </div>
                                </div>
                                <form method="post" action="schedule_asistente.php">
                                <div class="row">


                                        <div class="col-lg-2 col-md-2 p-t-15">
                                            <label>Alege asistenta</label>
                                            <select class="form-select" name="asistenta"  aria-label="Default select example">
                                                <option selected></option>
                                                <?php
                                                while($row=mysqli_fetch_array($asistente)) {
                                                ?>
                                                <option value="<?php echo $row['nume'].' '.$row['prenume'];?>"><?php echo  $row['nume'].' '.$row['prenume']; ?></option>
                                                <?php }?>
                                            </select>
                                        </div>

                                        <div class="col-lg-2 col-md-2 p-t-15">
                                            <label>Alege cabinet</label>
                                            <select class="form-select" name="cabinet" aria-label="Default select example">
                                                <option selected></option>
                                                <?php
                                                while($row=mysqli_fetch_array($cabinete)) {
                                                    ?>
                                                    <option value="<?php echo $row['denumire'];?>"><?php echo  $row['denumire']; ?></option>
                                                <?php }?>
                                            </select>
                                        </div>

                                        <div class="col-lg-2 col-md-2 p-t-15">
                                            <label>Alege data</label>
                                            <input type="date" id="start" name="data_program" value="<?php echo date('Y-m-d');?>" min="" max="2099-12-31">
                                        </div>

                                        <div class="col-lg-2 col-md-2 p-t-15">
                                            <label>Ora intrare</label>
                                            <select class="form-select" name="ora_intrare" aria-label="Default select example">
                                                <option selected></option>

                                                <option value="<?php getHours(); ?>"><?php getHours();?></option>
                                            </select>
                                        </div>

                                        <div class="col-lg-2 col-md-2 p-t-15">
                                            <label>Ora iesire</label>
                                            <select class="form-select" name="ora_iesire" aria-label="Default select example">
                                                <option selected></option>
                                                <option value="<?php getHours(); ?>"><?php getHours();?></option>
                                            </select>
                                        </div>

                                        <div class="col-lg-2 col-md-2 p-t-15">
                                            <label>ACTIUNE</label>
                                            <button type="submit" name="adauga" id="adauga" class="btn btn-success" value="">Adauga program</button>
                                        </div>
                                    </div>
                                </div>

                                    <div class="row text-center">



                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php $ret=mysqli_query($con,"select * from program_asistente order by cabinet"); ?>
        <div class="row">
            <div class="col-lg-12 col-md-12 ">
                <div class="grid-body borderall">
                    <?php
                       //echo "<pre>"; var_dump($ret);die();
                    if (count($errors) > 0) {
                        foreach ($errors as $err) {
                            echo "<div class='alert alert-info' disabled='true'>.$err.</div>";
                            print_r($err . '<br />');
                        }
                    }

                        if($ret->num_rows == 0){
                            echo "Nu exista inca un program";
                        } else {?>
                    <table class="table table-hover no-more-tables">
                        <thead>
                            <tr>
                                <th>Cabinet</th>
                                <th>Asistenta </th>
                                <th>Data</th>
                                <th>Ora intrare</th>
                                <th>Ora iesire</th>
                                <th>Editeaza</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            while($row=mysqli_fetch_array($ret))
                            {

                                ?>
                                <tr>

                                    <td><?php echo $row['cabinet']; ?></td>
                                    <td><?php echo $row['asistenta']; ?></td>
                                    <td><?php echo $row['data']; ?></td>
                                    <td><?php echo $row['ora_intrare_a']; ?></td>
                                    <td><?php echo $row['ora_iesire_a']; ?></td>

                                    <td>
                                        <form name="abc" action="" method="post">
                                            <a href="edit-cabinet-asistenta.php?id=<?php echo $row['id'];?>" class="btn btn-primary btn-xs btn-mini">Editeaza </a>
                                            
                                        </form>
                                    </td>
                                </tr>
                            <?php }}?>
                        </tbody>
                    </table>

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
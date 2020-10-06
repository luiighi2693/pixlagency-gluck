<?php
@session_start();

require('Connections/Connections.php');
require('include/security.php');
require('include/functions.php');


$rowid=$_REQUEST['rowid'];

if ($_SESSION['user']['type']==1) {
    $user=$_SESSION['user']['rowid'];
}else{
    $user=$_REQUEST['rowid_user'];
}

if($query = mysqli_query($connect,"SELECT * FROM q_pools WHERE rowid = '".$rowid."'")){
    $array=mysqli_fetch_array($query);

    $rowid=$array['rowid'];
    $name=$array['name'];
    $puntaje_empate=$array['puntaje_empate'];
    $puntaje_ganar=$array['puntaje_ganar'];
    $puntaje_perder=$array['puntaje_perder'];
    $puntaje_resultado=$array['puntaje_resultado'];
    $date_Create=date("d/m/Y",strtotime($array['date_Create']));



    //$query_result = mysqli_query($connect,"SELECT * FROM q_result_pools WHERE fk_q_pools = '".$rowid."' AND fk_q_user = '".$user."'");
    $query_result = mysqli_query($connect,"SELECT qrp.rowid, qrp.fk_q_user,qrp.fk_q_pools,qrp.fk_team_1,qrp.team__result_1,qrp.team__result_1_admin,qrp.fk_team_2,qrp.team__result_2,qrp.team__result_2_admin,qrp.status,qrp.comment,qrp.result_admin,qrp.date_Sport,qrp.hour, qrp.hits,qrp.close,qrp.date_Create , (select name from q_sport where qrp.fk_q_user=rowid) as sport, (select img from q_team where qrp.fk_team_1 = rowid) as image1,(select img from q_team where qrp.fk_team_2 = rowid) as image2,(SELECT result FROM q_pools_details WHERE fk_pools = '".$rowid."' AND fk_team_1 = qrp.fk_team_1 AND fk_team_2 = qrp.fk_team_2) as result FROM q_result_pools qrp WHERE qrp.fk_q_pools = '".$rowid."' AND qrp.fk_q_user = '".$user."'");
    //$query_result = mysqli_query($connect,"SELECT qrp.rowid, qrp.fk_q_user,qrp.fk_q_pools,qrp.fk_team_1,qrp.team__result_1,qrp.team__result_1_admin,qrp.fk_team_2,qrp.team__result_2,qrp.team__result_2_admin,qrp.status,qrp.comment,qrp.result_admin,qrp.date_Sport,qrp.hour, qrp.hits,qrp.close,qrp.date_Create , (select name from q_sport where qrp.fk_q_user=rowid) as sport FROM q_result_pools qrp WHERE qrp.fk_q_pools = '".$rowid."'");

    $query_result_label = mysqli_query($connect,"SELECT qpd.rowid, qpd.fk_pools,qpd.fk_team_1,qpd.fk_team_2, concat( qpd.label ,' ', qpd.date_Sport,' ',qpd.hour) as sportLabel FROM q_pools_details qpd where qpd.fk_pools='".$rowid."'");
}

//validamos el score en base a los resultados
function getResult($resultUser1, $resultUser2, $resultAdmin1, $resultAdmin2, $result) {
    $scoreTotal = 0;
    global $puntaje_resultado;
    global $puntaje_empate;
    global $puntaje_ganar;
    global $puntaje_perder;

    //verificamos si es el resultado exacto
    if ($resultUser1 == $resultAdmin1 && $resultUser2 == $resultAdmin2)
        $scoreTotal += $puntaje_resultado;
    //verificamos si hay empate
    if ($resultUser1 == $resultUser2 && $resultAdmin1 == $resultAdmin2)
        $scoreTotal += $puntaje_empate;
    //verificamos si gano el equipo uno gano o perdio
    $scoreTotal += ($resultUser1 > $resultUser2 && $resultAdmin1 > $resultAdmin2) ? $puntaje_ganar : $puntaje_perder;;
    //verificamos si gano el equipo dos gano o perdio
    $scoreTotal += ($resultUser1 < $resultUser2 && $resultAdmin1 < $resultAdmin2) ? $puntaje_ganar : $puntaje_perder;

    if ($result == "C")
        $scoreTotal = 0;

    return $scoreTotal;
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | Resultado de Clientes</title>
    <link rel="stylesheet" href="Ccs/style.css">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="Css/style.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body class="hold-transition skin-black sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <?php include("header-usuario.php");?>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <?php include("panel-usuario.php");?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Resultados
                <small>Quiniela #<?=str_pad($rowid, 10, "0", STR_PAD_LEFT);?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="q_pools_list_result.php">Listado Quinielas</a></li>
                <li class="active">Quiniela</li>
            </ol>
        </section>

        <div class="pad margin no-print">
            <div class="callout callout-info" style="margin-bottom: 0!important;">
                <h4><i class="fa fa-info"></i> Nota:</h4>
                Esta quiniela ya se encuentra cerrada.
            </div>
        </div>

        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <i class="fa fa-globe"></i> <?=$name;?>
                        <small class="pull-right">Creada: <?=$date_Create;?></small>
                    </h2>
                </div><!-- /.col -->
            </div>
            <!-- info row -->

<!--            --><?php
//            //todo: only debug
//            echo ' only debug ';
//            echo '<br> Resultado <br>';
//            echo $puntaje_resultado;
//            echo '<br> Ganar <br>';
//            echo $puntaje_ganar;
//            echo '<br> Empate <br>';
//            echo $puntaje_empate;
//            echo '<br> Perder <br>';
//            echo $puntaje_perder;
//            echo '<br> 30 , 30 , 11 , 11 , 15 , 15 , 16 , 16 , 1 , 1 , 1 , 1 , 16 , 16 , 3 , 3 , 1 , 1 , T , T , , , F , F , 0000-00-00 , 0000-00-00 , 12:00:00 , 12:00:00 , 0 , 0 , 2 , 2 , 2020-09-13 14:41:42 , 2020-09-13 14:41:42 , Futbol , Futbol <br>
//                            31 , 31 , 11 , 11 , 15 , 15 , 19 , 19 , 1 , 1 , 3 , 3 , 18 , 18 , 1 , 1 , 4 , 4 , T , T , , , F , F , 0000-00-00 , 0000-00-00 , 12:00:00 , 12:00:00 , 0 , 0 , 2 , 2 , 2020-09-13 14:41:42 , 2020-09-13 14:41:42 , Futbol , Futbol <br>';
//            ?>

            <!-- Table row -->
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Juego</th>
                            <th colspan="4" style="text-align: center;" class="custom-center-colum">Resultados del Usuario</th>
                            <!--<th class="bg-gray disabled color-palette"></th>
                            <th>Equipo #2</th>
                            <th class="bg-gray disabled color-palette"></th>-->
                            <th colspan="4" style="text-align: center;" class="custom-center-colum">Resultados Finales</th>
                            <!--<th>Equipo #1</th>
                            <th class="bg-gray disabled color-palette">Admin #1</th>
                            <th>Equipo #2</th>
                            <th class="bg-gray disabled color-palette">Admin #2</th>-->
                            <!--<th class="bg-gray disabled color-palette">Estatus</th>
                            <th class="bg-yellow disabled color-palette">Estatus Admin</th>-->
                            <th style="text-align: center;">Puntaje</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
//                                              $constResultado= $puntaje_resultado;
//                                              $constGanador= $puntaje_ganar;
//                                              $constEmpate=$puntaje_empate;
//                                              $constPerdedor= $puntaje_perder;
//
//                                              $resResultadoEmpate=0;
//                                              $resResultado=0;
//                                              $resResultadoGanador=0;
//                                              $resResultadoPerdedo=0;
                        $resFinal=0;
                        $sumResFinal=0;
                                              $labels=[];


                                              while($item_result_label=mysqli_fetch_array($query_result_label)){
                                                array_push($labels,$item_result_label);
                                              }

                        while($item_result=mysqli_fetch_array($query_result)){

                          $resFinal = getResult($item_result['team__result_1'], $item_result['team__result_2'], $item_result['team__result_1_admin'], $item_result['team__result_2_admin'], $item_result['result']);
                            $sumResFinal+= $resFinal;
//                        $teamGanador=0;
//                        $teamGanadorAdmin=0;
//
//                        if( $item_result['team__result_1'] == $item_result['team__result_1_admin'] &&
//                        $item_result['team__result_2'] == $item_result['team__result_2_admin']){
//                          $resResultado= $constResultado;
//                        }

                        for ($j=0; $j < count($labels); $j++) {
                          if ($labels[$j]['fk_team_1']==$item_result['fk_team_1'] &&
                          $labels[$j]['fk_team_2']==$item_result['fk_team_2']){
                            $item_result['sportLabel']= $labels[$j]['sportLabel'];
                            break;
                          }
                        }

//                        if($item_result['team__result_1'] == $item_result['team__result_2']){
//                          if($item_result['team__result_1_admin'] == $item_result['team__result_2_admin'] &&
//                          $item_result['team__result_1']==$item_result['team__result_1_admin'] ){
//                            $resResultadoEmpate= $constEmpate;
//                          }
//                        }
//
//                        if($item_result['team__result_1'] == $item_result['team__result_2']){
//                          $teamGanador=0;
//                        }else if ($item_result['team__result_1'] > $item_result['team__result_2']){
//                          $teamGanador=1;
//                        }else if ($item_result['team__result_1'] < $item_result['team__result_2']){
//                          $teamGanador=2;
//                        }
//
//                        if($item_result['team__result_1_admin'] == $item_result['team__result_2_admin']){
//                          $teamGanadorAdmin=0;
//                        }else if ($item_result['team__result_1_admin'] > $item_result['team__result_2_admin']){
//                          $teamGanadorAdmin=1;
//                        }else if ($item_result['team__result_1_admin'] < $item_result['team__result_2_admin']){
//                          $teamGanadorAdmin=2;
//                        }
//
//                       if($teamGanador==$teamGanadorAdmin && $teamGanadorAdmin!=0){
//                        $resResultadoGanador= $constGanador;
//                        $resFinal=  $resResultadoGanador + $resResultado + $resResultadoEmpate;
//                       }else{
//                        $resResultadoPerdedor= $constPerdedor;
//                        $resFinal=  $resResultadoPerdedor;
//                       }
//                       $sumResFinal=$sumResFinal+$resFinal;
                       $query_update="UPDATE q_result_pools SET hits=".$resFinal."  WHERE rowid = '".$item_result['rowid']."'";
                       mysqli_query($connect,$query_update)
                            ?>
                            <tr>
                                <td><?=$item_result['sportLabel']?><?=$item_result['result'] == "C" ? "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sin Comenzar" : "" ?></td>
                                <td>
                                    <?php $images=($item_result['image1']!='')?$item_result['image1']:'logo.png';?>
                                    <img width="30px" src="images/team/<?=$images;?>" class="img-circle" alt="User Image">
                                    <?=team_pools_result(0, $connect, 1, $item_result['fk_team_1']);?>
                                </td>
                                <td style="text-align: center;"><?=$item_result['team__result_1'];?></td>
                                <td style="text-align: center;"><?=$item_result['team__result_2'];?></td>
                                <td>
                                    <?php $images=($item_result['image2']!='')?$item_result['image2']:'logo.png';?>
                                    <img width="30px" src="images/team/<?=$images;?>" class="img-circle" alt="User Image">
                                    <?=team_pools_result(0, $connect, 1, $item_result['fk_team_2']);?>
                                </td>
                                <td>
                                    <?php $images=($item_result['image1']!='')?$item_result['image1']:'logo.png';?>
                                    <img width="30px" src="images/team/<?=$images;?>" class="img-circle" alt="User Image">
                                    <?=team_pools_result(0, $connect, 1, $item_result['fk_team_1']);?>
                                </td>
                                <td style="text-align: center;"><?=$item_result['team__result_1_admin'];?></td>
                                <td style="text-align: center;"><?=$item_result['team__result_2_admin'];?></td>
                                <td>
                                    <?php $images=($item_result['image2']!='')?$item_result['image2']:'logo.png';?>
                                    <img width="30px" src="images/team/<?=$images;?>" class="img-circle" alt="User Image">
                                    <?=team_pools_result(0, $connect, 1, $item_result['fk_team_2']);?>
                                </td>
                                <td style="text-align: center;"> <?=$resFinal;?></td>
                            </tr>
                            <?php
                        }
                        ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                            <td></td>
                            <td></td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: right;"> Total:</td>
                            <td style="text-align: center;"> <?=$sumResFinal;?></td>
                        </tr>
                        </tbody>
                    </table>
                </div><!-- /.col -->
            </div><!-- /.row -->

        </section><!-- /.content -->
        <div class="clearfix"></div>
    </div><!-- /.content-wrapper -->
    <?php include("side-bar.php");  ?>

    <!-- Control Sidebar -->

    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->

<!-- jQuery 2.1.4 -->
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>

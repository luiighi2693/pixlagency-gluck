<?php

@session_start();



require('Connections/Connections.php');

require('include/redirect.php');

require('include/security.php');



if($query = mysqli_query($connect,"SELECT * FROM q_pools WHERE rowid = '".$_REQUEST['rowid']."'")) {

    $array = mysqli_fetch_array($query);



    $puntaje_empate = $array['puntaje_empate'];

    $puntaje_ganar = $array['puntaje_ganar'];

    $puntaje_perder = $array['puntaje_perder'];

    $puntaje_resultado = $array['puntaje_resultado'];

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



    if ($result == "C" || $result == "S")

        $scoreTotal = 0;



    return $scoreTotal;

}



?>

<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Gluck | Listado de Clientes</title>

    <!-- Tell the browser to be responsive to screen width -->

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.5 -->

    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

    <!-- Font Awesome -->

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- Ionicons -->

    <link rel="stylesheet" href="//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">

    <!-- DataTables -->

    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">

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

  <body class="hold-transition skin-blue sidebar-mini">

    <div class="wrapper">



      <header class="main-header">

          <?php include("header-usuario.php");?>

      </header>

            <!-- Panel lateral de usuario -->

      <?php include("panel-usuario.php");?>





      <!-- Content Wrapper. Contains page content -->

      <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Listado de Clientes

            <small>Informaci&oacute;n General</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>

            <li class="active">Clientes</li>

          </ol>

        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">

                 <div class="box">

                <div class="box-header">

                  <?php if ($_SESSION['user']['type']==1) { ?>

                  <h3 class="box-title">Listado de Participantes</h3>

                  <?php }?>

                  <?php if ($_SESSION['user']['type']==0) { ?>

                  <h3 class="box-title">Listado de Clientes</h3>

                  <?php }?>

                </div><!-- /.box-header -->

                <div class="box-body table-responsive">

                  <table id="example1" class="table table-responsive table-bordered table-striped">

                    <thead>

                      <tr>

                        <th>Usuario</th>

                        <?php if ($_SESSION['user']['type']==0) { ?>

                        <th>Email</th>

                         <?php }?>

                         <?php if ($_SESSION['user']['type']==0) { ?>

                        <th>Tel&eacute;fono</th>

                        <?php }?>

                        <th>Puntuaci&oacute;n</th>
                        <th>Goles Acertados</th>

                        <?php if ($_SESSION['user']['type']==0) { ?>

                        <th>Ultimo Acceso</th>

                        <?php }?>

                        <?php if ($_SESSION['user']['type']==0) { ?>

                        <th>-</th>

                        <?php }?>

                      </tr>

                    </thead>

                    <tbody>

                      <?php 

                      $fk_q_pools=$_REQUEST['rowid'];

                      //if($query = mysqli_query($connect,"SELECT DISTINCT u.name, u.email,u.phone,u.ranking,u.date_Access, u.rowid as rowid_user, r.fk_q_pools as result FROM q_user u, q_result_pools r WHERE u.rowid=r.fk_q_user AND r.fk_q_pools = ".$fk_q_pools." GROUP BY r.fk_q_pools ORDER BY r.rowid  DESC")){

                        if($query = mysqli_query($connect,"SELECT DISTINCT u.rowid as userId, u.name,u.lastname,u.email,u.phone,(SELECT sum(qrp.hits) FROM q_result_pools qrp where qrp.fk_q_user=u.rowid and qrp.fk_q_pools=r.fk_q_pools) ranking, (SELECT sum(qrp.team__result_1) FROM q_result_pools qrp where qrp.fk_q_user=u.rowid and qrp.fk_q_pools=r.fk_q_pools and qrp.team__result_1 = qrp.team__result_1_admin) goles1, (SELECT sum(qrp.team__result_2) FROM q_result_pools qrp where qrp.fk_q_user=u.rowid and qrp.fk_q_pools=r.fk_q_pools and qrp.team__result_2 = qrp.team__result_2_admin) goles2, u.date_Access, u.rowid as rowid_user, r.fk_q_pools as result FROM q_user u, q_result_pools r WHERE u.rowid=r.fk_q_user AND r.fk_q_pools = ".$fk_q_pools."  ORDER BY r.rowid DESC")){

                        //if($query = mysqli_query($connect,"SELECT DISTINCT u.name, u.email,u.phone,(SELECT sum(qrp.hits) FROM q_result_pools qrp where qrp.fk_q_user=u.rowid and qrp.fk_q_pools=r.fk_q_pools) ranking,u.date_Access, u.rowid as rowid_user, r.fk_q_pools as result FROM q_user u, q_result_pools r WHERE r.fk_q_pools = ".$fk_q_pools."  ORDER BY r.rowid DESC")){

                        while ($array=mysqli_fetch_array($query)) {



//                            echo "\n";

//                            echo "SELECT qrp.rowid, qrp.fk_q_user,qrp.fk_q_pools,qrp.fk_team_1,qrp.team__result_1,qrp.team__result_1_admin,qrp.fk_team_2,qrp.team__result_2,qrp.team__result_2_admin,qrp.status,qrp.comment,qrp.result_admin,qrp.date_Sport,qrp.hour, qrp.hits,qrp.close,qrp.date_Create , (select name from q_sport where qrp.fk_q_user=rowid) as sport FROM q_result_pools qrp WHERE qrp.fk_q_pools = '".$fk_q_pools."' AND qrp.fk_q_user = '".$array['userId']."'";

//                            echo "\n\n";

                            $goles1 = $array['goles1'] == null ? 0 : $array['goles1'];
                            $goles2 = $array['goles2'] == null ? 0 : $array['goles2'];

                            $sumResFinalGoles = $goles1 + $goles2;

                            $query_result_points = mysqli_query($connect,"SELECT qrp.rowid, qrp.fk_q_user,qrp.fk_q_pools,qrp.fk_team_1,qrp.team__result_1,qrp.team__result_1_admin,qrp.fk_team_2,qrp.team__result_2,qrp.team__result_2_admin,qrp.status,qrp.comment,qrp.result_admin,qrp.date_Sport,qrp.hour, qrp.hits,qrp.close,qrp.date_Create , (select name from q_sport where qrp.fk_q_user=rowid) as sport,(SELECT result FROM q_pools_details WHERE fk_pools = '".$_REQUEST['rowid']."' AND fk_team_1 = qrp.fk_team_1 AND fk_team_2 = qrp.fk_team_2) as result FROM q_result_pools qrp WHERE qrp.fk_q_pools = '".$fk_q_pools."' AND qrp.fk_q_user = '".$array['userId']."'");

                            $resFinal=0;

                            $sumResFinal=0;



                            while($item_result=mysqli_fetch_array($query_result_points)) {

                                $resFinal = getResult($item_result['team__result_1'], $item_result['team__result_2'], $item_result['team__result_1_admin'], $item_result['team__result_2_admin'], $item_result['result']);

                                $sumResFinal += $resFinal;

                            }



                      ?>

                      <tr>

                        <td><?=$array['name']?> <?=$array['lastname']?></td>

                        <?php if ($_SESSION['user']['type']==0) { ?>

                        <td><?=$array['email'];?></td>

                        <?php }?>

                         <?php if ($_SESSION['user']['type']==0) { ?>

                        <td><?=$array['phone'];?></td>

                         <?php }?>

                        <td><?=$sumResFinal;?></td>
                        <td><?=$sumResFinalGoles;?></td>

                        <?php if ($_SESSION['user']['type']==0) { ?>

                        <td><?=date('d-m-Y',strtotime($array['date_Access']));?></td>

                        <?php }?>

                        <td style="text-align: center;">

                          <a href="result_teams.php?rowid=<?=$array['result'];?>&rowid_user=<?=$array['rowid_user'];?>"><i class="fa fa-fw fa-edit"></i></a>

                        </td>

                      </tr>

                      <?php 

                                              }

                      }

                      ?>

                    </tbody>

                    <tfoot>

                      <tr>

                        <th>Usuario</th>

                        <?php if ($_SESSION['user']['type']==0) { ?>

                        <th>Email</th>

                        <?php }?>

                        <?php if ($_SESSION['user']['type']==0) { ?>

                        <th>Tel&eacute;fono</th>

                        <?php }?>

                        <th>Puntuaci&oacute;n</th>

                        <?php if ($_SESSION['user']['type']==0) { ?>

                        <th>Ultimo Acceso</th>

                        <?php }?>

                        <th>-</th>

                      </tr>

                    </tfoot>

                  </table>

                </div><!-- /.box-body -->

              </div><!-- /.box -->

            </div><!-- /.col -->

          </div><!-- /.row -->

        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->





      <!-- Control Sidebar -->

        <!-- Add the sidebar's background. This div must be placed

           immediately after the control sidebar -->

    </div><!-- ./wrapper -->



    <!-- jQuery 2.1.4 -->

    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>

    <!-- Bootstrap 3.3.5 -->

    <script src="bootstrap/js/bootstrap.min.js"></script>

    <!-- DataTables -->

    <script src="plugins/datatables/jquery.dataTables.min.js"></script>

    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>

    <!-- SlimScroll -->

    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>

    <!-- FastClick -->

    <script src="plugins/fastclick/fastclick.min.js"></script>

    <!-- AdminLTE App -->

    <script src="dist/js/app.min.js"></script>

    <!-- AdminLTE for demo purposes -->

    <script src="dist/js/demo.js"></script>

    <!-- page script -->

    <script>

      $(function () {

        $("#example1").DataTable(
            {
                "order": [[ 3, "desc" ]]
            }
        );

        $('#example2').DataTable({

          "paging": true,

          "lengthChange": false,

          "searching": false,

          "ordering": true,

          "info": true,

          "autoWidth": false

        });

      });

    </script>

  </body>

</html>


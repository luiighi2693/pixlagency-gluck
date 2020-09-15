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
  $date_Create=date("d/m/Y",strtotime($array['date_Create']));



  $query_result = mysqli_query($connect,"SELECT * FROM q_result_pools WHERE fk_q_pools = '".$rowid."' AND fk_q_user = '".$user."'");


}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | Resultado de Clientes</title>
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


          <!-- Table row -->
          <div class="row">
            <div class="col-xs-12 table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Equipo #1</th>
                    <th>Equipo #2</th>
                    <th class="bg-gray disabled color-palette">Resultado #1</th>
                    <th class="bg-gray disabled color-palette">Resultado #2</th>
                    <th class="bg-gray disabled color-palette">Estatus</th>
                    <th class="bg-yellow disabled color-palette">Resultado Admin #1</th>
                    <th class="bg-yellow disabled color-palette">Resultado Admin #2</th>
                    <th class="bg-yellow disabled color-palette">Estatus Admin</th>
                    <th class="bg-aqua disabled color-palette">GANADOR</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                      while($array=mysqli_fetch_array($query_result)){
                  ?>
                  <tr>
                    <td><?=team_pools_result(0, $connect, 1, $array['fk_team_1']);?></td>
                    <td><?=team_pools_result(0, $connect, 1, $array['fk_team_2']);?></td>
                    <td style="text-align: center;"><?=$array['team__result_1'];?></td>
                    <td style="text-align: center;"><?=$array['team__result_2'];?></td>
                    <td style="text-align: center;">
                        <?=($array['status']=="C")?'Sin Comenzar':'';?>
                        <?=($array['status']=="P")?'En Proceso':'';?>
                        <?=($array['status']=="F")?'Finalizado':'';?>
                        <?=($array['status']=="E")?'Empate':'';?>
                        <?=($array['status']=="T")?'Penales':'';?>
                        <?=($array['status']=="S")?'Suspendido':'';?>
                    </td>

                    <td style="text-align: center;"><?=$array['team__result_1_admin'];?></td>
                    <td style="text-align: center;"><?=$array['team__result_2_admin'];?></td>
                    <td style="text-align: center;">
                        <?=($array['result_admin']=="C")?'Sin Comenzar':'';?>
                        <?=($array['result_admin']=="P")?'En Proceso':'';?>
                        <?=($array['result_admin']=="F")?'Finalizado':'';?>
                        <?=($array['result_admin']=="E")?'Empate':'';?>
                        <?=($array['result_admin']=="T")?'Penales':'';?>
                        <?=($array['result_admin']=="S")?'Suspendido':'';?>
                    </td>
                    <th style="text-align: center;" class="<?=($array['hits']==1)?'bg-green color-palette':'bg-red color-palette'?>"><?=($array['hits']==1)?'Si':'No'?></th>
                  </tr>
                  <?php 
                     }
                  ?>                  
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

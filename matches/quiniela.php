<?php
@session_start();
require('Connections/Connections.php');
require('include/security.php');
require('include/functions.php');
require('include/redirect.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | Gluck</title>
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
            Quinielas
            <small>Listado</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Quinielas</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <div class="row">
                <div class="box-body">
                  <?php 
                        $and='';
                      if ($_SESSION['user']['type']==1) {
                        $result='';
                        $query_POO = mysqli_query($connect,"SELECT p.rowid FROM q_user_pools u, q_pools p WHERE p.rowid=u.fk_q_pools AND u.fk_q_user = ".$_SESSION['user']['rowid']);
                         while ($array_POO=mysqli_fetch_array($query_POO)) {
                            $result.= $array_POO['rowid'].',';
                         }
                        $result=substr($result, 0,-1);
                        $and=' AND p.rowid IN ( '.$result.' )';
                      }

                      if($query = mysqli_query($connect,"SELECT p.rowid,p.name,p.date_Create,p.fk_sport,p.color,p.quantity FROM q_pools p, q_pools_details d  WHERE p.rowid=d.fk_pools AND p.status=1 ".$and." GROUP BY d.fk_pools ORDER BY p.date_Create DESC ")){
                        $row=mysqli_num_rows($query);
                        if($row>0){
                           while ($array=mysqli_fetch_array($query)) {
                          $now = time(); // or your date as well
                          $your_date = strtotime($array['date_Create']);
                          $datediff = $now - $your_date;
                    ?>
                      <div class="col-lg-6 col-xs-6">
                            <!-- small box -->
                            <div class="small-box" style="color: #ffffff; background-color: <?=$array['color'];?>">
                              <div class="inner">
                                <h4><?=$array['name'];?></h4>
                                <p><?=sport($array['fk_sport'], $connect, 1);?></p>
                                <p><?=$array['quantity'];?> (Partido)</p>
                              </div>
                              <div class="icon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <a href="resultados.php?rowid=<?=$array['rowid'];?>&param=1" class="small-box-footer">
                                Resultados &nbsp;<i class="fa fa-arrow-circle-right"></i>
                              </a>
                            </div>
                          </div><!-- ./col -->
                      <?php 
                          }
                          }else{
                          echo '<h3>No Existen Quinielas Activas</h3>';
                        }
                      }
                      ?>
              </div><!-- /.row -->
          </div><!-- /.row -->


        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

            <?php include("side-bar.php");  ?> 


      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Slimscroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
  </body>
</html>

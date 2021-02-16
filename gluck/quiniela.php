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
    <link rel="stylesheet" href="Css/style.css">   
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
     <link rel="stylesheet" href="Css/style.css">


    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="assets/css/demo.css" rel="stylesheet" />

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
            Quinielas
            <small>Listado</small>
          </h1>
            <?php
            $result='';
            $query_POO = mysqli_query($connect,"SELECT p.rowid FROM q_user_pools u, q_pools p WHERE p.rowid=u.fk_q_pools AND u.fk_q_user = ".$_SESSION['user']['rowid']);
            while ($array_POO=mysqli_fetch_array($query_POO)) {
                $result.= $array_POO['rowid'].',';
            }
            ?>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Quinielas</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

<!--            <div class="modal fade" id="reglas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"-->
<!--                 style="top: 0%;">-->
<!--                <div class="modal-xl modal-dialog" role="document">-->
<!--                    <div class="modal-content">-->
<!--                        <div class="modal-header">-->
<!---->
<!--                            <h5 class="modal-title" id="exampleModalLabel">Reglas: </h5>-->
<!--                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--                                <span aria-hidden="true">&times;</span>-->
<!--                            </button>-->
<!--                        </div>-->
<!--                        <div class="modal-body">-->
<!---->
<!--                            <h5>Imagen de las reglas aca</h5>-->
<!---->
<!---->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->

          <div class="row">
                <div class="box-body">
                  <?php 
                        $and='';

                  $arrayUserPools=array();

                      if ($_SESSION['user']['type']==1) {
                        $result='';
                        $query_POO = mysqli_query($connect,"SELECT p.rowid FROM q_user_pools u, q_pools p WHERE p.rowid=u.fk_q_pools AND u.fk_q_user = ".$_SESSION['user']['rowid']);
                         while ($array_POO=mysqli_fetch_array($query_POO)) {
                            $result.= $array_POO['rowid'].',';
                            array_push($arrayUserPools, $array_POO['rowid']);
                         }
                        $result=substr($result, 0,-1);
                        $and=' AND p.rowid IN ( '.$result.' )';


//                          if($query = mysqli_query($connect,"SELECT p.rowid,p.name,p.date_Create,p.fk_sport,p.color,p.quantity FROM q_pools p, q_pools_details d  WHERE p.rowid=d.fk_pools AND p.status=1 ".$and." GROUP BY d.fk_pools ORDER BY p.date_Create DESC ")){
                          if($query = mysqli_query($connect,"SELECT p.rowid,p.name,p.date_Create,p.fk_sport,p.color,p.quantity, p.rules, p.password FROM q_pools p, q_pools_details d  WHERE p.rowid=d.fk_pools AND p.status=1 GROUP BY d.fk_pools ORDER BY p.date_Create DESC ")){
                            $row=mysqli_num_rows($query);
                            if($row>0){
                                $i = 0;
                               while ($array=mysqli_fetch_array($query)) {
                                   $i = $i + 1;
                              $now = time(); // or your date as well
                              $your_date = strtotime($array['date_Create']);
                              $datediff = $now - $your_date;
                        ?>
                          <div class="col-lg-6 col-xs-6">
                                <!-- small box -->
                                <div class="small-box" style="color: #ffffff; background-color: <?=$array['color'];?>">
                                  <div class="inner">
                                     <a class="nav-link buscadores" data-toggle="modal" data-target="#reglas-<?=$_SESSION['user']['type'].'-'.$i;?>"> <button type="submit" class="btn btn-info btn-fill">Reglas </button></a>
                                     <a class="nav-link buscadores" data-toggle="modal" data-target="#participantes-<?=$_SESSION['user']['type'].'-'.$i;?>"> <button type="submit" class="btn btn-info btn-fill">Participantes </button></a>
                                     <br>
                                    <h4><?=$array['name'];?></h4>
                                    <p><?=sport($array['fk_sport'], $connect, 1);?></p>
                                    <p><?=$array['quantity'];?> (Partidos)</p>
<!--                                    <p>--><?//=json_encode($arrayUserPools);?><!--</p>-->
<!--                                    <p>--><?//=$array['rowid'];?><!--</p>-->
<!--                                    <p>--><?//=in_array($array['rowid'], $arrayUserPools) ? 'T' : 'F';?><!--</p>-->

                                  </div>
                                  <div class="icon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <a href="resultados.php?rowid=<?=$array['rowid'];?>&param=1" class="small-box-footer" style="display: <?=in_array($array['rowid'], $arrayUserPools) ? 'block;' : 'none;';?>">
                                    Editar Resultados &nbsp;<i class="fa fa-arrow-circle-right"></i>
                                  </a>
                                  <div class="small-box-footer" style="display: <?=!in_array($array['rowid'], $arrayUserPools) ? 'block;' : 'none;';?>">
                                    <input type="password" placeholder="clave de la quiniela..." id="clave-<?=$_SESSION['user']['type'].'-'.$i;?>" style="color: black;">
                                      <a href="#" class="small-box-footer"><i class="fa fa-arrow-circle-right" style="color: white;" onclick="registerPool(<?=$_SESSION['user']['rowid'];?>, <?=$array['rowid'];?>, <?=$array['password'] == null ? '\'\'' : $array['password'];?>, <?='\'clave-'.$_SESSION['user']['type'].'-'.$i.'\'';?>, <?='\'http://getgluck.com/resultados.php?rowid='.$array['rowid'].'&param=1\'';?>);"></i></a>
                                  </div>
                                </div>
                              </div><!-- ./col -->

                                   <div class="modal fade" id="reglas-<?=$_SESSION['user']['type'].'-'.$i;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
                                        style="top: 0%;">
                                       <div class="modal-xl modal-dialog" role="document">
                                           <div class="modal-content">
                                               <div class="modal-header">

                                                   <h5 class="modal-title" id="exampleModalLabel">Reglas: </h5>
                                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                       <span aria-hidden="true">&times;</span>
                                                   </button>
                                               </div>
                                               <div class="modal-body">
                                                   <?php $images=($array['rules']!=null)?$array['rules']:'logo.png';?>
                                                   <img src="images/clients/<?=$images;?>" class="img-circle" alt="User Image" style="width: 100%;">


                                               </div>
                                           </div>
                                       </div>
                                   </div>

                                   <div class="modal fade" id="participantes-<?=$_SESSION['user']['type'].'-'.$i;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
                                        style="top: 0%;">
                                       <div class="modal-xl modal-dialog" role="document">
                                           <div class="modal-content">
                                               <div class="modal-header">

                                                   <h5 class="modal-title" id="exampleModalLabel">Participantes: </h5>
                                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                       <span aria-hidden="true">&times;</span>
                                                   </button>
                                               </div>
                                               <div class="modal-body">

                                                   <ul>
                                                       <?php

                                                       $rowid=$array['rowid'];
                                                       $queryUsers = mysqli_query($connect,"SELECT qu.username FROM q_user_pools qup left join q_user qu on qup.fk_q_user = qu.rowid WHERE fk_q_pools = ".$rowid);
                                                       if($query){
                                                           $i=1;$j=1;
                                                           while ($array_content_users=mysqli_fetch_array($queryUsers)) {
                                                               ?>
                                                               <li class="box-title"><?=$array_content_users['username'];?></li>
                                                               <?php
                                                               $i++; }
                                                       }
                                                       ?>
                                                   </ul>

                                               </div>
                                           </div>
                                       </div>
                                   </div>
                          <?php
                              }
                              }else{
                            }
                          }
                      }
                      ?>
                      <?php 
                        $and='';
                      if ($_SESSION['user']['type']==0) {
//                        $result='';
//                        $query_POO = mysqli_query($connect,"SELECT p.rowid FROM q_user_pools u, q_pools p WHERE p.rowid=u.fk_q_pools AND u.fk_q_user = ".$_SESSION['user']['rowid']);
//                         while ($array_POO=mysqli_fetch_array($query_POO)) {
//                            $result.= $array_POO['rowid'].',';
//                         }
//                        $result=substr($result, 0,-1);
//                        $and=' AND p.rowid IN ( '.$result.' )';


                          if($query = mysqli_query($connect,"SELECT p.rowid,p.name,p.date_Create,p.fk_sport,p.color,p.quantity FROM q_pools p, q_pools_details d  WHERE p.rowid=d.fk_pools AND p.status=1 GROUP BY d.fk_pools ORDER BY p.date_Create DESC ")){
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
                                    <a class="nav-link buscadores" data-toggle="modal" data-target="#reglas-<?=$_SESSION['user']['type'].'-'.$i;?>"> <button type="submit" class="btn btn-info btn-fill">Reglas </button></a>
                                      <a class="nav-link buscadores" data-toggle="modal" data-target="#participantes-<?=$_SESSION['user']['type'].'-'.$i;?>"> <button type="submit" class="btn btn-info btn-fill">Participantes </button></a>

                                      <h4><?=$array['name'];?></h4>
                                    <p><?=sport($array['fk_sport'], $connect, 1);?></p>
                                    <p><?=$array['quantity'];?> (Partidos)</p>
                                  </div>
                                  <div class="icon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                </div>
                              </div><!-- ./col -->

                                   <div class="modal fade" id="reglas-<?=$_SESSION['user']['type'].'-'.$i;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
                                        style="top: 0%;">
                                       <div class="modal-xl modal-dialog" role="document">
                                           <div class="modal-content">
                                               <div class="modal-header">

                                                   <h5 class="modal-title" id="exampleModalLabel">Reglas: </h5>
                                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                       <span aria-hidden="true">&times;</span>
                                                   </button>
                                               </div>
                                               <div class="modal-body">

                                                   <?php $images=($array['img']!='')?$array['rules']:'logo.png';?>
                                                   <img src="images/clients/<?=$images;?>" class="img-circle" alt="User Image" style="width: 100%;">


                                               </div>
                                           </div>
                                       </div>
                                   </div>

                                   <div class="modal fade" id="participantes-<?=$_SESSION['user']['type'].'-'.$i;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
                                        style="top: 0%;">
                                       <div class="modal-xl modal-dialog" role="document">
                                           <div class="modal-content">
                                               <div class="modal-header">

                                                   <h5 class="modal-title" id="exampleModalLabel">Participantes: </h5>
                                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                       <span aria-hidden="true">&times;</span>
                                                   </button>
                                               </div>
                                               <div class="modal-body">

                                                   <ul>
                                                       <?php

                                                       $rowid=$array['rowid'];
                                                       $queryUsers = mysqli_query($connect,"SELECT qu.username FROM q_user_pools qup left join q_user qu on qup.fk_q_user = qu.rowid WHERE fk_q_pools = ".$rowid);
                                                       if($query){
                                                           $i=1;$j=1;
                                                           while ($array_content_users=mysqli_fetch_array($queryUsers)) {
                                                               ?>
                                                               <li class="box-title"><?=$array_content_users['username'];?></li>
                                                               <?php
                                                               $i++; }
                                                       }
                                                       ?>
                                                   </ul>

                                               </div>
                                           </div>
                                       </div>
                                   </div>
                          <?php
                              }
                              }else{
                            }
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
    <!--   Core JS Files   -->
<script src="assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="assets/js/plugins/bootstrap-switch.js"></script>
     <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="js/mfn.menu.js"></script>
    <script type="text/javascript" src="js/jquery.plugins.js"></script>
    <script type="text/javascript" src="js/jquery.jplayer.min.js"></script>
    <script type="text/javascript" src="js/animations/animations.js"></script>
    <script type="text/javascript" src="js/email.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>

  <script>
      function registerPool(userId, poolId, password, userPasswordId, url) {
          console.log(userId, poolId, password, $('#' + userPasswordId).val(), url);

          password = password == null ? "" : password.toString();

          if (password !== $('#' + userPasswordId).val()) {
              alert('Clave incorrecta!');
          } else {
              $.ajax({
                  url : 'external/actions.php',
                  data : { rowid : poolId, userId : userId, type: '3' },
                  type : 'POST',

                  success : function(json) {
                      console.log(json);

                      window.location.href = url;
                  },

                  error : function(xhr, status) {
                      alert('Disculpe, existió un problema');
                  },

                  complete : function(xhr, status) {
                      console.log('Petición realizada');
                  }
              });
          }
      }
  </script>
  </body>
</html>

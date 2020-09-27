<?php
@session_start();
require('Connections/Connections.php');
require('include/security.php');
require('include/functions.php');
require('include/redirect.php');
   
if(isset($_REQUEST['submit']) )
{ 

$subject=$_REQUEST['subject'];   
$message=$_REQUEST['message'];

//Get uploaded file data using $_FILES array 
$tmp_name    = $_FILES['my_file']['tmp_name']; // get the temporary file name of the file on the server 
$name        = $_FILES['my_file']['name'];  // get the name of the file 
$size        = $_FILES['my_file']['size'];  // get size of the file for size validation 
$type        = $_FILES['my_file']['type'];  // get type of the file 
$error       = $_FILES['my_file']['error']; // get the error (if any) 
  
$fk_sport = $_REQUEST['sport'];

$query = mysqli_query($connect,"INSERT INTO q_template (subjet, message) VALUES ('".addslashes($subject)."','".addslashes($message)."')");
$row_id=mysqli_insert_id($connect);


for ($i=0;$i<count($fk_sport);$i++)    
{     
   $query = mysqli_query($connect,"SELECT t.rowid FROM q_sport s, q_team t  WHERE s.rowid = t.fk_sport  AND s.rowid =  '".$fk_sport[$i]."'");
   while($array=mysqli_fetch_array($query)){
     $query2 = mysqli_query($connect,"SELECT u.email, u.rowid FROM q_user_team ut, q_user u  WHERE u.rowid = ut.fk_q_user  AND ut.fk_q_team =  '".$array['rowid']."' GROUP BY u.rowid");
     while($array2=mysqli_fetch_array($query2)){
        $email.=$array2['email'].', ';
        $query_log = mysqli_query($connect,"INSERT INTO q_notifications (fk_q_user, fk_template) VALUES ( '".$array2['rowid']."', '".$row_id."')");

     }
   }
} 

$a_val = explode(',',$email);
$a_result = array_unique($a_val);
$varible  = implode(",",$a_result);
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$result=mail($varible, $subject, $message, $cabeceras);
} 
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | Gluck </title>
    <!-- Tell the browser to be responsive to screen width -->
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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- FONT AWESOME-->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  </head>
  <body class="hold-transition skin-black sidebar-mini">
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
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Instrumentos</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?=quinielas_activas( $connect );?></h3>
                  <?php
                if ($_SESSION['user']['type']==1) {
                ?>
                  <p>Quinielas Disponibles para entrar</p> 
                  <?php } ?>
                  <?php
                if ($_SESSION['user']['type']==0) {
                ?>
                  <p>Quinielas Activas</p> 
                  <?php } ?>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                   <a href="quiniela.php" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <?php if ($_SESSION['user']['type']==0) { ?>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?=user_home( $connect );?></h3>
                  <p>Usuarios Activos</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                   <a href="q_user_list.php" class="small-box-footer">Detalles <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <?php }else{?>

            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?=ranking( $connect , $_SESSION['user']['rowid']);?></h3>
                  <p>Resultados (Quinielas Cerradas)</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                   <a href="q_pools_list_result.php" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->

            <?php }?>

            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?=team_home( $connect );?></h3>
                  <p>Partidos Activos</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <?php if ($_SESSION['user']['type']==0) { ?>
                   <a href="q_pools_list.php" class="small-box-footer">Detalles <i class="fa fa-arrow-circle-right"></i></a>
                <?php }else{?>
                   <a href="quiniela.php" class="small-box-footer">Detalles <i class="fa fa-arrow-circle-right"></i></a>
                <?php }?>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?=sport_home( $connect );?></h3>
                  <p>Deportes Activos</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <?php if ($_SESSION['user']['type']==0) { ?>
                   <a href="q_sport_list.php" class="small-box-footer">Detalles <i class="fa fa-arrow-circle-right"></i></a>
                <?php }else{?>
                   <a href="quiniela.php" class="small-box-footer">Detalles <i class="fa fa-arrow-circle-right"></i></a>
                <?php }?>                
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">
             

              <!-- Chat box -->
            

              <!-- TO DO List -->
              <div class="box box-primary">
                <div class="box-header">
                  <i class="ion ion-clipboard"></i>
                  <h3 class="box-title">Quinielas en proceso</h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                 <ul class="todo-list">
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

                      if($query = mysqli_query($connect,"SELECT p.rowid,p.name,p.date_Create,p.fk_sport,p.color,p.quantity FROM q_pools p, q_pools_details d  WHERE p.rowid=d.fk_pools AND p.status=1 ".$and." GROUP BY d.fk_pools ORDER BY p.date_Create DESC limit 10")){
                        while ($array=mysqli_fetch_array($query)) {
                          $now = time(); // or your date as well
                          $your_date = strtotime($array['date_Create']);
                          $datediff = $now - $your_date;
                    ?>
      
                    <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <span class="text"><?=$array['name'];?></span>
                      <span class="text"><?=sport($array['fk_sport'], $connect, 1);?></span>
                      <span class="text"><?=$array['quantity'];?> (Partidos)</span>
                      <small style="color: #ffffff; background-color: <?=$array['color'];?>">&nbsp;&nbsp;<i class="fa fa-clock-o"></i> <?=round($datediff / (60 * 60 * 24));?> D&iacute;as &nbsp;&nbsp;</small>
                      <div class="tools">
                        <?php if($_SESSION['user']['type']==0) {  ?>
                          <a href="q_pools.php?rowid=<?=$array['rowid'];?>&param=edit"><i class="fa fa-edit"></i></a>
                        <?php }else{ ?>
                          <a href="quiniela.php?rowid=<?=$array['rowid'];?>"><i class="fa fa-plus"></i></a>
                        <?php } ?>
                      </div>
                    </li>
                      <?php 
                          }
                      }
                      ?>
                  </ul> 
                </div><!-- /.box-body -->
                <?php
                if ($_SESSION['user']['type']==0) {
                ?>
                <div class="box-footer clearfix no-border">
                  <a href="q_pools.php?rowid=0&param=insert">
                      <button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Agregar Quiniela</button>
                   </a>
                </div>
                <?php
                }
                ?>
              </div><!-- /.box -->

                <?php
                if ($_SESSION['user']['type']==0) {
                ?>
                <form enctype="multipart/form-data" method="POST" > 
              <div class="box box-info">
                <div class="box-header">
                  <i class="fa fa-envelope"></i>
                  <h3 class="box-title">Enviar E-mail a los usuarios</h3>
                  <!-- tools box -->
                  <div class="pull-right box-tools">
                    <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div><!-- /. tools -->
                </div>
                <div class="box-body">
                  <form action="#" method="post">
                    <div class="form-group">
                          <select  class="form-control select2" multiple="multiple" required="required" name="sport[]" style="width: 100%;">
                            <?=sport(0, $connect);?>
                          </select>
                    </div>
                    <div class="form-group">
                              <input class="form-control" placeholder="Subject:" name="subject">
                    </div>
                    <div>
                     
                      <textarea id="compose-textarea" class="form-control" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="message">

                      </textarea>


                    </div>
                  </form>
                </div>
                <div class="box-footer clearfix">
                              <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Enviar</button>
                </div>
              </div>
                                  </form>

                <?php

                }
                ?>
            </section><!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5 connectedSortable">
               
                <?php
                if ($_SESSION['user']['type']==1) {
                ?>

               <div class="box box-primary">
                <div class="box-header">
                  <i class="ion ion-clipboard"></i>
                  <h3 class="box-title">Otras Quinielas </h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                 <ul class="todo-list">
                  <?php 
                        $and='';
                      if ($_SESSION['user']['type']==1) {
                        $result='';
                        $query_POO = mysqli_query($connect,"SELECT p.rowid FROM q_user_pools u, q_pools p WHERE p.rowid=u.fk_q_pools AND u.fk_q_user = ".$_SESSION['user']['rowid']);
                         while ($array_POO=mysqli_fetch_array($query_POO)) {
                            $result.= $array_POO['rowid'].',';
                         }
                        $result=substr($result, 0,-1);
                        $and=' AND p.rowid NOT IN ( '.$result.' )';
                      }

                      if($query = mysqli_query($connect,"SELECT p.rowid,p.name,p.date_Create,p.fk_sport,p.color,p.quantity FROM q_pools p, q_pools_details d  WHERE p.rowid=d.fk_pools AND p.status=1 ".$and." GROUP BY d.fk_pools ORDER BY p.date_Create DESC limit 10")){
                        while ($array=mysqli_fetch_array($query)) {
                          $now = time(); // or your date as well
                          $your_date = strtotime($array['date_Create']);
                          $datediff = $now - $your_date;
                    ?>
      
                    <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <span class="text"><?=$array['name'];?></span>
                      <span class="text"><?=sport($array['fk_sport'], $connect, 1);?></span>
                      <span class="text"><?=$array['quantity'];?> (Usuarios)</span>
                      <small style="color: #ffffff; background-color: <?=$array['color'];?>">&nbsp;&nbsp;<i class="fa fa-clock-o"></i> <?=round($datediff / (60 * 60 * 24));?> D&iacute;as &nbsp;&nbsp;</small>
                      
                    </li>
                      <?php 
                          }
                      }
                      ?>
                  </ul> 
                </div><!-- /.box-body -->

              </div><!-- /.box -->
                      <?php 
                          
                      }
                      ?>
              <!-- Map box -->
               <?php if ($_SESSION['user']['type']==0) { ?>
              <div class="box box-solid bg-light-blue-gradient">
                <div class="box-header">
                  <!-- tools box -->
                  <div class="pull-right box-tools">
                    <button type="button" class="btn btn-primary btn-sm daterange pull-right" data-toggle="tooltip" title="Date range"><i class="fa fa-calendar"></i></button>
                    <button type="button" class="btn btn-primary btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="Collapse" style="margin-right: 5px;"><i class="fa fa-minus"></i></button>
                  </div><!-- /. tools -->

                  <i class="fa fa-map-marker"></i>
                  <h3 class="box-title">
                    Visitors
                  </h3>
                </div>
                <div class="box-body">
                  <div id="world-map" style="height: 250px; width: 100%;"></div>
                </div><!-- /.box-body-->
                <div class="box-footer no-border">
                  <div class="row">
                    <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                      <div id="sparkline-1"></div>
                      <div class="knob-label">Visitors</div>
                    </div><!-- ./col -->
                    <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                      <div id="sparkline-2"></div>
                      <div class="knob-label">Online</div>
                    </div><!-- ./col -->
                    <div class="col-xs-4 text-center">
                      <div id="sparkline-3"></div>
                      <div class="knob-label">Exists</div>
                    </div><!-- ./col -->
                  </div><!-- /.row -->
                </div>
              </div>
               <?php }?>
              <!-- /.box -->

              <!-- solid sales graph -->
            

            </section><!-- right col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


     
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>

    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>       

    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
  </body>
</html>

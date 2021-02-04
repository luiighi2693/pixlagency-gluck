<?php
@session_start();
require('Connections/Connections.php');
require('include/security.php');
require('include/functions.php');

if (isset($_REQUEST['rowid']) and isset($_REQUEST['param'])) {
  mysqli_query($connect,"DELETE FROM q_pools WHERE rowid = ".$_REQUEST['rowid']);
  mysqli_query($connect,"DELETE FROM q_user_pools WHERE fk_q_pools = ".$_REQUEST['rowid']);
  mysqli_query($connect,"DELETE FROM q_pools_details WHERE fk_pools = ".$_REQUEST['rowid']);
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | Listado de Quinielas</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/a0da89506f.js" crossorigin="anonymous"></script>
    <!-- Ionicons -->
    <link rel="stylesheet" href="//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
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
            Listado de Quinielas
            <small>Informaci&oacute;n General</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Quinielas</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
                 <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Listado de Quinelas</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style="width: 50%">Nombre</th>
                        <th>Deporte</th>
                        <th>Estatus</th>
                        <th>Fecha Creaci&oacute;n</th>
                        <th>-</th>
                        <th>-</th>
                        <th>Color</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $and='';
                      if (isset($_REQUEST['fk_sport'])) {
                         $and=' AND fk_sport = '.$_REQUEST['fk_sport'];
                      }   

                      if ($_SESSION['user']['type']==1) {
                        $result='';
                        $query_POO = mysqli_query($connect,"SELECT p.rowid FROM q_user_pools u, q_pools p WHERE p.rowid=u.fk_q_pools AND u.fk_q_user = ".$_SESSION['user']['rowid']." AND p.status <> 3");
                         while ($array_POO=mysqli_fetch_array($query_POO)) {
                            $result.= $array_POO['rowid'].',';
                         }
                        $result=substr($result, 0,-1);
                        $and.=' AND rowid IN ( '.$result.' )';
                      }

                      if($query = mysqli_query($connect,"SELECT * FROM q_pools WHERE status = 1 ".$and." ORDER BY date_Create DESC")){
                        while ($array=mysqli_fetch_array($query)) {
                      ?>
                      <tr>
                        <td><?=$array['name'];?></td>
                        <td><a href="q_pools_list.php?fk_sport=<?=$array['fk_sport'];?>"><?=sport($array['fk_sport'], $connect, 1);?></a></td>
                        <td><?=($array['status']==1)?'<small class="label label-success">Activo</small>':'<small class="label label-danger">Inactivo</small>';?></td>
                        <td><?=date('d-m-Y',strtotime($array['date_Create']));?></td>
                        <td style="text-align: center;">
                          <?php if($_SESSION['user']['type']==0) {  ?>
                              <a href="q_pools.php?rowid=<?=$array['rowid'];?>&param=edit"><i title="edit" class="fa fa-fw fa-edit"></i></a>
                          <?php }else{ ?>
                              <a href="quiniela.php?rowid=<?=$array['rowid'];?>"><i class="fa fa-plus"></i></a>
                          <?php } ?>
                        </td>
                        <td style="text-align: center;">
                          <?php if($_SESSION['user']['type']==0) {  ?>
                             <a href="#" data-toggle="modal" data-target="#Modal<?=$array['rowid'];?>"><i title="delete" class="fa fa-eraser"></i></a>
                          <?php }else{ ?>
                              <a href="quiniela.php?rowid=<?=$array['rowid'];?>"><i class="fa fa-plus"></i></a>
                          <?php } ?>
                        </td>
                        <td >
                          <small style="color:white;  background-color: <?=$array['color'];?>"><?=$array['color'];?></small>
                        </td>
                      </tr>

                      <div id="Modal<?=$array['rowid'];?>" class="modal fade" role="dialog">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header" style="color:white;  background-color: <?=$array['color'];?>">
                                <h5 class="modal-title">Eliminar Quiniela</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <p><?=$array['name'];?></p>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-primary">
                                  <a href="q_pools_list.php?rowid=<?=$array['rowid'];?>&param=delete" style="color: white;">Eliminar</a>
                                </button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                              </div>
                            </div>
                          </div>
                        </div>

                      <?php 
                                              }
                      }
                      ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th style="width: 60%">Nombre</th>
                        <th>Deporte</th>
                        <th>Estatus</th>
                        <th>Fecha Creaci&oacute;n</th>
                        <th>-</th>
                        <th>Color</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include("side-bar.php");  ?> 


      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
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
        $("#example1").DataTable();
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

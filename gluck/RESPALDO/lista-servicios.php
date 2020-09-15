<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Lista de Quinielas </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
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
            <!-- Panel lateral de usuario -->
      <?php include("panel-usuario.php");?>


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Servicios de BLUEweb
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="#">Clientes</a></li>
            <li class="active">Lista de servicios</li>
          </ol>
        </section>

        <!-- Main content -->
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Lista de servicios</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped" style="table-layout: fixed;">
                    <thead>
                      <tr>
                        <th width="3%"><div align='center'>Codigo</div></th>
                        <th width="20%" ><div align='center'>Servicio</div></th>
                        <th width="20%" ><div align='center'>Tipo de servicio</div></th>
                        <th width="60%"><div align='center'>Descripcion</div></th>
                        <th width="5%"><div align='center'>Costo</div></th>
                        <th width="10%"><div align='center'>Opciones</div></th>
                      </tr>
                    </thead>
                    <tbody>
                          <?php 
                                include("control/conex.php");
                                $QUERY=mysql_query("SELECT codigo_servicio,servicio,tipo_servicio,costo_servicio,descripcion_servicio FROM servicios ORDER BY codigo_servicio") or die ("ERROR CONSULTA -> ".mysql_error());
                                $numero_filas=mysql_num_rows($QUERY);
                                  while($fila=mysql_fetch_array($QUERY)){
                                      echo "<tr>     


                                                            <td><div align='center'>".$fila["codigo_servicio"]."</div></td>
                                                            <td> ".$fila["servicio"]."</td>
                                                            <td>".$fila["tipo_servicio"]."</td>
                                                            <td style='word-wrap:break-word' align='center'>".$fila["descripcion_servicio"]."</td>
                                                            <td><div align='center'>".$fila["costo_servicio"]."</div></td>
                                                            <td> <a href='modificar-servicio.php?id=".$fila['codigo_servicio']."' title='Editar Cliente'><button style='margin-left: 10%;background-color#F1DD96;' type='button' class='btn btn-primary'  title='Modificar Servicio'><i class='fa fa-pencil'></i></button>
                                                            </a> 
                        
                                                                 <a href='eliminar-servicio.php?id=".$fila['codigo_servicio']."'><button style='margin-left: 10%' type='button' class='btn btn-danger' title='Eliminar Servicio'><i class='fa fa-trash-o'  style='font-size: 1em'></i></button></a></td>
                                                            </tr>";
                                                            }
                                                    
                                  #sin registros
                          ?>



                                      <div id="myModal" class="modal hide fade">
                                      <div class="modal-header">
                                        <button class="close" data-dismiss="modal">&times;</button>
                                        <h3>Title</h3>
                                      </div>
                                      <div class="modal-body">            
                                          <div id="modalContent">

                                          </div>
                                      </div>
                                      <div class="modal-footer">
                                        <a href="#" class="btn btn-info" data-dismiss="modal" >Close</a>
                                      </div>
                                      </div>

                                       <script>
                                      $('.modalLoad').click(function() { 
                                      $('#modificarcliente').modal('show') // evento que lanza la ventana
                                         $('#modalContent').val('');
                                        $('#modalContent').load($(this).attr('href'));
                                        return false;
                                      });
                                      </script>

                    </tbody>
                    <!--
                    <tfoot>
                      <tr>
                        <th>Rendering engine</th>
                        <th>Browser</th>
                        <th>Platform(s)</th>
                        <th>Engine version</th>
                        <th>CSS grade</th>
                      </tr>
                    </tfoot>
                    -->
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div>

<!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b></b>
        </div>
        <strong></a>.</strong>
      </footer>

      <!-- Control Sidebar -->
      <?php include("side-bar.php");  ?> 
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->

      <div class="control-sidebar-bg"></div>

<!-- //////////////////////////MODALES/////////////////////////  -->


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

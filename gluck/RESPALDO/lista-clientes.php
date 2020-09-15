<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Quiniela| Users</title>
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
           Users
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="#">Clientes</a></li>
            <li class="active">Lista de clientes</li>
          </ol>
        </section>

        <!-- Main content -->
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"> Lista de clientes</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Nombre del cliente</th>
                        <th>Empresa</th>
                        <th>Correo electronico</th>
                        <th>Direccion web</th>
                        <th>Estatus</th>
                        <th>Opciones</th>
                      </tr>
                    </thead>
                    <tbody>
                          <?php 
                                include("control/conex.php");
                                $QUERY=mysql_query("SELECT id,nombre_cliente,empresa_cliente,correo_cliente,direccion_web,estatus_cliente,fecha_registro FROM clientes ORDER BY fecha_registro DESC") or die ("ERROR CONSULTA -> ".mysql_error());
                                $numero_filas=mysql_num_rows($QUERY);
                                  while($fila=mysql_fetch_array($QUERY)){
                                      echo "<tr>     


                                                            <td>".$fila["nombre_cliente"]."</td>
                                                            <td> ".$fila["empresa_cliente"]."</td>
                                                            <td>".$fila["correo_cliente"]."</td>
                                                            <td>".$fila["direccion_web"]."</td>
                                                            <td>".$fila["estatus_cliente"]."</td>
                                                            <td> <a href='actualizar-cliente.php?id=".$fila['id']."' title='Editar Cliente'><button style='margin-left: 10%;background-color#F1DD96;' type='button' class='btn btn-warning'  title='Modificar Cliente'><i class='fa fa-pencil-square-o' style='font-size: 1em'></i></button></a> 
                        
                                                                 <a href='eliminar-cliente.php?id=".$fila['id']."'><button style='margin-left: 10%' type='button' class='btn btn-danger'  title='Eliminar Cliente'><i class='fa fa-trash-o'  style='font-size: 1em'></i></button></a></td>
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

     
      <div id="eliminarcliente" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">¿Esta seguro que desea eliminar este cliente?.</h4>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-succes">Si</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
          </div>

        </div>
      </div>





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

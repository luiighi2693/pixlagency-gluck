<?php 
include("control/conex.php");
$QUERY=mysql_query("SELECT id,nombre_cliente,empresa_cliente,numero_cliente,correo_cliente,direccion_web,estatus_cliente FROM clientes") or die ("ERROR CONSULTA -> ".mysql_error());
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Data Tables</title>
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
            Calcular Presupuesto de servicios
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="#">Clientes</a></li>
            <li class="active">Lista de clientes</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"> Realizar nuevo presupuesto</h3>
                </div><!-- /.box-header -->
                <div class="box-body"> 


                 <form role="form" name="Calcular Presupuesto" method="post" type="submit" action="nuevo-presupuesto.php">
                          

                          <select name="cliente">
                          Seleccionar cliente:
                          <?php 
                                if(!empty($_POST['cliente'])){
                                    $presupuestocliente =$_POST['cliente'];
                                }

                                include("control/conex.php");
                                $QUERY=mysql_query("SELECT id,nombre_cliente FROM clientes") or die ("ERROR CONSULTA -> ".mysql_error());
                                $numero_filas=mysql_num_rows($QUERY);
                                  while($fila=mysql_fetch_array($QUERY)){
                                    if ($fila["id"] ==$presupuestocliente){
                                      echo "
                                     <option value='".$fila["id"]."' selected>".$fila["nombre_cliente"]."</option>";
                                   }else{ echo "<option value='".$fila["id"]."'>".$fila["nombre_cliente"]."</option>";
                                   }
                                }
                                                   
                          ?>

                           </select>

                           <select name="servicio">
                            <?php 
                            if(!empty($_POST['servicio'])){
                                   $servicio2=$_POST['servicio'];
                             }

                                include("control/conex.php");
                                $QUERY=mysql_query("SELECT codigo_servicio,servicio FROM servicios") or die ("ERROR CONSULTA -> ".mysql_error());
                                $numero_filas=mysql_num_rows($QUERY);
                                  while($fila=mysql_fetch_array($QUERY)){
                                    if ($fila["codigo_servicio"] ==$servicio2){
                                      echo "<option value='".$fila["codigo_servicio"]."' selected> ".$fila["servicio"]."</option> ";
                                     }else{ echo "<option value='".$fila["codigo_servicio"]."'> ".$fila["servicio"]."</option> ";
                                     }
                              }                          
                          ?>

                          </select>

                          <select name="cantidad" form-control select2>
                          <?php  
                                 if(!empty($_POST['cantidad'])){
                                    $cantidad =$_POST['cantidad'];
                                  }else{ 
                                    $cantidad='1';}
                          ?>
                            <option value="1" <?=(($cantidad=="1")?"selected":"");?>>1</option>
                            <option value="2" <?=(($cantidad=="2")?"selected":"");?>>2</option>
                            <option value="3" <?=(($cantidad=="3")?"selected":"");?>>3</option>
                            <option value="4" <?=(($cantidad=="4")?"selected":"");?>>4</option> 
                            <option value="5" <?=(($cantidad=="5")?"selected":"");?>>5</option>
                            <option value="6" <?=(($cantidad=="6")?"selected":"");?>>6</option> 
                          </select>
                          
                          <button style='margin-left: 10%;background-color#F1DD96;' type='submit' class='btn btn-warning'  title='Calcular Presupuesto'><i class='fa fa-pencil-square-o' style='font-size: 1em'></i></button> 
                          <?php 
                           if(!empty($_POST['cantidad'])){
                                    $cantidad =$_POST['cantidad'];
                                  }else{ $cantidad ='1';}
                          if(!empty($_POST['servicio'])){
                             $QUERY=mysql_query("SELECT codigo_servicio,servicio,tipo_servicio,costo_servicio,descripcion_servicio FROM servicios WHERE codigo_servicio=".$_POST['servicio'].";") or die ("ERROR CONSULTA -> ".mysql_error());
                                $numero_filas=mysql_num_rows($QUERY);
                                  while($servicio=mysql_fetch_array($QUERY)){
                                    setlocale(LC_MONETARY,"de_DE");
                                    $costo = number_format($cantidad*($servicio["costo_servicio"]), 2, ',', ' ');
                                    $cero= '0';
                                    $impuesto_servicio='21';
                                    $impuesto_servicio= number_format($cantidad * ($servicio["costo_servicio"] * ($cero.".".$impuesto_servicio)), 2, ',', ' ');
                                    $total = number_format($cantidad * ($servicio["costo_servicio"] + ($servicio["costo_servicio"] * ($cero.".".$impuesto_servicio))), 2, ',', ' ');
                                    echo "Presupuesto del servicio: ".$servicio["servicio"];
                                    echo "<br />"."Costo: ".$costo." €"."<br />";
                                    echo "Impuesto: ".$impuesto_servicio." €"."<br />";
                                    echo "Total: ".$total." €"; }
                          }else{ echo "0 000,00 €";}
                          ?>

                         </form>
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
                   
                  </table> -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
          </section>
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

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Blueweb | Registrar Servicio</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
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
            Registro de nuevo servicio
            <small>visualizar</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="#">Servicios</a></li>
            <li class="active">Agregar servicio</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Agregar un nuevo servicio</h3>
                </div><!-- /.box-header -->
             <form role="form" name="registro-servicio" method="post" type="submit" action="control/registro-servicio.php">
                    <div class="box-body table-responsive">
                      <table class="table table-hover">
                        <tr>
                          <th>Servicio</th>
                          <th>Tipo de Servicio</th>
                          <th style="padding-left:50px;">Descripción</th>
                          <th  style="padding-left:20px;">Costo</th>
                          <!--<th>Impuesto</th>-->
                          <th></th>
                        </tr>
                        <tr>
                          <td><input type="text" name="servicio" class="form-control" placeholder="Nombre del Servicio"></td>
                          <td><input type="text" name="tipo_servicio" class="form-control" placeholder="Tipo de Servicio"></td>
                          <td style="padding-left:50px;"><textarea type="text" name="descripcion_servicio" cols="40" rows="5" placeholder="Descripción del servicio" ... ></textarea></td>
                          <td>(€)<input  type="number" step="any" name="costo_servicio" pattern="(\d{3})([\.])(\d{2})"></td>
                          <!--<td>
                          <select name="taskOption">
                            <option value="0">0%</option>
                            <option value="21">21%</option>
                          </select>
                          </td>-->
                          <td><button type="submit" id="enviar" name="enviar" class="col-md-offset-5 btn btn-primary"><i class="fa fa-plus"></i> Agregar</button></td>
                        </tr>
                      </table>
                    </div>
            </form><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>

        </section><!-- /.content -->
      </div><!-- /.content-wrapper
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
      </footer>
<!-- Sidebar -->
      <?php include("side-bar.php");  ?> 

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

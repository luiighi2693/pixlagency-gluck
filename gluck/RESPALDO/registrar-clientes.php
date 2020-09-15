<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Blueweb | Registrar cliente</title>
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
            Registro de nuevo cliente
            <small>visualizar</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="#">Clientes</a></li>
            <li class="active">Registrar Clientes</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-6 col-md-offset-3">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Formulario de registro</h3>
                </div><!-- /.box-header -->
                <!-- form start --> 
                <form role="form" name="registro-clientes" method="post" type="submit" action="control/registro-cliente.php">
                  <div class="box-body">

                   <div class="form-group">
                      <label>Cliente:</label>
                      <input type="text" name="nombre_cliente" class="form-control" placeholder="Nombre del cliente">
                    </div>

                    <div class="form-group">
                      <label>Empresa:</label>
                      <input type="text" name="empresa_cliente" class="form-control" placeholder="Nombre de la empresa" required/>
                    </div>
                          
                  <div class="form-group">
                      <label>Numero telef&oacute;nico:</label>                         
                       <input type="tel" name="numero_cliente" class="form-control" placeholder="Numero telefonico" required />
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Correo electr&oacute;nico:</label>
                      <input type="email" name="correo_cliente" class="form-control" id="exampleInputEmail1" placeholder="Correo electr&oacute;nico">
                    </div>

                     <div class="form-group">
                      <label for="exampleInputEmail1">Direcci&oacute;n de la web:</label>
                      <input type="url" name="direccion_web" class="form-control" id="exampleInputEmail1" placeholder="Dominio de la web">
                    </div>
                    
                    <!--
                    <div class="checkbox">
                      <label>
                        <input type="checkbox"> Check me out
                      </label>
                    </div>

                  </div><!-- /.box-body 


<!-- Button trigger modal 
<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModalNorm">
    Launch Normal Form
</button>

<!-- Modal
<div class="modal fade" id="myModalNorm" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header 
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Modal title
                </h4>
            </div>
            
            <!-- Modal Body -->
            
            <!-- Modal Footer -->

        </div>
                  <div class="box-footer">
                    <button type="submit" id="enviar" name="enviar" class="col-md-offset-5 btn btn-primary"><i class="fa fa-user-plus"></i> Registrar</button>
                  </div>
                </form>
              </div><!-- /.box -->   
            </div><!--/.col (left) -->
            <!-- right column -->

          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
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

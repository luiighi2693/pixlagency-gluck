<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Blueweb | Actualizar cliente</title>
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
            Data Tables
            <small>advanced tables</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Editar usuario: </a></li>
            <li class="active">Data tables</li>
          </ol>
        </section>

        <!-- Main content -->
	<style>
	.modal {
	  display:block;
	}
	</style>

              <div class="box">
              <?php  
				include("control/conex.php");
				$QUERY=mysql_query("SELECT codigo_servicio,servicio,tipo_servicio,costo_servicio,descripcion_servicio FROM servicios WHERE codigo_servicio=$_GET[id]") or die ("ERROR CONSULTA -> ".mysql_error());
				while($fila=mysql_fetch_array($QUERY)){					
				echo "

					<form action='control/modificarservicio.php' method='post'>
						<div id='mymodal' class='modal fade in' >
							 <div class='modal-dialog'>
								<div class='modal-content'>
						            <div class='modal-header'>
						                <h4 class='modal-title'>Modificar el servicio: ".$fila['servicio']." </h4>
						            </div> 
									<div class='modal-body'>
							                <div class='row'>
											        <div class='col-sm-9 col-sm-offset-1'>
													        <div class='row'>
											                    <div class='form-group'> 
																	<div class='form-group'>
												                      <label>Servicio:</label>
												                      <input type='text' name='servicio' class='form-control' placeholder='".$fila['servicio']."'>
												                    </div>

												                    <div class='form-group'>
												                      <label>Tipo de servicio:</label>
												                      <input type='text' name='tipo_servicio' class='form-control' placeholder='".$fila['tipo_servicio']."'/>
												                    </div>
												                          
												                  <div class='form-group'>
												                      <label>Costo:</label>                        
												                       <input type='number' step='any' name='costo_servicio' pattern='(\d{3})([\.])(\d{2})' class='form-control' placeholder='".$fila['costo_servicio']."' />
												                    </div>

												                    <div class='form-group'>
												                      <label for='exampleInputEmail1'>Descripción del servicio:</label>
                                              <textarea type='text' name='descripcion_servicio' cols='40' rows='5' class='form-control' placeholder='".$fila['descripcion_servicio']."' ></textarea>
												                    </div>

											                    </div>
										   					</div>
									      		    </div>
								            </div>
								            <div class='modal-footer'>
                            <input type='hidden' name='id' value=".$fila['codigo_servicio'].">
											    <button type='submit' type='submit' class='btn btn-success'><i class='fa fa-refresh'></i> Actualizar</button>
												<a href='lista-servicios.php'><button type='button' class='btn btn-danger'  value='Abrir'><i class='fa fa-arrow-left'></i> Volver a lista de Servicios</button></a>
										    </div>
							    	</div>
						        </div>
					   	    </div> 
						</div> 
					 <div class='modal-backdrop fade in'></div>
					</form>
				   ";}?>

	<!-- //////////////////////////MODALES///////////////////////// 
        <div class="box-header">
                  <h3 class="box-title">Lista de clientes</h3>
                </div><!-- /.box-header -->
               <div class="box-body">

			

              
     		    </div>
				</div>
<!-- /.content-wrapper 
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
         
        </div>
        <strong></strong>
      </footer>
-->
     <?php include("side-bar.php");  ?> 
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

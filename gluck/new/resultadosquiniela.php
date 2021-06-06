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
    <link rel="stylesheet" href="bootstrap4/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap4/css/bootstrap.css">
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
          <h1>QUINIELA SEMANAL NOMBRE QUINIELA</h1>
          <ol class="breadcrumb">
            <li><a href="#">Coins</a></li>
            <li class="active">Balance</li>
            <li>Recargar</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
        	 <div class="modal fade" id="registroquiniela" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="top: 0%;">
              <div class="modal-xl modal-dialog" role="document">
                     <div class="modal-content fondonegro" style="height: 100%; padding-bottom: 20%; padding-top:20%;"> 
                      <div class="modal-header sinbordes">

                             <button type="button" class="close amarillo" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" class="amarillo">&times;</span>
                             </button>

                             <h4 class="modal-title centrado amarillo" id="exampleModalLabel"><b>¡Los resultados de tu Quiniela han sido registrados!</b></h2> 

                         </div>
                         <div class="row">
                         <div class="modal-body">
                          <div class="col-lg-12 col-xs-12 blanco">
                             <h2 class="centrado blanco">¡GET GLUCK!</h2>
                             <a href="misquinielas.php" class="nav-link buscadores">
                             <button type="submit" name="submit" class="registro btn botonregistro" id="submit">REGRESAR A MIS QUINIELAS</button>
                           </a>
                         </div>
                         </div>
                     </div>
                 </div>
              </div>
            </div>
          <!-- Small boxes (Stat box) -->
          <div class="row">


            <div class="col-lg-10 col-xs-12 col-md-offset-1" style="background-color: #FDE206; border-radius: 20px;">
                
              <!-- small box -->
              <div class="small-box" style="background-color: #FDE206; padding-left: 2%; border-radius: 20px;">
                <div class="row">
                 
                <div class="col-md-5 col-xs-5 negro centrado" style="float: left; margin-top: 1%">
                <h4><b>USUARIO</b></h4>
                  </div>

              <div class="col-md-3 col-xs-3 negro centrado bordeformulario" style="float: left; margin-left: 6%;">
                <h4 style="margin-top: 7%;"><b> PUNTUACIÓN </b></h4>
              </div>
              <div class="col-md-3 col-xs-3 negro centrado bordeformulario" style="float: left;">
                <h4 style="margin-top: 7%"><b> GOLES ACERTADOS </b></h4>
              </div>
              </div>
               </div>
            </div>
          </div>

          <div class="row" style="margin-top: 1%;">


            <div class="col-lg-10 col-xs-12 col-md-offset-1" style="background-color: #E9E8E7; border-radius: 60px;">
                
              <!-- small box -->
              <div class="small-box" style="background-color: #E9E8E7; padding-left: 2%; border-radius: 60px; margin-bottom: 0px;">
                <div class="row">
                 <div class="col-md-1 col-xs-1 blanco" style="float: left;">
                 <h4 class="centrado negro" style="position: absolute; margin-top: 25%; font-size: 25px;"><b>45.</b></h4>
                </div>
                 <div class="col-md-2 col-xs-2 blanco formulario" style="float: left; margin-left: 6%; margin-top: 5px; margin-bottom: 5px;">
                 <img src="images/clients/602c19be192bb.jpeg" class="img-circle centrado" width="40%" style="float: left; min-width: 60px;">
               </div>
                <div class="col-md-2 col-xs-2 negro" style="float: left;">
                <a href="resultadosusuario.php"><h4 style="margin-top: 15%;">Usuario</h4></a>
              </div>

              <div class="col-md-3 col-xs-3 negro centrado bordeformulario" style="float: left;">
                <h4 style="margin-top: 10%">10 PTS</h4>
              </div>
              <div class="col-md-3 col-xs-3 negro centrado bordeformulario" style="float: left;">
                <h4 style="margin-top: 10%">13 GOLES</h4>
              </div>
              </div>
               </div>
            </div>
          </div>
          <div class="row" style="margin-top: 1%;">


            <div class="col-lg-10 col-xs-12 col-md-offset-1" style="background-color: #E9E8E7; border-radius: 60px;">
                
              <!-- small box -->
              <div class="small-box" style="background-color: #E9E8E7; padding-left: 2%; border-radius: 60px; margin-bottom: 0px;">
                <div class="row">
                 <div class="col-md-1 col-xs-1 blanco" style="float: left;">
                 <h4 class="centrado negro" style="position: absolute; margin-top: 25%; font-size: 25px;"><b>45.</b></h4>
                </div>
                 <div class="col-md-2 col-xs-2 blanco formulario" style="float: left; margin-left: 6%; margin-top: 5px; margin-bottom: 5px;">
                 <img src="images/clients/602c19be192bb.jpeg" class="img-circle centrado" width="40%" style="float: left; min-width: 60px;">
               </div>
                <div class="col-md-2 col-xs-2 negro" style="float: left;">
                <h4 style="margin-top: 15%;">Usuario</h4>
              </div>

              <div class="col-md-3 col-xs-3 negro centrado bordeformulario" style="float: left;">
                <h4 style="margin-top: 10%">10 PTS</h4>
              </div>
              <div class="col-md-3 col-xs-3 negro centrado bordeformulario" style="float: left;">
                <h4 style="margin-top: 10%">13 GOLES</h4>
              </div>
              </div>
               </div>
            </div>
          </div>
          <div class="row" style="margin-top: 1%;">


            <div class="col-lg-10 col-xs-12 col-md-offset-1" style="background-color: #E9E8E7; border-radius: 60px;">
                
              <!-- small box -->
              <div class="small-box" style="background-color: #E9E8E7; padding-left: 2%; border-radius: 60px; margin-bottom: 0px;">
                <div class="row">
                 <div class="col-md-1 col-xs-1 blanco" style="float: left;">
                 <h4 class="centrado negro" style="position: absolute; margin-top: 25%; font-size: 25px;"><b>45.</b></h4>
                </div>
                 <div class="col-md-2 col-xs-2 blanco formulario" style="float: left; margin-left: 6%; margin-top: 5px; margin-bottom: 5px;">
                 <img src="images/clients/602c19be192bb.jpeg" class="img-circle centrado" width="40%" style="float: left; min-width: 60px;">
               </div>
                <div class="col-md-2 col-xs-2 negro" style="float: left;">
                <h4 style="margin-top: 15%;">Usuario</h4>
              </div>

              <div class="col-md-3 col-xs-3 negro centrado bordeformulario" style="float: left;">
                <h4 style="margin-top: 10%">10 PTS</h4>
              </div>
              <div class="col-md-3 col-xs-3 negro centrado bordeformulario" style="float: left;">
                <h4 style="margin-top: 10%">13 GOLES</h4>
              </div>
              </div>
               </div>
            </div>
          </div>

              
            
                
          </div>




        
           </div>
            </div><!-- ./col -->
          
           

        </div>


            

          </div><!-- /.row -->
          <!-- Main row -->
          


     
    </div><!-- ./wrapper -->

    <!-- jQuery 3.6 -->
    <script src="plugins/jQuery/jquery-3.6.0.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>

    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
     <!--  booststap4 -->
    <script src="bootstrap4/js/bootstrap.min.js"></script>
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
    <script type="text/javascript" src="css/animations.js"></script>
       <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="js/mfn.menu.js"></script>
    <script type="text/javascript" src="js/jquery.plugins.js"></script>
    <script type="text/javascript" src="js/jquery.jplayer.min.js"></script>
    <script type="text/javascript" src="js/animations/animations.js"></script>
    <script type="text/javascript" src="js/email.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>


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

<?php
@session_start();
require('Connections/Connections.php');
//require('include/security.php');
require('include/functions.php');
require('include/redirect.php');



if(isset($_REQUEST['submit']) )
{ 

$subject=$_REQUEST['subject'];   
$message=$_REQUEST['message'];

$query = mysqli_query($connect,"INSERT INTO q_template (subjet, message) VALUES ('".addslashes($subject)."','".addslashes($message)."')");
$row_id=mysqli_insert_id($connect);

//Get uploaded file data using $_FILES array 
$tmp_name    = $_FILES['my_file']['tmp_name']; // get the temporary file name of the file on the server 
$name        = $_FILES['my_file']['name'];  // get the name of the file 
$size        = $_FILES['my_file']['size'];  // get size of the file for size validation 
$type        = $_FILES['my_file']['type'];  // get type of the file 
$error       = $_FILES['my_file']['error']; // get the error (if any) 
  
$fk_sport = $_REQUEST['sport'];
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
    <title>Admin | Notificaciones</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="plugins/fullcalendar/fullcalendar.print.css" media="print">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

     <link rel="stylesheet" href="Css/style.css">

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
      <!-- Left side column. contains the logo and sidebar -->
      <?php include("panel-usuario.php");?>


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Notificaciones
            <small>Via Email</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Email</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">

            <div class="col-md-12">
              <div class="box box-primary">
                <?php if($result>0){ echo '<div class="callout callout-success">
                        <h4>Envio Exitoso!</h4>
                        <p>Su proceso fue realizado exitosamente.</p>
                      </div>';
                      header( "refresh:3;url=q_compose.php" );
        } ?>
                  <form enctype="multipart/form-data" method="POST" > 

                          <div class="box-header with-border">
                            <h3 class="box-title">Redactar Nuevo Mensaje</h3>
                          </div><!-- /.box-header -->
                          <div class="box-body">
                            <div class="form-group">
                               <div class="form-group">
                                <label>Seleccione Grupo a Enviar</label>
                                <div class="form-group">
                                <select  class="form-control select2" multiple="multiple" required="required" name="sport[]" style="width: 100%;">
                                  <?=sport(0, $connect);?>
                                </select>
                              </div>
                              </div>

                            </div> 
                            <div class="form-group">
                              <input class="form-control" placeholder="Subject:" name="subject">
                            </div>
                            <div class="form-group">
                              <textarea id="compose-textarea" class="form-control" style="height: 300px" name="message">

                              </textarea>
                            </div>
                            <!--div class="form-group">
                              <div class="btn btn-default btn-file">
                                <i class="fa fa-paperclip"></i> Attachment
                                <input type="file" name="my_file">
                              </div>
                              <p class="help-block">Max. 5MB</p>
                            </div-->
                          </div><!-- /.box-body -->
                          <div class="box-footer">
                            <div class="pull-right">
                              <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Enviar</button>
                            </div>
                            <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Limpiar</button>
                          </div><!-- /.box-footer -->
                    </form>

              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
        </div>
      </footer>


      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
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
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Page Script -->
    <script>
      $(function () {
        //Add text editor
        $("#compose-textarea").wysihtml5();
      });
    </script>
  </body>
</html>

<?php
require('Connections/Connections.php');
//require('include/security.php');
require('include/functions.php');

function encryptIt( $q ) {
    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
    return( $qEncoded );
}

  function decryptIt( $q ) {
    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
    return( $qDecoded );
     }

 if(($_SESSION['user']['rowid']!= $_REQUEST['rowid']) and $_SESSION['user']['type']==1) {
  header("location: index.php");
 }

$result = "";
$currentDirectory = getcwd();
$uploadDirectory = "/images/clients/";

 
if(isset($_REQUEST['rowid']) and isset($_REQUEST['param'])){
 $rowid = $_REQUEST['rowid'];
 if($rowid>0){
    if($query = mysqli_query($connect,"SELECT * FROM q_user WHERE rowid = '".$rowid."'")){
      $array=mysqli_fetch_array($query);
      if(isset($_REQUEST["submit"])){
        $username     = $_REQUEST['username'];
        $name     = $_REQUEST['name'];
        $lastname     = $_REQUEST['lastname'];
        $email    = $_REQUEST['email'];
        $password = encryptIt ($_REQUEST['password']);
        $phone    = $_REQUEST['phone'];
        $address  = $_REQUEST['address'];
        $fk_sport = $_REQUEST['sport'];
        $state  = $_REQUEST['state'];
        $city  = $_REQUEST['city'];
        $code  = $_REQUEST['code'];

        mysqli_query($connect,"DELETE FROM q_user_team WHERE fk_q_user = ".$rowid);
        $count = count( $fk_sport );$fkSport='';
        for ($i=0;$i<count($fk_sport);$i++)    
        {     
           $fkSport.= $fk_sport[$i].',';    
           mysqli_query($connect,"INSERT INTO q_user_team (fk_q_user, fk_q_team) VALUES ('".$rowid."', '".$fk_sport[$i]."') ");

        } 
        $fkSport=substr($fkSport,0, -1);
        $status   = $_REQUEST['status'];
        $sql = "";
        if($password!=''){ $sql=" , password = '".$password."' ";}

        if($query = mysqli_query($connect,"UPDATE q_user SET username = '".$username."', name = '".$name."', lastname = '".$lastname."', email = '".$email."', phone = '".$phone."', address = '".$address."', state = '".$state."', city = '".$city."', code = '".$code."', fk_sport = '".$fkSport."', status = '".$status."' ".$sql." WHERE rowid = '".$rowid."'")){
          $errors = []; // Store errors here

          $fileExtensionsAllowed = ['jpeg','jpg','png']; // These will be the only file extensions allowed 
          $RandomAccountNumber = uniqid();

          $fileName = $_FILES['logo']['name'];
          $fileSize = $_FILES['logo']['size'];
          $fileTmpName  = $_FILES['logo']['tmp_name'];
          $fileType = $_FILES['logo']['type'];
          $fileExtension = @strtolower(end(explode('.',$fileName)));

          $uploadPath = $currentDirectory . $uploadDirectory . basename($RandomAccountNumber.'.'.$fileExtension);

          if (! in_array($fileExtension,$fileExtensionsAllowed)) {
            $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
          }

          if ($fileSize > 400000000) {
            $errors[] = "File exceeds maximum size (4MB)";
          }

          if (empty($errors)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

            if ($didUpload) {
               $errors[] = "The file " . basename($fileName) . " has been uploaded";
               mysqli_query($connect,"UPDATE q_user SET img = '".$RandomAccountNumber.'.'.$fileExtension."' WHERE rowid = '".$rowid."'");
            } else {
              $errors[] = "An error occurred. Please contact the administrator.";
            }
          } else {
            foreach ($errors as $error) {
               $errors[] = "These are the errors" . "\n";
            }
          }
          $result = '<div class="callout callout-success">
                        <h4>Actualizaci&oacute;n Exitosa!</h4>
                        <p>Su proceso fue realizado exitosamente.</p>
                      </div>';
                      header( "refresh:3;url=q_user_list.php" );
        }else{
          $result = '<div class="callout callout-danger">
                        <h4>Fallo al Actualizar!</h4>
                        <p>Ocurrio un error al actualizar la informaci&oacute;n, por favor intente nuevamente.</p>
                      </div>';
        }
      }
    }else{
      echo "Failure" . mysql_error();
      die();
    }
  }else{
    if($query = mysqli_query($connect,"SELECT * FROM q_user WHERE rowid = '".$rowid."'")){
      $array=mysqli_fetch_array($query);
      if(isset($_REQUEST["submit"])){
        $username     = $_REQUEST['username'];
        $name     = $_REQUEST['name'];
        $lastname     = $_REQUEST['lastname'];
        $email    = $_REQUEST['email'];
        $password = encryptIt ($_REQUEST['password']);
        $phone    = $_REQUEST['phone'];
        $address  = $_REQUEST['address'];
        $state  = $_REQUEST['state'];
        $city  = $_REQUEST['city'];
        $code  = $_REQUEST['code'];
        $fk_sport = $_REQUEST['sport'];
        $count = count( $fk_sport );$fkSport='';
        for ($i=0;$i<count($fk_sport);$i++)    
        {     
           $fkSport.= $fk_sport[$i].',';    
        } 
        $fkSport=substr($fkSport,0, -1);
        $status   = $_REQUEST['status'];
        $sql = "";
        if($query = mysqli_query($connect,"INSERT INTO q_user (username, name, lastname, email, phone, address,state,city,code, fk_sport, status, password) VALUES ( '".$usernamename."','".$name."','".$lastname."', '".$email."', '".$phone."', '".$address."','".$state."','".$city."','".$code."', '".$fkSport."', '".$status."' , '".$password."')")){
          $errors = []; // Store errors here
          $rowid=mysqli_insert_id($connect);
          for ($i=0;$i<count($fk_sport);$i++)    
          {     
              mysqli_query($connect,"INSERT INTO q_user_team (fk_q_user, fk_q_team) VALUES ('".$rowid."', '".$fk_sport[$i]."') ");
   
          } 

          $fileExtensionsAllowed = ['jpeg','jpg','png']; // These will be the only file extensions allowed 
          $RandomAccountNumber = uniqid();

          $fileName = $_FILES['logo']['name'];
          $fileSize = $_FILES['logo']['size'];
          $fileTmpName  = $_FILES['logo']['tmp_name'];
          $fileType = $_FILES['logo']['type'];
          $fileExtension = @strtolower(end(explode('.',$fileName)));

          $uploadPath = $currentDirectory . $uploadDirectory . basename($RandomAccountNumber.'.'.$fileExtension);

          if (! in_array($fileExtension,$fileExtensionsAllowed)) {
            $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
          }

          if ($fileSize > 4000000) {
            $errors[] = "File exceeds maximum size (4MB)";
          }

          if (empty($errors)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

            if ($didUpload) {
               $errors[] = "The file " . basename($fileName) . " has been uploaded";
               mysqli_query($connect,"UPDATE q_user SET img = '".$RandomAccountNumber.'.'.$fileExtension."' WHERE rowid = '".$rowid."'");
            } else {
              $errors[] = "An error occurred. Please contact the administrator.";
            }
          } else {
            foreach ($errors as $error) {
               $errors[] = "These are the errors" . "\n";
            }
          }



          $result = '<div class="callout callout-success">
                        <h4>Actualizaci&oacute;n Exitosa!</h4>
                        <p>Su proceso fue realizado exitosamente.</p>
                      </div>';
                      header( "refresh:3;url=q_user_list.php" );
        }else{
          $result = '<div class="callout callout-danger">
                        <h4>Fallo al Actualizar!</h4>
                        <p>Ocurrio un error al actualizar la informaci&oacute;n, por favor intente nuevamente.</p>
                      </div>';
        }
      }
    }
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | Mantenimiento de Clientes</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
    <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="Css/style.css">

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
      <!-- Left side column. contains the logo and sidebar -->
      <?php include("panel-usuario.php");?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Mantenimiento de Clientes
            <small>Vista</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Mantenimiento de Clientes</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <?=$result;?>
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="registrobackground box">
                <div class="box-header">
                  <h3 class="blanco">Editar</h3>
                 <h4 class="blanco">Información Personal</h4>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1" class="blanco">Usuario</label>
                      <input type="text" class="form-control registro1 registroinput" placeholder="Nombre" name="username" required="required" value="<?=$array['username'];?>">
                    </div>
                    <div class="form-group">

                      <label for="exampleInputEmail1"  class="blanco">Nombre</label>
                      <input type="text" class="form-control registro1 registroinput" placeholder="Nombre" name="name" required="required" value="<?=$array['name'];?>">
                    </div>

                     <div class="form-group">
                      <label for="exampleInputLastName"  class="blanco">Apellido</label>
                      <input type="text" class="form-control registro1 registroinput"   placeholder="Apellido" name="lastname" required="required" value="<?=$array['lastname'];?>">
                      </div>

                      <div class="form-group">
                      <label for="exampleInputEmail1"  class="blanco">Email</label>
                      <input type="email" name="email" <?=$readonly;?> class="form-control registro1 registroinput" id="exampleInputEmail1" required="required" placeholder="Email" value="<?=$array['email'];?>">
                    </div>
                
                    <div class="form-group">
                      <label for="exampleInputPassword1"  class="blanco">Password</label>
                      <input type="password" class="form-control registro1 registroinput" id="exampleInputPassword1" name="password" required="required" value="<?php 
                      if(empty($array['password'])){
                        echo "password";
                      }else{
                        echo decryptIt($array['password']);
                      } ?>">
                    </div>

                    <div class="form-group">
                      <label  class="blanco">Tel&eacute;fono:</label>
                        <input type="text" class="form-control registro1 registroinput" required="required" data-inputmask='"mask": "(999) 999-9999"' data-mask name="phone" value="<?=$array['phone'];?>">
                    </div>
                    <div class="form-group">
                        <label  class="blanco">Direcci&oacute;n</label>
                      
                      <div class="pad"  style="padding: 0px !important;">
                          <textarea class="form-control registroinput" name="address" required="required" placeholder="Direcci&oacute;n"
                              style="width: 40%; height: 50px; padding: 10px !important;"><?= $array['address']; ?></textarea>
                      </div>
                    </div>

                    <div class="form-group">
                      <label  class="blanco">Estado:</label>
                      <div class="pad"  style="padding: 0px !important;">
                        <input type="text" class="form-control registro1 registroinput" required="required" name="state" style="width: 40% !important; height: 50px; padding: 10px !important;" value="<?=$array['state'];?>">
                      </div>
                     
                    </div>

                    <div class="form-group">
                      <label  class="blanco">Ciudad:</label>
                      <div class="pad"  style="padding: 0px !important;">
                        <input type="text" class="form-control registro1 registroinput" required="required" name="city" style="width: 40% !important; height: 50px; padding: 10px !important;" value="<?=$array['city'];?>">
                      </div>
                    </div>

                    <div class="form-group">  
                      <label  class="blanco">Código Postal:</label>
                        <input type="text" class="form-control registro1 registroinput" required="required" name="code" value="<?=$array['code'];?>" style="width: 40% !important; height: 50px; padding: 10px !important;">
                    </div>                   

                     <div class="form-group">
                      <label  class="blanco">Deporte Favorito</label>
                      <?php $disabled='  '; if($_SESSION['user']['type']==1) { 
                          $disabled=' disabled="disabled" '; 
                       } ?>
                      <select <?=$disabled;?> class="form-control select2 registro1 registroinput" multiple="multiple" required="required" name="sport[]" style="width: 40% !important; height: 55px; padding: 10px !important;">
                        <?=sport($array['fk_sport'], $connect);?>
                      </select>
                    </div>

                    <div class="form-group">
                      <h3 class="blanco">Tu Foto</h3>
                      <label for="exampleInputFile"></label>
                      <div class="box-footer botonregistro float-right" style="border-top: 0px solid #f4f4f4; background-color: transparent;">

                      <input type="file" id="exampleInputFile" name="logo" class="botonregistro" style="border-top: 0px solid #f4f4f4;">
                      </div>
                      <p class="help-block">
                        <?php $images=($array['img']!='')?$array['img']:'logo.png';?>
                        <img width="250px" src="images/clients/<?=$images;?>"  alt="User Image">
                      </p>
                    </div>
                  <!--
                    <div class="form-group">
                      <label for="exampleInputEmail1">Ultimo Acceso</label>
                      <input type="text" class="form-control" value="<?=date('d-m-Y',strtotime($array['date_Access']));?>" readonly="readonly" >
                    </div>
                  -->
                    <!--
                    <div class="form-group">
                      <label for="exampleInputEmail1">Fecha Registro</label>
                      <input type="text" class="form-control" value="<?=date('d-m-Y',strtotime($array['date_Create']));?>" readonly="readonly">
                    </div>
                  -->
                    <?php if($_SESSION['user']['type']==0) { ?>
                      <div class="form-group">
                        <label>Estatus</label>
                        <select class="form-control select2" style="width: 100%;" name="status">
                          <option value="1" <?php if($array['status']==1){?>selected="selected"<?php }?>>Activo</option>
                          <option value="0" <?php if($array['status']==0){?>selected="selected"<?php }?>>Inactivo</option>
                        </select>
                      </div>
                    <?php } ?>
                     <div class="box-footer" style="background-color: #333232; border: 0px;">
                    <button type="submit" name="submit" class="btn btn-primary">Enviar</button>
                    <input type="hidden" name="rowid" value="<?=$array['rowid'];?>">
                    <input type="hidden" name="param" value="<?=$array['param'];?>">
                  </div>
                </form>
                  </div><!-- /.box-body -->

                 
              </div><!-- /.box -->

             
            </div><!--/.col (left) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <script src="plugins/input-mask/jquery.inputmask.js"></script>
    <script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>

    <script>
      $(function () {

        $("[data-mask]").inputmask();
      });
    </script>

  </body>
</html>

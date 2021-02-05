<?php

require('Connections/Connections.php');

//require('include/security.php');

require('include/functions.php');

@session_start();



 if( $_SESSION['user']['type']==1 ) {

  header("location: index.php");

 }

$result = "";

$box = array("box box-danger", "box box-primary", "box box-success", "box box-info");



 

if(isset($_REQUEST['rowid']) and isset($_REQUEST['param'])){

 $rowid = $_REQUEST['rowid'];

 if($rowid>0){

    if($query = mysqli_query($connect,"SELECT * FROM q_pools WHERE rowid = '".$rowid."'")){

      $array=mysqli_fetch_array($query);

      $fk_sport_pools=$array['fk_sport'];



      $query_details = mysqli_query($connect,"SELECT * FROM q_pools_details WHERE fk_pools = '".$rowid."'");

      

      if(isset($_REQUEST["submit"])){

        $fk_sport     = $_REQUEST['fk_sport'];

        $color    = $_REQUEST['color'];

        $quantity = $_REQUEST['quantity'];

        $penalty = $_REQUEST['penalty'];

        $status   = $_REQUEST['status'];

        $name     = $_REQUEST['name']; 

        $puntaje_empate= $_REQUEST['puntaje_empate'];

        $puntaje_ganar= $_REQUEST['puntaje_ganar'];

        $puntaje_perder= $_REQUEST['puntaje_perder'];

        $puntaje_resultado= $_REQUEST['puntaje_resultado'];

        $label ='';   

         $quantity.'$quantity';

        if($query_i = mysqli_query($connect,"UPDATE q_pools SET name = '".$name."', fk_sport = '".$fk_sport."', color = '".$color."' , status = '".$status."', quantity = '".$quantity."', penalty = '".$penalty."', puntaje_empate = '".$puntaje_empate."', puntaje_ganar = '".$puntaje_ganar."', puntaje_perder = '".$puntaje_perder."', puntaje_resultado = '".$puntaje_resultado."' WHERE rowid = '".$rowid."'")){



          mysqli_query($connect,"UPDATE q_pools_details SET penalty = '".$penalty."', label='". $label."', puntaje_empate = '".$puntaje_empate."' WHERE fk_pools = '".$rowid."'");



          for ($i=1; $i <= $quantity; $i++) { 

              $label = $_REQUEST['label'.$i]; 

              $updateLabelQuery="UPDATE q_pools_details SET label='". $label."' WHERE fk_pools = '".$rowid."' AND fk_team_1 = '".$_REQUEST['fk_team_1_'.$i]."' AND fk_team_2 = '".$_REQUEST['fk_team_2_'.$i]."' AND date_Sport = '".$_REQUEST['date_Sport_'.$i]."' AND hour = '".date('h:i:s',strtotime($_REQUEST['hour_'.$i]))."'";

              

              mysqli_query($connect,$updateLabelQuery);



      	        $queryCount = mysqli_query($connect,"SELECT * FROM q_result_pools WHERE fk_q_pools = '".$rowid."' AND fk_team_1 = '".$_REQUEST['fk_team_1_'.$i]."' AND fk_team_2 = '".$_REQUEST['fk_team_2_'.$i]."' AND date_Sport = '".$_REQUEST['date_Sport_'.$i]."' AND hour = '".date('h:i:s',strtotime($_REQUEST['hour_'.$i]))."'");





                $arrayCount=mysqli_fetch_array($queryCount);

      	        $rowcount=mysqli_num_rows($queryCount);

      	        $sql= "";

               if($rowcount==0){

                  $sql.= " , fk_team_1 = '".$_REQUEST['fk_team_1_'.$i]."' , ";

                  $sql.= "fk_team_2 = '".$_REQUEST['fk_team_2_'.$i]."' , ";

                  $sql.= "date_Sport = '".$_REQUEST['date_Sport_'.$i]."' , ";

                  $sql.= "hour = '".$_REQUEST['hour_'.$i]."'";

               }



               mysqli_query($connect,"UPDATE q_pools_details SET  

                 status = '".$_REQUEST['status_sport_'.$i]."' , 

                 result = '".$_REQUEST['result_'.$i]."' , 

                 result_team_1 = '".$_REQUEST['result_team_1_'.$i]."' , 

                 result_team_2 = '".$_REQUEST['result_team_2_'.$i]."' 

                 ".$sql."

                 WHERE fk_pools = '".$rowid."' AND number_pools = ".$i);                                      

//E Empate

//T 

//F Finalizado

            if($_REQUEST['result_'.$i]=='E' OR $_REQUEST['result_'.$i]=='T' OR $_REQUEST['result_'.$i]=='F'){



            	$sql = mysqli_query($connect," SELECT * FROM q_result_pools WHERE fk_q_pools = '".$rowid."' AND fk_team_1 = '".$_REQUEST['fk_team_1_'.$i]."' AND fk_team_2 = '".$_REQUEST['fk_team_2_'.$i]."'");

              $K=0;

            	while ($array=mysqli_fetch_array($sql)) {



                if ($array['team__result_1']==$_REQUEST['result_team_1_'.$i] AND $array['team__result_2']==$_REQUEST['result_team_2_'.$i] AND $array['result_admin']==$_REQUEST['result_'.$i]) {

                  $K=$K+1;

                }else{

                  $K=0;

                }

            	}



              	$query_i = mysqli_query($connect,"UPDATE  q_result_pools SET team__result_1_admin = '".$_REQUEST['result_team_1_'.$i]."', team__result_2_admin = '".$_REQUEST['result_team_2_'.$i]."', result_admin = '".$_REQUEST['result_'.$i]."', hits = '".$K."', close = '".$status."'  WHERE fk_q_pools = '".$rowid."' AND fk_team_1 = '".$_REQUEST['fk_team_1_'.$i]."' AND fk_team_2 = '".$_REQUEST['fk_team_2_'.$i]."'");

              $query_i = mysqli_query($connect,"UPDATE  q_user SET ranking = ranking + ".$K." WHERE rowid = '".$arrayCount['fk_q_user']."'");





            }

           

          }



          $user = @$_REQUEST['user'];

          if (isset($user)) {

                  mysqli_query($connect,"DELETE FROM q_user_pools WHERE fk_q_pools = ".$rowid);

              foreach($user as $operacion){

                  $var=explode('-', $operacion);

                  mysqli_query($connect,"INSERT INTO q_user_pools (fk_q_user, fk_q_pools) VALUES ('".$var[0]."','".$var[1]."') ");

              }

          }



          $result = '<div class="callout callout-success">

                        <h4>Actualizaci&oacute;n Exitosa!</h4>

                        <p>Su proceso fue realizado exitosamente.</p>

                      </div>';

                      header( trim("refresh:1;url=q_pools.php?rowid=".$rowid."&param=".$_REQUEST['param']));

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

    if($query = mysqli_query($connect,"SELECT * FROM q_pools WHERE rowid = '".$rowid."'")){

      $array=mysqli_fetch_array($query);

      if(isset($_REQUEST["submit"])){

        $fk_sport     = $_REQUEST['fk_sport'];

        $color  = $_REQUEST['color'];

        $quantity = $_REQUEST['quantity'];

        $status   = $_REQUEST['status'];

        $name   = $_REQUEST['name'];

        $penalty = $_REQUEST['penalty'];

        $puntaje_empate= $_REQUEST['puntaje_empate'];

        $puntaje_ganar= $_REQUEST['puntaje_ganar'];

        $puntaje_perder= $_REQUEST['puntaje_perder'];

        $puntaje_resultado= $_REQUEST['puntaje_resultado'];

        $label = $_REQUEST['label'];

        

        if($query_i = mysqli_query($connect,"INSERT INTO q_pools (name,fk_sport, quantity, color, status,penalty, puntaje_empate, puntaje_ganar, puntaje_perder, puntaje_resultado) VALUES ( '".$name."', '".$fk_sport."', '".$quantity."', '".$color."' , '".$status."' , '".$penalty."', '".$puntaje_empate."', '".$puntaje_ganar."', '".$puntaje_perder."', '".$puntaje_resultado."')")){

          $rowid=mysqli_insert_id($connect);





          for ($i=1; $i <= $quantity; $i++) {

            $label = $_REQUEST['label'.$i]; 

             mysqli_query($connect,"INSERT INTO q_pools_details (fk_pools, status, result, number_pools, result_team_1, result_team_2,penalty, label) VALUES ( '".$rowid."', '1', 'C','".$i."', '0', '0','".$penalty."','".$label."')");

          }





          $result = '<div class="callout callout-success">

                        <h4>Actualizaci&oacute;n Exitosa!</h4>

                        <p>Su proceso fue realizado exitosamente.</p>

                      </div>';

                      header( trim("refresh:1;url=q_pools.php?rowid=".$rowid."&param=edit"));

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

    <title>Admin | Mantenimiento de Quinielas</title>
    <!-- Tell the browser to be responsive to screen width -->

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, pools-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.5 -->

    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

    <!-- Font Awesome -->

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- Ionicons -->

    <link rel="stylesheet" href="//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">

    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">

    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">

    <!-- iCheck for checkboxes and radio inputs -->

    <link rel="stylesheet" href="plugins/iCheck/all.css">

    <!-- Bootstrap Color Picker -->

    <link rel="stylesheet" href="plugins/colorpicker/bootstrap-colorpicker.min.css">

    <!-- Bootstrap time Picker -->

    <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">

    <!-- Select2 -->

    <link rel="stylesheet" href="plugins/select2/select2.min.css">

    <!-- Theme style -->

    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">

    <!-- AdminLTE Skins. Choose a skin from the css/skins

         folder instead of downloading all of them to reduce the load. -->

    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

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



      <?php include("panel-usuario.php");?>





      <!-- Content Wrapper. Contains page content -->

      <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Mantenimientos de Quiniela

            <small>Vista</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>

            <li class="active">Quinielas</li>

          </ol>

        </section>



        <!-- Main content -->

        <section class="content">

          <?=$result;?>

          <form role="form" method="post" name="quiniela">

            <section class="content">

              <div class="row">

                <div class="col-md-12">

                  <div class="nav-tabs-custom">

                    <ul class="nav nav-tabs">

                      <li class="active"><a href="#activity" data-toggle="tab">Configuraci&oacute;n</a></li>

                      <li><a href="#timeline" data-toggle="tab">Partidos (<?=($array['quantity']>0)?$array['quantity']:0;?>)</a></li>

                      <li><a href="#user" data-toggle="tab">Usuarios (<?=count_user(@$fk_sport_pools, $connect);?>)</a></li>

                      <li><a href="#puntaje" data-toggle="tab">Puntaje</a></li>

                    </ul>

                    <div class="tab-content">

                      <div class="active tab-pane" id="activity">

                        <div class="col-md-12">

                            <div class="box box-primary">

                                  <div class="box-header"> 

                                    <h3 class="box-title">Nombre Quinela</h3>

                                  </div>

                                   <input type="text" class="form-control" placeholder="Nombre" name="name" value="<?=$array['name'];?>">

                                  <h3 class="box-title">Seleccione Deporte</h3>

                                 <select class="form-control select2" name="fk_sport" id="fk_sport" style="width: 100%;">

                                     <option value="0">Seleccione</option>

                                     <?=sport($array['fk_sport'], $connect);?>

                                 </select>  

                              </div>

                        </div>    

                        <div class="row">

                          <div class="col-md-4">

                            <div class="box box-info">

                                <div class="box-header">

                                  <h3 class="box-title">Color</h3>

                                </div>

                                <div class="box-body">

                                  <div class="form-group">

                                    <div class="input-group my-colorpicker2">

                                      <input type="text" name="color" value="<?=$array['color'];?>" class="form-control">

                                      <div class="input-group-addon">

                                        <i></i>

                                      </div>

                                    </div><!-- /.input group -->

                                  </div><!-- /.form group -->

                                </div>

                              </div>

                            </div>

                            <div class="col-md-4">

                              <div class="box box-info">

                                  <div class="box-header">

                                    <h3 class="box-title">Cantidad de Partidos</h3>

                                  </div>

                                  <div class="box-body">

                                    <div class="form-group">

                                        <input type="number" name="quantity" min="1" value="<?=$array['quantity'];?>" class="form-control">

                                    </div>

                                  </div>

                                </div>

                              </div>



                              <div class="col-md-2">

                                <div class="box box-info">

                                  <div class="box-header">

                                    <h3 class="box-title">Estatus Quiniela</h3>

                                  </div>



                                  <div class="box-body">

                                    <div class="form-group">

                                        <div class="input-group">

                                        <select class="form-control select2" style="width: 100%;" name="status">

                                          <option value="1" <?php if($array['status']==1){?>selected="selected"<?php }?>>Activo</option>

                                          <option value="0" <?php if($array['status']==0){?>selected="selected"<?php }?>>Proceso</option>

                                          <option value="2" <?php if($array['status']==2){?>selected="selected"<?php }?>>Cerrado</option>

                                        </select>

                                       </div>

                                    </div>

                                  </div><!-- /.box-body -->

                                </div><!-- /.box -->

                              </div><!-- /.col (right) -->



                              <div class="col-md-2">

                                <div class="box box-info">

                                  <div class="box-header">

                                    <h3 class="box-title">Penalty</h3>

                                  </div>



                                  <div class="box-body">

                                    <div class="form-group">

                                        <div class="input-group">

                                        <select id="penaltySelect" class="form-control select2" style="width: 100%;" name="penalty" onchange="javascript:mostrarInput()">

                                          <option value="0" <?php if($array['penalty']==0){?>selected="selected"<?php }?>>No</option>

                                          <option value="1" <?php if($array['penalty']==1){?>selected="selected"<?php }?>>Si</option>

                                        </select>

                                       </div>

                                    </div>

                                  </div><!-- /.box-body -->

                                </div><!-- /.box -->

                              </div><!-- /.col (right) -->





                               <div class="col-xs-6">

                                  <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Registrar</button>

                                  <input type="hidden" name="rowid" value="<?=($array['rowid']!='')?$array['rowid']:0;?>">

                                  <input type="hidden" name="param" value="<?=$_REQUEST['param'];?>">

                              </div><!-- /.col -->

                              <div class="col-xs-6">

                                <button type="reset" class="btn btn-primary btn-block btn-flat">Limpiar</button>

                              </div><!-- /.col -->

                        </div>



                      </div><!-- /.tab-pane -->





                      <div class="tab-pane" id="timeline">



                          <?php

                           $i=1;

                          if(@mysqli_num_rows (@$query_details)){

                           while ($array_details=mysqli_fetch_array($query_details)) {

                          ?>



                          <div class="row">

                             <div class="col-md-12">

                             <input type="text" class="form-control" name="<?='label'.$i;?>" value="<?=$array_details['label'];?>">

                             </div>

                         </div>

                        <div class="<?php echo  array_random($box) ;?>">

                          <div class="row">

                              <div class="col-md-6">

                                  <div class="form-group">

                                    <div class="box-header">

                                       <h3 class="box-title">Equipo #1</h3>

                                    </div>

                                    <div class="box-body">

                                      <div class="col-md-8">

                                        <select class="form-control select2" name="fk_team_1_<?php echo $array_details['number_pools'];?>" id="teams1" style="width: 100%;">

                                          <option value="0">Seleccione</option>

                                          <?=team_pools($array['fk_sport'], $connect,1,$array_details['fk_team_1']);?>

                                        </select>

                                       </div>

                                      <div class="col-md-2"> 

                                        <input type="text" class="form-control" name="result_team_1_<?php echo $array_details['number_pools'];?>" value="<?=$array_details['result_team_1'];?>">

                                      </div>





                                      <div class="col-md-2 penalty_class">

                                        <input type="text" style="border-color: black;" id="result_team_1_penales_<?php echo $i;?>" class="form-control" name="result_team_1_penales_<?php echo $array_details['number_pools'];?>" value="" title='Penales'>

                                      </div>

                                      <script>

                                      function mostrarInput() {



                                          var e = document.getElementById("penaltySelect");

                                          var valorSelect = e.options[e.selectedIndex].value;



                                          console.log(valorSelect);



                                          var penaltyInputs = document.getElementsByClassName('penalty_class');



                                          for (var i = 0; i < penaltyInputs.length; i ++) {

                                              penaltyInputs[i].style.display = (valorSelect === "1") ? 'block' : 'none';

                                          }



                                        // elemento = document.getElementById("div_penalty");

                                        // // penalty = document.getElementById("penalty");

                                        //

                                        // if (valorSelect === 1) {

                                        //   elemento.style.display='block';

                                        // }

                                        // else {

                                        //   elemento.style.display='none';

                                        // }

                                      }

                                      </script>

                                    </div>

                                  </div>

                              </div><!-- /.col -->

                              <div class="col-md-6">

                                  <div class="form-group">

                                    <div class="box-header">

                                       <h3 class="box-title">Equipo #2</h3>

                                    </div>

                                    <div class="box-body">

                                      <div class="col-md-8"> 

                                        <select class="form-control select2" name="fk_team_2_<?php echo $array_details['number_pools'];?>" id="teams2" style="width: 100%;">

                                          <option value="0">Seleccione</option>

                                          <?=team_pools($array['fk_sport'], $connect,1,$array_details['fk_team_2']);?>

                                        </select>

                                        </div>

                                      <div class="col-md-2">

                                        <input type="text" class="form-control" name="result_team_2_<?php echo $array_details['number_pools'];?>" value="<?=$array_details['result_team_2'];?>">

                                      </div>

                                      <div class="col-md-2 penalty_class">

                                        <input type="text" style="border-color: black;" id="result_team_2_penales_<?php echo $array_details['number_pools'];?>" class="form-control" name="result_team_2_penales_<?php echo $array_details['number_pools'];?>" value="" title='Penales'>

                                      </div>



                                    </div>

                                  </div>

                              </div><!-- /.col -->

                          </div><!-- /.row -->



                          <div class="row">

                              <div class="col-md-3">

                                  <div class="form-group">

                                    <div class="box-header">

                                       <h3 class="box-title">Fecha</h3>

                                    </div>

                                    <div class="box-body">

                                      <div class="input-group">

                                        <div class="input-group-addon"> 

                                          <i class="fa fa-calendar"></i>

                                        </div>  

                                        <input type="text" class="form-control" name="date_Sport_<?php echo $array_details['number_pools'];?>" value="<?=$array_details['date_Sport'];?>" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask>

                                      </div>

                                    </div>

                                  </div>

                              </div><!-- /.col -->

                              <div class="col-md-3">

                                  <div class="form-group">

                                    <div class="box-header">

                                       <h3 class="box-title">Hora</h3>

                                    </div>

                                    <div class="box-body">

                                        <div class="bootstrap-timepicker">

                                          <div class="form-group">

                                            <div class="input-group">

                                              <input type="text" name="hour_<?php echo $array_details['number_pools'];?>" class="form-control timepicker" value="<?=$array_details['hour'];?>">

                                              <div class="input-group-addon">

                                                <i class="fa fa-clock-o"></i>

                                              </div>

                                            </div><!-- /.input group -->

                                          </div><!-- /.form group -->

                                        </div>

                                    </div>

                                  </div>

                              </div>

                              <div class="col-md-3">

                                  <div class="form-group">

                                    <div class="box-header">

                                       <h3 class="box-title">Estatus</h3>

                                    </div>

                                    <div class="box-body">

                                        <select class="form-control select2" name="status_sport_<?php echo $array_details['number_pools'];?>" style="width: 100%;">

                                          <option value="1" <?=($array_details['status']==1)?'selected="selected"':'';?>>Activo</option>

                                          <option value="0" <?=($array_details['status']==0)?'selected="selected"':'';?>>Inactivo</option>

                                        </select>

                                    </div>

                                  </div>

                              </div>

                              <div class="col-md-3">

                                  <div class="form-group">

                                    <div class="box-header">

                                       <h3 class="box-title">Resultado</h3>

                                    </div>

                                    <div class="box-body">

                                      <div class="form-group">  

                                            <div class="input-group">

                                            <select class="form-control select2" name="result_<?php echo $array_details['number_pools'];?>" style="width: 100%;">

                                              <option value="C" <?=($array_details['result']=="C")?'selected="selected"':'';?>>Sin Comenzar</option>

                                              <option value="F" <?=($array_details['result']=="F")?'selected="selected"':'';?>>Resultado Final</option>

                                              <option value="S" <?=($array_details['result']=="S")?'selected="selected"':'';?>>Suspendido</option>

                                            </select>

                                          </div>

                                        </div>

                                    </div>

                                  </div>

                              </div>

                          </div>

                         </div>

                         <?php

                         $i++;

                           }}

                          ?>

                          <div class="row">

                            <div class="col-xs-6">

                                    <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Registrar</button>

                                    <input type="hidden" name="rowid" value="<?=($array['rowid']!='')?$array['rowid']:0;?>">

                            </div>



                             <div class="col-xs-6">

                              <button type="reset" class="btn btn-primary btn-block btn-flat">Limpiar</button>

                            </div>



                          </div>



                      </div><!-- /.tab-pane -->

                       <div class="tab-pane" id="user">



                        <div class="box-header">

                          <h3 class="box-title">Seleccione Participantes de la Quiniela</h3>

                          <div class="box-tools">

                            

                          </div>

                        </div><!-- /.box-header -->





                <div class="box-body">
                          <div class="box-body table-responsive no-padding">

                            <table id="example1" class="table table-bordered table-striped">

                             <thead>

                              <tr>

                                <th>ID</th>

                                <th>Nombre</th>

                                <th>Email</th>

                                <th>Tel&eacute;fono</th>

                                <th>-</th>

                              </tr>

                            </thead>

                            <tbody>

                              <?php 

                              if($query = @mysqli_query($connect,"SELECT U.rowid, U.name, U.email, U.phone  FROM q_user U, q_user_team T WHERE U.status = 1 AND U.rowid=T.fk_q_user AND fk_q_team IN (".$fk_sport_pools." )  ORDER BY U.name DESC")){

                                $i=1;

                                while ($array_pools=mysqli_fetch_array($query)) {



                              ?>

                              <tr>

                                <td><?=$i;?></td>

                                <td><?=$array_pools['name'];?></td>

                                <td><?=$array_pools['email'];?></td>

                                <td><?=$array_pools['phone'];?></td>

                                <td>

                                   <label>

                                    <input type="checkbox" class="minimal-red"  name="user[]" value="<?=$array_pools['rowid'];?>-<?=$rowid;?>" <?=checked($array_pools['rowid'], $rowid, $connect);?>>

                                  </label>

                                </td>

                              </tr>

                             <?php $i++;}}else{echo 'No existen usuarios registrados.';} ?>

                              </tbody>

                              <tfoot>

                                <tr>

                                  <th>ID</th>

                                <th>Nombre</th>

                                <th>Email</th>

                                <th>Tel&eacute;fono</th>

                                <th>-</th>

                                </tr>

                              </tfoot>



                            </table>
                          </div>

                          </div>

                          <div class="row">

                            <div class="col-xs-6">

                                <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Registrar</button>

                                <input type="hidden" name="rowid" value="<?=($array['rowid']!='')?$array['rowid']:0;?>">

                            </div>

                             <div class="col-xs-6">

                                 <button type="reset" class="btn btn-primary btn-block btn-flat">Limpiar</button>

                            </div>

                          </div>

                      </div>



                      <div class="tab-pane" id="puntaje">



                        <div class="box-header">

                          <h3 class="box-title">Seleccione la puntuacion de la Quiniela</h3>

                          <div class="box-tools">

                            

                          </div>

                        </div><!-- /.box-header -->





                          <div class="box-body table-responsive no-padding">

                            <table class="table">

                             <thead>

                              <tr>

                                <th>Resultado</th>

                                <th>Ganador</th>

                                <th>Empate</th>

                                <th>Perdedor</th>

                              </tr>

                            </thead>

                            <tbody>

                              <tr>

                                <td><input type="text" class="form-control" name="puntaje_resultado" value="<?=$array['puntaje_resultado'];?>"></td>

                                <td><input type="text" class="form-control" name="puntaje_ganar" value="<?=$array['puntaje_ganar'];?>"></td>

                                <td><input type="text" class="form-control" name="puntaje_empate" value="<?=$array['puntaje_empate'];?>"></td>

                                <td><input type="text" class="form-control" name="puntaje_perder" value="<?=$array['puntaje_perder'];?>"></td>

                              </tr>

                             </tbody>

                              

                            </table>

                          </div>



                          <div class="row">

                            <div class="col-xs-6">

                                <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Registrar</button>

                                <input type="hidden" name="rowid" value="<?=($array['rowid']!='')?$array['rowid']:0;?>">

                            </div>

                             <div class="col-xs-6">

                                 <button type="reset" class="btn btn-primary btn-block btn-flat">Limpiar</button>

                            </div>

                          </div>

                      </div>

                    </div>

                  </div>

                </div>

              </div>

            </section>

          </form>

        </section><!-- /.content -->

      </div><!-- /.content-wrapper --

>

      <div class="control-sidebar-bg"></div>

    </div><!-- ./wrapper -->



    <!-- jQuery 2.1.4 -->

    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>

    <!-- Bootstrap 3.3.5 -->

    <script src="bootstrap/js/bootstrap.min.js"></script>

    <script src="plugins/datatables/jquery.dataTables.min.js"></script>

    <script src="plugins/select2/select2.full.min.js"></script>

    <!-- InputMask -->

    <script src="plugins/input-mask/jquery.inputmask.js"></script>

    <script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>

    <script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>

    <!-- date-range-picker -->

    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>

    <script src="plugins/daterangepicker/daterangepicker.js"></script>

    <!-- bootstrap color picker -->

    <script src="plugins/colorpicker/bootstrap-colorpicker.min.js"></script>

    <!-- bootstrap time picker -->

    <script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>

    <!-- SlimScroll 1.3.0 -->

    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>

    <!-- iCheck 1.0.1 -->

    <script src="plugins/iCheck/icheck.min.js"></script>

    <!-- FastClick -->

    <script src="plugins/fastclick/fastclick.min.js"></script>

    <!-- AdminLTE App -->

    <script src="dist/js/app.min.js"></script>

    <!-- AdminLTE for demo purposes -->

    <script src="dist/js/demo.js"></script>


    <!-- Page script -->
    <script>

      $(function () {

        //Initialize Select2 Elements

        $(".select2").select2();

        $( document ).ready(function() {

          $("#example1").DataTable({
              "lengthMenu": [ [100, 250, -1], [100, 250, "All"] ]
          });

        $('#example2').DataTable({

          "paging": true,

          "lengthChange": false,

          "searching": false,

          "ordering": true,

          "info": true,

          "autoWidth": true

        });




            $( "#fk_sport" ).change(function() {

              $.ajax({

                  url : 'external/actions.php',

                  data : { rowid : $( "#fk_sport" ).val() },

                  type : 'POST',

                  success : function(json) {

                    $('#teams1').html(json);

                    $('#teams2').html(json);

                  },

                  error : function(xhr, status) {

                      alert('Disculpe, existió un problema');

                  },

                  complete : function(xhr, status) {

                      console.log('Petición realizada');

                  }

              });

            });



            var penaltyInputs = document.getElementsByClassName('penalty_class');



            for (var i = 0; i < penaltyInputs.length; i ++) {

                penaltyInputs[i].style.display = 'none';

            }



        });



        //Datemask dd/mm/yyyy

        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});

        //Datemask2 mm/dd/yyyy

        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});

        //Money Euro

        $("[data-mask]").inputmask();



        //Date range picker

        $('#reservation').daterangepicker();

        //Date range picker with time picker

        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});

        //Date range as a button

        $('#daterange-btn').daterangepicker(

                {

                  ranges: {

                    'Today': [moment(), moment()],

                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],

                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],

                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],

                    'This Month': [moment().startOf('month'), moment().endOf('month')],

                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]

                  },

                  startDate: moment().subtract(29, 'days'),

                  endDate: moment()

                },

        function (start, end) {

          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

        }

        );



        //iCheck for checkbox and radio inputs

        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({

          checkboxClass: 'icheckbox_minimal-blue',

          radioClass: 'iradio_minimal-blue'

        });

        //Red color scheme for iCheck

        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({

          checkboxClass: 'icheckbox_minimal-red',

          radioClass: 'iradio_minimal-red'

        });

        //Flat red color scheme for iCheck

        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({

          checkboxClass: 'icheckbox_flat-green',

          radioClass: 'iradio_flat-green'

        });



        //Colorpicker

        $(".my-colorpicker1").colorpicker();

        //color picker with addon

        $(".my-colorpicker2").colorpicker();



        //Timepicker

        $(".timepicker").timepicker({

          showInputs: false

        });

      });

    </script>

  </body>

</html>


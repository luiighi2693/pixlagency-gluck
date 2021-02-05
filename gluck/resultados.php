<?php

@session_start();

require('Connections/Connections.php');

require('include/security.php');

require('include/functions.php');

require('include/redirect.php');



if(isset($_REQUEST['rowid']) and $_REQUEST['submit']!=''){

    $count = $_REQUEST['count'];

    $rowid = $_REQUEST['rowid'];

    for ($i=0;$i<($count);$i++){    

       if($_REQUEST['result_fk_team_1_'.$i]!='' and $_REQUEST['result_fk_team_2_'.$i]!=''){

            $queryCount = mysqli_query($connect,"SELECT * FROM q_result_pools WHERE fk_q_pools = '".$_REQUEST['rowid']."' AND fk_team_1 = '".$_REQUEST['fk_team_1_'.$i]."'  AND fk_team_2 = '".$_REQUEST['fk_team_2_'.$i]."' AND date_Sport = '".$_REQUEST['date_Sport'.$i]."' AND hour = '".$_REQUEST['hour'.$i]."'");

             $rowcount=mysqli_num_rows($queryCount);



           // if($rowcount==0) { 

                        mysqli_query($connect,"DELETE FROM q_result_pools WHERE fk_q_user = '".$_SESSION['user']['rowid']."' AND  fk_q_pools = '".$rowid."'  AND fk_team_1 = '".$_REQUEST['fk_team_1_'.$i]."'  AND fk_team_2 = '".$_REQUEST['fk_team_2_'.$i]."' AND date_Sport = '".$_REQUEST['date_Sport'.$i]."' AND hour = '".$_REQUEST['hour'.$i]."'");

            

                        mysqli_query($connect,"INSERT INTO q_result_pools (fk_q_user, fk_q_pools, fk_team_1, team__result_1, fk_team_2, team__result_2, status,date_Sport,hour) VALUES ('".$_SESSION['user']['rowid']."','".$rowid."','".$_REQUEST['fk_team_1_'.$i]."','".$_REQUEST['result_fk_team_1_'.$i]."', '".$_REQUEST['fk_team_2_'.$i]."', '".$_REQUEST['result_fk_team_2_'.$i]."', '".$_REQUEST['result_'.$i]."', '".$_REQUEST['date_Sport'.$i]."', '".$_REQUEST['hour'.$i]."') ");

           // }



       }

    } 

}



?>

<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Admin | Resultados</title>

    <!-- Tell the browser to be responsive to screen width -->

       

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.5 -->

    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">

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

    <style>

      .color-palette {

        height: 35px;

        line-height: 35px;

        text-align: center;

      }

      .color-palette-set {

        margin-bottom: 15px;

      }

      .color-palette span {

        display: none;

        font-size: 12px;

      }

      .color-palette:hover span {

        display: block;

      }

      .color-palette-box h4 {

        position: absolute;

        top: 100%;

        left: 25px;

        margin-top: -40px;

        color: rgba(255, 255, 255, 0.8);

        font-size: 12px;

        display: block;

        z-index: 7;

      }

    </style>

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

            Quinielas

            <small>Apuestas</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="quiniela.php">Quinielas</a></li>

            <li class="active">Resultados</li>

          </ol>

        </section>



        <!-- Main content -->

        <section class="content">





          <!-- START ACCORDION & CAROUSEL-->

          <h2 class="page-header">Listado de Juegos </h2>

          <div class="row">

            <div class="col-md-12">

              <div class="box box-solid">

                <form role="form" method="post">

                  <?php 

                        $and='';

                        $rowid=$_REQUEST['rowid'];

                      if ($_SESSION['user']['type']==1) {

                        $result='';

                        $query_POO = mysqli_query($connect,"SELECT p.rowid, p.name FROM q_user_pools u, q_pools p WHERE p.rowid=u.fk_q_pools AND u.fk_q_user = ".$_SESSION['user']['rowid']." AND p.rowid = ".$rowid." AND p.status = 1");

                         while ($array_POO=mysqli_fetch_array($query_POO)) {

                            $name= $array_POO['name'];

                            $result.= $array_POO['rowid'].',';

                         }

                        $result=substr($result, 0,-1);

                        $and=' AND p.rowid IN ( '.$result.' )';

                      }



						$query = mysqli_query($connect,"SELECT p.rowid,p.name,p.date_Create,p.fk_sport,p.color,p.quantity,d.fk_team_1, d.fk_team_2 , p.fk_sport,d.date_Sport,d.hour,d.status, (select img from q_team where d.fk_team_1 = rowid) as image1, (select img from q_team where d.fk_team_2 = rowid) as image2 FROM q_pools p, q_pools_details d  WHERE p.rowid=d.fk_pools AND p.status=1 ".$and."  ORDER BY p.date_Create DESC ");

						 $row=mysqli_num_rows($query);



                      if($query){

                        $i=1;$j=1;

                        while ($array_content=mysqli_fetch_array($query)) {

                    ?>

                      <div class="box-header with-border">

                        <h2 class="box-title"><?php echo ($i==1)?$name:'';?></h2>

                      </div><!-- /.box-header -->

                      <div class="box-body">

                        <div class="box-group" id="accordion">

      



                          <div class="col-md-12">

                            <div class="box box-solid">

                              <div class="box-header with-border">

                                <i class="fa fa-bullhorn"></i>

                               <h3 class="box-title" style="text-align: center;">Partido # <?php echo $i;?></h3>

                               <br>

                              <div class="col-md-5">

                                <div class="col-md-4">

                                    <?php $images=($array_content['image1']!='')?$array_content['image1']:'logo.png';?>

                                    <img width="30px" src="images/team/<?=$images;?>" class="img-circle" alt="User Image">

                                    <?=team_pools_result($array_content['fk_sport'], $connect,1,$array_content['fk_team_1']);?>

                                   <input type="hidden" class="form-control" name="fk_team_1_<?php echo $i;?>" value="<?php echo $array_content['fk_team_1'];?>">

                                </div>

                                <div class="col-md-2"> 

                                   <input type="text" onchange="changeLabel('resultType<?php echo $i;?>', 'fk_team_1_<?php echo $i;?>', 'fk_team_2_<?php echo $i;?>');" class="form-control" name="result_fk_team_1_<?php echo $i;?>" id="fk_team_1_<?php echo $i;?>" value="<?=team_pools_result_total($_SESSION['user']['rowid'], $connect, $array_content['rowid'], $array_content['fk_team_1'], 1, $array_content['date_Sport'], $array_content['hour']);?>">

                                 </div>

                              </div>

                              <div class="col-md-5">

                                <div class="col-md-4">

                                    <?php $images=($array_content['image2']!='')?$array_content['image2']:'logo.png';?>

                                    <img width="30px" src="images/team/<?=$images;?>" class="img-circle" alt="User Image">

                                  <?=team_pools_result($array_content['fk_sport'], $connect,1,$array_content['fk_team_2']);?>

                                   <input type="hidden" class="form-control" name="fk_team_2_<?php echo $i;?>" value="<?php echo $array_content['fk_team_2'];?>">

                                </div>

                                <div class="col-md-2">

                                   <input type="text" onchange="changeLabel('resultType<?php echo $i;?>', 'fk_team_1_<?php echo $i;?>', 'fk_team_2_<?php echo $i;?>');" class="form-control" name="result_fk_team_2_<?php echo $i;?>" id="fk_team_2_<?php echo $i;?>" value="<?=team_pools_result_total($_SESSION['user']['rowid'], $connect, $array_content['rowid'], $array_content['fk_team_2'], 2, $array_content['date_Sport'], $array_content['hour']);?>">

                                </div>

                              </div>

                              <div class="col-md-2">

                                  <?php
                                    $result1 = team_pools_result_total($_SESSION['user']['rowid'], $connect, $array_content['rowid'], $array_content['fk_team_1'], 1, $array_content['date_Sport'], $array_content['hour']);
                                    $result2 = team_pools_result_total($_SESSION['user']['rowid'], $connect, $array_content['rowid'], $array_content['fk_team_2'], 2, $array_content['date_Sport'], $array_content['hour']);
                                    $resultLabel = '';

                                    if ($result1 != '' && $result2 != '') {
                                        $resultLabel = $result1 == $result2 ? 'Empate' : 'Resultado';
                                    }
                                  ?>

                                  <span id="resultType<?php echo $i;?>"><?php echo $resultLabel;?></span>

<!--                                  <select class="form-control select2" name="result_--><?php //echo $i;?><!--" style="width: 100%;">-->
<!---->
<!--                                    <option value="E" --><?//=team_pools_result_total_select($_SESSION['user']['rowid'], $connect, $array_content['rowid'],  $array_content['fk_team_1'] , $array_content['fk_team_2'],'E');?><!-- > Empate </option>-->
<!---->
<!--                                    <option value="F" --><?//=team_pools_result_total_select($_SESSION['user']['rowid'], $connect, $array_content['rowid'],  $array_content['fk_team_1'] , $array_content['fk_team_2'],'F');?><!-- > Finalizado </option>-->
<!---->
<!--                                  </select>-->

                              </div>

                              </div><!-- /.box-header -->

                              <?='Fecha: '.date("d/m/Y",strtotime($array_content['date_Sport'])).' Hora: '.date('h:i A', strtotime($array_content['hour']));?> 

                              <input type="hidden" class="form-control" name="date_Sport<?php echo $i;?>" value="<?php echo $array_content['date_Sport'];?>">

                              <input type="hidden" class="form-control" name="hour<?php echo $i;?>" value="<?php echo $array_content['hour'];?>">

                            </div><!-- /.box -->

                          </div><!-- ./col -->

                        </div>



                      </div>

                      <?php 

                         $i++; }

                      }

                      ?>



                     <div class="box-footer">

                      <button type="submit" name="submit" value="Reportar" class="btn btn-primary">Reportar</button>

                      <input type="hidden" name="rowid" value="<?=$_REQUEST['rowid'];?>">

                      <input type="hidden" name="count" value="<?=$i;?>">

                      <input type="hidden" name="status" value="<?=$_REQUEST['status'];?>">

                    </div>

                    </form>

              </div><!-- /.box -->

            </div>

          </div><!-- /.row -->



        



        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->

                 <?php include("side-bar.php");  ?> 





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

  <script>
      function changeLabel(labelId, id1, id2) {
        console.log(labelId, id1, id2);

        const result1 = $('#' + id1).val();
        const result2 = $('#' + id2).val();
        let result = '';

        if ( (result1 !== '') && (result2 !== '')) {
            result = (result1 === result2) ? 'Empate' : 'Resultado';
        }

          $('#'+ labelId).text(result);
      }
  </script>

  </body>

</html>


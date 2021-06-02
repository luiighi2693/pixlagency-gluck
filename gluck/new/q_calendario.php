<?php

@session_start();

require('Connections/Connections.php');

require('include/security.php');

require('include/functions.php');

require('include/redirect.php');

?>



<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Admin | Calendario</title>

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

            Calendario

            <small>Control panel</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>

            <li class="active">Calendario</li>

          </ol>

        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

       

            <div class="col-md-12">

              <div class="box box-primary">

                <div class="box-body no-padding">

                  <!-- THE CALENDAR -->

                  <div id="calendar"></div>

                </div><!-- /.box-body -->

              </div><!-- /. box -->

            </div><!-- /.col -->

          </div><!-- /.row -->

        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->



      <footer class="main-footer">

        <div class="pull-right hidden-xs">

        </div>

        <strong>2020 <a href="http://pixlagency.com">Pixl Agency</a>.</strong> All rights reserved.

      </footer>





      <div class="control-sidebar-bg"></div>

    </div><!-- ./wrapper -->



    <!-- jQuery 2.1.4 -->

    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>

    <!-- Bootstrap 3.3.5 -->

    <script src="bootstrap/js/bootstrap.min.js"></script>

    <!-- jQuery UI 1.11.4 -->

    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

    <!-- Slimscroll -->

    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>

    <!-- FastClick -->

    <script src="plugins/fastclick/fastclick.min.js"></script>

    <!-- AdminLTE App -->

    <script src="dist/js/app.min.js"></script>

    <!-- AdminLTE for demo purposes -->

    <script src="dist/js/demo.js"></script>

    <!-- fullCalendar 2.2.5 -->

    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>

    <script src="plugins/fullcalendar/fullcalendar.js"></script>

    <!-- Page specific script -->

    <script>

      $(function () {



        /* initialize the external events

         -----------------------------------------------------------------*/

        function ini_events(ele) {

          ele.each(function () {



            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)

            // it doesn't need to have a start or end

            var eventObject = {

              title: $.trim($(this).text()) // use the element's text as the event title

            };



            // store the Event Object in the DOM element so we can get to it later

            $(this).data('eventObject', eventObject);



            // make the event draggable using jQuery UI

            $(this).draggable({

              zIndex: 1070,

              revert: true, // will cause the event to go back to its

              revertDuration: 0  //  original position after the drag

            });



          });

        }

        ini_events($('#external-events div.external-event'));



        /* initialize the calendar

         -----------------------------------------------------------------*/

        //Date for the calendar events (dummy data)

        var date = new Date();

        var d = date.getDate(),

                m = date.getMonth(),

                y = date.getFullYear();

        $('#calendar').fullCalendar({

          header: {

            left: 'prev,next today',

            center: 'title',

            right: 'month,agendaWeek,agendaDay'

          },

          buttonText: {

            today: 'today',

            month: 'month',

            week: 'week',

            day: 'day'

          },

          //Random default events

          events: [

          <?php

             $and='';

            if ($_SESSION['user']['type']==1) {

              $result='';

              $query_POO = mysqli_query($connect,"SELECT p.rowid FROM q_user_pools u, q_pools p WHERE p.rowid=u.fk_q_pools AND u.fk_q_user = ".$_SESSION['user']['rowid']);

               while ($array_POO=mysqli_fetch_array($query_POO)) {

                  $result.= $array_POO['rowid'].',';

               }

              $result=substr($result, 0,-1);

              $and=' AND p.rowid IN ( '.$result.' )';

            }



            if($query = mysqli_query($connect,"SELECT p.rowid,p.name,d.date_Sport,p.fk_sport,p.color,p.quantity,hour,label FROM q_pools p, q_pools_details d  WHERE p.rowid=d.fk_pools AND p.status=2 ".$and." ORDER BY d.date_Sport DESC ")){

              while ($array=mysqli_fetch_array($query)) {

                $your_date = strtotime($array['date_Sport']);



               $your_date =  date("Y,m,d", strtotime("-1 month", $your_date));

               $label =$_REQUEST['label'];

               $hour = $_REQUEST['hour'];



                $y=date("Y",$your_date);

                $m=date("m",$your_date);

                $d=date("d",$your_date);



              $dateTime = explode(":", $array['hour']);

              $hour = $dateTime[0];

              $min = $dateTime[1];

              $second = $dateTime[2];



                if ($_SESSION['user']['type']==0) {

                  $url="q_pools.php?rowid=".$array['rowid']."&param=edit";

                }else{

                  $url="quiniela.php?rowid=".$array['rowid']."";

                }

          ?>



            {



              title: '<?=$hour.':'.$min.'  '.$array['name'].$array['label'];?>',

              start: new Date(<?=$your_date.','.$hour.','.$min.','.$second;?>),

              end: new Date(<?=$your_date.','.$hour.','.$min.','.$second;?>),

              url: '<?=$url;?>',

              backgroundColor: '<?=$array['color'];?>', //Primary (light-blue)

              borderColor: "#00000" //Primary (light-blue)

            },

          <?php 

                          }

                      }

                      ?>



          ],

          editable: false,

          droppable: false, // this allows things to be dropped onto the calendar !!!

          drop: function (date, allDay) { // this function is called when something is dropped



            // retrieve the dropped element's stored Event Object

            var originalEventObject = $(this).data('eventObject');



            // we need to copy it, so that multiple events don't have a reference to the same object

            var copiedEventObject = $.extend({}, originalEventObject);



            // assign it the date that was reported

            copiedEventObject.start = date;

            copiedEventObject.allDay = allDay;

            copiedEventObject.backgroundColor = $(this).css("background-color");

            copiedEventObject.borderColor = $(this).css("border-color");



            // render the event on the calendar

            // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)

            $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);



            // is the "remove after drop" checkbox checked?

            if ($('#drop-remove').is(':checked')) {

              // if so, remove the element from the "Draggable Events" list

              $(this).remove();

            }



          }

        });



        /* ADDING EVENTS */

        var currColor = "#3c8dbc"; //Red by default

        //Color chooser button

        var colorChooser = $("#color-chooser-btn");

        $("#color-chooser > li > a").click(function (e) {

          e.preventDefault();

          //Save color

          currColor = $(this).css("color");

          //Add color effect to button

          $('#add-new-event').css({"background-color": currColor, "border-color": currColor});

        });

        $("#add-new-event").click(function (e) {

          e.preventDefault();

          //Get value and make sure it is not null

          var val = $("#new-event").val();

          if (val.length == 0) {

            return;

          }



          //Create events

          var event = $("<div />");

          event.css({"background-color": currColor, "border-color": currColor, "color": "#fff"}).addClass("external-event");

          event.html(val);

          $('#external-events').prepend(event);



          //Add draggable funtionality

          ini_events(event);



          //Remove event from text input

          $("#new-event").val("");

        });

      });

    </script>

  </body>

</html>


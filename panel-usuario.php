<?php
@session_start();
require('include/redirect.php');
?>
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="<?=$_SESSION['user']['name'];?>">
            </div>
            <div class="center info">
              <p><?=$_SESSION['user']['name'];?></p>
            </div>
          </div>
          <!-- search form -->

          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">Menu</li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-user"></i> <span>Clientes</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <?php if($_SESSION['user']['type']==0){?>
                <li class="active"><a href="q_user.php?rowid=0&param=insert"><i class="fa fa-user-plus"></i> Registrar Cliente</a></li>
                <?php }?>
                <li><a href="q_user_list.php"><i class="fa fa-users"></i> Lista de Clientes</a></li>
              </ul>
            </li>
            <?php if($_SESSION['user']['type']==0){?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-user"></i> <span>Deportes</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="q_sport.php?rowid=0&param=insert"><i class="fa fa-user-plus"></i> Registrar Deporte</a></li>
                <li><a href="q_sport_list.php"><i class="fa fa-users"></i> Lista de Deportes</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-user"></i> <span>Equipos</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="q_team.php?rowid=0&param=insert"><i class="fa fa-user-plus"></i> Registrar Equipo</a></li>
                <li><a href="q_team_list.php"><i class="fa fa-users"></i> Lista de Equipo</a></li>
              </ul>
            </li>
           <?php }?>
             <li class="treeview">
              <a href="#">
                <i class="fa fa-briefcase"></i><span> Quinielas</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <?php if($_SESSION['user']['type']==0){?>
                <li class="active"><a href="q_pools.php?rowid=0&param=insert"><i class="fa fa-user-plus"></i> Agregar Quiniela</a></li>
                <?php }?>
                <li><a href="q_pools_list.php"><i class="fa fa-users"></i> Lista de Quinielas</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-file-text"></i>
                <span>E-mails</span>
                <span class="label label-primary pull-right">+</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="nuevo-presupuesto.php"><i class="fa fa-plus-circle"></i> Nuevo E-mail</a></li>
                <li><a href="pages/layout/boxed.html"><i class="fa fa-files-o"></i> Lista de E-mails</a></li>
              </ul>
            </li>
            <!--
            <li>
              <a href="pages/widgets.html">
                <i class="fa fa-th"></i> <span>Widgets</span> <small class="label pull-right bg-green">new</small>
              </a>
            </li>
            -->
            <!--
            <li class="treeview">
              <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Charts</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
                <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
                <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
                <li><a href="pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
              </ul>
            </li>
            -->
            <!--
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>UI Elements</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
                <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
                <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
                <li><a href="pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
                <li><a href="pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
                <li><a href="pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
              </ul>
            </li>
            -->
            <!--
            <li class="treeview">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Forms</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
                <li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
                <li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
              </ul>
            </li>

            <!--  
            <li class="treeview">
              <a href="#">
                <i class="fa fa-table"></i> <span>Tables</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
                <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
              </ul>
            </li>
             -->
            <li>
              <a href="pages/calendar.html">
                <i class="fa fa-calendar"></i> <span>Calendario</span>
                <small class="label pull-right bg-red">3</small>
              </a>
            </li>

            
      
        
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
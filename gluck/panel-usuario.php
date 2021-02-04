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
              <img src="<?=($_SESSION['user']['img']!='')?'images/clients/'.$_SESSION['user']['img']:'images/clients/avatar5.png';?>" class="img-circle" alt="<?=$_SESSION['user']['name'];?>">
            </div>
            <div class="center info">
              <p><?=$_SESSION['user']['name'];?></p>
            </div>
          </div>
          <!-- search form -->

          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
           <li class="header"><a href="home.php" style="color: #000;"><h5 style="text-align: center; font-weight: bold;">Menu</h5></a></li> 
              <?php if($_SESSION['user']['type']==1){?>
           <a href="q_user.php?rowid=<?=$_SESSION['user']['rowid'];?>&param=edit">
                
                <li>
                 <i class="fa fa-user"></i> <span>Editar Perfil</span>
               </a>
             </li>
               <?php }?>
            <?php if($_SESSION['user']['type']==0){?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-user"></i> <span>Clientes</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
               <?php }?>
              <ul class="treeview-menu">
                <?php if($_SESSION['user']['type']==0){?>
                <li class="active"><a href="q_user.php?rowid=0&param=insert"><i class="fa fa-user-plus"></i> Registrar Cliente</a></li>
                <?php }?>
                <?php if($_SESSION['user']['type']==0){?>
                <li><a href="q_user_list.php"><i class="fa fa-users"></i> Lista de Clientes</a></li>
                <?php }?>
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
                <li><a href="q_pools_list.php"><i class="fa fa-users"></i> Lista de Quinielas</a></li>
                <li><a href="q_pools_list_result.php"><i class="fa fa-users"></i> Resultados</a></li>
                <?php }else{ ?>
                <li><a href="quiniela.php"><i class="fa fa-users"></i> Lista de Quinielas </a></li>
                <li><a href="q_pools_list_result.php"><i class="fa fa-users"></i> Resultados</a></li>
                <?php } ?>
              </ul>
            </li>
            <?php if($_SESSION['user']['type']==0){?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-file-text"></i>
                <span>E-mails</span>
                <span class="label label-primary pull-right">+</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="q_compose.php"><i class="fa fa-plus-circle"></i> Nuevo E-mail</a></li>
                <!--li><a href="#"><i class="fa fa-files-o"></i> Lista de E-mails</a></li--->
              </ul>
            </li>
                <?php }?>
            <li class="treeview">
              <a href="q_calendario.php">
                <i class="fa fa-calendar"></i> <span>Calendario</span>
                <!--small class="label pull-right bg-red">3</small-->
              </a>
            </li>
            <?php if($_SESSION['user']['type']==1){?>
              <li>
              <a href="#">
                <img src="images/logo-whatsapp.png" width="20%">
                <span>¡Contactanos!</span>
                <!--small class="label pull-right bg-red">3</small-->
              </a>
            </li>
            <?php }?> 
            
      
        
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
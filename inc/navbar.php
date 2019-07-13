<?php
    if(isset($_POST['nombre_login']) && isset($_POST['contrasena_login'])){
        include "./process/login.php";
    }
?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> 
            </button>
            <a class="navbar-brand">&nbsp;&nbsp; SISTEMA MLT Y GRIEGA &nbsp;&nbsp;<sup><small><span class="label label-danger">V 1.9.1</span></small></sup></a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <?php if(isset($_SESSION['tipo']) && isset($_SESSION['nombre'])): ?>
            <ul class="nav navbar-nav navbar-right">
                
                <li class="dropdown">
                        <a href="#" class="dropdown-toggle btn btn-sq-sm" data-toggle="dropdown">
                        <span class="fa fa-user-circle-o" style="color:#f1c40f;"></span> &nbsp;Bienvenido:&nbsp;<strong style="color: #f1c40f ;"><?php echo utf8_encode($_SESSION['nombre']); ?></strong> &nbsp;<b class="caret"></b>
                    </a>
                    
                        <!-- usuarios -->
                        
                        <?php if($_SESSION['tipo']=="user"):  ?>
                    <ul class="dropdown-menu">
                         <li>
                    <a href="./index.php?view=soporte"><span class="glyphicon glyphicon-credit-card"></span>&nbsp;&nbsp;Solicitud de Ordenes</a>
                        </li>
                        <li>
                            <a href="./index.php?view=configuracion"><i class="fa fa-cogs"></i>&nbsp;&nbsp;Configuracion</a>
                        </li> 
                        <li >
                            <a href="./process/logout.php"><i class="fa fa-power-off"></i>&nbsp;&nbsp;Cerrar sesión</a></li>
                    </ul>
              </li>
                        <li>
                    <a href="./index.php?view=menu"><span class="fa fa-home"></span>&nbsp;&nbsp;Inicio</a>
                        </li>
                       <li>
                    <a href="./index.php?view=soporte"><span class="fa fa-ticket"></span>&nbsp;&nbsp;Ticket´s</a>
                        </li>
                  <li>
                    <a href="./index.php?view=soporte-actividad"><span class="fa fa-pencil-square-o"></span>&nbsp;&nbsp;Actividades</a>
                        </li>
                        <?php endif; ?>
                     
                        <!-- admins -->
                        
                 <?php if($_SESSION['tipo']=="admin"): ?>
                        <ul class="dropdown-menu">
                        <li> 
                            <a href="admin.php?view=config"><i class="fa fa-cogs"></i>&nbsp;Configuracion Administrador</a>
                        </li> 
                        <li >
                            <a href="./process/logout.php"><i class="fa fa-power-off"></i>&nbsp;&nbsp;Cerrar sesión</a></li>
                    
                        </ul>
                        <li>
                            <a href="admin.php?view=menu-admin"><span class="fa fa-home"></span>&nbsp;Inicio</a>
                        </li>
                        <li>
                    <a href="#" class="dropdown-toggle btn btn-sq-sm " data-toggle="dropdown"><span class="fa fa-bar-chart"></span>&nbsp;&nbsp;Usuarios&nbsp;&nbsp;<b class="caret"></b></a>
                    <ul class="dropdown-menu multi-level">
                    <li>
                            <a href="admin.php?view=users"><span class="fa fa-users"></span>&nbsp; Usuarios</a>
                        </li>
                         <li>
                             <a href="admin.php?view=admin"><i class="fa fa-users"></i>&nbsp;Administradores</a>
                        </li>
                    </ul>
                </li>
                
                    <li>
                    <a href="#" class="dropdown-toggle btn btn-sq-sm " data-toggle="dropdown"><span class="fa fa-bar-chart"></span>&nbsp;&nbsp;Administrar Tickets&nbsp;&nbsp;<b class="caret"></b></a>
                    <ul class="dropdown-menu multi-level"> 
                        <li>
                             <a href="admin.php?view=solicitud-ticket-admin"><span class="fa fa-ticket"></span>&nbsp;&nbsp;Solicitud de Ticket</a> 
                        </li> 
                        <li class="divider"></li>
                         <li>
                            <a href="admin.php?view=ticketadmin"><span class="fa fa-ticket"></span>&nbsp;&nbsp;Todos los Tickes</a>
                        </li> 
                        <li>
                            <a href="admin.php?view=reporteAE"><span class="fa fa-line-chart"></span>&nbsp;&nbsp;Tickets Asesor Externo</a>
                        </li>
                         
                        <li>
                            <a href="admin.php?view=reporteCM"><span class="fa fa-area-chart"></span>&nbsp;&nbsp;Tickets Calidad</a>
                        
                        </li>
                       
                        <li>
                            <a href="admin.php?view=reporteHS"><span class="fa fa-bar-chart"></span>&nbsp;&nbsp;Tickets Software y Hardware</a>
                        
                        </li>
                 
                        <li >
                            <a href="admin.php?view=reporteCS"><span class="fa fa-pie-chart"></span>&nbsp;&nbsp;Tickets Comunicacion y Seguridad TI</a>
                        
                        </li>
                    </ul>
                </li>
            
                          <li>
                    <a href="#" class="dropdown-toggle btn btn-sq-sm " data-toggle="dropdown"><span class="fa fa-bar-chart"></span>&nbsp;&nbsp;Reporte de Actividades&nbsp;&nbsp;<b class="caret"></b></a>
                    <ul class="dropdown-menu multi-level">
                        <li>
                            <a href="admin.php?view=actividades-general"><span class="fa fa-line-chart"></span>&nbsp;&nbsp;Todos los reportes</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="admin.php?view=menu-departamento-actividades"><span class="fa fa-bar-chart"></span>&nbsp;&nbsp;Reporte Por Departamento</a>
                        
                        </li>
                  
                    </ul>
                </li>
                       <?php endif; ?>  
                        <li>
                            <a href="./process/logout.php"><i class="fa fa-power-off"></i>&nbsp;&nbsp;Cerrar sesión</a></li>
                        <?php endif; ?>
                        <ul class=" nav navbar-nav navbar-right"> 
                         <?php if(!isset($_SESSION['tipo']) && !isset($_SESSION['nombre'])): ?>
                     <li>
                    <a href="./sup.php"><i class="fa fa-user-secret"></i>&nbsp; Iniciar sesión Administrador</a>
                </li>
                <li>
                    <a href="http://www.laygriega.com.mx/"><span class="glyphicon glyphicon-globe"></span> &nbsp;Web LA Y GRIEGA</a>
                </li>
                <li>
                   <a href="./index.php"><i class="fa fa-user"></i>&nbsp; Iniciar sesión Usuario</a>
                </li>
                <li>
                    <a href="./index.php?view=registro"><i class="fa fa-users"></i>&nbsp;&nbsp;Registro</a>
                </li>
                <?php endif; ?>
            </ul>
                </ul>
      </div>
    </div>
</nav> 
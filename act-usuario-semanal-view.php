<?php 
header('Content-Type: text/html; charset=UTF-8'); 
session_start();
include './lib/class_mysql.php';
include './lib/config.php';
if($_SESSION['clave']!="" && isset($_SESSION['id_cliente'])){ $nombre_user= $_SESSION['email']; $id_clien= $_SESSION['id_cliente'];?>

    <!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Reporte Usuario</title>
        <?php include "./inc/links.php"; ?>        
    </head>
    <body>   
        <?php include "./inc/navbar.php"; ?>
        <br>
        <div class="container">
            <div class="row">
            <div class="col-sm-12">
              <div class="page-header">
                <h1 class="animated lightSpeedIn">Reporte de Actividades Realizadas</h1>
                <span class="label label-danger">Sistema de Ordenes de Mejora LA Y GRIEGA</span>
                <p class="pull-right text-success">
                  <strong>
                  <span class="glyphicon glyphicon-time"></span>&nbsp;<?php include "./inc/timezone.php"; ?>
                 </strong>
               </p>
              </div>
            </div>
          </div>
        </div>
        
            <?php

                /* Todas los actividades*/
$num_actividad_all=Mysql::consulta(" SELECT a.fecha_sem,a.hora_sem, a.estatus,t.nombre_completo_a,a.fecha_revi,a.hora_revi
FROM actividad_semanal a INNER JOIN cliente c ON a.id_cliente_sem = c.id_cliente INNER JOIN administrador t ON  a.id_admin_fks = t.id_admin WHERE a.id_cliente_sem = a.id_cliente_sem AND a.id_cliente_sem = '$id_clien'");
                $num_total_all=mysqli_num_rows($num_actividad_all);
                                                             
                                                             
            /* Tickets pendientes*/
                $num_ticket_pend=Mysql::consulta("SELECT a.fecha_sem,a.hora_sem, a.estatus,t.nombre_completo_a,a.fecha_revi,a.hora_revi
FROM actividad_semanal a INNER JOIN cliente c ON a.id_cliente_sem = c.id_cliente INNER JOIN administrador t ON  a.id_admin_fks = t.id_admin WHERE a.id_cliente_sem = a.id_cliente_sem AND a.id_cliente_sem = '$id_clien' AND a.estatus  = 'Pendiente'" );
                $num_total_pend=mysqli_num_rows($num_ticket_pend);
            
          /* actividades Revisadas*/
                $num_ticket_res=Mysql::consulta("SELECT a.fecha_sem,a.hora_sem, a.estatus,t.nombre_completo_a,a.fecha_revi,a.hora_revi
FROM actividad_semanal a INNER JOIN cliente c ON a.id_cliente_sem = c.id_cliente INNER JOIN administrador t ON  a.id_admin_fks = t.id_admin WHERE a.id_cliente_sem = a.id_cliente_sem AND a.id_cliente_sem = '$id_clien' AND a.estatus  = 'Revisado'");
                $num_total_res=mysqli_num_rows($num_ticket_res);
        ?>
            <div class="container">
                      <div class="row">
                <div class="col-sm-2">
                   <a href="actividad-usuario-view.php" class="btn btn-success btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Actividad Diaria</a>
            </div>
                   <div class="col-sm-2">
                   <a href="act-usuario-semanal-view.php" class="btn btn-success btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Actividad Semanal</a>
            </div>
                   <div class="col-sm-2">
                   <a href="" class="btn btn-success btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Actividad Mensual</a>
            </div>
                   <div class="col-sm-2">
                   <a href="" class="btn btn-success btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Actividad Trimestral</a>
            </div>
                   <div class="col-sm-2">
                   <a href="" class="btn btn-success btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Actividad Anual</a>
            </div>
                   <div class="col-sm-2">
                   <a href="" class="btn btn-success btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Actividad x Periodo</a>
            </div>
          </div>
        </div>
  <br>
            <div class="container">
                <div class="row">
                    <div class="col-md">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="act-usuario-semanal-view.php?ticket=all"><i class="fa fa-list"></i>&nbsp;&nbsp;Todas las Actividades&nbsp;&nbsp;<span class="label label-primary"><?php echo $num_total_all; ?></span></a></li>
                            <li><a href="act-usuario-semanal-view.php?ticket=all"><i class="fa fa-list"></i>&nbsp;&nbsp;Pendientes en Revisar&nbsp;&nbsp;<span class="label label-warning"><?php echo $num_total_pend; ?></span></a></li>
                            <li><a href="act-usuario-semanal-view.php?ticket=all"><i class="fa fa-list"></i>&nbsp;&nbsp;Actividades Revisadas&nbsp;&nbsp;<span class="label label-info"><?php echo $num_total_res; ?></span></a></li>
                        </ul>
                         </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
           
                            
                            
                            <?php
                                $mysqli = mysqli_connect(SERVER, USER, PASS, BD);
                                mysqli_set_charset($mysqli, "utf8");

                                $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                                $regpagina = 15;
                                $inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;

                                
                                if(isset($_GET['actividad_diaria'])){
                                    if($_GET['actividad_diaria']=="all"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * ROM actividad_semanal a INNER JOIN cliente c ON a.id_cliente_sem = c.id_cliente INNER JOIN administrador t ON  a.id_admin_fks = t.id_admin WHERE a.id_cliente_sem = a.id_cliente_sem AND a.id_cliente_sem = '$id_clien'LIMIT $inicio, $regpagina";
                         
                                    }else{
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM actividad_semanal a INNER JOIN cliente c ON a.id_cliente_sem = c.id_cliente INNER JOIN administrador t ON  a.id_admin_fks = t.id_admin WHERE a.id_cliente_sem = a.id_cliente_sem AND a.id_cliente_sem = '$id_clien' LIMIT $inicio, $regpagina";
                                    }
                                }else{
                                    $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM actividad_semanal a INNER JOIN cliente c ON a.id_cliente_sem = c.id_cliente INNER JOIN administrador t ON  a.id_admin_fks = t.id_admin WHERE a.id_cliente_sem = a.id_cliente_sem AND a.id_cliente_sem = '$id_clien' LIMIT $inicio, $regpagina";
                                }


                                 $selactividad=mysqli_query($mysqli,$consulta);

                                $totalregistros = mysqli_query($mysqli,"SELECT FOUND_ROWS()");
                                $totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);
                        
                                $numeropaginas = ceil($totalregistros["FOUND_ROWS()"]/$regpagina);

                                if(mysqli_num_rows($selactividad)>0):
                            ?>
                            
                            <div class="panel panel-primary">
<div style="margin:7px">
        <div class="col-xs-6">
        <div class="btn-group">
        </div>
      </div>
        </div>
  <div class="panel-body" style="padding:0px">
  <table class="table table-striped table-bordered" style="margin:0px">
                               <thead>
                                    <tr>
                                        <th class="text-center" scope="col">#</th>
                                        <th class="text-center" scope="col">Fecha Elaboración</th>
                                        <th class="text-center" scope="col">Hora Elaboración</th>
                                        <th class="text-center" scope="col">Estatus</th>
                                        <th class="text-center" scope="col">Nombre del Revisor</th>
                                        <th class="text-center" scope="col">Fecha de Revisión</th>
                                        <th class="text-center" scope="col">Hora de Revisión</th>
                                        <th class="text-center" scope="col">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $ct=$inicio+1;
                                        while ($row=mysqli_fetch_array($selactividad, MYSQLI_ASSOC)): 
                                    ?>
                                    <tr>
                                        <td class="text-center" scope="row" data-label="Registro"><?php echo $ct; ?></td>
                                        <td class="text-center" data-label="Fecha:"><?php echo $row['fecha_sem']; ?></td>
                                        <td class="text-center" data-label="Hora:"><?php echo $row['hora_sem']; ?></td>
                                    <td class="text-center" data-label="Estatus:"> <?php 
  //pintamos de colorores los estados de la actividad
	switch ($row['estatus'])
	{
		case "Pendiente":
		echo '<span class="btn btn-danger btn-xs" disabled="disabled">'.$row["estatus"].'</span>';
		break;
		case "Revisado":
		echo '<span class="btn btn-info btn-xs" disabled="disabled">'.$row["estatus"].'</span>';
		break;
	}
  ?>
</td>                                       <td class="text-center" data-label="Fecha:"><?php echo $row['nombre_completo_a']; ?></td>
                                          <td class="text-center" data-label="Fecha:"><?php echo $row['fecha_revi']; ?></td>
                                        <td class="text-center" data-label="Hora:"><?php echo $row['hora_revi']; ?></td>
                                        <td class="text-center" data-label="Opciones:">
                                            <a href="./lib/pdf.php?id=<?php echo $row['id'] ?>" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                                               <a href="act-descripcion-semanal-view.php?id=<?php echo $row['id_act'] ?>" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-eye-open"></span></a>
                                        </td>
                                    </tr>
                                    <?php
                                        $ct++;
                                        endwhile; 
                                    ?>
                                </tbody>
      
</table>
      <?php else: ?>
                                <h2 class="text-center">No hay Actividad registrada en el sistema</h2>
                            <?php endif; ?>
                        </div>
                        <?php 
                            if($numeropaginas>=1):
                            if(isset($_GET['actividad_diaria'])){
                                $actividadselected=$_GET['actividad_diaria'];
                            }else{
                                $actividadselected="all";
                            }
                        ?>
  </div>
  <div class="panel-footer">
      <div class="col-xs-3"><div class="dataTables_info" id="example_info">Showing 51 - 60 of 100 total results</div></div>
    <div class="col-xs-6">
<div class="dataTables_paginate paging_bootstrap">
<ul class="pagination pagination-sm" style="margin:0 !important">
 <?php if($pagina == 1): ?>
                                    <li class="disabled">
                                        <a aria-label="Previous">
                                            <span aria-hidden="true">&laquo;&nbsp;Anterior</span>
                                        </a>
                                    </li>
                                <?php else: ?>
                                    <li>
                                        <a href="./actividad-usuario-view.php=<?php echo $actividadselected; ?>&pagina=<?php echo $pagina-1; ?>" aria-label="Previous">
                                            <span aria-hidden="true">&larr;</span>&nbsp;Anterior
                                        </a>
                                    </li>
                                <?php endif; ?>
                                
                                
                                <?php
                                    for($i=1; $i <= $numeropaginas; $i++ ){
                                        if($pagina == $i){
                                            echo '<li class="active"><a href="./actividad-usuario-view.php?ticket='.$actividadselected.'&pagina='.$i.'">'.$i.'</a></li>';
                                        }else{
                                            echo '<li><a href="./actividad-usuario-view.php?ticket='.$actividadselected.'&pagina='.$i.'">'.$i.'</a></li>';
                                        }
                                    }
                                ?>
                                
                                
                                <?php if($pagina == $numeropaginas): ?>
                                    <li class="disabled">
                                        <a aria-label="Previous">
                                            <span aria-hidden="true">&raquo;&nbsp;Siguiente</span>
                                        </a>
                                    </li>
                                <?php else: ?>
                                    <li>
                                        <a href="./actividad-usuario-view.php?ticket=<?php echo $actividadselected; ?>&pagina=<?php echo $pagina+1; ?>" aria-label="Previous">
                                            <span aria-hidden="true">&rarr;</span>&nbsp;Siguiente
                                        </a>
                                    </li>
                                <?php endif; ?>
    
    </ul>
</div>
</div>
<div class="btn-group">
  <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
    10 <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu" style="min-width: 0px ">
    <li><a href="#">5</a></li>
    <li class="active"><a href="#">10</a></li>
    <li><a href="#">15</a></li>
    <li><a href="#">15</a></li>
  </ul>
  <span>items per page </span>
</div>
  </div>
</div>
                            
                            
                            <?php else: ?>
                    
                            <?php endif; ?>
                        </div>
                        <?php 
                            if($numeropaginas>=1):
                            if(isset($_GET['actividad_diaria'])){
                                $actividadselected=$_GET['actividad_diaria'];
                            }else{
                                $actividadselected="all";
                            }
                        ?>
                      <nav aria-label="Page navigation" class="text-center">
                            <ul class="pagination">
                                <?php if($pagina == 1): ?>
                                    <li class="disabled">
                                        <a aria-label="Previous">
                                            <span aria-hidden="true">&laquo;&nbsp;Anterior</span>
                                        </a>
                                    </li>
                                <?php else: ?>
                                    <li>
                                        <a href="./actividad-usuario-view.php=<?php echo $actividadselected; ?>&pagina=<?php echo $pagina-1; ?>" aria-label="Previous">
                                            <span aria-hidden="true">&larr;</span>&nbsp;Anterior
                                        </a>
                                    </li>
                                <?php endif; ?>
                                
                                
                                <?php
                                    for($i=1; $i <= $numeropaginas; $i++ ){
                                        if($pagina == $i){
                                            echo '<li class="active"><a href="./actividad-usuario-view.php?ticket='.$actividadselected.'&pagina='.$i.'">'.$i.'</a></li>';
                                        }else{
                                            echo '<li><a href="./actividad-usuario-view.php?ticket='.$actividadselected.'&pagina='.$i.'">'.$i.'</a></li>';
                                        }
                                    }
                                ?>
                                
                                
                                <?php if($pagina == $numeropaginas): ?>
                                    <li class="disabled">
                                        <a aria-label="Previous">
                                            <span aria-hidden="true">&raquo;&nbsp;Siguiente</span>
                                        </a>
                                    </li>
                                <?php else: ?>
                                    <li>
                                        <a href="./actividad-usuario-view.php?ticket=<?php echo $actividadselected; ?>&pagina=<?php echo $pagina+1; ?>" aria-label="Previous">
                                            <span aria-hidden="true">&rarr;</span>&nbsp;Siguiente
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                        <?php endif; ?>
                    </div>
                </div>
                
            </div><!--container principal-->
        
        
        
        
        
<?php
}else{
?>
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <img src="./img/Stop.png" alt="Image" class="img-responsive animated slideInDown"/><br>
                    <img src="./img/SadTux.png" alt="Image" class="img-responsive"/>
                    
                </div>
                <div class="col-sm-7 animated flip">
                    <h1 class="text-danger">Lo sentimos esta página es solamente para administradores del Sistema OM La Y Griega</h1>
                    <h3 class="text-info text-center">Inicia sesión como administrador para poder acceder</h3>
                </div>
                <div class="col-sm-1">&nbsp;</div>
            </div>
        </div>
        </body>
        </html>
    
<?php
}
?>  
       <?php include './inc/footer.php'; ?>
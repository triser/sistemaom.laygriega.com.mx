            <?php

                /* Todos las actividades*/
 $num_actividad_all=Mysql::consulta("SELECT nombre_completo,  email_cliente, descripcion, fecha_act, hora_act FROM actividad_diaria a, cliente c WHERE a.id_cliente_fk = c.id_cliente");
                   $num_total_all=mysqli_num_rows($num_actividad_all);

                /* Actividades en pendientes de revicion*/
               $num_actividad_proceso=Mysql::consulta("SELECT nombre_completo,  email_cliente, descripcion, fecha_act, hora_act, estatus FROM actividad_diaria a, cliente c WHERE a.id_cliente_fk = c.id_cliente AND  estatus='Revisado'");
               $num_total_proceso=mysqli_num_rows($num_actividad_proceso);

                /* Actividades en revisadas*o*/
                  $num_actividad_pend=Mysql::consulta("SELECT nombre_completo,  email_cliente, descripcion, fecha_act, hora_act, estatus FROM actividad_diaria a, cliente c WHERE a.id_cliente_fk = c.id_cliente AND  estatus='Pendiente'");
                $num_total_pend=mysqli_num_rows($num_actividad_pend);

            ?>

            <div class="container">
                <div class="row">
                    <div class="col-md">
                        <ul class="nav nav-pills nav-justified">
            <li><a href="./admin.php?view=actividades-general&actividad=all"><i class="fa fa-list"></i>&nbsp;&nbsp;Todos las Actividades&nbsp;&nbsp;<span class="label label-primary"><?php echo $num_total_all; ?></span></a></li>
<li><a href="./admin.php?view=actividades-general&actividad=pending"><i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;Actividas Pendientes&nbsp;&nbsp;<span class="label label-danger"><?php echo $num_total_pend; ?></span></a></li>
<li><a href="./admin.php?view=actividades-general&actividad=process"><i class="fa fa-folder-open"></i>&nbsp;&nbsp;Actividades Revisadas&nbsp;&nbsp;<span class="label label-warning"><?php echo $num_total_proceso; ?></span></a></li>
                           
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
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM actividad_diaria a, cliente c WHERE a.id_cliente_fk = c.id_cliente LIMIT $inicio, $regpagina";
                                    }elseif($_GET['actividad_diaria']=="pending"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM actividad_diaria a, cliente c WHERE a.id_cliente_fk = c.id_cliente AND estatus='Pendiente' LIMIT $inicio, $regpagina";
                                    }elseif($_GET['actividad_diaria']=="process"){
                                     $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM actividad_diaria a, cliente c WHERE a.id_cliente_fk = c.id_cliente AND estatus='Revisado' LIMIT $inicio, $regpagina";
                                    }else{
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM actividad_diaria a, cliente c WHERE a.id_cliente_fk = c.id_cliente ORDER BY id_act ASC LIMIT $inicio, $regpagina";
                                    }
                                }else{
                                    $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM actividad_diaria a, cliente c WHERE a.id_cliente_fk = c.id_cliente ORDER BY id_act ASC LIMIT $inicio, $regpagina";
                                }


                                 $selactividad=mysqli_query($mysqli,$consulta);

                                $totalregistros = mysqli_query($mysqli,"SELECT FOUND_ROWS()");
                                $totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);
                        
                                $numeropaginas = ceil($totalregistros["FOUND_ROWS()"]/$regpagina);

                                if(mysqli_num_rows($selactividad)>0):
                            ?>
                            <table class="table table-hover table-striped table-bordered points_table_admin2">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">#</th>
                                        <th class="text-center" scope="col">Fecha Elaboración</th>
                                        <th class="text-center" scope="col">Hora Elaboración</th>
                                         <th class="text-center" scope="col">Nombre Completo</th>
                                        <th class="text-center" scope="col">Estatus</th>
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
                                        <td class="text-center" data-label="Fecha:"><?php echo $row['fecha_act']; ?></td>
                                        <td class="text-center" data-label="Hora:"><?php echo $row['hora_act']; ?></td>
                                          <td class="text-center" data-label="Nombre Completo:"><?php echo $row['nombre_completo']; ?></td>
                                        <td class="text-center" data-label="Estatus:"> <?php 
  //pintamos de colorores los estados del actividad
	switch ($row['estatus'])
	{
		case "Pendiente":
		echo '<span class="btn btn-danger btn-xs" disabled="disabled">'.$row["estatus"].'</span>';
		break;
		case "Revisado":
		echo '<span class="btn btn-primary btn-xs" disabled="disabled">'.$row["estatus"].'</span>';
		break;
	}
  ?>
</td>
                                          <td class="text-center" data-label="Fecha Revicion:"><?php echo $row['fecha_revi']; ?></td>
                                        <td class="text-center" data-label="Hora:"><?php echo $row['hora_revi']; ?></td>

                                        <td class="text-center" data-label="Opciones:">

                                            <a href="./lib/pdf.php?id=<?php echo $row['id_act'] ?>" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                     
                                            
                                                      <!--ver lista de comentarios-->
                                          <a href="admin.php?view=actividadedit&id=<?php echo $row['id_act']; ?>" 
                                            class="btn btn-sm btn btn-info red-tooltip"data-toggle="tooltip" data-placement="right" id="tooltipex" title="<?php echo $row['descripcion']; ?>"><i class="fa fa-list" aria-hidden="true"></i></a>
                                        </td>
                            
                                    </tr>
                                    <?php
                                        $ct++;
                                        endwhile; 
                                    ?>
                                </tbody>
                            </table>
                            <?php else: ?>
                                <h2 class="text-center">No hay Ordenes registrados en el sistema con este estatus</h2>
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
                                        <a href="./admin.php?view=actividades-general&actividad=<?php echo $actividadselected; ?>&pagina=<?php echo $pagina-1; ?>" aria-label="Previous">
                                            <span aria-hidden="true">&larr;</span>&nbsp;Anterior
                                        </a>
                                    </li>
                                <?php endif; ?>
                                
                                
                                <?php
                                    for($i=1; $i <= $numeropaginas; $i++ ){
                                        if($pagina == $i){
                                            echo '<li class="active"><a href="./admin.php?view=actividades-general&actividad='.$actividadselected.'&pagina='.$i.'">'.$i.'</a></li>';
                                        }else{
                                            echo '<li><a href="./admin.php?view=actividades-general&actividad='.$actividadselected.'&pagina='.$i.'">'.$i.'</a></li>';
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
                                        <a href="./admin.php?view=actividades-general&actividad=<?php echo $actividadselected; ?>&pagina=<?php echo $pagina+1; ?>" aria-label="Previous">
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



  <style type="text/css">
    .red-tooltip + .tooltip > .tooltip-arrow { border-right-color:#428bca; }
    .red-tooltip + .tooltip > .tooltip-inner {background-color: #428bca;}
</style>   
        <script type="text/javascript">
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
  $("a").tooltip();
});
</script>

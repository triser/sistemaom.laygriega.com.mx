<?php if( $_SESSION['nombre']!="" && $_SESSION['clave']!="" && $_SESSION['tipo']=="admin"){ ?>
        <div class="container">
          <div class="row">
            <div class="col-sm-2">
              <center><img src="./img/msj.png" alt="Image" class="img-responsive animated tada"></center>
            </div>
            <div class="col-sm-10">
              <p class="lead text-info">Bienvenido administrador <?php echo $_SESSION['nombre_completo_a']; ?>, aqui se muestran todas las Actividades de todos los departamento los cuales podra, Revisar, imprimir y Consultar</p>
            </div>
          </div>
        </div>
            <?php
                   /* Todos los tickets*/
                $num_ticket_all=Mysql::consulta("SELECT a.fecha_act,a.hora_act, c.nombre_completo,a.estatus,t.nombre_completo_a,a.fecha_revi,a.hora_revi
FROM actividad_diaria a INNER JOIN cliente c ON a.id_cliente_fk = c.id_cliente INNER JOIN administrador t ON  a.id_admin_fk = t.id_admin"  );
                $num_total_all=mysqli_num_rows($num_ticket_all);
                
                /* Tickets pendientes*/
                $num_ticket_pend=Mysql::consulta("SELECT a.fecha_act,a.hora_act, c.nombre_completo,a.estatus,t.nombre_completo_a,a.fecha_revi,a.hora_revi
FROM actividad_diaria a INNER JOIN cliente c ON a.id_cliente_fk = c.id_cliente INNER JOIN administrador t ON  a.id_admin_fk = t.id_admin WHERE a.id_cliente_fk = a.id_cliente_fk AND estatus='Pendiente'" );
                $num_total_pend=mysqli_num_rows($num_ticket_pend);

    
                /* Tickets resueltos*/
                $num_ticket_res=Mysql::consulta("SELECT a.fecha_act,a.hora_act, c.nombre_completo,a.estatus,t.nombre_completo_a,a.fecha_revi,a.hora_revi
FROM actividad_diaria a INNER JOIN cliente c ON a.id_cliente_fk = c.id_cliente INNER JOIN administrador t ON  a.id_admin_fk = t.id_admin WHERE a.id_cliente_fk = a.id_cliente_fk AND estatus='Revisado'");
                $num_total_res=mysqli_num_rows($num_ticket_res);
  
            ?>
            <div class="container">
                      <div class="row">
                       <div class="col-sm-2">
                   <a href="./admin.php?view=act-diarias" class="btn btn-info btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Actividad Diaria</a>
            </div>
                   <div class="col-sm-2">
                   <a href="./admin.php?view=act-semanales" class="btn btn-info btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Actividad Semanal</a>
            </div>
                   <div class="col-sm-2">
                   <a href="" class="btn btn-info btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Actividad Mensual</a>
            </div>
                   <div class="col-sm-2">
                   <a href="" class="btn btn-info btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Actividad Trimestral</a>
            </div>
                   <div class="col-sm-2">
                   <a href="" class="btn btn-info btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Actividad Anual</a>
            </div>
                   <div class="col-sm-2">
                   <a href="" class="btn btn-info btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Actividad x Periodo</a>
            </div>
          </div>
        </div>
  <br>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="./admin.php?view=act-diarias&ticket=all"><i class="fa fa-list"></i>&nbsp;&nbsp;Todos las actividaes&nbsp;&nbsp;<span class="label label-primary"><?php echo $num_total_all; ?></span></a></li>
                            <li><a href="./admin.php?view=act-diarias&ticket=pending"><i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;Actividades Pendientes&nbsp;&nbsp;<span class="label label-danger"><?php echo $num_total_pend; ?></span></a></li>
                            <li><a href="./admin.php?view=act-diarias&ticket=resolved"><i class="fa fa-check-square-o"></i>&nbsp;&nbsp;Actividades Revisadas&nbsp;&nbsp;<span class="label label-warning"><?php echo $num_total_res; ?></span></a></li>
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
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM actividad_diaria a INNER JOIN cliente c ON a.id_cliente_fk = c.id_cliente INNER JOIN administrador t ON  a.id_admin_fk = t.id_admin LIMIT $inicio, $regpagina";
                                    }elseif($_GET['actividad_diaria']=="pending"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM actividad_diaria a INNER JOIN cliente c ON a.id_cliente_fk = c.id_cliente INNER JOIN administrador t ON  a.id_admin_fk = t.id_admin WHERE a.id_cliente_fk = a.id_cliente_fk AND estatus='Pendiente' LIMIT $inicio, $regpagina";
                                    }elseif($_GET['actividad_diaria']=="resolved"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM actividad_diaria a INNER JOIN cliente c ON a.id_cliente_fk = c.id_cliente INNER JOIN administrador t ON  a.id_admin_fk = t.id_admin WHERE a.id_cliente_fk = a.id_cliente_fk AND = 'Revisado' LIMIT $inicio, $regpagina";
                                    
                                                                }else{
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM actividad_diaria a INNER JOIN cliente c ON a.id_cliente_fk = c.id_cliente INNER JOIN administrador t ON  a.id_admin_fk = t.id_admin ORDER BY id_act ASC LIMIT $inicio, $regpagina";
                                    }
                                }else{
                                    $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM actividad_diaria a INNER JOIN cliente c ON a.id_cliente_fk = c.id_cliente INNER JOIN administrador t ON  a.id_admin_fk = t.id_admin ORDER BY id_act ASC LIMIT $inicio, $regpagina";
                                }



                                $selticket=mysqli_query($mysqli,$consulta);

                                $totalregistros = mysqli_query($mysqli,"SELECT FOUND_ROWS()");
                                $totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);
                        
                                $numeropaginas = ceil($totalregistros["FOUND_ROWS()"]/$regpagina);

                                if(mysqli_num_rows($selticket)>0):
                            ?>
                            <table class="table table-hover table-striped table-bordered points_table_admin2">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">#</th>
                                        <th class="text-center" scope="col">Nombre Completo</th>
                                        <th class="text-center" scope="col">Fecha Elaboración</th>
                                        <th class="text-center" scope="col">Hora</th>
                                         <th class="text-center" scope="col">Nombre del Revisor</th>
                                        <th class="text-center" scope="col">Estatus</th>
                                        <th class="text-center" scope="col">Fecha Revisión</th>
                                        <th class="text-center" scope="col">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $ct=$inicio+1;
                                        while ($row=mysqli_fetch_array($selticket, MYSQLI_ASSOC)): 
                                    ?>
                                    <tr>
                                        <td class="text-center" scope="row" data-label="Registro"><?php echo $ct; ?></td>
                                         <td class="text-center" data-label="Nombre del Usuario:"><?php echo $row['nombre_completo']; ?></td>
                                        <td class="text-center" data-label="Fecha de Elaboracion:"><?php echo $row['fecha_act']; ?></td>
                                        <td class="text-center" data-label="Hora:"><?php echo $row['hora_act']; ?></td>
                                          <td class="text-center" data-label="Nombre del Revisor:"><?php echo $row['nombre_completo_a']; ?></td>
                                        <td class="text-center" data-label="Estatus:"> <?php 
  //pintamos de colorores los estados de la actividad
	switch ($row['estatus'])
	{
		case "Pendiente":
		echo '<span class="btn btn-danger btn-xs" disabled="disabled">'.$row["estatus"].'</span>';
		break;
		case "Revisado":
		echo '<span class="btn btn-warning btn-xs" disabled="disabled">'.$row["estatus"].'</span>';
		break;
	}
  ?>
</td>
                                          <td class="text-center" data-label="Fecha Revisión:"><?php echo $row['fecha_revi']; ?></td>

                                        <td class="text-center" data-label="Opciones:">

                                            <a href="./lib/pdf.php?id=<?php echo $row['id_act'] ?>" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                     
                                            
                                                      <!--ver lista de comentarios-->
                                          <a href="admin.php?view=act-diarias-comentario&id=<?php echo $row['id_act']; ?>" 
                                            class="btn btn-sm btn btn-info red-tooltip"data-toggle="tooltip" data-placement="right" id="tooltipex" title="Agregar Comentario"><span class="glyphicon glyphicon-comment"></span></a>
                                        </td>
                            
                                    </tr>
                                    <?php
                                        $ct++;
                                        endwhile; 
                                    ?>
                                </tbody>
                            </table>
                            <?php else: ?>
                                <h2 class="text-center">No hay Ordenes registrados en el sistema</h2>
                            <?php endif; ?>
                        </div>
                        <?php 
                            if($numeropaginas>=1):
                            if(isset($_GET['actividad_diaria'])){
                                $ticketselected=$_GET['actividad_diaria'];
                            }else{
                                $ticketselected="all";
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
                                        <a href="./admin.php?view=act-diarias&ticket=<?php echo $ticketselected; ?>&pagina=<?php echo $pagina-1; ?>" aria-label="Previous">
                                            <span aria-hidden="true">&larr;</span>&nbsp;Anterior
                                        </a>
                                    </li>
                                <?php endif; ?>
                                
                                
                                <?php
                                    for($i=1; $i <= $numeropaginas; $i++ ){
                                        if($pagina == $i){
                                            echo '<li class="active"><a href="./admin.php?view=act-diarias&ticket='.$ticketselected.'&pagina='.$i.'">'.$i.'</a></li>';
                                        }else{
                                            echo '<li><a href="./admin.php?view=act-diarias&ticket='.$ticketselected.'&pagina='.$i.'">'.$i.'</a></li>';
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
                                        <a href="./admin.php?view=act-diarias&ticket=<?php echo $ticketselected; ?>&pagina=<?php echo $pagina+1; ?>" aria-label="Previous">
                                            <span aria-hidden="true">&rarr;</span>&nbsp;Siguiente
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                        <?php endif; ?>
                    </div>
                </div>
              <!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header2">
        <h5 class="modal-title" id="exampleModalLongTitle">PANEL DE ELIMINACION DE REGISTRO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <img src="img/sadminiracion.png">
          <hr>
      ¿Estás seguro de Eliminar este registro?
          <br>
          <hr>
    Esta operación es irreversible
          
      <div class="modal-footer">
        
          <button type="button" class="btn btn-info btn-lg btn" data-dismiss="modal">Salir</button>
                    <form action="" method="POST" style="display: inline-block;">
                                                <input type="hidden" name="id_del" value="<?php echo $row['id']; ?>">
                                                <button type="submit" class="btn btn-danger btn-lg btn" disabled="disabled">Eliminar</button>
                                            </form>

        
      </div>
    </div>
  </div>
</div>
                
            </div> </div><!--container principal-->
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
    
<?php
}
?>   <script type="text/javascript">
    lightbox.option({
      'resizeDuration': 200,
      'wrapAround': true
    })
</script>

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

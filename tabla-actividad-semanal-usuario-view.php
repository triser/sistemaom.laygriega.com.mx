<?php 
header('Content-Type: text/html; charset=UTF-8'); 
session_start();
include './lib/class_mysql.php';
include './lib/config.php';
if($_SESSION['clave']!="" && isset($_SESSION['id_cliente'])){ $nombre_user= $_SESSION['email']; $id_clien= $_SESSION['id_cliente'];?>
<?php
	if(isset($_POST['id_edit']) && isset($_POST['descripcion'])){

		$id_edit= MysqlQuery::RequestPost('id_edit');
        $descripcion_edit= MysqlQuery::RequestPost('descripcion');



		if(MysqlQuery::Actualizar("actividad_semanal", "descripcion='$descripcion_edit'", "id_act='$id_edit'")){

		}
	}     

$sql = Mysql::consulta("SELECT nombre_completo, descripcion, fecha_sem, hora_sem FROM actividad_semanal a INNER JOIN cliente c ON a.id_cliente_sem=c.id_cliente WHERE a.id_cliente_sem='$id_clien'");
	$reg=mysqli_fetch_array($sql, MYSQLI_ASSOC);
?>


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
                <h1 class="animated lightSpeedIn">Reporte de Actividades a Realizar</h1>
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

                /* Todos los actividades GENERAL*/
$num_actividad_all=Mysql::consulta("SELECT nombre_completo, descripcion, fecha_sem, hora_sem FROM actividad_semanal a INNER JOIN cliente c ON a.id_cliente_sem=c.id_cliente WHERE a.id_cliente_sem='$id_clien'");
                $num_total_all=mysqli_num_rows($num_actividad_all);                         
                                        
            ?>
            <div class="container">
                      <div class="row">
                <div class="col-sm-2">
                          <a href="actividad-usuario-view.php" class="btn btn-warning btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Actividad Diaria</a>
            </div>
                   <div class="col-sm-2">
                   <a href="tabla-actividad-semanal-usuario-view.php" class="btn btn-warning btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Actividad Semanal</a>
            </div>
                   <div class="col-sm-2">
                   <a href="./admin.php?view=actividades-general" class="btn btn-warning btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Actividad Mensual</a>
            </div>
                   <div class="col-sm-2">
                   <a href="./admin.php?view=actividades-general" class="btn btn-warning btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Actividad Trimestral</a>
            </div>
                   <div class="col-sm-2">
                   <a href="./admin.php?view=actividades-general" class="btn btn-warning btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Actividad Anual</a>
            </div>
                   <div class="col-sm-2">
                   <a href="./admin.php?view=actividades-general" class="btn btn-warning btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Actividad x Periodo</a>
            </div>
          </div>
        </div>
  <br>
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <ul class="nav">
                            <li><a href="./actividad-usuario-view.php?ticket=all"><i class="fa fa-list"></i>&nbsp;&nbsp;Todas las Actividades&nbsp;&nbsp;<span class="label label-primary"><?php echo $num_total_all; ?></span></a></li>
                            
                        </ul>
                         </div>
                    <div class="col-md-3">
                        </div>
                     <div class="col-md-2">
                        </div>
                    <div class="col-md-2">
                        </div>
                          <div class="col-md-2">
                            <ul class="nav">
                <a type="button" class="btn btn-primary"  href="./index.php?view=actividad-diaria"><i class="glyphicon glyphicon-plus"></i>&nbsp;&nbsp;Elaborar Actividad&nbsp;&nbsp;</a>
                                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#user-id-2">Editar</button>
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

                                
                                if(isset($_GET['actividad_semanal'])){
                                    if($_GET['actividad_semanal']=="all"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM actividad_semanal a INNER JOIN cliente c ON a.id_cliente_sem=c.id_cliente WHERE a.id_cliente_sem='$id_clien' LIMIT $inicio, $regpagina";
                         
                                    }else{
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM actividad_semanal a INNER JOIN cliente c ON a.id_cliente_sem=c.id_cliente WHERE a.id_cliente_sem='$id_clien' LIMIT $inicio, $regpagina";
                                    }
                                }else{
                                    $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM actividad_semanal a INNER JOIN cliente c ON a.id_cliente_sem=c.id_cliente WHERE a.id_cliente_sem='$id_clien' LIMIT $inicio, $regpagina";
                                }


                                 $selactividad=mysqli_query($mysqli,$consulta);

                                $totalregistros = mysqli_query($mysqli,"SELECT FOUND_ROWS()");
                                $totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);
                        
                                $numeropaginas = ceil($totalregistros["FOUND_ROWS()"]/$regpagina);

                                if(mysqli_num_rows($selactividad)>0):
                            ?>
                            <table class="table table-hover table-striped table-bordered points_table_admin2 ">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">#</th>
                                        <th class="text-center" scope="col">Fecha Elaboración</th>
                                        <th class="text-center" scope="col">Hora Elaboración</th>
                                        <th class="text-center" scope="col">descripcion</th>
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
                                        <td class="text-center" data-label="Fecha:"><?php echo $row['fecha_sem']; ?></td>
                                        <td class="text-center" data-label="Hora:"><?php echo $row['hora_sem']; ?></td>
                                        <td class="text-center" data-label="Fecha:"><?php echo $row['descripcion']; ?></td>
                                        <td class="text-center" data-label="Fecha:"><?php echo $row['estatus']; ?></td>
                                          <td class="text-center" data-label="Fecha:"><?php echo $row['fecha_revi']; ?></td>
                                        <td class="text-center" data-label="Hora:"><?php echo $row['hora_revi']; ?></td>

                                        <td class="text-center" data-label="Opciones:">

                                            <a href="./lib/pdf.php?id=<?php echo $row['id_sem']?>" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>

                                               <a href="actividad-descripcion-view.php?id=<?php echo $row['id_sem'] ?>" class="btn btn-sm btn-warning"><i class="fa fa-list" aria-hidden="true"></i></a>
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
                            if(isset($_GET['actividad_semanal'])){
                                $actividadselected=$_GET['actividad_semanal'];
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
        
        
        
        <div id="user-id-2" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="form" action="" method="POST">
            <input type="hidden" name="id_edit" id="id_edit" value="<?php echo $reg['id_sem']?>">
          <div class="form-group">
              <div class="col-sm-6">
            <label for="recipient-name" class="col-form-label">Nombre:</label>
            <input type="text" class="form-control" id="id_nombre" value="<?php echo $reg['nombre_completo']; ?>">
          </div>
          </div>
         <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Actividades Semanales:</label>
                          <div class="col-sm-12">
                            <textarea class="form-control" rows="20"  name="descripcion" id="descripcion" required ><?php echo utf8_encode($reg['descripcion']); ?></textarea>
                          </div>
                        </div>
          
          <br>
          ...
          <br>
          ...
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>&nbsp;Actualizar</button>
      </div>
      
    </div>


  </div>
</div>

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
        </section>
        </body>
        </html>
    
<?php
}
?>   <script type="text/javascript">
    lightbox.option({
      'resizeDuration': 200,
      'wrapAround': true
    })
</script>
   <!-- LIGHTBOX PLUS JQUERY -->
    <script src="./js/lightbox-plus-jquery.min.js"></script>
       <?php include './inc/footer.php'; ?>
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

                /* Todos los tickets*/
$num_actividad_all=Mysql::consulta("SELECT nombre_completo, descripcion, fecha_act, hora_act FROM actividad_diaria INNER JOIN cliente ON actividad_diaria.id_cliente_fk=cliente.id_cliente WHERE actividad_diaria.id_cliente_fk='$id_clien'");
                $num_total_all=mysqli_num_rows($num_actividad_all);
            ?>

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
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM actividad_diaria INNER JOIN cliente ON actividad_diaria.id_cliente_fk=cliente.id_cliente WHERE actividad_diaria.id_cliente_fk='$id_clien' LIMIT $inicio, $regpagina";
                         
                                    }else{
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM actividad_diaria INNER JOIN cliente ON actividad_diaria.id_cliente_fk=cliente.id_cliente WHERE actividad_diaria.id_cliente_fk='$id_clien' LIMIT $inicio, $regpagina";
                                    }
                                }else{
                                    $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM actividad_diaria INNER JOIN cliente ON actividad_diaria.id_cliente_fk=cliente.id_cliente WHERE actividad_diaria.id_cliente_fk='$id_clien' LIMIT $inicio, $regpagina";
                                }


                                 $selactividad=mysqli_query($mysqli,$consulta);

                                $totalregistros = mysqli_query($mysqli,"SELECT FOUND_ROWS()");
                                $totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);
                        
                                $numeropaginas = ceil($totalregistros["FOUND_ROWS()"]/$regpagina);

                                if(mysqli_num_rows($selactividad)>0):
                            ?>
                            <table class="table table-hover table-striped table-bordered points_table_admin ">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">#</th>
                                        <th class="text-center" scope="col">Fecha Elaboración</th>
                                        <th class="text-center" scope="col">Hora Elaboración</th>
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
                                        <td class="text-center" data-label="Fecha:"><?php echo $row['estatus']; ?></td>
                                          <td class="text-center" data-label="Fecha:"><?php echo $row['fecha_revi']; ?></td>
                                        <td class="text-center" data-label="Hora:"><?php echo $row['hora_revi']; ?></td>

                                        <td class="text-center" data-label="Opciones:">

                                            <a href="./lib/pdf.php?id=<?php echo $row['id'] ?>" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>

                                               <a href="detalleticket.php?id=<?php echo $row['id'] ?>" class="btn btn-sm btn-warning"><i class="fa fa-list" aria-hidden="true"></i></a>
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
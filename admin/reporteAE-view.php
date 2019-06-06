<?php if( $_SESSION['nombre']!="" && $_SESSION['clave']!="" && $_SESSION['tipo']=="admin"){ ?>
        <div class="container">
          <div class="row">
            <div class="col-sm-2">
              <center><img src="./img/msj.png" alt="Image" class="img-responsive animated tada"></center>
            </div>
            <div class="col-sm-10">
              <p class="lead text-info">Bienvenido administrador ING. RUBEN PAREDES SILVA, aqui se muestran todas los Ticket del departamento del Asesor Externo (Intelisis) los cuales podra, modificar, Cancela, imprimir y Consultar</p>
            </div>
          </div>
        </div>
            <?php
                if(isset($_POST['id_del'])){
                    $id = MysqlQuery::RequestPost('id_del');
                    if(MysqlQuery::Eliminar("ticket", "id='$id'")){
                        echo '
                            <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="text-center">TICKET ELIMINADO</h4>
                                <p class="text-center">
                                    El ticket fue eliminado del sistema con exito
                                </p>
                            </div>
                        ';
                    }else{
                        echo '
                            <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                                <p class="text-center">
                                    No hemos podido eliminar el ticket
                                </p>
                            </div>
                        '; 
                    }
                }

                   /* Todos los tickets*/
                $num_ticket_all=Mysql::consulta("SELECT * FROM ticket WHERE area_solicitada ='Asesor externo'"  );
                $num_total_all=mysqli_num_rows($num_ticket_all);
                
                /* Tickets pendientes*/
                $num_ticket_pend=Mysql::consulta(" SELECT * FROM ticket WHERE area_solicitada='Asesor Externo' AND estado_ticket = 'Pendiente'" );
                $num_total_pend=mysqli_num_rows($num_ticket_pend);

                /* Tickets en proceso*/
                $num_ticket_proceso=Mysql::consulta("SELECT * FROM ticket WHERE area_solicitada='Asesor Externo' AND estado_ticket = 'En Proceso'");
                $num_total_proceso=mysqli_num_rows($num_ticket_proceso);

                /* Tickets resueltos*/
                $num_ticket_res=Mysql::consulta("SELECT * FROM ticket WHERE area_solicitada='Asesor Externo' AND estado_ticket = 'Resuelto'");
                $num_total_res=mysqli_num_rows($num_ticket_res);
                
                 /* Tickets Cancelado*/
                $num_ticket_can=Mysql::consulta("SELECT * FROM ticket WHERE area_solicitada='Asesor Externo' AND estado_ticket = 'Cancelado'");
                $num_total_can=mysqli_num_rows($num_ticket_can);
            ?>

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="./admin.php?view=reporteAE&ticket=all"><i class="fa fa-list"></i>&nbsp;&nbsp;Todos los Ticket&nbsp;&nbsp;<span class="label label-primary"><?php echo $num_total_all; ?></span></a></li>
                            <li><a href="./admin.php?view=reporteAE&ticket=pending"><i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;Ticket Pendientes&nbsp;&nbsp;<span class="label label-danger"><?php echo $num_total_pend; ?></span></a></li>
                            <li><a href="./admin.php?view=reporteAE&ticket=process"><i class="fa fa-folder-open"></i>&nbsp;&nbsp;Ticket en proceso&nbsp;&nbsp;<span class="label label-warning"><?php echo $num_total_proceso; ?></span></a></li>
                            <li><a href="./admin.php?view=reporteAE&ticket=resolved"><i class="fa fa-check-square-o"></i>&nbsp;&nbsp;Ticket resueltos&nbsp;&nbsp;<span class="label label-success"><?php echo $num_total_res; ?></span></a></li>
                            <li><a href="./admin.php?view=reporteAE&ticket=cancelled"><i class="fa fa-minus-square"></i>&nbsp;&nbsp;Ticket Cancelados&nbsp;&nbsp;<span class="label label-danger"><?php echo $num_total_can; ?></span></a></li>
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

                                
                                if(isset($_GET['ticket'])){
                                    if($_GET['ticket']=="all"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket WHERE area_solicitada='Asesor Externo' LIMIT $inicio, $regpagina";
                                    }elseif($_GET['ticket']=="pending"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket WHERE area_solicitada='Asesor Externo' AND estado_ticket = 'Pendiente' LIMIT $inicio, $regpagina";
                                    }elseif($_GET['ticket']=="process"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket WHERE area_solicitada='Asesor Externo' AND estado_ticket = 'En Proceso' LIMIT $inicio, $regpagina";
                                    }elseif($_GET['ticket']=="resolved"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket WHERE area_solicitada='Asesor Externo' AND estado_ticket = 'Resuelto' LIMIT $inicio, $regpagina";
                                    }elseif($_GET['ticket']=="cancelled"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket WHERE area_solicitada='Asesor Externo' AND estado_ticket = 'Cancelado' LIMIT $inicio, $regpagina";
                                    }else{
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket ORDER BY id DESC LIMIT $inicio, $regpagina";
                                    }
                                }else{
                                    $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket WHERE area_solicitada='Asesor Externo' LIMIT $inicio, $regpagina";
                                }


                                $selticket=mysqli_query($mysqli,$consulta);

                                $totalregistros = mysqli_query($mysqli,"SELECT FOUND_ROWS()");
                                $totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);
                        
                                $numeropaginas = ceil($totalregistros["FOUND_ROWS()"]/$regpagina);

                                if(mysqli_num_rows($selticket)>0):
                            ?>
                            <table class="table table-hover table-striped table-bordered points_table_admin1">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">#</th>
                                        <th class="text-center" scope="col">F.Apertura</th>
                                        <th class="text-center" scope="col">Folio</th>
                                        <th class="text-center" scope="col">Departamento</th>
                                        <th class="text-center" scope="col">Estado</th>
                                        <th class="text-center" scope="col">Prioridad</th>
                                        <th class="text-center" scope="col">Asignado a</th>
                                        <th class="text-center" scope="col">F.Entrega</th>
                                 
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
                                        <td class="text-center" data-label="F.Apertura:"><?php echo $row['fecha']; ?></td>
                                        <td class="text-center" data-label="Serie:"><?php echo $row['serie']; ?></td>
                                        <td class="text-center" data-label="Area:"><?php echo $row['departamento']; ?></td>
                                        <td class="text-center" data-label="Estado:"><?php echo $row['estado_ticket']; ?></td>
                                        <td class="text-center" data-label="Prioridad:"><?php echo $row['Prioridad']; ?></td>
                                        <td class="text-center" data-label="Solicitado:"><?php echo $row['area_solicitada']; ?></td>
                                        <td class="text-center" data-label="F.Entrega:"><?php echo $row['fechaE']; ?></td>
                                        
                                        <td class="text-center" data-label="Opciones:">
                                            <a href="./lib/pdf.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                                            <a href="admin.php?view=ticketeditAE&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning"  ><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            <form action="" method="POST" style="display: inline-block;">
                                                <input type="hidden" name="id_del" value="<?php echo $row['id']; ?>">
                                                <button type="submit" class="btn btn-sm btn-danger" disabled="disabled"><i class="fa fa-trash-o" aria-hidden="true" ></i></button>
                                            </form>
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
                            if(isset($_GET['ticket'])){
                                $ticketselected=$_GET['ticket'];
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
                                        <a href="./admin.php?view=reporteAE&ticket=<?php echo $ticketselected; ?>&pagina=<?php echo $pagina-1; ?>" aria-label="Previous">
                                            <span aria-hidden="true">&larr;</span>&nbsp;Anterior
                                        </a>
                                    </li>
                                <?php endif; ?>
                                
                                
                                <?php
                                    for($i=1; $i <= $numeropaginas; $i++ ){
                                        if($pagina == $i){
                                            echo '<li class="active"><a href="./admin.php?view=reporteAE&ticket='.$ticketselected.'&pagina='.$i.'">'.$i.'</a></li>';
                                        }else{
                                            echo '<li><a href="./admin.php?view=reporteAE&ticket='.$ticketselected.'&pagina='.$i.'">'.$i.'</a></li>';
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
                                        <a href="./admin.php?view=reporteAE&ticket=<?php echo $ticketselected; ?>&pagina=<?php echo $pagina+1; ?>" aria-label="Previous">
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
    
<?php
}
?>   <script type="text/javascript">
    lightbox.option({
      'resizeDuration': 200,
      'wrapAround': true
    })
    </script>
    <script type="text/javascript">
    $(document).ready(function(){
    $("a").tooltip();
});
</script>
   <!-- LIGHTBOX PLUS JQUERY -->
    <script src="./js/lightbox-plus-jquery.min.js"></script>
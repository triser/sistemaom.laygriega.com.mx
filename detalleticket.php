<?php
header('Content-Type: text/html; charset=UTF-8'); 
session_start();
include './lib/class_mysql.php';
include './lib/config.php';   
	$id = MysqlQuery::RequestGet('id');
	$sql = Mysql::consulta("SELECT * FROM ticket WHERE id= '$id'");
	$reg=mysqli_fetch_array($sql, MYSQLI_ASSOC);

if($_SESSION['tipo']==1){
    session_destroy();
echo "<scrip>alert('saliendo...')</script>";
}

?>
<!DOCTYPE html>
<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=gb18030">
        <title>Panel de Comentarios</title>
        <?php include "./inc/links.php"; ?>        
    </head>
    <body>   
        <?php include "./inc/navbar.php"; ?>
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <div class="page-header">
<<<<<<< HEAD
                <?php if ($_SESSION['tipo']=="admin")
                {
                echo   '<h1 class="animated lightSpeedIn">Panel Administrativo</h1>';
              }
                else {
                  echo   '<h1 class="animated lightSpeedIn">Panel de comentarios</h1>';
                }
                ?>

=======
                <h1 class="animated lightSpeedIn">Panel Comentarios</h1>
>>>>>>> administrator
                <span class="label label-danger">Sistema de Ordenes de Mejora LA Y GRIEGA</span>
                <p class="pull-right text-success">
                  <strong>
                  <span class="glyphicon glyphicon-time"></span>&nbsp;<?php include "./inc/timezone.php"; ?>
                 </strong>
               </p>
              </div>
            </div>
          </div>
            <!-- Example row of columns -->
    <div class="row">
    	<h4 class="blue">
<span class="middle">Detalle de ticket #<?php echo $reg['serie']?> </span>
</h4>
   <div class="profile-user-info">
<div class="profile-info-row">
<div class="profile-info-name">Generado por:</div>
<div class="profile-info-value">
<span><?php echo $reg['nombre_usuario'];?> </span>
</div>
</div>
<div class="profile-info-row">
<div class="profile-info-name">Departamento:</div>
<div class="profile-info-value">
<span><?php echo $reg['departamento']?></span>
</div>
</div>
<div class="profile-info-row">
<div class="profile-info-name">Asunto:</div>
<div class="profile-info-value">
<span><?php echo $reg['asunto']?></span>
</div>
</div>
<div class="profile-info-row">
<div class="profile-info-name">Fecha creación:</div>
<div class="profile-info-value">
<span><?php echo $reg['fecha']?></span>
</div>
</div>
<div class="profile-info-row">
<div class="profile-info-name">Estatus:</div>


<div class="profile-info-value">

	<?php 
	//pintamos de colorores los estados del ticket
	switch ($reg['estado_ticket'])
	{
		case "Resuelto":
		echo '<span style="color:green">'.$reg["estado_ticket"].'</span>';
		break;
		case "Cancelado":
		echo '<span style="color:red">'.$reg["estado_ticket"].'</span>';
		break;
      case "Pendiente":
    echo '<span style="color:orange">'.$reg["estado_ticket"].'</span>';
    break;


	}

	?>

</div>
<div>
	<button type="button" class="btn btn-success" id="btncomentar">Comentar</button>
	<button type="button" class="btn btn-primary" id="btnback">Regresar</button>
	</div>		
	</div>
</div>
</br>
<!--FORMULARIO QUE ENVIA EL COMENTARIO-->
	<form class="form-horizontal" role="form" id="formcomenta" action="detalleticket.php" method="GET">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Comentario</label>
    <div class="col-sm-10">
      <textarea type="text" rows="5" class="form-control" name="comentario" id="comentario" placeholder="Escriba aqui su comentario"></textarea>
      <input type="hidden" name="id" value="<?php echo "$id"?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default" name="envia">Enviar</button>
         <a class="btn btn-danger" id="cancelar">Cancelar</a>
    </div>
  </div>
</form>

	<div>
</div>
    </div>
    
     <div class="container">
               
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive ">
                            <?php 
                                $mysqli = mysqli_connect(SERVER, USER, PASS, BD);
                                mysqli_set_charset($mysqli, "utf8");

                                $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                                $regpagina = 15;
                                $inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;

                                $selusers=mysqli_query($mysqli,"SELECT SQL_CALC_FOUND_ROWS  * FROM detalle_ticket AS tik 
                                	INNER JOIN cliente AS cl ON  tik.id_usuario=cl.id_cliente where id_ticket='$id' LIMIT $inicio, $regpagina");

                                $totalregistros = mysqli_query($mysqli,"SELECT FOUND_ROWS()");
                                $totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);
                        
                                $numeropaginas = ceil($totalregistros["FOUND_ROWS()"]/$regpagina);
                                if(mysqli_num_rows($selusers)>0):
                            ?>
                            <table class="table table-hover table-striped table-bordered table_usuario">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Comentario</th>
                                        <th class="text-center">Comento</th>
                                        <th class="text-center">fecha</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $ct=$inicio+1;
                                        while ($row=mysqli_fetch_array($selusers, MYSQLI_ASSOC)): 
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $ct; ?></td>
                                        <td class="text-center"><?php echo $row['comentario']; ?></td>
                                        <td class="text-center"><?php echo $row['nombre_usuario']; ?></td>
                                        <td class="text-center"><?php echo $row['fecha']; ?></td>                                                       
                                    </tr>
                                    <?php
                                        $ct++;
                                        endwhile; 
                                    ?>
                                </tbody>
                            </table>
                            <?php else: ?>
                                <h2 class="text-center">No hay comentarios </h2>
                            <?php endif; ?>
                        </div>
                        <?php if($numeropaginas>=1): ?>
                        <nav aria-label="Page navigation" class="text-center">
                            <ul class="pagination">
                                <?php if($pagina == 1): ?>
                                    <li class="disabled">
                                        <a aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                <?php else: ?>
                                    <li>
                                        <a href="./admin.php?view=users&pagina=<?php echo $pagina-1; ?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                
                                
                                <?php
                                    for($i=1; $i <= $numeropaginas; $i++ ){
                                        if($pagina == $i){
                                            echo '<li class="active"><a href="./admin.php?view=users&pagina='.$i.'">'.$i.'</a></li>';
                                        }else{
                                            echo '<li><a href="./detalleticket.php?id='.$id.'&pagina='.$i.'">'.$i.'</a></li>';
                                        }
                                    }
                                ?>
                                
                                
                                <?php if($pagina == $numeropaginas): ?>
                                    <li class="disabled">
                                        <a aria-label="Previous">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                <?php else: ?>
                                    <li>
                                        <a href="./admin.php?view=users&pagina=<?php echo $pagina+1; ?>" aria-label="Previous">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        
        </script>
         <?php include './inc/footer.php'; ?>
         <script type="text/javascript">
         	$(document).ready(function(){
         	//ocultamos el formulario
         	$("#formcomenta").hide();
         	$("#btncomentar").click(function(){

         		$("#formcomenta").show();
         	});
         	$("#cancelar").click(function(){

         		$("#formcomenta").hide();
         	});
         	 	$("#btnback").click(function(){

         		history.back(1);
         	});


         });

         </script>
    </body>
    <?php 
    if(isset($_GET['envia'])){
    $comentario=$_GET['comentario'];
    echo $date=date('Y/m/d');
    	if(MysqlQuery::Guardar("detalle_ticket", "id_ticket,id_usuario,comentario,fecha","'$id',1,'$comentario','$date'")){

    			echo '<script>alert("se ha guardado correctamente el comentario")</script>';
    			/*addslashes($email_edit, $asunto_edit, $mensaje_mail, $cabecera);----------Fin codigo numero de ticket*/
      echo '<script>
  location.href="detalleticket.php?id='. $id.'";
  </script>';
          //Preparamos el mensaje de contacto
        $cabeceras = "From:Se ha realizado un comentario al ticket".$reg['serie'].""; //La persona que envia el correo
        $asunto = "Actualizacion de Orden de Mejora"; //El asunto
        $email_to = "".$row['email_cliente']."; , sistemaom@laygriega.com.mx"; //cambiar por tu email
        $mensaje_mail="Estimado usuario ".$name_edit." Su Orden de Mejora esta Resuelto con Fecha: ".$fecha2_edit.".
        \nfolio: ".$serie_edit." 
        \n La solución a su problema es la siguiente:".$solucion_edit;
       
       

          //Enviamos el mensaje y comprobamos el resultado
        if (@mail($email_to, $asunto ,$mensaje_mail ,$cabeceras )) ;
    	
    	}
    }
    ?>
</html>
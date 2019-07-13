<?php
header('Content-Type: text/html; charset=utf-8'); 
session_start();
include './lib/class_mysql.php';
include './lib/config.php';   
	$id = MysqlQuery::RequestGet('id');
	$sql = Mysql::consulta("SELECT * FROM actividad_semanal WHERE id_act= '$id'");
	$reg=mysqli_fetch_array($sql, MYSQLI_ASSOC);

if($_SESSION['tipo']==1){
    session_destroy();
echo "<scrip>alert('saliendo...')</script>";
}

?>
<!DOCTYPE html>
<html>
    <head>
	 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Panel de Comentarios</title>
        <?php include "./inc/links.php"; ?>        
    </head>
    <body>   
        <?php include "./inc/navbar.php"; ?>
        <!--************************************ Page content******************************-->
        <div class="container">
          <div class="row">
            <div class="col-sm-3">
               <center><img src="./img/Edit.png" alt="Image" class="img-responsive animated tada"></center>
            </div>
            <div class="col-sm-9">
                <a href="actividad-usuario-view.php" class="btn btn-primary btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Volver administrar Actividades</a>
            </div>
          </div>
        </div>
          <div class="container">
            <div class="col-sm-12">
                <form class="form-horizontal" role="form" action="" method="POST">
            <input type="hidden" name="id_edit" value="<?php echo $reg['id_']?>">
             <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
            <span class="glyphicon glyphicon-bookmark"></span>&nbsp;&nbsp;Activida Diaria</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                          <div class="col-sm-4">
                          </div>
                            <div class='col-sm-2'>
                                <div class="input-group">
                                       <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input class="form-control" readonly type="text" name="" readonly=""  style="border:f92913; background-color: #fef9e7" value="<?php echo $reg['fecha_sem']?>">
                                </div>
                            </div>
                            <div class='col-sm-2'>
                                <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                    <input class="form-control" readonly type="text" name="" readonly=""  style="border:f92913; background-color: #fef9e7" value="<?php echo $reg['hora_sem']?>">
                                </div>
                            </div>
                       
             
                      
    </div>
                    
                        <div class="form-group">
                          <div class="col-sm-12">
                              <textarea class="form-control" rows="25"  name="descripcion_actividad" readonly style="border:f92913; background-color: #ebf5fb"><?php echo strip_tags (utf8_encode($reg['descripcion'])); ?></textarea>
                          </div>
                        </div>
                    
                    
                           <div class="form-group">
                          <label  class="col-sm-2 control-label">Comentario del Revisor</label>
                          <div class="col-sm-10">
                            <textarea class="form-control" rows="3"  name="comentario_actividad" readonly style="border:f92913; background-color: #d5f5e3"><?php echo utf8_encode($reg['comentario']); ?></textarea>
                          </div>
                        </div>
                </div>
            </div>
        </div>

              
                          
              
                      </form>
            </div><!--col-md-12-->
          </div><!--container-->
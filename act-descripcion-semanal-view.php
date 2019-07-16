<?php
header('Content-Type: text/html; charset=utf-8'); 
session_start();
include './lib/class_mysql.php';
include './lib/config.php';   
	$id = MysqlQuery::RequestGet('id');
	$sql = Mysql::consulta("SELECT * FROM actividad_semanal WHERE id_semanal= '$id'");
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
               <div class="container">
            <div class="row">
            <div class="col-sm-12">
              <div class="page-header">
                <h1 class="animated lightSpeedIn">Actividades Semanales</h1>
                <span class="label label-danger">Sistema MTL LA Y GRIEGA</span>
                <p class="pull-right text-success">
                  <strong>
                  <span class="glyphicon glyphicon-time"></span>&nbsp;<?php include "./inc/timezone.php"; ?>
                 </strong>
               </p>
              </div>
            </div>
          </div>
        </div>
        <!--************************************ Page content******************************-->
        <div class="container">
          <div class="row">
              
            <div class="col-sm-3">
               <center><img src="./img/Edit.png" alt="Image" class="img-responsive animated tada"></center>
            </div>
            <div class="col-sm-9">
                <a href="act-usuario-semanal-view.php" class="btn btn-primary btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Volver administrar Actividades</a>
            </div>
          </div>
        </div>
          <div class="container">
            <div class="col-sm-12">
                <form class="form-horizontal" role="form" action="" method="POST">
            <input type="hidden" name="id_edit" value="<?php echo $reg['id_semanal']?>">
             <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
            <span class="glyphicon glyphicon-bookmark"></span>&nbsp;&nbsp;Consulta de Actividad Semanal</h3>
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
                              <textarea class="form-control" rows="20"  name="descripcion_actividad" readonly style="border:f92913; background-color: #ebf5fb"><?php echo strip_tags (utf8_encode($reg['descrip_sem'])); ?></textarea>
                          </div>
                        </div>
                    
                    
                           <div class="form-group">
                          <label  class="col-sm-2 control-label">Comentario del Revisor</label>
                          <div class="col-sm-10">
                            <textarea class="form-control" rows="3"  name="comentario_actividad" readonly style="border:f92913; background-color: #d5f5e3"><?php echo utf8_encode($reg['comentario_sem']); ?></textarea>
                          </div>
                        </div>
                </div>
            </div>
        </div>

              
                          
              
                      </form>
            </div><!--col-md-12-->
          </div><!--container-->
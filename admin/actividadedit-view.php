<?php
	if(isset($_POST['id_edit']) && isset($_POST['estatus']) && isset($_POST['fecha_revi'])){
		$id_edit= MysqlQuery::RequestPost('id_edit');
		$estado_edit= "Revisado";
		$fecha2_edit=  MysqlQuery::RequestPost('fecha_revi');
        $hra2_edit=  MysqlQuery::RequestPost('hora_revi');

	/*	$cabecera="From: Sistema OT La Y Griega<sistemas2@laygriega.com.mx>";
		$mensaje_mail="Estimado usuario la solución a su problema es la siguiente : ".$solucion_edit;
		$mensaje_mail=wordwrap($mensaje_mail, 70, "\r\n");*/

		if(MysqlQuery::Actualizar("actividad_diaria", "estatus='$estado_edit', fecha_revi='$fecha2_edit', hora_revi='$hra2_edit'", "id_act='$id_edit'")){

	echo '
                 <div class="alert alert-warning alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed;  top: 50%; right:40%; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">Actualización de Actividad</h4>
                    <p class="text-center">
                    La Revisión fue actualizado con exito
                    </p>
                </div>
            ';


		}else{
			echo '
                <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                    <p class="text-center">
                        No hemos podido Actualizar la Actividad
                    </p>
                </div>
            '; 
		}
	}     
	     
	$id = MysqlQuery::RequestGet('id');
	$sql = Mysql::consulta("SELECT * FROM actividad_diaria WHERE id_act= '$id'");
	$reg=mysqli_fetch_array($sql, MYSQLI_ASSOC);



?>


        <!--************************************ Page content******************************-->
        <div class="container">
          <div class="row">
            <div class="col-sm-3">
               <center><img src="./img/Edit.png" alt="Image" class="img-responsive animated tada"></center>
            </div>
            <div class="col-sm-9">
                   <a href="./admin.php?view=actividades-general" class="btn btn-info btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Volver administrar Actividad</a>
            </div>
          </div>
        </div>
          <div class="container">
            <div class="col-sm-12">
                 <form class="form-horizontal" role="form" action="" method="POST">
                		<input type="hidden" name="id_edit" value="<?php echo $reg['id_act']?>">
                              <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
            <span class="glyphicon glyphicon-bookmark"></span>Activida Diaria</h3>
                </div>
                <div class="panel-body">
                  
                            <div class="form-group">
                            <label class="col-sm-2 control-label">Fecha hra de Entrega</label>
                            <div class='col-sm-5'>
                                <div class="input-group">
            <input required aria-required="true" class="form-control" type="text" value="<?php echo $reg['fecha_act']?>" readonly="" style="border:f92913; background-color:#e9f7ef" name="fecha_revi">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                                    <div class='col-sm-5'>
                                <div class="input-group">
    <input required aria-required="true" class="form-control" type="text" value="<?php echo $reg['hora_act']?>" readonly="" style="border:f92913; background-color:#e9f7ef" name="hora_revi">
                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                </div>
                            </div>
                        </div>
                     
                     
                     
                                                      <div class="form-group">
                          <label  class="col-sm-6 control-label">Estatus de Actividad</label>
                         <div class="col-sm-2">
                              <div class='input-group'>
                                                   <p>                       
    <?php switch ($reg['estatus'])
	{
		case "Pendiente":
		echo '<span class="btn btn-danger" disabled="disabled"> <i class="fa fa-info-circle"></i> '.$reg["estatus"].'</span>';
		break;
		case "Revisado":
		echo '<span class="btn btn-warning" disabled="disabled"><i class="fa fa-info-circle"></i> '.$reg["estatus"].'</span>';
		break;
	}
  ?></p>
                              </div>
                          </div>
                        </div>
       
                                   <div class="form-group">
                          <div class="col-sm-12">
                              <textarea class="form-control" rows="25"  name="descripcion_actividad" readonly style="border:f92913; background-color: #ebf5fb"><?php echo strip_tags (utf8_encode($reg['descripcion'])); ?></textarea>
                          </div>
                        </div>
                    
                    
                          </div>
            </div>
        </div>

          <div class="form-group">
                            <label class="col-sm-2 control-label">Fecha de revisión</label>
                            <div class='col-sm-2'>
                                <div class="input-group">
            <input required aria-required="true" class="form-control" type="text" value="<?php echo utf8_encode(strftime("%Y-%m-%d")) ?>" readonly="" style="border:f92913; background-color:#e9f7ef" name="fecha2_act">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
               <label class="col-sm-2 control-label">hora de revisión</label>
                                    <div class='col-sm-2'>
                                <div class="input-group">
    <input required aria-required="true" class="form-control" type="text" value="<?php date_default_timezone_set('America/Mexico_city'); echo date("h:i:s A");?>" readonly="" style="border:f92913; background-color:#e9f7ef" name="hora_act">
                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                </div>
                            </div>
              <label  class="col-sm-2 control-label">Estatus de Actividad</label>
              
                         <div class="col-sm-2">
                    <p>                       
    <?php switch ($reg['estatus'])
	{
		case "Pendiente":
		echo '<span class="btn btn-danger" disabled="disabled"> <i class="fa fa-info-circle"></i> '.$reg["estatus"].'</span>';
		break;
		case "Revisado":
		echo '<span class="btn btn-warning" disabled="disabled"><i class="fa fa-info-circle"></i> '.$reg["estatus"].'</span>';
		break;
	}
  ?></p>

                          </div>
              
                        </div>

                    <br>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-9 text-center">
                             <button type="submit" class="btn btn-success"><i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>&nbsp;Actualizar a Revisado</button>
                              <a href="./admin.php?view=reporteCS" class="btn btn-info "><i class="fa fa-reply"></i>&nbsp;&nbsp;Volver</a>
                          </div>
                        </div>
                      </form>
            </div><!--col-md-12-->
        
          </div><!--container-->

<?php
	if(isset($_POST['id']) && isset($_POST['descripcion_actividad'])){
		$descripcion_edit=  MysqlQuery::RequestPost('descripcion_actividad');
	/*	$cabecera="From: Sistema OT La Y Griega<sistemas2@laygriega.com.mx>";
		$mensaje_mail="Estimado usuario la solución a su problema es la siguiente : ".$descripcion_edit;
		$mensaje_mail=wordwrap($mensaje_mail, 70, "\r\n");*/

		if(MysqlQuery::Actualizar("actividad_diaria", "descripcion='$descripcion_edit'")){

	
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
                <a href="./admin.php?view=actividades-general" class="btn btn-primary btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Volver administrar Actividad</a>
            </div>
          </div>
        </div>
          <div class="container">
            <div class="col-sm-12">
                <form class="form-horizontal" role="form" action="" method="POST">
                		<input type="hidden" name="id_edit" value="<?php echo $reg['id_act']?>">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Fecha Hrs de Solicitud</label>
                            <div class='col-sm-5'>
                                <div class="input-group">
                                    <input class="form-control" readonly type="text" name="" readonly=""  style="border:f92913; background-color: #fef9e7" value="<?php echo $reg['fecha_act']?>">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                            <div class='col-sm-5'>
                                <div class="input-group">
                                    <input class="form-control" readonly type="text" name="" readonly=""  style="border:f92913; background-color: #fef9e7" value="<?php echo $reg['hora_act']?>">
                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                          <label  class="col-sm-2 control-label">Nombre</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                                  <input type="text" readonly class="form-control"  name="name_ticket" readonly="" style="border:f92913; background-color: #ebf5fb
" value="<?php echo utf8_encode($_SESSION['nombre_completo']); ?>">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                              </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label  class="col-sm-2 control-label">Mensaje</label>
                          <div class="col-sm-10">
                              <textarea class="form-control" rows="25"  name="descripcion_actividad" readonly style="border:f92913; background-color:#ffffff"><?php echo strip_tags (utf8_encode($reg['descripcion'])); ?></textarea>
                          </div>
                        </div>
                            <div class="form-group">
                            <label class="col-sm-2 control-label">Fecha hra de Entrega</label>
                            <div class='col-sm-5'>
                                <div class="input-group">
            <input required aria-required="true" class="form-control" type="text" value="<?php echo utf8_encode(strftime("%Y-%m-%d")) ?>" readonly="" style="border:f92913; background-color:#e9f7ef" name="fecha2_ticket">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                                    <div class='col-sm-5'>
                                <div class="input-group">
    <input required aria-required="true" class="form-control" type="text" value="<?php date_default_timezone_set('America/Mexico_city'); echo date("h:i:s A");?>" readonly="" style="border:f92913; background-color:#e9f7ef" name="hra2_ticket">
                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                </div>
                            </div>
                        </div>
                             <div class="row">
                            <div class="col-sm-offset-5">
                            <div class="btn-group btn-group-vertical" data-toggle="buttons">
                            <label class="btn active">
                             <input type="radio" name="optionsRadios" value="option1" checked><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i><span>&nbsp;&nbsp;No enviar solución al email del usuario</span>
                            </label>
                         <label class="btn">
                         <input type="radio" name="optionsRadios" value="option2"><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i><span>&nbsp;&nbsp;Enviar solución al email del usuario</span>
                        </label>
                         </div>
                        </div>
                         </div>
                    <br>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-9 text-center">
                             <button type="submit" class="btn btn-primary"><i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>&nbsp;Actualizar</button>
                              <a href="./admin.php?view=reporteCS" class="btn btn-success"><i class="fa fa-reply"></i>&nbsp;&nbsp;Volver</a>
                          </div>
                        </div>
                      </form>
            </div><!--col-md-12-->
          </div><!--container-->
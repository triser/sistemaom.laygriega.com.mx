<?php

	if(isset($_POST['id_edit'])&& isset($_POST['descripcion_act_sem'])){
		$id_edit= MysqlQuery::RequestPost('id_edit');
        $solucion_edit=  MysqlQuery::RequestPost('descripcion_act_sem');
		$fecha2_edit= date("Y-m-d"); 
        $hra2_edit= date("H:i:s");
        $idA=$_SESSION['id'];

	/*	$cabecera="From: Sistema OT La Y Griega<sistemas2@laygriega.com.mx>";
		$mensaje_mail="Estimado usuario la solución a su problema es la siguiente : ".$solucion_edit;
		$mensaje_mail=wordwrap($mensaje_mail, 70, "\r\n");*/

		if(MysqlQuery::Actualizar("actividad_semanal", "fecha_revi_sem='$fecha2_edit', hora_revi_sem='$hra2_edit', descrip_sem='$solucion_edit', id_admin_fks='$idA'", "id_semanal='$id_edit'")){

	echo '
                 <div class="alert alert-warning alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed;  top: 50%; right:40%; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">Actualización de Actividad Semanal</h4>
                    <p class="text-center">
                    La ctualizacion fue con exito
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
	$sql = Mysql::consulta("SELECT * FROM actividad_semanal WHERE id_semanal= '$id'");
	$reg=mysqli_fetch_array($sql, MYSQLI_ASSOC);



?>


        <!--************************************ Page content******************************-->
        <div class="container">
          <div class="row">
            <div class="col-sm-3">
               <center><img src="./img/Edit.png" alt="Image" class="img-responsive animated tada"></center>
            </div>
            <div class="col-sm-9">
                   <a href="./admin.php?view=act-semanales" class="btn btn-info btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Volver administrar Actividad</a>
            </div>
          </div>
</div>
  <br>
            <div class="container">
                      <div class="row">
             <div class="col-sm-2">
                   <a href="./admin.php?view=act-diarias" class="btn btn-info btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Actividad Diaria</a>
            </div>
                   <div class="col-sm-2">
                   <a href="./admin.php?view=act-semanales" class="btn btn-info btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Actividad Semanal</a>
            </div>
                   <div class="col-sm-2">
                   <a href="./admin.php?view=actividades-general" class="btn btn-info btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Actividad Mensual</a>
            </div>
                   <div class="col-sm-2">
                   <a href="./admin.php?view=actividades-general" class="btn btn-info btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Actividad Trimestral</a>
            </div>
                   <div class="col-sm-2">
                   <a href="./admin.php?view=actividades-general" class="btn btn-info btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Actividad Anual</a>
            </div>
                   <div class="col-sm-2">
                   <a href="./admin.php?view=actividades-general" class="btn btn-info btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Actividad x Periodo</a>
            </div>
          </div>
        </div>
  <br>
          <div class="container">
            <div class="col-sm-12">
                 <form class="form-horizontal" role="form" action="" method="POST">
                		<input type="hidden" name="id_edit" value="<?php echo $reg['id_semanal']?>">
                              <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
            <span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp;Editar Actividades Semanales</h3>
                </div>
                <div class="panel-body">
                            <div class="form-group">
                            <label class="col-sm-2 control-label">Fecha Elaboracion:</label>
                            <div class='col-sm-4'>
                                <div class="input-group">
            <input required aria-required="true" class="form-control" type="text" value="<?php echo $reg['fecha_sem']?>" readonly="" style="border:f92913; background-color:#e9f7ef" name="fecha2_act">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                                    <div class='col-sm-5'>
                                        <label class="col-sm-2 control-label">Hora:</label>
                                <div class="input-group">
    <input required aria-required="true" class="form-control" type="text" value="<?php echo $reg['hora_sem']?>" readonly="" style="border:f92913; background-color:#e9f7ef" name="hora_act">
                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                </div>
                            </div>
                        </div>
                         <div class="form-group">
                          <label  class="col-sm-6 control-label">Estatus de Actividad</label>
                         <div class="col-sm-2">
                              <div class='input-group'>
                                                   <p>                       
    <?php switch ($reg['estatus_sem'])
	{
		case "Pendiente":
		echo '<span class="btn btn-danger" disabled="disabled"> <i class="fa fa-info-circle"></i> '.$reg["estatus_sem"].'</span>';
		break;
		case "Revisado":
		echo '<span class="btn btn-warning" disabled="disabled"><i class="fa fa-info-circle"></i> '.$reg["estatus_sem"].'</span>';
		break;
	}
  ?></p>
                              </div>
                          </div>
                        </div>
                           <div class="form-group">
                          <label  class="col-sm-7 control-label">Editar Actividad Semanal</label>
                          <div class="col-sm-12">
                            <textarea class="form-control" rows="20"  name="descripcion_act_sem" ><?php echo utf8_encode($reg['descrip_sem']); ?></textarea>
                          </div>
                        </div>
                    
                    
                          </div>
            </div>
        </div>

          <div class="form-group">
                            <label class="col-sm-3 control-label">Fecha de Ultima Actualizacion</label>
                            <div class='col-sm-3'>
                                <div class="input-group">
            <input required aria-required="true" class="form-control" type="text" value="<?php echo $reg['f_actualizacion']?>" readonly="" style="border:f92913; background-color:#e9f7ef" name="">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
              <label  class="col-sm-3 control-label">Estatus de Actividad</label>
              
                         <div class="col-sm-3">
                    <p>                       
    <?php switch ($reg['estatus_sem'])
	{
		case "Pendiente":
		echo '<span class="btn btn-danger" disabled="disabled"> <i class="fa fa-info-circle"></i> '.$reg["estatus_sem"].'</span>';
		break;
		case "Revisado":
		echo '<span class="btn btn-warning" disabled="disabled"><i class="fa fa-info-circle"></i> '.$reg["estatus_sem"].'</span>';
		break;
	}
  ?></p>

                          </div>
              
                        </div>

                    <br>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-9 text-center">
                             <button type="submit" class="btn btn-success"><i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>&nbsp;Actualizar</button>
                              <a href="./admin.php?view=act-semanales" class="btn btn-info "><i class="fa fa-reply"></i>&nbsp;&nbsp;Volver</a>
                          </div>
                        </div>
                      </form>
            </div><!--col-md-12-->
        
          </div><!--container-->

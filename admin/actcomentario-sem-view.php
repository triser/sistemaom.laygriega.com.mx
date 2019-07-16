<?php

	if(isset($_POST['id_edit'])&& isset($_POST['comentario_actividad'])){
		$id_edit= MysqlQuery::RequestPost('id_edit');
        $solucion_edit=  MysqlQuery::RequestPost('comentario_actividad');
		$estado_edit= "Revisado";
		$fecha2_edit= date("Y-m-d"); 
        $hra2_edit= date("H:i:s");
        $idA=$_SESSION['id'];

	/*	$cabecera="From: Sistema OT La Y Griega<sistemas2@laygriega.com.mx>";
		$mensaje_mail="Estimado usuario la solución a su problema es la siguiente : ".$solucion_edit;
		$mensaje_mail=wordwrap($mensaje_mail, 70, "\r\n");*/

		if(MysqlQuery::Actualizar("actividad_semanal", "estatus_sem='$estado_edit', fecha_revi_sem='$fecha2_edit', hora_revi_sem='$hra2_edit', comentario_sem='$solucion_edit', id_admin_fks='$idA'", "id_semanal='$id_edit'")){

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
	$sql = Mysql::consulta("SELECT * FROM actividad_semanal WHERE id_semanal= '$id'");
	$reg=mysqli_fetch_array($sql, MYSQLI_ASSOC);
?>
<?php
                   /* Todos las actividade diarias*/
                $num_ticket_all=Mysql::consulta("SELECT * FROM actividad_diaria"  );
                $num_total_all=mysqli_num_rows($num_ticket_all);
                
               /* Todos las actividade semanales*/
                $num_ticket_pend=Mysql::consulta("SELECT * FROM actividad_semanal" );
                $num_total_pend=mysqli_num_rows($num_ticket_pend);
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
            <div class="container">
           <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="./admin.php?view=act-diarias"><i class="fa fa-folder-o"></i>&nbsp;&nbsp;Act Diaria&nbsp;&nbsp;<span class="label label-success"><?php echo $num_total_all; ?></span></a></li>
                            <li><a href="./admin.php?view=act-semanales"><i class="fa fa-folder-o"></i>&nbsp;&nbsp;Act Semanal&nbsp;&nbsp;<span class="label label-success"><?php echo $num_total_pend; ?></span></a></li>
                            <li><a href=""><i class="fa fa-folder-o"></i>&nbsp;&nbsp;Act Mensual&nbsp;&nbsp;<span class="label label-warning"></span></a></li>
                            <li><a href=""><i class="fa fa-folder-o"></i>&nbsp;&nbsp;Act Trimestral&nbsp;&nbsp;<span class="label label-success"></span></a></li>
                            <li><a href=""><i class="fa fa-folder-o"></i>&nbsp;&nbsp;Act Anual&nbsp;&nbsp;<span class="label label-danger"></span></a></li>
                            <li><a href=""><i class="fa fa-folder-o"></i>&nbsp;&nbsp;Act x Periodo&nbsp;&nbsp;<span class="label label-danger"></span></a></li>
                        </ul>
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
            <span class="glyphicon glyphicon-comment"></span>&nbsp;&nbsp;Agregar Comentario Actividad Semanal</h3>
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
                          <div class="col-sm-12">
                              <textarea class="form-control" rows="20"  name="descripcion_actividad" readonly style="border:f92913; background-color: #ebf5fb"><?php echo strip_tags (utf8_encode($reg['descrip_sem'])); ?></textarea>
                          </div>
                        </div>
                    
                           <div class="form-group">
                          <label  class="col-sm-2 control-label">Comentarios</label>
                          <div class="col-sm-10">
                            <textarea class="form-control" rows="3"  name="comentario_actividad" ><?php echo utf8_encode($reg['comentario_sem']); ?></textarea>
                          </div>
                        </div>
                    
                    
                          </div>
            </div>
        </div>

          <div class="form-group">
                            <label class="col-sm-2 control-label">Fecha de revisión</label>
                            <div class='col-sm-2'>
                                <div class="input-group">
            <input required aria-required="true" class="form-control" type="text" value="<?php echo $reg['fecha_revi_sem']?>" readonly="" style="border:f92913; background-color:#e9f7ef" name="">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
               <label class="col-sm-2 control-label">hora de revisión</label>
                                    <div class='col-sm-2'>
                                <div class="input-group">
    <input required aria-required="true" class="form-control" type="text" value="<?php echo $reg['hora_revi_sem']?>" readonly="" style="border:f92913; background-color:#e9f7ef" name="">
                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                </div>
                            </div>
              <label  class="col-sm-2 control-label">Estatus de Actividad</label>
              
                         <div class="col-sm-2">
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


<?php 
        if(isset($_SESSION['id_cliente']) && isset($_SESSION['nombre']) && isset($_SESSION['tipo']) && isset($_SESSION['email'])){
        
        if(isset($_POST['fecha_actividad']) && isset($_POST['nombre_act'])){
			
          /*Fin codigo numero de actividad*/
          $idC=$_SESSION['id_cliente'];
          $fecha_actividad=  MysqlQuery::RequestPost('fecha_actividad');
          $hra_actividad=  MysqlQuery::RequestPost('hra_actividad');    
          $descripcion_actividad=  MysqlQuery::RequestPost('descripcion_actividad');
          $estado_actividad="Pendiente";
          $fecha2_revi="";
          $hra2_revi="";
          $id_admin="4";
		
			//Enviamos el mensaje ala Bd
			
if(MysqlQuery::Guardar("actividad_semanal", "id_cliente_sem, descripcion, fecha_sem, hora_sem, estatus, fecha_revi, hora_revi,id_admin_fks","'$idC', '$descripcion_actividad', '$fecha_actividad', '$hra_actividad', '$estado_actividad', '$fecha2_revi', '$hra2_revi', '$id_admin'")){

                
                /*
            ----------Enviar correo con los datos 
            ----------*/
            	 /*Fin codigo numero de actividad*/
                
		  $descripcion_actividad = $_POST['descripcion_actividad'];
		  $fecha_actividad = $_POST['fecha_actividad'];
          $hra_actividad = $_POST['hra_actividad'];
		  $nombre_act = utf8_decode($_POST['nombre_act']);
		 
		  //Preparamos el mensaje de contacto
			
		  $cabeceras = "From: SISTEMA MT"; //La persona que envia el correo
		  $asunto= "Registro de Actividad Diaria"; //El asunto
		  $email_to = "email, sistemaom@laygriega.com.mx"; //cambiar por tu email
		  $mensaje_mail="Hola ".$nombre_act.",Gracias por subir tu Actividad diaria,
		  \n Registrado Con Fecha: ". $fecha_actividad.",  y hora: ". $hra_actividad.",
		  \n Para poder Consultar sus Registros de Actividad Diaria, Visitanos en el siguiente Enlace: http://sistemaom.laygriega.com.mx";

		  //Enviamos el mensaje y comprobamos el resultado
		  if (@mail($email_to, $asunto ,$mensaje_mail ,$cabeceras )) ;
		  
            echo '
                <div class="alert alert-success alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed;  top: 50%; right:40%; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">ACTIVIDAD DIARIA CREADA</h4>
                    <p class="text-center">
                       La Actividad se creado con exito '.$_SESSION['nombre'].'<br>Con Fecha: <strong>'.$fecha_actividad.'</strong> y Hora: <strong>'.$hra_actividad.'</strong>
                    </p>
                </div>
            ';

          }else{
            echo '
                <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                    <p class="text-center">
                        No hemos podido Registrar su Actividad. Por favor intente nuevamente.
                    </p>
                </div>
            ';
          }
        }
        
        
        
?>
            <div class="container">
                      <div class="row">
                <div class="col-sm-2">
                   <a href="actividad-usuario-view.php" class="btn btn-success btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Actividad Diaria</a>
            </div>
                   <div class="col-sm-2">
                   <a href="./index.php?view=actividad-semanal" class="btn btn-success btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Actividad Semanal</a>
            </div>
                   <div class="col-sm-2">
                   <a href="" class="btn btn-success btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Actividad Mensual</a>
            </div>
                   <div class="col-sm-2">
                   <a href="" class="btn btn-success btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Actividad Trimestral</a>
            </div>
                   <div class="col-sm-2">
                   <a href="" class="btn btn-success btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Actividad Anual</a>
            </div>
                   <div class="col-sm-2">
                   <a href="" class="btn btn-success btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Actividad x Periodo</a>
            </div>
          </div>
        </div>
  <br>
       

        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title text-center"><strong><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;&nbsp;Panel de Actividad Semanal</strong></h3>
                </div>
                <div class="panel-body">
                  <div class="row">
                      <div class="col-sm-12 text-center">
                      <p class="text-primary text-justify">Por favor llenar el formulario con sus <strong>Actidades Semanal.</strong>la informacion será enviado directamente a su dirección de correo electronico proporcionada en este formulario.</p>
                        <br> 
                    </div>
                      
                      
                    <div class="col-sm-12">
                      <form class="form-horizontal" role="form" action="" method="POST" enctype="multipart/form-data">
                          <fieldset>
                        <div class="form-group">
              <label  class="col-sm-1 control-label">Nombre:</label>
                              <div class="col-sm-4">
                                   <div class='input-group'>
                                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" name="nombre_act" readonly="" value="<?php echo utf8_encode($_SESSION['nombre_completo']); ?>" readonly="" style="border:f92913; background-color:  #fdebd0 ">
                              </div>
                          </div>
                            <label class="col-sm-1 control-label">Fecha:</label>
                            <div class="col-sm-2">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input class="form-control" type="text" name="fecha_actividad" value="<?php echo utf8_encode(strftime("%Y-%m-%d")) ?>" readonly="" style="border:f92913; background-color:#fdebd0">
                                </div>
                            </div>
                             <label class="col-sm-1 control-label">Hora:</label>
                             <div class="col-sm-2">
                                <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                <input class="form-control color-" type="text" name="hra_actividad" value="<?php date_default_timezone_set('America/Mexico_city'); echo date("h:i:s A");?>" readonly="" style="border:f92913; background-color:  #fdebd0">
                                </div>
                            </div>
                        </div>
                    <div class="row">                           
                    <div class="col-md-3">
                        <ul class="nav">
                            <li><a><i class="fa fa-list"></i>&nbsp;&nbsp;Describir tus Actividades</a><span class="label label-success"></span></li>
                        </ul>
                         </div>
                          <div class="col-md-4">
                            <ul class="nav">
                <a type="button" class="btn btn-success"  href=""><i class="fa fa-search"></i>&nbsp;&nbsp;Subir Actividades&nbsp;&nbsp;</a>
                        </ul>
                    </div>
                                    <div class="col-md-4">
                            <ul class="nav">
                <a type="button" class="btn btn-success"  href="" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-search"></i>&nbsp;&nbsp;Editar Actividad Semanal&nbsp;&nbsp;</a>
                                <a href="index.php?view=actividad-semanal&id=<?php echo $reg['id_sem']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>


                        </ul>
                    </div>
                </div>
                <br>

                                 <div class="form-group">
                          <div class="col-sm-12">
                            <textarea class="form-control" rows="23"  placeholder="No se encontro ninguna actividad"  pattern="[ A-Za-zäÄëËïÏöÖüÜáéíóúáéíóúÁÉÍÓÚÂÊÎÔÛâêîôûàèìòùÀÈÌÒÙ.-]+{1,400}" name="descripcion_actividad" required="" value="<?php echo $reg['descripcion']; ?>"></textarea>
                          </div>
                        </div>    
                              
                              
                          <div class="col-sm-offset-5">
                            <button  name="guardar" type="submit" class="btn btn-danger"><i class="fa fa-cloud-upload"></i>&nbsp;&nbsp;Subir Actividad</button>
                          </div>
                    
                             </fieldset> 
                      </form>
                   
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>        </div>
  
<?php
}else{
?>


    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <img src="./img/SadTux.png" alt="Image" class="img-responsive"/><br>
                <img src="./img/Stop.png" alt="Image" class="img-responsive"/>
            </div>
            <div class="col-sm-7 text-center">
                <h1 class="text-danger">Lo sentimos esta página es solamente para usuarios registrados en el Sistema OM</h1>
                <h3 class="text-info">Inicia sesión para poder acceder</h3>
            </div>
            <div class="col-sm-1">&nbsp;</div>
        </div>
    </div>
<?php
}
?>

<script type="text/javascript">

$(document).ready(function () {
 
window.setTimeout(function() {
    $(".alert").fadeTo(800, 0).slideUp(800, function(){
        $(this).remove(); 
    });
}, 2500);
 
});
</script>
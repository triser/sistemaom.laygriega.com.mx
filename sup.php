<?php
header('Content-Type: text/html; charset=UTF-8'); 
session_start();
include './lib/class_mysql.php';
include './lib/config.php';
if(isset($_POST['nombre_login']) && isset($_POST['contrasena_login'])){
        include "./process/login.php";

    }
     
?>

<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
        <title>Sistema OM</title>
        <?php include "./inc/links.php"; ?>        
    </head>
    <body>   
        <?php include "./inc/navbar.php"; ?>
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <div class="page-header">
                <h1 class="animated lightSpeedIn">Sistema de Ordenes de Mejora<small> LA Y GRIEGA</small></h1>
                <span class="label label-danger"> la Y Griega S.A de C.V.</span>
                <p class="pull-right text-success">
                  <strong>
                    <!--<span class="glyphicon glyphicon-time"></span>&nbsp;<?php //include "./inc/timezone.php"; ?>-->
                 </strong>
               </p>
              </div>
            </div>
          </div>
        </div>  
        <?php
            if(isset($_GET['view'])){
                $content=$_GET['view'];
                $WhiteList=["index","soporte","ticket","ticketcon","registro","configuracion"];
                if(in_array($content, $WhiteList) && is_file("./user/".$content."-view.php")){
                    include "./user/".$content."-view.php";
                }else{
        ?>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4">
                            <img src="img/SadTux.png" alt="Image" class="img-responsive"/><br>
                            <img src="./img/Stop.png" alt="Image" class="img-responsive"/>
                            
                        </div>
                        <div class="col-sm-7 text-center">
                            <h1 class="text-danger">Lo sentimos, la opción que ha seleccionado no se encuentra disponible</h1>
                            <h3 class="text-info">Por favor intente nuevamente</h3>
                        </div>
                        <div class="col-sm-1">&nbsp;</div>
                    </div>
                </div>     
               
          <?php
                }
            }else{
                //include "./user/index-view.php";
                ?>
              
  <div class="container">
                    <div class="row" style="margin-left:30%">            
                        <div class="col-sm-7" style="
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                <div class="avatar">
                    <center><img src="img/lay.png" class="img-responsive" alt="Image"></center>
                </div>              
                <center><h4 class="modal-title">Inicio de Sesion de Ordenes de Mejora</h4></center> 

                <form action="" method="POST">
                 <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input type="text" class="form-control" name="nombre_login" placeholder="Ingrese su nombre de Usuario" required=""/>    
                </div>
                <br />
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input type="password" class="form-control" name="contrasena_login" placeholder="Ingrese su contraseña" required=""/>   
                </div>
                <br />
               
              
                    <input type="hidden" name="optionsRadios" id="radio3" value="admin">
                    <label for="radio3">
           
                 </label>
      
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block login-btn"><i class="glyphicon glyphicon-log-in"></i>&nbsp; &nbsp; Iniciar sesión</button>
                    
            </div>

        </form>
    </div>
</div>
</div>
</div>
<br>

            
        

                <?php
            }
        ?>

        
      <?php include './inc/footer.php'; ?>

    </body>
</html>

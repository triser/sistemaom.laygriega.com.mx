<?php
session_start();
include './lib/class_mysql.php';
include './lib/config.php';
header('Content-Type: text/html; charset=UTF-8'); 
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
                <span class="label label-danger">Distribuidora de Abarrotes la Y Griega S.A de C.V.</span>
                <p class="pull-right text-success">
                  <strong>
                    <span class="glyphicon glyphicon-time"></span>&nbsp;<?php include "./inc/timezone.php"; ?>
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
                            <h1 class="text-danger">Lo sentimos, la opci贸n que ha seleccionado no se encuentra disponible</h1>
                            <h3 class="text-info">Por favor intente nuevamente</h3>
                        </div>
                        <div class="col-sm-1">&nbsp;</div>
                    </div>
                </div>     
               
          <?php
                }
            }else{
                include "./user/index-view.php";
            }
        ?>

        
      <?php include './inc/footer.php'; ?>

    </body>
</html>

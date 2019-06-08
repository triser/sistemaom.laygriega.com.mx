<?php 
session_start();
include '../lib/class_mysql.php';
include '../lib/config.php';
    if(isset($_GET['envia'])){
    $comentario=$_GET['comentario'];
    $id=$_GET['id'];
    echo $date=date('Y/m/d');
      if(MysqlQuery::Guardar("detalle_ticket", "id_ticket,id_usuario,comentario,fecha","'$id',1,'$comentario','$date'")){

          echo '<script>alert("Su comentario se guardo correctamente")</script>';
          /*addslashes($email_edit, $asunto_edit, $mensaje_mail, $cabecera);----------Fin codigo numero de ticket*/
      echo '<script>
  history.back(1);
  </script>';
        
      }
    }
    ?>
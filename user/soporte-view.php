<div class="container">
  <div class="row well">
    <div class="col-sm-3">
      <img src="img/tux_repair.png" class="img-responsive" alt="Image">
    </div>
    <div class="col-sm-9 lead">
      <h2 class="text-info">Bienvenido al Sistema de OM LA Y GRIEGA</h2>
      <p>Es muy facil de usar, si usted tiene una solicitud o algun requerimiento del sistema nos puede enviar una Nueva orden de Mejora, nosotros lo respondemos y solucionaremos su problema. Si ya nos ha enviado una Orden puede consultar el estado de este mediante su <strong>Orden ID</strong>.</p>
    </div>
  </div><!--fin row 1-->

  <div class="row">
    <div class="col-sm-6">
      <div class="panel panel-info">
        <div class="panel-heading text-center"><i class="fa fa-file-text"></i>&nbsp;<strong>Solicitar Orden</strong></div>
        <div class="panel-body text-center">
          <img src="./img/new_ticket.png" alt="">
          <h4>Abrir una nueva Orden</h4>
          <p class="text-justify">Si tienes un problema con cualquiera de nuestras Ordenes reportalo creando un nueva Orden y te ayudaremos a solucionarlo.Si desea actualizar una peticion ya realizada utiliza el formulario de la derecha <em>Comprobar estado de Orden</em>, solamente los <strong>usuarios registrados</strong> pueden abrir un nueva Orden de Mejora.</p>
          <p>Para abrir una nueva <strong>orden</strong> has click en el siguiente boton</p>
          <a type="button" class="btn btn-info" href="./index.php?view=ticket">Nueva Orden</a>
        </div>
      </div>
    </div><!--fin col-md-6-->
    
    <div class="col-sm-6">
      <div class="panel panel-danger">
        <div class="panel-heading text-center"><i class="fa fa-link"></i>&nbsp;<strong>Comprobar estado de Orden</strong></div>
        <div class="panel-body text-center">
          <img src="./img/old_ticket.png" alt="">
          <h4>Consultar estado de Orden</h4>
          <form class="form-horizontal" role="form" method="GET" action="./index.php">
            <input type="hidden" name="view" value="ticketcon">
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
                  <input type="email" class="form-control" name="email_consul" placeholder="Email" required="">
              </div>
            </div>
            <div class="form-group">
              <label  class="col-sm-2 control-label">Orden ID</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" name="id_consul" placeholder="ID Orden" required="">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">Consultar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div><!--fin col-md-6-->
  </div><!--fin row 2-->
</div><!--fin container-->
$(document).ready(function(){
    // Cargamos los departamentos
    var asignado = "<option value='' disabled selected>Selecciona el departamento asignado</option>";

    for (var key in actividades) {
        if (actividades.hasOwnProperty(key)) {
            asignado = asignado + "<option value='" + key + "'>" + key + "</option>";
        }
    }

    $('#asignado').html(asignado);

    // Al detectar
    $( "#asignado" ).change(function() {
        var html = "";
        $( "#asignado option:selected" ).each(function() {
            var asignado = $(this).text();
            if(asignado != "Selecciona el departamento asignado"){
                var actividad = actividades[asignado];
                for (var i = 0; i < actividad.length; i++)
                    html += "<option value='" + actividad[i] + "'>" + actividad[i] + "</option>";
            }
        });
        $('#actividad').html(html);
        $('select').material_select('update');
    })
    .trigger( "change" );
});


var actividades = {
                "Accesor Externo (Ing. Ruben Paredes Silva)":[
                   "Capacitacion","Control de Acceso","Desarrollo","Ecenario Contable","Mejora","Migracion","Reportes"
                    ],
                "Hardware Y Software (Ing. Jose de Jesus Villatoro)":[
                     "Mantenimiento","sistemas","Soporte","Reporte","Instalacion"
                    ],
                "Comunicacion y Seguridad TI (Lic. Francisco Javier Ruiz Utrilla)":[
                    "Impresoras","Toner","Soporte","Antivirus"
                    ],
                
            }
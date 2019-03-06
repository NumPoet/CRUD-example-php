var table;
var table2;
$(document).ready(function() {
   table= $('#table_id').DataTable({
    "language": {
        "sProcessing":    "Procesando...",
        "sLengthMenu":    "Mostrar _MENU_ registros",
        "sZeroRecords":   "No se encontraron resultados",
        "sEmptyTable":    "Ningún dato disponible en esta tabla",
        "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":   "",
        "sSearch":        "Buscar:",
        "sUrl":           "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":    "Último",
            "sNext":    "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        },  
    },
  "dom": 'Brtip',
  "bJQueryUI": true,
 
 
  //"dom": 'lBtipr'
 /* buttons: [
            {
                tag:"button",
                className:"btn btn-primary"
                
            }
        ]
    ,
    "bFilter": false,
    "bLengthChange": false*/
});
});


 
// #myInput is a <input type="text"> element
$('#myInputTextField').on( 'keyup', function () {
    table.search( this.value ).draw();
} );

function agregaDato(id){
	var id= id;
	$.ajax({
		url:"http://localhost/sistema/puestos/ver",
		type:'GET',
		dataType:"json",
		data:{id: id},
		success:function(json){
			$("#modal_puesto").val(json.PUESTO);
			$("#modal_jefe").val(json.JEFE);
			$("#modal_nivel").val(json.NIVEL);
			$("#modal_tipo").val(json.TIPO);
			$("#verModal").modal('show');
		},error : function(xhr, status) {
        toastr.error('Error al cargar datos', 'Error');
    }
	});
	
}
$(document).ready(function() {
   table2= $('#table_id_colaboradores').DataTable({
    "language": {
        "sProcessing":    "Procesando...",
        "sLengthMenu":    "Mostrar _MENU_ registros",
        "sZeroRecords":   "No se encontraron resultados",
        "sEmptyTable":    "Ningún dato disponible en esta tabla",
        "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":   "",
        "sSearch":        "Buscar:",
        "sUrl":           "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":    "Último",
            "sNext":    "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        },  
    },
  "dom": 'Brtip',
  "bJQueryUI": true,
 
 
  //"dom": 'lBtipr'
 /* buttons: [
            {
                tag:"button",
                className:"btn btn-primary"
                
            }
        ]
    ,
    "bFilter": false,
    "bLengthChange": false*/
});
});

$('#buscador').on( 'keyup', function () {
    table2.search( this.value ).draw();
} );
$('#buscador2').on( 'keyup', function () {
    table2.search( this.value ).draw();
} );
function cancelaVentanaCol(id) {

    window.location.replace("http://localhost/sistema/colaboradores/editar/"+id);
}
function regresaVentanaCol(){
    window.location.replace("http://localhost/sistema/colaboradores");
}


<!-- <h1>Contenedor en card, para hacer filtros y mostrar lista de estudiantes</h1> -->
<div class="container-fluid">
    <div class="row">
        
        <div class="col-md-12 col-s-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Configuración de preguntas <b id="evaluacion"></b></h3>
              </div>
              <div class="card-body">
                
                <form id="formValidate">
                <div class="row">              
                    <div class="col-lg-3 form-group">
                            <label for="grado" class="m-0">Grado <span class="text-danger">*</span></label>
                            <select name="grado" id="grado" class="form-control form-control-sm select2" style="width: 100% !important;">
                                <option selected disabled> Seleccione una grado</option>
                            </select>
                    </div>
                    <div class="col-lg-3 form-group">
                            <label for="area" class="m-0">Área: <span class="text-danger">*</span></label>
                            <select name="area" id="area" class="form-control form-control-sm select2" style="width: 100% !important;">
                                <option selected disabled> Seleccione una area</option>
                            </select>
                    </div>
                    <div class="col-lg-4">
                    <label for="area" class="m-0"><span class="text-danger"></span></label>
                    <button type="button" class="btn btn-outline-info btn-block btn-sm configurar"><i class="fa fa-search"></i> Seleccionar</button>
                    </div>
                    </div>
                 </form>
                <hr class="my-1">

                <div class="row">
                        <div class="col-md-12 table-responsive contenedorRegistros p-0" style="display: ;">
                            <table id="registros" class="table table-hover dt-responsive nowrap">
                                <thead class="thead-light">
                                    
                                </thead>
                                <tbody id="data">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>



<script>

function fillRegistros()
{
    
    var html = ''; // Variable para almacenar las filas de la tabla
    // Crear la cabecera de la tabla
    var header = `<tr><th class="text-center" data-priority="1">#</th>
                    <th class="text-center" data-priority="2">DNI</th>
                    <th class="text-center" data-priority="2">Apellidos y nombres</th>                                        
                    <th class="text-center" data-priority="1">Estado</th>`;
    
    for (var i = 0; i < 20; i++) {
      var pregunta = 'P' + (i + 1);
      header += '<th>' + pregunta + '</th>';
    }
    header += '</tr>';
    html += header;

    $('.contenedorRegistros').css('display','block');
    jQuery.ajax(
    { 
        url: "<?php echo base_url('estudiante/listar');?>",
        method: 'get',
        success: function(r){
           
            let data = JSON.parse(r);
            for (var i = 0; i < data.length; i++) 
            {
                html += `
                <tr class="text-center">
                  <td>${i + 1}</td>
                  <td>${novDato(data[i].dni)}</td>
                  <td>${novDato(data[i].apellidos)}, ${novDato(data[i].nombres)}</td>
                  <td>${formatoEstadoEstudiante(data[i].estado)}</td>`;

                for (var j = 0; j < 20; j++) {
                var input = '<td><input type="text" class="alternativa" data-estudiante="1" data-pregunta="1"></td>';
                html += input;
              }

                html +='</tr>';
            }
            $('#data').html(html);
            initDatatable('registros');
            $('.overReg').css('display','none');
        }
    });
}

var letras = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];
var contadorLetra = 0;
$(document).ready( function () {
    $('.overlayPagina').css("display","none");
    fillGrado();
	fillArea();
	fillLastEvaluacion();
    
} );
$('.configurar').on('click',function(){
    configurar();
});
$('.agregarOpcion').on('click',function(){
    agregarOpcion();
});

function fillLastEvaluacion()
{
    jQuery.ajax(
    { 
        url: "<?=base_url('evaluacion/ultimaEvaluacion');?>",
        method: 'get',
        success: function(r){
        	let data = JSON.parse(r);
            $('#evaluacion').text(" "+data.anio+" | Etapa: "+data.etapa);
        }
    });
}
function fillGrado()
{
    jQuery.ajax(
    { 
        url: "<?php echo base_url('grado/listar');?>",
        method: 'get',
        success: function(result){
            $.each(JSON.parse(result),function(indice,fila){
                $('#grado').append("<option value='"+fila.idgrado+"'>"+fila.descripcion+"</option>");
            });
            $('#grado').select2({placeholder:"Seleccione una grado.",width:"resolve",});
        }
    });
}
function fillArea()
{
    jQuery.ajax(
    { 
        url: "<?php echo base_url('area/listar');?>",
        method: 'get',
        success: function(result){
            $.each(JSON.parse(result),function(indice,fila){
                $('#area').append("<option value='"+fila.idarea+"'>"+(fila.nivel=='1'?'Primaria':'Secundaria')+" : "+fila.descripcion+"</option>");
            });
            $('#area').select2({placeholder:"Seleccione una area.",width:"resolve",});
        }
    });
}
function eliminarElem(elem)
{
	// alert('eliminancdo des func');
	$(elem).parent().remove();
	let html = '<p class="text-danger text-center eliminarElem" onclick="eliminarElem(this);"><i class="fa fa-trash"></i></p>';
	$('.contenedorAlternativas').children().eq($('.contenedorAlternativas').children().length - 2).append(html);
}
function agregarOpcion()
{
	$('.eliminarElem').remove();
	let html = '<div class="col-lg-1 form-group elem">'+
            		'<label class="m-0">Alt.</label>'+
            		'<input type="text" class="form-control form-control-sm" value="' + letras[contadorLetra] + '">'+
            		'<p class="text-danger text-center eliminarElem" onclick="eliminarElem(this);"><i class="fa fa-trash"></i></p>'+
            	'</div>';
	contadorLetra++;
	if (contadorLetra >= letras.length) {contadorLetra = 0;}
    var ultimoElem = $(".contenedorAlternativas div.elem:last");
    $(html).insertBefore(ultimoElem);
}
function configurar()
{
	if($('#formValidate').valid()==false)
    {return;}
	// alert('listo para configurar');
	fillRegistros();
}
$("#formValidate").validate({
    errorClass: "text-danger font-italic font-weight-normal",
    ignore: ".ignore",
    rules: {
        evaluacion: "required",
        grado: "required",
        area: "required",
    },
});
</script>
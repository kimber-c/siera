<!-- <h1>aka estara el iiee</h1> -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-6 col-sm-6 col-12 m-auto">
                    <h3><i class="fa fa-building"></i> Configuracion de las alternativas</h3>
                </div>
                <div class="col-lg-6 col-sm-6 col-12 m-auto">
                    <button class="btn btn-sm btn-light float-right border shadow" onclick="accion(true);">
                        <i class="fa fa-plus"></i> 
                        Nuevo
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-12 contenedorFormulario">
            <div class="card card-default">
                <!-- <div class="overlay overReg">
                    <i class="fas fa-2x fa-sync-alt"></i>
                </div> -->
                <div class="card-body">
                	<form id="formValidate">
                	<div class="row">
                		<div class="col-lg-3 form-group">
                        	<label for="evaluacion" class="m-0">Evaluacion: <span class="text-danger">*</span></label>
	                        <div class="input-group input-group-sm">
	                            <div class="input-group-prepend">
	                                <span class="input-group-text font-weight-bold"><i class="fa fa-city"></i></span>
	                            </div>
	                            <input type="text" class="form-control" id="evaluacion" name="evaluacion" disabled>
	                        </div>
                    	</div>
                    	<div class="col-lg-3 form-group">
	                        <label for="grado" class="m-0">Grado: <span class="text-danger">*</span></label>
	                        <select name="grado" id="grado" class="form-control form-control-sm select2" style="width: 100% !important;">
	                            <option selected disabled> Seleccione una grado</option>
	                        </select>
	                    </div>
	                    <div class="col-lg-3 form-group">
	                        <label for="area" class="m-0">Area: <span class="text-danger">*</span></label>
	                        <select name="area" id="area" class="form-control form-control-sm select2" style="width: 100% !important;">
	                            <option selected disabled> Seleccione una area</option>
	                        </select>
	                    </div>
	                    <div class="col-lg-3 form-group">
	                    	<label class="m-0" style="visibility: hidden;"></label>
	                        <div class="form-control form-control-sm p-0">
	                        	<button type="button" class="btn btn-sm btn-primary w-100 m-0 configurar"><i class="fa fa-gear"></i> Configurar</button>
	                        </div>
	                    </div>
                	</div>
	                </form>
	                <hr class="my-1">
	                <div class="row contenedorAlternativas" style="display: none;">
                    	<!-- <div class="col-lg-1 form-group elem">
                    		<label class="m-0">Alt.</label>
                    		<input type="text" class="form-control form-control-sm">
                    		<p class="text-danger text-center eliminarElem" onclick="eliminarElem(this);"><i class="fa fa-trash"></i></p>
                    	</div> -->
                    	<!-- <div class="col-lg-1 form-group elem">
                    		<label class="m-0">Alt.</label>
                    		<input type="text" class="form-control form-control-sm">
                    	</div>
                    	<div class="col-lg-1 form-group elem">
                    		<label class="m-0">Alt.</label>
                    		<input type="text" class="form-control form-control-sm">
                    	</div> -->
                    	<div class="col-lg-1 form-group elem">
	                    	<label class="m-0" style="visibility: hidden;"></label>
	                        <div class="form-control form-control-sm p-0">
	                        	<button type="button" class="btn btn-sm btn-primary w-100 m-0 agregarOpcion"><i class="fa fa-plus"></i></button>
	                        </div>
	                    </div>

	                </div>
                    <div class="row">
                        <div class="col-md-12 table-responsive contenedorRegistros p-0" style="display: none;">
                            <table id="registros" class="table table-hover dt-responsive nowrap">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" data-priority="2">Identificador</th>
                                        <th class="text-center" data-priority="2">Descripcion</th>
                                        <th class="text-center" data-priority="1"></th>
                                    </tr>
                                </thead>
                                <tbody id="data">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
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
        url: "<?php echo base_url('evaluacion/ultimaEvaluacion');?>",
        method: 'get',
        success: function(r){
        	let data = JSON.parse(r);
            $('#evaluacion').val("año: "+data.anio+" | etapa: "+data.etapa);
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
	$('.contenedorAlternativas').css('display','flex');
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
<style>
    .btn-flotante {
    font-size: 16px; /* Cambiar el tamaño de la tipografia */
    text-transform: uppercase; /* Texto en mayusculas */
    font-weight: bold; /* Fuente en negrita o bold */
    color: #ffffff; /* Color del texto */
    border-radius: 5px; /* Borde del boton */
    letter-spacing: 2px; /* Espacio entre letras */
    background-color: #28a745; /* Color de fondo */
    padding: 18px 30px; /* Relleno del boton */
    position: fixed;
    bottom: 40px;
    right: 40px;
    transition: all 300ms ease 0ms;
    box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
    z-index: 99;
}
.btn-flotante:hover {
    background-color: #41d497; /* Color de fondo al pasar el cursor */
    box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.3);
    transform: translateY(-7px);
}
@media only screen and (max-width: 600px) {
    .btn-flotante {
        font-size: 14px;
        padding: 12px 20px;
        bottom: 20px;
        right: 20px;
    }
} 
</style>
<a href="#contenedorFooter" class="btn-flotante rounded-circle btn-success addPreguntas" title="Agregar pregunta" style="display: none;"><i class="fa fa-plus fa-2x"></i></a>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12 col-s-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title m-0 evaluacion font-weight-bold text-dark">--</h3>
                    <span class="catidadPreguntas badge badge-warning float-right">Preguntas 5</span>
                </div>
                <div class="card-body">
                    <div class="panel panel-primary">
                        <form id="formValidate">
                        <div class="row">
                            <div class="col-lg-4 form-group">
                                <label for="grado" class="m-0">Grado: <span class="text-danger">*</span></label>
                                <select name="grado" id="grado" class="form-control form-control-sm select2" style="width: 100% !important;">
                                    <option selected disabled> Seleccione una grado</option>
                                </select>
                            </div>
                            <div class="col-lg-4 form-group">
                                <label for="area" class="m-0">Area: <span class="text-danger">*</span></label>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row justify-content-center contenedorCard" style="display: none;">
        <!-- <div class="col-lg-8">
            <div class="card" style="border-left: 5px solid #007bff;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 form-group">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold"><i class="fa fa-city"></i></span>
                                </div>
                                <textarea cols="30" rows="5" class="form-control" placeholder="Pregunta"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 form-group">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold"><i class="fa fa-city"></i></span>
                                </div>
                                <textarea cols="30" rows="5" class="form-control" placeholder="Criterio"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-11 form-group">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold"><i class="fa fa-city"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Alternativa">
                            </div>
                        </div>
                        <div class="col-lg-1 mt-1">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="r1" name="p1">
                                <label for="r1" class="custom-control-label"></label>
                            </div>
                        </div>   
                        <div class="col-lg-11 form-group">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold"><i class="fa fa-city"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Alternativa">
                            </div>
                        </div>
                        <div class="col-lg-1 mt-1">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="r2" name="p1">
                                <label for="r2" class="custom-control-label"></label>
                            </div>
                        </div> 
                        <div class="col-lg-11 form-group">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold"><i class="fa fa-city"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Alternativa">
                            </div>
                        </div>
                        <div class="col-lg-1 mt-1">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="r3" name="p1">
                                <label for="r3" class="custom-control-label"></label>
                            </div>
                        </div>    
                    </div>
                </div>
                <div class="modal-footer py-1 border-transparent">
                    <a href="" class="text-danger"><i class="fa fa-trash fa-lg"></i></a>
                </div>
            </div>
        </div> -->
    </div>
</div>
<script>
var contadorPregunta=1;
var idevaluacion = '';
var configAlternativas = '';
$(document).ready( function () {
    $('.overlayPagina').css("display","none");
    fillGrado();
    fillArea();
    fillLastEvaluacion();
} );
$('.configurar').on('click',function(){
    configurar();
});
$('.addPreguntas').on('click',function(){
    addPreguntas();
});
function fillLastEvaluacion()
{
    jQuery.ajax(
    { 
        url: "<?php echo base_url('evaluacion/ultimaEvaluacion');?>",
        method: 'get',
        success: function(r){
            let data = JSON.parse(r);
            idevaluacion = data.idevaluacion;
            $('.evaluacion').html("Configuración de preguntas ERA "+data.anio+" - "+data.etapa);
            // Configuración de preguntas ERA 2023 - I
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
                $('#grado').append("<option value='"+fila.idgrados+"'>"+fila.descripcion+"</option>");
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
function configurar()
{
    if($('#formValidate').valid()==false)
    {return;}
    var data = {
        idevaluacion:idevaluacion,
        grado:$('#grado').val(),
        area:$('#area').val(),
    };
    jQuery.ajax(
    { 
        url: "<?php echo base_url('confalternativas/mostrar');?>",
        data: data,
        method: 'post',
        success: function(r){
            let data = JSON.parse(r);
            console.log(data);
            configAlternativas = data;
            $('.contenedorCard').css('display','flex');
            $('.addPreguntas').css('display','flex');
        }
    });
    // $('.contenedorCard').css('display','flex');
    // $('.addPreguntas').css('display','flex');
}
function eliminarCard(elem)
{
    $(elem).parent().parent().parent().remove();
    contadorPregunta--;
    // alert(contadorPregunta);
    $('.catidadPreguntas').html('Preguntas '+(contadorPregunta-1));
    $.each($('.preguntaTitulo'), function( index, value ) {
        $(this).html('Pregunta '+(index+1));
    });
    // let html = '<p class="text-danger text-center eliminarCard" onclick="eliminarCard(this);"><i class="fa fa-trash"></i></p>';
}
function buildAlternativas()
{
    // return 'añadi esto mas';
    let html='';
    for(i=0;i<configAlternativas.length;i++)
    {
        html +='<div class="col-lg-11 form-group">'+
                    '<div class="input-group input-group-sm">'+
                        '<div class="input-group-prepend">'+
                            '<span class="input-group-text font-weight-bold">'+configAlternativas[i].alternativa+'</span>'+
                        '</div>'+
                        '<input type="text" class="form-control" placeholder="Alternativa '+configAlternativas[i].alternativa+'">'+
                    '</div>'+
                '</div>'+
                '<div class="col-lg-1 mt-1">'+
                    '<div class="custom-control custom-radio">'+
                        '<input class="custom-control-input" type="radio" id="r3" name="p1">'+
                        '<label for="r3" class="custom-control-label"></label>'+
                    '</div>'+
                '</div>';
    }
    return html;
}
function addPreguntas()
{
    let html = '<div class="col-lg-8">'+
            '<div class="card" style="border-left: 5px solid #007bff;">'+
                '<div class="card-body">'+
                    '<div class="row">'+
                        '<div class="col-lg-12 alert alert-info font-weight-bold preguntaTitulo">Pregunta '+contadorPregunta+'</div>'+
                        '<div class="col-lg-6 form-group">'+
                            '<div class="input-group input-group-sm">'+
                                '<div class="input-group-prepend">'+
                                    '<span class="input-group-text font-weight-bold"><i class="fa fa-city"></i></span>'+
                                '</div>'+
                                '<textarea cols="30" rows="5" class="form-control" placeholder="Pregunta '+contadorPregunta+'"></textarea>'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-lg-6 form-group">'+
                            '<div class="input-group input-group-sm">'+
                                '<div class="input-group-prepend">'+
                                    '<span class="input-group-text font-weight-bold"><i class="fa fa-city"></i></span>'+
                                '</div>'+
                                '<textarea cols="30" rows="5" class="form-control" placeholder="Criterio"></textarea>'+
                            '</div>'+
                        '</div>'+
                        // '<div class="col-lg-11 form-group">'+
                        //     '<div class="input-group input-group-sm">'+
                        //         '<div class="input-group-prepend">'+
                        //             '<span class="input-group-text font-weight-bold"><i class="fa fa-city"></i></span>'+
                        //         '</div>'+
                        //         '<input type="text" class="form-control" placeholder="Alternativa">'+
                        //     '</div>'+
                        // '</div>'+
                        // '<div class="col-lg-1 mt-1">'+
                        //     '<div class="custom-control custom-radio">'+
                        //         '<input class="custom-control-input" type="radio" id="r1" name="p1">'+
                        //         '<label for="r1" class="custom-control-label"></label>'+
                        //     '</div>'+
                        // '</div>'+
                        // '<div class="col-lg-11 form-group">'+
                        //     '<div class="input-group input-group-sm">'+
                        //         '<div class="input-group-prepend">'+
                        //             '<span class="input-group-text font-weight-bold"><i class="fa fa-city"></i></span>'+
                        //         '</div>'+
                        //         '<input type="text" class="form-control" placeholder="Alternativa">'+
                        //     '</div>'+
                        // '</div>'+
                        // '<div class="col-lg-1 mt-1">'+
                        //     '<div class="custom-control custom-radio">'+
                        //         '<input class="custom-control-input" type="radio" id="r2" name="p1">'+
                        //         '<label for="r2" class="custom-control-label"></label>'+
                        //     '</div>'+
                        // '</div>'+
                        // '<div class="col-lg-11 form-group">'+
                        //     '<div class="input-group input-group-sm">'+
                        //         '<div class="input-group-prepend">'+
                        //             '<span class="input-group-text font-weight-bold"><i class="fa fa-city"></i></span>'+
                        //         '</div>'+
                        //         '<input type="text" class="form-control" placeholder="Alternativa">'+
                        //     '</div>'+
                        // '</div>'+
                        // '<div class="col-lg-1 mt-1">'+
                        //     '<div class="custom-control custom-radio">'+
                        //         '<input class="custom-control-input" type="radio" id="r3" name="p1">'+
                        //         '<label for="r3" class="custom-control-label"></label>'+
                        //     '</div>'+
                        // '</div>'+
                        buildAlternativas()+
                    '</div>'+
                '</div>'+
                '<div class="modal-footer py-1 border-transparent">'+
                    '<p class="text-danger text-center eliminarCard" onclick="eliminarCard(this);"><i class="fa fa-trash fa-lg"></i></p>'+
                '</div>'+
            '</div>'+
        '</div>';
    $('.catidadPreguntas').html('Preguntas '+contadorPregunta);
    contadorPregunta++;
    $('.contenedorCard').append(html);
}
$("#formValidate").validate({
    errorClass: "text-danger font-italic font-weight-normal",
    ignore: ".ignore",
    rules: {
        grado: "required",
        area: "required",
    },
});
</script>


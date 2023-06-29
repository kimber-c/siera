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
.div-flotante {
    /*font-size: 16px; */
    text-transform: uppercase; /* Texto en mayusculas */
    /*font-weight: bold; */
    /*color: #ffffff;*/
    /*border-radius: 5px; */
    /*letter-spacing: 2px;*/
    /*background-color: #28a745;*/
    /*padding: 18px 30px; */
    position: fixed;
    bottom: 140px;
    right: 40px;
    /*transition: all 300ms ease 0ms;*/
    /*box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);*/
    z-index: 99;
}
.btn-flotante:hover {
    background-color: #41d497;
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
    .div-flotante {
        font-size: 8px;
        padding: 12px 20px;
        bottom: 65px;
        right: 5px;
        text-align: right;
    }
} 
</style>
<div class="div-flotante font-weight-bold text-dark" style="display: none;">
    <h6 class="m-0">ERA 2023 - 2</h6>
    <span class="catidadPreguntas badge badge-warning">Preguntas 5</span>
</div>
<a href="#contenedorFooter" class="btn-flotante rounded-circle btn-success addPreguntas" title="Agregar pregunta" style="display: none;"><i class="fa fa-plus fa-2x"></i></a>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-12 m-auto">
                    <h3 class="evaluacion"><i class="fa fa-building"></i> Configuracion de las alternativas</h3>
                </div>
                <!-- <div class="col-lg-6 col-sm-6 col-12 m-auto">
                    <button class="btn btn-sm btn-light float-right border shadow" onclick="accion(true);">
                        <i class="fa fa-plus"></i> 
                        Nuevo
                    </button>
                </div> -->
            </div>
        </div>
        <div class="col-md-12 col-s-6">
            <div class="card card-primary">
                <!-- <div class="card-header">
                    <h3 class="card-title m-0 evaluacion font-weight-bold text-dark">--</h3>
                    <span class="catidadPreguntas badge badge-warning float-right">Preguntas 5</span>
                </div> -->
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
            $('.evaluacion').html('<i class="fa fa-building"></i>'+" Configuración de preguntas ERA "+data.anio+" - "+data.etapa);
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
var ppp;
function configurar()
{

    if($('#formValidate').valid()==false)
    {return;}
    $('.contenedorCard>div').remove();
    contadorPregunta=1;
    $('.catidadPreguntas').html('Preguntas 0');
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
            // console.log(data);
            configAlternativas = data;
            $('.contenedorCard').css('display','flex');
            $('.addPreguntas').css('display','flex');
            $('.div-flotante').css('display','block');
        }
    });
    jQuery.ajax(
    { 
        url: "<?php echo base_url('preguntas/listarCard');?>",
        data: data,
        method: 'post',
        success: function(r){
            console.log(r.alternativas);
            ppp=r.alternativas;
            let idpreguntas;
            let html='';
            if(r.preguntas.length!=0)
            {
                for(i=0;i<r.preguntas.length;i++)
                {
                    idpreguntas = r.preguntas[i].idpreguntas;
                    html = '<div class="col-lg-9">'+
                                    '<div class="card" style="border-left: 5px solid #007bff;">'+
                                        '<div class="card-body">'+
                                            '<div class="row contenedorAlternativasCadaPregunta'+idpreguntas+'">'+
                                                '<div class="col-lg-12 alert alert-info font-weight-bold preguntaTitulo">Pregunta '+contadorPregunta+'</div>'+
                                                '<div class="col-lg-6 form-group">'+
                                                    '<div class="input-group input-group-sm">'+
                                                        '<div class="input-group-prepend">'+
                                                            '<span class="input-group-text font-weight-bold"><i class="fa fa-city"></i></span>'+
                                                        '</div>'+
                                                        '<textarea cols="30" rows="3" class="form-control textareaPregunta" data-id="'+idpreguntas+'" placeholder="Pregunta" onblur="actualizarPregunta(this);">'+r.preguntas[i].descripcion+'</textarea>'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="col-lg-6 form-group">'+
                                                    '<div class="input-group input-group-sm">'+
                                                        '<div class="input-group-prepend">'+
                                                            '<span class="input-group-text font-weight-bold"><i class="fa fa-city"></i></span>'+
                                                        '</div>'+
                                                        '<textarea cols="30" rows="3" class="form-control" data-id="'+idpreguntas+'" placeholder="Criterio" onblur="actualizarPregunta(this);">'+novDato(r.preguntas[i].criterio)+'</textarea>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="modal-footer py-1 border-transparent">'+
                                            '<p class="text-danger text-center eliminarCard" onclick="eliminarCard(this);" data-id="'+idpreguntas+'"><i class="fa fa-trash fa-lg"></i></p>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>';
                    $('.catidadPreguntas').html('Preguntas '+contadorPregunta);
                    contadorPregunta++;
                    $('.contenedorCard').append(html);
                }
            }
            let idalternativas;
            html='';
            let id;
            let j=0;
            let validez = '';
            setTimeout(function()
            {
                if(r.alternativas.length!=0)
                {
                    for(i=0;i<r.alternativas.length;i++)
                    {
                        
                        let alternativa = configAlternativas[j].alternativa;
                        // console.log('valor de j :'+j);
                        j++;
                        if (j >= configAlternativas.length) 
                        {j = 0;}
                        idalternativas = r.alternativas[i].idalternativas;
                        id = r.alternativas[i].preguntas_idpreguntas;
                        validez = r.alternativas[i].validez=='1'?'checked':'';
                        html ='<div class="col-lg-11 form-group kevins">'+
                                    '<div class="input-group input-group-sm">'+
                                        '<div class="input-group-prepend">'+
                                            '<span class="input-group-text font-weight-bold">'+alternativa+'</span>'+
                                        '</div>'+
                                        '<input type="text" class="form-control" placeholder="Alternativa '+alternativa+'" onblur="actualizarAlternativa(this);" data-id="'+idalternativas+'" value="'+novDato(r.alternativas[i].descripcion)+'">'+
                                    '</div>'+
                                '</div>'+
                                '<div class="col-lg-1 mt-1">'+
                                    '<div class="custom-control custom-radio">'+
                                        '<input class="custom-control-input" type="radio" id="alternativa'+idalternativas+'" name="radioPregunta'+id+'" onclick="actualizarPreguntaCorrecta(this);" '+validez+'>'+
                                        '<label for="alternativa'+idalternativas+'" class="custom-control-label"></label>'+
                                    '</div>'+
                                '</div>';
                        $(".contenedorAlternativasCadaPregunta"+id).append(html);
                    }
                }

            }, 2000);
            
        }
    });

    // $('.contenedorCard').css('display','flex');
    // $('.addPreguntas').css('display','flex');
}
function eliminarCard(elem)
{
    jQuery.ajax(
    { 
        url: "<?php echo base_url('preguntas/eliminar');?>",
        data: {id:$(elem).attr('data-id')},
        method: 'post',
        success: function(r){
            // let data = JSON.parse(r);
            // console.log(data);
            $(elem).parent().parent().parent().remove();
            contadorPregunta--;
            $('.catidadPreguntas').html('Preguntas '+(contadorPregunta-1));
            $.each($('.preguntaTitulo'), function( index, value ) {
                $(this).html('Pregunta '+(index+1));
            });
        }
    });
    
}
function buildAlternativas(id)
{
    let html='';
    // for(i=0;i<configAlternativas.length;i++)
    // {
    //     let alternativa = configAlternativas[i].alternativa;
        jQuery.ajax(
        {
            url: "<?php echo base_url('alternativas/registrarVarios');?>",
            data: {idpreguntas:id,cantAlternativas:configAlternativas.length},
            method: 'post',
            success: function(r){
                // console.log(r);
                let data = JSON.parse(r);
                for(i=0;i<configAlternativas.length;i++)
                {
                    let alternativa = configAlternativas[i].alternativa;
                    html +='<div class="col-lg-11 form-group">'+
                                '<div class="input-group input-group-sm">'+
                                    '<div class="input-group-prepend">'+
                                        '<span class="input-group-text font-weight-bold">'+alternativa+'</span>'+
                                    '</div>'+
                                    '<input type="text" class="form-control" placeholder="Alternativa '+alternativa+'" onblur="actualizarAlternativa(this);" data-id="'+data[i].idalternativas+'">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-lg-1 mt-1">'+
                                '<div class="custom-control custom-radio">'+
                                    '<input class="custom-control-input" type="radio" id="alternativa'+data[i].idalternativas+'" name="radioPregunta'+id+'" onclick="actualizarPreguntaCorrecta(this);">'+
                                    '<label for="alternativa'+data[i].idalternativas+'" class="custom-control-label"></label>'+
                                '</div>'+
                            '</div>';
                }
                $(".contenedorAlternativasCadaPregunta"+id).append(html);
                window.scrollTo(0, document.body.scrollHeight);
            }
        });
        // html +='<div class="col-lg-11 form-group">'+
        //             '<div class="input-group input-group-sm">'+
        //                 '<div class="input-group-prepend">'+
        //                     '<span class="input-group-text font-weight-bold">'+configAlternativas[i].alternativa+'</span>'+
        //                 '</div>'+
        //                 '<input type="text" class="form-control" placeholder="Alternativa '+configAlternativas[i].alternativa+'">'+
        //             '</div>'+
        //         '</div>'+
        //         '<div class="col-lg-1 mt-1">'+
        //             '<div class="custom-control custom-radio">'+
        //                 '<input class="custom-control-input" type="radio" id="r3" name="radioPregunta'+id+'">'+
        //                 '<label for="r3" class="custom-control-label"></label>'+
        //             '</div>'+
        //         '</div>';
    // }
    // return html;
}
function actualizarPreguntaCorrecta(elem)
{
    // alert($(elem).attr('id'));
    // alert($(elem).attr('id').split('alternativa')[1]);
    // alert($('input:radio[name='+name+']:checked').attr("id");
    let data = {
        idalternativas:$(elem).attr('id').split('alternativa')[1],
        idpreguntas:$(elem).attr('name').split('radioPregunta')[1]
    };
    jQuery.ajax(
    {
        url: "<?php echo base_url('alternativas/actualizarValidez');?>",
        data: data,
        method: 'post',
        success: function(r){
            console.log(r);
        }
    });
}
function addPreguntas()
{
    let data = {
        idevaluacion:idevaluacion,
        grado:$('#grado').val(),
        area:$('#area').val(),
    };
    jQuery.ajax(
    { 
        url: "<?php echo base_url('preguntas/registrar');?>",
        data: data,
        method: 'post',
        success: function(r){
            let data = JSON.parse(r);
            var returnAlternativas = buildAlternativas(data.idpreguntas);
            let html = '<div class="col-lg-9">'+
                            '<div class="card" style="border-left: 5px solid #007bff;">'+
                                '<div class="card-body">'+
                                    '<div class="row contenedorAlternativasCadaPregunta'+data.idpreguntas+'">'+
                                        '<div class="col-lg-12 alert alert-info font-weight-bold preguntaTitulo">Pregunta '+contadorPregunta+'</div>'+
                                        '<div class="col-lg-6 form-group">'+
                                            '<div class="input-group input-group-sm">'+
                                                '<div class="input-group-prepend">'+
                                                    '<span class="input-group-text font-weight-bold"><i class="fa fa-city"></i></span>'+
                                                '</div>'+
                                                '<textarea cols="30" rows="3" class="form-control textareaPregunta" data-id="'+data.idpreguntas+'" placeholder="Pregunta" onblur="actualizarPregunta(this);"></textarea>'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="col-lg-6 form-group">'+
                                            '<div class="input-group input-group-sm">'+
                                                '<div class="input-group-prepend">'+
                                                    '<span class="input-group-text font-weight-bold"><i class="fa fa-city"></i></span>'+
                                                '</div>'+
                                                '<textarea cols="30" rows="3" class="form-control" data-id="'+data.idpreguntas+'" placeholder="Criterio" onblur="actualizarPregunta(this);"></textarea>'+
                                            '</div>'+
                                        '</div>'+
                                        // returnAlternativas+
                                    '</div>'+
                                '</div>'+
                                '<div class="modal-footer py-1 border-transparent">'+
                                    '<p class="text-danger text-center eliminarCard" onclick="eliminarCard(this);" data-id="'+data.idpreguntas+'"><i class="fa fa-trash fa-lg"></i></p>'+
                                '</div>'+
                            '</div>'+
                        '</div>';
            $('.catidadPreguntas').html('Preguntas '+contadorPregunta);
            contadorPregunta++;
            $('.contenedorCard').append(html);
        }
    });
    
}
function actualizarAlternativa(elem)
{
    if($(elem).val()!='')
    {
        data = {
            idalternativas:$(elem).attr('data-id'),
            descripcion:$(elem).val(),
        };
        jQuery.ajax(
        {
            url: "<?php echo base_url('alternativas/actualizar');?>",
            data: data,
            method: 'post',
            success: function(r){
                console.log(r);
            }
        });
    }
}
function actualizarPregunta(elem)
{
    let data = '';
    if($(elem).val()!='')
    {
        if($(elem).hasClass('textareaPregunta'))
        {
            data = {
                idpreguntas:$(elem).attr('data-id'),
                descripcion:$(elem).val(),
                tipo:'pregunta',
            };
        }
        else
        {
            data = {
                idpreguntas:$(elem).attr('data-id'),
                criterio:$(elem).val(),
                tipo:'criterio',
            };
        }
        jQuery.ajax(
        {
            url: "<?php echo base_url('preguntas/actualizar');?>",
            data: data,
            method: 'post',
            success: function(r){
                console.log(r);
            }
        });
    }
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


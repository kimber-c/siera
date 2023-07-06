<div class="modal fade" id="modalIe" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header py-1 border-transparent" style="background-color: rgba(0, 0, 0, 0.03);">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-building"></i> Nueva institucion educativa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formValidate">
                <div class="row contForm">
                    <div class="col-lg-6 form-group">
                        <label for="codmodular" class="m-0">Codigo modular: <span class="text-danger">*</span></label>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold"><i class="fa fa-building"></i></span>
                            </div>
                            <input type="text" class="form-control input soloNumeros" id="codmodular" name="codmodular" maxlength="7">
                        </div>
                    </div>
                    <div class="col-lg-6 form-group">
                        <label for="cod_local" class="m-0">Codigo local: <span class="text-danger">*</span></label>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold"><i class="fa fa-city"></i></span>
                            </div>
                            <input type="text" class="form-control input soloNumeros" id="cod_local" name="cod_local" maxlength="6">
                        </div>
                    </div>
                    <div class="col-lg-6 form-group">
                        <label for="descripcion" class="m-0">Nombre: <span class="text-danger">*</span></label>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold"><i class="fa fa-building"></i></span>
                            </div>
                            <input type="text" class="form-control input" id="descripcion" name="descripcion">
                        </div>
                    </div>
                    <div class="col-lg-6 form-group">
                        <label for="nivel" class="m-0">Nivel: <span class="text-danger">*</span></label>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold"><i class="fa fa-building"></i></span>
                            </div>
                            <select name="nivel" id="nivel" class="form-control sValidate input">
                                <option value="1" selected>Primaria</option>
                                <option value="2">Secundaria</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 form-group">
                        <label for="gestion" class="m-0">Gestion: <span class="text-danger">*</span></label>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold"><i class="fa fa-building-lock"></i></span>
                            </div>
                            <!-- <input type="text" class="form-control input" id="gestion" name="gestion"> -->
                            <select name="gestion" id="gestion" class="form-control">
                                <option value="1" selected>publico</option>
                                <option value="2">privado</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 form-group">
                        <label for="direccion" class="m-0">Direccion:</label>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold"><i class="fa fa-location"></i></span>
                            </div>
                            <input type="text" class="form-control input" id="direccion" name="direccion">
                        </div>
                    </div>
                    <div class="col-lg-6 form-group">
                        <label for="localidad" class="m-0">Centro poblado:</label>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold"><i class="fa fa-map"></i></span>
                            </div>
                            <input type="text" class="form-control input" id="localidad" name="localidad">
                        </div>
                    </div>
                    <div class="col-lg-6 form-group">
                        <label for="area_geografica" class="m-0">Area geografica: <span class="text-danger">*</span></label>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold"><i class="fa fa-map"></i></span>
                            </div>
                            <!-- <input type="text" class="form-control input" id="area_geografica" name="area_geografica"> -->
                            <select name="area_geografica" id="area_geografica" class="form-control">
                                <option value="rural" selected>Rural</option>
                                <option value="urbano">Urbano</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 form-group">
                        <label for="provincia" class="m-0">Provincia: <span class="text-danger">*</span></label>
                        <select name="provincia" id="provincia" class="form-control form-control-sm select2" style="width: 100% !important;">
                            <option selected disabled> Seleccione una provincia</option>
                        </select>
                    </div>
                    <div class="col-lg-4 form-group">
                        <label for="distrito" class="m-0">Distrito: <span class="text-danger">*</span></label>
                        <select name="distrito" id="distrito" class="form-control form-control-sm select2" style="width: 100% !important;">
                            <option selected disabled> Seleccione una distrito</option>
                        </select>
                    </div>
                    <div class="col-lg-4 form-group">
                        <label for="ugel" class="m-0">Ugel: <span class="text-danger">*</span></label>
                        <select name="ugel" id="ugel" class="form-control form-control-sm select2" style="width: 100% !important;">
                            <option selected disabled> Seleccione una ugel</option>
                        </select>
                    </div>
                </div>
                </form>
            </div>
            <div class="modal-footer py-1 border-transparent">
                <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-sm btn-success segunAccion guardar"><i class="fa fa-save"></i> Guardar</button>
            </div>
        </div>
    </div>
</div>
<script>
var nombreAccion;
$(document).ready( function () {
    fillDistrito();
    fillProvincia();
    fillEjecutoras();
} );
$('.segunAccion').on('click',function(){
    segunAccion();
});
function accion(ban)
{
    if(ban)
    {
        limpiarForm();
        $('.actualizar').addClass('guardar');
        $('.actualizar').removeClass('actualizar');
        $('.guardar').html('<i class="fa fa-save"></i> Guardar');
        nombreAccion = 'registrar';
        $('#codmodular').prop('disabled',false);
    }
    else
    {
        $('.guardar').addClass('actualizar');
        $('.guardar').removeClass('guardar');
        $('.actualizar').html('<i class="fa fa-save"></i> Guardar Cambios');
        nombreAccion = 'actualizar';
        $('#codmodular').prop('disabled',true);
    }
    $('#modalIe').modal('show');
}
function fillEjecutoras()
{
    jQuery.ajax(
    { 
        url: "<?php echo base_url('ejecutora/listar');?>",
        method: 'get',
        success: function(result){
            $.each(JSON.parse(result),function(indice,fila){
                $('#ugel').append("<option value='"+fila.idejecutora+"'>"+fila.descripcion+"</option>");
            });
            $('#ugel').select2({placeholder:"Seleccione una ugel.",width:"resolve",});
        }
    });
}
function fillDistrito()
{
    jQuery.ajax(
    { 
        url: "<?php echo base_url('distrito/listar');?>",
        method: 'get',
        success: function(result){
            $.each(JSON.parse(result),function(indice,fila){
                $('#distrito').append("<option value='"+fila.iddistrito+"'>"+fila.descripcion+"</option>");
            });
            $('#distrito').select2({placeholder:"Seleccione una distrito.",width:"resolve",});
        }
    });
}
function fillProvincia()
{
    jQuery.ajax(
    { 
        url: "<?php echo base_url('provincia/listar');?>",
        method: 'get',
        success: function(result){
            $.each(JSON.parse(result),function(indice,fila){
                $('#provincia').append("<option value='"+fila.idprovincia+"'>"+fila.descripcion+"</option>");
            });
            $('#provincia').select2({placeholder:"Seleccione una provincia.",width:"resolve",});
        }
    });
}
function data(tipo)
{
	return {
        // accion: accion,
        codmodular:$('#codmodular').val(),
        cod_local:$('#cod_local').val(),
        descripcion:$('#descripcion').val(),
        nivel:$('#nivel').val(),
        gestion:$('#gestion').val(),
        direccion:$('#direccion').val(),
        localidad:$('#localidad').val(),
        area_geografica:$('#area_geografica').val(),
        provincia:$('#provincia').val(),
        distrito:$('#distrito').val(),
        ugel:$('#ugel').val(),
	}
}
function segunAccion()
{
    if(nombreAccion == 'registrar')
    {
        if($('#formValidate').valid()==false)
        {return;}
        jQuery.ajax(
        {
            url: "<?php echo base_url('iiee/registrar');?>",
            data: data(true),
            method: 'post',
            success: function(result){
                console.log(result);
                let data = JSON.parse(result);
                $('.overReg').css('display','flex');
                construirTabla();
                fillRegistros();
                $('#modalIe').modal('hide');
                msjRee(data);
                limpiarForm();
            }
        });
    }
    else
    {
        if($('#formValidate').valid()==false)
        {return;}
        jQuery.ajax(
        {
            url: "<?php echo base_url('iiee/actualizar');?>",
            data: data(true),
            method: 'post',
            success: function(result){

                let data = JSON.parse(result);
                $('.overReg').css('display','flex');
                construirTabla();
                fillRegistros();
                $('#modalIe').modal('hide');
                msjRee(data);
            }
        });
        console.log('ssssssssssss');
        console.log(data(true));
        console.log('ssssssssssss');
    }
}
function consultar(elem)
{
    // $('#modalEditar').modal('show');
    jQuery.ajax(
    {
        url: "<?php echo base_url('iiee/consultar');?>",
        data: {id:$(elem).attr('data-id')},
        method: 'post',
        success: function(r){
            console.log(r);
            let data = JSON.parse(r);
            $('#codmodular').val(data.codmodular);
            $('#cod_local').val(data.cod_local);
            $('#descripcion').val(data.descripcion);
            $('#nivel').val(data.nivel);
            $('#gestion').val(data.gestion);
            $('#direccion').val(data.direccion);
            $('#localidad').val(data.localidad);
            $('#area_geografica').val(data.area_geografica);
            $('#provincia').val(data.provincia_idprovincia).change();
            $('#distrito').val(data.distrito_iddistrito).change();
            $('#ugel').val(data.ejecutora_idejecutora).change();
            // $('#modalIe').modal('show');

            // $('.guardar').addClass('actualizar');
            // $('.guardar').removeClass('guardar');
            // $('.actualizar').html('Guardar Cambios');
            accion(false);
            // accion=false;
        }
    });
}
$("#formValidate").validate({
    errorClass: "text-danger font-italic font-weight-normal",
    ignore: ".ignore",
    rules: {
        codmodular: "required",
        cod_local: "required",
        descripcion: "required",
        nivel: "required",
        gestion: "required",
        area_geografica: "required",
        provincia: "required",
        distrito: "required",
        ugel: "required",
    },
});
</script>
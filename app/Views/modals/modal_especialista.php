<div class="modal fade" id="modalEspecialista" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header py-1 border-transparent" style="background-color: rgba(0, 0, 0, 0.03);">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-building"></i> Nuevo especialista</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formValidate">
                <div class="row contForm">
                    <div class="card mx-2">
                        <div class="card-header py-0">
                            <h6 class="card-title m-0">Datos de especialista</h6>
                        </div>
                        <div class="card-body p-2">
                            <div class="row">
                                <div class="col-lg-6 form-group">
                                    <label for="ejecutora" class="m-0">Ugel: <span class="text-danger">*</span></label>
                                    <select name="ejecutora" id="ejecutora" class="form-control form-control-sm select2" style="width: 100% !important;">
                                        <option selected disabled> Seleccione una Ugel</option>
                                    </select>
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label for="dni" class="m-0">DNI: <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bold"><i class="fa fa-city"></i></span>
                                        </div>
                                        <input type="text" class="form-control soloNumeros" id="dni" name="dni" maxlength="8">
                                    </div>
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label for="nombres" class="m-0">Nombres: <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bold"><i class="fa fa-city"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="nombres" name="nombres">
                                    </div>
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label for="apellidos" class="m-0">Apellidos:</label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bold"><i class="fa fa-city"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="apellidos" name="apellidos">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mx-2">
                        <div class="card-header py-0">
                            <h6 class="card-title m-0">Credenciales</h6>
                        </div>
                        <div class="card-body p-2">
                            <div class="row">
                                <div class="col-lg-6 form-group">
                                    <label for="usuario" class="m-0">Usuario: <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bold"><i class="fa fa-city"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="usuario" name="usuario">
                                    </div>
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label for="password" class="m-0">Contraseña: <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bold"><i class="fa fa-city"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="password" name="password">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input estado" type="checkbox" id="estado" checked="true">
                                        <label for="estado" class="custom-control-label desEstado"> Activo</label>
                                    </div>
                                </div>
                            </div>
                        </div>
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
var idespecialista='';
$(document).ready( function () {
    fillEjecutoras();
} );
$('.segunAccion').on('click',function(){
    segunAccion();
});
$('.estado').on('click',function(){
    // alert($('#estado').prop("checked"));
    $('.desEstado').html($('#estado').prop("checked")?' Activo':' Inactivo');
});
function fillEjecutoras()
{
    jQuery.ajax(
    { 
        url: "<?php echo base_url('ejecutora/listar');?>",
        method: 'get',
        success: function(result){
            $.each(JSON.parse(result),function(indice,fila){
                $('#ejecutora').append("<option value='"+fila.idejecutora+"'>"+fila.descripcion+"</option>");
            });
            $('#ejecutora').select2({placeholder:"Seleccione una institucion educativa.",width:"resolve",});
        }
    });
}
function accion(ban)
{
    if(ban)
    {
        limpiarForm();
        $('.actualizar').addClass('guardar');
        $('.actualizar').removeClass('actualizar');
        $('.guardar').html('<i class="fa fa-save"></i> Guardar');
        nombreAccion = 'registrar';
    }
    else
    {
        $('.guardar').addClass('actualizar');
        $('.guardar').removeClass('guardar');
        $('.actualizar').html('<i class="fa fa-save"></i> Guardar Cambios');
        nombreAccion = 'actualizar';
    }
    $('#modalEspecialista').modal('show');
}
function data(tipo)
{
    return {
        ejecutora:$('#ejecutora').val(),
        dni:$('#dni').val(),
        nombres:$('#nombres').val(),
        apellidos:$('#apellidos').val(),
        usuario:$('#usuario').val(),
        password:$('#password').val(),
        estado:$('#estado').prop("checked"),
        idespecialista:idespecialista,
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
            url: "<?php echo base_url('especialista/registrar');?>",
            data: data(true),
            method: 'post',
            success: function(result){
                console.log(result);
                let data = JSON.parse(result);
                $('.overReg').css('display','flex');
                construirTabla();
                fillRegistros();
                $('#modalEspecialista').modal('hide');
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
            url: "<?php echo base_url('especialista/actualizar');?>",
            data: data(true),
            method: 'post',
            success: function(result){
                let data = JSON.parse(result);
                $('.overReg').css('display','flex');
                construirTabla();
                fillRegistros();
                $('#modalEspecialista').modal('hide');
                msjRee(data);
            }
        });
    }
}
function consultar(elem)
{
    jQuery.ajax(
    {
        url: "<?php echo base_url('especialista/consultar');?>",
        data: {id:$(elem).attr('data-id')},
        method: 'post',
        success: function(r){
            let data = JSON.parse(r);
            idespecialista=data.idespecialista;
            $('#ejecutora').val(data.ugel_idugel).change();
            $('#dni').val(data.dni);
            $('#nombres').val(data.nombres);
            $('#apellidos').val(data.apellidos);
            $('#usuario').val(data.usuario);
            $('#password').val(data.contraseña);
            $('#estado').prop("checked",data.estado=="activo"?true:false);
            $('.desEstado').html(data.estado=="activo"?' Activo':' Inactivo');
            accion(false);
        }
    });
}
$("#formValidate").validate({
    errorClass: "text-danger font-italic font-weight-normal",
    ignore: ".ignore",
    rules: {
        iiee: "required",
        dni: "required",
        nombres: "required",
        usuario: "required",
        password: "required",

    },
});
</script>
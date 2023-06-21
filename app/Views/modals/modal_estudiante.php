<div class="modal fade" id="modalIe" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header py-1 border-transparent" style="background-color: rgba(0, 0, 0, 0.03);">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-building"></i> Nuevo estudiante</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formValidate">
                <div class="row contForm">
                    <div class="col-lg-6 form-group">
                        <label for="dni" class="m-0">DNI: <span class="text-danger">*</span></label>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold"><i class="fa fa-building"></i></span>
                            </div>
                            <input type="text" class="form-control input soloNumeros" id="dni" name="dni" maxlength="8">
                        </div>
                    </div>
                    <div class="col-lg-6 form-group">
                        <label for="nombres" class="m-0">Nombres: <span class="text-danger">*</span></label>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold"><i class="fa fa-city"></i></span>
                            </div>
                            <input type="text" class="form-control input soloNumeros" id="nombres" name="nombres" maxlength="20">
                        </div>
                    </div>
                    <div class="col-lg-6 form-group">
                        <label for="apellidos" class="m-0">Apellidos: <span class="text-danger">*</span></label>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold"><i class="fa fa-building"></i></span>
                            </div>
                            <input type="text" class="form-control input" id="apellidos" name="apellidos">
                        </div>
                    </div>
                    <div class="col-lg-6 form-group">
                        <label for="estado" class="m-0">Estado: <span class="text-danger">*</span></label>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold"><i class="fa fa-building"></i></span>
                            </div>
                            <select name="estado" id="estado" class="form-control sValidate input">
                                <option value="1" selected>Activo</option>
                                <option value="0">inactivo</option>
                            </select>
                        </div>
                    </div>


                    <!-- <div class="col-lg-4 form-group">
                        <label for="detalleie" class="m-0">Provincia: <span class="text-danger">*</span></label>
                        <select name="detalleie" id="detalleie" class="form-control form-control-sm select2" style="width: 100% !important;">
                            <option selected disabled> Seleccione una detalle</option>
                        </select>
                    </div> -->

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
var idestudiante;
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
    // alert('si llega hasta aki---:'+ban);
    if(ban)
    {
        limpiarForm();
        $('.actualizar').addClass('guardar');
        $('.actualizar').removeClass('actualizar');
        $('.guardar').html('<i class="fa fa-save"></i> Guardar');
        nombreAccion = 'registrar';
        // $(".guardar").attr('onclick', guardar());
    }
    else
    {
        $('.guardar').addClass('actualizar');
        $('.guardar').removeClass('guardar');
        $('.actualizar').html('<i class="fa fa-save"></i> Guardar Cambios');
        nombreAccion = 'actualizar';
        // $(".actualizar").attr('onclick', actualizar());
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


function data(tipo)
{
	return {
        // accion: accion,
        idestudiante: idestudiante,
        dni:$('#dni').val(),
        nombres:$('#nombres').val(),
        apellidos:$('#apellidos').val(),
        estado:$('#estado').val()        
        // detalle:$('#detalle').val()
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
            url: "<?php echo base_url('estudiante/registrar');?>",
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
            url: "<?php echo base_url('estudiante/actualizar');?>",
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
    }
}

function consultar(elem)
{
    // $('#modalEditar').modal('show');
    jQuery.ajax(
    {
        url: "<?php echo base_url('estudiante/consultar');?>",
        data: {id:$(elem).attr('data-id')},
        method: 'post',
        success: function(r){
            console.log(r);
            let data = JSON.parse(r);
            idestudiante = data.idestudiante;
            $('#dni').val(data.dni);
            $('#nombres').val(data.nombres);
            $('#apellidos').val(data.apellidos);
            $('#estado').val(data.estado);
            
            $('#detalleie').val(data.detalleie_iddetalleie).change();
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
        dni: "required",
        nombres: "required",
        apellidos: "required",       
        detalleie: "required"
    },
});
</script>
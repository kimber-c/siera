<div class="modal fade" id="modalDistrito" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header py-1 border-transparent" style="background-color: rgba(0, 0, 0, 0.03);">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-building"></i> Nuevo distrito</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formValidate">
                <div class="row contForm">
                    <div class="col-lg-6 form-group">
                        <label for="provincia" class="m-0">Provincia: <span class="text-danger">*</span></label>
                        <select name="provincia" id="provincia" class="form-control form-control-sm select2" style="width: 100% !important;">
                            <option selected disabled> Seleccione una provincia</option>
                        </select>
                    </div>
                    <div class="col-lg-6 form-group">
                        <label for="descripcion" class="m-0">Descripcion: <span class="text-danger">*</span></label>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold"><i class="fa fa-city"></i></span>
                            </div>
                            <input type="text" class="form-control" id="descripcion" name="descripcion">
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
var iddistrito = '';
$(document).ready( function () {
    fillProvincia();
} );
$('.segunAccion').on('click',function(){
    segunAccion();
});
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
function accion(ban)
{
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
    $('#modalDistrito').modal('show');
    // 8.30 9 de julio 7.30 dni
}
function data(tipo)
{
	return {
        iddistrito:iddistrito,
        idprovincia:$('#provincia').val(),
        descripcion:$('#descripcion').val(),
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
            url: "<?php echo base_url('distrito/registrar');?>",
            data: data(true),
            method: 'post',
            success: function(result){
                console.log(result);
                let data = JSON.parse(result);
                $('.overReg').css('display','flex');
                construirTabla();
                fillRegistros();
                $('#modalDistrito').modal('hide');
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
            url: "<?php echo base_url('distrito/actualizar');?>",
            data: data(true),
            method: 'post',
            success: function(result){
                let data = JSON.parse(result);
                $('.overReg').css('display','flex');
                construirTabla();
                fillRegistros();
                $('#modalDistrito').modal('hide');
                msjRee(data);
            }
        });
    }
}
function consultar(elem)
{
    jQuery.ajax(
    {
        url: "<?php echo base_url('distrito/consultar');?>",
        data: {id:$(elem).attr('data-id')},
        method: 'post',
        success: function(r){
            console.log(r);
            let data = JSON.parse(r);
            iddistrito=data.iddistrito;
            $('#provincia').val(data.provincia_idprovincia).change();
            $('#descripcion').val(data.descripcion);
            accion(false);
        }
    });
}
$("#formValidate").validate({
    errorClass: "text-danger font-italic font-weight-normal",
    ignore: ".ignore",
    rules: {
        identificador: "required",
        descripcion: "required",
        
    },
});
</script>
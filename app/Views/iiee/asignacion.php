<div class="modal fade" id="modalAsignacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header py-1 border-transparent" style="background-color: rgba(0, 0, 0, 0.03);">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-gear"></i> Asignar grado y seccion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="fvAsignacion">
                <div class="row contForm">
                    <div class="col-lg-5 form-group">
                        <label for="grado" class="m-0">Grado: <span class="text-danger">*</span></label>
                        <select name="grado" id="grado" class="form-control form-control-sm select2" style="width: 100% !important;">
                            <option selected disabled> Seleccione una grado</option>
                        </select>
                    </div>
                    <div class="col-lg-7 form-group">
                        <label for="seccion" class="m-0">Secciones: <span class="text-danger">*</span></label>
                        <select name="seccion[]" id="seccion" multiple="multiple" class="form-control form-control-sm select2" style="width: 100% !important;">
                            <option disabled> Seleccione una seccion</option>
                        </select>
                    </div>
                    <div class="col-lg-12 pb-3">
                        <button type="button" class="btn btn-sm btn-success guardarAsignacion w-100"><i class="fa fa-save"></i> Guardar</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 table-responsive p-0">
                        <table id="sa" class="table table-hover dt-responsive nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center" data-priority="1">Grado</th>
                                    <th class="text-center" data-priority="1">Secciones</th>
                                    <th class="text-center" data-priority="1"></th>
                                </tr>
                            </thead>
                            <tbody id="dataAsignacion">
                                <tr>
                                    <td>primer grado</td>
                                    <td>A, B, C</td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <button type="button" class="btn text-secondary"><i class="fa fa-edit"></i></button>
                                            <button type="button" class="btn text-danger"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>primer grado</td>
                                    <td>A, B, C</td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <button type="button" class="btn text-secondary"><i class="fa fa-edit"></i></button>
                                            <button type="button" class="btn text-danger"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>primer grado</td>
                                    <td>A, B, C</td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <button type="button" class="btn text-secondary"><i class="fa fa-edit"></i></button>
                                            <button type="button" class="btn text-danger"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                </form>
            </div>
            <div class="modal-footer py-1 border-transparent">
                <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Cerrar</button>
                
            </div>
        </div>
    </div>
</div>
<style>
#dataAsignacion td {
  /*min-width: 235px;*/
  /*height: 100px;*/
  /*background-color: #433;*/
  padding: 0;
    text-align: center;
}

table {
  /*color: #4ef;*/
}
</style>    
<script>
var nombreAccion;
$(document).ready( function () {
    fillGrado();
    fillSeccion();
} );
function fillGrado()
{
    jQuery.ajax(
    { 
        url: "<?php echo base_url('grado/listar');?>",
        method: 'get',
        success: function(result){
            $.each(JSON.parse(result),function(indice,fila){
                $('#grado').append("<option value='"+fila.idejecutora+"'>"+fila.descripcion+"</option>");
            });
            $('#grado').select2({placeholder:"Seleccione una grado.",width:"resolve",});
        }
    });
}
function fillSeccion()
{
    jQuery.ajax(
    { 
        url: "<?php echo base_url('seccion/listar');?>",
        method: 'get',
        success: function(result){
            $.each(JSON.parse(result),function(indice,fila){
                $('#seccion').append("<option value='"+fila.idejecutora+"'>"+fila.descripcion+"</option>");
            });
            $('#seccion').select2({placeholder:"Seleccione una seccion.",width:"resolve",});
        }
    });
}
$('.guardarAsignacion').on('click',function(){
    guardarAsignacion();
})
function data(tipo)
{
    return {
        grado:$('#grado').val(),
        secciones:$('#seccion').val(),
    }
}
function asignar(elem)
{
    $('#modalAsignacion').modal('show');
}
function guardarAsignacion()
{
    if($('#formValidate').valid()==false)
    {return;}
    jQuery.ajax(
    {
        url: "<?php echo base_url('asignacion/registrar');?>",
        data: data(true),
        method: 'post',
        success: function(result){
            console.log(result);
            // let data = JSON.parse(result);
            // $('.overReg').css('display','flex');
            // construirTabla();
            // fillRegistros();
            // $('#modalIe').modal('hide');
            // msjRee(data);
            // limpiarForm();
        }
    });
}
$("#fvAsignacion").validate({
    errorClass: "text-danger font-italic font-weight-normal",
    ignore: ".ignore",
    rules: {
        grado: "required",
        seccion: "required",
    },
});
</script>
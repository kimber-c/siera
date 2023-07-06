<!-- <h1>aka estara el iiee</h1> -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-6 col-sm-6 col-12 m-auto">
                    <h3><i class="fa fa-building"></i> Provincias</h3>
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
                <div class="overlay overReg">
                    <i class="fas fa-2x fa-sync-alt"></i>
                </div>
                <div class="card-body">
                    <div class="alert alert-warning msjPms" style="display: none;">
                        <p class="m-0 font-weight-bold font-italic">El usuario no cuenta con el acceso a registros.</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12 table-responsive contenedorRegistros p-0" style="display: none;">
                            <table id="registros" class="table table-hover dt-responsive nowrap">
                                <thead class="thead-dark">
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
<?php include 'modals/modal_provincia.php';?>
<script>
var tablaDeRegistros;
$(document).ready( function () {
    tablaDeRegistros=$('.contenedorRegistros').html();
    $('.overlayPagina').css("display","none");
    fillRegistros();
} );
function fillRegistros()
{
    $('.contenedorRegistros').css('display','block');
    jQuery.ajax(
    { 
        url: "<?php echo base_url('provincia/listar');?>",
        method: 'get',
        success: function(r){
            // console.log(JSON.parse(r)[0].cod_modular);
            var html = '';
            let data = JSON.parse(r);
            for (var i = 0; i < data.length; i++) 
            {
                html += '<tr class="text-center">' +
                    '<td>' + novDato(data[i].idprovincia) + '</td>' +
                    '<td>' + novDato(data[i].descripcion) + '</td>' +
                    '<td>'+
                    '<div class="btn-group btn-group-sm" role="group">'+
                        '<button type="button" class="btn text-secondary" title="Editar registro" onclick="consultar(this);" data-id="'+data[i].idprovincia+'"><i class="fa fa-edit" ></i></button>'+
                        '<button type="button" class="btn text-danger" title="Eliminar registro" onclick="eliminar(this);" data-id="'+data[i].idprovincia+'"><i class="fa fa-trash"></i></button>'+
                    '</div>'+
                    '</td></tr>';
            }
            $('#data').html(html);
            initDatatable('registros');
            $('.overReg').css('display','none');
        }
    });
}
function eliminar(elem)
{
    Swal.fire({
        title: 'Esta seguro de eliminar el registro?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
    }).then((result) => {
        if(result.isConfirmed)
        {
            $('.overReg').css('display','none');
            jQuery.ajax(
            { 
                url: "<?php echo base_url('provincia/eliminar');?>",
                data: {id:$(elem).attr('data-id')},
                method: 'post',
                success: function(result){
                    let data = JSON.parse(result);
                    construirTabla();
                    fillRegistros();
                    msjRee(data);
                }
            });
        }
    });
}
function construirTabla()
{
    $('.contenedorRegistros>div').remove();
    $('.contenedorRegistros').html(tablaDeRegistros);
}
function limpiarForm()
{
    $('#descripcion').val('');
    $("#identificador").prop("selectedIndex", 0);
}
</script>
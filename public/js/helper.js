// nb5
// id de la tabla para inicializar con dattable INIT
function initDatatable(idTabla)
{
    $('#'+idTabla).DataTable( {
        "autoWidth":false,
        "responsive":true,
        "ordering": false,
        "lengthMenu": [[5, 10,25, -1], [5, 10,25, "Todos"]],   
        // "order": [[ 1, 'desc' ]],
        "language": {
            "info": "Mostrando la pagina _PAGE_ de _PAGES_. (Total: _MAX_)",
            "search":"",
            "infoFiltered": "(filtrando)",
            "infoEmpty": "No hay registros disponibles",
            "sEmptyTable": "No tiene registros guardados.",
            "lengthMenu":"Mostrar registros _MENU_ .",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
        
    } );
    $('input[type=search]').parent().css('width','100%');
    $('input[type=search]').css('width','100%');            $('input[type=search]').css('margin','0');
    $('input[type=search]').prop('placeholder','Escriba para buscar en las columnas.');
}
$('.input-number').on('input', function () { 
    this.value = this.value.replace(/[^0-9]/g,'');
});
function novDato(dato)
{
    return dato!==null && dato!=''?dato:'--';
}
$('.soloNumeros').on('input', function () { 
    this.value = this.value.replace(/[^0-9]/g,'');
});
function msjSwal(estado,msj) 
{
    if(estado)
    {
        if(msj=='eliminado')
        {
            Swal.fire(
                'Eliminado!',
                'Su registro a sido eliminado.',
                'success'
            )
        }
        else
        {
            Swal.fire({
                // position: 'top-end',
                icon: 'success',
                title: msj,
                showConfirmButton: false,
                timer: 1500
            });
        }
    }
    else
    {
        new PNotify(
        {
            title : 'No se pudo proceder',
            text : '--',
            type : 'error'
        });
    }
}
function msjRee(result)
{
    var Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        // timer: 3000
        timer:3000
    });
    if(result.estado)
    {
        Toast.fire({
            icon: 'success',
            title: result.msg
        });
    }
    else
    {
        if(result.validator)
        {
            let verifyObject = JSON.parse(result.msg);
            if(typeof verifyObject === 'object')
            {
                var msg='';
                for (const property in verifyObject) 
                {
                    console.log(`${property}: ${verifyObject[property]}`);
                    msg=msg+`${verifyObject[property]}`+'<br>';
                }
                Toast.fire({
                    icon: 'error',
                    title: msg
                });
            }
        }
        else
        {
            Toast.fire({
                icon: 'error',
                title: result.msg
            });
        }
    }
}
function msjSimple(estado,mensaje)
{
    var Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 3000
    });
    Toast.fire({
        icon: estado?'success':'error',
        title: mensaje
    });
}
$('.buscarDni').on('click',function(){
    if($('#doc').val().length==8)
    {
        jQuery.ajax(
        { 
            url: "https://www.dayangels.xyz/api/reniec/reniec-dni",
            method: 'post',
            data:{dni:$('#doc').val()},
            beforeSend(request) {
                request.setRequestHeader('Authorization', 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjozMDUsImNvcnJlbyI6Imtldmlucy5jaG9xdWVAZ21haWwuY29tIiwiaWF0IjoxNjU0NjI2MzY3fQ.BxPEwgV24FCAemB8lAPwgfTPhCHZs8b4IHOqQ56PLKU');
            },
            success: function(data){
                $('#nombre').val(data.result.nombres);
                $('#apellido').val(data.result.paterno+' '+data.result.materno);
                msjSimple(true,'Los datos fueron traidos exitosamente.');
            },
            error: function(data){
                msjSimple(false,'Las consultas a la RENIEC se encuentra inabilitada en estos momentos.');
            },
        });
    }
});
$('.ebuscarDni').on('click',function(){
    if($('#edoc').val().length==8)
    {
        jQuery.ajax(
        { 
            url: "https://www.dayangels.xyz/api/reniec/reniec-dni",
            method: 'post',
            data:{dni:$('#edoc').val()},
            beforeSend(request) {
                request.setRequestHeader('Authorization', 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjozMDUsImNvcnJlbyI6Imtldmlucy5jaG9xdWVAZ21haWwuY29tIiwiaWF0IjoxNjU0NjI2MzY3fQ.BxPEwgV24FCAemB8lAPwgfTPhCHZs8b4IHOqQ56PLKU');
            },
            success: function(data){
                $('#enombre').val(data.result.nombres);
                $('#eapellido').val(data.result.paterno+' '+data.result.materno);
                msjSimple(true,'Los datos fueron traidos exitosamente.');
            },
            error: function(data){
                msjSimple(false,'Las consultas a la RENIEC se encuentra inabilitada en estos momentos.');
            },
        });
    }
});
// -----------------------------------------------PMS





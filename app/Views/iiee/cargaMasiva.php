<!-- <h1>aka estara el iiee</h1> -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-6 col-sm-6 col-12 m-auto">
                    <h4><i class="fa fa-building"></i> Instituciones educativas: Carga masiva</h4>
                </div>
                <div class="col-lg-6 col-sm-6 col-12 m-auto">
                    
                    <a href="<?php echo base_url('iiee');?>" class="btn btn-sm btn-light float-right border shadow">
                        <i class="fa fa-list"></i> 
                        Mostrar instituciones educativas
                    </a>
                    <a href="<?php echo base_url('cargamasiva/iiee/cargamasiva.xlsx');?>" class="btn btn-sm btn-info float-right border shadow mr-4">
                        <i class="fa fa-download"></i> 
                        Descargar formato
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-12 contenedorFormulario">
            <div class="card card-default">
                <!-- <div class="overlay overReg">
                    <i class="fas fa-2x fa-sync-alt"></i>
                </div> -->
                <div class="card-body">
                    <div class="alert alert-warning msjPms" style="display: none;">
                        <p class="m-0 font-weight-bold font-italic">El usuario no cuenta con el acceso a registros.</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
	                        <form method="post" enctype="multipart/form-data" class="dropzone dz-clickable h-100 text-center" id="dzLoadFile" style="height: 250px !important;">
	                            <div>
	                                <h6 class="text-center font-weight-bold">Archivos subidos</h6>
	                            </div>
	                            <input type="hidden" value="dep prube" name="test">
	                            <div class="dz-default dz-message">
	                                <span class="font-weight-bold font-italic">Suelta el archivo o realiza click para cargar archivos 
	                                	<!-- <span class="text-warning">(<5MB)</span> -->
	                            	</span>
	                            </div>
	                        </form>
	                    </div>
                    </div>
                </div>
                <div class="card-footer py-1 border-transparent">
	                <!-- <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Cancelar</button> -->
	                <button type="button" class="btn btn-sm btn-success guardarDescripcion float-right guardarArchivo"><i class="fa fa-upload"></i> Subir archivo</button>
	            </div>
            </div>
        </div>
    </div>
</div>
<script>
Dropzone.autoDiscover = false;
Dropzone.prototype.defaultOptions.dictDefaultMessage = "Arrastra los archivos aquí para subirlos.";
Dropzone.prototype.defaultOptions.dictFallbackMessage = "Su navegador no admite la carga de archivos de arrastrar y soltar.";
Dropzone.prototype.defaultOptions.dictFallbackText = "Utilice el formulario alternativo a continuación para cargar sus archivos como en los viejos tiempos.";
Dropzone.prototype.defaultOptions.dictFileTooBig = "El archivo es demasiado grande ({{filesize}}MiB). Tamaño máximo de archivo: {{maxFilesize}}MiB.";
Dropzone.prototype.defaultOptions.dictInvalidFileType = "No puedes subir archivos de este tipo.";
Dropzone.prototype.defaultOptions.dictResponseError = "Server responded with {{statusCode}} code.";
Dropzone.prototype.defaultOptions.dictCancelUpload = "Cancelar carga";
Dropzone.prototype.defaultOptions.dictCancelUploadConfirmation = "Estás segura de que deseas cancelar esta carga?";
Dropzone.prototype.defaultOptions.dictRemoveFile = "Eliminar archivo";
Dropzone.prototype.defaultOptions.dictMaxFilesExceeded = "No puedes subir más archivos.";

var ext__img = new Array("text/csv", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
$(document).ready( function () {
    $('.overlayPagina').css("display","none");
    initDropzone();
} );

function validateForm(myDropzone2)
{
	console.log(myDropzone2.files[0].type);
    if(ext__img.includes(myDropzone2.files[0].type))
        myDropzone2.processQueue();
    else
    	msjSimple(false,'Solo se puede subir archivos EXCEL')
}
function initDropzone()
{
    // mydz = new Dropzone("#dzLoadFile", {
    //     url: "<?php echo base_url('iiee/cargaMasiva');?>",
    //     dictDefaultMessage: "Seleccione algun archivo.",
    //     paramName: "file",
    //     autoProcessQueue:false,
    //     addRemoveLinks: true,
    //     maxFiles: 1,
    //     maxFilesize: 5,
    //     clickable: true,
    //     renameFile: function(file) {
    //         return new Date().getTime() + "_" + file.name;
    //     },
    //     init:function(){
    //         var submitButton = document.querySelector('.guardarArchivo');
    //         mydz=this;
    //         submitButton.addEventListener('click',function(){
    //             mydz.processQueue();
    //         });
    //         this.on("addedfile", function (file) {
    //             // alert('activar boton');
    //             $('.guardarArchivo').css('display','block');
    //         });
    //         this.on("removedfile", function (file) {
    //             console.log('Se removio un archivo');
    //             // alert('desactivar boton');
    //             $('.guardarArchivo').css('display','none');
    //         });
    //         this.on('complete',function(file){
    //             mydz.removeAllFiles();
    //             fillFiles($('#idEmpresaFile').val());
    //             // msjFiles(true,'Se guardo los archivos');
    //         });
    //     },
    // });
    myDropzone2 = new Dropzone("#dzLoadFile", {
        url: "<?php echo base_url('iiee/subirArchivo');?>",
        dictDefaultMessage: "Seleccione algun archivo.",
        paramName: "file",
        autoProcessQueue:false,
        addRemoveLinks: true,
        maxFiles: 1,
        maxFilesize: 10,
        clickable: true,
        renameFile: function(file) {
            // return "_" + file.name;
            var name = $('#codigoFaja').val();
            console.log(file);
            console.log(file.name);
            return 'cargamasiva.xlsx';
        },
        init:function(){
            var submitButton = document.querySelector('.guardarArchivo');
            myDropzone2=this;
            submitButton.addEventListener('click',function(){
                validateForm(myDropzone2);
            });
            this.on("addedfile", function (file) {
                // alert('activar boton');
                console.log(myDropzone2);
                $('.guardarArchivo').css('display','block');
            });
            this.on("removedfile", function (file) {
                console.log('Se removio un archivo');
                // alert('desactivar boton');
                $('.guardarArchivo').css('display','none');
            });
            this.on('complete',function(file){
                // clearForm(myDropzone2);
                // msjSimple(true,'Se guardo el registro exitosamente');
                // console.log(file);
                // let imgGuardada = path+$('#codigoFaja').val()+'/'+file.name;
                // $('#imgFaja').attr('src',imgGuardada);
                
            });
        },
        success: function(file, response) {
		    console.log("Archivo cargado con éxito:", file);
		    console.log("Respuesta del servidor:", response);
		    msjRee(response);
		    myDropzone2.removeAllFiles();
		},
    });
    console.dir(myDropzone2);
}
</script>
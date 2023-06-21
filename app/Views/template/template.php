<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>APP</title>
    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="{{asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}"> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link rel="stylesheet" href="<?php echo base_url('plugins/fontawesome/all/all.min.css');?>">
    <!-- Theme style ADMIN LTE CSS -->
    <link rel="stylesheet" href="<?php echo base_url('adminlte/dist/css/adminlte.min.css');?>">
    
    <!-- ---------------- -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> -->
    <!-- -------------- -->
    <!-- jquery -->
    <script src="<?php echo base_url('js/jquery.min.js');?>"></script>
    
    <!-- para validaciones -->
    <script src="<?php echo base_url('js/jquery.validate.js');?>"></script>
    <script src="<?php echo base_url('plugins/validate/translateMsgValidate.js');?>"></script>
    <!-- para notificaciones y alertas -->
    <link rel="stylesheet" href="<?php echo base_url('css/pnotify.custom.min.css');?>">
    <script src="<?php echo base_url('js/pnotify.custom.min.js');?>"></script>
    <!-- start cambiado porq ya esta desfasado -->
    <!-- <script src="{{asset('js/sweetalert.min.js')}}"></script> -->
    <!-- end cambiado porq ya esta desfasado -->
    <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <script src="<?php echo base_url('plugins/sweetalert2/sweetalert2.min.js');?>"></script>
    <!-- estart esto posiblemente se eliminara -->
    <!-- //------------pone dos barras negras en la tabla REEMPLAZAR -->
    <!-- <link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}"> -->
    <!-- js de datatable -->
    <!-- <script src="{{asset('js/jquery.dataTables.min.js')}}"></script> -->
    <!-- end esto posiblemente se eliminara -->
    <!-- start datatablae archivos de ahi -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css"> -->
    <link rel="stylesheet" href="<?php echo base_url('plugins/datatable/bootstrap.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('plugins/datatable/dataTables.bootstrap4.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('plugins/datatable/responsive.bootstrap4.min.css');?>">
    <!-- end datatable archivos de ahi -->

    <!-- select 2 -->
    <link href="<?php echo base_url('plugins/select2/select2.min.css');?>" rel="stylesheet" />
    <script src="<?php echo base_url('plugins/select2/select2.min.js');?>"></script>
    <!-- dropzone para subir archivos -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" integrity="sha512-3g+prZHHfmnvE1HBLwUnVuunaPOob7dpksI7/v6UnF/rnKGwHf/GdEq9K7iEN7qTtW+S0iivTcGpeTBqqB04wA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link rel="stylesheet" href="<?php echo base_url('plugins/dropzone/dropzone.min.css');?>">
    <!-- Subir archivos -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js" integrity="sha512-9WciDs0XP20sojTJ9E7mChDXy6pcO0qHpwbEJID1YVavz2H6QBz5eLoDD8lseZOb2yGT8xDNIV7HIe1ZbuiDWg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <script src="<?php echo base_url('plugins/dropzone/dropzone.min.js');?>"></script>
    <!-- propiedades generales -->
    <link rel="stylesheet" href="<?php echo base_url('css/general.css');?>">
    <!-- modificaciones en los mensajes de jsvalidate -->
    <script src="<?php echo base_url('js/modificacionJqueryValidate.js');?>"></script>
</head>
<body class="hold-transition sidebar-mini layout-boxed layout-fixed">
    <div class="wrapper" style="max-width: 100%;">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light py-0">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <a href="" class="m-auto">
            </a>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link nameNavbar" data-toggle="dropdown" href="#" aria-expanded="false" title="">
                        <i class="fa fa-circle-user fa-lg"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;min-width: 20rem; display: none;">
                        <a href="#" class="dropdown-item">
                            <div class="media mb-2">
                                <img src="https://yt3.ggpht.com/ytc/AMLnZu-CkHfe_d5oAVhWMfn4e8Ul-COm3yptlLyR1sFCNQ=s900-c-k-c0x00ffffff-no-rj" alt="User Avatar" class="img-size-50 img-circle m-auto">
                            </div>
                            <div class="media-body">
                                <p class="text-center nameLastNavbar">nombre apellido</p>
                                <p class="text-center">
                                    <span class="text-sm text-muted">Usuario registrado el <span class="dateRegNavbar"></span></span>
                                </p>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <div class="dropdown-item">
                            <div class="media">
                                <div class="media-body">
                                    <a href="#" class="btn btn-info btn-sm float-left"><i class="fa fa-house-user fa-sm"></i> Perfil</a>
                                    <button class="btn btn-info btn-sm float-right"><i class="fa fa-arrow-right-from-bracket fa-sm"></i> Cerrar Sesion</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: linear-gradient(-45deg,#212c50 50%,#20273e);">
            <a href="#" class="brand-link text-center">
                <!-- <img src="{{asset('img/logo.png')}}" alt="logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
                <!-- <br> -->
                <span class="brand-text font-weight-light ">app</span>
            </a>
            <div class="sidebar">
                <div class="user-panel mb-3 d-flex">
                    <div class="info">
                        <a href="#" class="d-block text-center ocultarTextIzqNameUser nameSidebar" title="nombre apellido">
                            --
                        </a>
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column nav-compact" data-widget="treeview" role="menu">
                        <li class="nav-item">
                            <a href="{{url('home/home')}}" class="nav-link bg-light sba1">
                                <i class="fas fa-tachometer-alt nav-icon"></i>
                                <p data-npms="dashboard">Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('cliente/cliente')}}" class="nav-link bg-secondary sba9">
                                <i class="nav-icon fa-solid fa-user"></i>
                                <p>Curso</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('proveedor/proveedor')}}" class="nav-link bg-secondary sba9">
                                <i class="nav-icon fa-solid fa-user-tie"></i>
                                <p>Ie</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('compra/registrar')}}" class="nav-link bg-secondary sba9">
                                <i class="nav-icon fa-solid fa-cart-shopping"></i>
                                <p>ugel</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('compra/compra')}}" class="nav-link bg-secondary sba9">
                                <i class="nav-icon fa-solid fa-list"></i>
                                <p>grado</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('producto/producto')}}" class="nav-link bg-secondary sba14">
                                <i class="nav-icon fa-solid fa-th-large"></i>
                                <p>seccion</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('venta/registrar')}}" class="nav-link bg-secondary sba14">
                                <i class="nav-icon fa-solid fa-cart-plus"></i>
                                <p>Estudiante</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('venta/venta')}}" class="nav-link bg-secondary sba14">
                                <i class="nav-icon fa-solid fa-list-alt"></i>
                                <p>eva</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link bg-secondary sba15 cerrarSesion">
                                <i class="nav-icon fas fa-arrow-right"></i>
                                <p>Cerrar sesion</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <div class="content-wrapper py-1">
            <div class="overlayPagina">
                <div class="loadingio-spinner-spin-i3d1hxbhik m-auto">
                    <div class="ldio-onxyanc9oyh">
                        <div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div>
                    </div>
                </div>
            </div>
            <h1>aka estara el body</h1>
        </div>
        <footer class="main-footer py-1">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0.0
            </div>
            <strong>Copyright &copy; 2023 <a href="#">app</a>.</strong>
        </footer>
    </div>
    <!-- jQuery -->
    <!-- <script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script> -->
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
    <!-- AdminLTE App js-->
    <script src="<?php echo base_url('adminlte/dist/js/adminlte.min.js');?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url('adminlte/dist/js/demo.js');?>"></script>

    <!-- start datatablae archivos de ahi -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap4.min.js"></script> -->
<script src="<?php echo base_url('plugins/datatable/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo base_url('plugins/datatable/dataTables.bootstrap4.min.js');?>"></script>
<script src="<?php echo base_url('plugins/datatable/dataTables.responsive.min.js');?>"></script>
<script src="<?php echo base_url('plugins/datatable/responsive.bootstrap4.min.js');?>"></script>
<!-- end datatable archivos de ahi -->
<!-- select 2 -->
<script src="<?php echo base_url('plugins/select2/select2.min.js');?>"></script>
<!-- ------------------------------------ -->
<!-- ------------------------------------ -->
<script src="<?php echo base_url('js/helper.js');?>"></script>
</body>
</html>

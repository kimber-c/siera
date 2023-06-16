<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');

$routes->setAutoRoute(true);
/*
$routes->get('/', 'LoginController::login');
$routes->post('login/ingresar', 'LoginController::ingresar');
$routes->get('login/ingresar', 'LoginController::ingresar');

$routes->get('grado', 'GradoController::index');
$routes->post('grado/registrar', 'GradoController::registrar');
$routes->get('grado/listar', 'GradoController::listar');
$routes->post('grado/eliminar', 'GradoController::eliminar');

$routes->get('iiee', 'IieeController::index');
$routes->post('iiee/registrar', 'IieeController::registrar');
$routes->get('iiee/listar', 'IieeController::listar');
$routes->post('iiee/eliminar', 'IieeController::eliminar');
$routes->post('iiee/consultar', 'IieeController::consultar');
$routes->post('iiee/actualizar', 'IieeController::actualizar');
$routes->get('iiee/cargaMasiva', 'IieeController::cargaMasiva');
$routes->post('iiee/subirArchivo', 'IieeController::subirArchivo');




$routes->get('provincia/listar', 'ProvinciaController::listar');
$routes->get('distrito/listar', 'DistritoController::listar');
$routes->get('ejecutora/listar', 'EjecutoraController::listar');*/





/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

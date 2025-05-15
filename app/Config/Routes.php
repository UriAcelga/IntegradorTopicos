<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index');
$routes->get('altas', 'AltasController::index');
$routes->get('bajas', 'BajasController::index');
$routes->get('modificacion', 'ModificacionController::index');
$routes->get('mostrar', 'MostrarController::index');
$routes->post('/bajasController/eleccion', 'BajasController::eleccion');   
$routes->post('/bajasController/baja', 'BajasController::baja');   
$routes->get('/bajasController/eleccion', 'BajasController::eleccion');
$routes->post('/bajasController/bajaVeterinario', 'BajasController::bajaVeterinario');   
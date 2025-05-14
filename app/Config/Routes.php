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
//metodos para altas 
$routes->post('altas/alta_amo', 'AltasController::alta_amo');
$routes->post('altas/alta_mascota', 'AltasController::alta_mascota');

$routes->post('altas/alta_veterinario', 'AltasController::alta_veterinario');


$routes->post('altas/guardar_asociacion', 'AltasController::guardarAsociacion'); // Procesa el guardado
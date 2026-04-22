<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index'); //mengakses rute ini harus login dulu

$routes->get('login', '\App\Controllers\AuthController::login');
$routes->post('login', '\App\Controllers\AuthController::login');
$routes->get('logout', '\App\Controllers\AuthController::logout');

$routes->get('/produk', 'ProduksiController::index', ['filter' => 'auth']); //mengakses rute ini harus login dulu
$routes->get('/keranjang', 'TransaksiController::index', ['filter'=>'auth']); //mengakses rute ini harus login dulu

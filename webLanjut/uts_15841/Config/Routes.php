<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index'); //mengakses rute ini harus login dulu

$routes->get('login', '\App\Controllers\AuthController::login'); //ambil data
$routes->post('login', '\App\Controllers\AuthController::login'); //kirim data ke server 
$routes->get('logout', '\App\Controllers\AuthController::logout');

$routes->get('/produk', 'ProduksiController::index', ['filter' => 'auth']); //mengakses rute ini harus login dulu
$routes->get('/keranjang', 'TransaksiController::index', ['filter'=>'auth']); //mengakses rute ini harus login dulu
$routes->get('contact', '\App\Controllerss\Home::contact', ['filter' => 'role']); //mengakses rute ini harus login dulu

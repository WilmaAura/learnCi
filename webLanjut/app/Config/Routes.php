<?php
/* 
post = Mengirim data baru ke server (seperti input form)
get = Mengambil/meminta data dari server 
*/
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index'); //mengakses rute ini harus login dulu


$routes->group('keranjang', ['filter' => 'auth'], function ($routes){ //mengakses rute ini harus login dulu
    $routes->get('', 'TransaksiController::index'); 
    $routes->post('', 'TransaksiController::cart_add');
    $routes->post('edit', 'TransaksiController::cart_edit');
    $routes->get('delete/(:any)', 'TransaksiController::cart_delete/$1');
    $routes->post('', 'TransaksiController::cart_add');
});

$routes->get('login', '\App\Controllers\AuthController::login'); //ambil data
$routes->post('login', '\App\Controllers\AuthController::login'); //kirim data ke server 
$routes->get('logout', '\App\Controllers\AuthController::logout');

$routes->get('contact', 'Home::contact', ['filter' => 'role']); //mengakses rute ini harus login dulu


/* Routes CRUD */
/* Routes for product */
$routes->group('produk', ['filter' => 'auth'], function($routes){
    $routes->get('', 'ProdukController::index'); //mengakses rute ini harus login dulu
    $routes->post('', 'ProdukController::create');
    //(:any) = placeholder untuk menambahkan parameter yang digunakan oleh function pada controller yang bertanggung jawab atas route ini
    $routes->post('edit/(:any)', 'ProdukController::edit/$1'); 
    $routes->get('delete/(:any)', 'ProdukController::delete/$1');
    $routes->get ('download', 'ProdukController::download');
});


<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Home;
use App\Controllers\Products;
use App\Controllers\Auth;

/**
 * @var RouteCollection $routes
 */

// Public Routes (Bisa diakses tanpa login)
$routes->get('/', [Home::class, 'index']);
$routes->get('/login', [Auth::class, 'login']);
$routes->post('/login/process', [Auth::class, 'processLogin']);
$routes->get('/logout', [Auth::class, 'logout']);

// Protected Routes (Wajib Login)
$routes->group('', ['filter' => 'authFilter'], function ($routes) {
    
    // Semua user terotentikasi bisa melihat daftar produk
    $routes->get('/products', [Products::class, 'index']);

    // Admin Only Routes (Hanya Admin yang bisa Tambah, Edit, Hapus)
    $routes->group('', ['filter' => 'adminFilter'], function ($routes) {
        $routes->get('/products/create', [Products::class, 'create']);
        $routes->post('/products/store', [Products::class, 'store']);
        $routes->get('/products/edit/(:num)', [Products::class, 'edit']);
        $routes->post('/products/update/(:num)', [Products::class, 'update']);
        $routes->get('/products/delete/(:num)', [Products::class, 'delete']);
    });
});
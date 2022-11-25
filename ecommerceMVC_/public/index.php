<?php

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use MVC\Router;
use Controllers\ProductoController;
use Controllers\PaginasController;
use Controllers\CarritoController;

$router = new Router();

// Privado
$router->get('/admin', [ProductoController::class, 'index']);
$router->get('/productos/crear', [ProductoController::class, 'crear']);
$router->post('/productos/crear', [ProductoController::class, 'crear']);
$router->get('/productos/actualizar', [ProductoController::class, 'actualizar']);
$router->post('/productos/actualizar', [ProductoController::class, 'actualizar']);
$router->post('/productos/eliminar', [ProductoController::class, 'eliminar']);

$router->get('/clientes/compras', [CarritoController::class, 'comprar']);

// Publico
$router->get('/', [PaginasController::class, 'index']);
$router->get('/producto', [PaginasController::class, 'producto']);

$router->get('/carrito', [CarritoController::class, 'carrito']);
$router->post('/carrito', [CarritoController::class, 'carrito']);
$router->get('/carrito/actualizar', [CarritoController::class, 'actualizar']);
$router->post('/carrito/actualizar', [CarritoController::class, 'actualizar']);
$router->post('/carrito/eliminar', [CarritoController::class, 'eliminar']);
$router->get('/carrito/compras', [CarritoController::class, 'comprar']);
$router->post('/carrito/compras', [CarritoController::class, 'comprar']);


// Login
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/register', [LoginController::class, 'register']);
$router->post('/register', [LoginController::class, 'register']);
$router->get('/logout', [LoginController::class, 'logout']);

$router->comprobarRutas();

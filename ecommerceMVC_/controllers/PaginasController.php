<?php

namespace Controllers;

use Model\Admin;
use MVC\Router;
use Model\Producto;
use Model\Categorias;

class PaginasController
{
    public static function index(Router $router)
    {
        $categorias = Categorias::all();
        $productos = Producto::all();

        $idCategoria = $_GET['categoria'] ?? '';
        $nombreCategoria = $_GET['nombre'] ?? '';
        $precioMin = $_GET['precioMinimo'] ?? 0;
        $precioMax = $_GET['precioMaximo'] ?? 99999 * 99999;
        $buscarNombre = $_GET['buscar'] ?? '';

        $filtros = [
            "categoria" => $idCategoria,
            "precio" => $precioMax === '' && $precioMin === '' ? '' : [$precioMin, $precioMax],
            "buscar" => $buscarNombre,
        ];

        $orden = $_GET['orden'];

        $productosCategoria = Producto::aplicarFiltros($filtros, $orden);

        $router->render('/paginas/index', [
            'categorias' => $categorias,
            'productos' => $productos,
            'productosCategoria' => $productosCategoria,
            'nombreCategoria' => $nombreCategoria,
            'idCategoria' => $idCategoria
        ]);
    }

    public static function producto(Router $router)
    {
        $idProducto = $_GET['producto'];
        $producto = Producto::buscar($idProducto);

        $router->render('/paginas/producto', [
            'producto' => $producto
        ]);
    }
}

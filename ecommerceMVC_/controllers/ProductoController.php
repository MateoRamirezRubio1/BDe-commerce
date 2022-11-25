<?php

namespace Controllers;

use MVC\Router;
use Model\Producto;
use Model\Categorias;

class ProductoController
{
    public static function index(Router $router)
    {
        $productos = Producto::all();
        $resultado = $_GET['resultado'] ?? null;

        $router->render('/productos/admin', [
            'productos' => $productos,
            'resultado' => $resultado
        ]);
    }

    public static function crear(Router $router)
    {
        $producto = new Producto();
        $categorias = Categorias::all();
        $errores = Producto::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $producto = new Producto($_POST['producto']);

            $errores = $producto->validarCampos();

            if (empty($errores)) {
                $producto->guardar();
            }
        }

        $router->render('productos/crear', [
            'producto' => $producto,
            'categorias' => $categorias,
            'errores' => $errores,
        ]);
    }

    public static function actualizar(Router $router)
    {
        $id = validarRedireccionar('/admin');

        // Obtener datos del producto
        $producto = Producto::buscar($id);
        $errores = Producto::getErrores();
        // Consulta para obtener las categorias
        $categorias = Categorias::all();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $argumentos = $_POST['producto'];

            $producto->sincronizar($argumentos);

            $errores = $producto->validarCampos();

            if (empty($errores)) {
                $producto->guardar();
            }
        }

        $router->render('productos/actualizar', [
            'producto' => $producto,
            'categorias' => $categorias,
            'errores' => $errores,
        ]);
    }

    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                $producto = Producto::buscar($id);
                // Eliminar producto
                $producto->eliminar();
            }
        }
    }
}
